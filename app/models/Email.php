<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scholarship;
use Config;
use Mail;

class Email extends Model
{
    protected $fillable = ['subject', 'body'];

    public $timestamps = false;

  /**
   * @param $key - the key of which email to look for
   * @param $recipient - who is this email going to
   * @param $to - the email address to send the email to
   * @param $data - (optional) array of things to search and replace in the body of email.
   */
  public static function sendEmail($key, $recipient, $to, $data = [])
  {
      // Find the correct email.
    $email = self::where('key', '=', $key)->where('recipient', '=', $recipient)->firstOrFail();
      $subject = $email->subject;
      $body = $email->body;

    // add another array of vars used in many emails.
    // @TODO: in other places we had to get rid of pluck and just do something like ->table so
    //        make sure this works
    $default_data = [
      'status_page' => link_to_route('status', 'status page'),
      'faq_page'    => link_to('faq', 'FAQ page'),
      'home_page'   => link_to_route('home', Scholarship::getCurrentScholarship()->pluck('title')),
      'email'       => link_to('mailto:'.Config::get('mail.from.address'), Config::get('mail.from.address')),
      ];
      $data = array_merge($data, $default_data);
      if (isset($data)) {
          // Replace all values in the body copy.
      foreach ($data as $find => $replace) {
          $subject = str_replace('['.$find.']', $replace, $subject);
          $body = str_replace('['.$find.']', $replace, $body);
      }
      }

      $email_data = [
      'to'      => $to,
      'body'    => $body,
      'subject' => $subject,
      ];

    // Send off the message.
    Mail::queue('emails.email', $email_data, function ($message) use ($email_data) {
      $message->to($email_data['to'])->subject($email_data['subject']);
    });
  }
}
