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
        $table->string('hear_about')->nullable()->after('essay2');
        $table->string('link')->nullable()->after('hear_about');
    });
    Schema::table('scholarships', function($table)
    {
        $table->text('hear_about_options')->after('label_rec_essay1');
    });
  }

}
