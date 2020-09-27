<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('code')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert([
            ['id' => 1, 'name' => 'header_script', 'code'=>''],
            ['id' => 2, 'name' => 'footer_script', 'code'=>''],
            ['id' => 3, 'name' => 'footer', 'code'=>'']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
