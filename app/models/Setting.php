<?php

class Setting extends Eloquent {

  protected $fillable = ['value', 'description'];


  /**
   * Retrieve specific settings content based on category.
   */
  public static function getSettingsVariables($category)
  {
    return (object) Setting::rememberForever('query.setting.' . $category)->whereCategory($category)->lists('value', 'key');
  }
}
