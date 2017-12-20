<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashflows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_number', 50)->nullable();
            $table->string('customer', 100)->nullable();
            $table->text('detail');
            $table->timestamp('date_time')->useCurrent = true;
            $table->decimal('opening_balance', 12, 2);
            $table->decimal('credit', 12, 2)->nullable();
            $table->decimal('debit', 12, 2)->nullable();
            $table->decimal('final_balance', 12, 2);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('establishment_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('cashflows');
    }
}
