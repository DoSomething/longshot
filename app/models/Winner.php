<?php

class Winner extends Eloquent {
  protected $guarded = ['id'];

  public $timestamps = false;

  public function scholarship()
  {
    return $this->belongsTo('Scholarship');
  }

  public function user()
  {
    return $this->belongsTp('User');
  }
}