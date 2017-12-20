<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serie');
            $table->bigInteger('establishment_id')->unsigned();
            $table->bigInteger('current');
            $table->bigInteger('min');
            $table->bigInteger('max');
            $table->boolean('enabled');
            $table->string('type', 20);
            $table->timestamps();
            
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
        Schema::drop('series');
    }
}
