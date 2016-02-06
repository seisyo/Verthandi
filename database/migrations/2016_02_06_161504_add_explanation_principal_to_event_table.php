<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExplanationPrincipalToEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event', function($table) {
            $table->string('principal', 20);
            $table->mediumText('explanation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event', function($table) {
            $table->dropColumn('principal');
            $table->dropColumn('explanation');
        });
    }
}
