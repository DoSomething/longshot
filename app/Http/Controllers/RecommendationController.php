<?php

use App\Models\Application;
use App\Models\Email;
use App\Models\Recommendation;
use App\Models\RecommendationToken;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Http\Request;
use Scholarship\Repositories\SettingRepository;

class RecommendationController extends \Controller
{
    protected $settings;

    protected $rules = [
      'first_name'      => 'required',
      'last_name'       => 'required',
      'phone'           => 'numeric|required',
      'email'           => 'email|required',
    ];

    protected $recommender_rules = [
      'rank_character'  => 'required',
      'rank_additional' => 'required',
      'essay1'          => 'required',
    ];

    protected $applicant_rules = [
      'relationship'    => 'required',
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
  public function store(Request $request)
  {
      $request = $request->all();
      $recs = $request['rec'];
      $rules = array_merge($this->rules, $this->applicant_rules);
      $errors = [];

      // Go through each rec and collect the validation errors
      foreach ($recs as $key => $rec) {
          // Only try to validate and fill in recs that have any part of the form filled out
        if (array_filter($rec)) {
            $v = Validator::make($rec, $rules);

            if ($v->fails()) {
                $errors[$key] = $v->errors()->all();
            }
        }
      }

      // If there are any errors in the form, keep the data in the form and display the errors. Do not save any recs until there are no errors in the form
      if ($errors !== []) {
          $errorMessage = $this->formatErrors($errors);
          return redirect()->back()->withInput()->with('flash_message', ['text' => 'There is an error in your submission.<br>'. $errorMessage, 'class' => '-error']);
      } else {
          // Once there are no errors, go through the filled in rec forms and create the recs
          foreach ($recs as $key => $rec) {
              if (array_filter($rec)) {

                $recommendation = new Recommendation();
                $recommendation->fill($rec);

                $application = Auth::user()->application;
                $recommendation->application()->associate($application);
                $recommendation->save();

                $token = $recommendation->generateRecToken($recommendation);
                $this->prepareRecRequestConfirmationEmail($recommendation);
                $this->prepareRecRequestEmail($recommendation, $token);
            }
          }
      }

      return redirect()->route('status')->with('flash_message', ['text' => 'Your recommendation request has been submitted!', 'class' => '-success']);
  }

  /**
   * Formats validation errors from the rec request form and returns a formatted string.
   *
   * @param  array  $errors
   *
   * @return string $formatted
   */
  public function formatErrors($errors)
  {
      $formatted = '';

      foreach ($errors as $recNumber=>$errorArray) {
          $formatted .= 'Recommendation # ' . ($recNumber + 1) . ': <br>';
          $formatted .= '<ul>';
          foreach ($errorArray as $error) {
              $formatted .= '<li>' . $error . '</li>';
          }
          $formatted .= '</ul>';
      }

      return $formatted;
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
      $correct_token = RecommendationToken::where('recommendation_id', $id)->value('token');

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
          $rank_values = Recommendation::getRankValues();
          $scholarship = Scholarship::getCurrentScholarship();

          return view('recommendation.edit')->with(compact('recommendation', 'scholarship', 'rank_values', 'vars'));
      }
      // The user wants to add more recs.
      elseif (isset($_GET['app_id'])) {
          $rec_min = Scholarship::getCurrentScholarship()->num_recommendations_min;
          $rec_max = Scholarship::getCurrentScholarship()->num_recommendations_max;
          $num_recs = ['num_recommendations_max' => $rec_max, 'num_recommendations_min' => $rec_min];
          $recs = Recommendation::where('application_id', $_GET['app_id'])->get();
          $complete_recs = [];
          foreach ($recs as $rec) {
              if (Recommendation::isComplete($rec['id'])) {
                  array_push($complete_recs, $rec['id']);
              }
          }
          $user = Auth::user();

          return view('recommendation.applicant_edit')->with(compact('num_recs', 'recs', 'user', 'vars', 'complete_recs'));
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
      // Hidden field to determine if the applicant is making the update
    if (isset($request['app_id'])) {
        return $this->updateUserRec($request->all());
    }

    // Hidden field to determine if an admin is making the update
    if (isset($request['rec_id'])) {
        return $this->updateAdmin($request->all());
    }

    // Else, the recommender is the one making the update
    $rules = array_merge($this->rules, $this->recommender_rules);
      $this->validate($request, $rules, $this->messages);
      $recommendation = Recommendation::whereId($id)->firstOrFail();
      $recommendation->fill($request->all())->save();
      $application = Application::whereId($recommendation->application_id)->firstOrFail();
      // We should only be marking the app as complete if they have the minimum number of recommendations
      $recs_have = $recommendation->numRecsForApp($recommendation->application_id);
      $recs_need = Scholarship::getCurrentScholarship()->num_recommendations_min;
      if ($recs_have >= $recs_need) {
          $application->completed = 1;
      }
      $application->save();
      $this->prepareRecReceivedEmail($recommendation);

      return redirect()->route('home')->with('flash_message', ['text' => 'Thanks, we got your recommendation!', 'class' => '-success']);
  }

    public function updateAdmin($input)
    {
        $recommendation = Recommendation::whereId($input['rec_id'])->firstOrFail();
        $input['essay1'] = $input['rec_essay1'];
        $recommendation->fill($input)->save();
        // need to get ID of user associated with the rec
        $user_id = Application::whereId($recommendation->application_id)->firstOrFail()->user_id;

        return redirect()->route('admin.application.show', $user_id);
    }

    public function updateUserRec($input)
    {
        $recs = $input['rec'];
        $rules = array_merge($this->rules, $this->applicant_rules);
        $errors = [];
        foreach ($recs as $key => $rec) {
            // If rec already exists, update existing rec
          if (isset($rec['id'])) {
              // Do not validate completed recs
            if (!Recommendation::isComplete($rec['id'])) {
                $v = Validator::make($rec, $rules);
                // Collect validation errors
                if ($v->fails()) {
                    $errors[$key] = $v->errors()->all();
                }
            }
            // Display errors to user if there are any
            if ($errors !== []) {
                $errorMessage = $this->formatErrors($errors);
                return redirect()->back()->withInput()->with('flash_message', ['text' => 'There is an error in your submission.<br>'. $errorMessage, 'class' => '-error']);
            } else {
                // Update the rec if there are no errors
              $currentRec = Recommendation::whereId($rec['id'])->firstOrFail();
                $currentRec->fill($rec);
              // Only resend and email to the recommender if the email address was changed
              if ($currentRec->isDirty('email')) {
                  $token = RecommendationToken::where('recommendation_id', $rec['id'])->pluck('token');
                  $this->prepareRecRequestEmail($currentRec, $token);
                  $this->prepareRecRequestConfirmationEmail($currentRec);
              }
              $currentRec->save();
            }
          } else {
              // True if any fields are filled in
              if (array_filter($rec)) {
                  $v = Validator::make($rec, $rules);
                  // Collect validation errors
                  if ($v->fails()) {
                      $errors[$key] = $v->errors()->all();
                  }
                  // Display errors to the user
                  if ($errors !== []) {
                      $errorMessage = $this->formatErrors($errors);
                      return redirect()->back()->withInput()->with('flash_message', ['text' => 'There is an error in your submission.<br>'. $errorMessage, 'class' => '-error']);
                  } else {
                      // If no errors, save the new rec
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
        }

        return redirect()->route('status')->with('flash_message', ['text' => 'Everything updated!', 'class' => '-success']);
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
