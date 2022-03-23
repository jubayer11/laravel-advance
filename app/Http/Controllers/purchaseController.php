<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use Illuminate\Http\Request;

class purchaseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function buy(Request $request)
    {
        purchase::create($request->all());
        return response(null,201);
    }
}
