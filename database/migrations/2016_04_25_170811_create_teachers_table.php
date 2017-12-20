<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('id_number', 50)->nullable()->unique();
            $table->string('phone_number', 20)->nullable();
            $table->string('cellphone_number', 20)->nullable();
            $table->text('address')->nullable();
            $table->text('comment')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::table('teachers', function(Blueprint $table) {
            //Foreign keys
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
        Schema::drop('teachers');
    }
}
