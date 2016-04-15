<?php

use App\Models\Application;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Http\Request;
use Scholarship\Repositories\SettingRepository;

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
      $hear_about = Scholarship::getCurrentScholarship()->hear_about_options;
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
    // complete is just the word we send through if it was sumbitted (draft if saved as draft)
    // these apps are actually submitted, NOT completed (that mechanic happens when recs are submitted)
    // @TODO: we should probably standardize
    if (isset($request['complete'])) {
        $this->validate($request, $this->rules, $this->messages);
    }

    // @TODO: there's a better way of doing the following...
    $application = new Application();
      $application->accomplishments = Request::get('accomplishments');

      if (Request::get('gpa') != '') {
          $application->gpa = $request['gpa'];
      }

      if (Request::get('test_type') == 'Prefer not to submit scores') {
          $application->test_type = null;
      } else {
          $application->test_type = Request::get('test_type');
      }

      if (Request::get('test_score') != '') {
          $application->test_score = Request::get('test_score');
      } else {
          $application->test_score = null;
      }

      $application->activities = Request::get('activities');
      $application->participation = Request::get('participation');
      $application->essay1 = Request::get('essay1');
      $application->essay2 = Request::get('essay2');
      // if (isset($request['link'])) {
      //     $application->link = $request['link'];
      // }
      // $file = Request::file('file');
      // if (isset($request['file'])) {
        $file = Request::file('file');
        if (Request::hasFile('file')) {
            $filename = $user->id;
            $file->move(uploadedContentPath('uploads'), $filename);
            $application->file = 'uploads/'.$filename;
        }
      // }

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
      $hear_about = Scholarship::getCurrentScholarship()->hear_about_options;
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
        $this->validate($request, $this->rules, $this->messages);
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
          return redirect()->route('admin.application.show', $id);
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
