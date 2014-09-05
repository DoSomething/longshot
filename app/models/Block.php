<?php

class Block extends Eloquent {

  protected $fillable = ['block-title', 'block-description', 'block-body'];

  public function page()
  {
    return $this->belongsTo('Page');
  }

}