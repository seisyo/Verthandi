<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary', function($table){

            $table->increments('id');
            $table->boolean('direction');
            $table->integer('amount')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->integer('trade_id')->unsigned();
            $table->foreign('trade_id')->references('id')->on('trade');
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('account');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('diary');
    }
}
