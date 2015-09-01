<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class WipeDatabaseCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'wipe:users';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

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
		if (! $this->confirm('Did you run a dump and back up the current database? [y|n]')) {
			return $this->error('Please back up the current database before proceeding!');
		}

		// Do the thing here:
		// applications ✓
		// nominations ✓
		// failed_jobs ✓
		// password_reminders ✓
		// profiles ✓
		// races ✓
		// ratings ✓
		// recommendation_tokens ✓
		// recommendations ✓
		// users


		Application::truncate();
		Nomination::truncate();
		Profile::truncate();
		Race::truncate();
		Rating::truncate();
		Recommendation::truncate();
		RecommendationToken::truncate();
		// Users::truncate();


		DB::table('failed_jobs')->truncate();
		DB::table('password_reminders')->truncate();


		$this->info('All set! We successfully killed all the user data with fire.');
	
	}

}
