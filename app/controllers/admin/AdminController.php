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
    $count['submitted_apps'] = Application::where('submitted', '=', 1)->where('completed', '=', 1)->count();

    return View::make('admin.index', compact('user', 'count'));
  }


  /**
   *
   */
  public function applicationsIndex()
  {
    $sort_by = Request::get('sort_by');

    $query = DB::table('users')
                  ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                  ->where('role_user.role_id', '=', 2);
    if ($sort_by) {
      // @TODO: add 'direction' to this, so you can reverse results.
      $query->orderBy($sort_by, 'asc');
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

    return View::make('admin.applications.show', compact('application', 'profile', 'scholarship', 'recomendations'));
  }

  /**
   *
   */
  public function settings() {
    $scholarship_id = Scholarship::getCurrentScholarship()->pluck('id');
    return View::make('admin.settings.index', with(compact('scholarship_id')));
  }

}
