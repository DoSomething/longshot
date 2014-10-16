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

    $this->call('SettingsTableSeeder');
    $this->call('NominateSettingsTableSeeder');
    $this->call('TrackingCodeSettingTableSeeder');
    $this->command->info('Settings table seeded!');

    $this->call('PagesTableSeeder');
    $this->command->info('Pages table seeded!');

    $this->call('ScholarshipsTableSeeder');
    $this->command->info('Scholarship table seeded!');

    $this->call('EmailsTableSeeder');
    $this->command->info('Emails table seeded!');

    $this->call('AppSubmitHelpTextTableSeeder');
    $this->call('HelperTextTableSeeder');
    $this->call('StatusPageHelpTextSeeder');
    $this->command->info('Help text table seeded!');


    // Explicitly undo disabling foreign key checks.
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }

}
