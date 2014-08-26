<?php

class RecommendationController extends \BaseController {

  /**
   * Display a listing of the resource.
   * GET /recommendation
   *
   * @return Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   * GET /recommendation/create
   *
   * @return Response
   */
  public function create()
  {
    // This will be seen by applicants only.
    return View::make('recommendation.create');
  }

  /**
   * Store a newly created resource in storage.
   * POST /recommendation
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::all();

    $recommendation = new Recommendation;

    foreach ($input as $key => $field) {
      // skip form token
      if ($key !== '_token') {
        $recommendation->$key = $field;
      }
    }
    // @TODO: also make sure to send an email.
    $recommendation->save();

    return Redirect::route('status')->with('flash_message', 'Application information has been saved!');
  }

  /**
   * Display the specified resource.
   * GET /recommendation/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   * GET /recommendation/{id}/edit
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $recommendation = Recommendation::whereId($id)->firstOrFail();
    // @TODO: find the right scholarship
    $scholarship = Scholarship::firstOrFail();
    return View::make('recommendation.edit')->with(compact('recommendation', 'scholarship'));
  }

  /**
   * Update the specified resource in storage.
   * PUT /recommendation/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    return;
  }

  /**
   * Remove the specified resource from storage.
   * DELETE /recommendation/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }

}
