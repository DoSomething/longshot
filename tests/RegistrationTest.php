<?php

use App\Models\Email;
use App\Models\Scholarship;
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

        // Create a scholarship because some items in the view partials depend on having an open one
        $scholarship_data = [
						'title'                     => 'Fox Lover Scholarship',
						'description'               => 'Bright Eyed and Bushy Tailed',
						'amount_scholarship'        => '20',
						'application_start'         => '2016-01-01',
						'application_end'           => '2016-12-11',
						'winners_announced'         => '2016-12-12',
						'age_min'                   => '13',
						'age_max'                   => '18',
						'num_recommendations_min'   => '1',
						'num_recommendations_max'   => '2',
						'gpa_min'                   => '3.0',
						'label_app_accomplishments' => 'What have you accomplished?',
						'label_app_activities'      => 'List all of your fox-related activities',
						'label_app_essay1'          => 'Tell us about your favorite type of fox.',
						'label_app_essay2'          => 'Tell us about a time foxes made you sad and how you got over it.',
						'label_rec_rank_character'  => 'How much does this person love foxes?',
						'label_rec_rank_additional' => 'Are you a fox?',
						'label_rec_essay1'          => 'Tell me about the time this person yelled about foxes the loudest...',
        ];
        $scholarship = Scholarship::create($scholarship_data);

        $email_data = [
						'key'       => 'welcome',
						'recipient' => 'applicant',
						'subject'   => 'Your Foot Locker Scholar Athletes application',
						'body'      => '',
        ];
        $email = Email::create($email_data);

        $this->notSeeInDatabase('users', [
            'first_name' => 'Puppet',
            'last_name'  => 'Sloth',
            'email'      => 'example-sloth@example.com',
        ]);

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
            'id'         => $user->id,
            'first_name' => 'Puppet',
            'last_name'  => 'Sloth',
            'email'      => 'example-sloth@example.com',
        ]);
    }
}
