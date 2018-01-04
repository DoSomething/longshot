<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('relationship');
            $table->string('phone');
            $table->string('email')->unique;
            $table->string('rank_character');
            $table->string('rank_additional');
            $table->longtext('essay1');
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
        Schema::drop('recommendations');
    }
}
