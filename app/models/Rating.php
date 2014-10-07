<?php

class Rating extends Eloquent {

  protected $fillable = ['rating'];

  public function application()
  {
    return $this->hasOne('Application');
  }



}
