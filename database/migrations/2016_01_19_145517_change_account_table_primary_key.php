<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAccountTablePrimaryKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account', function ($table) {
            
            $table->dropForeign('account_parent_id_foreign');
            $table->dropPrimary('account_id_primary');
            $table->primary(['id', 'parent_id']);
            $table->foreign('parent_id')->references('id')->on('account');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account', function ($table) {
            
            $table->dropForeign('account_parent_id_foreign');
            $table->dropPrimary(['account_id_primary', 'account_parent_id_primary']);
            $table->primary('id');
            $table->foreign('parent_id')->references('id')->on('account');

        });
    }
}
