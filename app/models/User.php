<?php

namespace App\Models;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

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
    protected $hidden = ['password', 'remember_token'];

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
     *
     * @return object
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    /**
     * Get the Application for a User.
     *
     * @return object
     */
    public function application()
    {
        return $this->hasOne('App\Models\Application');
    }

    /**
     * Get the Roles for a User.
     *
     * @return object
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function winner()
    {
        return $this->hasOne('App\Models\Winner');
    }

    /**
     * Check to see if User has a Role.
     *
     * @return object
     */
    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Assign a specific role to a User.
     */
    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    /**
     * Remove a specific role from a User.
     */
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * Check to see if the current User object is the currently authenticated user.
     */
    public function isCurrent()
    {
        if (Auth::guest()) {
            return false;
        }

        return Auth::user()->id === $this->id;
    }

    public static function getUserInfo($id)
    {
        return $user = self::whereId($id)->select('first_name', 'last_name', 'email')->first()->toArray();
    }

    /**
     * Get full public biography for user.
     *
     * @param  int|array $ids  Single or multiple user ids.
     *
     * @return object
     */
    public function getFullBios($ids)
    {
        $fields = [
      'profile'     => function ($query) {
          $query->select('user_id', 'city', 'state');
      },
      'application' => function ($query) {
          $query->select('user_id', 'scholarship_id', 'gpa', 'participation');
      },
    ];

        if (is_array($ids)) {
            $data = self::with($fields)->whereIn('id', $ids)->get();
        } else {
            $data = self::with($fields)->findOrFail($ids);
        }

        return $data;
    }
}
