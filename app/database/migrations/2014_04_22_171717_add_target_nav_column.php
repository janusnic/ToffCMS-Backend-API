<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTargetNavColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'navigation',
            function(Blueprint $table) {
                $table->enum('target', array('_blank'))->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'navigation',
            function (Blueprint $table) {
                $table->dropColumn('target');
            }
        );
    }
}
