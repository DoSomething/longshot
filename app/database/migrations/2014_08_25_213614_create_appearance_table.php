<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppearanceTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('appearance', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('company_name')->nullable();
      $table->string('company_url')->nullable();
      $table->string('primary_color')->nullable();
      $table->string('primary_color_contrast')->nullable();
      $table->string('secondary_color')->nullable();
      $table->string('secondary_color_contrast')->nullable();
      $table->string('cap_color')->nullable();
      $table->string('cap_color_contrast')->nullable();
      $table->string('header_logo')->nullable();
      $table->string('footer_logo')->nullable();
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
    Schema::drop('appearance');
  }

}
