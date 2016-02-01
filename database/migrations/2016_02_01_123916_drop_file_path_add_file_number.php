<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropFilePathAddFileNumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diary_attached_files', function($table){
            $table->dropColumn('file_path');
            $table->integer('file_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diary_attached_files', function($table){
            $table->dropColumn('file_number');
            $table->integer('file_path');
        });
    }
}
