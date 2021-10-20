<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userteams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('da');
            $table->integer('da_2');
            $table->integer('da_3');
            $table->integer('vo');
            $table->integer('vo_2');
            $table->integer('vo_3');
            $table->integer('pf');
            $table->integer('pf_2');
            $table->integer('pf_3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('userteams');
    }
}
