<?php

namespace App\Console\Commands;

use App\Models\Race;
use App\Models\User;
use App\Models\Profile;
use App\Models\Application;
use App\Models\Recommendation;
use Illuminate\Console\Command;

class GenerateTestData extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'generate:testdata {amount=1} {type=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make some test data';

    public function fire()
    {
        $number = (int) $this->argument('amount');
        $type = $this->argument('type');
        if ($type === 'all') {
            $type = null;
        }

        // plain user
        if (! $type || $type == 'user') {
            $users = factory(User::class, $number)->create();
            if ($number == 1) {
                $users = collect([$users]);
            }
            $users->each(function ($user) {
                $this->line('plain user - ' . $user->id);
            });
        }

        // user with partial profile (including race)
        if (! $type || $type == 'partial-profile-race') {
            $partial_profiles = factory(Profile::class, 'partial', $number)->create();
            if ($number == 1) {
                $partial_profiles = collect([$partial_profiles]);
            }
            $partial_profiles->each(function ($profile) {
                $profile->race()->save(factory(Race::class)->make());
                $this->line('user with partial profile (including race) - ' . $profile->user_id);
            });
        }

        // user with partial profile (no race)
        if (! $type || $type == 'partial-profile') {
            $partial_profile_no_race = factory(Profile::class, 'partial', $number)->create();
            if ($number == 1) {
                $partial_profile_no_race = collect([$partial_profile_no_race]);
            }
            $partial_profile_no_race->each(function ($partial) {
                $this->line('user with partial profile (no race) - ' . $partial->user_id);
            });
        }

        // user with partial profile and partial app (no race)
        if (! $type || $type == 'partial-profile-and-app') {
            $partial_profile_app_no_race = factory(Profile::class, 'partial', $number)->create();
            if ($number == 1) {
                $partial_profile_app_no_race = collect([$partial_profile_app_no_race]);
            }
            $partial_profile_app_no_race->each(function ($profile) {
                $profile->user->application()->save(factory(Application::class, 'partial')->create());
                $this->line('user with partial profile and partial app (no race) - ' . $profile->user_id);
            });
        }

        // user with partial profile and partial app (including race)
        if (! $type || $type == 'partial-profile-and-app-race') {
            $partial_profile_app = factory(Profile::class, 'partial', $number)->create();
            if ($number == 1) {
                $partial_profile_app = collect([$partial_profile_app]);
            }
            $partial_profile_app->each(function ($profile) {
                $profile->race()->save(factory(Race::class)->create());
                $profile->user->application()->save(factory(Application::class, 'partial')->create());
                $this->line('user with partial profile and partial app (including race) - ' . $profile->user_id);
            });
        }

        // user with finished profile (including race)
        if (! $type || $type == 'profile-race') {
            $profile = factory(Profile::class, $number)->create();
            if ($number == 1) {
                $profile = collect([$profile]);
            }
            $profile->each(function ($profile) {
                $profile->race()->save(factory(Race::class)->create());
                $this->line('user with finished profile (including race) - ' . $profile->user_id);
            });
        }

        // user with finished profile and partial app
        if (! $type || $type == 'profile-partial-app') {
            $profile_partial_app = factory(Profile::class, $number)->create();
            if ($number == 1) {
                $profile_partial_app = collect([$profile_partial_app]);
            }
            $profile_partial_app->each(function ($profile) {
                $profile->user->application()->save(factory(Application::class, 'partial')->create());
                $this->line('user with finished profile and partial app - ' . $profile->user_id);
            });
        }

        // user with finished profile and submitted app and rec requests
        if (! $type || $type == 'submitted-app-recs') {
            $profile_submitted_app = factory(Profile::class, $number)->create();
            if ($number == 1) {
                $profile_submitted_app = collect([$profile_submitted_app]);
            }
            $profile_submitted_app->each(function ($profile) {
                $profile->user->application()->save(factory(Application::class, 'submitted')->create());
                $profile_submitted_app_app = $profile->user->application;
                $profile_submitted_app_app->recommendation()->save(factory(Recommendation::class, 'request')->create());
                $this->line('user with finished profile and submitted app and rec requests - ' . $profile->user_id);
            });
        }

        // user with finished profile, completed app, completed rec requests
        if (! $type || $type == 'all-done') {
            $done = factory(Profile::class, $number)->create();
            if ($number == 1) {
                $done = collect([$done]);
            }
            $done->each(function ($app) {
                $app->user->application()->save(factory(Application::class, 'submitted')->create());
                $done_app = $app->user->application;
                $done_app->recommendation()->save(factory(Recommendation::class, 'request')->create());
                $this->line('user with finished profile, completed app, completed rec requests - ' . $app->user_id);
            });
        }
    }
}
