<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('settings', function (Blueprint $table) {
      $table->increments('id');
      $table->string('category')->index();
      $table->string('key')->unique();
      $table->text('value')->nullable();
      $table->string('type')->nullable();
      $table->text('description')->nullable();
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
      Schema::drop('settings');
  }
}
