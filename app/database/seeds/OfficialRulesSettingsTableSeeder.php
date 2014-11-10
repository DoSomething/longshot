<?php

class OfficialRulesSettingsTableSeeder extends Seeder {

  public function run()
  {
    Setting::insert([
      'category'    => 'general',
      'key'         => 'official_rules_url',
      'value'       => NULL,
      'type'        => 'text',
      'description' => 'Enter URL to the Official Rules PDF document.'
    ]);
  }

}
