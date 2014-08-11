<?php

class SessionsController extends \BaseController {

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

    // @TODO: Validate

    $attempt = Auth::attempt(Input::only('email', 'password'));

    if ($attempt)
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
  public function destroy()
  {

    Auth::logout();

    return Redirect::home()->with('flash_message', 'You have been logged out!');

  }


}
