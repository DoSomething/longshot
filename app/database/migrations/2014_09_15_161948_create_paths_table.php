<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePathsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('paths', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('page_id')->index();
      $table->string('url')->index();
      $table->string('link_title');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('paths');
  }

}
