<?php

use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Scholarship\Repositories\SettingRepository;

class RegistrationController extends \Controller
{
    protected $registrationForm;

    protected $settings;

    protected $rules;

    protected $messages = [
    'first_name.required'  => 'Please enter your first name.',
    'last_name.required'   => 'Please enter your last name.',
    'email.required'       => 'Please enter an email.',
    'email.unique'         => 'That email is already registered.',
    'password.required'    => 'Please note: password must be 6+ characters.',
    'eligibility.required' => 'Only candidates who meet the requirements above are eligible for the scholarship.',
    ];

    public function __construct(SettingRepository $settings)
    {
        $this->settings = $settings;

        $this->middleware(['guest', 'isClosed'], ['only' => ['create']]);

        $this->middleware('currentUser', ['only' => ['edit', 'update']]);

        $user = Auth::user();
        $currentUserID = isset($user) ? $user->id : 'null';
        $this->rules = [
          'first_name'  => 'required',
          'last_name'   => 'required',
          'email'       => 'required|email|unique:users,email,'.$currentUserID,
          'password'    => 'required|confirmed|min:6',
          'eligibility' => 'required|accepted',
         ];
    }

  /**
   * Show the form for creating a new resource.
   * /register.
   *
   * @return Response
   */
  public function create()
  {
      $eligibilityText = $this->settings->getSpecifiedSettingsVars(['eligibility_text']);
      $help_text = $this->settings->getSpecifiedSettingsVars(['create_account_help_text']);

      $vars = (object) array_merge($eligibilityText, $help_text);

      return view('registration.create', compact('vars'));
  }

  /**
   * Store a newly created resource in storage.
   * /register.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $this->validate($request, $this->rules, $this->messages);
      $input = $request->only('first_name', 'last_name', 'email', 'password', 'password_confirmation');

      // We don't need to save this to the db.
      $user = User::create($input);

      Auth::login($user);

      $this->sendRegistrationEmail($user);

      return redirect()->route('profile.create')->with('flash_message', ['text' => 'Thanks for creating your account.', 'class' => '-success']);
  }

    public function sendRegistrationEmail($user)
    {
        $email = new Email();
        $data = [
          'first_name' => $user->first_name,
          'last_name'  => $user->last_name,
        ];

        $email->sendEmail('welcome', 'applicant', $user->email, $data);
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
      $user = User::whereId($id)->firstOrFail();

      return view('registration.edit')->withUser($user);
  }

  /**
   * Update the specified resource in storage.
   * PUT /registration/{id}.
   *
   * @param Request $request
   * @param Page $page
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, User $user)
  {
      $this->validate($request, $this->rules, $this->messages);

      $user = Auth::user();
      $request = $request->except('eligibility');
      $user->fill($request);

      if ($user->isDirty('email')) {
          $this->sendRegistrationEmail($user);
      }

      $user->save();

      return redirect()->route('status');
  }
}
