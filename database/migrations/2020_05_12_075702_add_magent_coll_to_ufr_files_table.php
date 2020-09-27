<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMagentCollToUfrFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ufr_files', function (Blueprint $table) {
            $table->string('magnet')->nullable();
            $table->integer('seeds')->default(0);
            $table->integer('peers')->default(0);
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
            $table->dropColumn('magnet');
            $table->dropColumn('seeds');
            $table->dropColumn('peers');
        });
    }
}
