<?php

class AdminController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $count = array();
    $user = Auth::user();
    $count['users'] =  $query = DB::table('users')
                                  ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                                  ->whereNull('role_user.role_id')
                                  ->count();

    $count['apps'] = Application::leftJoin('role_user', 'applications.user_id', '=', 'role_user.user_id')
                                  ->whereNull('role_user.role_id')
                                  ->count();
    $count['noms'] = Nomination::count();
    $unique = DB::select("SELECT COUNT(DISTINCT (nom_email)) as count FROM nominations");
    $count['unique_noms'] = $unique[0]->count;
    $unique = DB::select("SELECT COUNT(DISTINCT (rec_email)) as count FROM nominations");
    $count['unique_recs'] = $unique[0]->count;
    $count['submitted_apps'] = Application::where('submitted', '=', 1)
                                            ->leftJoin('role_user', 'applications.user_id', '=', 'role_user.user_id')
                                            ->whereNull('role_user.role_id')
                                            ->count();
    $count['completed_apps'] = Application::where('submitted', '=', 1)
                                            ->where('completed', '=', 1)
                                            ->leftJoin('role_user', 'applications.user_id', '=', 'role_user.user_id')
                                            ->whereNull('role_user.role_id')
                                            ->count();

    // @TODO: combime these two, the is null and is not null will not bind as a variable. :(
    $base_rec_null_query = 'SELECT count(*) as total FROM (
                        SELECT count(*) as c
                        FROM recommendations r
                        INNER JOIN applications a on a.id = r.application_id
                        LEFT JOIN role_user ru on a.user_id = ru.user_id
                        WHERE r.rank_additional is null
                        AND ru.role_id is null
                        AND a.submitted = 1
                        GROUP BY r.application_id
                        HAVING c = :count
                      ) T ;';

    $base_rec_complete_query = 'SELECT count(*) as total FROM (
                        SELECT count(*) as count
                        FROM recommendations r
                        INNER JOIN applications a on a.id = r.application_id
                        LEFT JOIN role_user ru on a.user_id = ru.user_id
                        WHERE r.rank_additional is not null
                        AND ru.role_id is null
                        AND a.submitted = 1
                        GROUP BY r.application_id
                        HAVING count = :count
                      ) T ;';

    $requested_one = DB::select($base_rec_null_query, array('count' => 1));
    $requested_two = DB::select($base_rec_null_query, array('count' => 2));

    $submitted_one = DB::select($base_rec_complete_query, array('count' => 1));
    $submitted_two = DB::select($base_rec_complete_query, array('count' => 2));

    $count['requested_one'] = $requested_one[0]->total;
    $count['requested_two'] = $requested_two[0]->total;
    $count['submitted_one'] = $submitted_one[0]->total;
    $count['submitted_two'] = $submitted_two[0]->total;

    return View::make('admin.index', compact('user', 'count'));
  }


  /**
   *
   */
  public function applicationsIndex()
  {
    $sort_by = Request::get('sort_by');
    $filter_by = Request::get('filter_by');
    $direction = Request::get('direction');

    $query = DB::table('users');

    $query = $this->applicantBaseQuery($query);
    $query->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                  ->whereNull('role_user.role_id');

    if ($sort_by) {
      $query->orderBy($sort_by, $direction);
    }
    if ($filter_by) {
      switch ($filter_by) {
        case 'submitted':
            $query->where('applications.submitted', '=', 1)
                  ->where('applications.completed', '=', null);
            break;
        case 'completed':
            $query->where('applications.submitted', '=', 1)
                  ->where('applications.completed', '=', 1);
            break;
        case 'incomplete':
            $query->where('applications.submitted', '=', null)
                  ->where('applications.completed', '=', null);
            break;
        case 'yes':
        case 'no' :
        case 'maybe':
          $query->where('ratings.rating', '=', $filter_by);
          break;
        case 'm':
        case 'f':
          $query->where('profiles.gender', '=', $filter_by);
          break;
        case 'unrated':
          $query->where('applications.submitted', '=', 1)
                ->where('applications.completed', '=', 1)
                ->whereNotExists(function($query) {
                   $query->select(DB::raw(1))
                      ->from('ratings')
                      ->whereRaw('ratings.application_id = applications.id');
                  });
          break;
        }
    }

    $applicants = $query->paginate(25)->appends(Input::all());
    return View::make('admin.applications.index', compact('applicants'));
  }

  public function search()
  {
    $name = Request::get('search');

    $query = DB::table('users');
    $query = $this->applicantBaseQuery($query);

    $query->where('last_name', 'LIKE', '%'. $name .'%');

    $applicants = $query->get();
    return View::make('admin.applications.index', compact('applicants'));

  }


  /**
   * Get Application and Profile information for a specified User.
   */
  public function applicationsShow($id)
  {
    // @TODO: this could all be consolidated using some eager loading which
    // would significantly reduce the number of SQL queries needed, as well
    // as the number of variables passed to the view.
    $application = Application::getUserApplication($id);
    $profile = Profile::getUserProfile($id);
    $user = User::getUserInfo($id);
    $scholarship = Scholarship::getScholarshipLabels($application['scholarship_id']);
    $app_id = Application::getUserApplicationId($id);
    $prof_id = Profile::getUserProfileId($id);
    $races = Profile::getUserRace($prof_id);
    $is_winner = Winner::where('user_id', $id)->first() ? TRUE : FALSE;

    $recomendations = null;
    $show_rating = FALSE;
    if ($app_id) {
      $recomendations = Recommendation::getUserRecs($app_id->id);
    }

    if (Application::isComplete($app_id->id))
        $show_rating = TRUE;
    
    $app_rating = Rating::getApplicationRating($app_id->id);

    $possible_ratings = Rating::getPossibleRatings();

    Session::put('url.index', URL::previous());

    return View::make('admin.applications.show', compact('id', 'application', 'app_id', 'user', 'profile', 'races', 'scholarship', 'recomendations', 'show_rating', 'possible_ratings', 'app_rating', 'is_winner'));
  }

  public function applicationsEdit($id)
  {
    $application = Application::getUserApplication($id);
    $user_info = User::getUserInfo($id);
    $profile = Profile::with('race')->whereUserId($id)->firstOrFail();
    $label = Scholarship::getScholarshipLabels($application['scholarship_id']);
    $app_id = Application::getUserApplicationId($id);
    $races = Profile::getRaces();
    $states = Profile::getStates();

    $hear_about = Scholarship::getCurrentScholarship()->pluck('hear_about_options');
    $choices = Application::formatChoices($hear_about);

    $recomendations = null;
    if ($app_id)
    {
      $recomendations = Recommendation::getUserRecs($app_id->id);
      $rank_values = Recommendation::getRankValues();
    }
    


    $show_rating = FALSE;
    if (Application::isComplete($app_id->id))
      $show_rating = TRUE;

    $app_rating = Rating::getApplicationRating($app_id->id);
    $possible_ratings = Rating::getPossibleRatings();

    return View::make('admin.applications.edit')->withUser($profile)->with(compact('id', 'application', 'app_id', 'user', 'user_info', 'profile', 'races', 'label', 'choices', 'recomendations', 'states', 'show_rating', 'possible_ratings', 'app_rating', 'rank_values'));

  }

  /**
   *
   */
  public function settings()
  {
    $scholarship_id = Scholarship::getCurrentScholarship()->pluck('id');
    return View::make('admin.settings.index', with(compact('scholarship_id')));
  }

  public function rate()
  {
    $rating = strtolower(Input::get('rating'));
    $app_id = Input::get('app_id');
    $application = Application::whereId($app_id)->firstOrFail();
    $rate = Rating::where('application_id', $app_id)->first();
    if (!$rate)
      $rate = new Rating;

    $rate->rating = $rating;

    $rate->application()->associate($application);
    $rate->save();

    return Redirect::to(Session::get('url.index'))->with('flash_message', ['text' => '<strong>Success:</strong> Awesome, we got that rated for you!', 'class' => 'alert-success']);
  }

  public function export()
  {
    return View::make('admin.reports.export');
  }



  public function export_results()
  {
    $request = key(Input::except('_token'));
    $function = $request . '_query';
    $export = new Export;
    $ex = $export->$function();
    $output = '';
    foreach ($ex as $row) {
      foreach ($row as $key => $person) {
        $output .= $person;
        $output .= ',';
      }
      $output .= "\n";
    }
    $filename = $request . '-' . time() . '.csv';
    $headers = array(
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'. $filename . '"',
    );


    return Response::make(rtrim($output, "\n"), 200, $headers);

  }


  /**
   * Helper function to select/join for the admin index table.
   */
  public static function applicantBaseQuery($query)
  {
    $query->select('users.id', 'users.first_name', 'users.last_name', 'users.email',
                   'profiles.state', 'profiles.gender',
                   'applications.submitted', 'applications.completed', 'applications.gpa',
                   'ratings.rating')
          ->leftJoin('profiles', 'profiles.user_id', '=', 'users.id')
          ->leftJoin('applications', 'applications.user_id', '=', 'users.id')
          ->leftJoin('ratings', 'application_id', '=', 'applications.id');

    return $query;
  }


}
