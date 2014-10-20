<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class WinnerController extends \BaseController {

  public function index()
  {
    // @TODO: get winners from different years.
    $winners = DB::table('winners')
                         ->join('users', 'winners.user_id', '=', 'users.id')
                         ->get();
    return View::make('admin.winners.index', compact('winners'));
  }

  public function store()
  {
    $scholarship_id = Scholarship::getCurrentScholarship()->pluck('id');

    $user_id = Input::get('user_id');
    $winner = new Winner;
    $winner->user_id = $user_id;
    $winner->scholarship_id = $scholarship_id;

    $winner->save();
    return Redirect::back()->with('flash_message', ['text' => '<strong>Success:</strong> Awesome, we got that person as a winner for you!', 'class' => 'alert-success']);
  }

  public function update()
  {

  }

}