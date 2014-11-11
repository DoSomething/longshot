<?php

use Scholarship\Forms\SettingsForm;
use Scholarship\Repositories\SettingRepository;

class SettingsController extends \BaseController {

  protected $settingsForm;

  protected $settings;

  function __construct(SettingsForm $settingsForm, SettingRepository $settings)
  {
    $this->settingsForm = $settingsForm;

    $this->settings = $settings;
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @return Response
   */
  public function editAppearance()
  {
    $settings_data = Setting::whereCategory('appearance')->get();

    return View::make('admin.settings.appearance.edit')->with('settings', $settings_data);
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @return Response
   */
  public function editGeneral()
  {
    $settings_data = Setting::whereCategory('general')->get();

    return View::make('admin.settings.general.edit')->with('settings', $settings_data);
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @return Response
   */
  public function editMetaData()
  {
    $settings_data = Setting::whereCategory('meta_data')->get();

    return View::make('admin.settings.meta-data.edit')->with('settings', $settings_data);
  }


  /**
   * Update the specified resource in storage.
   *
   * @return Response
   */
  public function updateAppearance()
  {
    $input = Input::only(
      'primary_color',
      'primary_color_contrast',
      'primary_color_interaction',
      'secondary_color',
      'secondary_color_contrast',
      'secondary_color_interaction',
      'cap_color',
      'cap_color_contrast'
      );

    $this->settingsForm->validate($input);

    $input = $this->settings->nullify($input);

    // Get specified category settings collection.
    $settings_data = Setting::whereCategory('appearance')->get();

    // Save settings.
    $this->settings->saveSettings($settings_data, $input);

    // Updated Appearance Settings so clear the cache.
    Event::fire('settings.change', ['appearance']);

    // Create the custom stylesheet file from values in Appearance settings.
    createCustomStylesheet($input);

    return Redirect::route('appearance.edit')->with('flash_message', ['text' => '<strong>Success:</strong> <em>Appearance</em> settings have been saved!', 'class' => 'alert-success']);

  }


   /**
   * Update the specified resource in storage.
   *
   * @return Response
   */
  public function updateGeneral()
  {
    // @TODO: maybe collect the help_text related items via the $individualQueryItems SettingsRepository property?
    $inputText = Input::only(
      'company_name',
      'company_url',
      'site_name',
      'site_url',
      'eligibility_text',
      'footer_text',
      'basic_info_help_text',
      'create_account_help_text',
      'profile_create_help_text',
      'application_create_help_text',
      'recommendation_create_help_text',
      'recommendation_update_help_text',
      'application_submit_help_text',
      'nominate_text',
      'tracking_code_id',
      'status_page_help_text_incomplete',
      'status_page_help_text_submitted',
      'status_page_help_text_complete',
      'official_rules_url'
      );

    $inputImages = Input::only('header_logo', 'footer_logo', 'nominate_image');

    $this->settingsForm->validate($inputText);
    $this->settingsForm->validate($inputImages);

    $defaultLogoPath = '/dist/images/tmi-logo.png';

    // Uploaded Images
    foreach ($inputImages as $key => $image) {
      if (Input::hasFile($key)) {
        $inputImages[$key] = $this->settings->moveImage($key);
      }
    }

    $input = array_merge($inputText, $inputImages);

    $input = $this->settings->nullify($input);

    // Get specified category settings collection.
    $settings_data = Setting::whereCategory('general')->get();

    // Save settings.
    $this->settings->saveSettings($settings_data, $input);

    // Updated General Settings so clear the cache.
    Event::fire('settings.change', ['general']);

    return Redirect::route('general.edit')->with('flash_message', ['text' => '<strong>Success:</strong> <em>General</em> settings have been saved!', 'class' => 'alert-success']);

  }


  /**
   * Update the specified resource in storage.
   *
   * @return Response
   */
  public function updateMetaData()
  {
    $inputText = Input::only(
      'open_graph_data_title',
      'open_graph_data_description',
      'open_graph_data_type',
      'open_graph_data_url'
    );

    $inputImages = Input::only('open_graph_data_image', 'favicon');

    $this->settingsForm->validate($inputText);
    $this->settingsForm->validate($inputImages);

    // Uploaded Images
    foreach ($inputImages as $key => $image) {
      if (Input::hasFile($key)) {
        $inputImages[$key] = $this->settings->moveImage($key);
      }
    }

    $input = array_merge($inputText, $inputImages);

    $input = $this->settings->nullify($input);

    // Get specified category settings collection.
    $settings_data = Setting::whereCategory('meta_data')->get();

    // Save settings.
    $this->settings->saveSettings($settings_data, $input);

    // Updated General Settings so clear the cache.
    Event::fire('settings.change', ['meta_data']);

    return Redirect::route('meta-data.edit')->with('flash_message', ['text' => '<strong>Success:</strong> <em>Meta Data</em> settings have been saved!', 'class' => 'alert-success']);
  }

}
