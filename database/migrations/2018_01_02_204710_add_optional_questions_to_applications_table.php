<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptionalQuestionsToApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->longtext('extra_question_1')->after('essay2')->nullable;
            $table->longtext('extra_question_2')->after('extra_question_1')->nullable;
            $table->longtext('extra_question_3')->after('extra_question_2')->nullable;
            $table->longtext('extra_question_4')->after('extra_question_3')->nullable;
            $table->longtext('extra_question_5')->after('extra_question_4')->nullable;
        });
    }

    /**
     * Reverse the migrations.     
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['extra_question_1', 'extra_question_2', 'extra_question_3', 'extra_question_4', 'extra_question_5']);
        });
    }
}
