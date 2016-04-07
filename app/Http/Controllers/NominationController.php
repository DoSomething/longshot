<?php

use Scholarship\Forms\NominationForm;
use Illuminate\Http\Request;


class NominationController extends \Controller
{
    /**
   * @var nominationForm
   */

  protected $rules = [
  'rec_name'   => 'required',
  'rec_email'  => 'required|email',
  'nom_name'   => 'required',
  'nom_email'  => 'required|email',
  ];

  protected $messages = [
  'rec_name.required'   => 'Please enter your name.',
  'nom_name.required'   => 'Please enter the nominee\'s name.',
  'rec_email.required'  => 'Please enter an email.',
  'nom_email.required'  => 'Please enter an email.',
  'rec_email.email'     => 'Please enter a valid email address',
  'nom_email.email'     => 'Please enter a valid email address',
  ];

    public function __construct()
    {

    }

    public function store(Request $request)
    {
        // $input = Input::all();
        $this->validate($request, $this->rules, $this->messages);
        $input = $request->all();
        $nom = new Nomination();
        $nom->fill($input)->save();

        $this->sendNomEmail($nom);

        return redirect()->route('home')->with('flash_message', ['text' => 'Thanks for taking the time to nominate someone! If you know other outstanding individuals for the program, we’d love to hear about them.', 'class' => '-info']);
    }

    public function sendNomEmail($nom)
    {
        $email = new Email();
        $data = [
      'nom_name'    => $nom->nom_name,
      'rec_name'    => $nom->rec_name,
      'application' => link_to_route('home', 'Application'),
    ];
        $email->sendEmail('nomination', 'applicant', $nom->nom_email, $data);
    }
}
