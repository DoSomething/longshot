<?php

class Appearance extends \Eloquent {

  protected $fillable = ['company_name', 'company_url', 'primary_color', 'secondary_color', 'button_color', 'link_color', 'header_logo', 'footer_logo'];

  protected $table = 'appearance';
}
