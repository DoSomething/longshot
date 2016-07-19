<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class OfficialRulesSettingsTableSeeder extends Seeder
{
    public function run()
    {
        Setting::insert([
      'category'    => 'general',
      'key'         => 'official_rules_url',
      'value'       => null,
      'type'        => 'text',
      'description' => 'Enter URL to the Official Rules PDF document.',
    ]);
    }
}
