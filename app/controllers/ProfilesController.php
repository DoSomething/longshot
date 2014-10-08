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
    $this->beforeFilter('startedProcess:profile', ['only' => ['create']]);
  }  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $states = Profile::getStates();
    $races = Profile::getRaces();

    $help_text = Setting::getSpecifiedSettingsVars(['basic_info_help_text']);
    $page_vars = Setting::getPageSettingsVars();

    $vars = (object) array_merge($page_vars, $help_text);

    return View::make('profile.create')->with(compact('states', 'races', 'vars'));
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

    $input = Input::all();
    // Only run validation on applications that were submitted
    // (do not run on those 'saved as draft')
    if (isset($input['complete']))
    {
      $this->profileForm->validate($input);
    }
    // @TODO: there's a better way of doing the following...
    $profile = new Profile;
    $profile->birthdate = date('Y-m-d',(strtotime($input['birthdate'])));
    $profile->phone = $input['phone'];
    $profile->address_street = $input['address_street'];
    $profile->address_premise = $input['address_premise'];
    $profile->city = $input['city'];
    $profile->state = $input['state'];
    $profile->zip = $input['zip'];
    $profile->gender = $input['gender'];
    $profile->school = $input['school'];
    $profile->grade = $input['grade'];

    $user->profile()->save($profile);
    if (isset($input['race']))
    {
      foreach($input['race'] as $inputRace) {
        $race = new Race;
        $race->race = $inputRace;
        $race->profile()->associate($profile);
        $race->save();
      }
    }

    return $this->redirectAfterSave($input, $user->id);
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

    $vars = (object) Setting::getPageSettingsVars();

    if (! $user->profile)
    {
      // @TODO: Probably change states into a public static function of Controller.
      $states = Profile::getStates();
      return View::make('profile.create', compact('states', 'vars'));
    }

    return View::make('profile.show', compact('vars'))->withUser($user);
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $profile = Profile::with('race')->whereUserId($id)->firstOrFail();
    $states = Profile::getStates();
    $races = Profile::getRaces();

    $help_text = Setting::getSpecifiedSettingsVars(['basic_info_help_text']);
    $page_vars = Setting::getPageSettingsVars();

    $vars = (object) array_merge($page_vars, $help_text);

    return View::make('profile.edit')->withUser($profile)->with(compact('states', 'races', 'vars'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $user = User::with('profile')->whereId($id)->firstOrFail();
    $input = Input::only('birthdate', 'phone', 'address_street', 'address_premise', 'city', 'state', 'zip', 'gender', 'school', 'grade', 'complete');
    $currentRaces = Race::where('profile_id', $user->profile->id)->select('race')->get()->toArray();
    $input['birthdate'] = date('Y-m-d',(strtotime($input['birthdate'])));

    // Let's make the arrays match
    $newArray = array();
    foreach($currentRaces as $currentRace) {
      $newArray[] = $currentRace['race'];
    }
    $inputRaces = Input::only('race');
    if (isset($inputRaces['race']))
    {
      $toAdd = array_diff($inputRaces['race'], $newArray);
      foreach ($toAdd as $diff)
      {
        $race = new Race;
        $race->race = $diff;
        $race->profile()->associate($user->profile);
        $race->save();
      }

      // Remove unchecked races
      $toRemove = array_diff($newArray, $inputRaces['race']);
      foreach($toRemove as $remove)
      {
        Race::where('profile_id', '=', $user->profile->id)->where('race', '=', $remove)->delete();
      }
    }
    // only validate if not saved as a draft
    if (isset($input['complete']))
      $this->profileForm->validate($input);

    $user->profile->fill($input)->save();

    return $this->redirectAfterSave($input, $user->id);
  }

  public function redirectAfterSave($input, $id)
  {
    if (isset($input['complete']))
    {
      return Redirect::route('application.create')->with('flash_message', 'Application information has been saved!');
    }
    else
    {
    return Redirect::route('profile.edit', $id)->with('flash_message', 'Your profile has been updated!');
    }

  }
}
