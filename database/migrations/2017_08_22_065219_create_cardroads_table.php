<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardroadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardroads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('card_id');
            $table->string('parent', 11);
            $table->string('node', 11);
            $table->string('type', 11);
            $table->string('color', 20);
            $table->integer('points');
            $table->integer('small');
            $table->integer('medium');
            $table->integer('large');
            $table->integer('level');
            $table->iterger('chapter_id');
            $table->iterger('end');
            $table->integer('updated_by');
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
        Schema::drop('cardroads');
    }
}
