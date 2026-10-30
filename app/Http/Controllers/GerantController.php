<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Plat;
use App\Models\PlatImage;
use App\Models\Categorie;
use App\Models\RestoTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GerantController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'commandes_jour' => Commande::whereDate('created_at', today())->count(),
            'ventes_jour' => Commande::whereDate('created_at', today())
                ->where('statut_paiement', 'confirme')
                ->sum('montant_total'),
            'plats_total' => Plat::count(),
            'tables_total' => RestoTable::count(),
            'commandes_en_cours' => Commande::whereNotIn('statut', ['livree', 'annulee'])->count(),
        ];

        $dernieres_commandes = Commande::with(['table', 'items.plat'])
            ->latest()
            ->take(10)
            ->get();

        return view('gerant.dashboard', compact('stats', 'dernieres_commandes'));
    }

    // ── CATÉGORIES ──
    public function categories()
    {
        $categories = Categorie::withCount('plats')->orderBy('ordre')->get();
        return view('gerant.categories.index', compact('categories'));
    }

    public function categorieStore(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'icone' => 'nullable|string|max:10',
        ]);

        Categorie::create([
            'nom' => $request->nom,
            'icone' => $request->icone ?? '🍽️',
            'ordre' => Categorie::max('ordre') + 1,
            'actif' => true,
        ]);

        return back()->with('success', 'Catégorie ajoutée avec succès !');
    }

    public function categorieUpdate(Request $request, Categorie $categorie)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'icone' => 'nullable|string|max:10',
        ]);

        $categorie->update([
            'nom' => $request->nom,
            'icone' => $request->icone,
        ]);

        return back()->with('success', 'Catégorie modifiée avec succès !');
    }

    public function categorieToggle(Categorie $categorie)
    {
        $categorie->update(['actif' => !$categorie->actif]);
        return back()->with('success', 'Statut mis à jour !');
    }

    public function categorieDestroy(Categorie $categorie)
    {
        if ($categorie->plats()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer : cette catégorie contient des plats.');
        }

        $categorie->delete();
        return back()->with('success', 'Catégorie supprimée !');
    }

    // ── PLATS ──
    public function plats()
    {
        $plats = Plat::with(['categorie', 'images'])->orderBy('created_at', 'desc')->get();
        $categories = Categorie::orderBy('ordre')->get();
        return view('gerant.plats.index', compact('plats', 'categories'));
    }

    public function platStore(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'temps_preparation' => 'required|integer|min:1',
            'allergenes' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ]);

        $plat = Plat::create([
            'categorie_id' => $request->categorie_id,
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'temps_preparation' => $request->temps_preparation,
            'allergenes' => $request->allergenes,
            'disponible' => true,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('plats', 'public');
                PlatImage::create([
                    'plat_id' => $plat->id,
                    'image' => $path,
                    'principale' => $index === 0,
                ]);
            }
        }

        return back()->with('success', 'Plat ajouté avec succès !');
    }

    public function platUpdate(Request $request, Plat $plat)
    {
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'temps_preparation' => 'required|integer|min:1',
            'allergenes' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ]);

        $plat->update($request->only(['categorie_id', 'nom', 'description', 'prix', 'temps_preparation', 'allergenes']));

        if ($request->hasFile('images')) {
            $aDejaUnePrincipale = $plat->images()->where('principale', true)->exists();

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('plats', 'public');
                PlatImage::create([
                    'plat_id' => $plat->id,
                    'image' => $path,
                    'principale' => !$aDejaUnePrincipale && $index === 0,
                ]);
            }
        }

        return back()->with('success', 'Plat modifié avec succès !');
    }

    public function platToggle(Plat $plat)
    {
        $plat->update(['disponible' => !$plat->disponible]);
        return back()->with('success', 'Disponibilité mise à jour !');
    }

    public function platDestroy(Plat $plat)
    {
        foreach ($plat->images as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $plat->delete();
        return back()->with('success', 'Plat supprimé !');
    }

    public function platImageDestroy(PlatImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();
        return response()->json(['success' => true]);
    }

    public function platImageSetPrincipale(PlatImage $image)
    {
        PlatImage::where('plat_id', $image->plat_id)->update(['principale' => false]);
        $image->update(['principale' => true]);
        return response()->json(['success' => true]);
    }

    // ── TABLES ──
    public function tables()
    {
        $tables = RestoTable::orderBy('numero')->get();
        return view('gerant.tables.index', compact('tables'));
    }

    public function tableGenererQr(RestoTable $table)
    {
        $url = route('client.menu', ['table' => $table->numero]);

        $qrcode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->size(400)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($url);

        $filename = 'qrcodes/table-' . $table->numero . '.svg';
        Storage::disk('public')->put($filename, $qrcode);

        $table->update(['qr_code' => $filename]);

        return back()->with('success', 'QR Code généré pour la table ' . $table->numero . ' !');
    }

    public function tablesGenererTousQr()
    {
        $tables = RestoTable::all();

        foreach ($tables as $table) {
            $url = route('client.menu', ['table' => $table->numero]);

            $qrcode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                ->size(400)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($url);

            $filename = 'qrcodes/table-' . $table->numero . '.svg';
            Storage::disk('public')->put($filename, $qrcode);

            $table->update(['qr_code' => $filename]);
        }

        return back()->with('success', 'Tous les QR Codes ont été générés avec succès !');
    }

    public function tableStatutUpdate(Request $request, RestoTable $table)
    {
        $request->validate([
            'statut' => 'required|in:libre,occupee,reservee',
        ]);

        $table->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut de la table mis à jour !');
    }
}