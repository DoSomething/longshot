<?php

class EmailController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    // Get all the emails.
    $applicant_emails = Email::where('recipient', '=', 'applicant')->get()->toArray();
    $recommender_emails = Email::where('recipient', '=', 'recommender')->get()->toArray();
    return View::make('admin.settings.emails.edit')->with(compact('applicant_emails', 'recommender_emails'));
  }

  public function update()
  {
    $input = Input::all();
    foreach($input as $key=> $field)
    {
      if ($key != '_token')
      {
        $email = Email::whereId($field['id'])->firstOrFail();
        $email->subject = $field['subject'];
        $email->body = $field['body'];
        $email->save();
      }
    }

    return Redirect::route('emails')->with('flash_message', 'Email settings have been saved');
  }

}
