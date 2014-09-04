<?php

class Page extends \Eloquent {
	protected $fillable = ['title', 'description', 'image'];

//   public function blocks()
//   {
//     return $this->hasMany('Blocks');
//   }
}