<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Seed the Settings table.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        Setting::create([
          'category'  => 'general',
          'key'       => 'company_name',
          'value'     => 'TMI',
          'type'      => 'text',
        ]);

        Setting::create([
          'category'  => 'general',
          'key'       => 'company_url',
          'value'     => 'http://tmiagency.org',
          'type'      => 'text',
        ]);

        Setting::create([
          'category'  => 'general',
          'key'       => 'eligibility_text',
          'value'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui aspernatur, sapiente doloribus expedita similique nemo.',
          'type'      => 'textarea',
        ]);

        Setting::create([
          'category'    => 'appearance',
          'key'         => 'primary_color',
          'value'       => '00d4b5',
          'type'        => 'color',
          'description' => 'Primary branding color for buttons, links, etc.',
        ]);

        Setting::create([
          'category'  => 'appearance',
          'key'       => 'primary_color_contrast',
          'value'     => 'ffffff',
          'type'      => 'color',
        ]);

        Setting::create([
          'category'  => 'appearance',
          'key'       => 'secondary_color',
          'value'     => null,
          'type'      => 'color',
        ]);

        Setting::create([
          'category'  => 'appearance',
          'key'       => 'secondary_color_contrast',
          'value'     => null,
          'type'      => 'color',
        ]);

        Setting::create([
          'category'  => 'appearance',
          'key'       => 'cap_color',
          'value'     => '404040',
          'type'      => 'color',
        ]);

        Setting::create([
          'category'  => 'appearance',
          'key'       => 'cap_color_contrast',
          'value'     => '404040',
          'type'      => 'color',
        ]);

        Setting::create([
          'category'  => 'general',
          'key'       => 'header_logo',
          'value'     => '/dist/images/tmi-logo.png',
          'type'      => 'image',
        ]);

        Setting::create([
          'category'  => 'general',
          'key'       => 'footer_logo',
          'value'     => '/dist/images/tmi-logo.png',
          'type'      => 'image',
        ]);

        Setting::create([
          'category'  => 'general',
          'key'       => 'footer_text',
          'value'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque facilis, explicabo quidem ea dolore fugit.',
          'type'      => 'textarea',
        ]);

        Setting::create([
          'category'  => 'general',
          'key'       => 'background_image',
          'value'     => '',
          'type'      => 'image',
        ]);

        Setting::create([
          'category'  => 'appearance',
          'key'       => 'custom_font_kit_id',
          'value'     => '',
          'type'      => 'text',
        ]);

        Setting::create([
          'category'  => 'appearance',
          'key'       => 'custom_font_name',
          'value'     => '',
          'type'      => 'text',
        ]);
    }
}
