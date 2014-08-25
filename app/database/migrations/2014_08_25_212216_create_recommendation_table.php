<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecommendationTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('recommendation', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('application_id');
      $table->string('first_name');
      $table->string('last_name');
      $table->string('phone')
      $table->string('rec_email')->unique;
      $table->string('rank_character');
      $table->string('rank_addiational');
      $table->longtext('essay1');
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
    Schema::drop('recommendation');
  }

}
