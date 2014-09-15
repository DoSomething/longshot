<?php

class PagesTableSeeder extends Seeder {

  public function run()
  {
    Page::truncate();

    Page::create([
      'title'       => 'Home',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, sequi.',
    ]);

    Page::create([
      'title'       => 'About',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, sequi.',
    ]);

    Page::create([
      'title'       => 'FAQ',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, sequi.',
    ]);
  }
}
