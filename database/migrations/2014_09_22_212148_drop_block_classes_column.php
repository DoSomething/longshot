<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropBlockClassesColumn extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('blocks', function (Blueprint $table) {
          $table->dropColumn('block_classes');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('blocks', function (Blueprint $table) {
          $table->text('block_classes')->after('block_body_html');
      });
  }
}
