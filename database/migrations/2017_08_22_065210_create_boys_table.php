<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('japanese_name');
            $table->string('english_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('unit_id');
            $table->integer('classroom_id');
            $table->integer('club_id');
            $table->date('birthday');
            $table->string('blood_type', 5);
            $table->integer('height');
            $table->integer('weight');
            $table->string('color', 15);
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
        Schema::drop('boys');
    }
}
