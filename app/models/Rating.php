<?php

class Rating extends Eloquent {

  protected $fillable = ['rating'];
  public $timestamps = false;

  public function application()
  {
    return $this->belongsTo('Application');
  }

  // Given an app_id returns bool if application has been rated.
  public static function applicationHasRating($app_id)
  {
    $rating = Rating::where('application_id', $app_id)->first();
    if ($rating) {
      return TRUE;
    }
    return FALSE;
  }


}
