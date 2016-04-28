<?php

use Illuminate\Database\Migrations\Migration;

class AddEmailFromAddressToScholarship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scholarships', function ($table) {
            $table->string('email_from_address')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scholarships', function ($table) {
            $table->dropColumn('email_from_address');
        });
    }
}
