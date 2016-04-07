<?php

use Illuminate\Database\Migrations\Migration;

class UpdateLabelFields extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      DB::statement('ALTER TABLE `scholarships` MODIFY COLUMN `label_app_essay1` TEXT');
      DB::statement('ALTER TABLE `scholarships` MODIFY COLUMN `label_app_essay2` TEXT');
  }
}
