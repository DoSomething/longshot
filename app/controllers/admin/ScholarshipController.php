<?php

class ScholarshipController extends \BaseController {

  /**
   * Display a listing of the resource.
   * GET /scholarship
   *
   * @return Response
   */
  public function index()
  {
    $scholarships = Scholarship::get(['id', 'title', 'description', 'amount_scholarship']);
    return View::make('admin.scholarship.index')->with(compact('scholarships'));
  }

  /**
   * Show the form for creating a new resource.
   * GET /scholarship/create
   *
   * @return Response
   */
  public function create()
  {
    return View::make('admin.scholarship.create');
  }

  /**
   * Store a newly created resource in storage.
   * POST /scholarship
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::all();

    $scholarship = new Scholarship;

    foreach ($input as $key => $field) {
      // skip form token
      if ($key !== '_token') {
        $scholarship->$key = $field;
      }
    }
    $scholarship->save();
  }

  /**
   * Display the specified resource.
   * GET /scholarship/{id}
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
   * GET /scholarship/{id}/edit
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $scholarship = Scholarship::whereId($id)->firstOrFail();
    return View::make('admin.scholarship.edit')->with(compact('scholarship'));
  }

  /**
   * Update the specified resource in storage.
   * PUT /scholarship/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $input = Input::all();
    // Must explicity get checkbox content to save as boolean, since a non-checked  box doesn't return anything from a form submit.
    $optional = Input::get('display_optional_rec_question');
    $scholarship = Scholarship::whereId($id)->firstOrFail();
    $scholarship->display_optional_rec_question = $optional;
    $scholarship->fill($input)->save();

    // Maybe this should go to scholarship/show?
    return Redirect::back()->with('flash_message', ['text' => '<strong>Success:</strong> Scholarship information has been saved!', 'class' => 'alert-success']);
  }

  /**
   * Remove the specified resource from storage.
   * DELETE /scholarship/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }

}
