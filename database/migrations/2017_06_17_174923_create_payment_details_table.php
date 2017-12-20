<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payment_id')->unsigned();
            $table->decimal('quantity', 12,2)->unsigned()->nullable();
            $table->string('detail', 200);
            $table->decimal('unit_price', 12,4)->unsigned();
            $table->decimal('amount', 12,4)->unsigned();
            $table->timestamps();
            
            $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payment_details');
    }
}
