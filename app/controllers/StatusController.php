<?php

use Scholarship\Forms\ReviewForm;

class StatusController extends \BaseController {

  /**
  * @var reviewForm
  */
  protected $reviewForm;

  function __construct(ReviewForm $reviewForm)
  {
    $this->reviewForm = $reviewForm;
  }
  /**
   * User status page.
   * This page shows an overall glance of the status of the application.
   * Displays App, profile completeness as well as recs, if any.
   */
  public function status() {
    $user = Auth::user();
    $app_complete = FALSE;
    $prof_complete = FALSE;
    // @TODO: are these queries too heavy?
    // Get all info about application status.
    $application = Application::where('user_id', $user->id)->first();
    if ($application) {
      $app_complete = Application::isComplete($user->id);
    }
    // Is the app complete & been submitted?
    if ($app_complete && $application->complete) {
      $status = 'Submitted. Waiting for recommendation...';
      $help_text = 'We have your application!';
    } else {
      $status = 'Incomplete';
      $help_text = 'Make sure to fill out all fields and submit the application!';
    }

    $profile = Profile::where('user_id', $user->id)->first();
    if ($profile) {
      $prof_complete = Profile::isComplete($user->id);
    }
    if ($application) {
      // Get recommendations
      $recommendations = Recommendation::where('application_id', $application->id)->get();
      $max_recs = Scholarship::getCurrentScholarship()->pluck('num_recommendations_max');
      if ($recommendations->count() < $max_recs) {
        $add_rec_link = link_to_route('recommendation.create', 'Ask for another recommendation.');
      }
      foreach($recommendations as $rec) {
        $rec->isRecommendationComplete($rec);
        if ($rec->isComplete($rec->id) && isset($app_complete) && $application->complete) {
          $status = 'Completed.';
          $help_text = 'Your application is in review.';
        }

      }
      $recommendations = $recommendations->toArray();
    }

    // If both app & profile are complete add a link to review & submit.
    if ($app_complete && $prof_complete && !($application->complete)) {
      $submit = link_to_route('review', 'Review & Submit Application', array($user->id));
    }

    $vars = Setting::getSettingsVariables('general');

    return View::make('status.index', compact('profile', 'application', 'recommendations', 'app_complete', 'prof_complete', 'submit', 'status', 'helper', 'vars', 'add_rec_link'));

  }

  /**
   * Creates the review & submit applicaiton page for the user.
   * Gathers all fields that the user has filled out to display.
   */
  public function review($id)
  {
    // Get all the things.
    $application = Application::where('user_id', $id)->select('accomplishments', 'activities', 'participation', 'essay1', 'essay2', 'hear_about as how_did_you_hear_about_this', 'link', 'test_type', 'test_score', 'gpa')->first()->toArray();
    $profile = Profile::where('user_id', $id)->select('birthdate', 'phone', 'address_street', 'address_premise', 'city', 'state', 'zip as zip_code', 'gender', 'grade', 'school as current_high_school')->first()->toArray();
    $scholarship = Scholarship::getCurrentScholarship()->select(array('label_app_accomplishments as accomplishments', 'label_app_activities as activities', 'label_app_participation as participation' ,'label_app_essay1 as essay1', 'label_app_essay2 as essay2'))->first()->toArray();
    $help_text = Setting::where('key', '=', 'application_submit_help_text')->pluck('value');
    $vars = Setting::getSettingsVariables('general');

    return View::make('status.review', compact('application', 'profile', 'scholarship', 'help_text', 'vars'));
  }

  /**
   * Form submission handler for the review page.
   * This saves that the application has been submitted, making it uneditable to the user.
   */
  public function submit()
  {
    $input = Input::all();
    $this->reviewForm->validate($input);
    $application = Application::where('user_id', Auth::user()->id)->firstorFail();
    $application->complete = 1;
    $application->save();
    $this->confirmationEmail();
    $recommendations = Recommendation::where('application_id', $application->id)->get();
    $max_recs = Scholarship::getCurrentScholarship()->pluck('num_recommendations_max');
    foreach($recommendations as $rec) {
      if ($rec->isComplete($rec->id)) {
        return Redirect::route('status')->with('flash_message', 'Sweet, you\'re all set!');
      }
    }
    if ($recommendations->count() == $max_recs) {
      return Redirect::route('status')->with('flash_message', 'Sweet, just waiting on your recommendations');
    }
    return Redirect::route('recommendation.create')->with('flash_message', 'Sweet, you submitted your app');
  }

  //@TODO refactor, move and combine into one function... etc etc. this code is the worst.
  public function resendEmailRequest()
  {
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

  /**
   * Sends email to applicant saying the rec request has been sent.
   */
  public function confirmationEmail()
  {
    $email = new Email;
    $email->sendEmail('submitted', 'applicant', Auth::user()->email);
  }

}
