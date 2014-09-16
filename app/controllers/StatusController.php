<?php

class StatusController extends \BaseController {

  public function status() {
    $user = Auth::user();

    // Get all info about application status.
    $application = Application::where('user_id', $user->id)->first();
    $profile = Profile::where('user_id', $user->id)->first();
    if ($application)
    {
      // Get recommendations
      $recommendations = Recommendation::where('application_id', $application->id)->get();

      foreach($recommendations as $rec)
      {
        $rec->isRecommendationComplete($rec);
      }
    }

    return View::make('status.status', compact('profile', 'application', 'recommendations'));
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