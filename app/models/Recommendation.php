<?php

class Recommendation extends \Eloquent {
	protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'rank_character', 'rank_addiational', 'essay1'];
}


public function application()
{
	return $this->belongsTo('Application');
}
