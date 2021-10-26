<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DarkGhostHunter\Larapass\Http\RecoversWebAuthn;
use Illuminate\Http\Request;

class WebAuthnRecoveryController extends Controller
{
    use RecoversWebAuthn;

    /*
    |--------------------------------------------------------------------------
    | WebAuthn Recovery Controller
    |--------------------------------------------------------------------------
    |
    | When an user loses his device he will reach this controller to attach a
    | new device. The user will attach a new device, and optionally, disable
    | all others. Then he will be authenticated and redirected to your app.
    |
    */

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('throttle:10,1')->only('options', 'recover');
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showResetForm(Request $request)
    {
        if ($request->missing('token', 'email')) {
            return redirect()->route('webauthn.lost.form');
        }

        return view('webauthn.recover')->with(
            ['token' => $request->query('token'), 'email' => $request->query('email')]
        );
    }
}
