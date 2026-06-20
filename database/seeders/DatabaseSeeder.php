<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categorie;
use App\Models\Plat;
use App\Models\RestoTable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── UTILISATEURS ──
        User::create([
            'name' => 'Gérant Délice',
            'email' => 'gerant@delice.com',
            'password' => bcrypt('gerant123'),
            'role' => 'gerant',
            'telephone' => '+22900000001',
        ]);

        User::create([
            'name' => 'Aïcha Serveuse',
            'email' => 'serveuse@delice.com',
            'password' => bcrypt('password'),
            'role' => 'serveuse',
            'telephone' => '+22900000002',
        ]);

        User::create([
            'name' => 'Chef Cuisine',
            'email' => 'cuisine@delice.com',
            'password' => bcrypt('password'),
            'role' => 'cuisine',
            'telephone' => '+22900000003',
        ]);

        // ── TABLES (25 tables) ──
        for ($i = 1; $i <= 25; $i++) {
            RestoTable::create([
                'numero' => $i,
                'statut' => 'libre',
            ]);
        }

        // ── CATÉGORIES ──
        $entrees = Categorie::create(['nom' => 'Entrées', 'icone' => '🥗', 'ordre' => 1]);
        $plats = Categorie::create(['nom' => 'Plats', 'icone' => '🍽️', 'ordre' => 2]);
        $boissons = Categorie::create(['nom' => 'Boissons', 'icone' => '🥤', 'ordre' => 3]);
        $desserts = Categorie::create(['nom' => 'Desserts', 'icone' => '🍰', 'ordre' => 4]);

        // ── PLATS ──
        Plat::create([
            'categorie_id' => $entrees->id,
            'nom' => 'Salade César',
            'description' => 'Salade fraîche, poulet grillé, parmesan, croûtons',
            'prix' => 2500,
            'temps_preparation' => 10,
        ]);

        Plat::create([
            'categorie_id' => $entrees->id,
            'nom' => 'Soupe du jour',
            'description' => 'Soupe de légumes de saison',
            'prix' => 1500,
            'temps_preparation' => 8,
        ]);

        Plat::create([
            'categorie_id' => $plats->id,
            'nom' => 'Poulet braisé',
            'description' => 'Poulet braisé, riz, sauce tomate épicée',
            'prix' => 4500,
            'temps_preparation' => 25,
        ]);

        Plat::create([
            'categorie_id' => $plats->id,
            'nom' => 'Poisson grillé',
            'description' => 'Poisson frais grillé, alloco, sauce piment',
            'prix' => 5500,
            'temps_preparation' => 30,
        ]);

        Plat::create([
            'categorie_id' => $boissons->id,
            'nom' => 'Jus de bissap',
            'description' => 'Jus de bissap maison glacé',
            'prix' => 1000,
            'temps_preparation' => 2,
        ]);

        Plat::create([
            'categorie_id' => $boissons->id,
            'nom' => 'Coca-Cola',
            'description' => '33cl',
            'prix' => 800,
            'temps_preparation' => 1,
        ]);

        Plat::create([
            'categorie_id' => $desserts->id,
            'nom' => 'Tarte aux fruits',
            'description' => 'Tarte fraîche aux fruits de saison',
            'prix' => 2000,
            'temps_preparation' => 5,
        ]);
    }
}