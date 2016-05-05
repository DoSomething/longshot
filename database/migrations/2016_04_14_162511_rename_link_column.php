<?php

use Illuminate\Database\Migrations\Migration;

class RenameLinkColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function ($table) {
            $table->renameColumn('link', 'upload');
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
            $table->renameColumn('upload', 'link');
        });
    }
}
