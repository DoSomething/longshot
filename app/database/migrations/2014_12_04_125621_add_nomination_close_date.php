<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNominationCloseDate extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('scholarships', function($table)
    {
        $table->date('nomination_end')->after('application_end');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('scholarships', function($table)
    {
      $table->dropColumn('nomination_end');
    });
  }

}
