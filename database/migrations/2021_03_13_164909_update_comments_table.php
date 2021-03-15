<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('comments', function (Blueprint $table) {
            $table->string('model',10)->after('comment')->nullable();
            $table->bigInteger('model_id')->nullable()->after('model');
            $table->bigInteger('user_id')->nullable()->after('model_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('model');
            $table->dropColumn('model_id');
            $table->dropColumn('user_id');
        });
    }
}
