<?php

class Appearance extends \Eloquent {

  protected $fillable = ['company_name', 'company_url', 'primary_color', 'primary_color_contrast', 'secondary_color', 'secondary_color_contrast', 'cap_color', 'cap_color_contrast', 'header_logo', 'footer_logo'];

  protected $table = 'appearance';
}
