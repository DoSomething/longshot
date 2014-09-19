<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class ProfileForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules = [
    'birthdate'       => 'required',
    'phone'           => 'required|numeric',
    'address_street'  => 'required',
    'city'            => 'required',
    'state'           => 'required',
    'zip'             => 'required',
    'school'          => 'required',
  ];

}
