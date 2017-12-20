<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('grade');
            $table->bigInteger('grade_id')->after('id')->unsigned();
            
            $table->foreign('grade_id')->references('id')->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign(['grade_id']);
            $table->string('grade', 20);
            $table->dropColumn('grade_id');
        });
    }
}
