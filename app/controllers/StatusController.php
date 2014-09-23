<?php

class StatusController extends \BaseController {

  public function status() {
    $user = Auth::user();

    // Get all info about application status.
    $application = Application::where('user_id', $user->id)->first();
    $app_complete = Application::isComplete($user->id);

    $profile = Profile::where('user_id', $user->id)->first();
    $prof_complete = Profile::isComplete($user->id);
    if ($application) {
      // Get recommendations
      $recommendations = Recommendation::where('application_id', $application->id)->get();

      foreach($recommendations as $rec) {
        $rec->isRecommendationComplete($rec);
      }
      $recommendations = $recommendations->toArray();
    }
    if ($app_complete && $prof_complete) {
      // Submit that application!
      // make a submit button
    }

    return View::make('status.index', compact('profile', 'application', 'recommendations', 'app_complete', 'prof_complete'));
  }

  public function review($id)
  {
    // Get all the things.
    // return View::make('review');
  }

  //@TODO refactor, move and combine into one function... etc etc. this code is the worst.
  public function resendEmailRequest()
  {
    // @todo: redo this depending on copy.
    $rec_id = Input::get('id');
    $recommendation = Recommendation::whereId($rec_id)->firstOrFail();
    $token = $recommendation->generateRecToken($recommendation);

    $link = link_to_route('recommendation.edit', "Please provide a recommendation", array($recommendation->id,'token' => $token));
    $email = new Email;
    $data = array(
      'link' => $link,
      'applicant_name' => Auth::user()->first_name .  " " . Auth::user()->last_name,
      );
    $email->sendEmail('request', 'recommender', $recommendation->email, $data);

    return Redirect::route('status')->with('flash_message', 'We sent another email!');
  }

}
