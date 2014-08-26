<?php

use Scholarship\Forms\AppearanceForm;

class AppearanceController extends \BaseController {

  /**
   * @var AppearanceForm
   */
  protected $appearanceForm;

  function __construct(AppearanceForm $appearanceForm)
  {
    $this->appearanceForm = $appearanceForm;
  }


  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return View::make('admin.appearance.edit');
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit()
  {
    $appearance = Appearance::first();

    return View::make('admin.appearance.edit', compact('appearance'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update()
  {
    $input = Input::only('company_name', 'company_url', 'primary_color', 'secondary_color', 'button_color', 'link_color', 'header_logo', 'footer_logo');
    $this->appearanceForm->validate($input);

    $appearance = Appearance::first();
    $appearance->fill($input);
    // @TODO: handle upload of images by saving image to public_path()/contents/images and storing path in table.
    $appearance->save();

    return Redirect::route('appearance.edit');
  }

}
