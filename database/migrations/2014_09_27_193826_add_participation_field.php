<?php

use Illuminate\Database\Migrations\Migration;

class AddParticipationField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function ($table) {
            $table->string('participation')->nullable()->after('activities');
        });
        Schema::table('scholarships', function ($table) {
            $table->text('label_app_participation')->after('label_app_activities');
        });
    }

    public function down()
    {
        Schema::table('applications', function ($table) {
            $table->dropColumn('participation');
        });
        Schema::table('scholarships', function ($table) {
            $table->dropColumn('label_app_participation');
        });
    }
}
