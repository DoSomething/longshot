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
    'test_score'      => 'numeric|required_if:test_type,PSAT,SAT (Out of 2400),SAT (Out of 1600),PLAN,ACT',
    'activities'      => 'required',
    'essay1'          => 'required',
    'essay2'          => 'required',
    'upload'          => 'image',
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
    'upload.image'             => 'The uploaded file must be an image.',
   ];
    protected $settings;

    public function __construct(SettingRepository $settings)
    {
        // You should be logged in to do anything with an application
        $this->middleware('currentUser');

        $this->middleware('isClosed');
        // Check that the current user doesn't create many applications
        $this->middleware('startedProcess:application', ['only' => ['create']]);
        // Users can only update their app if it hasn't been submitted.
        $this->middleware('submittedApp', ['only' => ['create', 'edit']]);

        $this->settings = $settings;
    }

  /**
   * This isn't a real route, so redirect to the homepage if someone hits it in error.
   *
   * @return Response
   */
  public function index()
  {
      return redirect()->route('home');
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
      $image_uploads = Scholarship::getCurrentScholarship()->image_uploads;
      $choices = Application::formatChoices($hear_about);
      $vars = (object) $this->settings->getSpecifiedSettingsVars(['application_create_help_text']);

      return view('application.create')->with(compact('label', 'choices', 'vars', 'image_uploads'));
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
    if ($request->input('complete')) {
        $this->validate($request, $this->rules, $this->messages);
    }

    // @TODO: there's a better way of doing the following...
    $application = new Application();
      $application->fill($request->all());

      // We aren't saving the test type without a score elsewhere
      if (!$request->has('test_score')) {
          $application->test_type = null;
          $application->test_score = null;
      }

      $upload = $request->file('upload');
      if ($request->hasFile('upload')) {
          $filename = $upload->getClientOriginalName();
          $upload->move(base_path('/storage/app/uploads/'.$user->id.'/'), $filename);
          $application->upload = $filename;
      }

      $scholarship = Scholarship::getCurrentScholarship();
      $application->scholarship()->associate($scholarship);

      $user->application()->save($application);

      return $this->redirectAfterSave($request, $user->id);
  }

  /**
   * We very rarely use show, but sometimes people hit it somehow so we should handle it.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function show($id)
  {
      // If there is an application, direct to edit, otherwise to create (edit handles making sure it is the correct user)
      if (Application::where('user_id', $id)->first()) {
          return redirect()->route('application.edit', $id);
      } else {
          return redirect()->route('application.create');
      }
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
      // Make sure the user is only seeing their own application
      if (Auth::user()->id != $id) {
          // Direct the user to show to edit or create their own application
        return redirect()->route('application.show', Auth::user()->id);
      }
      // @TODO: add a filter here to check for app complete.
      $user = User::whereId($id)->firstOrFail();
      $application = Application::getUserApplication($id);
      $label = Scholarship::getScholarshipLabels($application['scholarship_id']);
      $hear_about = Scholarship::getCurrentScholarship()->hear_about_options;
      $image_uploads = Scholarship::getCurrentScholarship()->image_uploads;
      $choices = Application::formatChoices($hear_about);

      // We have to pass uploads to the view, so set null unless there is one
      $uploads = null;
      if ($application['upload']) {
          $uploads = explode(',', $application['upload']);
      }

      $vars = (object) $this->settings->getSpecifiedSettingsVars(['application_create_help_text']);

      return view('application.edit')->with(compact('user', 'label', 'choices', 'vars', 'uploads', 'image_uploads'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function update($id, Request $request)
  {
      // @TODO: figure out validation logic with request etc.
      $input = $request->except('documentation', 'factual', 'media_release', 'rules');

    // Only run validation on applications that were submitted
    // (do not run on those 'saved as draft')
    if ($request->input('complete')) {
        $this->validate($request, $this->rules, $this->messages);
    }
      $application = Application::where('user_id', $id)->firstOrFail();
      $application->fill($input);

    // Don't save test type without a score.
    if (empty($input['test_score'])) {
        unset($application->test_type);
        unset($application->test_score);
    }

      // Add initial or additional files
      $upload = $request->file('upload');
      if ($request->hasFile('upload')) {
          $filename = $upload->getClientOriginalName();
          $upload->move(base_path('/storage/app/uploads/'.$application->user_id.'/'), $filename);

          // If there is not already a file, just throw the name in the uploads column
          if (empty($application->upload)) {
              $application->upload = $filename;
          } else {
              // If there is already a file - append to list in db
              $application->upload = $application->upload.','.$filename;
          }
      }
      // Remove deleted files
      if ($request->input('remove')) {
          // Remove file from application's list of files
          $uploads = explode(',', $application->upload);
          $uploads = array_diff($uploads, $request->input('remove'));
          $application->upload = implode(',', $uploads);

        // Delete actual files from storage
        foreach ($request->input('remove') as $deletedUpload) {
            $path = 'uploads/'.$application->user_id.'/'.$deletedUpload;
            Storage::delete($path);
        }
      }
      $application->save();

      $override = null;

      if (Auth::user()->hasRole('administrator') && stripos($_SERVER['HTTP_REFERER'], 'admin')) {
          return redirect()->route('admin.application.show', $id);
      }

      return $this->redirectAfterSave($request, $id, $override);
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
