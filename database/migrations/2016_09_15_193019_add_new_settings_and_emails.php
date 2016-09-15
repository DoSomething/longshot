<?php

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Database\Schema\Blueprint;
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
        if (!(Setting::where('key', 'background_image', '=')->first())) {
            Setting::insert([
                'category'  => 'general',
                'key'       => 'background_image',
                'value'     => '',
                'type'      => 'image',
            ]);  
        }

        if (!(Setting::where('key', 'custom_font_kit_id', '=')->first())) {
            Setting::insert([
                'category'  => 'appearance',
                'key'       => 'custom_font_kit_id',
                'value'     => '',
                'type'      => 'text',
            ]);
        }

        if (!(Setting::where('key', 'custom_font_name', '=')->first())) {
            Setting::insert([
                'category'  => 'appearance',
                'key'       => 'custom_font_name',
                'value'     => '',
                'type'      => 'text',
            ]);
        }

        // New Emails
        Email::firstOrNew([
            'key'       => 'submitted_blank_rec',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'submitted_no_rec',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'incomplete_apps',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'nominated_no_app',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'completed_apps',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'rec_requested_not_finished',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'nominators',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'nominees',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'recommenders',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'completed_apps_by_first_and_email',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'incomplete_apps_by_first_and_email',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'yes_applicants',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();

        Email::firstOrNew([
            'key'       => 'noodles',
            'recipient' => 'group',
            'subject'   => '',
            'body'      => '',
        ])->save();
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
