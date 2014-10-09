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
    $app_filled_out = FALSE;
    $prof_complete = FALSE;
    // @TODO: are these queries too heavy?
    // Get all info about application status.
    $application = Application::where('user_id', $user->id)->first();
    if ($application) {
      $app_filled_out = Application::isFilledOut($user->id);
    }

    // Is the app complete & been submitted?
    if ($app_filled_out && $application->submitted) {
      $status = 'Submitted. Waiting for recommendation...';
      $help_text = Setting::getSpecifiedSettingsVars(['status_page_help_text_submitted']);
    } else {
      $status = 'Incomplete';
      $help_text = Setting::getSpecifiedSettingsVars(['status_page_help_text_incomplete']);
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
        $add_rec_link = link_to_route('recommendation.create', 'Ask for another recommendation', null, ['class' => 'button -small']);
      }
      foreach($recommendations as $rec) {
        $rec->isRecommendationComplete($rec);
        if ($rec->isComplete($rec->id) && isset($app_filled_out) && $application->submitted) {
          $status = 'Completed.';
          $help_text = Setting::getSpecifiedSettingsVars(['status_page_help_text_complete']);
        }

      }
      $recommendations = $recommendations->toArray();
    }

    // If both app & profile are complete add a link to review & submit.
    if ($app_filled_out && $prof_complete && !($application->submitted)) {
      $submit = link_to_route('review', 'Review & Submit Application', [$user->id], ['class' => 'button -small']);
    }

    $page_vars = Setting::getPageSettingsVars();

    $vars = (object) array_merge($page_vars, $help_text);

    // @TODO: find a better way of retrieving the timeline in case there are other blocks to that type.
    // Query cached for 2 hours.
    $timeline = Block::remember(120, 'query.block.timeline')->whereBlockType('timeline')->select('block_body_html')->first();
    $timeline = $timeline->block_body_html;

    return View::make('status.index', compact('profile', 'application', 'recommendations', 'app_filled_out', 'prof_complete', 'submit', 'status', 'vars', 'add_rec_link', 'timeline'));

  }

  /**
   * Creates the review & submit applicaiton page for the user.
   * Gathers all fields that the user has filled out to display.
   */
  public function review($id)
  {
    // Get all the things.
    $application = Application::getUserApplication($id);
    $profile = Profile::getUserProfile($id);
    $scholarship = Scholarship::getScholarshipLabels();

    $help_text = Setting::getSpecifiedSettingsVars(['application_submit_help_text']);
    $page_vars = Setting::getPageSettingsVars();

    $vars = (object) array_merge($page_vars, $help_text);

    $prof_complete = Profile::isComplete(Auth::user()->id);
    if (!$prof_complete) {
      return Redirect::route('status')->with('flash_message', ['text' => 'Please go back and answer all required questions in ' . link_to_route('profile.create', 'basic info.'), 'class' => '-warning']);
    }

    return View::make('status.review', compact('application', 'profile', 'scholarship', 'vars'));
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
    $application->submitted = 1;
    $application->save();
    $this->confirmationEmail();
    $recommendations = Recommendation::where('application_id', $application->id)->get();
    $max_recs = Scholarship::getCurrentScholarship()->pluck('num_recommendations_max');
    foreach($recommendations as $rec) {
      if ($rec->isComplete($rec->id)) {
        return Redirect::route('status')->with('flash_message', ['text' => 'Sweet, you\'re all set!', 'class' => '-success']);
      }
    }
    if ($recommendations->count() == $max_recs) {
      return Redirect::route('status')->with('flash_message', ['text' => 'Sweet, just waiting on your recommendations.', 'class' => '-info']);
    }
    return Redirect::route('recommendation.create')->with('flash_message', ['text' => 'Your application has been submitted. Submit a recommendation request below.', 'class' => '-success']);
  }

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

    return Redirect::route('status')->with('flash_message', ['text' => 'We sent another email!', 'class' => '-success']);
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
