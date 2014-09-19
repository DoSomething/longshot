<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class ApplicationForm extends FormValidator {

 /**
  * @var array
  */
 protected $rules = [
  'accomplishments' => 'required',
  'gpa'             => 'required|numeric',
  'test_score'      => 'numeric',
  'activities'      => 'required',
  'essay1'          => 'required',
  'essay2'          => 'required',
  'documentation'   => 'accepted',
  'factual'         => 'accepted',
  'media_release'   => 'accepted',
  'rules'           => 'accepted',

 ];

}
