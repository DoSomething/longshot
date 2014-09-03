<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class AppearanceForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules = [
    'company_name'    => 'alpha_num',
    'company_url'     => 'url',
    'primary_color'   => 'alpha_num|size:6',
    'secondary_color' => 'alpha_num|size:6',
    'button_color'    => 'alpha_num|size:6',
    'link_color'      => 'alpha_num|size:6',
    'header_logo'     => 'image|mimes:png',
    'footer_logo'     => 'image|mimes:png',
  ];

}
