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
        // Si la table n'existe pas, créez-la
        if (!Schema::hasTable('monthly_leaves')) {
            Schema::create('monthly_leaves', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('employee_id');
                $table->string('month_key'); // Format: "MM/YYYY" comme "05/2025"
                $table->double('leave_value', 8, 2)->default(0.00);
                $table->timestamps();
                
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            });
        }
        // Si la table existe mais n'a pas les bonnes colonnes, ajoutez-les
        else {
            // Vérifiez si la colonne existe déjà
            if (!Schema::hasColumn('monthly_leaves', 'month_key')) {
                Schema::table('monthly_leaves', function (Blueprint $table) {
                    $table->string('month_key')->after('employee_id');
                });
            }
            
            if (!Schema::hasColumn('monthly_leaves', 'leave_value')) {
                Schema::table('monthly_leaves', function (Blueprint $table) {
                    $table->double('leave_value', 8, 2)->default(0.00)->after('month_key');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Si vous souhaitez supprimer la table lors d'un rollback
        // Schema::dropIfExists('monthly_leaves');
        
        // Ou si vous souhaitez simplement supprimer les colonnes ajoutées
        Schema::table('monthly_leaves', function (Blueprint $table) {
            if (Schema::hasColumn('monthly_leaves', 'month_key')) {
                $table->dropColumn('month_key');
            }
            if (Schema::hasColumn('monthly_leaves', 'leave_value')) {
                $table->dropColumn('leave_value');
            }
        });
    }
};