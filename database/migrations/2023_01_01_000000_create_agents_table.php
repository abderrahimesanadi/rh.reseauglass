<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->foreignId('service_id')->constrained();
            $table->integer('nombre_formation_suivi')->default(0);
            $table->timestamps();
            $table->index('service_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('agents');
    }
}