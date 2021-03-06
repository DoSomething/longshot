<?php

use Illuminate\Database\Migrations\Migration;

class UpdateRankFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `recommendations` MODIFY COLUMN `rank_character` INT');
        DB::statement('ALTER TABLE `recommendations` MODIFY COLUMN `rank_additional` INT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE `recommendations` MODIFY COLUMN `rank_character` VARCHAR(255)');
        DB::statement('ALTER TABLE `recommendations` MODIFY COLUMN `rank_additional` VARCHAR(255)');
    }
}
