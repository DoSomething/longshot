<?php

class AppearanceTableSeeder extends Seeder {

  /**
   * Seed the Appearance table.
   *
   * @return void
   */
  public function run()
  {
     Appearance::truncate();

     Appearance::create([
        'company_name'             => 'TMI',
        'company_url'              => 'http://tmiagency.org',
        'primary_color'            => '00d4b5',
        'primary_color_contrast'   => 'ffffff',
        'cap_color'                => '404040',
        'cap_color_contrast'       => '404040',
        'header_logo'              => '',
        'footer_logo'              => '',
      ]);
  }

}
