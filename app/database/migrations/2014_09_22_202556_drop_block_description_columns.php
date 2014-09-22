<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropBlockDescriptionColumns extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('blocks', function(Blueprint $table)
    {
      $table->dropColumn(['block_description', 'block_description_html']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('blocks', function(Blueprint $table)
    {
      $table->longtext('block_description');
      $table->longtext('block_description_html');
    });
  }

}
