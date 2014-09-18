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

}
