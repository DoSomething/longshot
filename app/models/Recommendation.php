<?php

class Recommendation extends \Eloquent {

  protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'relationship', 'rank_character', 'rank_addiational', 'essay1'];

  public function application()
  {
    return $this->belongsTo('Application');
  }

  public function recommendation_token()
  {
    return $this->hasOne('RecommendationToken');
  }

  public function generateRecToken($recommendation)
  {
    // is there already a token?
    $token = RecommendationToken::where('recommendation_id', $recommendation->id)->first();
    if (!isset($token['original']['token']))
    {
      // Create a new token.
      $token = new RecommendationToken;
      $token->recommendation()->associate($recommendation);
      $token->token = Hash::make(str_random(20));
      $token->save();
    }

    return $token->token;
  }

  public function isRecommendationComplete($rec)
  {
    // Set an attribute of if it's finished or not.
    if (!empty($rec->rank_character) && !empty($rec->rank_additional) && !empty($rec->essay1))
    {
      $rec->complete = 'Recommendation received!';
    }
    else
    {
      $rec->complete = 'Still waiting';
    }
  }

  // Given a rec id, returns bool if all required fields are filled out.
  public static function isComplete($id)
  {
    $fields = Recommendation::where('id', $id)->firstOrFail()->toArray();

    return fieldsAreComplete($fields, $optional = array());
  }

  public static function getRankValues()
  {
    return array(
      10   => 'Top 10%',
      25   => 'Top 25%',
      50   => 'Top 50%',
      -50  => 'Bottom 50%',
      -10  => 'Bottom 10%',
      -25  => 'Bottom 25%',
    );
  }

  public static function getUserRecs($id)
  {
    $fields = array('first_name', 'last_name', 'relationship', 'phone', 'email', 'rank_character', 'rank_additional', 'essay1 as rec_essay1');
    $recommendations = Recommendation::where('application_id', $id)->select($fields)->get();
    if ($recommendations)
      return $recommendations->toArray();
    return NULL;

  }

}
