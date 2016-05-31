<?php

use Illuminate\Database\Migrations\Migration;

class AddOptionalRecQuestion extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('scholarships', function ($table) {
          $table->boolean('display_optional_rec_question')->after('label_rec_essay1');
          $table->text('label_rec_optional_question')->after('display_optional_rec_question')->nullable();
      });
      Schema::table('recommendations', function ($table) {
          $table->text('optional_question')->after('essay1')->nullable();
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('scholarships', function ($table) {
          $table->dropColumn('display_optional_rec_question');
          $table->dropColumn('label_rec_optional_question');
      });

      Schema::table('recommendations', function ($table) {
          $table->dropColumn('optional_question');
      });
  }
}
