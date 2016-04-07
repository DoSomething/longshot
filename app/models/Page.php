<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'url', 'description', 'description_html', 'hero_image'];

    public function path()
    {
        return $this->hasOne('App\Models\Path');
    }

    public function blocks()
    {
        return $this->hasMany('App\Models\Block');
    }

  /**
   * Assign a specified path for the page.
   */
  public function assignPath($path)
  {
      return $this->path()->save($path);
  }
}
