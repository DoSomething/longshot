<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SiteInfoSettingsTableSeeder extends Seeder
{
    public function run()
    {
        Setting::insert([
      'category'    => 'general',
      'key'         => 'site_name',
      'value'       => 'Scholarship Application',
      'type'        => 'text',
      'description' => 'Enter name for this website.',
    ]);

        Setting::insert([
      'category'    => 'general',
      'key'         => 'site_url',
      'value'       => 'http://tmiagency.org',
      'type'        => 'text',
      'description' => 'Enter URL for this website.',
    ]);
    }
}
