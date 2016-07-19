<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class TrackingCodeSettingTableSeeder extends Seeder
{
    public function run()
    {
        Setting::insert([
      'category'    => 'general',
      'key'         => 'tracking_code_id',
      'value'       => null,
      'type'        => 'text',
      'description' => 'Please enter your analytics tracking code id.',
    ]);
    }
}
