<?php namespace Scholarship\Repositories;

use Illuminate\Support\Facades\DB;

class SettingRepository {

  public static $pageQueryItems = ['company_name', 'company_url', 'site_name', 'site_url', 'header_logo', 'footer_logo', 'footer_text', 'tracking_code_id'];

  public static $openGraphDataQueryItems = ['open_graph_data_title', 'open_graph_data_description', 'open_graph_data_type', 'open_graph_data_url', 'open_graph_data_image'];

  public static $nominateQueryItems = ['nominate_text', 'nominate_image'];

  public static $individualQueryItems = ['eligibility_text', 'basic_info_help_text', 'create_account_help_text', 'profile_create_help_text', 'application_create_help_text', 'recommendation_create_help_text', 'recommendation_update_help_text', 'application_submit_help_text', 'status_page_help_text_incomplete', 'status_page_help_text_submitted', 'status_page_help_text_complete'];


  /**
   * Retrieve specific settings content based on category.
   * Using this method does not cache the settings.
   * @return  array List of query results returned from the Settings table based on specified category.
   */
  public function getCategorySettingsVars($category)
  {
    return DB::table('settings')->where('category', '=', $category)->lists('value', 'key');
  }


  /**
   * Return an object with the requested Settings variables from the database.
   * @param  string $column The specified column in the database to search within.
   * @param  array $items  List of items to search against for the specified column.
   * @return  array List of query results returned from the Settings table.
   */
  public function getSpecifiedSettingsVars($items = null, $keyname = null)
  {
    if (!$items) {
      return false;
    }

    if (!$keyname) {
      $keyname = implode('.', $items);
    }

    return DB::table('settings')->rememberForever('setting.' . $keyname)->whereIn('key', $items)->lists('value', 'key');
  }


  /**
   * Shortcut to grab all global Page Setting variables.
   * @return array
   */
  public function getPageSettingsVars()
  {
    return $this->getSpecifiedSettingsVars(self::$pageQueryItems);
  }


  /**
   * Shortcut to grab all global Meta Data Setting variables.
   * @return array
   */
  public function getOpenGraphDataSettingsVars()
  {
    return $this->getSpecifiedSettingsVars(self::$openGraphDataQueryItems);
  }

}
