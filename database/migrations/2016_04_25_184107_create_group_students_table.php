<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupStudentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_student', function (Blueprint $table) {
            $table->bigInteger('group_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->primary(['group_id', 'student_id']);
            $table->timestamps();

            //Foreign Keys
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('group_student');
    }

}
