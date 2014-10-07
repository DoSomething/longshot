<?php

class StatusPageHelpTextTableSeeder extends Seeder {

  public function run()
  {
    Setting::insert([
      'category'  => 'general',
      'key'       => 'status_page_help_text_incomplete',
      'value'     => 'You are just a couple of steps away from a home run! Continue filling out the application and hit review and submit once your application is complete. Keep up the hard work!',
      'type'      => 'textarea',
    ]);
    Setting::insert([
      'category'  => 'general',
      'key'       => 'status_page_help_text_submitted',
      'value'     => 'Thanks for your submission! We’re excited to read your application. Your application will be 100% complete once we receive your required recommendation. Come back to this page to check your application status.',
      'type'      => 'textarea',
    ]);
    Setting::insert([
      'category'  => 'general',
      'key'       => 'status_page_help_text_complete',
      'value'     => 'Thanks for your submission! Your application is 100% complete and is under review. We’ll reach out to you by late-January if you are a semi-finalist. Stay tuned!',
      'type'      => 'textarea',
    ]);
  }
}
