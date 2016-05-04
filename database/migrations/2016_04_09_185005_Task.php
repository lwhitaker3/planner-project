<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Task extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tasks', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id');
        $table->integer('category_id');
        $table->string('title');
        $table->string('text');
        $table->integer('order');
        $table->timestamp('due_date');
        $table->boolean('completed');
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
