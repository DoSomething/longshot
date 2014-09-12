<?php

class PagesController extends \BaseController {

  /**
   * Display the Home page.
   *
   * @return Response
   */
  public function home()
  {
    return View::make('pages.home');
  }
}
