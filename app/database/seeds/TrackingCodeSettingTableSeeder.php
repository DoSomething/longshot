<?php

class TrackingCodeSettingTableSeeder extends Seeder {

  public function run()
  {
    Setting::insert([
      'category'    => 'general',
      'key'         => 'tracking_code_id',
      'value'       => NULL,
      'type'        => 'text',
      'description' => 'Please enter your analytics tracking code id.'
    ]);
  }

}
