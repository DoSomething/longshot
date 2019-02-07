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

        // Get the admins from the Users table.
        $admins = DB::select(DB::raw('SELECT *
						                      FROM users u
						                      INNER JOIN role_user ru
						                      WHERE ru.id = u.id;'));

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear out database tables.
        Application::truncate();
        Nomination::truncate();
        Profile::truncate();
        Race::truncate();
        Rating::truncate();
        Recommendation::truncate();
        RecommendationToken::truncate();
        User::truncate();
        if ((Schema::hasTable('failed_jobs'))) {
            DB::table('failed_jobs')->truncate();
        }
        DB::table('password_resets')->truncate();

        // Add the admins back into the Users table.
        foreach ($admins as $admin) {
            DB::table('users')->insert([
            'email'          => $admin->email,
            'password'       => $admin->password,
            'first_name'     => $admin->first_name,
            'last_name'      => $admin->last_name,
            'remember_token' => null,
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('All set! We successfully killed all the user data with fire.');
    }
}
