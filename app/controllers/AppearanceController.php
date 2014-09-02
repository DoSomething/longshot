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
    $input = Input::only('company_name', 'company_url', 'primary_color', 'primary_color_contrast', 'secondary_color', 'secondary_color_contrast', 'cap_color', 'cap_color_contrast', 'header_logo', 'footer_logo');
    $this->appearanceForm->validate($input);

    $appearance = Appearance::first();
    $appearance->fill($input);
    // @TODO: handle upload of images by saving image to public_path()/contents/images and storing path in table.
    $appearance->save();

    // Create the custom stylesheet file from values in Appearance settings.
    createCustomStylesheet($appearance);

    return Redirect::route('appearance.edit')->with('flash_message', 'Appearance settings have been saved!');
  }

}
