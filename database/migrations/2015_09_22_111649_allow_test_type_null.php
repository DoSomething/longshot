<?php

use Illuminate\Database\Migrations\Migration;

class AllowTestTypeNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `applications` MODIFY `test_type` VARCHAR(100) NULL;');
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
