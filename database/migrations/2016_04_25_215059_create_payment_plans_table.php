<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('establishment_id')->unsigned();
            $table->bigInteger('grade_id')->unsigned()->nullable();
            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->text('comment')->nullable();
            $table->integer('pay_day')->unsigned();
            //monthly weekly quarterly biannual annual
            $table->string('period', 20)->default('monthly');
            $table->decimal('price', 12,2)->unsigned();
            $table->decimal('fault', 12,2)->unsigned()->default(0);
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('establishment_id')->references('id')->on('establishments');
            $table->foreign('grade_id')->references('id')->on('grades');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payment_plans');
    }
}
