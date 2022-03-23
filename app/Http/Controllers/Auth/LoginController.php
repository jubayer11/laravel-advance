<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    //

    public function __invoke(Request $request)
    {

        $user = User::where(['email' => $request->email])->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response('credentials not match', Response::HTTP_UNAUTHORIZED);
        }


        $token = $user->createToken('auth_token');


        return response(['token' => $token->plainTextToken]);
    }
}
