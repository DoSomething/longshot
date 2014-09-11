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
    $scholarship = Scholarship::whereId($id)->firstOrFail();;
    $scholarship->fill($input)->save();
    // Maybe this should go to scholarship/show?
    return Redirect::route('admin')->with('flash_message', 'Scholarship information has been saved!');
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

  /**
   * Return the current scholarship.
   */
  public function getActiveScholarship()
  {
    // @TODO: there actually needs to be rules to return this correctly.
    return Scholarship::firstOrFail();
  }

  /**
   * Return a specific field about the scholarhisp
   *
   *
   * @param - the field that you are looking for
   *
   * @return - the right info!
   */
  public function getField($field)
  {
    // if there is a special handler get that
    // if not - grab the field from the database
    $handler = 'get_' . $field_name;
    if (function_exists($handler))
    {
      return $handler;
    }
    else
    {
      return 'the field';
    }
  }

}
