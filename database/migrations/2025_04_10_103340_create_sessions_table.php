<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->date('date_formation');
            $table->unsignedBigInteger('module_id');
            $table->integer('nombre_agents')->default(0);
            $table->timestamps();
            
            $table->foreign('module_id')->references('id')->on('modules');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}