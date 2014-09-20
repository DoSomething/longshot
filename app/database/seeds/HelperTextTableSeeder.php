<?php

class HelperTextTableSeeder extends Seeder {

	public function run()
	{
    Setting::insert([
      'category'  => 'general',
      'key'       => 'basic_info_help_text',
      'value'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque facilis, explicabo quidem ea dolore fugit.',
      'type'      => 'textarea',
    ]);
    Setting::insert([
      'category'  => 'general',
      'key'       => 'create_account_help_text',
      'value'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque facilis, explicabo quidem ea dolore fugit.',
      'type'      => 'textarea',
    ]);
    Setting::insert([
      'category'  => 'general',
      'key'       => 'profile_create_help_text',
      'value'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque facilis, explicabo quidem ea dolore fugit.',
      'type'      => 'textarea',
    ]);
    Setting::insert([
      'category'  => 'general',
      'key'       => 'application_create_help_text',
      'value'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque facilis, explicabo quidem ea dolore fugit.',
      'type'      => 'textarea',
    ]);
    Setting::insert([
      'category'  => 'general',
      'key'       => 'recommendation_create_help_text',
      'value'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque facilis, explicabo quidem ea dolore fugit.',
      'type'      => 'textarea',
    ]);
    Setting::insert([
      'category'  => 'general',
      'key'       => 'recommendation_update_help_text',
      'value'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque facilis, explicabo quidem ea dolore fugit.',
      'type'      => 'textarea',
    ]);
	}

}