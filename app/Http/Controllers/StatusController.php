<?php

use App\Models\Application;
use App\Models\Block;
use App\Models\Email;
use App\Models\Profile;
use App\Models\Recommendation;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Scholarship\Repositories\SettingRepository;

class StatusController extends \Controller
{
    protected $settings;

    protected $rules = [
    'documentation'   => 'accepted',
    'factual'         => 'accepted',
    'media_release'   => 'accepted',
    'rules'           => 'accepted',
    ];

    protected $messages = [
    'documentation.accepted'   => 'Please confirm you can provide one of these documents.',
    'factual.accepted'         => 'Please confirm everything in your application is true and factual.',
    'media_release.accepted'   => 'Please verify that you accept the media release.',
    'rules.accepted'           => 'Please verify that you accept the Official Rules.',
   ];

    public function __construct(SettingRepository $settings)
    {
        $this->settings = $settings;
    }

  /**
   * User status page.
   * This page shows an overall glance of the status of the application.
   * Displays App, profile completeness as well as recs, if any.
   */
  public function status()
  {
      $user = Auth::user();
      $app_filled_out = false;
      $app_submitted = false;
      $prof_complete = false;
      $closed = Scholarship::isClosed();
    // @TODO: are these queries too heavy?
    // Get all info about application status.
    $application = Application::where('user_id', $user->id)->first();
      if ($application) {
          $app_filled_out = Application::isFilledOut($user->id);
          $app_submitted = Application::isSubmitted($user->id);
      }

    // Is the app complete & been submitted?
    if ($app_filled_out && $application->submitted) {
        $status = 'Submitted. Waiting for recommendation...';
        $help_text = $this->settings->getSpecifiedSettingsVars(['status_page_help_text_submitted'])['status_page_help_text_submitted'];
    } else {
        $status = 'Incomplete';
        $help_text = $this->settings->getSpecifiedSettingsVars(['status_page_help_text_incomplete'])['status_page_help_text_incomplete'];
    }

      $profile = Profile::where('user_id', $user->id)->first();
      if ($profile) {
          $prof_complete = Profile::isComplete($user->id);
      }
      if ($application) {
          // Get recommendations
        $recommendations = Recommendation::where('application_id', $application->id)->get();
          $max_recs = Scholarship::getCurrentScholarship()->num_recommendations_max;
          $add_rec_link = link_to_route('recommendation.create', 'Add or Update Recommendations', null, ['class' => 'button -small']);

          foreach ($recommendations as $rec) {
              $rec->isRecommendationComplete($rec);
              if ($rec->isComplete($rec->id) && isset($app_filled_out) && $application->submitted) {
                  $status = 'Completed.';
                  $help_text = $this->settings->getSpecifiedSettingsVars(['status_page_help_text_complete'])['status_page_help_text_complete'];
              }
          }
      }

    // If both app & profile are complete add a link to review & submit.
    if ($app_filled_out && $prof_complete && !($application->submitted)) {
        $submit = link_to_route('review', 'Review & Submit Application', [$user->id], ['class' => 'button -small']);
    }

    // @TODO: $help_text got removed from getting merged into $vars... find out why.

    // @TODO: find a better way of retrieving the timeline in case there are other blocks to that type.
      $timeline = Cache::remember(120, 'query.block.timeline', function () {
          return Block::where('block_type', 'timeline')->select('block_body_html')->first();
      });
      if ($timeline) {
          $timeline = $timeline->block_body_html;
      }

      return view('status.index', compact('profile', 'application', 'recommendations', 'app_filled_out', 'app_submitted', 'prof_complete', 'submit', 'status', 'add_rec_link', 'timeline', 'help_text', 'closed', 'user'));
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
      $scholarship = Scholarship::getScholarshipLabels($application['scholarship_id']);

      $vars = (object) $this->settings->getSpecifiedSettingsVars(['application_submit_help_text']);

      $prof_complete = Profile::isComplete(Auth::user()->id);
      if (!$prof_complete) {
          return redirect()->route('status')->with('flash_message', ['text' => 'Please go back and answer all required questions in '.link_to_route('profile.create', 'basic info.'), 'class' => '-warning']);
      }

      return view('status.review', compact('application', 'profile', 'scholarship', 'vars'));
  }

  /**
   * Form submission handler for the review page.
   * This saves that the application has been submitted, making it uneditable to the user.
   */
  public function submit(Request $request)
  {
      $this->validate($request, $this->rules);

      $application = Application::where('user_id', Auth::user()->id)->firstorFail();
      $application->submitted = 1;
      $application->save();
      $application->checkGPA();

      $this->confirmationEmail();
      $recommendations = Recommendation::where('application_id', $application->id)->get();
      $max_recs = Scholarship::getCurrentScholarship()->num_recommendations_max;
      foreach ($recommendations as $rec) {
          if ($rec->isComplete($rec->id)) {
              return redirect()->route('status')->with('flash_message', ['text' => 'Sweet, you\'re all set!', 'class' => '-success']);
          }
      }
      if ($recommendations->count() == $max_recs) {
          return redirect()->route('status')->with('flash_message', ['text' => 'Sweet, just waiting on your recommendations.', 'class' => '-info']);
      }

      return redirect()->route('recommendation.create')->with('flash_message', ['text' => 'Your application has been submitted. Submit a recommendation request below.', 'class' => '-success']);
  }

    public function resendEmailRequest()
    {
        $rec_id = Input::get('id');
        $recommendation = Recommendation::whereId($rec_id)->firstOrFail();
        $token = $recommendation->generateRecToken($recommendation);

        $link = link_to_route('recommendation.edit', 'Please provide a recommendation', [$recommendation->id, 'token' => $token]);
        $email = new Email();
        $data = [
          'link'           => $link,
          'applicant_name' => Auth::user()->first_name.' '.Auth::user()->last_name,
        ];
        $email->sendEmail('request', 'recommender', $recommendation->email, $data);

        return redirect()->route('status')->with('flash_message', ['text' => 'We sent another email!', 'class' => '-success']);
    }

  /**
   * Sends email to applicant saying the rec request has been sent.
   */
  public function confirmationEmail()
  {
      $email = new Email();
      $email->sendEmail('submitted', 'applicant', Auth::user()->email);
  }
}
