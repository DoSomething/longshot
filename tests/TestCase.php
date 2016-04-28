<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use DatabaseTransactions;

    protected $baseUrl = 'http://localhost';

  /**
   * Creates the application.
   *
   * @return \Illuminate\Foundation\Application
   */
  public function createApplication()
  {
      $app = require __DIR__.'/../bootstrap/app.php';

      $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

      return $app;
  }
}
