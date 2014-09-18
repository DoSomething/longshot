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

    //@TODO: send emails
    return Redirect::route('home')->with('flash_message', 'Thanks for taking the time to nominate someone for the Foot Locker Scholar Athletes program! If you know other outstanding individuals for the program, we’d love to hear about them.');
  }
}
