<?php

use Illuminate\Database\Migrations\Migration;

class UpdateProfileAddIndexToUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE INDEX user_id ON profiles (user_id)');
    }

    public function down()
    {
        DB::statement('ALTER TABLE profiles DROP INDEX user_id');
    }
}
