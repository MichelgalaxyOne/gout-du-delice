<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GerantController;
use App\Http\Controllers\ServeuseController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsletterController;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

Route::get('/menu/table/{table}', function ($table) {
    return "Menu pour la table $table (page en construction par votre camarade)";
})->name('client.menu');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ── ROUTES GÉRANT ──
Route::middleware(['auth', 'gerant'])->prefix('gerant')->name('gerant.')->group(function () {
    Route::get('/dashboard', [GerantController::class, 'dashboard'])->name('dashboard');

    // Catégories
    Route::get('/categories', [GerantController::class, 'categories'])->name('categories.index');
    Route::post('/categories', [GerantController::class, 'categorieStore'])->name('categories.store');
    Route::put('/categories/{categorie}', [GerantController::class, 'categorieUpdate'])->name('categories.update');
    Route::patch('/categories/{categorie}/toggle', [GerantController::class, 'categorieToggle'])->name('categories.toggle');
    Route::delete('/categories/{categorie}', [GerantController::class, 'categorieDestroy'])->name('categories.destroy');

    // Plats
    Route::get('/plats', [GerantController::class, 'plats'])->name('plats.index');
    Route::post('/plats', [GerantController::class, 'platStore'])->name('plats.store');
    Route::put('/plats/{plat}', [GerantController::class, 'platUpdate'])->name('plats.update');
    Route::patch('/plats/{plat}/toggle', [GerantController::class, 'platToggle'])->name('plats.toggle');
    Route::delete('/plats/{plat}', [GerantController::class, 'platDestroy'])->name('plats.destroy');
    Route::delete('/plat-images/{image}', [GerantController::class, 'platImageDestroy'])->name('plat-images.destroy');
    Route::patch('/plat-images/{image}/principale', [GerantController::class, 'platImageSetPrincipale'])->name('plat-images.principale');

    // Tables
    Route::get('/tables', [GerantController::class, 'tables'])->name('tables.index');
    Route::post('/tables/{table}/qr', [GerantController::class, 'tableGenererQr'])->name('tables.qr');
    Route::post('/tables/generer-tous-qr', [GerantController::class, 'tablesGenererTousQr'])->name('tables.qr.all');
    Route::patch('/tables/{table}/statut', [GerantController::class, 'tableStatutUpdate'])->name('tables.statut');
});

// ── ROUTES SERVEUSE ──
Route::middleware(['auth', 'serveuse'])->prefix('serveuse')->name('serveuse.')->group(function () {
    Route::get('/dashboard', [ServeuseController::class, 'dashboard'])->name('dashboard');
});

// ── ROUTES CUISINE ──
Route::middleware(['auth', 'cuisine'])->prefix('cuisine')->name('cuisine.')->group(function () {
    Route::get('/dashboard', [CuisineController::class, 'dashboard'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';