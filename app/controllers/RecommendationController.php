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
    //
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
    //
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
