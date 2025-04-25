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
        Schema::create('offres', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Colonne pour l'ID unique
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade'); // Colonne pour la clé étrangère vers l'entreprise
            $table->string('title'); // Colonne pour le titre de l'offre
            $table->longText('description'); // Colonne pour la description de l'offre
            $table->string('localisation')->nullable(); // Colonne pour la localisation de l'offre
            $table->string('salaire')->nullable(); // Colonne pour le salaire de l'offre
            $table->foreignUuid('type_contrat_id')->constrained()->onDelete('cascade'); 
            $table->string('city')->nullable(); // Colonne pour la ville de l'offre
            $table->date('publicationDate'); // Colonne pour la date de publication de l'offre
            $table->date('deadline');
            $table->string('langue')->nullable();
            $table->longText('skills')->nullable();
            $table->longText('experience')->nullable();	
            $table->longText('formation')->nullable(); 
            $table->longText('mission')->nullable();
            $table->longText('objective')->nullable(); 
            $table->longText('otherInformation')->nullable(); 
            $table->string('fiche')->nullable(); 
            $table->string('status')->default('brouillon'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
