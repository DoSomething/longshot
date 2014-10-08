<?php

use Scholarship\Forms\RegistrationForm;

class RegistrationController extends \BaseController {

  /**
   * @var RegistrationForm
   */
  protected $registrationForm;

  function __construct(RegistrationForm $registrationForm)
  {
    $this->registrationForm = $registrationForm;
  }


  /**
   * Show the form for creating a new resource.
   * /register
   *
   * @return Response
   */
  public function create()
  {

    $eligibilityText = Setting::getSpecifiedSettingsVars(['eligibility_text']);
    $help_text = Setting::getSpecifiedSettingsVars(['create_account_help_text']);
    $page_vars = Setting::getPageSettingsVars();

    $vars = (object) array_merge($page_vars, $help_text, $eligibilityText);

    return View::make('registration.create', compact('vars'));
  }


  /**
   * Store a newly created resource in storage.
   * /register
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

    // Assign an initial role of 'applicant'.
    $user->assignRole(2);

    Auth::login($user);

    $this->sendRegistrationEmail($user);

    return Redirect::route('profile.create')->with('flash_message', 'Thanks for creating your account.');

  }

  public function sendRegistrationEmail($user)
  {
    $email = new Email;
    $data = array(
      'first_name' => $user->first_name,
      'last_name' => $user->last_name,
    );
    $email->sendEmail('welcome', 'applicant', $user->email, $data);
  }

}
