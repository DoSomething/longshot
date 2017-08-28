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
        'first_name' => 'Diego',
        'last_name'  => 'Lorenzo',
        'email'      => 'dlorenzo@dosomething.org',
        'password'   => '123456',
      ])->assignRole(1);

      User::create([
        'first_name' => 'Katie',
        'last_name'  => 'Crane',
        'email'      => 'kcrane@dosomething.org',
        'password'   => '123456',
      ])->assignRole(1);

      User::create([
        'first_name' => 'Jen',
        'last_name'  => 'Ng',
        'email'      => 'jng@dosomething.org',
        'password'   => '123456',
      ])->assignRole(1);

      User::create([
        'first_name' => 'Mai',
        'last_name'  => 'Irie',
        'email'      => 'mirie@dosomething.org',
        'password'   => '123456',
      ])->assignRole(1);

      User::create([
        'first_name' => 'Dave',
        'last_name'  => 'Furnes',
        'email'      => 'dfurnes@dosomething.org',
        'password'   => '123456',
      ])->assignRole(1);
  }
}
