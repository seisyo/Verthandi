<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('account', function($table){

            $table->integer('id')->unique();
            $table->primary('id');
            $table->string('name', 50);
            $table->enum('group',  ['資產', '負債', '餘絀', '收益', '費損']);
            $table->enum('direction', ['借', '貸']);
            $table->string('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('account');
    }
}
