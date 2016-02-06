<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LetHandlerNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade', function($table) {
            $table->string('handler', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade', function($table) {
            $trade->dropColumn('handler');
        });
        Schema::table('trade', function($trade) {
            $table->string('handler', 20);
        });
    }
}
