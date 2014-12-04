<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateZipcodeFromIntToVarchar extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement("ALTER TABLE profiles MODIFY zip VARCHAR(255);");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    throw new Exception('Irreversible migration, sorry mate.');
  }

}
