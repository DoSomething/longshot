<?php

class ScholarshipTableSeeder extends Seeder {

  public function run()
  {
    Scholarship::truncate();

    Scholarship::create([
      'title' => 'FootLocker',
      'description' => 'Let\'s Kick it',
      'amount_scholarship' => '20,000',
      'application_start' => '2014-08-11',
      'application_end' => '2014-09-11',
      'winners_announced'=> '2014-10-11',
      'age_min'=> '13',
      'age_max'=> '18',
      'num_recommendations_min'=> '1',
      'num_recommendations_max'=> '1',
      'gpa_min'=> '3.6',
      'label_app_accomplishments'=> 'What have you done?',
      'label_app_activities'=> 'List the kinds of sportsballs can you kick',
      'label_app_essay1'=> 'Tell us about your favorite sportsball, and why it\'s your favorite',
      'label_app_essay2'=> 'Tell us about a time you couldn\'t find a sportsball and why it hurt you.',
      'label_rec_rank_character'=> 'Can this person kick a sportsball?',
      'label_rec_rank_additional'=> 'Be honest.',
      'label_rec_essay1'=> 'Tell me about the time this person kicked a sportsball the furthest...',
    ]);
  }
}
