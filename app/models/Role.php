<?php

class Role extends Eloquent {

  protected $fillable = ['name'];

  public $timestamps = false;


  /**
   * Get the Users of a specific Role.
   * @return object
   */
  public function users()
  {
    return $this->belongsToMany('User');
  }
}
