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

    return View::make('profiles.show')->withUser($user);
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

    return View::make('profiles.edit')->withUser($user);
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
