<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Scholarship\Repositories\SettingRepository;

class CustomStylesCommand extends Command
{
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

      $settings->resetAppearanceSettings();

      $this->info('Custom settings have been saved to the cache.');
  }
}
