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

protected $messages = [
  'documentation.accepted'   => 'Please confirm you can provide one of these documents.',
  'factual.accepted'         => 'Please confirm everything in your application is true and factual.',
  'media_release.accepted'   => 'lease verify that you accept the media release.',
  'rules.accepted'           => 'Please verify that you accept the Official Rules.',
 ];

}
