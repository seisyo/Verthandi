<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUploaderForeignKeyToDiaryAttachedFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diary_attached_files', function($table){
            $table->dropColumn('uploader');
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
            $table->string('uploader', 100);
        });
    }
}
