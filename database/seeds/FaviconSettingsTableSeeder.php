<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class FaviconSettingsTableSeeder extends Seeder
{
    public function run()
    {
        Setting::insert([
      'category'    => 'meta_data',
      'key'         => 'favicon',
      'value'       => null,
      'type'        => 'image',
      'description' => 'Upload a custom favicon (must be of type ".ico").',
    ]);
    }
}
