<?php namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules = [
    'first_name' => 'required',
    'last_name'  => 'required',
    'email'      => 'required|email|unique:users',
    'password'   => 'required|confirmed',
  ];

}
