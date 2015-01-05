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
    $this->call('StatusPageHelpTextTableSeeder');
    $this->command->info('Help text seeded into Settings table!');

    $this->call('SiteInfoSettingsTableSeeder');
    $this->command->info('Site info seeded into Settings table!');

    $this->call('OpenGraphDataSettingsTableSeeder');
    $this->command->info('Open graph data seeded into Settings table!');

    $this->call('FaviconSettingsTableSeeder');
    $this->command->info('Favicon seeded into Settings table!');

    $this->call('OfficialRulesSettingsTableSeeder');
    $this->command->info('Official Rules URL seeded into Settings table!');

    $this->call('InteractionColorSettingsTableSeeder');
    $this->command->info('Interaction colors seeded into Settings table!');

    // Explicitly undo disabling foreign key checks.
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }

}
