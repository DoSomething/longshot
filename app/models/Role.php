<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

  /**
   * Get the Users of a specific Role.
   *
   * @return object
   */
  public function users()
  {
      return $this->belongsToMany('User');
  }
}
