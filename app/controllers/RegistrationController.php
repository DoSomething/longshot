<?php

use Scholarship\Forms\RegistrationForm;
use Scholarship\Repositories\SettingRepository;

class RegistrationController extends \BaseController
{
    protected $registrationForm;

    protected $settings;

    public function __construct(SettingRepository $settings, RegistrationForm $registrationForm)
    {
        $this->settings = $settings;

        $this->registrationForm = $registrationForm;
    }

  /**
   * Show the form for creating a new resource.
   * /register.
   *
   * @return Response
   */
  public function create()
  {
      $eligibilityText = $this->settings->getSpecifiedSettingsVars(['eligibility_text']);
      $help_text = $this->settings->getSpecifiedSettingsVars(['create_account_help_text']);

      $vars = (object) array_merge($eligibilityText, $help_text);

      return View::make('registration.create', compact('vars'));
  }

  /**
   * Store a newly created resource in storage.
   * /register.
   *
   * @return Response
   */
  public function store()
  {
      $input = Input::only('first_name', 'last_name', 'email', 'password', 'password_confirmation', 'eligibility');

    // Form errors caught and handled in Application Error Handler in /start/global.php
    $this->registrationForm->validate($input);
    // We don't need to save this to the db.
    unset($input['eligibility']);
      $user = User::create($input);

      Auth::login($user);

      $this->sendRegistrationEmail($user);

      return Redirect::route('profile.create')->with('flash_message', ['text' => 'Thanks for creating your account.', 'class' => '-success']);
  }

    public function sendRegistrationEmail($user)
    {
        $email = new Email();
        $data = [
      'first_name' => $user->first_name,
      'last_name'  => $user->last_name,
    ];
        $email->sendEmail('welcome', 'applicant', $user->email, $data);
    }
}
