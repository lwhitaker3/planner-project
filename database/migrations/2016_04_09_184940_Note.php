<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Note extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('notes', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id');
        $table->integer('category_id');
        $table->string('title');
        $table->string('text');
        $table->integer('height');
        $table->integer('order');
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
        //
    }
}
