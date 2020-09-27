<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollToAdvertisings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisings', function (Blueprint $table) {
            $table->boolean('enable_content_top')->default(true);
            $table->boolean('show_homepage_content_top')->default(true);
            $table->boolean('enable_banner_top')->default(true);
            $table->boolean('show_homepage_banner_top')->default(true);
            $table->boolean('enable_banner_banner_left_and_right')->default(true);
            $table->boolean('show_homepage_banner_left_and_right')->default(true);
        });

        DB::table('advertisings')->insert([
            [
                'content_top' => '',
                'banner_top' => '',
                'banner_left' => '',
                'banner_right' => '',
                'enable_content_top' => '0',
                'show_homepage_content_top' => '0',
                'enable_banner_top' => '0',
                'show_homepage_banner_top' => '0',
                'enable_banner_banner_left_and_right' => '0',
                'show_homepage_banner_left_and_right' => '0'
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
        Schema::table('advertisings', function (Blueprint $table) {
            $table->dropColumn('enable_content_top');
            $table->dropColumn('show_homepage_content_top');
            $table->dropColumn('enable_banner_top');
            $table->dropColumn('show_homepage_banner_top');
            $table->dropColumn('show_homepage_banner_top');
            $table->dropColumn('enable_banner_banner_left_and_right');
            $table->dropColumn('show_homepage_banner_left_and_right');
        });
    }
}
