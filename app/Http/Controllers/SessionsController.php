<?php

use Illuminate\Http\Request;

class SessionsController extends \Controller
{
    protected $loginForm;

    protected $rules = [
    'email'      => 'required|email',
    'password'   => 'required',
    ];

    public function __construct()
    {
        // $this->loginForm = $loginForm;
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      if (Auth::check()) {
          return redirect()->route('status');
      }

      return view('sessions.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $this->validate($request, $this->rules);

      $input = $request->only('email', 'password');

      if (Auth::attempt($input)) {

          if (Auth::user()->hasRole('administrator')) {
              return Redirect::route('admin');
          }

          return redirect()->intended('status')->with('flash_message', ['text' => 'You have been logged in!', 'class' => '-info']);
      }

      return redirect()->back()->withInput()->with('flash_message', ['text' => 'Sorry, unrecognized username or password. Have you forgotten your password?', 'class' => '-error']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function destroy($id = null)
  {
      Auth::logout();

      return redirect()->home()->with('flash_message', ['text' => 'You have been logged out!', 'class' => '-info']);
  }
}
