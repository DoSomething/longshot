<?php

class Block extends Eloquent {

  protected $fillable = ['block_title', 'block_description', 'block_body'];

  public function page()
  {
    return $this->belongsTo('Page');
  }

}
