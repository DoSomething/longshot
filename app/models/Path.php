<?php namespace App\Models;

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
      // We were caching this before but I can't get it to work, it just returns whichever one was 
      // cached first
      // $path = Cache::remember(120, 'page.blocks', function() use($pageRequest){
      //   return self::with('page', 'page.blocks')->whereUrl($pageRequest)->firstOrFail();
      // });
      $path = self::with('page', 'page.blocks')->whereUrl($pageRequest)->firstOrFail();
      return $path->page;
  }
}
