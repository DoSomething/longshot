<?php

use Illuminate\Database\Migrations\Migration;

class UpdateZipcodeFromIntToVarchar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE profiles MODIFY zip VARCHAR(255);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Irreversible migration, sorry mate
    }
}
