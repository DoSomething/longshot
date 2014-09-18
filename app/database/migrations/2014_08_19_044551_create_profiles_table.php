<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('profiles', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id');
      $table->date('birthdate')->nullable();
      $table->string('phone')->nullable();
      $table->string('address_street')->nullable();
      $table->string('address_premise')->nullable();
      $table->string('city')->nullable();
      $table->string('state')->nullable();
      $table->integer('zip')->nullable();
      $table->string('gender')->nullable();
      $table->string('school')->nullable();
      $table->integer('grade')->nullable();
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
    Schema::drop('profiles');
  }

}
