<?php

use Scholarship\Forms\ApplicationForm;
use Scholarship\Repositories\SettingRepository;

class ApplicationController extends \BaseController
{
    protected $applicationForm;

    protected $settings;

    public function __construct(ApplicationForm $applicationForm, SettingRepository $settings)
    {
        $this->applicationForm = $applicationForm;

        $this->beforeFilter('currentUser', ['only' => ['edit', 'update']]);

        $this->beforeFilter('isClosed');
    // Check that the current user doesn't create many applications
    $this->beforeFilter('startedProcess:application', ['only' => ['create']]);
    // Users can only update their app if it hasn't been submitted.
    $this->beforeFilter('submittedApp', ['only' => ['create', 'edit']]);

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

      return View::make('application.create')->with(compact('label', 'choices', 'vars'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
      $user = User::whereId(Auth::user()->id)->firstOrFail();

      $input = Input::all();

    // Only run validation on applications that were submitted
    // (do not run on those 'saved as draft')
    if (isset($input['complete'])) {
        $this->applicationForm->validate($input);
    }

    // @TODO: there's a better way of doing the following...
    $application = new Application();
      $application->accomplishments = $input['accomplishments'];

      if ($input['gpa'] != '') {
          $application->gpa = $input['gpa'];
      }

      if ($input['test_type'] == 'Prefer not to submit scores') {
          $application->test_type = null;
      } else {
          $application->test_type = $input['test_type'];
      }

      if ($input['test_score'] != '') {
          $application->test_score = $input['test_score'];
      } else {
          $application->test_score = null;
      }

      $application->activities = $input['activities'];
      $application->participation = $input['participation'];
      $application->essay1 = $input['essay1'];
      $application->essay2 = $input['essay2'];
      if (isset($input['link'])) {
          $application->link = $input['link'];
      }

      $scholarship = Scholarship::getCurrentScholarship();
      $application->scholarship()->associate($scholarship);

      $user->application()->save($application);

      return $this->redirectAfterSave($input, $user->id);
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

      return View::make('application.show')->withUser($user);
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

      return View::make('application.edit')->with(compact('user', 'label', 'choices', 'vars'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function update($id)
  {
      $input = Input::except('documentation', 'factual', 'media_release', 'rules');

    // Only run validation on applications that were submitted
    // (do not run on those 'saved as draft')
    if (isset($input['complete'])) {
        $input = Input::all();
        $this->applicationForm->validate($input);
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
            return Redirect::route($override)->with('flash_message', ['text' => 'Your profile has been updated', 'class' => '-success']);
        } elseif (isset($input['complete'])) {
            return Redirect::route('review', $id)->with('flash_message', ['text' => 'Application information has been saved!', 'class' => '-success']);
        } else {
            return Redirect::route('application.edit', $id)->with('flash_message', ['text' => 'Application information has been saved!', 'class' => '-success']);
        }
    }
}
