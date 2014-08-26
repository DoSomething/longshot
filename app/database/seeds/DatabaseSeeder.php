<?php

class DatabaseSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Eloquent::unguard();

    // Disable foreign key check for this connection before running seeders.
    // @TODO: There may be a more official way to do this. Need to look into it.
    // Not for use on Production site!
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    $this->call('RolesTableSeeder');
    $this->command->info('Roles table seeded!');

    $this->call('UsersTableSeeder');
    $this->command->info('Users table seeded!');

    $this->call('AppearanceTableSeeder');
    $this->command->info('Appearance table seeded!');

    $this->call('ScholarshipTableSeeder');
    $this->command->info('Scholarship table seeded!');

    // Explicitly undo disabling foreign key checks.
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }

}
