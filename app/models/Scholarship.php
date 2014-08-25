<?php

class Scholarship extends \Eloquent {
  
  protected $fillable = ['title', 'description', 'amount_scholarship', 'application_start', 'application_end', 'winners_announced',
  'age_min', 'age_max', 'num_recommendations_min', 'num_recommendations_max', 'gpa_min', 'label_app_accomplishments',
  'label_app_activities', 'label_app_essay1', 'label_app_essay2', 'label_rec_rank_character', 'label_rec_rank_additional', 'label_rec_essay1'];

  // Needed to ensure the table name can be singular!
  protected $table = 'scholarship';

  public function application()
  {
    return $this->hasMany('Applications');
  }

}
