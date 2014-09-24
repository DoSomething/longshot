<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class ReviewForm extends FormValidator {

 /**
  * @var array
  */
 protected $rules = [
  'documentation'   => 'accepted',
  'factual'         => 'accepted',
  'media_release'   => 'accepted',
  'rules'           => 'accepted',
 ];

}
