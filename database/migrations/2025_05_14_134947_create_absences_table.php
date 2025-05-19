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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('service')->nullable();
            $table->integer('month');
            $table->integer('year');
            $table->decimal('cp_value', 5, 1)->default(0);
            $table->decimal('m_value', 5, 1)->default(0);
            $table->decimal('a_value', 5, 1)->default(0);
            $table->string('day_type')->nullable();
            $table->integer('day_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};