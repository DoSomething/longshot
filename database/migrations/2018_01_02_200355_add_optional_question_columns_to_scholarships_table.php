<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptionalQuestionColumnsToScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->string('label_extra_question_1')->after('label_app_essay2')->nullable;
            $table->string('label_extra_question_2')->after('label_extra_question_1')->nullable;
            $table->string('label_extra_question_3')->after('label_extra_question_2')->nullable;
            $table->string('label_extra_question_4')->after('label_extra_question_3')->nullable;
            $table->string('label_extra_question_5')->after('label_extra_question_4')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->dropColumn(['label_extra_question_1', 'label_extra_question_2', 'label_extra_question_3', 'label_extra_question_4', 'label_extra_question_5']);
        });
    }
}
