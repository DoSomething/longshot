<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function(Blueprint $table)
    {

      $table->increments('id');
      $table->string('email')->unique;
      $table->string('password');
      $table->string('role');
      $table->string('first_name');
      $table->string('last_name');
      $table->date('birthdate');
      $table->string('phone');
      $table->string('address_street');
      $table->string('address_premise')->nullable();
      $table->string('city');
      $table->string('state');
      $table->integer('zip');
      $table->string('gender')->nullable();
      $table->string('race')->nullable();
      $table->string('school')->nullable();
      $table->integer('grade')->nullable();
      $table->string('remember_token', 100)->nullable();
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

    Schema::drop('users');

  }

}
