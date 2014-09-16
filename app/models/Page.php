<?php

class Page extends \Eloquent {

  protected $fillable = ['title', 'url', 'description', 'image'];

  public function path()
  {
    return $this->hasOne('Path');
  }

  public function blocks()
  {
    return $this->hasMany('Block');
  }

  /**
   * Assign a specified path for the page.
   */
  public function assignPath($path)
  {
    return $this->path()->save($path);
  }

}
