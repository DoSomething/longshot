<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'relationship', 'rank_character', 'rank_additional', 'essay1', 'optional_question'];

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }

    public function recommendation_token()
    {
        return $this->hasOne('App\Models\RecommendationToken');
    }

    public function generateRecToken($recommendation)
    {
        // is there already a token?
        $token = RecommendationToken::where('recommendation_id', $recommendation->id)->first();
        if (! isset($token['original']['token'])) {
            // Create a new token.
            $token = new RecommendationToken();
            $token->recommendation()->associate($recommendation);
            $token->token = Hash::make(str_random(20));
            $token->save();
        }

        return $token->token;
    }

    public function isRecommendationComplete($rec)
    {
        // Set an attribute of if it's finished or not.
        if (! empty($rec->rank_character) && ! empty($rec->rank_additional) && ! empty($rec->essay1)) {
            $rec->complete = 'Recommendation received!';
        } else {
            $rec->complete = 'Still waiting';
        }
    }

    public function numRecsForApp($app_id)
    {
        $recs = self::where('application_id', $app_id)->get();

        return count($recs);
    }

    // Given a rec id, returns bool if all required fields are filled out.
    public static function isComplete($id)
    {
        $optional = ['optional_question'];
        $fields = self::where('id', $id)->firstOrFail()->toArray();

        return fieldsAreComplete($fields, $optional);
    }

    public static function getRankValues()
    {
        return [
      10   => 'Top 10%',
      25   => 'Top 25%',
      50   => 'Top 50%',
      -50  => 'Bottom 50%',
      -10  => 'Bottom 10%',
      -25  => 'Bottom 25%',
    ];
    }

    public static function getUserRecs($id)
    {
        $fields = ['id',
                    'first_name',
                    'last_name',
                    'relationship',
                    'phone',
                    'email',
                    'rank_character',
                    'rank_additional',
                    'essay1 as rec_essay1',
                    'optional_question as rec_optional_question',
                    ];
        $recommendations = self::where('application_id', $id)->select($fields)->get();

        if ($recommendations) {
            $recommendations_array = [];

            foreach ($recommendations as $recommendation) {
                $recommendation_token = $recommendation->generateRecToken($recommendation);

                $recommendation = $recommendation->toArray();
                $recommendation['recommendation_link'] = link_to_route('recommendation.edit', 'Recommendation Link', [$recommendation['id'], 'token' => $recommendation_token]);
                array_push($recommendations_array, $recommendation);
            }

            return $recommendations_array;
        }
    }
}
