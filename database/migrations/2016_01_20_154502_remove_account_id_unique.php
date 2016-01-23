<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAccountIdUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diary', function ($table){
            
            $table->dropForeign('diary_account_id_foreign');
            $table->dropIndex('diary_account_id_foreign');

        });

        Schema::table('account', function ($table) {
            
            $table->dropForeign('account_parent_id_foreign');
            $table->dropColumn('parent_id');
            $table->dropColumn('id');
           
        });
        Schema::table('account', function ($table){

            $table->integer('parent_id')->unsigned();
            $table->integer('id')->unsigned();
            $table->primary(['id', 'parent_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account', function ($table){

            $table->dropPrimary(['account_id_primary', 'account_parent_id_primary']);
            $table->dropColumn('id');
            $table->dropColumn('parent_id');

        });
        Schema::table('account', function ($table) {

            $table->integer('id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->primary(['id', 'parent_id']);
            $table->foreign('parent_id')->references('id')->on('account');

        });

        // Schema::table('diary', function ($table){

        //     $table->foreign('account_id')->references('id')->on('account');

        // });

    }
}
