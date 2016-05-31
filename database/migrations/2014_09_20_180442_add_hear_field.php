<?php

use Illuminate\Database\Migrations\Migration;

class AddHearField extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('applications', function ($table) {
          $table->string('hear_about')->nullable()->after('essay2');
          $table->string('link')->nullable()->after('hear_about');
      });
      Schema::table('scholarships', function ($table) {
          $table->text('hear_about_options')->after('label_rec_essay1');
      });
  }

    public function down()
    {
        Schema::table('applications', function ($table) {
            $table->dropColumn('hear_about');
            $table->dropColumn('link');
        });
        Schema::table('scholarships', function ($table) {
            $table->dropColumn('hear_about_options');
        });
    }
}
