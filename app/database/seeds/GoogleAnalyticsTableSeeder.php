<?php

class GoogleAnalyticsTableSeeder extends Seeder {

  public function run()
  {
    Setting::insert([
      'category'    => 'general',
      'key'         => 'google_analytics_account',
      'value'       => NULL,
      'type'        => 'text',
      'description' => 'Please enter your Google Analytics Code as: UA-XXXXXXXX-X'
    ]);
  }

}
