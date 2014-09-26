<?php

class AppSubmitHelpTextTableSeeder extends Seeder {

  public function run()
  {
    Setting::insert([
      'category'  => 'general',
      'key'       => 'application_submit_help_text',
      'value'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque facilis, explicabo quidem ea dolore fugit.',
      'type'      => 'textarea',
    ]);
  }
}