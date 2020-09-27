<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ufr_file_id');
            $table->boolean('like');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ufr_file_id')->references('id')->on('ufr_files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['ufr_file_id']);
        });
        Schema::dropIfExists('likes');
    }
}
