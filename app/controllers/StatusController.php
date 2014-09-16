<?php

class StatusController extends \BaseController {

  public function status() {
    $user = Auth::user();

    // Get all info about application status.
    $application = Application::where('user_id', $user->id)->firstOrFail();
    // Get recs
    $recommendations = Recommendation::where('application_id', $application->id)->get();

    foreach($recommendations as $rec)
    {
      // Set an attribute of if it's finished or not.
      if (!empty($rec->rank_character) && !empty($rec->rank_additional) && !empty($rec->essay1))
      {
        $rec->complete = 'All set!';
      }
      else
      {
        $rec->complete = 'Still waiting';
      }
    }

    return View::make('status.status', compact('recommendations'));
  }

  //@TODO refactor, move and combine into one function... etc etc. this code is the worst.
  public function resendEmailRequest()
  {
    $rec_id = Input::get('id');
    $recommendation = Recommendation::whereId($rec_id)->firstOrFail();
    $to = $recommendation->email;
    $from = Auth::user()->first_name .  " " . Auth::user()->last_name;
    $scholarship = Scholarship::firstOrFail()->pluck('title'); // @TODO: get the real scholarship
    $subject = $from . " would like you pleaseeee to to be a recommender for the " . $scholarship . " scholarship";

    $data = array(
      'to' => $to,
      'subject' => $subject,
      'applicant' => $from,
      'recommendation_id' => $recommendation->id,
      'token' => $recommendation->generateRecToken($recommendation)
    );
    Mail::send('emails.recommendation.request', $data, function($message) use ($data)
    {
      $message->to($data['to'])->subject($data['subject']);
    });

    return Redirect::route('status')->with('flash_message', 'We sent another email!');
  }

}