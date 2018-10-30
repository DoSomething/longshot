<?php

use App\Models\Email;
use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{
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

        Email::create([
        'key'       => 'submitted_blank_rec',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'submitted_no_rec',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'incomplete_apps',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'nominated_no_app',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'completed_apps',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'rec_requested_not_finished',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'nominators',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'nominees',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'recommenders',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'completed_apps_by_first_and_email',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'incomplete_apps_by_first_and_email',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'yes_applicants',
        'recipient' => 'group',
        'subject'   => '',
        'body'      => '',
      ]);

        Email::create([
        'key'       => 'test',
        'recipient' => 'applicant',
        'subject'   => '',
        'body'      => '',
      ]);
    }
}
