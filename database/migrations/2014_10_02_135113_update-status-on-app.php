<?php

use Illuminate\Database\Migrations\Migration;

class UpdateStatusOnApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function ($table) {
            $table->dropIndex('applications_complete_index');
            $table->renameColumn('complete', 'submitted');
        });
        Schema::table('applications', function ($table) {
            $table->tinyInteger('completed')->after('submitted')->nullable();
            $table->index('completed');
            $table->index('submitted');
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
            $table->renameColumn('submitted', 'complete');
        });
        Schema::table('applications', function ($table) {
            $table->dropColumn('completed');
        });
    }
}
