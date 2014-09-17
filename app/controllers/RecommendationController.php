<?php

use Scholarship\Forms\RecommendationForm;

class RecommendationController extends \BaseController {
  /**
   * @var recommendationForm
   */
  protected $recommendationForm;

  function __construct(RecommendationForm $recommendationForm)
  {
    $this->recommendationForm = $recommendationForm;
  }

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
      // If we don't have an email, it's not a valid rec
      // For cases when there are empty recs in the form.
      if ($input['email'])
      {
        $recommendation = new Recommendation;

        foreach ($input as $key => $field) {
            $recommendation->$key = $field;
        }
        $application = Auth::user()->application;
        $recommendation->application()->associate($application);
        $recommendation->save();

        $token = $recommendation->generateRecToken($recommendation);

        $this->prepareRequestEmail($application, $recommendation, $token);
      }

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
    // Make sure this person has the right token in the url.
    $correct_token = RecommendationToken::where('recommendation_id', $id)->pluck('token');
    if (isset($_GET['token']) && $_GET['token'] == $correct_token)
    {
      // @TODO: find the right scholarship
      $scholarship = Scholarship::firstOrFail();
      return View::make('recommendation.edit')->with(compact('recommendation', 'scholarship'));
    }
    else
    {
      return App::abort(403, 'Access denied');
    }
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
    $input = Input::all();
    $recommendation = Recommendation::whereId($id)->firstOrFail();
    $recommendation->rank_character = $input['rank_character'];
    $recommendation->rank_addiational = $input['rank_addiational'];
    $recommendation->essay1 = $input['essay1'];
    $recommendation->save();
    $this->prepareRecReceivedEmail($recommendation);

    return Redirect::route('home')->with('flash_message', 'Thanks, we got your recommendation!');
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



  public function prepareRequestEmail($application, $recommendation, $token)
  {
    $to = $recommendation->email;
    $from = Auth::user()->first_name .  " " . Auth::user()->last_name;
    $scholarship = Scholarship::whereId($application->scholarship_id)->firstOrFail()->pluck('title');
    $subject = $from . " would like you to to be a recommender for the " . $scholarship . " scholarship";

    $data = array(
      'to' => $to,
      'subject' => $subject,
      'applicant' => $from,
      'recommendation_id' => $recommendation->id,
      'token' => $token
    );
    Mail::send('emails.recommendation.request', $data, function($message) use ($data)
    {
      $message->to($data['to'])->subject($data['subject']);
    });
  }

  public function prepareRecReceivedEmail($recommendation)
  {
    $user = DB::table('users')
                ->join('applications', 'applications.user_id', '=', 'users.id')
                ->where('applications.id', '=', $recommendation->id)
                ->select('users.id', 'users.email', 'users.first_name')
                ->first();

    $to = $user->email;
    $from = $recommendation->first_name . " " . $recommendation->last_name;
    $subject = $from . " has completed your recommendation.";
    $data = array(
      'to' => $to,
      'from' => $from,
      'subject' => $subject,
    );

    Mail::send('emails.recommendation.received', $data, function($message) use ($data)
    {
      $message->to($data['to'])->subject($data['subject']);
    });

  }



}
