<?php

class Setting extends Eloquent {

  protected $fillable = ['value', 'description'];

  public static $pageQueryItems = ['company_name', 'company_url', 'header_logo', 'footer_logo', 'footer_text', 'tracking_code_id'];

  public static $nominateQueryItems = ['nominate_text', 'nominate_image'];

  public static $individualQueryItems = ['eligibility_text', 'basic_info_help_text', 'create_account_help_text', 'profile_create_help_text', 'application_create_help_text', 'recommendation_create_help_text', 'recommendation_update_help_text', 'application_submit_help_text', 'status_page_help_text_incomplete', 'status_page_help_text_submitted', 'status_page_help_text_complete'];


  /**
   * Retrieve specific settings content based on category.
   */
  public static function getCategorySettingsVars($category)
  {
    return (object) self::rememberForever('query.setting.' . $category)->whereCategory($category)->lists('value', 'key');
  }


  /**
   * Return an object with the requested Settings variables from the database.
   * @param  string $column The specified column in the database to search within.
   * @param  array $items  List of items to search against for the specified column.
   * @return  array List of query results returned from the Settings table.
   */
  public static function getSpecifiedSettingsVars($items = null, $keyname = null)
  {
    if (!$items) {
      return false;
    }

    if (!$keyname) {
      $keyname = implode('.', $items);
    }

    return DB::table('settings')->rememberForever('query.setting.' . $keyname)->whereIn('key', $items)->lists('value', 'key');
  }


  /**
   * Shortcut to grab all global Page Setting variables.
   * @return array
   */
  public static function getPageSettingsVars()
  {
    return self::getSpecifiedSettingsVars(self::$pageQueryItems);
  }

}
