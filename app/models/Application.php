<?php

class Application extends Eloquent {

  protected $fillable = [ 'accomplishments', 'gpa', 'test_type', 'test_score', 'activities', 'essay1', 'essay2' ];

  public function user()
  {
    return $this->belongsTo('User');
  }

}
