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

  public static function getScholarshipLabels()
  {
    $fields = array('label_app_accomplishments as accomplishments', 'label_app_activities as activities', 'label_app_participation as participation' ,'label_app_essay1 as essay1', 'label_app_essay2 as essay2');
    return Scholarship::getCurrentScholarship()->select($fields)->first()->toArray();
  }


}
