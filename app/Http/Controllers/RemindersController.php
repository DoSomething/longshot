<?php

class RemindersController extends \Controller
{
    /**
   * Display the password reminder view.
   *
   * @return Response
   */
  public function getRemind()
  {
      return View::make('password.remind');
  }

  /**
   * Handle a POST request to remind a user of their password.
   *
   * @return Response
   */
  public function postRemind()
  {
      switch ($response = Password::remind(Input::only('email'), function ($message) {
      $message->subject('Scholarship Application Password Reset');
    })) {
      case Password::INVALID_USER:
        return redirect()->back()->with('flash_message', ['text' => Lang::get($response), 'class' => '-error']);

      case Password::REMINDER_SENT:
        return redirect()->back()->with('flash_message', ['text' => Lang::get($response), 'class' => '-success']);
    }
  }

  /**
   * Display the password reset view for the given token.
   *
   * @param  string  $token
   *
   * @return Response
   */
  public function getReset($token = null)
  {
      if (is_null($token)) {
          App::abort(404);
      }

      return view('password.reset', compact('token'));
  }

  /**
   * Handle a POST request to reset a user's password.
   *
   * @return Response
   */
  public function postReset()
  {
      $credentials = Input::only(
      'email', 'password', 'password_confirmation', 'token'
    );

      $response = Password::reset($credentials, function ($user, $password) {
      // Password is automatically hashed using mutator in User model.
      $user->password = $password;

      $user->save();
    });

      switch ($response) {
      case Password::INVALID_PASSWORD:
      case Password::INVALID_TOKEN:
      case Password::INVALID_USER:
        return redirect()->back()->withInput()->with('flash_message', ['text' => Lang::get($response), 'class' => '-error']);

      case Password::PASSWORD_RESET:
        return redirect()->to('login')->with('flash_message', ['text' => 'Your password has been reset.', 'class' => '-success']);
    }
  }
}
