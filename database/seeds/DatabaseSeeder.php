<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('AppSubmitHelpTextTableSeeder');
        $this->call('EmailsTableSeeder');
        $this->call('FaviconSettingsTableSeeder');
        $this->call('HelperTextTableSeeder');
        $this->call('InteractionColorSettingsTableSeeder');
        $this->call('NominateSettingsTableSeeder');
        $this->call('OfficialRulesSettingsTableSeeder');
        $this->call('OpenGraphDataSettingsTableSeeder');
        $this->call('PagesTableSeeder');
        $this->call('PreviousWinnersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('ScholarshipsTableSeeder');
        $this->call('SettingsTableSeeder');
        $this->call('SiteInfoSettingsTableSeeder');
        $this->call('StatusPageHelpTextTableSeeder');
        $this->call('TrackingCodeSettingTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('WaterGateSeeder');
    }
}
