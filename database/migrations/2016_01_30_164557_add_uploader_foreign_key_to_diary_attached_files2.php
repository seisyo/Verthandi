<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUploaderForeignKeyToDiaryAttachedFiles2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diary_attached_files', function($table){
            $table->integer('uploader')->unsigned();
            $table->foreign('uploader')->references('id')->on('user');
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
            $table->dropColumn('uploader');
        });
    }
}
