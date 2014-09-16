<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class RecommendationForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules = [
    'first_name'      => 'required',
    'last_name'       => 'required',
    'email'           => 'required|email',
    'relationship'    => 'required',
  ];

}
