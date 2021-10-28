<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(string $username)
    {
        $boards = parent::getAllBoards();

        $user = User::where('username', $username) -> first();
        if(isset($user) == false) return abort(404);

        $webAuthn_credentials = $user->webAuthnCredentials()->get()->all();

        $credentials = array();
        foreach ($webAuthn_credentials as $webAuthn_credential) {
            $json_credential = $webAuthn_credential->jsonSerialize();
            array_push($credentials, $json_credential);
        }

        $user_devices = $user->device()->get()->all();

        $devices = array();
        foreach ($user_devices as $user_device) {
            if($user_device['ip'] == "::1") continue;
            $json_device = $user_device->jsonSerialize();
            array_push($devices, $json_device);
        }

        return view('user.show')->with(compact('boards', 'user', 'credentials', 'devices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function AuthRouteAPI(Request $request){
        return $request->user();
    }
}
