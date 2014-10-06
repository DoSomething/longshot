<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class NominationForm extends FormValidator {

 /**
  * @var array
  */
 protected $rules = [
  'rec_name'   => 'required',
  'rec_email'  => 'required|email',
  'nom_name'   => 'required',
  'nom_email'  => 'required|email',

 ];

 protected $messages = [
  'rec_name.required'   => 'Please enter your name.',
  'nom_name.required'   => 'Please enter the nominee\'s name.',
  'rec_email.required'  => 'Please enter an email.',
  'nom_email.required'  => 'Please enter an email.',
  'rec_email.email'     => 'Please enter a valid email address',
  'nom_email.email'     => 'Please enter a valid email address',
 ];

}
