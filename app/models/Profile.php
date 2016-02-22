<?php

class Profile extends Eloquent
{
    protected $fillable = ['birthdate', 'phone', 'address_street', 'address_premise', 'city', 'state', 'zip', 'gender', 'race', 'school', 'grade'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function race()
    {
        return $this->hasMany('Race');
    }

    public function setBirthdateAttribute($birthdate)
    {
        $this->attributes['birthdate'] = date('Y-m-d', (strtotime($birthdate)));
    }

  /*
   * List of all US states
   * this could probably be done in a better way.
   */
  public static function getStates()
  {
      $states = [
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District Of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
            'AS' => 'American Samoa',
            'GU' => 'Guam',
            'MP' => 'Northern Mariana Islands',
            'PR' => 'Puerto Rico',
            'VI' => 'Virgin Islands',
            ];

      return $states;
  }

    public static function getRaces()
    {
        $races = [
          'White',
          'Black/African American',
          'Hispanic/Latino/Spanish',
          'Asian',
          'American Indian or Alaska Native',
          'Pacific Islander/Native Hawaiian',
          'Other',
          ];

        return $races;
    }

 // Given a user id, returns bool if all required fields are set.
  public static function isComplete($id)
  {
      $optional = ['address_premise'];
      $fields = self::where('user_id', $id)->firstOrFail()->toArray();

      return fieldsAreComplete($fields, $optional);
  }

  /**
   * @param - int - id
   *  the user ID
   *
   * @return - array - profile
   *  the profile for a user formatted as an array with pretty titles.
   */
  public static function getUserProfile($id)
  {
      $fields = ['birthdate', 'phone', 'address_street as address_1', 'address_premise as address_2', 'city', 'state', 'zip as zip_code', 'gender', 'grade', 'school as current_high_school'];
      if (self::where('user_id', '=', $id)->exists()) {
          return $profile = self::where('user_id', $id)->select($fields)->first()->toArray();
      }

      return;
  }

    public static function getUserProfileId($id)
    {
        return self::where('user_id', $id)->pluck('id');
    }

    public static function getUserRace($id)
    {
        $races = Race::where('profile_id', $id)->select('race')->get()->toArray();

        return $races;
    }
}
