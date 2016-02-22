<?php

use Illuminate\Database\Migrations\Migration;

class UpdateWinnerDescField extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      DB::statement('ALTER TABLE `winners` MODIFY COLUMN `description` TEXT');
  }
}
