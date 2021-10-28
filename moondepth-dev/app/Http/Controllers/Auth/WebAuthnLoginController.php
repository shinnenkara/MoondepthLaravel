<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DarkGhostHunter\Larapass\Http\AuthenticatesWebAuthn;
use Illuminate\Http\Request;

class WebAuthnLoginController extends Controller
{
    use AuthenticatesWebAuthn;

    /*
    |--------------------------------------------------------------------------
    | WebAuthn Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller allows the WebAuthn user device to request a login and
    | return the correctly signed challenge. Most of the hard work is done
    | by your Authentication Guard once the user is attempting to login.
    |
    */

    public function __construct()
    {
        $this->middleware(['guest', 'throttle:10,1']);
    }

    /**
     * Log the user in.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $previous_link = session('url.intended');

        $credential = $request->validate($this->assertionRules());

        if(isset($previous_link))
            session(['url.intended' => $previous_link]);

        if ($authenticated = $this->attemptLogin($credential, $this->hasRemember($request))) {
            return $this->authenticated($request, $this->guard()->user()) ?? response()->noContent();
        }

        return response()->noContent(422);
    }

    /**
     * Display the credential login view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function showWebAuthnLoginForm()
    {
        return view('webauthn.login');
    }
}
