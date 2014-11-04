<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Scholarship\Repositories\SettingRepository;

class CustomStylesCommand extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'custom-styles';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Easily save out the latest appearance settings.';


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
    $settings = new SettingRepository();

    $setting_data = $settings->getCategorySettingsVars('appearance');

    createCustomStylesheet($setting_data);

    $this->info('Custom settings have been saved to the cache.');
  }

}
