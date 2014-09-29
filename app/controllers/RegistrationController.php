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
    $setting = Setting::whereKey('eligibility_text')->first();

    $data = new stdClass;
    $data->eligibility_text = $setting->value;
    $help_text = Setting::where('key', '=', 'create_account_help_text')->pluck('value');
    $vars = Setting::getSettingsVariables('general'); // @TODO: mayb consolidate with above?

    return View::make('registration.create', compact('data', 'help_text', 'vars'));
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

    return Redirect::route('profile.create');

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
