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

  public static function getLastYearWinners()
  {
    $old_id = Scholarship::getCurrentScholarship()->pluck('id') - 1;
    $winners = Winner::rememberForever()->with('user')->where('scholarship_id', $old_id)->get();
    foreach ($winners as $key => $winner) {
      $winner->location = Profile::rememberForever()->where('user_id', $winner->user->id)->select('city', 'state')->get();
      $winner->gpa = Application::rememberForever()->where('user_id', $winner->user->id)->pluck('gpa');
    }
    return $winners;
  }
}
