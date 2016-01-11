<?php

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
        'first_name' => 'Andrea',
        'last_name'  => 'Gaither',
        'email'      => 'agaither@dosomething.org',
        'password'   => '123456',
      ])->assignRole(1);

      User::create([
        'first_name' => 'Barry',
        'last_name'  => 'Clark',
        'email'      => 'bclark@dosomething.org',
        'password'   => '123456',
      ])->assignRole(1);

      User::create([
        'first_name' => 'Greg',
        'last_name'  => 'Thomas',
        'email'      => 'gthomas@tmiagency.org',
        'password'   => '123456',
      ])->assignRole(1);

      User::create([
        'first_name' => 'Elizabeth',
        'last_name'  => 'Divine',
        'email'      => 'edivine@tmiagency.org',
        'password'   => '123456',
      ])->assignRole(1);
  }
}
