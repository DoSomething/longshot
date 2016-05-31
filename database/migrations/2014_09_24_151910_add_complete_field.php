<?php

use Illuminate\Database\Migrations\Migration;

class AddCompleteField extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('applications', function ($table) {
          $table->tinyInteger('complete')->index()->nullable()->after('gpa');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('applications', function ($table) {
          $table->dropColumn('complete');
      });
  }
}
