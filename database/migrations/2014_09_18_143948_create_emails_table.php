<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailsTable extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('emails', function (Blueprint $table) {
      $table->increments('id');
      $table->string('key')->index();
      $table->string('recipient')->index();
      $table->string('subject');
      $table->longText('body');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('emails');
  }
}
