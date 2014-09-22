<?php

class Scholarship extends \Eloquent {

  protected $guarded = ['id'];

  public function application()
  {
    return $this->hasMany('Application');
  }

  public static function getCurrentScholarship()
  {
    // @TODO: this needs to be updated.
    return Scholarship::firstOrFail();
  }


}
