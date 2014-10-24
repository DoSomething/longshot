<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class WinnerController extends \BaseController {

  public function index()
  {
    $filter_by = Request::get('filter_by');

    $query = DB::table('winners')
                         ->join('users', 'winners.user_id', '=', 'users.id');
    if ($filter_by) {
      $query->where('winners.scholarship_id', '=', $filter_by);
    }

    $winners = $query->get();

    $scholarships = Scholarship::all();
    return View::make('admin.winners.index', compact('winners', 'scholarships'));
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


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $winner = Winner::with('user')->where('user_id', $id)->firstOrFail();

    return View::make('admin.winners.edit', compact('winner'));
  }

  public function update($id)
  {
    $input = Input::except('photo');
    $winner = Winner::with('user')->where('id', $id)->firstOrFail();
    $winner->fill($input);


    $winner->save();

    return Redirect::back()->with('flash_message', ['text' => '<strong>Success:</strong> BAM, that\'s saved!', 'class' => 'alert-success']);;

  }

}