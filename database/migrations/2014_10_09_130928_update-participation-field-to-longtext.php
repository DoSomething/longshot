<?php

use Illuminate\Database\Migrations\Migration;

class UpdateParticipationFieldToLongtext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `applications` MODIFY COLUMN `participation` LONGTEXT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE `applications` MODIFY COLUMN `participation` VARCHAR(255)');
    }
}
