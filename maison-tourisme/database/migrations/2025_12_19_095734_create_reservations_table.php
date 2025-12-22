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
        Schema::create('reservations', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('site_id')->constrained('sites')->cascadeOnDelete();

    $table->string('nom_complet');
    $table->string('pays_origine');
    $table->string('langue');

    $table->date('date_arrivee');
    $table->date('date_depart');
    $table->integer('nombre_jours');

    $table->enum('type_groupe', ['individuel', 'groupe']);
    $table->integer('adultes');
    $table->integer('enfants')->default(0);
    $table->integer('total_personnes');

    $table->enum('statut', ['en_attente', 'validee', 'refusee'])
          ->default('en_attente');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
