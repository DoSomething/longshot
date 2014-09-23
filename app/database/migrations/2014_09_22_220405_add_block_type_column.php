<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlockTypeColumn extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('blocks', function(Blueprint $table)
    {
      $table->string('block_type')->after('page_id');
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
      $table->dropColumn('block_type');
    });
  }

}
