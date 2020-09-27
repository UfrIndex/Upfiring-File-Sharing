<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlternativeTableCollToOptionsCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->boolean('enable_alternative_table_in_home')->default(0);
            $table->tinyInteger('count_rows_in_alternative_table')->default(10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('enable_alternative_table_in_home');
            $table->dropColumn('count_rows_in_alternative_table');
        });
    }
}
