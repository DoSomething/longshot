<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

  use UserTrait, RemindableTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';


  /**
   * Fillable fields.
   *
   * @var array
   */
  protected $fillable = ['first_name', 'last_name', 'email', 'password', 'eligibility'];


  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('password', 'remember_token');


  /**
   * Mutator to set password hashing.
   *
   * @var array
   */
  public function setPasswordAttribute($password)
  {
    $this->attributes['password'] = Hash::make($password);
  }


  /**
   * Get the Profile for a User.
   * @return object
   */
  public function profile()
  {
    return $this->hasOne('Profile');
  }

  /**
   * Get the Profile for a User
   * @return object
   */
  public function application()
  {
    return $this->hasOne('Application');
  }

  /**
   * Get the Roles for a User.
   * @return object
   */
  public function roles()
  {
    return $this->belongsToMany('Role');
  }


  /**
   * Check to see if User has a Role.
   * @return object
   */
  public function hasRole($name)
  {
    foreach ($this->roles as $role)
    {
      if ($role->name === $name) return true;
    }

    return false;
  }


  /**
   *
   */
  public function assignRole($role)
  {
    return $this->roles()->attach($role);
  }


  /**
   *
   */
  public function removeRole($role)
  {
    return $this->roles()->detach($role);
  }


  /**
   * Is the current User object the currently authenticated user.
   */
  public function isCurrent()
  {
    if (Auth::guest())
    {
      return false;
    }

    return Auth::user()->id === $this->id;
  }
}
