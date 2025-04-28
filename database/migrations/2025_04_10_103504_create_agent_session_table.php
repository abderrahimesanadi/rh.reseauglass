<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentSessionTable extends Migration
{
    public function up()
    {
        Schema::create('agent_session', function (Blueprint $table) {
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('session_id');
            $table->primary(['agent_id', 'session_id']);
            
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('agent_session');
    }
}