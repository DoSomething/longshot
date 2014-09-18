<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNominationsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nominations', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('rec_email');
      $table->string('rec_name');
      $table->string('nom_email')->index();
      $table->string('nom_name');
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
    Schema::drop('nominations');
  }

}
