<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DarkGhostHunter\Larapass\Http\RegistersWebAuthn;

class WebAuthnRegisterController extends Controller
{
    use RegistersWebAuthn;

    /*
    |--------------------------------------------------------------------------
    | WebAuthn Registration Controller
    |--------------------------------------------------------------------------
    |
    | This controller receives an user request to register a device and also
    | verifies the registration. If everything goes ok, the credential is
    | persisted into the application, otherwise it will signal failure.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the password confirmation view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function showWebAuthnRegisterForm()
    {
        return view('webauthn.register');
    }
}
