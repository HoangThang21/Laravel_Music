<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Nghesi;
use App\Models\Nhac;
use App\Models\User;
use App\Models\UserAPI;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;

class ClientControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Auth::guard('web')->logout();
        // Auth::guard('google')->logout();
        if (Auth::guard('web')->check()) {
            return view('frontend.home', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 0,
                'content' => '',
                'loi' => '',
                'Albumtop3' => Album::latest()->take(3)->get(),
                'Chill' => Album::inRandomOrder()->take(3)->get(),
                'CanLike' => Album::inRandomOrder()->take(3)->get(),
                'Nhactop10' => Nhac::where('xetduyet', 1)->latest()->take(10)->get(),
                'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
            ]);
        }
        if (Auth::guard('google')->check()) {
            return view('frontend.home', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 0,
                'content' => '',
                'loi' => '',
                'Albumtop3' => Album::latest()->take(3)->get(),
                'Chill' => Album::inRandomOrder()->take(3)->get(),
                'CanLike' => Album::inRandomOrder()->take(3)->get(),
                'Nhactop10' => Nhac::where('xetduyet', 1)->latest()->take(10)->get(),
                'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
            ]);
        }
        return view('frontend.home', [
            'activerity' => 0,
            'Albumtop3' => Album::latest()->take(3)->get(),
            'Chill' => Album::inRandomOrder()->take(3)->get(),
            'CanLike' => Album::inRandomOrder()->take(3)->get(),
            'Nhactop10' => Nhac::where('xetduyet', 1)->latest()->take(10)->get(),
            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'content' => '',
            'loi' => '',
        ]);
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
    public function logingg()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        $user = Socialite::driver('google')->user();
        $userxacthuc = UserAPI::updateOrCreate([
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'email' => $user->email,
            'quyen' => 3,
            'trangthai' => 1,
        ]);
        Auth::guard('google')->logout();
        Auth::guard('google')->login($userxacthuc);
        UserAPI::where('email', $userxacthuc->email)->update(['online' => 1]);
        return redirect()->intended('/');
    }
    public function loadyeuthich()
    {

        return view('frontend.menu.yeuthich', ['activerity' => 1, 'loi' => '', 'content' => '']);
    }

    public function loadlivechat()
    {
        return view('frontend.menu.livechat', ['activerity' => 2,  'loi' => '', 'content' => '']);
    }
    public function loadMchart()
    {

        return view('frontend.menu.Mchart', ['activerity' => 3, 'loi' => '', 'content' => '']);
    }
    public function loadranksong()
    {

        return view('frontend.menu.ranksong', [
            'activerity' => 4,
            'loi' => '',
            'content' => '',
            'Nhactop10' => Nhac::orderBy('luotnghe', 'desc')->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
        ]);
    }
    public function loadtopic()
    {

        return view('frontend.menu.topic', ['activerity' => 5, 'content' => '', 'loi' => '',]);
    }
}