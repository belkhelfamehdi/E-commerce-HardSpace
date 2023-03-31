<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PhoneVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('auth.verify-phone');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'confirmation_number' => 'required|integer|min:100000|max:999999',
        ]);

        $token = Cache::get('confirmation_token_' . $request->user()->id);

        if ($request->confirmation_number == $token) {
            $request->user()->markPhoneNumberAsVerified();
            Cache::forget('confirmation_token_' . $request->user()->id);
            return redirect()->route('index')->with('success', 'Phone number verified.');
        } else {
            return back()->withErrors(['confirmation_number' => 'The provided confirmation number is incorrect.']);
        }
    }
}
