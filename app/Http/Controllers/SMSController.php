<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function sendSMS()
{
    $to = '+213674666757'; // The recipient's phone number
    $message = 'This is a test message'; // The SMS message text

    $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

    $twilio->messages->create(
        $to,
        array(
            'from' => env('TWILIO_FROM'),
            'body' => $message,
        )
    );

    return 'SMS sent successfully!';
}
}
