<?php

class Profile extends Eloquent {

  protected $fillable = [ 'birthdate', 'phone', 'address_street', 'address_premise', 'city', 'state', 'zip', 'gender', 'race', 'school', 'grade' ];

  public function user()
  {
    return $this->belongsTo('User');
  }

}
