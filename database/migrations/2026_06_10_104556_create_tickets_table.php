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
        Schema::create('tickets', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string('titre');
                $table->text('description');
                $table->enum('statut', ['nouveau', 'en_cours', 'resolu', 'clos'])->default('nouveau');
                $table->enum('priorite', ['normale', 'critique'])->default('normale');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('poste_informatique_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
