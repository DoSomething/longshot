<?php

use Scholarship\Forms\ProfileForm;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfilesController extends \BaseController {

  /**
   * @var ProfileForm
   */
  protected $profileForm;

  function __construct(ProfileForm $profileForm)
  {
    $this->profileForm = $profileForm;
    $this->beforeFilter('currentUser', ['only' => ['edit', 'update']]);
  }


	/**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $states = Profile::getStates();
    return View::make('profile.create')->with('states', $states);
  }


  /**
   * Store a newly created resource in storage.
   * /profile
   *
   * @return Response
   */
  public function store()
  {
    $user = User::whereId(Auth::user()->id)->firstOrFail();

    $input = Input::only('birthdate', 'phone', 'address_street', 'address_premise', 'city', 'state', 'zip', 'gender', 'race', 'school', 'grade');

    $this->profileForm->validate($input);

    // @TODO: there's a better way of doing the following...
    $profile = new Profile;
    $profile->birthdate = Input::get('birthdate');
    $profile->phone = Input::get('phone');
    $profile->address_street = Input::get('address_street');
    $profile->address_premise = Input::get('address_premise');
    $profile->city = Input::get('city');
    $profile->state = Input::get('state');
    $profile->zip = Input::get('zip');
    $profile->gender = Input::get('gender');
    $profile->race = Input::get('race');
    $profile->school = Input::get('school');
    $profile->grade = Input::get('grade');

    $user->profile()->save($profile);

    return Redirect::route('application.create')->with('flash_message', 'Profile information has been saved!');
  }


  /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
    try // @TODO: maybe add this to the global exceptions in app/start/global.php
    {
      $user = User::with('profile')->whereId($id)->firstOrFail();
    }
    catch(ModelNotFoundException $error)
    {
      return Redirect::home()->with('flash_message', 'This user does\'t exist!');
    }

    if (! $user->profile)
    {
      // @TODO: Probably change states into a public static function of Controller.
      $states = Profile::getStates();
      return View::make('profile.create')->with('states', $states);
    }

    return View::make('profile.show')->withUser($user);
	}


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $user = User::whereId($id)->firstOrFail();
    $states = Profile::getStates();
    return View::make('profile.edit')->withUser($user)->with('states', $states);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $user = User::whereId($id)->firstOrFail();
    $input = Input::only('birthdate', 'phone', 'address_street', 'address_premise', 'city', 'state', 'zip', 'gender', 'race', 'school', 'grade');
    $this->profileForm->validate($input);
    $user->profile->fill($input)->save();
    return Redirect::route('profile.edit', $user->id)->with('flash_message', 'Your profile has been updated!');
  }


}
