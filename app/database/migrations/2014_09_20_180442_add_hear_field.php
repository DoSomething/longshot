<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddHearField extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('applications', function($table)
    {
        $table->string('hear_about')->nullable();
        $table->string('link')->nullable();
    });
  }

}
