<?php

use App\Models\Application;
use App\Models\Profile;
use App\Models\Race;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Scholarship\Repositories\SettingRepository;

class ProfilesController extends \Controller
{
    protected $settings;

    protected $rules = [
    'birthdate'       => 'required',
    'phone'           => 'required|numeric',
    'address_street'  => 'required',
    'city'            => 'required',
    'state'           => 'required',
    'zip'             => 'required',
    'school'          => 'required',
    ];

    protected $messages = [
    'birthdate.required'       => 'Please enter your birthday in MM/DD/YYYY format.',
    'phone.required'           => 'Please enter a phone number.',
    'phone.numeric'            => 'Please enter a valid phone number.',
    'address_street.required'  => 'Please enter your address.',
    'city.required'            => 'Please enter your city.',
    'zip.required'             => 'Please enter your zip code.',
    'school.required'          => 'Please enter your current high school.',
    ];

    public function __construct(SettingRepository $settings)
    {
        $this->settings = $settings;
        $this->middleware('auth');
        $this->middleware('isClosed');
        $this->middleware('currentUser', ['only' => ['edit', 'update']]);
        $this->middleware('startedProcess:profile', ['only' => ['create']]);
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      $states = Profile::getStates();
      $races = Profile::getRaces();

      $vars = (object) $this->settings->getSpecifiedSettingsVars(['basic_info_help_text']);

      return view('profile.create')->with(compact('states', 'races', 'vars'));
  }

  /**
   * Store a newly created resource in storage.
   * /profile.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $user = User::whereId(Auth::user()->id)->firstOrFail();
      // $input = Input::all();
    // Only run validation on applications that were submitted
    // (do not run on those 'saved as draft')
    if (isset($request['complete'])) {
        $this->validate($request, $this->rules, $this->messages);
    }
    // @TODO: there's a better way of doing the following...
    $profile = new Profile();
      $profile->birthdate = $request['birthdate'];
      $profile->phone = $request['phone'];
      $profile->address_street = $request['address_street'];
      $profile->address_premise = $request['address_premise'];
      $profile->city = $request['city'];
      $profile->state = $request['state'];
      $profile->zip = $request['zip'];
      $profile->gender = $request['gender'];
      $profile->school = $request['school'];
      $profile->grade = $request['grade'];

      $user->profile()->save($profile);
      if (isset($request['race'])) {
          foreach ($request['race'] as $inputRace) {
              $race = new Race();
              $race->race = $inputRace;
              $race->profile()->associate($profile);
              $race->save();
          }
      }

      return $this->redirectAfterSave($request, $user->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function show($id)
  {
      try {
          // @TODO: maybe add this to the global exceptions in app/start/global.php

      $user = User::with('profile')->whereId($id)->firstOrFail();
      } catch (ModelNotFoundException $error) {
          return Redirect::home()->with('flash_message', ['text' => 'This user does\'t exist!', 'class' => '-warning']);
      }

      if (!$user->profile) {
          // @TODO: Probably change states into a public static function of Controller.
      $states = Profile::getStates();

          return view('profile.create', compact('states'));
      }

      return view('profile.show')->withUser($user);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function edit($id)
  {
      $profile = Profile::with('race')->whereUserId($id)->firstOrFail();
      $states = Profile::getStates();
      $races = Profile::getRaces();

      // Get what races should be checked and pass to the view
      $currentRaces = Profile::getUserRace($profile->id);
      $user_races = [];
      foreach ($currentRaces as $currentRace) {
          $user_races[] = $currentRace['race'];
      }

      $vars = (object) $this->settings->getSpecifiedSettingsVars(['basic_info_help_text']);

      return view('profile.edit')->withUser($profile)->with(compact('states', 'races', 'vars', 'user_races'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function update($id, Request $request)
  {
      //check the updating and validation logic here
      $user = User::with('profile')->whereId($id)->firstOrFail();
      $input = Input::only('birthdate', 'phone', 'address_street', 'address_premise', 'city', 'state', 'zip', 'gender', 'school', 'grade', 'complete');
      $currentRaces = Race::where('profile_id', $user->profile->id)->select('race')->get()->toArray();
      $profile = Profile::getUserProfile($user->id);

      // Update the races - this is a whole thing
      // Let's put the current races into the same format as the input races array (as in not have it keyed by 'race')
      $currentRaceArray = [];
      foreach ($currentRaces as $currentRace) {
          $currentRaceArray[] = $currentRace['race'];
      }

      $inputRaces = isset(Input::only('race')['race']) ? Input::only('race')['race'] : null;

      // Adding races or remove specific races if there is any input
      if ($inputRaces) {
          // Add the newly checked races
          $toAdd = array_diff($inputRaces, $currentRaceArray);
          foreach ($toAdd as $diff) {
              $race = new Race();
              $race->race = $diff;
              $race->profile()->associate($user->profile);
              $race->save();
          }

          // Remove the newly unchecked races
          $toRemove = array_diff($currentRaceArray, $inputRaces);
          foreach ($toRemove as $remove) {
            Race::where('profile_id', '=', $user->profile->id)->where('race', '=', $remove)->delete();
          }
      } else {
          // If there is no input, it means no boxes are checked, so remove all races
        Race::where('profile_id', '=', $user->profile->id)->delete();
      }

      // only validate if not saved as a draft
      if (isset($request['complete'])) {
          $this->validate($request, $this->rules, $this->messages);
      }

      $user->profile->fill($input)->save();

      $override = null;
      if (Application::isSubmitted($user->id)) {
          $override = 'status';
      }

      if (Auth::user()->hasRole('administrator') && stripos($_SERVER['HTTP_REFERER'], 'admin')) {
          return redirect()->route('admin.application.show', $id);
      }

      return $this->redirectAfterSave($input, $user->id, $override);
  }

    public function redirectAfterSave($input, $id, $override = null)
    {
        if (isset($override)) {
            return redirect()->route($override)->with('flash_message', ['text' => 'Your profile has been updated', 'class' => '-success']);
        } elseif (isset($input['complete'])) {
            return redirect()->route('application.create')->with('flash_message', ['text' => 'Application information has been saved!', 'class' => '-success']);
        } else {
            return redirect()->route('profile.edit', $id)->with('flash_message', ['text' => 'Your profile has been updated!', 'class' => '-success']);
        }
    }
}
