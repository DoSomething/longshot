<?php

use Illuminate\Database\Migrations\Migration;

class RemoveAppRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // if the applicant role is in the db, remove it and all corresponding role_user records
        $role = DB::table('roles')->where('name', 'applicant')->first();
        if (! is_null($role)) {
            DB::table('role_user')->where('role_id', 2)->delete();
            DB::table('roles')->where('name', 'applicant')->delete();
        }
    }

    public function down()
    {
        // Reversing this wouldn't make any sense and might be impossible
    }
}
