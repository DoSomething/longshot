<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class SettingsForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules = [
    // @TODO: Add regex check for alphanumeric + symbols for company_name & eligibility_text
    'company_url'              => 'url',
    'header_logo'              => 'image|mimes:png',
    'footer_logo'              => 'image|mimes:png',
    'primary_color'            => 'alpha_num|size:6',
    'primary_color_contrast'   => 'alpha_num|size:6',
    'secondary_color'          => 'alpha_num|size:6',
    'secondary_color_contrast' => 'alpha_num|size:6',
    'cap_color'                => 'alpha_num|size:6',
    'cap_color_contrast'       => 'alpha_num|size:6',
    'nominate_image'           => 'image|mimes:png,jpeg',
    'site_url'                 => 'url',
    'favicon'                  => 'mimes:ico',
    'open_graph_data_url'      => 'url',
  ];

}
