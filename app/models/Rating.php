<?php

class Rating extends Eloquent
{
    protected $fillable = ['rating'];
    public $timestamps = false;

    public function application()
    {
        return $this->belongsTo('Application');
    }

    public static function getPossibleRatings()
    {
        return ['yes', 'no', 'maybe'];
    }

  // Given an app_id returns rating, or false if application has been rated.
  public static function getApplicationRating($app_id)
  {
      $rating = self::where('application_id', $app_id)->first();
      if ($rating) {
          return $rating->rating;
      }

      return false;
  }
}
