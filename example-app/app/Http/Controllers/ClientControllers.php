<?php

namespace App\Http\Controllers;

use App\Events\CallLoad;
use App\Models\Album;
use App\Models\Mess;
use App\Models\Nghesi;
use App\Models\Nhac;
use App\Models\Ranks;
use App\Models\Theloai;
use App\Models\User;
use App\Models\UserAPI;
use Carbon\Carbon;
use Carbon\Exceptions\Exception as ExceptionsException;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

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
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',
                'Albumtop3' => Album::latest()->take(3)->get(),
                'Chill' => Album::inRandomOrder()->take(3)->get(),
                'CanLike' => Album::inRandomOrder()->take(3)->get(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
                'login' => 0,
                'user'=>User::select('id','image')->get(),
                'rank' => 'null', 'valuesreach' => '',
                'rightsong' => 0,
            ]);
        }
        if (Auth::guard('google')->check()) {

            return view('frontend.home', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',
                'Albumtop3' => Album::latest()->take(3)->get(),
                'Chill' => Album::inRandomOrder()->take(3)->get(),
                'CanLike' => Album::inRandomOrder()->take(3)->get(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
                'login' => 0,
                'user'=>User::select('id','image')->get(),
                'rank' => 'null', 'valuesreach' => '',
                'rightsong' => 0,
            ]);
        }

        return view('frontend.home', [
            'activerity' => 0,
            'Albumtop3' => Album::latest()->take(3)->get(),
            'Chill' => Album::inRandomOrder()->take(3)->get(),
            'CanLike' => Album::inRandomOrder()->take(3)->get(),
            'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
            'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'chatonline' => '',
            'loi' => '',
           'user'=>User::select('id','image')->get(),
            'loingoai' => '',
            'login' => 0,
            'rank' => 'null', 'valuesreach' => '',
            'rightsong' => 0,
        ]);
    }

    public function loadtrangchu()
    {
        return redirect()->intended('/');
    }
    public function logout()
    {
        if (Auth::guard('web')->check()) {
            User::where('id', Auth::guard('web')->user()->id)->update(['online' => 0]);

            Auth::guard('web')->logout();
        }
        if (Auth::guard('google')->check()) {

            UserAPI::where('id', Auth::guard('google')->user()->id)->update(['online' => 0]);
            Auth::guard('google')->logout();
            // $googleLogoutUrl = 'https://accounts.google.com/logout?continue=https://www.google.com';
            // return redirect()->to($googleLogoutUrl);
        }
        return  redirect()->intended('/');
    }
    public function login(Request $request)
    {

        try {
            $credentials = $request->validate([
                'input-name' => ['required'],
                'input-password' => ['required'],
            ]);
            if (Auth::guard('web')->check()) {
                User::where('id', Auth::guard('web')->user()->id)->update(['online' => 0]);

                Auth::guard('web')->logout();
            }
            if (Auth::guard('google')->check()) {

                UserAPI::where('id', Auth::guard('google')->user()->id)->update(['online' => 0]);
                Auth::guard('google')->logout();
            }
            $users = User::where("email", $request->input('input-name'))->first();
            if ($users->trangthai == 0) {
                return view(
                    'frontend.home',
                    [
                        'login' => 1,
                        'activerity' => 0, 'chatonline' => '',
                        'Albumtop3' => Album::latest()->take(3)->get(),
                        'Chill' => Album::inRandomOrder()->take(3)->get(),
                        'CanLike' => Album::inRandomOrder()->take(3)->get(),
                        'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                        'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                        'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                        'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                        'nghesi' => Nghesi::all(),
                        'album' => Album::all(),
                        'valuesreach' => '',
                        'loingoai' => '',
                        'loi' => 'Tài khoản bị khóa vui lòng liên hệ Admin qua Email:mobi@gmail.com',
                        'rank' => 'null',
                        'rightsong' => 0,
                    ]
                );
            } else {
                if ($credentials) {
                    if ($users->trangthai != 0) {
                        if (Hash::check($request->input('input-password'), $users->password)) {
                            Auth::guard('web')->login($users);
                            if (Auth::guard('web')->check()) {
                                User::where('id', Auth::guard('web')->user()->id)->update(['online' => 1]);
                                return redirect()->intended('/')->with('loingoai', 'Đăng nhập thành công');
                            }
                        } else {

                            return view(
                                'frontend.home',
                                [
                                    'login' => 1,
                                    'activerity' => 0, 'chatonline' => '',
                                    'Albumtop3' => Album::latest()->take(3)->get(),
                                    'Chill' => Album::inRandomOrder()->take(3)->get(),
                                    'CanLike' => Album::inRandomOrder()->take(3)->get(),
                                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                                    'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                                    'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                                    'nghesi' => Nghesi::all(),
                                    'album' => Album::all(),
                                    'valuesreach' => '',
                                    'loingoai' => '',
                                    'loi' => 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại',
                                    'rank' => 'null',
                                    'rightsong' => 0,
                                ]
                            );
                        }
                    } else {
                        return view('frontend.home', [
                            'login' => 1,
                            'activerity' => 0, 'chatonline' => '',
                            'Albumtop3' => Album::latest()->take(3)->get(),
                            'Chill' => Album::inRandomOrder()->take(3)->get(),
                            'CanLike' => Album::inRandomOrder()->take(3)->get(),
                            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                            'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                            'nghesi' => Nghesi::all(),
                            'album' => Album::all(),
                            'valuesreach' => '',
                            'loingoai' => '',
                            'loi' => 'Tài khoản của bạn đã bị khóa vui lòng liên hệ Admin',
                            'rank' => 'null',
                            'rightsong' => 0,
                        ]);
                    }
                } else {
                    return view('frontend.home', [
                        'login' => 1,
                        'activerity' => 0, 'chatonline' => '',
                        'Albumtop3' => Album::latest()->take(3)->get(),
                        'Chill' => Album::inRandomOrder()->take(3)->get(),
                        'CanLike' => Album::inRandomOrder()->take(3)->get(),
                        'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                      'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                        'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                        'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                        'nghesi' => Nghesi::all(),
                        'album' => Album::all(),
                        'valuesreach' => '',
                        'loi' => '',
                        'loingoai' => '',
                        'rank' => 'null',
                        'rightsong' => 0,
                    ]);
                }
            }
        } catch (Exception $e) {
            return view('frontend.home', [
                'login' => 1,
                'activerity' => 0, 'chatonline' => '',
                'Albumtop3' => Album::latest()->take(3)->get(),
                'Chill' => Album::inRandomOrder()->take(3)->get(),
                'CanLike' => Album::inRandomOrder()->take(3)->get(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
                'valuesreach' => '',
                'loingoai' => '',
                'loi' => 'Nhập không đúng. Vui lòng nhập lại',
                'rank' => 'null',
                'rightsong' => 0,
            ]);
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
        Auth::guard('google')->login(UserAPI::where('email', $userxacthuc->email)->first());
        UserAPI::where('email', $userxacthuc->email)->update(['online' => 1]);

        return redirect()->intended('/');
    }
    public function loadyeuthich()
    {
        if (Auth::guard('web')->check()) {
            return view('frontend.menu.yeuthich', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 1,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',

                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nghesi' => Nghesi::all(),
                'nhac' => Nhac::all(),
                'theloai' => Theloai::all(),
                'album' => Album::all(),
                'login' => 0,
                'rank' => 'null',
                'rightsong' => 1, 'valuesreach' => '',
            ]);
        }
        if (Auth::guard('google')->check()) {

            return view('frontend.menu.yeuthich', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 1,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nghesi' => Nghesi::all(),
                'nhac' => Nhac::all(),
                'theloai' => Theloai::all(),
                'album' => Album::all(),
                'login' => 0,
                'rank' => 'null',
                'rightsong' => 1, 'valuesreach' => '',
            ]);
        }
        return view('frontend.home', [
            'activerity' => 0, 'chatonline' => '',
            'Albumtop3' => Album::latest()->take(3)->get(),
            'Chill' => Album::inRandomOrder()->take(3)->get(),
            'CanLike' => Album::inRandomOrder()->take(3)->get(),
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'valuesreach' => '',
            'loingoai' => '',
            'loi' => 'Vui lòng đăng nhập để xem nhạc đã yêu thích.',
            'login' => 1,
            'rank' => 'null',
            'rightsong' => 0,
        ]);
    }

    public function loadlivechat()
    {
        if (Auth::guard('web')->check()) {
            if(Auth::guard('web')->user()->quyenchat==1){
                return view('frontend.menu.livechat', [
                    'ttnguoidung' => Auth::guard('web')->user(),
                    'chat' => Mess::all(),
                    'nhac' => Nhac::where('vip', 0)->get(),
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'namemusic' => '',
                    'activerity' => 2,
                    'loi' => '',
                    'loingoai' => '',
                    'chatonline' => [User::where('online', 1)->get(), UserAPI::where('online', 1)->get()],
                    'login' => 0,
                    'rank' => 'null',
                    'rightsong' => 0, 'valuesreach' => '',
                ]);
            }else{
                return view('frontend.home', [
                    'ttnguoidung' => Auth::guard('web')->user(),
                    'activerity' => 0,
                    'Albumtop3' => Album::latest()->take(3)->get(),
                    'Chill' => Album::inRandomOrder()->take(3)->get(),
                    'CanLike' => Album::inRandomOrder()->take(3)->get(),
                    'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                    'nghesi' => Nghesi::all(),
                    'album' => Album::all(),
                    'chatonline' => '',
                    'loi' => '',
                   
                    'loingoai' => 'Tài khoản đã bị cấm chat vui lòng liên hệ admin qua Email: mobi@gmail.com',
                    'login' => 0,
                    'rank' => 'null', 'valuesreach' => '',
                    'rightsong' => 0,
                ]);
            }
            
        }
        if (Auth::guard('google')->check()) {
            if(Auth::guard('google')->user()->quyenchat==1){
                return view('frontend.menu.livechat', [
                    'ttnguoidung' => Auth::guard('google')->user(),
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'chat' => Mess::all(),
                    'nhac' => Nhac::where('vip', 0)->get(),
                    'namemusic' => '',
                    'activerity' => 2,
                    'loi' => '',
                    'loingoai' => '',
                    'chatonline' => [User::where('online', 1)->get(), UserAPI::where('online', 1)->get()],
                    'login' => 0,
                    'rank' => 'null',
                    'rightsong' => 0, 'valuesreach' => '',
                ]);
            }
            else{
                return view('frontend.home', [
                    'ttnguoidung' => Auth::guard('google')->user(),
                    'activerity' => 0,
                    'Albumtop3' => Album::latest()->take(3)->get(),
                    'Chill' => Album::inRandomOrder()->take(3)->get(),
                    'CanLike' => Album::inRandomOrder()->take(3)->get(),
                    'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                    'nghesi' => Nghesi::all(),
                    'album' => Album::all(),
                    'chatonline' => '',
                    'loi' => '',
                   
                    'loingoai' => 'Tài khoản đã bị cấm chat vui lòng liên hệ admin qua Email: mobi@gmail.com',
                    'login' => 0,
                    'rank' => 'null', 'valuesreach' => '',
                    'rightsong' => 0,
                ]);
            }
           
        }
        return view('frontend.home', [
            'activerity' => 0,
            'Albumtop3' => Album::latest()->take(3)->get(),
            'Chill' => Album::inRandomOrder()->take(3)->get(),
            'CanLike' => Album::inRandomOrder()->take(3)->get(),
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'chatonline' => [],
            'loi' => 'Vui lòng đăng nhập để chat.',
            'loingoai' => '',
            'login' => 1,
            'rank' => 'null', 'valuesreach' => '',
            'rightsong' => 0,
        ]);
    }
    public function loadlivechatsendchat(string $name)
    {
        if (Auth::guard('web')->check()) {
          
            return view('frontend.menu.livechat', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'chat' => Mess::all(),
                'nhac' => Nhac::where('vip', 0)->get(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'namemusic' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('id', $name)->first(),
                'activerity' => 2,
                'loi' => '',
                'loingoai' => '',
                'chatonline' => [User::where('online', 1)->get(), UserAPI::where('online', 1)->get()],
                'login' => 0,
                'rank' => 'null',
                'rightsong' => 0, 'valuesreach' => '',
            ]);
        }
        if (Auth::guard('google')->check()) {
            return view('frontend.menu.livechat', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'chat' => Mess::all(),
                'nhac' => Nhac::where('vip', 0)->get(),
                'namemusic' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('id', $name)->first(),
                'activerity' => 2,
                'loi' => '',
                'loingoai' => '',
                'chatonline' => [User::where('online', 1)->get(), UserAPI::where('online', 1)->get()],
                'login' => 0,
                'rank' => 'null',
                'rightsong' => 0, 'valuesreach' => '',
            ]);
        }
        return view('frontend.home', [
            'activerity' => 0,
            'Albumtop3' => Album::latest()->take(3)->get(),
            'Chill' => Album::inRandomOrder()->take(3)->get(),
            'CanLike' => Album::inRandomOrder()->take(3)->get(),
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'chatonline' => [],
            'loi' => 'Vui lòng đăng nhập để chat.',
            'loingoai' => '',
            'login' => 1,
            'rank' => 'null', 'valuesreach' => '',
            'rightsong' => 0,
        ]);
    }
    public function sendchat(Request $request)
    {

        try {
            $arr = '';
            foreach (explode("\r\n", $request->input('message-input')) as $message) {
                $arr = $arr . "<p>$message</p>";
            };
            $mess = new Mess();
            if (Auth::guard('web')->check()) {
                $userid = Auth::guard('web')->user();
                $mess->iduser = $userid->id;
            }
            if (Auth::guard('google')->check()) {
                $userid = Auth::guard('google')->user();
                $mess->idusergg = $userid->id;
            }

            $mess->tenuser = $userid->name;

            $mess->hinhuser = $userid->image;
            if ($request->input('linknhac')) {
                $mess->idnhac = $request->input('linknhac');
            }
            $mess->noidung = $arr;
            $mess->time = Carbon::now();;
            $mess->save();
            event(new CallLoad('Success'));
            return  redirect()->intended('/livechat');
        } catch (Exception $e) {
            return  redirect()->intended('/livechat');
        }
    }
    public function changettuser(Request $request)
    {
        $loi = $request->validate([
            'txtname' => ['required'],
            'txtemail' => ['required'],
        ]);
        if ($loi) {
            if (Auth::guard('web')->check()) {
                if ($request->file('inputImage') != null) {
                    $generatedimage = 'image' . time() . '-' . $request->file('inputImage')->getClientOriginalName();
                    $request->file('inputImage')->move(public_path('images'), $generatedimage);
                    $user = User::where("email", Auth::guard('web')->user()->email)->update(
                        [
                            'name' => $request->input('txtname'),
                            'sdt' => $request->input('txtsdt'),
                            'image' => $generatedimage,

                        ]
                    );
                    $mess = Mess::where('iduser', Auth::guard('web')->user()->id)->update([
                        'tenuser' => $request->input('txtname'),
                        'hinhuser' => $generatedimage,
                    ]);
                    return redirect()->intended('/thongtin-user');
                } else {
                    $user = User::where("email", Auth::guard('web')->user()->email)->update(
                        [
                            'name' => $request->input('txtname'),
                            'sdt' => $request->input('txtsdt'),
                        ]
                    );
                    $mess = Mess::where('iduser', Auth::guard('web')->user()->id)->update([
                        'tenuser' => $request->input('txtname'),

                    ]);
                    return redirect()->intended('/thongtin-user');
                }
            }
            if (Auth::guard('google')->check()) {
                if ($request->file('inputImage') != null) {
                    $generatedimage = 'image' . time() . '-' . $request->file('inputImage')->getClientOriginalName();
                    $request->file('inputImage')->move(public_path('images'), $generatedimage);
                    $user = UserAPI::where("email", Auth::guard('google')->user()->email)->update(
                        [
                            'name' => $request->input('txtname'),
                            'sdt' => $request->input('txtsdt'),
                            'image' => $generatedimage,

                        ]
                    );
                    $mess = Mess::where('idusergg', Auth::guard('google')->user()->id)->update([
                        'tenuser' => $request->input('txtname'),
                        'hinhuser' => $generatedimage,
                    ]);
                    return redirect()->intended('/thongtin-user');
                } else {
                    $user = UserAPI::where("email", Auth::guard('google')->user()->email)->update(
                        [
                            'name' => $request->input('txtname'),
                            'sdt' => $request->input('txtsdt'),
                        ]
                    );
                    $mess = Mess::where('iduser', Auth::guard('google')->user()->id)->update([
                        'tenuser' => $request->input('txtname'),
                    ]);
                    return redirect()->intended('/thongtin-user');
                }
            }
        } else {
            if (Auth::guard('web')->check()) {
                return view('frontend.menu.thongtinuser', [
                    'ttnguoidung' => Auth::guard('web')->user(), 'chatonline' => '',
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'nhac' => Nhac::where('vip', 0)->get(),
                    'namemusic' => '',
                    'activerity' => 0,
                    'loi' => '',
                    'loingoai' => '',
                    'valuesreach' => '',
                    'login' => 0,
                    'rank' => 'null',
                    'rightsong' => 1,
                ]);
            }
            if (Auth::guard('google')->check()) {
                return view('frontend.menu.thongtinuser', [
                    'ttnguoidung' => Auth::guard('google')->user(), 'chatonline' => '',
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'nhac' => Nhac::where('vip', 0)->get(),
                    'namemusic' => '',
                    'activerity' => 0,
                    'loi' => '',
                    'loingoai' => '',
                    'valuesreach' => '',
                    'login' => 0,
                    'rank' => 'null',
                    'rightsong' => 1,
                ]);
            }
        }
    }
    public function changepassttuser(Request $request)
    {
        $loi = $request->validate([
            'txtmkcu' => ['required'],
            'txtmkmoi' => ['required'],
            'txtxnmkmoi' => ['required'],
        ]);

        if ($loi) {
            if ($request->input('txtmkmoi') == $request->input('txtxnmkmoi')) {
                if (Auth::guard('web')->check()) {
                    if (Hash::check($request->input('txtmkcu'),  Auth::guard('web')->user()->password)) {
                        $user = User::where("email", Auth::guard('web')->user()->email)->update(
                            [
                                'password' => Hash::make($request->input('txtxnmkmoi')),
                            ]
                        );
                        User::where('id', Auth::guard('web')->user()->id)->update(['online' => 0]);
                        Auth::guard('web')->logout();
                        return view('frontend.home', [
                            'ttnguoidung' => Auth::guard('web')->user(),
                            'activerity' => 0, 'chatonline' => '',
                            'loi' => '',
                            'loingoai' => '',
                            'Albumtop3' => Album::latest()->take(3)->get(),
                            'Chill' => Album::inRandomOrder()->take(3)->get(),
                            'CanLike' => Album::inRandomOrder()->take(3)->get(),
                            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                            'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                            'nghesi' => Nghesi::all(),
                            'album' => Album::all(),
                            'login' => 1,
                            'rank' => 'null',
                            'rightsong' => 0, 'valuesreach' => '',
                        ]);
                    } else {
                        return view('frontend.menu.thongtinuser', [
                            'ttnguoidung' => Auth::guard('web')->user(), 'chatonline' => '',
                            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                            'nhac' => Nhac::where('vip', 0)->get(),
                            'namemusic' => '',
                            'activerity' => 0,
                            'loi' => '',
                            'loingoai' => 'Mật khẩu cũ không chính xác',
                            'login' => 0,
                            'rank' => 'null',
                            'rightsong' => 1, 'valuesreach' => '',
                        ]);
                    }
                }
                if (Auth::guard('google')->check()) {
                    if (Hash::check($request->input('txtmkcu'),  Auth::guard('web')->user()->password)) {
                        $user = UserAPI::where("email", Auth::guard('google')->user()->email)->update(
                            ['password' => Hash::make($request->input('txtxnmkmoi')),]
                        );

                        UserAPI::where('id', Auth::guard('google')->user()->id)->update(['online' => 0]);
                        Auth::guard('google')->logout();
                        // $googleLogoutUrl = 'https://accounts.google.com/logout?continue=https://www.google.com';
                        // return redirect()->to($googleLogoutUrl);
                        return view('frontend.home', [
                            'ttnguoidung' => Auth::guard('web')->user(),
                            'activerity' => 0, 'chatonline' => '',
                            'loi' => '',
                            'loingoai' => '',
                            'Albumtop3' => Album::latest()->take(3)->get(),
                            'Chill' => Album::inRandomOrder()->take(3)->get(),
                            'CanLike' => Album::inRandomOrder()->take(3)->get(),
                            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                            'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                            'nghesi' => Nghesi::all(),
                            'album' => Album::all(),
                            'login' => 1,
                            'rank' => 'null',
                            'rightsong' => 0, 'valuesreach' => '',
                        ]);
                    } else {
                        return view('frontend.menu.thongtinuser', [
                            'ttnguoidung' => Auth::guard('google')->user(), 'chatonline' => '',
                            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                            'nhac' => Nhac::where('vip', 0)->get(),
                            'namemusic' => '',
                            'activerity' => 0,
                            'loi' => '',
                            'loingoai' => 'Mật khẩu cũ không chính xác',
                            'login' => 0,
                            'rank' => 'null', 'valuesreach' => '',
                            'rightsong' => 1,
                        ]);
                    }
                }
            } else {

                if (Auth::guard('web')->check()) {
                    return view('frontend.menu.thongtinuser', [
                        'ttnguoidung' => Auth::guard('web')->user(), 'chatonline' => '',
                        'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                      'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                        'nhac' => Nhac::where('vip', 0)->get(),
                        'namemusic' => '',
                        'activerity' => 0,
                        'loi' => '',
                        'loingoai' => 'Mật khẩu xác nhận không chính xác. Vui lòng nhập lại',
                        'valuesreach' => '',
                        'login' => 0,
                        'rank' => 'null',
                        'rightsong' => 1,
                    ]);
                }
                if (Auth::guard('google')->check()) {
                    return view('frontend.menu.thongtinuser', [
                        'ttnguoidung' => Auth::guard('google')->user(), 'chatonline' => '',
                        'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                      'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                        'nhac' => Nhac::where('vip', 0)->get(),
                        'namemusic' => '',
                        'activerity' => 0,
                        'loi' => '',
                        'loingoai' => 'Mật khẩu xác nhận không chính xác. Vui lòng nhập lại',
                        'valuesreach' => '',
                        'login' => 0,
                        'rank' => 'null',
                        'rightsong' => 1,
                    ]);
                }
            }
        } else {
            if (Auth::guard('web')->check()) {
                return view('frontend.menu.thongtinuser', [
                    'ttnguoidung' => Auth::guard('web')->user(), 'chatonline' => '',
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'nhac' => Nhac::where('vip', 0)->get(),
                    'namemusic' => '',
                    'activerity' => 0,
                    'loi' => '',
                    'loingoai' => '',
                    'valuesreach' => '',
                    'login' => 0,
                    'rank' => 'null',
                    'rightsong' => 1,
                ]);
            }
            if (Auth::guard('google')->check()) {
                return view('frontend.menu.thongtinuser', [
                    'ttnguoidung' => Auth::guard('google')->user(), 'chatonline' => '',
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'nhac' => Nhac::where('vip', 0)->get(),
                    'namemusic' => '',
                    'activerity' => 0,
                    'loi' => '',
                    'loingoai' => '',
                    'valuesreach' => '',
                    'login' => 0,
                    'rank' => 'null',
                    'rightsong' => 1,
                ]);
            }
        }
    }
    public function register(Request $request)
    {

        $loi = $request->validate([
            'input_email_sdt' => ['required'],
            'input_password' => ['required'],
            'input_password_xac_nhan' => ['required'],
            'input_name' => ['required'],
        ]);
        if ($loi) {
            if ($request->input('input_password_xac_nhan') == $request->input('input_password')) {
                if (User::where('email', $request->input('input_email_sdt'))->count() != 0) {
                    return view('frontend.home', [
                        'activerity' => 0,
                        'Albumtop3' => Album::latest()->take(3)->get(),
                        'Chill' => Album::inRandomOrder()->take(3)->get(),
                        'CanLike' => Album::inRandomOrder()->take(3)->get(),
                        'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                      'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                        'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                        'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                        'nghesi' => Nghesi::all(),
                        'album' => Album::all(),
                        'chatonline' => '',
                        'loi' => 'Email hoặc số điện thoại đã có. Vui lòng nhập lại',
                        'login' => 0,
                        'rank' => 'null', 'valuesreach' => '',
                        'rightsong' => 0,
                    ]);
                }

                $user = new User();
                $user->name = $request->input('input_name');
                $user->password = Hash::make($request->input('input_password'));
                $user->email = $request->input('input_email_sdt');
                $user->quyen = 3;
                $user->trangthai = 1;
                $user->quyenchat = 1;
                $user->save();
                return view('frontend.home', [
                    'activerity' => 0,
                    'Albumtop3' => Album::latest()->take(3)->get(),
                    'Chill' => Album::inRandomOrder()->take(3)->get(),
                    'CanLike' => Album::inRandomOrder()->take(3)->get(),
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                    'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                    'nghesi' => Nghesi::all(),
                    'album' => Album::all(),
                    'chatonline' => '',
                    'loi' => 'Đăng ký thành công',
                    'loingoai' => '',
                    'login' => 1,
                    'rank' => 'null', 'valuesreach' => '',
                    'rightsong' => 0,
                ]);
            } else {

                return view('frontend.home', [
                    'activerity' => 0,
                    'Albumtop3' => Album::latest()->take(3)->get(),
                    'Chill' => Album::inRandomOrder()->take(3)->get(),
                    'CanLike' => Album::inRandomOrder()->take(3)->get(),
                    'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
                  'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                    'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                    'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                    'nghesi' => Nghesi::all(),
                    'album' => Album::all(),
                    'chatonline' => '',
                    'loi' => 'Mật khẩu và xác nhận mật khẩu không đúng. Vui lòng nhập lại',
                    'loingoai' => '',
                    'login' => 0,
                    'rank' => 'null',
                    'rightsong' => 0, 'valuesreach' => '',
                ]);
            }
        } else {
            return view('frontend.home', [
                'activerity' => 0,
                'Albumtop3' => Album::latest()->take(3)->get(),
                'Chill' => Album::inRandomOrder()->take(3)->get(),
                'CanLike' => Album::inRandomOrder()->take(3)->get(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->latest()->take(10)->get(),
                'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
                'chatonline' => '',
                'loi' => 'Chưa có nhập đầy đủ. Vui lòng nhập lại',
                'loingoai' => '',
                'login' => 0,
                'rank' => 'null',
                'rightsong' => 0, 'valuesreach' => '',
            ]);
        }
    }
    public function loadMchart()
    {
        if (Auth::guard('web')->check()) {
            return view('frontend.menu.Mchart', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 3,
                'loi' => '', 'loingoai' => '',
                'chatonline' => '',
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'Nhactop10' => Nhac::where('vip', 0)->orderBy('luotnghe', 'desc')->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
                'login' => 0, 'valuesreach' => '',
                'rightsong' => 0,
                'rank' => json_encode(Ranks::orderBy('id', 'desc')->latest()->take(3)->select("tensong1", "nghesi1", "phantram1", "tensong2", "nghesi2", "phantram2", "tensong3", "nghesi3", "phantram3", "thoigian")->get()->toArray()),
            ]);
        }
        if (Auth::guard('google')->check()) {
            return view('frontend.menu.Mchart', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 3,
                'loi' => '',
                'loingoai' => '',
                'chatonline' => '',
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'Nhactop10' => Nhac::where('vip', 0)->orderBy('luotnghe', 'desc')->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
                'login' => 0,
                'rightsong' => 0, 'valuesreach' => '',
                'rank' => json_encode(Ranks::orderBy('id', 'desc')->latest()->take(3)->select("tensong1", "nghesi1", "phantram1", "tensong2", "nghesi2", "phantram2", "tensong3", "nghesi3", "phantram3", "thoigian")->get()->toArray()),
            ]);
        }
        return view('frontend.menu.Mchart', [
            'activerity' => 3,
            'loi' => '',
            'loingoai' => '',
            'chatonline' => '',
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'Nhactop10' => Nhac::where('vip', 0)->orderBy('luotnghe', 'desc')->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'login' => 0,
            'rightsong' => 0, 'valuesreach' => '',
            'rank' => json_encode(Ranks::orderBy('id', 'desc')->latest()->take(3)->select("tensong1", "nghesi1", "phantram1", "tensong2", "nghesi2", "phantram2", "tensong3", "nghesi3", "phantram3", "thoigian")->get()->toArray()),
        ]);
    }
    public function thongtinuser()
    {
        if (Auth::guard('web')->check()) {
            return view('frontend.menu.thongtinuser', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nhac' => Nhac::where('vip', 0)->get(),
                'namemusic' => '',
                'activerity' => 0,
                'loi' => '', 'loingoai' => '',
                'chatonline' => '',
                'login' => 0,
                'rank' => 'null',
                'rightsong' => 1, 'valuesreach' => '',
            ]);
        }
        if (Auth::guard('google')->check()) {
            return view('frontend.menu.thongtinuser', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nhac' => Nhac::where('vip', 0)->get(),
                'namemusic' => '',
                'activerity' => 0,
                'loi' => '', 'loingoai' => '',
                'chatonline' => '',
                'login' => 0,
                'rank' => 'null',
                'rightsong' => 1, 'valuesreach' => '',
            ]);
        }
    }
    public function loadranksong()
    {
        if (Auth::guard('web')->check()) {
            return view('frontend.menu.ranksong', [
                'ttnguoidung' => Auth::guard('web')->user(), 'chatonline' => '',
                'activerity' => 4,
                'loi' => '', 'loingoai' => '',

                'Nhactop10' => Nhac::where('vip', 0)->orderBy('id', 'desc')->get(),
                'nghesi' => Nghesi::all(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'album' => Album::all(),
                'login' => 0,
                'rank' => 'null',
                'rightsong' => 0, 'valuesreach' => '',
            ]);
        }
        if (Auth::guard('google')->check()) {
            return view('frontend.menu.ranksong', [
                'ttnguoidung' => Auth::guard('google')->user(), 'chatonline' => '',
                'activerity' => 4,
                'loi' => '', 'loingoai' => '',

                'Nhactop10' => Nhac::where('vip', 0)->orderBy('id', 'desc')->get(),
                'nghesi' => Nghesi::all(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'album' => Album::all(),
                'login' => 0,
                'rank' => 'null', 'valuesreach' => '',
                'rightsong' => 0,
            ]);
        }
        return view('frontend.menu.ranksong', [
            'activerity' => 4,
            'loi' => '', 'loingoai' => '', 'chatonline' => '',

            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'Nhactop10' => Nhac::where('vip', 0)->orderBy('id', 'desc')->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'login' => 0,
            'rank' => 'null', 'valuesreach' => '',
            'rightsong' => 0,
        ]);
    }
    public function loadtopic()
    {
        if (Auth::guard('web')->check()) {
            return view('frontend.menu.topic', [
                'ttnguoidung' => Auth::guard('web')->user(), 'chatonline' => '',
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'activerity' => 5,

                'loi' => '', 'loingoai' => '',
                'login' => 0,
                'rank' => 'null', 'valuesreach' => '',
                'rightsong' => 0,
            ]);
        }
        if (Auth::guard('google')->check()) {
            return view('frontend.menu.topic', [
                'ttnguoidung' => Auth::guard('google')->user(), 'chatonline' => '',
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'activerity' => 5,

                'loi' => '', 'loingoai' => '',
                'login' => 0,
                'rank' => 'null', 'valuesreach' => '',
                'rightsong' => 0,
            ]);
        }
        return view('frontend.menu.topic', [
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'activerity' => 5,
            'chatonline' => '',
            'loi' => '', 'loingoai' => '',
            'login' => 0, 'valuesreach' => '',
            'rank' => 'null', 'rightsong' => 0,
        ]);
    }
    public function albumbaihat(string $name)
    {
        // dd($name);
        $nhac = Nhac::where('vip', 0)->where('xetduyet', 1)->where('id', $name)->first();
        $album = Album::where('id', $nhac->album_idnhac)->first();
        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
        if (Auth::guard('web')->check()) {
            return view('frontend.List.AlbumBaiHat', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',
                'Nhacalbumbaihat' => $nhac,
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nghesi' =>  $nghesi,
                'album' => $album,
                'login' => 0,
                'rank' => 'null', 'valuesreach' => '',
                'rightsong' => 1,
            ]);
        }
        if (Auth::guard('google')->check()) {

            return view('frontend.List.AlbumBaiHat', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',
                'Nhacalbumbaihat' => $nhac,
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nghesi' =>  $nghesi,
                'album' => $album,
                'login' => 0,
                'rank' => 'null', 'valuesreach' => '',
                'rightsong' => 1,
            ]);
        }
        return view('frontend.List.AlbumBaiHat', [
            'activerity' => 0,
            'chatonline' => '',
            'loi' => '',
            'loingoai' => '',
            'Nhacalbumbaihat' => $nhac,
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'nghesi' =>  $nghesi,
            'album' => $album,
            'login' => 0,
            'rank' => 'null', 'valuesreach' => '',
            'rightsong' => 1,
        ]);
    }
    public function albumnghesi(string $name)
    {
        // dd($name);
        $album = Album::where('id', $name)->first();
        $nhac = Nhac::where('vip', 0)->where('xetduyet', 1)->where('album_idnhac', $album->id)->get();
        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
        if (Auth::guard('web')->check()) {
            return view('frontend.List.Albumnghesi', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',
                'Nhacalbumbaihat' => $nhac,
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nghesi' =>   Nghesi::all(),
                'nghesins' =>  $nghesi,
                'album' => Album::all(),
                'albumns' => $album,
                'login' => 0,
                'rank' => 'null', 'valuesreach' => '',
                'rightsong' => 1,
            ]);
        }
        if (Auth::guard('google')->check()) {

            return view('frontend.List.Albumnghesi', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',
                'Nhacalbumbaihat' => $nhac,
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nghesi' =>   Nghesi::all(),
                'nghesins' =>  $nghesi,
                'album' => Album::all(),
                'albumns' => $album,
                'login' => 0,
                'rank' => 'null', 'valuesreach' => '',
                'rightsong' => 1,
            ]);
        }
        return view('frontend.List.Albumnghesi', [
            'activerity' => 0,
            'chatonline' => '',
            'loi' => '',
            'loingoai' => '',
            'Nhacalbumbaihat' => $nhac,
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'nghesi' =>   Nghesi::all(),
            'nghesins' =>  $nghesi,
            'album' => Album::all(),
            'albumns' => $album,
            'login' => 0,
            'rank' => 'null',
            'valuesreach' => '',
            'rightsong' => 1,
        ]);
    }
    public function nghesiload(string $name)
    {
        // dd($name);
        $nghesi = Nghesi::where('id', $name)->first();
        $album = Album::where('nghesi_idalbum', $name)->get();
        $nhac = Nhac::where('vip', 0)->where('xetduyet', 1)->get();

        $usernghesi = User::where('id', $nghesi->id_nghesi_user)->first();
        if (Auth::guard('web')->check()) {
            return view('frontend.List.NghesiInfo', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',
                'Nhacalbumbaihat' => $nhac,
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nghesi' =>   Nghesi::all(),
                'nghesins' =>  $nghesi,
                'album' => Album::all(),
                'albumns' => $album,
                'usernghesi' => $usernghesi,
                'login' => 0,
                'rank' => 'null',
                'valuesreach' => '',
                'rightsong' => 1,
            ]);
        }
        if (Auth::guard('google')->check()) {

            return view('frontend.List.NghesiInfo', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '',
                'Nhacalbumbaihat' => $nhac,
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'nghesi' =>   Nghesi::all(),
                'nghesins' =>  $nghesi,
                'album' => Album::all(),
                'albumns' => $album,
                'usernghesi' => $usernghesi,
                'login' => 0,
                'rank' => 'null',
                'valuesreach' => '',
                'rightsong' => 1,
            ]);
        }
        return view('frontend.List.NghesiInfo', [
            'activerity' => 0,
            'chatonline' => '',
            'loi' => '',
            'loingoai' => '',
            'Nhacalbumbaihat' => $nhac,
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'nghesi' =>   Nghesi::all(),
            'nghesins' =>  $nghesi,
            'album' => Album::all(),
            'albumns' => $album,
            'usernghesi' => $usernghesi,
            'login' => 0,
            'rank' => 'null',
            'valuesreach' => '',
            'rightsong' => 1,
        ]);
    }
    public function addquantam(string $name)
    {
        $parts = explode('-', $name);

        if (Auth::guard('web')->check()) {

            $nghesi = Nghesi::where('id', $parts[0])->first();
            if (Str::contains($nghesi->quantam, Auth::guard('web')->user()->id . '-')) {
                // Nếu có, thay thế '3-' bằng ''
                $string = Str::replaceFirst(Auth::guard('web')->user()->id . '-', '', $nghesi->quantam);
            } else {
                // Nếu không, thêm '3-' vào cuối chuỗi
                $string = $nghesi->quantam . Auth::guard('web')->user()->id . '-';
            }
            $nghesiupdate = Nghesi::where('id', $parts[0])->update([
                'quantam' => $string,
            ]);
            return response()->json(['success' => $parts[0]]);
        }
        if (Auth::guard('google')->check()) {
            $nghesi = Nghesi::where('id', $parts[0])->first();
            if (Str::contains($nghesi->quantam, Auth::guard('google')->user()->id . 'gg-')) {
                // Nếu có, thay thế '3-' bằng ''
                $string = Str::replaceFirst(Auth::guard('google')->user()->id . 'gg-', '', $nghesi->quantam);
            } else {
                // Nếu không, thêm '3-' vào cuối chuỗi
                $string = $nghesi->quantam . Auth::guard('google')->user()->id . 'gg-';
            }
            $nghesiupdate = Nghesi::where('id', $parts[0])->update([
                'quantam' => $string,
            ]);
            return response()->json(['success' => $parts[0]]);
        }
    }
    public function addmusic(string $id, string $name)
    {
        $string = '';
        if ($name == 'addLabary') {
            if (Auth::guard('web')->check()) {
                $user = User::where('id', Auth::guard('web')->user()->id)->first();
                if ($user != null) {
                    if (Str::contains($user->thuvien, $id . '-')) {
                        // Nếu có, thay thế '3-' bằng ''
                        $string = Str::replaceFirst($id . '-', '', $user->thuvien);
                    } else {
                        // Nếu không, thêm '3-' vào cuối chuỗi
                        $string = $user->thuvien . $id . '-';
                    }
                    User::where('id', $user->id)
                        ->update([
                            'thuvien' => $string,
                        ]);

                    return response()->json(['success' => $id]);
                }
            }
            if (Auth::guard('google')->check()) {
                $user = UserAPI::where('id', Auth::guard('google')->user()->id)->first();
                if ($user != null) {
                    if (Str::contains($user->thuvien, $id . '-')) {
                        // Nếu có, thay thế '3-' bằng ''
                        $string = Str::replaceFirst($id . '-', '', $user->thuvien);
                    } else {
                        // Nếu không, thêm '3-' vào cuối chuỗi
                        $string = $user->thuvien . $id . '-';
                    }

                    UserAPI::where('id', $user->id)
                        ->update([
                            'thuvien' => $string,
                        ]);
                }
                return response()->json(['success' => $id]);
            }
        }
    }
    public function loadchat()
    {
        if (Auth::guard('web')->check()) {
            return response()->json([
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 0,
                'loi' => '',
                'loingoai' => '',
                'login' => 0,
                'rank' => 'null',
                'chat' => Mess::all(),
                'nhac' => Nhac::all(),
                'rightsong' => 0,
            ]);
        }
        if (Auth::guard('google')->check()) {
            return response()->json([
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 0,
                'loi' => '',
                'loingoai' => '',


                'login' => 0,
                'rank' => 'null',
                'chat' => Mess::all(),
                'nhac' => Nhac::all(),
                'rightsong' => 0,
            ]);
        }
    }
    public function searchs(Request $request)
    {
        $nhac = Nhac::where('vip', 0)->where('xetduyet', 1)->where('tennhac', 'like', '%' . $request->input('searchbar_input') . '%')->get();
        $album = Album::where('tenalbum', 'like', '%' . $request->input('searchbar_input') . '%')->get();
        $nghesi = Nghesi::where('tennghesi', 'like', '%' . $request->input('searchbar_input') . '%')->get();
        if (Auth::guard('web')->check()) {
            return view('frontend.List.Search', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '', 'user'=>User::select('id','image')->get(),
                'Chill' => Album::inRandomOrder()->where('tenalbum', 'like', '%' . $request->input('searchbar_input') . '%')->take(3)->get(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('tennhac', 'like', '%' . $request->input('searchbar_input') . '%')->latest()->take(5)->get(),
                'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->where('tennghesi', 'like', '%' . $request->input('searchbar_input') . '%')->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
                'login' => 0,
                'nhacsearch' => $nhac,
                'albumsearch' => $album,
                'nghesisearch' => $nghesi,
                'valuesreach' => $request->input('searchbar_input'),
                'rank' => 'null',
                'rightsong' => 0,
            ]);
        }
        if (Auth::guard('google')->check()) {

            return view('frontend.List.Search', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '', 'user'=>User::select('id','image')->get(),
                'Chill' => Album::inRandomOrder()->where('tenalbum', 'like', '%' . $request->input('searchbar_input') . '%')->take(3)->get(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('tennhac', 'like', '%' . $request->input('searchbar_input') . '%')->latest()->take(5)->get(),
                'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->where('tennghesi', 'like', '%' . $request->input('searchbar_input') . '%')->get(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
                'login' => 0,
                'nhacsearch' => $nhac,
                'albumsearch' => $album,
                'nghesisearch' => $nghesi,
                'valuesreach' => $request->input('searchbar_input'),
                'rank' => 'null',
                'rightsong' => 0,
            ]);
        }
        return view('frontend.List.Search', [
            'activerity' => 0,
            'chatonline' => '',
            'loi' => '',
            'loingoai' => '', 'user'=>User::select('id','image')->get(),
            'Chill' => Album::inRandomOrder()->where('tenalbum', 'like', '%' . $request->input('searchbar_input') . '%')->take(3)->get(),
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'Nhactop10' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('tennhac', 'like', '%' . $request->input('searchbar_input') . '%')->latest()->take(5)->get(),
            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->where('tennghesi', 'like', '%' . $request->input('searchbar_input') . '%')->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'login' => 0,
            'nhacsearch' => $nhac,
            'albumsearch' => $album,
            'nghesisearch' => $nghesi,
            'valuesreach' => $request->input('searchbar_input'),
            'rank' => 'null',
            'rightsong' => 0,
        ]);
    }
    public function prenium()
    {
        $nhac = Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->get();

        if (Auth::guard('web')->check()) {
            return view('frontend.List.Prenium', [
                'ttnguoidung' => Auth::guard('web')->user(),
                'activerity' => 0,
                'chatonline' => '',
                'loi' => '',
                'loingoai' => '', 'user'=>User::select('id','image')->get(),
                'Chill' => Album::all(),
                'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
              'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
                'Nhactop10' =>   $nhac,
                'Nghesitop20' => Nghesi::all(),
                'nghesi' => Nghesi::all(),
                'album' => Album::all(),
                'login' => 0,
                'nhac'=>Nhac::all(),
                'valuesreach' => '',
                'rank' => 'null',
                'rightsong' => 0,
            ]);
        }
        if (Auth::guard('google')->check()) {

            return view('frontend.List.Prenium', [
                'ttnguoidung' => Auth::guard('google')->user(),
                'activerity' => 0,
            'chatonline' => '',
            'loi' => '',
            'loingoai' => '',
            'Chill' => Album::all(), 'user'=>User::select('id','image')->get(),
            'Nhactopluotnghe' => Nhac::where('vip', 0)->where('xetduyet', 1)->where('luotnghe', "desc")->latest()->take(2)->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'Nhactop10' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->get(),
            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'login' => 0,
            'nhac'=>Nhac::all(),
            'valuesreach' => '',
            'rank' => 'null',
            'rightsong' => 0,
            ]);
        }
        return view('frontend.List.Prenium', [
            'activerity' => 0,
            'chatonline' => '',
            'loi' => '',
            'loingoai' => '',
            'Chill' => Album::all(),
            'user'=>User::select('id','image')->get(),
          'Nhactopvip' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->take(2)->get(),
            'Nhactop10' => Nhac::where('vip', 1)->where('xetduyet', 1)->latest()->get(),
            'Nghesitop20' => Nghesi::inRandomOrder()->take(20)->get(),
            'nghesi' => Nghesi::all(),
            'album' => Album::all(),
            'login' => 0,
            'nhac'=>Nhac::all(),
            'valuesreach' => '',
            'rank' => 'null',
            'rightsong' => 0,
        ]);
    }
    public function luotnghe(Request $request, string $id)
    {

        // Xử lý tăng lượt nghe ở đây
        $luotnghe = Nhac::where('id', $id)->first();
        $nhac = Nhac::where('id', $id)->update([
            'luotnghe' => $luotnghe->luotnghe + 1,
        ]);


        return response()->json(['success' => $id, 'success1' => $request]);
    }
    public function loadmusic(Request $request, string $id)
    {

        $nhac = Nhac::where('id', $id)->first();

        if (!$nhac) {
            return response()->json(['error' => 'Không tìm thấy bản ghi nhạc'], 404);
        }

        $album = Album::where('id', $nhac->album_idnhac)->first();

        if (!$album) {
            return response()->json(['error' => 'Không tìm thấy bản ghi album'], 404);
        }

        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();

        if (!$nghesi) {
            return response()->json(['error' => 'Không tìm thấy bản ghi nghệ sĩ'], 404);
        }

        // Trả về dữ liệu thành công
        return response()->json(['success' => $nhac, 'successns' => $nghesi]);
    }
    
    public function saveMyMusic(Request $request)
    {
      
        if($request->input('type')=='up'){
            Session::put('myMusic', $request->input('myMusic'));
            //  session(['myMusic' =>$request->input('myMusic') ]);
        }
     
        // Lấy người dùng hiện tại đã xác thực thông qua API
       
        return response()->json(['response' =>[ session('myMusic')]]);
    }
}