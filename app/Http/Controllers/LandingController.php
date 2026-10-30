<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Plat;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $categories = Categorie::where('actif', true)
            ->orderBy('ordre')
            ->with(['platsDisponibles'])
            ->get();

        $plats_vedettes = Plat::where('disponible', true)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('landing', compact('categories', 'plats_vedettes'));
    }
}