<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Twilio\Rest\Client;

class ConfirmationToken
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && !$request->user()->hasVerifiedPhoneNumber()) {
            $token = random_int(100000, 999999);
            Cache::put('confirmation_token_' . $request->user()->id, $token, 300);
            // Send the token to the user's phone number
            $this->sendToken($request->user()->phone_number, $token);
        }

        return $next($request);
    }

    private function sendToken($phoneNumber, $token)
    {
        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_FROM');

        $client = new Client($accountSid, $authToken);

        $client->messages->create(
            $phoneNumber,
            [
                'from' => $twilioPhoneNumber,
                'body' => "Your confirmation number is: {$token}",
            ]
        );
    }
}