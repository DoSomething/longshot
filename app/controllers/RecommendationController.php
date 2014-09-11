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
    $num_recs = Scholarship::whereId(1)->firstOrFail()->pluck('num_recommendations_max');
    return View::make('recommendation.create', compact('num_recs'));
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

    foreach($input['rec'] as $input)
    {
      $recommendation = new Recommendation;

      foreach ($input as $key => $field) {
          $recommendation->$key = $field;
      }
      $application = Auth::user()->application;
      $recommendation->application()->associate($application);
      $recommendation->save();

      $this->prepareEmail($application, $recommendation);
    }


    return Redirect::route('status')->with('flash_message', 'We sent that email off!');
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

  public function prepareEmail($application, $recommendation)
  {
    $to = $recommendation->email;
    $from = Auth::user()->first_name .  " " . Auth::user()->last_name;
    $scholarship = Scholarship::whereId($application->scholarship_id)->firstOrFail()->pluck('title');
    $subject = $from . " would like you to to be a recommender for the " . $scholarship . " scholarship";

    $data = array(
      'to' => $to,
      'subject' => $subject,
      'applicant' => $from,
      'recommendation_id' => $recommendation->id
    );
    Mail::send('emails.recommendation.request', $data, function($message) use ($data)
    {
      $message->to($data['to'])->subject($data['subject']);
    });
  }



}
