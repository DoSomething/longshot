<?php

namespace App\Console\Commands;

use DB;
use App\Models\Race;
use App\Models\User;
use App\Models\Rating;
use App\Models\Profile;
use App\Models\Nomination;
use App\Models\Application;
use App\Models\Recommendation;
use Illuminate\Console\Command;
use App\Models\RecommendationToken;
use Illuminate\Support\Facades\Schema;

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

        // Clear out database tables.
        DB::table('applications')->delete();
        DB::table('nominations')->delete();
        DB::table('profiles')->delete();
        DB::table('races')->delete();
        DB::table('ratings')->delete();
        DB::table('recommendations')->delete();
        DB::table('recommendation_tokens')->delete();
        if ((Schema::hasTable('failed_jobs'))) {
            DB::table('failed_jobs')->delete();
        }
        DB::table('password_resets')->delete();

        // Delete users who are not admins
        DB::table('users')
            ->whereNotIn('id', function ($query) {
                $query->select('user_id')
                      ->from('role_user')
                      ->where('role_user.role_id', 1);
            })
            ->delete();

        $this->info('All set! We successfully killed all the user data with fire and kept existing admins.');
    }
}
