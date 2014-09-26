<?php

class Recommendation extends \Eloquent {

  protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'rank_character', 'rank_addiational', 'essay1'];

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
    }

    $token->token = Hash::make(str_random(20));
    $token->save();

    return $token->token;
  }

  public function isRecommendationComplete($rec)
  {
    // Set an attribute of if it's finished or not.
    if (!empty($rec->rank_character) && !empty($rec->rank_additional) && !empty($rec->essay1))
    {
      $rec->complete = 'All set!';
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
      -10  => 'Bottom 10%',
      -25  => 'Bottom 25%',
    );
  }


}
