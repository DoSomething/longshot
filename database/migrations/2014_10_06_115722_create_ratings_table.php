<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('ratings', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('application_id')->index();
          $table->enum('rating', ['yes', 'no', 'maybe']);
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('ratings');
  }
}
