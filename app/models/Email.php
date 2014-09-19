<?php

class Email extends Eloquent {

  protected $fillable = ['subject', 'body'];

  public $timestamps = false;

  /**
   * @param $key - the key of which email to look for
   * @param $recipient - who is this email going to
   * @param $to - the email address to send the email to
   * @param $data - array of things to search and replace in the body of email.
   */
  public static function sendEmail($key, $recipient, $to, $data)
  {
    // Find the correct email.
    $email = Email::where('key', '=', $key)->where('recipient', '=' ,$recipient)->firstOrFail();
    $subject = $email->subject;
    $body = $email->body;

    // Replace all values in the body copy.
    foreach ($data as $find => $replace)
    {
      $body = str_replace('[' . $find . ']', $replace, $body);
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