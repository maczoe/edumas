<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subject_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('group_id')->unsigned();
            $table->string('start_time');
            $table->string('end_time');
            $table->timestamps();
            
            //Foreign Keys 
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('classes');
    }
}
