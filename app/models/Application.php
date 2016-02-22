<?php

class Application extends Eloquent
{
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
      $return = [];
      $choices = explode(',', $choices);
      foreach ($choices as $choice) {
          $return[$choice] = $choice;
      }

      return $return;
  }

  // Given a user id, returns bool if all required fields are
  public static function isFilledOut($id)
  {
      $optional = ['test_score', 'link', 'hear_about', 'completed', 'submitted'];
      $fields = self::where('user_id', $id)->firstOrFail()->toArray();

      return fieldsAreComplete($fields, $optional);
  }

  // Given a user id, returns bool if all required fields are
  public static function isSubmitted($user_id)
  {
      $application = self::where('user_id', $user_id)->select('submitted')->first();

      if ($application) {
          return $application->submitted;
      }

      return false;
  }

  // Given an application id returns if app is submitted & complete
  public static function isComplete($app_id)
  {
      $application = self::where('id', $app_id)->select('submitted', 'completed')->firstOrFail();
      if ($application->submitted && $application->completed) {
          return true;
      }

      return false;
  }

    public static function getUserApplication($id)
    {
        $fields = ['scholarship_id', 'accomplishments', 'activities', 'participation', 'essay1', 'essay2', 'hear_about as how_did_you_hear_about_this', 'link', 'test_type', 'test_score', 'gpa'];
        $application = self::where('user_id', $id)->select($fields)->first();
        if ($application) {
            return $application->toArray();
        }

        return;
    }

    public static function getUserApplicationId($id)
    {
        $fields = ['id'];

        return $application = self::where('user_id', $id)->select($fields)->first();
    }
}
