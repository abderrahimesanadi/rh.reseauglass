<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongeAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('conge_agents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('service');
            $table->string('nom');
            $table->string('prenom');
            $table->decimal('cp_total', 5, 1)->default(0);
            $table->date('date_suivi');
            $table->string('jour_type'); // 'L', 'M', 'ME', 'J', 'V', 'SAM', 'DIM'
            $table->string('status', 1); // 'C' (congé), 'A' (absent), 'M' (malade)
            $table->timestamps();
            
            // Clé étrangère si vous avez une table agents
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conge_agents');
    }
}
