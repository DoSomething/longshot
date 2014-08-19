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
    return View::make('registration.create');
  }


  /**
   * Store a newly created resource in storage.
   * /register
   *
   * @return Response
   */
  public function store()
  {
    if (Input::has('eligibility'))
    {
      $input = Input::only('first_name', 'last_name', 'email', 'password', 'password_confirmation');

      $this->registrationForm->validate($input);  // Form errors caught and handled in Application Error Handler in /start/global.php

      $user = User::create($input);

      Auth::login($user);

      return Redirect::route('status');
    }
    else
    {
      return Redirect::back()->withInput()->with('flash_message', 'No soup (scholarship) for you!');
    }

  }

}
