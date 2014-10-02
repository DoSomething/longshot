<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStatusOnApp extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('applications', function($table)
    {
      $table->renameColumn('complete', 'submitted');
    });
    Schema::table('applications', function($table)
    {
        $table->tinyInteger('complete')->after('submitted')->index()->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('applications', function($table)
    {
      $table->renameColumn('complete', 'submitted');
    });
    Schema::table('applications', function($table)
    {
        $table->dropColumn('complete');
    });
  }

}
