<?php

use Scholarship\Forms\SettingsForm;

class SettingsController extends \BaseController {

  /**
   * @var SettingsForm
   */
  protected $settingsForm;

  function __construct(SettingsForm $settingsForm)
  {
    $this->settingsForm = $settingsForm;
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @return Response
   */
  public function editAppearance()
  {
    $settings = Setting::whereCategory('appearance')->get();

    return View::make('admin.settings.appearance.edit', compact('settings'));
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @return Response
   */
  public function editGeneral()
  {
    $settings = Setting::whereCategory('general')->get();

    return View::make('admin.settings.general.edit', compact('settings'));
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
      'secondary_color',
      'secondary_color_contrast',
      'cap_color',
      'cap_color_contrast',
      );

    $this->settingsForm->validate($input);

    // @TODO: use the new method in the Setting model!
    $settings = Setting::whereCategory('appearance')->get();
    $settings->each(function($setting) use($input)
    {
      $setting->value = $input[$setting->key];
      $setting->save();
    });

    // Create the custom stylesheet file from values in Appearance settings.
    createCustomStylesheet($input);

    return Redirect::route('appearance.edit')->with('flash_message', 'Appearance settings have been saved!');

  }


   /**
   * Update the specified resource in storage.
   *
   * @return Response
   */
  public function updateGeneral()
  {
    $inputText = Input::only(
      'company_name',
      'company_url',
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
      'status_page_help_text_submitted', '
      status_page_help_text_complete',
      );

    $inputImages = Input::only('header_logo', 'footer_logo', 'nominate_image');

    $this->settingsForm->validate($inputText);
    $this->settingsForm->validate($inputImages);

    $defaultLogoPath = '/dist/images/tmi-logo.png';

    // Uploaded Images
    foreach ($inputImages as $key => $image) {
      if (Input::hasFile($key))
      {
        $inputImages[$key] = '/content/images/' . snakeCaseToKebabCase($key) . '.png';
        Input::file($key)->move(uploadedContentPath('images'), snakeCaseToKebabCase($key) . '.png');
      }
    }

    $input = array_merge($inputText, $inputImages);

    // @TODO: maybe create this as a method of the Setting model?
    $settings = Setting::whereCategory('general')->get();

    $settings->each(function($setting) use($input)
    {
      if ($setting->type === 'image' && $input[$setting->key] == null) return;
      $setting->value = $input[$setting->key];
      $setting->save();
    });

    Event::fire('setting.change', ['general']);

    return Redirect::route('general.edit')->with('flash_message', 'General settings have been saved!');

  }

}
