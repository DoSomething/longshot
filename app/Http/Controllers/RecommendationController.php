<?php

use App\Models\Application;
use App\Models\Email;
use App\Models\Recommendation;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Http\Request;
use Scholarship\Repositories\SettingRepository;

class RecommendationController extends \Controller
{
    protected $settings;

    protected $rules = [
    'rank_character'  => 'required',
    'rank_additional' => 'required',
    'essay1'          => 'required',
    ];

    protected $messages = [
    'essay1.required'  => 'Please answer this question.',
    ];

    public function __construct(SettingRepository $settings)
    {
        $this->settings = $settings;

        $this->middleware('isClosed');
      // Check that the current user doesn't create many applications
      $this->middleware('createdRec', ['only' => ['create']]);

      // check that the user is logged in before allowing them to create a recommendation
      $this->middleware('auth', ['only' => 'create']);
    }

  /**
   * Show the form for creating a new resource.
   * GET /recommendation/create.
   *
   * @return Response
   */
  public function create()
  {
      // This will be seen by applicants only.
    // $num_recs = Scholarship::getCurrentScholarship()->select('num_recommendations_max', 'num_recommendations_min')->firstOrFail()->toArray();
    // @TODO: is there a better way to do this? using select pulls from all scholarships
    $rec_min = Scholarship::getCurrentScholarship()->num_recommendations_min;
      $rec_max = Scholarship::getCurrentScholarship()->num_recommendations_max;
      $num_recs = ['num_recommendations_max' => $rec_max, 'num_recommendations_min' => $rec_min];
      $vars = (object) $this->settings->getSpecifiedSettingsVars(['recommendation_create_help_text']);

      return view('recommendation.create', compact('num_recs', 'vars'));
  }

  /**
   * Store a newly created resource in storage.
   * POST /recommendation.
   *
   * @return Response
   */
  public function store()
  {
      $input = Input::all();

      // These aren't the real rules, it's just needed to call the array validation class
      $rules = ['first_name' => 'required'];
      $data = ['first_name' => $input['rec']];
      // Calls the class that goes through and checks the real rules.
      $v = Validator::make($data, $rules);

      if ($v->fails()) {
          return  redirect()->back()->with('flash_message', ['text' => 'All fields are required.', 'class' => '-error'])->withInput();
      } else {
          foreach ($input['rec'] as $input) {
              if (!empty($input['email'])) {
                  $recommendation = new Recommendation();

                  foreach ($input as $key => $field) {
                      $recommendation->$key = $field;
                  }
                  $application = Auth::user()->application;
                  $recommendation->application()->associate($application);
                  $recommendation->save();

                  $token = $recommendation->generateRecToken($recommendation);
                  $this->prepareRecRequestConfirmationEmail($recommendation);
                  $this->prepareRecRequestEmail($recommendation, $token);
              }
          }

          return redirect()->route('status')->with('flash_message', ['text' => 'Your recommendation request has been submitted!', 'class' => '-success']);
      }
  }

