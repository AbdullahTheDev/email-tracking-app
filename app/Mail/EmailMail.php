<?php
// app/Mail/EmailMail.php

namespace App\Mail;

use App\Models\EmailTracking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class EmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Declare a public variable to store the data

    /**
     * Create a new message instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data; // Store the data in the class variable
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $trackingToken = Str::random(30);
        $emailId = Str::uuid();

        // Save the tracking record to the database
        EmailTracking::create([
            'email_id' => $emailId,
            'status' => 'sent',
            'tracking_token' => $trackingToken,
        ]);

        return $this->view('email.email')
            ->with(['emailId' => $emailId, 'trackingToken' => $trackingToken, 'data' => $this->data])
            ->subject('Email Mail');
    }
}
