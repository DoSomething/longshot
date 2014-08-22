<?php

class Scholarship extends \Eloquent {
	protected $fillable = [];

	public function application()
	{
		return $this->hasMany('Applications')
	}

}
