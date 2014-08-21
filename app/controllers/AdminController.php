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
    $applicants = Role::with('users')->whereName('applicant')->firstOrFail();
    $applicants = $applicants->users;

    return View::make('admin.applications.index', compact('applicants'));
  }

}
