<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class SettingsForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules = [
    'company_name'             => 'alpha_num',
    'company_url'              => 'url',
    'header_logo'              => 'image|mimes:png',
    'footer_logo'              => 'image|mimes:png',
    'primary_color'            => 'alpha_num|size:6',
    'primary_color_contrast'   => 'alpha_num|size:6',
    'secondary_color'          => 'alpha_num|size:6',
    'secondary_color_contrast' => 'alpha_num|size:6',
    'cap_color'                => 'alpha_num|size:6',
    'cap_color_contrast'       => 'alpha_num|size:6',
  ];

}
