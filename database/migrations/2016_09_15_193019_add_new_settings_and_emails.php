<?php

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

class AddNewSettingsAndEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // New Settings
        Setting::firstOrCreate([
            'category'  => 'general',
            'key'       => 'background_image',
            'type'      => 'image',
        ]);

        Setting::firstOrCreate([
            'category'  => 'appearance',
            'key'       => 'custom_font_kit_id',
            'type'      => 'text',
        ]);

        Setting::firstOrCreate([
            'category'  => 'appearance',
            'key'       => 'custom_font_name',
            'type'      => 'text',
        ]);

        // New Emails
        Email::firstOrCreate([
            'key'       => 'submitted_blank_rec',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'submitted_no_rec',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'incomplete_apps',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'nominated_no_app',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'completed_apps',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'rec_requested_not_finished',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'nominators',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'nominees',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'recommenders',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'completed_apps_by_first_and_email',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'incomplete_apps_by_first_and_email',
            'recipient' => 'group',
        ]);

        Email::firstOrCreate([
            'key'       => 'yes_applicants',
            'recipient' => 'group',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
