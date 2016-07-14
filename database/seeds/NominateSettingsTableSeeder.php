<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class NominateSettingsTableSeeder extends Seeder
{
    public function run()
    {
        Setting::insert([
      'category'    => 'general',
      'key'         => 'nominate_text',
      'value'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, soluta.',
      'type'        => 'textarea',
      'description' => 'Message text for Nominate form section.',
    ]);

        Setting::insert([
      'category'    => 'general',
      'key'         => 'nominate_image',
      'value'       => '/dist/images/nominate-image-placeholder.jpg',
      'type'        => 'image',
      'description' => 'Background image for the Nominate form section (PNG or JPEG).',
    ]);
    }
}
