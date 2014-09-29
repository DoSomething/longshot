<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class ApplicationForm extends FormValidator {

 /**
  * @var array
  */
 protected $rules = [
  'accomplishments' => 'required',
  'participation'   => 'required',
  'gpa'             => 'required|numeric',
  'test_score'      => 'numeric',
  'activities'      => 'required',
  'essay1'          => 'required',
  'essay2'          => 'required',
  'link'            => 'url',
 ];

}
