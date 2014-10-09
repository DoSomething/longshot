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
                  ->where('role_user.role_id', '=', 2)
                  ->count();

    $count['apps'] = Application::count();
    $count['noms'] = Nomination::count();
    $unique = DB::select("SELECT COUNT(DISTINCT (nom_email)) as count FROM nominations");
    $count['unique_noms'] = $unique[0]->count;
    $unique = DB::select("SELECT COUNT(DISTINCT (rec_email)) as count FROM nominations");
    $count['unique_recs'] = $unique[0]->count;
    $count['submitted_apps'] = Application::where('submitted', '=', 1)->count();
    $count['completed_apps'] = Application::where('submitted', '=', 1)->where('completed', '=', 1)->count();

    // @TODO: combime these two, the is null and is not null will not bind as a variable. :(
    $base_rec_null_query = 'SELECT count(*) as total FROM (
                        SELECT count(*) as c
                        FROM recommendations
                        WHERE rank_additional is null
                        GROUP BY application_id
                        HAVING c = :count
                      ) T ;';

    $base_rec_complete_query = 'SELECT count(*) as total FROM (
                        SELECT count(*) as count
                        FROM recommendations
                        WHERE rank_additional is not null
                        GROUP BY application_id
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

    $query = DB::table('users')
                  ->select('users.id', 'users.first_name', 'users.last_name', 'users.email',
                           'profiles.state', 'profiles.gender',
                           'applications.submitted', 'applications.completed', 'applications.gpa',
                           'ratings.rating')
                  ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                  ->leftJoin('profiles', 'profiles.user_id', '=', 'users.id')
                  ->leftJoin('applications', 'applications.user_id', '=', 'users.id')
                  ->leftJoin('ratings', 'application_id', '=', 'applications.id')
                  ->where('role_user.role_id', '=', 2);
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
        }
    }

    $applicants = $query->paginate(25);
    return View::make('admin.applications.index', compact('applicants'));
  }


  /**
   * Get Application and Profile information for a specified User.
   */
  public function applicationsShow($id)
  {
    $application = Application::getUserApplication($id);
    $profile = Profile::getUserProfile($id);
    $scholarship = Scholarship::getScholarshipLabels();
    $app_id = Application::getUserApplicationId($id);

    $recomendations = null;
    if ($app_id)
      $recomendations = Recommendation::getUserRecs($app_id->id);

    $show_rating = FALSE;
    if (Application::isComplete($app_id->id))
      $show_rating = TRUE;

    $app_rating = Rating::getApplicationRating($app_id->id);
    $possible_ratings = Rating::getPossibleRatings();

    return View::make('admin.applications.show', compact('application', 'app_id', 'profile', 'scholarship', 'recomendations', 'show_rating', 'possible_ratings', 'app_rating'));
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

    return Redirect::to('admin/applications?filter_by=completed')->with('flash_message', 'Awesome, we got that rated for you!');
  }

}
