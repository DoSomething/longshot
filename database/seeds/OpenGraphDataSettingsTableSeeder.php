<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class OpenGraphDataSettingsTableSeeder extends Seeder
{
    public function run()
    {
        Setting::insert([
      'category'    => 'meta_data',
      'key'         => 'open_graph_data_title',
      'value'       => null,
      'type'        => 'text',
      'description' => 'Enter title text to share on social media.',
    ]);

        Setting::insert([
      'category'    => 'meta_data',
      'key'         => 'open_graph_data_description',
      'value'       => null,
      'type'        => 'textarea',
      'description' => 'Enter a one or two sentence description to share on social media.',
    ]);

        Setting::insert([
      'category'    => 'meta_data',
      'key'         => 'open_graph_data_type',
      'value'       => 'website',
      'type'        => 'text',
      'description' => 'Enter the type of object (e.g. video, application, website, etc).',
    ]);

        Setting::insert([
      'category'    => 'meta_data',
      'key'         => 'open_graph_data_url',
      'value'       => null,
      'type'        => 'text',
      'description' => 'Enter site URL to share on social media.',
    ]);

        Setting::insert([
      'category'    => 'meta_data',
      'key'         => 'open_graph_data_image',
      'value'       => null,
      'type'        => 'image',
      'description' => 'Upload a square thumbnail image to share on social media.',
    ]);
    }
}
