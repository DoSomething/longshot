<?php

namespace Scholarship\Repositories;

use Cache;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class SettingRepository
{
    public static $pageQueryItems = ['company_name', 'company_url', 'site_name', 'site_url', 'header_logo', 'footer_logo', 'footer_text', 'tracking_code_id', 'official_rules_url', 'background_image', 'custom_font_kit_id', 'custom_font_name'];

    public static $openGraphDataQueryItems = ['open_graph_data_title', 'open_graph_data_description', 'open_graph_data_type', 'open_graph_data_url', 'open_graph_data_image'];

    public static $nominateQueryItems = ['nominate_text', 'nominate_image'];

    public static $individualQueryItems = ['eligibility_text', 'basic_info_help_text', 'create_account_help_text', 'profile_create_help_text', 'application_create_help_text', 'recommendation_create_help_text', 'recommendation_update_help_text', 'application_submit_help_text', 'status_page_help_text_incomplete', 'status_page_help_text_submitted', 'status_page_help_text_complete'];

    /**
     * Retrieve specific settings content based on category.
     * Using this method does not cache the settings.
     *
     * @return  array List of query results returned from the Settings table based on specified category.
     */
    public function getCategorySettingsVars($category)
    {
        return DB::table('settings')->where('category', '=', $category)->lists('value', 'key');
    }

    /**
     * Return an object with the requested Settings variables from the database.
     *
     * @param  string $column The specified column in the database to search within.
     * @param  array $items  List of items to search against for the specified column.
     *
     * @return  array List of query results returned from the Settings table.
     */
    public function getSpecifiedSettingsVars($items = null, $keyname = null)
    {
        if (! $items) {
            return false;
        }

        if (! $keyname) {
            $keyname = implode('.', $items);
        }
        // return DB::table('settings')->rememberForever('setting.'.$keyname)->whereIn('key', $items)->lists('value', 'key');
        // return DB::table('settings')->whereIn('key', $items)->lists('value', 'key');
        $vars = Cache::rememberForever('settings'.$keyname, function () use ($items) {
            return DB::table('settings')->whereIn('key', $items)->lists('value', 'key');
        });

        return $vars;
    }

    /**
     * Shortcut to grab all global Page Setting variables.
     *
     * @return array
     */
    public function getPageSettingsVars()
    {
        return $this->getSpecifiedSettingsVars(self::$pageQueryItems);
    }

    /**
     * Shortcut to grab all global Meta Data Setting variables.
     *
     * @return array
     */
    public function getOpenGraphDataSettingsVars()
    {
        return $this->getSpecifiedSettingsVars(self::$openGraphDataQueryItems);
    }

    /**
     * Save uploaded image to the images directory and return path to image.
     *
     * @param string $key Name of image input.
     *
     * @return  string Path to image.
     */
    public function moveImage($key)
    {
        $extension = Input::file($key)->guessExtension();

        $path = uploadedContentPath('images').'/'.snakeCaseToKebabCase($key).'.'.$extension;
        Storage::put($path, Input::file($key), 'public');

        return $path;
    }

    /**
     * If a setting is empty, then set it to NULL.
     *
     * @param   array $input Array of inputs retrieved for the form.
     *
     * @return  array
     */
    public function nullify($input)
    {
        foreach ($input as $key => $value) {
            if ($value === '') {
                $input[$key] = null;
            }
        }

        return $input;
    }

    /**
     * Loop through settings collection and save each to the database.
     *
     * @param   object $settings_data Settings collection retrieved from database based on category.
     * @param   array $input Array of inputs retrieved for the form.
     *
     * @return  void
     */
    public function saveSettings($settings_data, $input)
    {
        $settings_data->each(function ($setting) use ($input) {
            // If setting is an image type but no new image uploaded skip it.
            if ($setting->type === 'image' && $input[$setting->key] === null) {
                return;
            }

            $setting->value = $input[$setting->key];
            $setting->save();
        });
    }

    /**
     * Reset the appearance settings.
     *
     * @return  void
     */
    public function resetAppearanceSettings()
    {
        $settings_data = $this->getCategorySettingsVars('appearance');

        createCustomStylesheet($settings_data);
    }
}
