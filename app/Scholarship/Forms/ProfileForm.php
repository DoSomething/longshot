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

  protected $messages = [
    'birthdate.required'       => 'Please enter your birthday in MM/DD/YYYY format.',
    'phone.required'           => 'Please enter a valid phone number.',
    'address_street.required'  => 'Please enter your address.',
    'city.required'            => 'Please enter your city.',
    'zip.required'             => 'Please enter your zip code.',
    'school.required'          => 'Please enter your current high school.',
  ];

}
