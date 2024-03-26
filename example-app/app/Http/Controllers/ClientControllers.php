<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('web')->check()) {
            return view('frontend.home', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 0,
                'content' => '',
                'loi' => '',
            ]);
        }
        return view('frontend.home', ['activerity' => 0, 'content' => '', 'loi' => '']);
    }

    public function loadtrangchu()
    {
        return redirect()->intended('/');
    }
    public function logout()
    {
        User::where('id', Auth::guard('web')->user()->id)->update(['online' => 0]);
        Auth::guard('web')->logout();
        return  redirect()->intended('/');
    }
    public function login(Request $request)
    {

        try {
            $credentials = $request->validate([
                'input-name' => ['required'],
                'input-password' => ['required'],
            ]);
            $users = User::where("email", $request->input('input-name'))->first();

            if ($credentials) {
                if ($users->trangthai != 0) {
                    if (Hash::check($request->input('input-password'), $users->password)) {
                        Auth::guard('web')->login($users);
                        if (Auth::guard('web')->check()) {

                            User::where('id', Auth::guard('web')->user()->id)->update(['online' => 1]);
                            return redirect()->intended('/');
                        }
                    } else {
                       
                        return view('frontend.home', ['activerity' => 0, 'loi' => 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại']);
                    }
                } else {
                    return view('frontend.home', ['activerity' => 0, 'loi' => 'Tài khoản của bạn đã bị khóa vui lòng liên hệ Admin']);
                }
            } else {
                return view('frontend.home', ['activerity' => 0, 'loi' => '']);
            }
        } catch (Exception $e) {
            return view('frontend.home', ['activerity' => 0, 'loi' => '']);
        }
        return redirect()->intended('/');
    }
    public function loadyeuthich()
    {

        return view('frontend.menu.yeuthich', ['activerity' => 1, 'content' => '']);
    }

    public function loadlivechat()
    {
        return view('frontend.menu.livechat', ['activerity' => 2, 'content' => '']);
    }
    public function loadMchart()
    {

        return view('frontend.menu.Mchart', ['activerity' => 3, 'content' => '']);
    }
    public function loadranksong()
    {

        return view('frontend.menu.ranksong', ['activerity' => 4, 'content' => '']);
    }
    public function loadtopic()
    {

        return view('frontend.menu.topic', ['activerity' => 5, 'content' => '']);
    }
}