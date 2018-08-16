<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the Users table.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'first_name' => 'Longshot',
        'last_name'  => 'Admin',
        'email'      => 'admin@dosomething.org',
        'password'   => 'secret',
      ])->assignRole(1);
    }
}
