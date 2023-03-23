<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function listCart()
    {

    }

    public function create(Request $request)
    {
        dd($request->toArray());
    }
}
