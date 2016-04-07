<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScholarshipsTable extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('scholarships', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title')->index();
      $table->longtext('description');
      $table->integer('amount_scholarship');
      $table->date('application_start')->index();
      $table->date('application_end')->index();
      $table->date('winners_announced');
      $table->integer('age_min');
      $table->integer('age_max');
      $table->integer('num_recommendations_min');
      $table->integer('num_recommendations_max');
      $table->float('gpa_min');
      $table->string('label_app_accomplishments');
      $table->string('label_app_activities');
      $table->string('label_app_essay1');
      $table->string('label_app_essay2');
      $table->string('label_rec_rank_character');
      $table->string('label_rec_rank_additional');
      $table->string('label_rec_essay1');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('scholarships');
  }
}
