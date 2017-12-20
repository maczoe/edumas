<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->bigInteger('establishment_id')->after('group_id')->unsigned();
            
            $table->foreign('establishment_id')->references('id')->on('establishments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['establishment_id']);
            $table->dropColumn('establishment_id');
        });
    }
}
