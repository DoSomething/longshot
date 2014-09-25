<?php

class Email extends Eloquent {

  protected $fillable = ['subject', 'body'];

  public $timestamps = false;

  /**
   * @param $key - the key of which email to look for
   * @param $recipient - who is this email going to
   * @param $to - the email address to send the email to
   * @param $data - (optional) array of things to search and replace in the body of email.
   */
  public static function sendEmail($key, $recipient, $to, $data = array())
  {
    // Find the correct email.
    $email = Email::where('key', '=', $key)->where('recipient', '=' , $recipient)->firstOrFail();
    $subject = $email->subject;
    $body = $email->body;

    // add another array of vars used in many emails.
    $default_data = array(
      'status_page' => link_to_route('status', 'status page'),
      'faq_page'    => link_to('faq', 'FAQ page'),
      'home_page'   => link_to_route('home', 'Foot Locker Scholar Athletes'),
      'email'       => link_to('mailto:footlocker@tmiagency.org', 'footlocker@tmiagency.org'),
      );
    $data = array_merge($data, $default_data);
    if (isset($data)) {
       // Replace all values in the body copy.
      foreach ($data as $find => $replace)
      {
        $body = str_replace('[' . $find . ']', $replace, $body);
      }
    }

    $email_data = array(
      'to' => $to,
      'body' => $body,
      'subject' => $subject,
      );

    // Send off the message.
    Mail::send('emails.email', $email_data, function($message) use ($email_data)
    {
      $message->to($email_data['to'])->subject($email_data['subject']);
    });

  }
}