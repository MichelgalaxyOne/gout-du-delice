<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    public function dashboard()
    {
        $commandes = Commande::with(['table', 'items.plat'])
            ->where('statut_paiement', 'confirme')
            ->whereIn('statut', ['confirmee', 'en_preparation'])
            ->orderBy('created_at')
            ->get();

        return view('cuisine.dashboard', compact('commandes'));
    }
}