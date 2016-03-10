<?php

use Scholarship\Repositories\SettingRepository;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Scholarship;
use App\Models\User;

class ApplicationController extends \Controller
{
    protected $rules = [
    'accomplishments' => 'required',
    'participation'   => 'required',
    'gpa'             => 'required|numeric',
    'test_score'      => 'numeric',
    'activities'      => 'required',
    'essay1'          => 'required',
    'essay2'          => 'required',
    'link'            => 'url',
   ];

    protected $messages = [
    'accomplishments.required' => 'This question is required.',
    'participation.required'   => 'This question is required.',
    'gpa.required'             => 'GPA is required.',
    'gpa.numeric'              => 'Please enter your GPA as a number.',
    'test_score.numeric'       => 'Please enter your test score as a number.',
    'activities.required'      => 'This question is required.',
    'essay1.required'          => 'This essay is required.',
    'essay2.required'          => 'This essay is required.',
    'link.url'                 => 'Please enter a valid link.',
   ];
    protected $settings;

    public function __construct(SettingRepository $settings)
    {
        $this->middleware('currentUser', ['only' => ['edit', 'update']]);

        $this->middleware('isClosed');
        // Check that the current user doesn't create many applications
        $this->middleware('startedProcess:application', ['only' => ['create']]);
        // Users can only update their app if it hasn't been submitted.
        $this->middleware('submittedApp', ['only' => ['create', 'edit']]);

        $this->settings = $settings;
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      //@TODO: need to figure out which scholarship is the current run.
      $current_scholarship_id = Scholarship::getCurrentScholarship()->id;
      $label = Scholarship::getScholarshipLabels($current_scholarship_id);
      $hear_about = Scholarship::getCurrentScholarship()->pluck('hear_about_options');
      $choices = Application::formatChoices($hear_about);

      $vars = (object) $this->settings->getSpecifiedSettingsVars(['application_create_help_text']);

      return view('application.create')->with(compact('label', 'choices', 'vars'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $user = User::whereId(Auth::user()->id)->firstOrFail();

    // Only run validation on applications that were submitted
    // (do not run on those 'saved as draft')
    if (isset($request['complete'])) {
        $this->validate($request, $this->rules, $this->messages);
    }

    // @TODO: there's a better way of doing the following...
    $application = new Application();
      $application->accomplishments = $request['accomplishments'];

      if ($request['gpa'] != '') {
          $application->gpa = $request['gpa'];
      }

      if ($request['test_type'] == 'Prefer not to submit scores') {
          $application->test_type = null;
      } else {
          $application->test_type = $request['test_type'];
      }

      if ($request['test_score'] != '') {
          $application->test_score = $request['test_score'];
      } else {
          $application->test_score = null;
      }

      $application->activities = $request['activities'];
      $application->participation = $request['participation'];
      $application->essay1 = $request['essay1'];
      $application->essay2 = $request['essay2'];
      if (isset($request['link'])) {
          $application->link = $request['link'];
      }

      $scholarship = Scholarship::getCurrentScholarship();
      $application->scholarship()->associate($scholarship);

      $user->application()->save($application);

      return $this->redirectAfterSave($request, $user->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function show($id)
  {
      $user = User::with('application')->whereId($id)->firstOrFail();

      return view('application.show')->withUser($user);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function edit($id)
  {
      // @TODO: add a filter here to check for app complete.
      $user = User::whereId($id)->firstOrFail();
      $application = Application::getUserApplication($id);
      $label = Scholarship::getScholarshipLabels($application['scholarship_id']);
      $hear_about = Scholarship::getCurrentScholarship()->pluck('hear_about_options');
      $choices = Application::formatChoices($hear_about);

      $vars = (object) $this->settings->getSpecifiedSettingsVars(['application_create_help_text']);
      return view('application.edit')->with(compact('user', 'label', 'choices', 'vars'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function update($id, Request $request)
  { //figure out validation logic with request etc.
      $input = Input::except('documentation', 'factual', 'media_release', 'rules');

    // Only run validation on applications that were submitted
    // (do not run on those 'saved as draft')
    if (isset($request['complete'])) {
        // $input = Input::all();
        $this->validate($request, $this->rules, $this->messages);
      // @TODO: once we have validated, are we setting a 'complete' flag on the app to disable edits?
    }
      $application = Application::where('user_id', $id)->firstOrFail();
      $application->fill($input);

    // Don't save test type without a score.
    if (empty($input['test_score'])) {
        unset($application->test_type);
        unset($application->test_score);
    }
      $application->save();

      $override = null;

      if (Auth::user()->hasRole('administrator') && stripos($_SERVER['HTTP_REFERER'], 'admin')) {
          $override = 'applications.index';
      }

      return $this->redirectAfterSave($input, $id, $override);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function destroy($id)
  {
      //
  }

  public function redirectAfterSave($input, $id, $override = null)
  {
      if (isset($override)) {
          return redirect()->route($override)->with('flash_message', ['text' => 'Your profile has been updated', 'class' => '-success']);
      } elseif (isset($input['complete'])) {
          return redirect()->route('review', $id)->with('flash_message', ['text' => 'Application information has been saved!', 'class' => '-success']);
      } else {
          return redirect()->route('application.edit', $id)->with('flash_message', ['text' => 'Application information has been saved!', 'class' => '-success']);
      }
  }
}
