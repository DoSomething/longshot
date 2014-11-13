<?php

class Scholarship extends \Eloquent {

  protected $guarded = ['id'];

  // private $past_period = NULL;

  public function application()
  {
    return $this->hasMany('Application');
  }

  public function winner()
  {
    return $this->hasMany('Winners');
  }


  /**
   * Get current scholarship collection from database.
   * @return object Eloquent collection object.
   */
  public static function getCurrentScholarship()
  {
    return Scholarship::orderBy('application_start', 'desc')->remember(120)->firstOrFail();
  }


  /**
   * Get all labels for a scholarship.
   */
  public static function getScholarshipLabels()
  {
    $fields = array('label_app_accomplishments as accomplishments', 'label_app_activities as activities', 'label_app_participation as participation' ,'label_app_essay1 as essay1', 'label_app_essay2 as essay2', 'label_rec_rank_character as rank_character', 'label_rec_rank_additional as rank_additional', 'label_rec_essay1 as rec_essay1');
    return Scholarship::getCurrentScholarship()->select($fields)->first()->toArray();
  }


  /**
   * Get a past scholarship collection from database.
   * @param  integer $id Scholarship ID.
   * @return object  Eloquent collection object.
   */
  public static function getPastScholarship($id)
  {
    return Scholarship::whereId($id)->remember(120)->first();
  }


  /**
   * Get past year period of scholarship requested.
   * @param  integer $id Scholarship ID.
   * @return string||boolean  Year period for scholarship or FALSE if no scholarship found.
   */
  public static function getPastScholarshipPeriod($id)
  {
    $past_scholarship = static::getPastScholarship($id);

    if ($past_scholarship) {
      return output_year_period($past_scholarship->application_start, $past_scholarship->winners_announced);
    }

    return false;
  }

}
