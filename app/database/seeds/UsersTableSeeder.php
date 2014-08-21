<?php

class UsersTableSeeder extends Seeder {

  /**
   * Seed the Users table.
   *
   * @return void
   */
  public function run()
  {
     User::truncate();

     User::create([
        'first_name' => 'Diego',
        'last_name'  => 'Lorenzo',
        'email'      => 'dlorenzo@dosomething.org',
        'password'   => '1234',
      ])->assignRole(1);

     User::create([
        'first_name' => 'Andrea',
        'last_name'  => 'Gaither',
        'email'      => 'agaither@dosomething.org',
        'password'   => '1234',
      ])->assignRole(1);



     // The following users are dummy users for testing.
     // @TODO: Remove these and use Faker package for adding fake
     // dummy users.
     User::create([
        'first_name' => 'Braumhilda',
        'last_name'  => 'Snosages',
        'email'      => 'bs@example.com',
        'password'   => '1234',
      ])->assignRole(2);

     User::create([
        'first_name' => 'Pepper',
        'last_name'  => 'Pots',
        'email'      => 'pp@example.com',
        'password'   => '1234',
      ])->assignRole(2);

     User::create([
        'first_name' => 'Reed',
        'last_name'  => 'Richards',
        'email'      => 'rr@example.com',
        'password'   => '1234',
      ])->assignRole(2);

     User::create([
        'first_name' => 'Susan',
        'last_name'  => 'Storm',
        'email'      => 'ss@example.com',
        'password'   => '1234',
      ])->assignRole(2);

     User::create([
        'first_name' => 'Matt',
        'last_name'  => 'Murdock',
        'email'      => 'mm@example.com',
        'password'   => '1234',
      ])->assignRole(2);

     User::create([
        'first_name' => 'James',
        'last_name'  => 'Howlett',
        'email'      => 'jh@example.com',
        'password'   => '1234',
      ])->assignRole(2);
  }

}
