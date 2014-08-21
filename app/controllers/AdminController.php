<?php

class AdminController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $user = Auth::user();
    $userCount = DB::table('users')->count();

    return View::make('admin.index', compact('user', 'userCount'));
  }



  /**
   *
   */
  public function applications()
  {
    $sort_by = Request::get('sort_by');

    $query = DB::table('users')
                  ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                  ->where('role_user.role_id', '=', 2);
    if ($sort_by) {
      // @TODO: add 'direction' to this, so you can reverse results.
      $query->orderBy($sort_by, 'asc');
    }

    $applicants = $query->paginate(2);

    return View::make('admin.applications.index', compact('applicants'));
  }

}
