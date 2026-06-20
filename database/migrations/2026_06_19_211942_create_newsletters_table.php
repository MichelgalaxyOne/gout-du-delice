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
    Schema::create('newsletters', function (Blueprint $table) {
        $table->id();
        $table->string('sujet');
        $table->text('contenu');
        $table->enum('type', ['promotion', 'nouveau_menu', 'info'])->default('info');
        $table->timestamp('envoye_at')->nullable();
        $table->integer('nombre_destinataires')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
