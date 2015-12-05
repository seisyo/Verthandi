<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table){

            $table->increments('id');
            $table->string('username', 100)->unique('username');
            $table->string('password', 100);
            $table->string('nickname', 100);
            $table->enum('permission', [1, 2, 3, 4]);
            $table->enum('status', ['unverified','enable', 'disable']);
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
        Schema::drop('users');
    }
}
