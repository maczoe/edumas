<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_plans', function (Blueprint $table) {
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('payment_plan_id')->unsigned();
            $table->primary(['student_id', 'payment_plan_id']);
            $table->timestamps();

            //Foreign Keys
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('payment_plan_id')->references('id')->on('payment_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students_plans');
    }
}
