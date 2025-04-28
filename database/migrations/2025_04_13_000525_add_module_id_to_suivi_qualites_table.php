<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModuleIdToSuiviQualitesTable extends Migration
{
    public function up()
{
    Schema::table('suivi_qualites', function (Blueprint $table) {
        $table->unsignedBigInteger('module_id')->after('agent_id');
        // Ajoutez une clé étrangère si nécessaire
        // $table->foreign('module_id')->references('id')->on('modules');
    });
}
public function down()
{
    Schema::table('suivi_qualites', function (Blueprint $table) {
        // $table->dropForeign(['module_id']); // Si vous avez ajouté une clé étrangère
        $table->dropColumn('module_id');
    });
}
}
