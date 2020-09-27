<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollToUfrFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ufr_files', function (Blueprint $table) {
            $table->integer('count_likes')->default(0);
            $table->integer('count_dislikes')->default(0);
            $table->integer('count_likes_dislikes')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ufr_files', function (Blueprint $table) {
            $table->dropColumn('count_likes');
            $table->dropColumn('count_dislikes');
            $table->dropColumn('count_likes_dislikes');
        });
    }
}
