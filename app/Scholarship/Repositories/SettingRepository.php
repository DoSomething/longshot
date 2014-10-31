<?php namespace Scholarship\Repositories;

use Illuminate\Support\Facades\DB;

class SettingRepository {

  protected $pageQueryItems = ['company_name', 'company_url', 'site_name', 'site_url', 'header_logo', 'footer_logo', 'footer_text', 'tracking_code_id'];

  protected $openGraphDataQueryItems = ['open_graph_data_title', 'open_graph_data_description', 'open_graph_data_type', 'open_graph_data_url', 'open_graph_data_image'];

  protected $nominateQueryItems = ['nominate_text', 'nominate_image'];

  protected $individualQueryItems = ['eligibility_text', 'basic_info_help_text', 'create_account_help_text', 'profile_create_help_text', 'application_create_help_text', 'recommendation_create_help_text', 'recommendation_update_help_text', 'application_submit_help_text', 'status_page_help_text_incomplete', 'status_page_help_text_submitted', 'status_page_help_text_complete'];


  // public function __construct($pageQueryItems)
  // {
  //   $this->pageQueryItems = $pageQueryItems;
  // }


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
    // return ['something', 'something else', 'another something'];
    // var_dump($this->pageQueryItems);
    return $this->getSpecifiedSettingsVars($this->pageQueryItems);
  }

}

