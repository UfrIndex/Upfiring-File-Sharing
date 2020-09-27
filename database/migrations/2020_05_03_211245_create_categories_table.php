<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
        });

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Adult', 'slug'=>'adult'],
            ['id' => 2, 'name' => 'Applications', 'slug'=>'applications'],
            ['id' => 3, 'name' => 'Audio', 'slug'=>'audio'],
            ['id' => 4, 'name' => 'E-Books', 'slug'=>'e-books'],
            ['id' => 5, 'name' => 'Games', 'slug'=>'games'],
            ['id' => 6, 'name' => 'Other', 'slug'=>'other'],
            ['id' => 7, 'name' => 'Scripts / Plugins / Themes', 'slug'=>'scripts-plugins-themes'],
            ['id' => 8, 'name' => 'Video', 'slug'=>'video'],
            ['id' => 9, 'name' => 'Movies', 'slug'=>'movies'],
            ['id' => 10, 'name' => 'x265 BluRay Encodes', 'slug'=>'x265-bluray-encodes']
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
