<?php

class SiteInfoSettingsTableSeeder extends Seeder {

  public function run()
  {
    Setting::insert([
      'category'    => 'general',
      'key'         => 'site_name',
      'value'       => '',
      'type'        => 'text',
      'description' => 'Enter name for this website.'
    ]);

    Setting::insert([
      'category'    => 'general',
      'key'         => 'site_url',
      'value'       => '',
      'type'        => 'text',
      'description' => 'Enter URL for this website.'
    ]);
  }

}
