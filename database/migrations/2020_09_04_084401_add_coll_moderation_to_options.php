<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollModerationToOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->boolean('moderation_status')->default(true);
        });

        DB::table('options')->insert([
            [
                'id' => 1,
                'description' => 'Site No.1',
                'title' => 'Site No.1',
                'template' => '1',
                'frontpage_status' => '1',
                'homepage_first_position' => 'uploads',
                'homepage_first_status' => '1',
                'homepage_second_position' => 'popular',
                'homepage_second_status' => '1',
                'homepage_third_position' => 'movies',
                'homepage_third_status' => '1',
                'homepage_fourth_position'=>'games',
                'homepage_fourth_status'=>'1',
                'count_row_in_first_position'=>'5',
                'count_row_in_second_position'=>'2',
                'count_row_in_third_position'=>'10',
                'count_row_in_fourth_position'=>'0',
                'enable_alternative_table_in_home'=>'1',
                'count_rows_in_alternative_table'=>'10',
                'moderation_status' => '0'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('moderation_status');
        });
    }
}
