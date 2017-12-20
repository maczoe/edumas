<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('document_number')->unsigned();
            $table->string('document_series', 5);
            $table->timestamp('date_time');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->decimal('payment', 12, 2);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('payments');
    }
}
