<?php

class SettingsTableSeeder extends Seeder {

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
      'category'    => 'appearance',
      'key'         => 'primary_color',
      'value'       => '00d4b5',
      'type'        => 'color',
      'description' => 'Primary branding color for buttons, links, etc.'
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
      'value'     => NULL,
      'type'      => 'color',
    ]);

    Setting::create([
      'category'  => 'appearance',
      'key'       => 'secondary_color_contrast',
      'value'     => NULL,
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
  }

}
