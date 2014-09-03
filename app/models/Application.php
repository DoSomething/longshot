<?php

class Application extends Eloquent {

  protected $fillable = ['accomplishments', 'gpa', 'test_type', 'test_score', 'activities', 'essay1', 'essay2' ];

  public function user()
  {
    return $this->belongsTo('User');
  }


  /**
   * Get the scholarship for an application
   */
  public function scholarship()
  {
    return $this->belongsTo('Scholarship');
  }


  public function recommendation()
  {
      return $this->hasMany('Recommendation');
  }



}
