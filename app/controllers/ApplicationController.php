<?php

use Scholarship\Forms\ApplicationForm;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApplicationController extends \BaseController {

  /**
  * @var applicationForm
  */
  protected $applicationForm;

  function __construct(ApplicationForm $applicationForm)
  {
    $this->applicationForm = $applicationForm;
    $this->beforeFilter('currentUser', ['only' => ['edit', 'update']]);

    // Check that the current user doesn't create many applications
    $this->beforeFilter('startedProcess:application', ['only' => ['create']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    //
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
     //@TODO: need to figure out which scholarship is the current run.  // @TODO: do we need only certain fields?
    $scholarship = Scholarship::firstOrFail(); // ->select(['label_app_accomplishments', 'label_app_activities', 'label_app_essay1', 'label_app_essay2']);
    return View::make('application.create')->with(compact('scholarship'));
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
    if (isset($input['complete']))
    {
      $this->applicationForm->validate($input);
    }

    // @TODO: there's a better way of doing the following...
    $application = new Application;
    $application->accomplishments = Input::get('accomplishments');
    $application->gpa = Input::get('gpa');
    $application->test_type = Input::get('test_type');
    $application->test_score = Input::get('test_score');
    $application->activities = Input::get('activities');
    $application->essay1 = Input::get('essay1');
    $application->essay2 = Input::get('essay2');

    /*@TODO: for now this is just finding the first scholarship
     * this eventually needs to find the 'active' scholarship
     * that is TBD
     */
    $scholarship = Scholarship::firstOrFail();
    $application->scholarship()->associate($scholarship);

    $user->application()->save($application);

    // @TODO: this should go to the recommendation page.
    return Redirect::route('recommendation.create')->with('flash_message', 'Application information has been saved!');
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
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
   * @return Response
   */
  public function edit($id)
  {
    $user = User::whereId($id)->firstOrFail();
    $scholarship = Scholarship::firstOrFail();
    return View::make('application.edit')->with(compact('user', 'scholarship'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    // do the things. win the points.
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }


}
