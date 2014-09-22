<?php

class Path extends \Eloquent {

  protected $fillable = [];

  public $timestamps = false;

  public function page()
  {
    return $this->belongsTo('Page');
  }


  /**
   * Get all the content for the requested page.
   *
   * @param  string $pageRequest
   * @return object
   */
  public static function getPageContent($pageRequest)
  {
    $path = Path::with('page', 'page.blocks')->whereUrl($pageRequest)->firstOrFail();
    return $path->page;
  }

}
