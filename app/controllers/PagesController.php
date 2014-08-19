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


  /**
   * Display the About page.
   *
   * @return Response
   */
  public function about()
  {
    return View::make('pages.about');
  }


  /**
   * Display the FAQ page.
   *
   * @return Response
   */
  public function faq()
  {
    return View::make('pages.faq');
  }


  /**
   * Display the Status page.
   *
   * @return Response
   */
  public function status()
  {
    return View::make('pages.status');
  }

}
