<?php

class Application extends Eloquent {

  protected $fillable = ['accomplishments', 'gpa', 'test_type', 'test_score', 'activities', 'essay1', 'essay2', 'link', 'hear_about'];

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
    $optional = ['test_type', 'test_score', 'link', 'hear_about'];

    $fields = Application::where('user_id', $id)->firstOrFail()->toArray();

    // Are all fields filled out?
    $empty_fields = array();
    foreach ($fields as $key => $field)
    {
      if (empty($field) && !in_array($key, $optional)) {
         $empty_fields[$key] = $field;
      }
    }
    if (!is_null($empty_fields)) {
      return FALSE;
    }
    return TRUE;
  }



}
