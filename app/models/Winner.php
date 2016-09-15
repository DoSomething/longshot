<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Schema;

class Winner extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function scholarship()
    {
        return $this->belongsTo('App\Models\Scholarship');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

  /**
   * Retrieve winners data for the specified scholarship.
   *
   * @param  int $id ID of the specified scholarship.
   *
   * @return object Object containing all the winners data for the view.
   */
  public function getWinners($id)
  {
      $cachedWinners = Cache::get('data.scholarship'.$id.'.winners', false);

    // No winner data in cache for this scholarship, so lets collect it from the DB.
    if (!$cachedWinners) {
        $winners = self::where('scholarship_id', $id)->get();

        if (count($winners) > 0) {
            Cache::forever('data.scholarship'.$id.'.winners', $winners);

            return $winners;
        } else {
            return false;
        }
    }

    // Retrieve cached scholarship winner data.
    else {
        return $cachedWinners;
    }
  }

  /**
   * Collects all current winners and their full biographies.
   *
   * @throws Exception If the database migration has not been run, then missing required columns.
   *
   * @return object
   */
  public function collectBiosForWinners()
  {
      if (!Schema::hasColumn('winners', 'first_name')) {
          throw new Exception('Please run migration command to add new fields to the winners table in database.');
      }

      $user_ids = self::lists('user_id');

      $users = (new User())->getFullBios($user_ids);

      return $users;
  }

  /**
   * When passed a User object, sets user data to corresponding properties on Winner object.
   *
   * @param  User $user  Instance of user class with specified data.
   *
   * @return void
   */
  public function setUserData(User $user)
  {
      $this->user_id = $user->id;
      $this->scholarship_id = $user->application['scholarship_id'];
      $this->first_name = $user->first_name;
      $this->last_name = $user->last_name;
      $this->city = $user->profile['city'];
      $this->state = $user->profile['state'];
      $this->gpa = $user->application['gpa'];
      $this->participation = $user->application['participation'];
  }
}
