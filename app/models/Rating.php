<?php

class Rating extends Eloquent {

  protected $fillable = ['rating'];
  public $timestamps = false;

  public function application()
  {
    return $this->belongsTo('Application');
  }



}
