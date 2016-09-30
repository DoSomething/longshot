<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mail;

class Email extends Model
{
    protected $fillable = ['key', 'recipient', 'subject', 'body'];

    public $timestamps = false;

  /**
   * @param $key - the key of which email to look for
   * @param $recipient - who is this email going to
   * @param $to - the email address to send the email to
   * @param $data - (optional) array of things to search and replace in the body of email.
   */
  public static function sendEmail($key, $recipient, $to, $extra_tokens = [])
  {
      // Find the correct email.
      $email = self::where('key', '=', $key)->where('recipient', '=', $recipient)->firstOrFail();

      // should we just put all the tokens in here?
      // add another array of vars used in many emails.
      // @TODO: in other places we had to get rid of pluck and just do something like ->table so
      //        make sure this works
      $tokens = [
        ':status_page:' => link_to_route('status', 'status page'),
        ':faq_page:'    => link_to('faq', 'FAQ page'),
        ':home_page:'   => link_to_route('home', Scholarship::getCurrentScholarship()->title),
        ':email:'       => link_to('mailto:'.Scholarship::getCurrentScholarship()->email_from_address, Scholarship::getCurrentScholarship()->email_from_address),
      ];

      $tokens = array_merge($tokens, $extra_tokens);

      $subject = $email->subject;
      $body = $email->body;

      // Replace all the tokens
      $body = str_replace(array_keys($tokens), array_values($tokens), $body);
      $subject = str_replace(array_keys($tokens), array_values($tokens), $subject);

      $email_data = [
        'to'      => $to,
        'body'    => $body,
        'subject' => $subject,
      ];

      // Send off the message.
      Mail::queue('emails.email', $email_data, function ($message) use ($email_data) {
          $message->to($email_data['to'])->subject($email_data['subject']);
          $message->from(Scholarship::getCurrentScholarship()->email_from_address, Scholarship::getCurrentScholarship()->email_from_name);
      });
  }
}
