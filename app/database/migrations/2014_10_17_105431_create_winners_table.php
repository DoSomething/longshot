<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWinnersTable extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('winners', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unique;
      $table->integer('scholarship_id');
      $table->string('description');
      $table->string('college');
      $table->string('photo');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('winners');
  }
}
