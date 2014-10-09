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

    $vars = (object) Setting::getPageSettingsVars();

    return View::make('sessions.create', compact('vars'));
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
        return Redirect::route('admin');
      }

      return Redirect::intended('status')->with('flash_message', ['text' => 'You have been logged in!', 'class' => '-info']);
    }
    $password_forgot = link_to('password/remind', 'forgotten your password');
    return Redirect::back()->withInput()->with('flash_message', ['text' => 'Sorry, unrecognized username or password. Have you '. $password_forgot . '?', 'class' => '-error']);
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

    return Redirect::home()->with('flash_message', ['text' => 'You have been logged out!', 'class' => '-info']);
  }


}
