<?php

class Path extends \Eloquent {

  protected $fillable = [];

  public $timestamps = false;

  public function page()
  {
    return $this->belongsTo('Page');
  }

}
