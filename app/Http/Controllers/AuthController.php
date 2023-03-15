<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Constants\Constant;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        dd($request);
        if (! $token = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
    }

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone
        ]);

        return redirect()->route('register')->with(Constant::MSG_SUCCESS, trans('register_success'));
    }


    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    public function changePassWord(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'old_password' => 'required|string|min:6',
        //     'new_password' => 'required|string|confirmed|min:6',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors()->toJson(), 400);
        // }
        $userId = auth()->user()->id;

        $user = User::where('id', $userId)->update(
            ['password' => bcrypt($request->new_password)]
        );

        return response()->json([
            'message' => 'User successfully changed password',
            'user' => $user,
        ], 201);
    }
}
