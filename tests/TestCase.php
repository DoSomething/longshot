<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    protected $baseUrl = 'http://localhost';

  /**
   * Creates the application.
   *
   * @return \Symfony\Component\HttpKernel\HttpKernelInterface
   */
  public function createApplication()
  {
      $unitTesting = true;

      $testEnvironment = 'testing';

      return require __DIR__.'/../bootstrap/app.php';
  }
}
