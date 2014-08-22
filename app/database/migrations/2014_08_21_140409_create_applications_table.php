<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationsTable extends Migration {

 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('applications', function(Blueprint $table)
  {
   $table->increments('id');
   $table->integer('user_id');
   $table->integer("app_id");
   $table->longtext('accomplishments');
   $table->longtext('activities');
   $table->longtext('essay1');
   $table->longtext('essay2');
   $table->string('test_type');
   $table->integer('test_score');
   $table->float('gpa');
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