  /**
   * Display the specified resource.
   * GET /recommendation/{id}.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   * GET /recommendation/{id}/edit.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function edit($id)
  {
      // Make sure this person has the right token in the url.
    $correct_token = RecommendationToken::where('recommendation_id', $id)->pluck('token');

      $vars = (object) $this->settings->getSpecifiedSettingsVars(['recommendation_update_help_text']);

      if (isset($_GET['token']) && $_GET['token'] == $correct_token) {
          $recommendation = Recommendation::whereId($id)->firstOrFail();
          if (Recommendation::isComplete($id)) {
              $applicant_name = DB::table('users')
                              ->join('applications', 'users.id', '=', 'applications.user_id')
                              ->join('recommendations', 'applications.id', '=', 'recommendations.application_id')
                              ->where('recommendations.application_id', '=', $recommendation->application_id)
                              ->select('users.first_name', 'users.last_name')
                              ->first();

              $name = $applicant_name->first_name.' '.$applicant_name->last_name;

              return redirect()->route('home')->with('flash_message', ['text' => 'You already submitted your recommendation for '.$name.'. Thanks again for your recommendation!', 'class' => '-warning']);
          }
          $scholarship = Scholarship::getCurrentScholarship();
          $rank_values = Recommendation::getRankValues();

          return view('recommendation.edit')->with(compact('recommendation', 'scholarship', 'rank_values', 'vars'));
      }
    // The user wants to add more recs.
    elseif (isset($_GET['app_id'])) {
        $num_recs = Scholarship::getCurrentScholarship()->select('num_recommendations_max', 'num_recommendations_min')->firstOrFail()->toArray();
        $recs = Recommendation::where('application_id', $_GET['app_id'])->get()->toArray();
        $user = Auth::user();

        return view('recommendation.applicant_edit')->with(compact('num_recs', 'recs', 'user', 'vars'));
    } else {
        return App::abort(403, 'Access denied');
    }
  }

  /**
   * Update the specified resource in storage.
   * PUT /recommendation/{id}.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function update($id, Request $request)
  {
      // $input = Input::all();

    // If there is a hidden applicant value on the form call different update method.
    if (isset($request['app_id'])) {
        return $this->updateUserRec($request);
    }

      if (isset($input['rec_id'])) {
          return $this->updateAdmin($input);
      }

      $this->validate($request);
      $recommendation = Recommendation::whereId($id)->firstOrFail();
      $recommendation->fill($input)->save();
      $application = Application::whereId($recommendation->application_id)->firstOrFail();
      $application->completed = 1;
      $application->save();
      $this->prepareRecReceivedEmail($recommendation);

      return redirect()->route('home')->with('flash_message', ['text' => 'Thanks, we got your recommendation!', 'class' => '-success']);
  }

    public function updateAdmin($input)
    {
        $recommendation = Recommendation::whereId($input['rec_id'])->firstOrFail();
        $input['essay1'] = $input['rec_essay1'];
        $recommendation->fill($input)->save();
    //Redirect::back()->with('flash_message', ['text' => 'updated.', 'class' => '-success']);
    return redirect()->route('applications.index');
    }

    public function updateUserRec($input)
    {
        // These aren't the real rules, it's just needed to call the array validation class
    $rules = ['first_name' => 'required|TextFieldArray'];
        $data = ['first_name' => $input['rec']];
    // Calls the class that goes through and checks the real rules.
    $v = Validator::make($data, $rules);

        if ($v->fails()) {
            return  redirect()->back()->with('flash_message', ['text' => 'All fields are required.', 'class' => '-error'])->withInput();
        } else {
            $recs = $input['rec'];
            foreach ($recs as $rec) {
                if (isset($rec['id'])) {
                    $currentRec = Recommendation::whereId($rec['id'])->firstOrFail();
                    $currentRec->fill($rec);
                    $currentRec->save();
                    $token = RecommendationToken::where('recommendation_id', $rec['id'])->pluck('token');
                    $this->prepareRecRequestEmail($currentRec, $token);
                    $this->prepareRecRequestConfirmationEmail($currentRec);
                } else {
                    if (!empty($rec['email'])) {
                        $newRec = new Recommendation();
                        $application = Auth::user()->application;
                        $newRec->application()->associate($application);
                        $newRec->fill($rec);
                        $newRec->save();
                        $token = $newRec->generateRecToken($newRec);
                        $this->prepareRecRequestConfirmationEmail($newRec);
                        $this->prepareRecRequestEmail($newRec, $token);
                    }
                }
            }

            return redirect()->route('status')->with('flash_message', ['text' => 'We sent that email off!', 'class' => '-success']);
        }
    }

  /**
   * Sends email to applicant saying the rec request has been sent.
   */
  public function prepareRecRequestConfirmationEmail($recommendation)
  {
      $data = [
      'rec_name' => $recommendation->first_name.' '.$recommendation->last_name,
      ];
      $email = new Email();
      $email->sendEmail('request', 'applicant', Auth::user()->email, $data);
  }

  /**
   * Sends email to recommender upon request.
   */
  public function prepareRecRequestEmail($recommendation, $token)
  {
      $link = link_to_route('recommendation.edit', 'Please provide a recommendation', [$recommendation->id, 'token' => $token]);
      $email = new Email();
      $data = [
      'link'           => $link,
      'applicant_name' => Auth::user()->first_name.' '.Auth::user()->last_name,
      ];
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

      $email = new Email();
      $data = [
      'link' => link_to_route('status'),
      ];
      $email->sendEmail('received', 'applicant', $user->email, $data);

      $email2 = new Email();
      $data2 = [
      'completed_form' => '@TODO',
      'nominate_them'  => link_to_route('home', 'Nominate them'),
      ];
      $email->sendEmail('received', 'recommender', $recommendation->email, $data2);
  }
}
