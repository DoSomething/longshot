<?php

class Application extends Eloquent {

  protected $fillable = ['accomplishments', 'gpa', 'test_type', 'test_score', 'activities', 'participation', 'essay1', 'essay2', 'link', 'hear_about'];

  /** Relationship definitions **/
  public function user()
  {
    return $this->belongsTo('User');
  }

  public function scholarship()
  {
    return $this->belongsTo('Scholarship');
  }


  public function recommendation()
  {
      return $this->hasMany('Recommendation');
  }

  public function rating()
  {
    return $this->hasOne('Rating');
  }

   /** End Relationships **/

  public static function formatChoices($choices)
  {
    $return = array();
    $choices = explode(',', $choices);
    foreach ($choices as $choice)
    {
      $return[$choice] = $choice;
    }
    return $return;
  }

  // Given a user id, returns bool if all required fields are
  public static function isFilledOut($id)
  {
    $optional = ['test_type', 'test_score', 'link', 'hear_about', 'completed', 'submitted'];
    $fields = Application::where('user_id', $id)->firstOrFail()->toArray();

    return fieldsAreComplete($fields, $optional);
  }
  // Given a user id, returns bool if all required fields are
  public static function isSubmitted($id)
  {
    $application = Application::where('user_id', $id)->select('submitted')->firstOrFail();
    return $application->submitted;
  }

  public static function getUserApplication($id)
  {
    $fields = array('accomplishments', 'activities', 'participation', 'essay1', 'essay2', 'hear_about as how_did_you_hear_about_this', 'link', 'test_type', 'test_score', 'gpa');
    $application = Application::where('user_id', $id)->select($fields)->first();
    if ($application)
      return $application->toArray();
    return NULL;
  }

  public static function getUserApplicationId($id)
  {
    $fields = array('id');
    return $application = Application::where('user_id', $id)->select($fields)->first();
  }


}
