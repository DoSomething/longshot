<?php namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class LoginForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules = [
    'email'      => 'required|email',
    'password'   => 'required',
  ];

}
