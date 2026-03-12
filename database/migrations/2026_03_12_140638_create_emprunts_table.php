<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emprunts', function (Blueprint $table) {
            $table->id();
            $table->date('date_emprunt');
            $table->date('date_retour_prevue');
            $table->date('date_retour')->nullable();
            $table->foreignId('usager_id')->constrained('usagers')->cascadeOnDelete();
            $table->foreignId('exemplaire_id')->constrained('exemplaires')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
