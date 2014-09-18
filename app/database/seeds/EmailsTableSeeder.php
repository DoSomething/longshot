<?php


class EmailsTableSeeder extends Seeder {
  /**
   * Seed the Settings table.
   *
   * @return void
   */
  public function run()
  {
    Email::truncate();

    // Needed to fill the key and recipient fields
    Eloquent::unguard();

    Email::create([
      'key'       => 'welcome',
      'recipient' => 'applicant',
      'subject'   => 'Your Foot Locker Scholar Athletes application',
      'body'      => '',
    ]);

   Email::create([
      'key'       => 'submitted',
      'recipient' => 'applicant',
      'subject'   => 'CONFIRMATION: We’ve received your Foot Locker Scholar Athlete application',
      'body'      => '',
    ]);

    Email::create([
      'key'       => 'request',
      'recipient' => 'applicant',
      'subject'   => 'CONFIRMATION: Your recommendation was requested',
      'body'      => '',
    ]);

    Email::create([
      'key'       => 'request',
      'recipient' => 'recommender',
      'subject'   => 'Request for Recommendation',
      'body'      => '',
    ]);

    Email::create([
      'key'       => 'received',
      'recipient' => 'applicant',
      'subject'   => 'CONFIRMATION: We’ve received your required recommendation',
      'body'      => '',
    ]);

    Email::create([
      'key'       => 'received',
      'recipient' => 'recommender',
      'subject'   => 'CONFIRMATION: Your Recommendation',
      'body'      => '',
    ]);

    Email::create([
      'key'       => 'nomination',
      'recipient' => 'applicant',
      'subject'   => 'You were nominated to apply to Foot Locker Scholar Athletes program!',
      'body'      => '',
    ]);


  }

}