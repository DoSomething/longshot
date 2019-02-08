<?php

namespace App\Console\Commands;

use DB;
use App\Models\User;
use Illuminate\Console\Command;

class DatabaseWipeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'wipe:applicants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear out all applicant data from database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        if (! $this->confirm('If this is Footlocker External, is the winner gallery finished? [y|n]')) {
            return $this->error('Please award scholarships before running!');
        }

        if (! $this->confirm('Did you take a snapshot of the current database? [y|n]')) {
            return $this->error('Please take a snapshot of the current database before proceeding!');
        }

        // Clear out database tables with applicant data (except for winners).
        DB::table('applications')->delete();
        DB::table('nominations')->delete();
        DB::table('profiles')->delete();
        DB::table('races')->delete();
        DB::table('ratings')->delete();
        DB::table('recommendations')->delete();
        DB::table('recommendation_tokens')->delete();
        DB::table('failed_jobs')->delete();
        DB::table('password_resets')->delete();

        // Delete users who are not admins
        DB::table('users')
            ->whereNotIn('id', function ($query) {
                $query->select('user_id')
                      ->from('role_user')
                      ->where('role_user.role_id', 1);
            })
            ->delete();

        // Do a check to make sure we have the expected number of admins
        $ids = DB::table('role_user')->pluck('user_id');
        $emails = DB::table('users')->whereIn('id', $ids)->pluck('email');
        if (count($ids) === count($emails)) {
            $this->line('Correct number of '.count($ids).' admins found.');
        } else {
            $this->line('WARNING! NUMBER OF ADMIN ASSIGNMENTS DOES NOT MATCH NUMBER OF ADMIN USERS.');
        }
        $this->line('The admins are: ');
        foreach ($emails as $email) {
            $this->line($email);
        }

        $this->info('All set! We successfully killed all the user data with fire and kept existing admins.');
    }
}
