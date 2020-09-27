<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUfrFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ufr_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->float('price')->default(0);
            $table->integer('pieces')->nullable();
            $table->string('name')->default('');
            $table->string('slug')->unique();
            $table->float('size')->default(0);
            $table->string('creationdate')->nullable();
            $table->string('owner');
            $table->text('info');
            $table->string('encfile');
            $table->string('path');
            $table->string('original_file_name');
            $table->string('image')->nullable();
            $table->boolean('visible')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

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
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('ufr_files');
    }
}
