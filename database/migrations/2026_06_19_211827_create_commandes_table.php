<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('commandes', function (Blueprint $table) {
        $table->id();
        $table->string('reference')->unique();
        $table->foreignId('resto_table_id')->nullable()->constrained()->onDelete('set null');
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        $table->enum('type', ['sur_place', 'en_ligne'])->default('sur_place');
        $table->enum('mode_livraison', ['livraison', 'retrait'])->nullable();
        $table->text('adresse_livraison')->nullable();
        $table->enum('statut', ['en_attente', 'confirmee', 'en_preparation', 'prete', 'livree', 'annulee'])->default('en_attente');
        $table->enum('mode_paiement', ['kkiapay', 'mobile_manuel', 'liquide'])->nullable();
        $table->enum('statut_paiement', ['en_attente', 'confirme', 'echoue'])->default('en_attente');
        $table->decimal('montant_total', 10, 2);
        $table->text('note_client')->nullable();
        $table->integer('estimation_temps')->nullable(); // en minutes
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
