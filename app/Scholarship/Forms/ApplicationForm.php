<?php namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class ApplicationForm extends FormValidator {

 /**
  * @var array
  */
 protected $rules = [
  'accomplishments' => 'required',
  'gpa'             => 'required',
  'test_type'       => 'required',
  'test_score'      => 'required',
  'activities'      => 'required',
  'essay1'          => 'required',
 ];

}
