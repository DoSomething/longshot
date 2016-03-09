<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = ['race'];

    public $timestamps = false;

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
