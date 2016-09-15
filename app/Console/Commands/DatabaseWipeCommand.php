<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\Nomination;
use App\Models\Profile;
use App\Models\Race;
use App\Models\Rating;
use App\Models\Recommendation;
use App\Models\RecommendationToken;
use App\Models\User;
use DB;
use Illuminate\Console\Command;
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
        if (!$this->confirm('Did you transfer the winners data to the winners table? [y|n]')) {
            return $this->error('Please run artisan transfer:winners command!');
        }

        if (!$this->confirm('Did you run a dump and back up the current database? [y|n]')) {
            return $this->error('Please back up the current database before proceeding!');
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
