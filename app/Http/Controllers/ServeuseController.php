<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\RestoTable;
use Illuminate\Http\Request;

class ServeuseController extends Controller
{
    public function dashboard()
    {
        $commandes = Commande::with(['table', 'items.plat', 'paiement'])
            ->whereNotIn('statut', ['livree', 'annulee'])
            ->latest()
            ->get();

        $tables = RestoTable::orderBy('numero')->get();

        return view('serveuse.dashboard', compact('commandes', 'tables'));
    }
}