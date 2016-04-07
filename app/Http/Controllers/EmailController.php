<?php

use App\Models\Email;

class EmailController extends \Controller
{
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

      return view('admin.settings.emails.edit')->with(compact('applicant_emails', 'recommender_emails'));
  }

    public function update()
    {
        $input = Input::all();
        foreach ($input as $key => $field) {
            if ($key != '_token') {
                $email = Email::whereId($field['id'])->firstOrFail();
                $email->subject = $field['subject'];
                $email->body = $field['body'];
                $email->save();
            }
        }

        return redirect()->route('emails')->with('flash_message', ['text' => 'Success: Email settings have been saved!', 'class' => 'alert-success']);
    }
}
