<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuiviFormationTable extends Migration
{
    public function up()
    {
        Schema::create('suivi_formation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('agent_id');
            $table->string('statut')->default('INSCRIT'); // INSCRIT ou TERMINÉE
            $table->timestamps();
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('suivi_formation');
    }
}