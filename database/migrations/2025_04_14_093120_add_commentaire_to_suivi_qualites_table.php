<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentaireToSuiviQualitesTable extends Migration
{
    public function up()
{
    Schema::table('suivi_qualites', function (Blueprint $table) {
        $table->text('commentaire')->nullable();
    });
}

public function down()
{
    Schema::table('suivi_qualites', function (Blueprint $table) {
        $table->dropColumn('commentaire');
    });
}
}
