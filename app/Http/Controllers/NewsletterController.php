<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

/**
 * Class NewsletterController
 *
 * This controller handles newsletter subscription functionality.
 */
class NewsletterController extends Controller
{
    /**
     * Store a new email address in the newsletters table.
     *
     * This method is used to subscribe a user to the newsletter by saving
     * their email address to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $newsletter = Newsletter::create([
            'email' => $request->input('email'),
        ]);
        return redirect()->route('index');
    }
}
