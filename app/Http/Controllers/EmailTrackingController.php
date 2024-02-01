<?php

namespace App\Http\Controllers;

use App\Models\EmailTracking;
use Illuminate\Http\Request;
use Mail;
use App\Mail\EmailMail;


class EmailTrackingController extends Controller
{
    /**
     * Track email events (e.g., opened, deleted).
     *
     * @param  string  $token
     * @param  string  $email_id
     * @return \Illuminate\Http\Response
     */
    public function track($token, $email_id)
    {
        // Retrieve the tracking record from the database based on the provided token and email_id
        $trackingRecord = EmailTracking::where('tracking_token', $token)
            ->where('email_id', $email_id)
            ->first();

        if ($trackingRecord) {
            // Update the status based on the specific event (e.g., opened, deleted)
            $trackingRecord->update(['status' => 'opened']);

            // Return a pixel image (1x1 transparent) for the tracking pixel
            $pixel = base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
            return response($pixel)->header('Content-Type', 'image/gif');
        } else {
            // Handle the case when the tracking record is not found
            abort(404);
        }
    }

    public function sendEmail()
    {
        // You can customize this data according to your needs
        $data = [
            'name' => 'John Doe',
            'email' => 'r1abdullah4401@gmail.com',
        ];
    
        try {
            // Send the email using the EmailMail Mailable class and pass the data
            Mail::to($data['email'])->send(new EmailMail($data));
    
    
            return response()->json(['message' => 'Email sent successfully'], 200);
        } catch (\Exception $e) {
            // Handle exceptions, log, or display an error message
            return response()->json(['message' => 'Error sending email', 'error' => $e->getMessage()], 500);
        }
    }
    
}
