<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DarkGhostHunter\Larapass\Http\SendsWebAuthnRecoveryEmail;

class WebAuthnDeviceLostController extends Controller
{
    use SendsWebAuthnRecoveryEmail;

    /*
    |--------------------------------------------------------------------------
    | WebAuthn Device Lost Controller
    |--------------------------------------------------------------------------
    |
    | This is a convenience controller that will allow your users who have lost
    | their WebAuthn device to register another without using passwords. This
    | will send him a link to his email to create new WebAuthn credentials.
    |
    */

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the Account Recovery form.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function showDeviceLostForm()
    {
        return view('webauthn.lost');
    }
}
