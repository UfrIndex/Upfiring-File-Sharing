<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollToOptionsCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->tinyInteger('count_row_in_first_position')->default(5);
            $table->tinyInteger('count_row_in_second_position')->default(5);
            $table->tinyInteger('count_row_in_third_position')->default(5);
            $table->tinyInteger('count_row_in_fourth_position')->default(5);
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
            $table->dropColumn('count_row_in_first_position');
            $table->dropColumn('count_row_in_second_position');
            $table->dropColumn('count_row_in_third_position');
            $table->dropColumn('count_row_in_fourth_position');
        });
    }
}
