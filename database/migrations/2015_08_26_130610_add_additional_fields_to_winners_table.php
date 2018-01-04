<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('winners', function (Blueprint $table) {
            $table->string('first_name')->after('scholarship_id');
            $table->string('last_name')->after('first_name');
            $table->string('city')->after('last_name');
            $table->string('state')->after('city');
            $table->float('gpa')->after('state');
            $table->string('participation')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('winners', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('gpa');
            $table->dropColumn('participation');
        });
    }
}
