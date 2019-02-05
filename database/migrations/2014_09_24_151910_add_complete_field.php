<?php

use Illuminate\Database\Migrations\Migration;

class AddCompleteField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function ($table) {
            // We had to remove `->nullable()` from this column in this migration in order to allow future alterations to this column. It would allow this to be set initially but when making futer changes gives error of "Invalid default value."
            $table->tinyInteger('complete')->index()->after('gpa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function ($table) {
            $table->dropColumn('complete');
        });
    }
}
