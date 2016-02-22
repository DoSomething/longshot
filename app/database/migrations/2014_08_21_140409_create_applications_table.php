<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationsTable extends Migration
{
    /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
     Schema::create('applications', function (Blueprint $table) {
   $table->increments('id');
   $table->integer('user_id')->index();
   $table->integer('scholarship_id')->index();
   $table->longtext('accomplishments');
   $table->longtext('activities');
   $table->longtext('essay1');
   $table->longtext('essay2');
   $table->string('test_type');
   $table->integer('test_score')->nullable;
   $table->float('gpa')->nullable;
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
     Schema::drop('applications');
 }
}
