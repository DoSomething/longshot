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
        $group_emails = Email::where('recipient', '=', 'group')->get()->toArray();

        return view('admin.settings.emails.edit')->with(compact('applicant_emails', 'recommender_emails', 'group_emails'));
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

    public function testEmail()
    {
        return view('admin.settings.emails.test');
    }

    public function sendTestEmail()
    {
        // Build and send email
        $email = new Email();
        $input = Input::all();

        $email->sendEmail('welcome', 'applicant', $input['recipient'], $input);

        return redirect()->route('emails.test')->with('flash_message', ['text' => 'Success: Test email has been sent!', 'class' => 'alert-success']);
    }
}
