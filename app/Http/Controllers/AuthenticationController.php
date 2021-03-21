<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function authentication(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();


        if (
            is_null($user)
            || Hash::check($request->password, $user->password)
        ) {
            return response()->json(["error" => "Email or password invalid."], 401);
        }

        $token = JWT::encode(
            [
                'email' => $request->email
            ],
            env('JWT_KEY')
        );

        return [
            'access_token' => $token
        ];
    }
}
