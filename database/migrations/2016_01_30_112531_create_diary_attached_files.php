<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryAttachedFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_attached_files', function($table){

            $table->increments('id');
            
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('event');

            $table->integer('trade_id')->unsigned();
            $table->foreign('trade_id')->references('id')->on('trade');
            
            $table->string('file_path');
            $table->string('file_name');
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
        Schema::drop('diary_attached_files');
    }
}
