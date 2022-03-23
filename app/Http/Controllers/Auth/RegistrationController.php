<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends Controller
{
    //

    public function __invoke(Request $request)
    {
        $user = User::create($request->all());
        //using validate will only give the validated field
        // $user = User::create($request->validate());
        return response($user, Response::HTTP_CREATED);

    }
}
