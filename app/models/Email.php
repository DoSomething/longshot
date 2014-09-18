<?php

class Email extends Eloquent {

  protected $fillable = ['subject', 'body'];

  public $timestamps = false;
}