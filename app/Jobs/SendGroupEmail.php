<?php

namespace App\Jobs;

use Mail;
use App\Jobs\Job;
use App\Models\Email;
use App\Models\Export;
use App\Models\Scholarship;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendGroupEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $exportName;
    protected $exportFunction;
    protected $adminEmail;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($exportName, $exportFunction, $adminEmail)
    {
        $this->exportName = $exportName;
        $this->exportFunction = $exportFunction;
        $this->adminEmail = $adminEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Export $export)
    {
        info('Sending Group Email: ' . $this->exportFunction);

        // Run the export query
        $query_result = $export->{$this->exportFunction}();

        $email = new Email();

        // For each result, construct and send the email
        $tokens = [];
        foreach ($query_result as $row) {
            // Grab the email address
            $send_to = $row->email;

            // Define row specific tokens
            if (isset($row->first_name)) {
                $tokens[':first_name:'] = $row->first_name;
            }
            if (isset($row->last_name)) {
                $tokens[':last_name:'] = $row->last_name;
            }

            // Send it by passing in key, recipient, to, and extra tokens
            $email->sendEmail($this->exportName, 'group', $send_to, $tokens);

            info($this->exportFunction . ' email sent to: ' . $send_to);
        }

        // Notify us that the emails have all been queued
        info('DONE Group Emails all queued: ' . $this->exportFunction);
        Mail::raw('DONE Queuing Group Email: ' . $this->exportFunction, function ($message) {
            $message->to($this->adminEmail);
            $message->subject('Done Queuing Group Email: ' . $this->exportFunction);
            $message->from(Scholarship::getCurrentScholarship()->email_from_address, Scholarship::getCurrentScholarship()->email_from_name);
        });
    }
}
