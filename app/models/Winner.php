<?php

class Winner extends Eloquent {
  protected $guarded = ['id'];

  public $timestamps = false;


  public function scholarship()
  {
    return $this->belongsTo('Scholarship');
  }


  public function user()
  {
    return $this->belongsTo('User');
  }


  /**
   * Retrieve the latest winners for the specified scholarship.
   *
   * @param  object $scholarship Scholarship object.
   * @return object Object containing all the winners data for the view.
   */
  public function getLatest($scholarship)
  {
    if (date_has_expired($scholarship->winners_announced)) {
      return $this->getWinnerData($scholarship->id);
    }
    else {
      return $this->getWinnerData(($scholarship->id - 1));
    }
  }


  /**
   * Retrieve winners data for the specified scholarship.
   *
   * @param  int $id ID of the specified scholarship.
   * @return object Object containing all the winners data for the view.
   */
  private function getWinnerData($id)
  {
    $cachedWinners = Cache::get('data.scholarship' . $id . '.winners', false);

    // No winner data in cache for this scholarship, so lets collect it from the DB.
    if (!$cachedWinners) {
      $selectedData = [
        'user' => function ($query) { $query->select('id', 'first_name', 'last_name'); },
        'user.profile' => function ($query) { $query->select('user_id', 'city', 'state'); },
        'user.application' => function ($query) { $query->select('user_id', 'gpa', 'participation'); }
      ];

      $winners = Winner::with($selectedData)->where('scholarship_id', $id)->get();

      if (count($winners) > 0) {
        foreach ($winners as $key => $winner) {
          $winner->first_name    = $winner->user['first_name'];
          $winner->last_name     = $winner->user['last_name'];
          $winner->gpa           = $winner->user->application['gpa'];
          $winner->participation = $winner->user->application['participation'];
          $winner->state         = $winner->user->profile['state'];
          $winner->city          = $winner->user->profile['city'];

          unset($winner->user);
        }
      }

      Cache::forever('data.scholarship' . $id . '.winners', $winners);

      return $winners;
    }

    // Retrieve cached scholarship winner data.
    else {
      return $cachedWinners;
    }
  }

}
