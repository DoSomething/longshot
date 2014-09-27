<?php

class Application extends Eloquent {

  protected $fillable = ['accomplishments', 'gpa', 'test_type', 'test_score', 'activities', 'participation', 'essay1', 'essay2', 'link', 'hear_about'];

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
  public static function isComplete($id)
  {
    $optional = ['test_type', 'test_score', 'link', 'hear_about', 'complete'];
    $fields = Application::where('user_id', $id)->firstOrFail()->toArray();

    return fieldsAreComplete($fields, $optional);
  }
  // Given a user id, returns bool if all required fields are
  public static function isSubmitted($id)
  {
    $application = Application::where('user_id', $id)->select('complete')->firstOrFail();
    return $application->complete;
  }



}
