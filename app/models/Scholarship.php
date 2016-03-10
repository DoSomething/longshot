<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Scholarship extends Model
{
    protected $guarded = ['id'];

    public function application()
    {
        return $this->hasMany('Application');
    }

    public function winner()
    {
        return $this->hasMany('Winners');
    }

  /**
   * Get current scholarship collection from database.
   *
   * @return object Eloquent collection object.
   */
  public static function getCurrentScholarship()
  {
      //laravel 5
      // $path = Cache::remember('scholarships', 120, function() {
      //   return self::orderBy('application_start', 'desc')->firstOrFail();
      // });
      // $path = self::orderBy('application_start', 'desc')->firstOrFail();

    return self::orderBy('application_start', 'desc')->firstOrFail();
  }

  /**
   * Determine if the current scholarship application or nomination is closed.
   *
   * @param  $type  Check dates for either the application or the nomination period.
   *
   * @return bool - True if closed, else false.
   */
  public static function isClosed($type = 'application')
  {
      if ($type === 'application') {
          $end_date = self::getCurrentScholarship()->application_end;
      }

      if ($type === 'nomination') {
          $end_date = self::getCurrentScholarship()->nomination_end;
      }

      return date_has_expired($end_date);
  }

  /**
   * Determine if the current scholarship application or nomination is open.
   *
   * @param  $type  Check dates for either the application or the nomination period.
   *
   * @return bool - True if closed, else false.
   */
  public static function isOpen()
  {
      return date_has_expired(self::getCurrentScholarship()->application_start);
  }

  /**
   * Get all labels for a scholarship.
   *
   * @param int $id Scholarship ID.
   *
   * @return array Array of application labels.
   */
  public static function getScholarshipLabels($id)
  {
      $fields = ['label_app_accomplishments as accomplishments',
                    'label_app_activities as activities',
                    'label_app_participation as participation',
                    'label_app_essay1 as essay1',
                    'label_app_essay2 as essay2',
                    'label_rec_rank_character as rank_character',
                    'label_rec_rank_additional as rank_additional',
                    'label_rec_essay1 as rec_essay1',
                    'label_rec_optional_question as rec_optional_question',
                    ];
      return self::where('id', '=', $id)->select($fields)->first()->toArray();
  }

  /**
   * Get a past scholarship collection from database.
   *
   * @param  int $id Scholarship ID.
   *
   * @return object  Eloquent collection object.
   */
  public static function getPastScholarship($id)
  {
      // return self::whereId($id)->remember(120)->first();
      // return self::whereId($id)->first();
      // $path = Cache::remember('scholarships', 120, function() {
      //   return self::whereId($id)->first();
      // });
      $path = self::whereId($id)->first();
      return $path;
  }

  /**
   * Get year period of scholarship requested.
   *
   * @param  int $id Scholarship ID.
   *
   * @return string||bool  Year period for scholarship or FALSE if no scholarship found.
   */
  public static function getScholarshipPeriod($scholarship, $time_travel = null)
  {
      if ($scholarship) {
          return output_year_period($scholarship->application_start, $scholarship->winners_announced, $time_travel);
      }

      return false;
  }
}
