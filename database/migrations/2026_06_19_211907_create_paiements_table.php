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
    Schema::create('paiements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('commande_id')->constrained()->onDelete('cascade');
        $table->enum('methode', ['mtn', 'moov', 'celtiis', 'liquide']);
        $table->string('transaction_id')->nullable();
        $table->decimal('montant', 10, 2);
        $table->enum('statut', ['en_attente', 'confirme', 'echoue'])->default('en_attente');
        $table->foreignId('confirme_par')->nullable()->constrained('users')->onDelete('set null');
        $table->timestamp('confirme_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
