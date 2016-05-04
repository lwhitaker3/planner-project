<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      DB::statement("ALTER TABLE `tasks` MODIFY COLUMN `due_date` TIMESTAMP NULL;"); 
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
