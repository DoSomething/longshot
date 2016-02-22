<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator
{
    /**
   * @var array
   */
  protected $rules = [
    'first_name'  => 'required',
    'last_name'   => 'required',
    'email'       => 'required|email|unique:users',
    'password'    => 'required|confirmed|min:6',
    'eligibility' => 'required|accepted',
  ];

    protected $messages = [
    'first_name.required'  => 'Please enter your first name.',
    'last_name.required'   => 'Please enter your last name.',
    'email.required'       => 'Please enter an email.',
    'email.unique'         => 'That email is already registered.',
    'password.required'    => 'Please note: password must be 6+ characters.',
    'eligibility.required' => 'Only candidates who meet the requirements above are eligible for the scholarship.',
  ];
}
