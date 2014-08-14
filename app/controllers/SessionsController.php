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
      return Redirect::to('admin');
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
      return Redirect::intended('admin')->with('flash_message', 'You have been logged in!');
    }

    return Redirect::back()->with('flash_message', 'Invalid credentials!')->withInput();
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
