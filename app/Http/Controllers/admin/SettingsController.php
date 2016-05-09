<?php

use App\Models\Setting;
use Illuminate\Http\Request;
use Scholarship\Forms\SettingsForm;
use Scholarship\Repositories\SettingRepository;

class SettingsController extends \Controller
{
    protected $rules = [
      // @TODO: Add regex check for alphanumeric + symbols for company_name & eligibility_text
      'company_url'                 => 'url',
      'header_logo'                 => 'image|mimes:png',
      'footer_logo'                 => 'image|mimes:png',
      'primary_color'               => 'alpha_num|size:6',
      'primary_color_contrast'      => 'alpha_num|size:6',
      'primary_color_interaction'   => 'alpha_num|size:6',
      'secondary_color'             => 'alpha_num|size:6',
      'secondary_color_contrast'    => 'alpha_num|size:6',
      'secondary_color_interaction' => 'alpha_num|size:6',
      'cap_color'                   => 'alpha_num|size:6',
      'cap_color_contrast'          => 'alpha_num|size:6',
      'nominate_image'              => 'image|mimes:png,jpeg',
      'site_url'                    => 'url',
      'favicon'                     => 'mimes:ico',
      'open_graph_data_url'         => 'url',
      'official_rules_url'          => 'url',
      'background_image'            => 'image|mimes:png,jpeg',
    ];

    protected $settings;

    public function __construct(SettingRepository $settings)
    {
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

      return view('admin.settings.appearance.edit')->with('settings', $settings_data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @return Response
   */
  public function editGeneral()
  {
      $settings_data = Setting::whereCategory('general')->get();

      return view('admin.settings.general.edit')->with('settings', $settings_data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @return Response
   */
  public function editMetaData()
  {
      $settings_data = Setting::whereCategory('meta_data')->get();

      return view('admin.settings.meta-data.edit')->with('settings', $settings_data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @return Response
   */
  public function updateAppearance(Request $request)
  {
      $this->validate($request, $this->rules);

      $input = Input::only(
      'primary_color',
      'primary_color_contrast',
      'primary_color_interaction',
      'secondary_color',
      'secondary_color_contrast',
      'secondary_color_interaction',
      'cap_color',
      'cap_color_contrast',
      'custom_font_embed',
      'custom_font_name'
      );

      $input = $this->settings->nullify($input);

    // Get specified category settings collection.
    $settings_data = Setting::whereCategory('appearance')->get();

    // Save settings.
    $this->settings->saveSettings($settings_data, $input);

    // Updated Appearance Settings so clear the cache.
    Event::fire('settings.change', ['appearance']);

    // Create the custom stylesheet file from values in Appearance settings.
    createCustomStylesheet($input);

      return redirect()->route('appearance.edit')->with('flash_message', ['text' => 'Success: Appearance settings have been saved!', 'class' => 'alert-success']);
  }

  /**
   * Update the specified resource in storage.
   *
   * @return Response
   */
  public function updateGeneral(Request $request)
  {
      $this->validate($request, $this->rules);

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

      $inputImages = Input::only('header_logo', 'footer_logo', 'nominate_image', 'background_image');

      // $this->settingsForm->validate($inputText);
      // $this->settingsForm->validate($inputImages);

      $defaultLogoPath = '/dist/images/tmi-logo.png';

    // Uploaded Images
    foreach ($inputImages as $key => $image) {
        if (Input::hasFile($key)) {
            $inputImages[$key] = $this->settings->moveImage($key);
        }
    }

      $input = array_merge($inputText, $inputImages);

      $input = $this->settings->nullify($input);

      if ($request->get('remove_background_image')) {
          $input['background_image'] = '';
      }

    // Get specified category settings collection.
    $settings_data = Setting::whereCategory('general')->get();

    // Save settings.
    $this->settings->saveSettings($settings_data, $input);

    // Updated General Settings so clear the cache.
    // @TODO: cache is not clearing
    Event::fire('settings.change', ['general']);

      return redirect()->route('general.edit')->with('flash_message', ['text' => 'Success: General settings have been saved!', 'class' => 'alert-success']);
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

      return redirect()->route('meta-data.edit')->with('flash_message', ['text' => 'Success: Meta Data settings have been saved!', 'class' => 'alert-success']);
  }

  /**
   * Clear entire cache.
   *
   * @return Response
   */
  public function clearCache()
  {
      Cache::flush();

    // Reset appearance settings after cache clear.
    $settings = new SettingRepository();
      $settings->resetAppearanceSettings();

      return redirect()->back()->with('flash_message', ['text' => 'Success: Cache has been cleared!', 'class' => 'alert-success']);
  }
}
