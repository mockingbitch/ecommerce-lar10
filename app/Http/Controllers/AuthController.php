<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Constants\Constant;

class AuthController extends Controller
{
    public function viewLogin() : View
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     *
     * @return RedirectResponse
     */
    public function login(LoginRequest $request) : RedirectResponse
    {
        if (! $user = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->back()->with(Constant::MSG_ERROR, trans('auth_failed'));
        }

        return redirect()->route('home')->with(Constant::MSG_INFO, trans('auth_success'));
    }

    /**
;     * @return View
     */
    public function viewRegister() : View
    {
        return view('auth.register');
    }

    /**
     * @param RegisterRequest $request
     *
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request) : RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone
        ]);

        return redirect()->route('register')->with(Constant::MSG_SUCCESS, trans('register_success'));
    }

    /**
     * @return RedirectResponse
     */
    public function logout() : RedirectResponse
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
