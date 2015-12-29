<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade', function($table){

            $table->increments('id');
            $table->string('name', 100);
            $table->string('handler', 20);
            $table->string('comment')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('event');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trade');
    }
}
