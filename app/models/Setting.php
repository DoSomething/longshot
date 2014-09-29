<?php

class Setting extends Eloquent {

  protected $fillable = ['value', 'description'];


  /**
   * Retrieve specific settings content based on category.
   */
  public static function getContent($category)
  {
    // @TODO: try using remember() so that it Laravel will cache the query.
    return (object) Setting::whereCategory($category)->lists('value', 'key');
  }
}
