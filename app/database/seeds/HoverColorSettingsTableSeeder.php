<?php

class InteractionColorSettingsTableSeeder extends Seeder {

  public function run()
  {
    Setting::insert([
      'category'    => 'appearance',
      'key'         => 'primary_color_interaction',
      'value'       => NULL,
      'type'        => 'color',
      'description' => 'Hover/active color applied on primary elements during interaction.'
    ]);

    Setting::insert([
      'category'    => 'appearance',
      'key'         => 'secondary_color_interaction',
      'value'       => NULL,
      'type'        => 'color',
      'description' => 'Hover/active color applied on secondary elements during interaction.',
    ]);
  }

}
