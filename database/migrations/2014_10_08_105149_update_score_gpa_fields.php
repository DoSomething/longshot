<?php

use Illuminate\Database\Migrations\Migration;

class UpdateScoreGpaFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `applications` MODIFY `test_score` INTEGER unsigned NULL;');
        DB::statement('ALTER TABLE `applications` MODIFY `gpa` FLOAT NULL;');
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
