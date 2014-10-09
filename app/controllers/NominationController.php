<?php

use Scholarship\Forms\NominationForm;

class NominationController extends \BaseController {

  /**
  * @var nominationForm
  */
  protected $nominationForm;

  function __construct(NominationForm $nominationForm)
  {
    $this->nominationForm = $nominationForm;
  }

  public function store()
  {
    $input = Input::all();
    $this->nominationForm->validate($input);

    $nom = new Nomination;
    $nom->fill($input)->save();

    $this->sendNomEmail($nom);

    return Redirect::route('home')->with('flash_message', ['text' => 'Thanks for taking the time to nominate someone for the Foot Locker Scholar Athletes program! If you know other outstanding individuals for the program, we’d love to hear about them.', 'class' => '-info']);
  }

  public function sendNomEmail($nom)
  {
    $email = new Email;
    $data = array(
      'nom_name' => $nom->nom_name,
      'rec_name' => $nom->rec_name,
      'application' => link_to_route('home', 'Application'),
    );
    $email->sendEmail('nomination', 'applicant', $nom->nom_email, $data);

  }
}
