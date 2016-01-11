<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class ApplicationForm extends FormValidator
{
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

    protected $messages = [
  'accomplishments.required' => 'This question is required.',
  'participation.required'   => 'This question is required.',
  'gpa.required'             => 'GPA is required.',
  'gpa.numeric'              => 'Please enter your GPA as a number.',
  'test_score.numeric'       => 'Please enter your test score as a number.',
  'activities.required'      => 'This question is required.',
  'essay1.required'          => 'This essay is required.',
  'essay2.required'          => 'This essay is required.',
  'link.url'                 => 'Please enter a valid link.',
 ];
}
