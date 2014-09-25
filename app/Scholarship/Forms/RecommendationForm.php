<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class RecommendationForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules = [
    'rank_character'  => 'required',
    'rank_additional' => 'required',
    'essay1'          => 'required',
  ];

}
