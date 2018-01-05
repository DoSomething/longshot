<?php

use Illuminate\Database\Migrations\Migration;

class AddImageUploadsColumnToScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scholarships', function ($table) {
            $table->boolean('image_uploads')->after('label_app_essay2')->nullable()->default(0);
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
            $table->dropColumn('image_uploads');
        });
    }
}
