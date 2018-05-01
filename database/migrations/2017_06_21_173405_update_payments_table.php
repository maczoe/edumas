<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->bigInteger('serie_id')->after('id')->unsigned();
            $table->string('customer', 200)->after('user_id')->nullable();
            $table->string('status',10)->after('payment')->default('ok');
            $table->text('comment')->after('status')->nullable();
            $table->bigInteger('payment_plan_id')->after('comment')->unsigned()->nullable();
            $table->date('payment_date')->after('date_time')->nullable();
            
        //Foreign Keys
            $table->foreign('serie_id')->references('id')->on('series');
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
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['serie_id']);
            $table->dropColumn('serie_id');
            $table->dropColumn('customer');
            $table->dropColumn('status');
            $table->dropColumn('comment');
            $table->dropForeign(['payment_plan_id']);
            $table->dropColumn('payment_plan_id');
            $table->dropColumn('payment_date');
        });
    }
}
