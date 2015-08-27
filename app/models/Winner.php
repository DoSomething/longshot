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
   * Retrieve winners data for the specified scholarship.
   *
   * @param  int $id ID of the specified scholarship.
   * @return object Object containing all the winners data for the view.
   */
  public function getWinners($id)
  {
    $cachedWinners = Cache::get('data.scholarship' . $id . '.winners', false);

    // No winner data in cache for this scholarship, so lets collect it from the DB.
    if (!$cachedWinners) {
      $selectedData = [
        'user' => function ($query) { $query->select('id', 'first_name', 'last_name'); },
        'user.profile' => function ($query) { $query->select('user_id', 'city', 'state'); },
        'user.application' => function ($query) { $query->select('user_id', 'gpa', 'participation'); },
        'scholarship' => function ($query) { $query->select('id', 'application_start', 'winners_announced'); }
      ];

      $winners = Winner::with($selectedData)->where('scholarship_id', $id)->get();

      if (count($winners) > 0) {
        foreach ($winners as $key => $winner) {
          $winner->first_name         = $winner->user['first_name'];
          $winner->last_name          = $winner->user['last_name'];
          $winner->gpa                = $winner->user->application['gpa'];
          $winner->participation      = $winner->user->application['participation'];
          $winner->state              = $winner->user->profile['state'];
          $winner->city               = $winner->user->profile['city'];
          $winner->scholarship_period = '';

          unset($winner->user);
          unset($winner->scholarship);
        }

        Cache::forever('data.scholarship' . $id . '.winners', $winners);

        return $winners;
      }
      else {
        return false;
      }
    }

    // Retrieve cached scholarship winner data.
    else {
      return $cachedWinners;
    }
  }


  /**
   * Transfer collected winner data into winners table.
   * 
   * @throws Exception If the database migration has not been run, then missing required columns.
   * @return boolean
   */
  public function transferWinners() {
    // @PseudoCode steps:
    // 
    // Confirm database structure.
    // Collect all winner data.
    // Update the winner's table with the data.
    // Exit and party.

    if (! Schema::hasColumn('winners', 'first_name')) {
      throw new Exception('Please run migration command to add new fields to the winners table in database.');
    }

    
    $scholarships = Scholarship::lists('id');
    array_unshift($scholarships, 0);

    // Still in progress... Need to lay some foundation in User model.
    return true;
  }

}
