<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['block_type', 'block_title', 'block_body'];

    public function page()
    {
        return $this->belongsTo('App\Models\Page');
    }

  /**
   * Return an array of block types.
   *
   * @return array Block types
   */
  public static function getTypes()
  {
      $types = [
      'default'           => 'Default',
      'introduction'      => 'Introduction',
      'cta'               => 'Call to Action',
      'timeline'          => 'Timeline',
      'steps-vertical'    => 'Numbered Steps (vertical)',
      'steps-horizontal'  => 'Numbered Steps (horizontal)',
      'detailed-list'     => 'Detailed List',
    ];

      return $types;
  }
}
