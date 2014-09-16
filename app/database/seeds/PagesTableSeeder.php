<?php

class PagesTableSeeder extends Seeder {

  public function run()
  {
    Page::truncate();

    // @TODO: There's probably a much cleaner way to write this.
    $pathHome = new Path;
    $pathHome->url       = '/';
    $pathHome->link_text = 'Home';

    $pathAbout = new Path;
    $pathAbout->url       = 'about';
    $pathAbout->link_text = 'About';

    $pathFAQ = new Path;
    $pathFAQ->url       = 'faq';
    $pathFAQ->link_text = 'FAQ';

    Page::create([
      'title'       => 'Home',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, sequi.',
    ])->assignPath($pathHome);

    Page::create([
      'title'       => 'About',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, sequi.',
    ])->assignPath($pathAbout);

    Page::create([
      'title'       => 'FAQ',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, sequi.',
    ])->assignPath($pathFAQ);
  }
}
