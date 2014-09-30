<?php

class NominateSettingsTableSeeder extends Seeder {

  public function run()
  {
    Setting::insert([
      'category' => 'general',
      'key'      => 'nominate_text',
      'value'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, soluta.',
      'type'     => 'textarea',
    ]);

    Setting::insert([
      'category' => 'general',
      'key'      => 'nominate_image',
      'value'    => '/dist/images/nominate-image-placeholder.jpg',
      'type'     => 'image',
    ]);
  }

}
