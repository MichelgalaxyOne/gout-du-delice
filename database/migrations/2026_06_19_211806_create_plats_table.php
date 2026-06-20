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
    Schema::create('plats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
        $table->string('nom');
        $table->text('description')->nullable();
        $table->decimal('prix', 10, 2);
        $table->string('image')->nullable();
        $table->boolean('disponible')->default(true);
        $table->integer('temps_preparation')->default(15); // en minutes
        $table->string('allergenes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plats');
    }
};
