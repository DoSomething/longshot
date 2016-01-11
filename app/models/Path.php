<?php

class Path extends \Eloquent
{
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
   *
   * @return object
   */
  public static function getPageContent($pageRequest)
  {
      $path = self::with('page', 'page.blocks')->whereUrl($pageRequest)->remember(120)->firstOrFail();

      return $path->page;
  }
}
