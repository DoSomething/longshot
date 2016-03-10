<?php

class ExampleTest extends TestCase
{
     protected $baseUrl = 'http://localhost';

    /**
   * A basic functional test example.
   *
   * @return void
   */
  public function testBasicExample()
  {
      $crawler = $this->client->request('GET', '/');

      $this->assertTrue($this->client->getResponse()->isOk());
  }
}
