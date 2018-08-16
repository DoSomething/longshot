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

        User::create([
        'first_name' => 'Katie',
        'last_name'  => 'Crane',
        'email'      => 'kcrane@dosomething.org',
        'password'   => 'secret',
      ])->assignRole(1);

        User::create([
        'first_name' => 'Jen',
        'last_name'  => 'Ng',
        'email'      => 'jng@dosomething.org',
        'password'   => 'secret',
      ])->assignRole(1);

        User::create([
        'first_name' => 'Mai',
        'last_name'  => 'Irie',
        'email'      => 'mirie@dosomething.org',
        'password'   => 'secret',
      ])->assignRole(1);

        User::create([
        'first_name' => 'Dave',
        'last_name'  => 'Furnes',
        'email'      => 'dfurnes@dosomething.org',
        'password'   => 'secret',
      ])->assignRole(1);

        User::create([
        'first_name' => 'Chloe',
        'last_name'  => 'Lee',
        'email'      => 'clee@dosomething.org',
        'password'   => 'secret',
      ])->assignRole(1);
    }
}
