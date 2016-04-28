<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Email;
use App\Models\User;

class RegistrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateAccount()
    {
		// Create mock email object to intercept request to send email
		Mail::shouldReceive('queue');

		// Fill out and submit the registration form
    	$this->visit(route('registration.create'))
			->type('Puppet', 'first_name')
			->type('Sloth', 'last_name')
			->type('example-sloth@example.com', 'email')
			->type('slothpassword', 'password')
			->type('slothpassword', 'password_confirmation')
			->check('eligibility')
			->press('Create Account');

		// Make sure the user gets to the next page okay
		$this->see('Thanks for creating your account');

		// Check that the user is showing up in the database
		$user = User::where('email', 'example-sloth@example.com')->first();

		$this->seeInDatabase('users', [
			'id' => $user->id,
			'first_name' => 'Puppet',
			'last_name' => 'Sloth',
			'email' => 'example-sloth@example.com',
		]);
    }
}
