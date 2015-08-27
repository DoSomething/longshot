<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TransferWinnersCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'transfer:winners';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Collect winners data and transfer to winners table.';

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
    try {
      $transfer = Winner::transferWinners();
      $this->info('Transfer completed, have a scholarly beer!');
    }
    catch (Exception $error) {
      $this->error($error->getMessage());
    }
	}

















	// /**
	//  * Get the console command arguments.
	//  *
	//  * @return array
	//  */
	// protected function getArguments()
	// {
	// 	return array(
	// 		array('example', InputArgument::REQUIRED, 'An example argument.'),
	// 	);
	// }

	// /**
	//  * Get the console command options.
	//  *
	//  * @return array
	//  */
	// protected function getOptions()
	// {
	// 	return array(
	// 		array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
	// 	);
	// }

}
