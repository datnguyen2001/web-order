<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\WalletsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('web.login');
    }

    public function submitLogin(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'))->with('success', 'Đăng nhập thành công!');
        } else {
            toastr()->error('Tên đăng nhập hoặc mật khẩu không đúng.');
            return redirect()->back();
        }
    }

    public function register()
    {
        return view('web.register');
    }

    public function submitRegister(RegisterRequest $request)
    {
        $validated = $request->validated();
        $email = User::where('email',$validated['email'])->first();
        if ($email){
            toastr()->error('Email đã tồn tại');
            return back();
        }
        $phone = User::where('phone',$validated['phone'])->first();
        if ($phone){
            toastr()->error('Số điện thoại đã tồn tại');
            return back();
        }

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'full_name' => $validated['full_name'],
            'password' => Hash::make($validated['password']),
        ]);

        $wallet = WalletsModel::create([
            'user_id' => $user->id,
            'vietnamese_money' => 0,
            'middle_money' => 0,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()
            ->route('home')
            ->with(['alert' => 'success', 'message' => 'Đăng xuất thành công']);
    }

}
