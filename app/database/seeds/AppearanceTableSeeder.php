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
        'company_name'    => 'TMI',
        'company_url'     => 'http://tmiagency.org',
        'primary_color'   => '00d4b5',
        'secondary_color' => 'ffffff',
        'button_color'    => '00d4b5',
        'link_color'      => '00d4b5',
        'header_logo'     => '',
        'footer_logo'     => '',
      ]);
  }

}
