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

    // Check that the current user doesn't create many applications
    $this->beforeFilter('createdRec', ['only' => ['create']]);
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
    $num_recs = Scholarship::getCurrentScholarship()->select('num_recommendations_max', 'num_recommendations_min')->firstOrFail()->toArray();

    $help_text = Setting::getSpecifiedSettingsVars(['recommendation_create_help_text']);
    $page_vars = Setting::getPageSettingsVars();

    $vars = (object) array_merge($page_vars, $help_text);

    return View::make('recommendation.create', compact('num_recs', 'vars'));
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

    // These aren't the real rules, it's just needed to call the array validation class
    $rules = ['first_name' => 'required|TextFieldArray'];
    $data = ['first_name' => $input['rec']];
    // Calls the class that goes through and checks the real rules.
    $v = Validator::make($data, $rules);

    if ($v->fails()) {
      return  Redirect::back()->with('flash_message', ['text' => 'All fields are required.', 'class' => '-error'])->withInput();
    }
    else {
      foreach($input['rec'] as $input)
      {
        $recommendation = new Recommendation;

        foreach ($input as $key => $field) {
            $recommendation->$key = $field;
        }
        $application = Auth::user()->application;
        $recommendation->application()->associate($application);
        $recommendation->save();

        $token = $recommendation->generateRecToken($recommendation);
        $this->prepareRecRequestConfirmationEmail();
        $this->prepareRecRequestEmail($recommendation, $token);
      }
      return Redirect::route('status')->with('flash_message', ['text' => 'Your recommendation request has been submitted!', 'class' => '-success']);
    }
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
    // Make sure this person has the right token in the url.
    $correct_token = RecommendationToken::where('recommendation_id', $id)->pluck('token');

    $help_text = Setting::getSpecifiedSettingsVars(['recommendation_update_help_text']);
    $page_vars = Setting::getPageSettingsVars();

    $vars = (object) array_merge($page_vars, $help_text);

    if (isset($_GET['token']) && $_GET['token'] == $correct_token) {
      $recommendation = Recommendation::whereId($id)->firstOrFail();
      if (Recommendation::isComplete($id)) {

        $applicant_name = DB::table('users')
                              ->join('applications', 'users.id', '=', 'applications.user_id')
                              ->join('recommendations', 'applications.id', '=', 'recommendations.application_id')
                              ->where('recommendations.application_id', '=', $recommendation->application_id)
                              ->select('users.first_name', 'users.last_name')
                              ->first();

        $name = $applicant_name->first_name . ' ' . $applicant_name->last_name;
        return Redirect::route('home')->with('flash_message', ['text' => 'You already submitted your recommendation for ' . $name . '. Thanks again for your recommendation!', 'class' => '-warning']);
      }
      $scholarship = Scholarship::getCurrentScholarship();
      $rank_values = Recommendation::getRankValues();
      return View::make('recommendation.edit')->with(compact('recommendation', 'scholarship', 'rank_values', 'vars'));
    }
    // The user wants to add more recs.
    elseif (isset($_GET['app_id'])) {
      $num_recs = Scholarship::getCurrentScholarship()->select('num_recommendations_max', 'num_recommendations_min')->firstOrFail()->toArray();
      $recs = Recommendation::where('application_id', $_GET['app_id'])->get()->toArray();
      $user = Auth::user();
      return View::make('recommendation.applicant_edit')->with(compact('num_recs', 'recs', 'user', 'vars'));

    } else {
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

    // If there is a hidden applicant value on the form call different update method.
    if (isset($input['app_id'])) {
      return $this->updateUserRec($input);
    }
    $this->recommendationForm->validate($input);
    $recommendation = Recommendation::whereId($id)->firstOrFail();
    $recommendation->rank_character = $input['rank_character'];
    $recommendation->rank_additional = $input['rank_additional'];
    $recommendation->essay1 = $input['essay1'];
    $recommendation->save();
    $application = Application::whereId($recommendation->application_id)->firstOrFail();
    $application->completed = 1;
    $application->save();
    $this->prepareRecReceivedEmail($recommendation);

    return Redirect::route('home')->with('flash_message', ['text' => 'Thanks, we got your recommendation!', 'class' => '-success']);
  }

  public function updateUserRec($input)
  {
    // These aren't the real rules, it's just needed to call the array validation class
    $rules = ['first_name' => 'required|TextFieldArray'];
    $data = ['first_name' => $input['rec']];
    // Calls the class that goes through and checks the real rules.
    $v = Validator::make($data, $rules);

    if ($v->fails()) {
      return  Redirect::back()->with('flash_message', ['text' => 'All fields are required.', 'class' => '-error'])->withInput();
    } else {
      $recs = $input['rec'];
      foreach ($recs as $rec) {
        if (isset($rec['id'])) {
          $currentRec = Recommendation::whereId($rec['id'])->firstOrFail();
          $currentRec->fill($rec);
          $currentRec->save();
          $token = RecommendationToken::where('recommendation_id', $rec['id'])->pluck('token');
          $this->prepareRecRequestEmail($currentRec, $token);
        } else {
          if (!empty($rec['email'])) {
            $newRec = new Recommendation;
            $application = Auth::user()->application;
            $newRec->application()->associate($application);
            $newRec->fill($rec);
            $newRec->save();
            $token = $newRec->generateRecToken($newRec);
            $this->prepareRecRequestEmail($newRec, $token);
          }
        }
        $this->prepareRecRequestConfirmationEmail();

      }
      return Redirect::route('status')->with('flash_message', ['text' => 'We sent that email off!', 'class' => '-success']);
    }
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

  /**
   * Sends email to applicant saying the rec request has been sent.
   */
  public function prepareRecRequestConfirmationEmail()
  {
    $email = new Email;
    $email->sendEmail('request', 'applicant', Auth::user()->email);
  }
  /**
   * Sends email to recommender upon request.
   */
  public function prepareRecRequestEmail($recommendation, $token)
  {
    $link = link_to_route('recommendation.edit', "Please provide a recommendation", array($recommendation->id,'token' => $token));
    $email = new Email;
    $data = array(
      'link' => $link,
      'applicant_name' => Auth::user()->first_name .  " " . Auth::user()->last_name,
      );
    $email->sendEmail('request', 'recommender', $recommendation->email, $data);

  }

  /**
   * Sends email to applicant and recommender after the rec was completed.
   */
  public function prepareRecReceivedEmail($recommendation)
  {
    $user = DB::table('users')
                ->join('applications', 'applications.user_id', '=', 'users.id')
                ->where('applications.id', '=', $recommendation->application_id)
                ->select('users.id', 'users.email', 'users.first_name')
                ->first();

    $email = new Email;
    $data = array(
      'link' => link_to_route('status'),
      );
    $email->sendEmail('received', 'applicant', $user->email, $data);

    $email2 = new Email;
    $data2 = array(
      'completed_form' => '@TODO',
      'nominate_them' => link_to_route('home', 'Nominate them'),
      );
    $email->sendEmail('received', 'recommender', $recommendation->email, $data2);
  }



}
