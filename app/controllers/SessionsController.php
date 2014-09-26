<?php

use Scholarship\Forms\LoginForm;

class SessionsController extends \BaseController {

  /**
   * @var RegistrationForm
   */
  protected $loginForm;

  function __construct(LoginForm $loginForm)
  {
    $this->loginForm = $loginForm;
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    if (Auth::check())
    {
      return Redirect::route('status');
    }

    return View::make('sessions.create');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::only('email', 'password');

    $this->loginForm->validate($input);

    if (Auth::attempt($input))
    {
      if (Auth::user()->hasRole('administrator'))
      {
        return Redirect::route('admin')->with('flash_message', 'You have been logged in as an administrator!');
      }

      return Redirect::intended('status')->with('flash_message', 'You have been logged in!');
    }
    $password_forgot = link_to('password/remind', 'forgotten your password');
    return Redirect::back()->withInput()->with('flash_message', 'Sorry, unrecognized username or password. Have you '. $password_forgot . '?');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id = null)
  {
    Auth::logout();

    return Redirect::home()->with('flash_message', 'You have been logged out!');
  }


}
