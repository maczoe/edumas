<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('date');
            $table->boolean('attended')->default(False);
            $table->timestamp('arrival_time')->nullable();
            $table->timestamp('departure_time')->nullable();
            $table->timestamps();
            
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attendances');
    }
}
