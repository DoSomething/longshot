<?php

class Race extends Eloquent
{
    protected $fillable = ['race'];

    public $timestamps = false;

    public function profile()
    {
        return $this->belongsTo('Profile');
    }
}
