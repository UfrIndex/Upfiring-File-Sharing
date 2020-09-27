<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollToOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->boolean('frontpage_status')->default(true);
            $table->string('homepage_first_position')->default(true);
            $table->boolean('homepage_first_status')->default(true);
            $table->string('homepage_second_position')->default(2);
            $table->boolean('homepage_second_status')->default(true);
            $table->string('homepage_third_position')->default(3);
            $table->boolean('homepage_third_status')->default(true);
            $table->string('homepage_fourth_position')->default(4);
            $table->boolean('homepage_fourth_status')->default(true);

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
            $table->dropColumn('frontpage_status');
            $table->dropColumn('homepage_first_position');
            $table->dropColumn('homepage_first_status');
            $table->dropColumn('homepage_second_position');
            $table->dropColumn('homepage_second_status');
            $table->dropColumn('homepage_third_position');
            $table->dropColumn('homepage_third_status');
            $table->dropColumn('homepage_fourth_position');
            $table->dropColumn('homepage_fourth_status');
        });
    }
}
