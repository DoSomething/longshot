<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    protected $fillable = [];

    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo('App\Models\Page');
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
      $path = Cache::remember('page.blocks'.$pageRequest, 120, function () use ($pageRequest) {
        return self::with('page', 'page.blocks')->whereUrl($pageRequest)->firstOrFail();
      });

      return $path->page;
  }
}
