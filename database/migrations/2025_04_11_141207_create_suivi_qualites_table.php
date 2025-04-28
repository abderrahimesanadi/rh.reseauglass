<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuiviQualitesTable extends Migration
{
    public function up()
    {
        Schema::create('suivi_qualites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained();
            $table->foreignId('module_id')->constrained();
            $table->date('date_fin_formation')->nullable();
            $table->enum('analyse', ['Conforme', 'Passable', 'Non conforme'])->nullable();
            $table->foreignId('suivi_qualite_id')->nullable()->constrained('users');
            $table->string('numero_dossier')->nullable();
            $table->date('date_traitement_dossier')->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suivi_qualites');
    }
}