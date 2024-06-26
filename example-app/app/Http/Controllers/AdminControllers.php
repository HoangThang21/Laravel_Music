<?php

namespace App\Http\Controllers;

use App\Events\CallLoad;
use App\Mail\ContactEmail;
use App\Models\Album;
use App\Models\Nghesi;
use App\Models\Nhac;
use App\Models\Theloai;
use App\Models\User;
use App\Models\UserAPI;
use App\Models\Comment;
use Exception;

use Illuminate\Support\Collection;
use App\Events\PusherBroadcast;
use App\Models\Mess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use PhpParser\Node\Stmt\TryCatch;
use Pusher\Pusher;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Stripe\Stripe;

class AdminControllers extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function broadcast(Request $request)
    {
        if (Auth::guard('api')->check()) {

            $arr = '';
            foreach (explode("\r\n", $request->input('message-input')) as $message) {
                $arr = $arr . "<p>$message</p>";
            };
            // dd($arr);
            $mess = new Mess();
            $mess->tenuser = 'Admin';
            $mess->iduser = Auth::guard('api')->user()->id;
            $mess->hinhuser = 'logomobifone.png';
            if ($request->input('linknhac')) {
                $mess->idnhac = $request->input('linknhac');
            }
            $mess->noidung = $arr;
            $mess->time = Carbon::now();;
            $mess->save();
            event(new CallLoad('Success'));
            return  redirect()->intended('/Administrator/chat');
        } else {
            return view('Auth.login', ['loi' => '']);
        }
    }


    public function sendmail(Request $request)
    {
        if (Auth::guard('api')->check()) {

            $request->validate([
                'txtemail' => ['required'],
                'txtmota' => ['required'],

            ]);
            $ktemail = User::where('email', $request->input('txtemail'))->first();
            $ktemailgg = UserAPI::where('email', $request->input('txtemail'))->first();
            $email = $request->input('txtemail');
            $body = $request->input('txtmota');
            // dd($body);
            $url = 'Mail.contactEmail';
            if ($ktemail) {
                Mail::to($email)->send(new ContactEmail($email, $body, $url));
                return view(
                    'Auth.index',
                    [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'user' =>  User::all(),
                        'userapi' =>  UserAPI::all(),
                        'usercount' =>  User::all()->count(),
                        'userapicount' =>  UserAPI::all()->count(),
                        'searchbarinput' => '',
                        'contentFilter' => '0',
                        'active' => '0',
                        'suc' => "Đã gửi email thành công",
                    ]
                );
            }
            if ($ktemailgg) {
                Mail::to($email)->send(new ContactEmail($email, $body, $url));
                return view(
                    'Auth.index',
                    [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'user' =>  User::all(),
                        'userapi' =>  UserAPI::all(),
                        'usercount' =>  User::all()->count(),
                        'userapicount' =>  UserAPI::all()->count(),
                        'searchbarinput' => '',
                        'contentFilter' => '0',
                        'active' => '0',
                        'suc' => "Đã gửi email thành công",
                    ]
                );
            }
        } else {
            return view('Auth.login', ['loi' => '']);
        }


        // dd($email,$body);


    }
    public function chat()
    {
        if (Auth::guard('api')->check()) {

            return view(
                'Auth.qlchat.chat',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'userapi' =>  UserAPI::all(),
                    'chat' => Mess::all(),
                    'nhac' => Nhac::all(),
                    'contentFilter' => '-1',
                    'namemusic' => '',
                    'active' => '',
                    'suc' => "",
                ]
            );
        } else {
            return view('Auth.login', ['loi' => '']);
        }
    }
    public function xoachat(string $id)
    {
        if (Auth::guard('api')->check()) {

            Mess::where('id', $id)->delete();
            event(new CallLoad('Success'));
            return  redirect()->intended('/Administrator/chat');
        } else {
            return view('Auth.login', ['loi' => '']);
        }
    }
    public function loadchat()
    {
        return response()->json([
            'chat' => Mess::all(),
            'nhac' => Nhac::all(), 'ttnguoidung' =>   Auth::guard('api')->user(),
            'namemusic' => ''
        ]);
    }
    public function loadchatsend(string $id, string $name)
    {

        if ($name == 'albd') {
            $nhac = Nhac::where('id', $id)->first();
            // dd($nhac['nhaclink']);
            return view(
                'Auth.qlchat.chat',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'userapi' =>  UserAPI::all(),
                    'chat' => Mess::all(),
                    'nhac' => Nhac::all(),
                    'namemusic' => $nhac,
                    'contentFilter' => '-1',
                    'active' => '',
                    'suc' => "",
                ]
            );
        }
    }
   
    
    public function index()
    {

        if (Auth::guard('api')->check()) {

            return view(
                'Auth.index',
                [

                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'userapi' =>  UserAPI::all(),
                    'usercount' =>  User::all()->count(),
                    'userapicount' =>  UserAPI::all()->count(),
                    'searchbarinput' => '',
                    'contentFilter' => '0',
                    'active' => '0',
                    'suc' => "",
                ]
            );
        } else {
            return view('Auth.login', ['loi' => '']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('Auth.login', ['loi' => '']);
    }
    public function logoutadmin()
    {
        User::where('id', Auth::guard('api')->user()->id)->update(['online' => 0]);
        Auth::guard('api')->logout();
        return  redirect()->intended('/Administrator');
    }
    public function themnguoidung()
    {
        if (Auth::guard('api')->check()) {

            return view(
                'Auth.qlnguoidung.themnguoidung',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'userapi' =>  UserAPI::all(),
                    'contentFilter' => '0',
                    'active' => '0',
                    'loi' => '',
                ]
            );
        } else {
            return view('Auth.login', ['loi' => '']);
        }
    }
    public function hoso()
    {
        if (Auth::guard('api')->check()) {

            return view(
                'Auth.qlnguoidung.profile',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'userapi' =>  UserAPI::all(),
                    'contentFilter' => '0',
                    'active' => '0',
                ]
            );
        } else {
            return view('Auth.login', ['loi' => '']);
        }
    }
    public function doimatkhau()
    {
        if (Auth::guard('api')->check()) {

            return view(
                'Auth.qlnguoidung.doimatkhau',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'userapi' =>  UserAPI::all(),
                    'contentFilter' => '0',
                    'active' => '0', 'loi' => ''
                ]
            );
        } else {
            return view('Auth.login', ['loi' => '']);
        }
    }
    public function doimatkhaund(Request $request)
    {
        $request->validate([
            'txtpascu' => ['required'],
            'txtmatkhaumoi' => ['required'],
            'txtmatkhaumoixn' => ['required'],
        ]);
        $user = User::where('id', $request->input('iduser'))->first();

        if (Hash::check($request->input('txtpascu'), $user->password)) {
            if ($request->input('txtmatkhaumoi') === $request->input('txtmatkhaumoixn')) {
                $us = User::where('id', $request->input('iduser'))->update([
                    'password' => Hash::make($request->input('txtmatkhaumoi')),
                ]);
                Auth::guard('api')->logout();

                return  redirect()->intended('/Administrator/login');
            } else {
                $se = 'Lỗi,mật khẩu không giống nhau';
                return view('Auth.qlnguoidung.doimatkhau', ['ttnguoidung' =>  Auth::guard('api')->user(), 'contentFilter' => '0', 'active' => '0', 'loi' => $se]);
            }
        } else {
            $se = 'Lỗi,mật khẩu cũ';
            return view('Auth.qlnguoidung.doimatkhau', ['ttnguoidung' =>  Auth::guard('api')->user(), 'contentFilter' => '0', 'active' => '0', 'loi' => $se]);
        }
    }
    public function themnd(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'txtemail' => ['required', 'email'],
            'txtmatkhau' => ['required'],
            'txthinh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'txthoten' => ['required'],
            'optloaind' => ['required'],
        ]);
        if (User::where('email', $request->input('txtemail'))->count() != 0) {
            if (Auth::guard('api')->check()) {

                return view(
                    'Auth.qlnguoidung.themnguoidung',
                    [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'user' =>  User::all(),

                        'userapi' =>  UserAPI::all(),
                        'contentFilter' => '0',
                        'active' => '0',
                        'loi' => 'Email đã tồn tại vui lòng nhập Email khác.',
                    ]
                );
            } else {
                return view('Auth.login', ['loi' => '']);
            }
        }
        $generatedimage = 'img' . time() . '-' . $request->file('txthinh')->getClientOriginalName();
        $request->file('txthinh')->move(public_path('images'), $generatedimage);
        $user = new User();
        $user->name = $request->input('txthoten');
        $user->password = Hash::make($request->input('txtmatkhau'));
        $user->email = $request->input('txtemail');
        $user->image = $generatedimage;
        $user->quyen = $request->input('optloaind');
        if ($request->input('optloaind') == 4) {
            $user->vip = 1;
        } else {
            $user->vip = 0;
        }
        $user->trangthai = 1;
        $user->quyenchat = 1;
        $user->save();
        return redirect()->intended('/Administrator');
    }
    public function loginuser(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            $users = User::where("email", $request->input('email'))->first();
            if ($credentials) {
                if ($users->trangthai != 0) {
                    if ($users->quyen == 1 || $users->quyen == 2) {
                        if (Hash::check($request->password, $users->password)) {
                            Auth::guard('api')->login($users);
                            if (Auth::guard('api')->check()) {
                                User::where('id', Auth::guard('api')->user()->id)->update(['online' => 1]);
                                return  redirect()->intended('/Administrator');
                            }
                        } else {
                            return view('Auth.login', ['loi' => 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại']);
                        }
                    } else {
                        return view('Auth.login', ['loi' => 'Bạn không có quyền đăng nhập']);
                    }
                } else {
                    return view('Auth.login', ['loi' => 'Tài khoản của bạn đã bị khóa vui lòng liên hệ Admin']);
                }
            } else {
                return view('Auth.login', ['loi' => '']);
            }
        } catch (Exception $e) {
            return view('Auth.login', ['loi' => '']);
        }
    }

    public function searchinfouser(Request $request)
    {
        try {
            $searchUser = User::where('name', 'like', '%' . $request->searchbar_input . '%')
                ->orWhere('email', 'like', '%' . $request->searchbar_input . '%')
                ->get();
            $searchUser2 = UserAPI::where('name', 'like', '%' . $request->searchbar_input . '%')
                ->orWhere('email', 'like', '%' . $request->searchbar_input . '%')
                ->get();

            if (Auth::guard('api')->check()) {
                return view(
                    'Auth.index',
                    [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'user' =>   $searchUser,
                        'userapi' =>  $searchUser2,
                        'usercount' =>   $searchUser->count(),
                        'userapicount' =>  $searchUser2->count(),
                        'searchbarinput' => $request->searchbar_input,
                        'suc' => "",
                        'contentFilter' => '0',
                        'active' => '0',
                    ]
                );
            }
        } catch (Exception $e) {
        }
    }

    public function searchns(Request $request)
    {

        try {

            if ($request->searchbar_input == '') {
                $searchns = Nghesi::where('tennghesi', 'like', '%' . $request->searchbar_input . '%')
                    ->get();
                $searchnsapi = [];
            } else {
                $user = User::where('email', 'like', '%' . $request->searchbar_input . '%')->where('quyen', 4)->pluck('id')->first();
                $userapi = UserAPI::where('email', 'like', '%' . $request->searchbar_input . '%')->where('quyen', 4)->pluck('id')->first();
                if ($userapi && $user) {
                    $searchns = Nghesi::Where('id_nghesi_user', $user)
                        ->get();
                    $searchnsapi = Nghesi::Where('idnghesi_userapi', $userapi)
                        ->get();
                } elseif ($user) {
                    $searchns = Nghesi::Where('id_nghesi_user', $user)
                        ->get();
                    $searchnsapi = [];
                } elseif ($userapi) {
                    $searchnsapi = Nghesi::Where('idnghesi_userapi', $userapi)
                        ->get();
                    $searchns = [];
                } elseif (!$userapi && !$user) {
                    $searchns = Nghesi::where('tennghesi', 'like', '%' . $request->searchbar_input . '%')
                        ->get();
                    $searchnsapi = [];
                }
            }

            return view(
                'Auth.qlnghesi.home',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'theloai' =>  Theloai::all(),
                    'userapi' =>  UserAPI::all(),
                    'nghesi' =>  $searchns,
                    'nghesiapi' =>  $searchnsapi,
                    'searchbarinput' => $request->searchbar_input,
                    'contentFilter' => '-1',
                    'active' => '',
                ]
            );
        } catch (Exception $e) {
        }
    }
    public function searchal(Request $request)
    {

        // try {

        if ($request->searchbar_input == '') {
            return redirect()->intended('/Administrator/qlalbum');
        } else {
            $nghesisr = Nghesi::where('tennghesi', 'like', '%' . $request->searchbar_input . '%')->first();
            $theloaisr = Theloai::where('tentheloai', 'like', '%' . $request->searchbar_input . '%')->first();
            if ($nghesisr && $theloaisr) {
                $albumsearch = Album::where('tenalbum', 'like', '%' . $request->searchbar_input . '%')
                    ->orWhere('namphathanh', 'like', '%' . $request->searchbar_input . '%')
                    ->orWhere('nghesi_idalbum', 'like', '%' . $nghesisr->id . '%')
                    ->orWhere('theloai_idalbum', 'like', '%' . $theloaisr->id  . '%')
                    ->get();
            } elseif ($nghesisr) {
                $albumsearch = Album::where('tenalbum', 'like', '%' . $request->searchbar_input . '%')
                    ->orWhere('namphathanh', 'like', '%' . $request->searchbar_input . '%')
                    ->orWhere('nghesi_idalbum', 'like', '%' . $nghesisr->id . '%')

                    ->get();
            } elseif ($theloaisr) {
                $albumsearch = Album::where('tenalbum', 'like', '%' . $request->searchbar_input . '%')
                    ->orWhere('namphathanh', 'like', '%' . $request->searchbar_input . '%')

                    ->orWhere('theloai_idalbum', 'like', '%' . $theloaisr->id  . '%')
                    ->get();
            } else {
                $albumsearch = Album::where('tenalbum', 'like', '%' . $request->searchbar_input . '%')
                    ->orWhere('namphathanh', 'like', '%' . $request->searchbar_input . '%')


                    ->get();
            }
            // dd($nghesisr,"-",$theloaisr);


            return view(
                'Auth.qlalbum.home',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'theloai' =>  Theloai::all(),
                    'userapi' =>  UserAPI::all(),
                    'nghesi' =>  Nghesi::all(),
                    'album' =>  $albumsearch,
                    'nghesiapi' =>  [],
                    'searchbarinput' => '',
                    'contentFilter' => '-1',
                    'active' => '',
                ]
            );
        }


        // } catch (Exception $e) {
        // }
    }
    public function searchs(Request $request)
    {
        if ($request->searchbar_input == '') {
            return redirect()->intended('/Administrator/qlnhac');
        } else {
            $song = Nhac::where('tennhac', 'like', '%' . $request->searchbar_input . '%')->get();
            return view(
                'Auth.qlnhac.home',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'theloai' =>  Theloai::all(),
                    'userapi' =>  UserAPI::all(),
                    'nghesi' =>  Nghesi::all(),
                    'album' =>  Album::all(),
                    'nhac' =>  $song,
                    'searchbarinput' => '',
                    'contentFilter' => '-1',
                    'active' => '',
                ]
            );
        }
    }
    public function suand(Request $request)
    {
        try {
            $request->validate([

                'fhinh' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'txthinhanhcu' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'txthoten' => ['required'],
            ]);

            if ($request->file('fhinh') != null) {
                $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
                $request->file('fhinh')->move(public_path('images'), $generatedimage);
                $user = User::where('id', $request->input('txtiduser'))
                    ->update([
                        'name' => $request->input('txthoten'),
                        'image' => $generatedimage
                    ]);
            } else {
                $user = User::where('id', $request->input('txtiduser'))
                    ->update([
                        'name' => $request->input('txthoten'),

                    ]);
            }



            return redirect()->intended('/Administrator/hoso');
        } catch (Exception $e) {
        }
    }
    public function suanguoidungbt(Request $request)
    {
        try {
            $request->validate([
                'optloaindvip' => ['required'],
                'optloaind' => ['required'],
                'txtquyenchat' => ['required'],
            ]);
            $usera = User::where('id', $request->input('idnguoidung'))
                ->first();
            if (Auth::guard('api')->user()->quyen == 2 && $usera->quyen == 2) {
                return redirect()->intended('/Administrator');
            }
            if (Auth::guard('api')->user()->quyen == 2 && $usera->quyen == 1) {
                return redirect()->intended('/Administrator');
            }
            if ($request->input('txtmatkhau') != null) {
                if ($request->input('idnguoidungselect') == 'userbt') {
                    $user = User::where('id', $request->input('idnguoidung'))
                        ->update([
                            'password' => Hash::make($request->input('txtmatkhaumoi')),
                            'vip' => $request->input('optloaindvip'),
                            'name' => $request->input('txtten'),
                            'quyen' => $request->input('optloaind'),
                            'quyenchat' => $request->input('txtquyenchat'),
                        ]);
                    return redirect()->intended('/Administrator');
                }
                if ($request->input('idnguoidungselect') == 'usergg') {
                    $user = UserAPI::where('id', $request->input('idnguoidung'))
                        ->update([
                            'password' => Hash::make($request->input('txtmatkhaumoi')),
                            'vip' => $request->input('optloaindvip'),
                            'quyen' => $request->input('optloaind'),
                            'quyenchat' => $request->input('txtquyenchat'),
                            'name' => $request->input('txtten'),
                        ]);
                    return redirect()->intended('/Administrator');
                }
            } else {
                if ($request->input('idnguoidungselect') == 'userbt') {
                    $user = User::where('id', $request->input('idnguoidung'))
                        ->update([
                            'name' => $request->input('txtten'),
                            'vip' => $request->input('optloaindvip'),
                            'quyen' => $request->input('optloaind'),
                            'quyenchat' => $request->input('txtquyenchat'),
                        ]);
                    return redirect()->intended('/Administrator');
                }
                if ($request->input('idnguoidungselect') == 'usergg') {
                    $user = UserAPI::where('id', $request->input('idnguoidung'))
                        ->update([
                            'name' => $request->input('txtten'),
                            'vip' => $request->input('optloaindvip'),
                            'quyen' => $request->input('optloaind'),
                            'quyenchat' => $request->input('txtquyenchat'),
                        ]);
                    return redirect()->intended('/Administrator');
                }
            }



            return redirect()->intended('/Administrator/hoso');
        } catch (Exception $e) {
        }
    }
    public function fillter(string $cn, string $name)
    {
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function qltheloai()
    {
        return view(
            'Auth.qltheloai.home',
            [
                'ttnguoidung' =>   Auth::guard('api')->user(),
                'user' =>  User::all(),
                'theloai' =>  Theloai::all(),
                'userapi' =>  UserAPI::all(),
                'contentFilter' => '-1',
                'active' => '',

            ]
        );
    }
    public function qlnghesi()
    {
        return view(
            'Auth.qlnghesi.home',
            [
                'ttnguoidung' =>   Auth::guard('api')->user(),
                'user' =>  User::all(),
                'theloai' =>  Theloai::all(),
                'userapi' =>  UserAPI::all(),
                'nghesi' =>  Nghesi::latest()->get(),
                'nghesiapi' =>  [],
                'searchbarinput' => '',
                'contentFilter' => '-1',
                'active' => '',
            ]
        );
    }
    public function qlalbum()
    {
        return view(
            'Auth.qlalbum.home',
            [
                'ttnguoidung' =>   Auth::guard('api')->user(),
                'user' =>  User::all(),
                'theloai' =>  Theloai::all(),
                'userapi' =>  UserAPI::all(),
                'nghesi' =>  Nghesi::all(),
                'album' =>  Album::latest()->get(),
                'nghesiapi' =>  [],
                'searchbarinput' => '',
                'contentFilter' => '-1',
                'active' => '',
            ]
        );
    }
    public function qlnhac()
    {
        return view(
            'Auth.qlnhac.home',
            [
                'ttnguoidung' =>   Auth::guard('api')->user(),
                'user' =>  User::all(),
                'theloai' =>  Theloai::all(),
                'userapi' =>  UserAPI::all(),
                'nghesi' =>  Nghesi::all(),
                'album' =>  Album::all(),
                'nhac' => Nhac::orderBy('created_at', 'desc')->get(),
                'searchbarinput' => '',
                'contentFilter' => '-1',
                'active' => '',
            ]
        );
    }
    public function themnghesi()
    {
        return view(
            'Auth.qlnghesi.themnghesi',
            [
                'ttnguoidung' =>   Auth::guard('api')->user(),
                'user' =>  User::where('quyen', 4)->get(),
                'theloai' =>  Theloai::all(),
                'userapi' =>  UserAPI::where('quyen', 4)->get(),
                'nghesi' =>  Nghesi::all(),
                'contentFilter' => '-1',
                'active' => '',
                'loi' => '',
            ]
        );
    }
    public function themtheloai()
    {
        return view('Auth.qltheloai.themtheloai',  [
            'ttnguoidung' =>   Auth::guard('api')->user(),
            'loi' => '',
            'contentFilter' => '-1',

            'active' => '',
        ]);
    }
    public function themalbum()
    {
        return view('Auth.qlalbum.themalbum',  [
            'ttnguoidung' =>   Auth::guard('api')->user(),
            'loi' => '',
            'theloai' =>  Theloai::all(),
            'nghesi' =>  Nghesi::all(),
            'contentFilter' => '-1',
            'active' => '',

        ]);
    }
    public function themnhac()
    {
        return view('Auth.qlnhac.themnhac',  [
            'ttnguoidung' =>   Auth::guard('api')->user(),
            'loi' => '',
            'album' =>  Album::all(),
            'nghesi' =>  Nghesi::all(),
            'contentFilter' => '-1',
            'active' => '',

        ]);
    }
    public function themmusic(Request $request)
    {
        $request->validate([
            'txttennhac' => 'required',
            'txtmanhac' => 'required',
            'txtgia' => 'required',
            'fnhac' => 'required|mimes:mp3',
            'fhinh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'optloains' => 'required',
            'optloaiphi' => 'required',

        ]);
        if ($request->input('txtgia') <= 0) {
            return view('Auth.qlnhac.themnhac',  [
                'ttnguoidung' =>   Auth::guard('api')->user(),
                'loi' => 'Giá không được < 0',
                'album' =>  Album::all(),
                'nghesi' =>  Nghesi::all(),
                'contentFilter' => '-1',
                'active' => '',

            ]);
        }
        $generatedmusic = 'music' . time() . '-' . $request->file('fnhac')->getClientOriginalName();
        $request->file('fnhac')->move(public_path('music'), $generatedmusic);
        $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
        $request->file('fhinh')->move(public_path('images'), $generatedimage);
        $ns = new Nhac();
        $ns->tennhac = $request->input('txttennhac');
        $ns->nhaclink = $generatedmusic;
        $ns->imagemusic  = $generatedimage;
        $ns->album_idnhac   = $request->input('optloains');
        $ns->maNhac = $request->input('txtmanhac');
        $ns->gia = $request->input('txtgia');
        if ($request->input('txtmotalyric')) {
            $ns->lyric = $request->input('txtmotalyric');
        } else {
            $ns->lyric = '';
        }

        $ns->vip = $request->input('optloaiphi');
        $ns->save();
        return redirect()->intended('/Administrator/qlnhac');
    }
    public function formchuyensua(string $id)
    {
        if (strpos($id, '-') !== false) {
            list($number, $text) = array_map('trim', explode('-', $id));

            switch ($text) {
                case 'tl':
                    $theloai = Theloai::where('id', $number)->first();

                    return view('Auth.qltheloai.suatheloai', [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'theloai' => $theloai,
                        'contentFilter' => '-1',
                        'active' => '',
                    ]);
                    // case 'ns':
                    //     $nghesi = Nghesi::where('id', $number)->first();

                    //     return view('Auth.qlnghesi.suanghesi', ['ttnguoidung' =>  Auth::guard('web')->user(), 'nghesi' => $nghesi]);
                    // case 'alb':

                    //     $album = Album::where('id', $number)->first();
                    //     $nghesi = Nghesi::all();
                    //     $theloai = Theloai::all();
                    //     return view('Auth.qlalbum.suaalbum', [
                    //         'ttnguoidung' =>  Auth::guard('web')->user(), 'album' => $album,
                    //         'nghesi' => $nghesi, 'theloai' => $theloai,
                    //     ]);
                    // case 'music':
                    //     $music = Nhac::where('id', $number)->first();
                    //     return view('Auth.qlnhac.suamusic', ['ttnguoidung' =>  Auth::guard('web')->user(), 'album' => Album::all(), 'music' => $music]);

                default:
                    break;
            }
        }
    }
    /**
     * Show the form for editing the specified resource.
     * 
   
     */ public function suatheloai(Request $request)
    {

        $request->validate([
            'txttentheloai' => ['required'],
        ]);

        $tl = Theloai::where('id', $request->input('txtidtheloai'))->update([
            'tentheloai' => $request->input('txttentheloai'),
        ]);

        return redirect()->intended('/Administrator/qltheloai');
    }
    public function themtl(Request $request)
    {
        $request->validate([
            'txttheloai' => ['required'],
        ]);
        $theloaitim = Theloai::where('tentheloai', $request->input('txttheloai'))->count();

        if ($theloaitim != 0) {
            return view('Auth.qltheloai.themtheloai',  [
                'ttnguoidung' =>   Auth::guard('api')->user(),
                'loi' => 'Tên thể loại đã tồn tại vui lòng nhập tên khác.',
                'contentFilter' => '-1',
                'active' => '',
            ]);
        } else {
            $tl = new Theloai();
            $tl->tentheloai = $request->input('txttheloai');
            $tl->save();
            return redirect()->intended('/Administrator/qltheloai');
        }
    }
    public function themalb(Request $request)
    {
        $request->validate([
            'txttenalbum' => ['required'],
            'txtnamphathanh' => ['required'],
            'optloains' => ['required'],
            'optloaitl' => ['required'],
            'txthinh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->input('txtnamphathanh') > 0) {
            $generatedimage = 'image' . time() . '-' . $request->file('txthinh')->getClientOriginalName();
            $request->file('txthinh')->move(public_path('images'), $generatedimage);
            $al = new Album();
            $al->tenalbum = $request->input('txttenalbum');
            $al->hinhalbum =  $generatedimage;
            $al->namphathanh = $request->input('txtnamphathanh');
            $al->nghesi_idalbum = $request->input('optloains');
            $al->theloai_idalbum  = $request->input('optloaitl');
            $al->save();
            return redirect()->intended('/Administrator/qlalbum');
        } else {
            return view('Auth.qlalbum.themalbum',  [
                'ttnguoidung' =>   Auth::guard('api')->user(),
                'loi' => 'Năm phát hành > 0',
                'theloai' =>  Theloai::all(),
                'nghesi' =>  Nghesi::all(),
                'contentFilter' => '-1',
                'active' => '',

            ]);
        }
        // $theloaitim = Theloai::where('tentheloai', $request->input('txttheloai'))->count();

        // if ($theloaitim != 0) {
        //     return view('Auth.qltheloai.themtheloai',  [
        //         'ttnguoidung' =>   Auth::guard('api')->user(),
        //         'loi' => 'Tên thể loại đã tồn tại vui lòng nhập tên khác.',
        //         'contentFilter' => '0',
        //         'active' => '',
        //     ]);
        // } else {
        //     $tl = new Theloai();
        //     $tl->tentheloai = $request->input('txttheloai');
        //     $tl->save();
        //     return redirect()->intended('/Administrator/qltheloai');
        // }
    }
    public function themns(Request $request)
    {
        $request->validate([
            'txtnghesi' => ['required'],
            'optloains' => ['required'],

        ]);
        $idnghesibt = User::where('email', $request->input('optloains'))->pluck('id')->first();
        $idnghesiapi = UserAPI::where('email', $request->input('optloains'))->pluck('id')->first();
        // dd($idnghesiapi, $idnghesibt);
        if ($idnghesibt) {
            $ktNghesia = Nghesi::where('id_nghesi_user', $idnghesibt)

                ->first();

            if ($ktNghesia) {
                return view(
                    'Auth.qlnghesi.themnghesi',
                    [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'user' =>  User::where('quyen', 4)->get(),
                        'theloai' =>  Theloai::all(),
                        'userapi' =>  UserAPI::where('quyen', 4)->get(),
                        'nghesi' =>  Nghesi::all(),
                        'contentFilter' => '-1',
                        'active' => '',
                        'loi' => 'Emai: ' . $request->input('optloains') . '. Đã là nghệ sĩ, vui lòng chọn Eamil khác.',
                    ]
                );
            } else {
                $ktNghesia = Nghesi::where('tennghesi', $request->input('txtnghesi'))
                    ->first();
                if ($ktNghesia) {
                    return view(
                        'Auth.qlnghesi.themnghesi',
                        [
                            'ttnguoidung' =>   Auth::guard('api')->user(),
                            'user' =>  User::where('quyen', 4)->get(),
                            'theloai' =>  Theloai::all(),
                            'userapi' =>  UserAPI::where('quyen', 4)->get(),
                            'nghesi' =>  Nghesi::all(),
                            'contentFilter' => '-1',
                            'active' => '',
                            'loi' => 'Tên: ' . $request->input('txtnghesi') . ' đã có, vui lòng chọn tên khác',
                        ]
                    );
                } else {
                    $ns = new Nghesi();
                    $ns->tennghesi = $request->input('txtnghesi');
                    $ns->id_nghesi_user = $idnghesibt;
                    $ns->mota = $request->input('txtmota');
                    $ns->save();
                    return redirect()->intended('/Administrator/qlnghesi');
                }
            }
        }
        if ($idnghesiapi) {
            $ktNghesi = Nghesi::where('idnghesi_userapi', $idnghesiapi)->first();
            if ($ktNghesi) {
                return view(
                    'Auth.qlnghesi.themnghesi',
                    [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'user' =>  User::where('quyen', 4)->get(),
                        'theloai' =>  Theloai::all(),
                        'userapi' =>  UserAPI::where('quyen', 4)->get(),
                        'nghesi' =>  Nghesi::all(),
                        'contentFilter' => '-1',
                        'active' => '',
                        'loi' => 'Tên: ' . $request->input('optloains') . '. Đã là nghệ sĩ, vui lòng chọn Eamil khác. ',
                    ]
                );
            } else {
                $ktNghesia = Nghesi::where('tennghesi', $request->input('txtnghesi'))
                    ->first();
                if ($ktNghesia) {
                    return view(
                        'Auth.qlnghesi.themnghesi',
                        [
                            'ttnguoidung' =>   Auth::guard('api')->user(),
                            'user' =>  User::where('quyen', 4)->get(),
                            'theloai' =>  Theloai::all(),
                            'userapi' =>  UserAPI::where('quyen', 4)->get(),
                            'nghesi' =>  Nghesi::all(),
                            'contentFilter' => '-1',
                            'active' => '',
                            'loi' => 'Tên: ' . $request->input('txtnghesi') . ' đã có, vui lòng chọn tên khác',
                        ]
                    );
                } else {
                    $ns = new Nghesi();
                    $ns->tennghesi = $request->input('txtnghesi');
                    $ns->idnghesi_userapi = $idnghesiapi;
                    $ns->mota = $request->input('txtmota');
                    $ns->save();
                    return redirect()->intended('/Administrator/qlnghesi');
                }
            }
        }
    }
    public function hinh()
    {
        return view(
            'Auth.hinh',
            [
                'ttnguoidung' =>   Auth::guard('api')->user(),
                'files' => File::allFiles(public_path('images')),
                'contentFilter' => '-1',
                'active' => '',
                'loi' => '',
            ]
        );
    }
    public function edit(string $id)
    {

        if (strpos($id, '&') !== false) {
            $parts = explode('&', $id);

            if (count($parts) == 3 && is_numeric($parts[0]) && is_numeric($parts[1]) && is_string($parts[2])) {

                if ($parts[2] == 'users') {
                    $user = User::where('id', $parts[0])
                        ->update([
                            'trangthai' => $parts[1],
                        ]);

                    return redirect()->intended('/Administrator');
                }
                if ($parts[2] == 'usersgg') {
                    $user = UserAPI::where('id', $parts[0])
                        ->update([
                            'trangthai' => $parts[1],
                        ]);

                    return redirect()->intended('/Administrator');
                }
            }
            if (count($parts) == 2 && is_numeric($parts[0]) && is_string($parts[1])) {


                if ($parts[1] == 'userde') {

                    $user = User::where('id', $parts[0])
                        ->first();
                    if (Auth::guard('api')->user()->quyen == 2 && $user->quyen == 2) {
                        return redirect()->intended('/Administrator');
                    }
                    if (Auth::guard('api')->user()->quyen == 2 && $user->quyen == 1) {
                        return redirect()->intended('/Administrator');
                    }
                    $nghesi = Nghesi::where('id_nghesi_user', $user->id)->first();
                    if ($nghesi) {
                        $album = Album::where('nghesi_idalbum',  $nghesi->id)->get();

                        foreach ($album as $alb) {
                            Nhac::where('album_idnhac', $alb->id)
                                ->delete();
                        }
                        Album::where('nghesi_idalbum',  $nghesi->id)->delete();
                        Nghesi::where('id_nghesi_user', $user->id)->delete();
                    }

                    User::where('id', $parts[0])->delete();

                    return redirect()->intended('/Administrator');
                }
                if ($parts[1] == 'userdegg') {
                    $user = UserAPI::where('id', $parts[0])
                        ->delete();

                    return redirect()->intended('/Administrator');
                }
                if ($parts[1] == 'userfix') {
                    $user = User::where('id', $parts[0])
                        ->first();

                    if (Auth::guard('api')->user()->quyen == 2 && $user->quyen == 2) {
                        return redirect()->intended('/Administrator');
                    }
                    if (Auth::guard('api')->user()->quyen == 2 && $user->quyen == 1) {
                        return redirect()->intended('/Administrator');
                    }
                    return view(
                        'Auth.qlnguoidung.fixnguoidung',
                        [
                            'ttnguoidung' =>   Auth::guard('api')->user(),
                            'user' =>    $user,
                            'userbt' =>    'userbt',
                            'contentFilter' => '0',
                            'active' => '0',
                        ]
                    );
                }
                if ($parts[1] == 'userfixgg') {
                    $user = UserAPI::where('id', $parts[0])
                        ->first();

                    return view(
                        'Auth.qlnguoidung.fixnguoidung',
                        [
                            'ttnguoidung' =>   Auth::guard('api')->user(),
                            'user' =>    $user,
                            'userbt' =>    '',
                            'contentFilter' => '0',
                            'active' => '0',
                        ]
                    );
                }
                if ($parts[1] == 'sendmail') {
                    $user = User::where('id', $parts[0])
                        ->first();

                    return view(
                        'Auth.qlnguoidung.sendmail',
                        [
                            'ttnguoidung' =>   Auth::guard('api')->user(),
                            'user' =>    $user,
                            'userbt' =>    '',
                            'contentFilter' => '0',
                            'loi' => "",
                            'active' => '0',
                        ]
                    );
                }
                if ($parts[1] == 'sendmailgg') {
                    $user = UserAPI::where('id', $parts[0])
                        ->first();

                    return view(
                        'Auth.qlnguoidung.sendmail',
                        [
                            'ttnguoidung' =>   Auth::guard('api')->user(),
                            'user' =>    $user,
                            'userbt' =>    '',
                            'contentFilter' => '0',
                            'loi' => "",
                            'active' => '0',
                        ]
                    );
                }
            }
            if (count($parts) == 2 && is_string($parts[0]) && is_string($parts[1])) {
                $cn = $parts[0];
                $name = $parts[1];
                $checkquyen = Auth::guard('api')->user();
                if ($cn == 'fillter' && $name == 'nv') {

                    try {
                        if ($checkquyen->quyen == 1) {
                            $searchUser = User::where('quyen', 2)
                                ->get();
                            if (Auth::guard('api')->check()) {
                                return view(
                                    'Auth.index',
                                    [
                                        'ttnguoidung' =>   Auth::guard('api')->user(),
                                        'user' => $searchUser,
                                        'userapi' =>  [],
                                        'usercount' =>  $searchUser->count(),
                                        'userapicount' =>  0,
                                        'searchbarinput' => '',
                                        'contentFilter' => '1',
                                        'active' => '0', 'suc' => "",
                                    ]
                                );
                            }
                        } else {
                            return redirect()->intended('/Administrator');
                        }
                    } catch (Exception $e) {
                        return redirect()->intended('/Administrator');
                    }
                }
                if ($cn == 'fillter' && $name == 'nd') {

                    try {
                        $searchUser = User::where('quyen', 3)
                            ->get();
                        $searchUser2 = UserAPI::where('quyen', 3)
                            ->get();
                        if (Auth::guard('api')->check()) {
                            return view(
                                'Auth.index',
                                [
                                    'ttnguoidung' =>   Auth::guard('api')->user(),
                                    'user' =>   $searchUser,
                                    'userapi' =>  $searchUser2,
                                    'usercount' =>  $searchUser->count(),
                                    'userapicount' =>  $searchUser2->count(),
                                    'searchbarinput' => '',
                                    'contentFilter' => '2',
                                    'active' => '0',
                                    'suc' => "",

                                ]
                            );
                        }
                    } catch (Exception $e) {
                    }
                }
                if ($cn == 'fillter' && $name == 'ns') {

                    try {
                        $searchUser = User::where('quyen', 4)
                            ->get();
                        $searchUser2 = UserAPI::where('quyen', 4)
                            ->get();
                        if (Auth::guard('api')->check()) {
                            return view(
                                'Auth.index',
                                [
                                    'ttnguoidung' =>   Auth::guard('api')->user(),
                                    'user' =>   $searchUser,
                                    'userapi' =>  $searchUser2,
                                    'usercount' =>  $searchUser->count(),
                                    'userapicount' =>  $searchUser2->count(),
                                    'searchbarinput' => '',
                                    'contentFilter' => '3',
                                    'active' => '0', 'suc' => "",
                                ]
                            );
                        }
                    } catch (Exception $e) {
                    }
                }
            }
        } else {
            return redirect()->intended('/Administrator');
        }
    }
    public function suggestData(Request $request)
    {
        $query = $request->input('query');

        $data = User::where('email', 'LIKE', "%$query%")->where('quyen', 4)->pluck('email');
        $data2 = UserAPI::where('email', 'LIKE', "%$query%")->where('quyen', 4)->pluck('email');

        return response()->json([$data, $data2]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function qlupdate(string $name, string $number, string $type)
    {
        // dd('abc');
        if ($name == 'suanghesi') {
            return view(
                'Auth.qlnghesi.suanghesi',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'theloai' =>  Theloai::all(),
                    'userapi' =>  UserAPI::all(),
                    'nghesi' =>  Nghesi::where('id', $number)->first(),
                    'contentFilter' => '-1',
                    'active' => '',
                    'loi' => '',
                ]
            );
        }
        if ($name == 'suaalbum') {
            return view(
                'Auth.qlalbum.suaalbum',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),

                    'theloai' =>  Theloai::all(),

                    'nghesi' =>  Nghesi::all(),
                    'album' =>  Album::where('id', $number)->first(),
                    'contentFilter' => '-1',
                    'active' => '',
                    'loi' => '',
                ]
            );
        }
        if ($name == 'xemalbum') {
            $xemalbum = Album::where('id', $number)->first();
            $nsxemalbum = Nghesi::where('id', $xemalbum->nghesi_idalbum)->first();
            $tlxemalbum = Theloai::where('id', $xemalbum->theloai_idalbum)->first();
            $nhacxemalbum = Nhac::where('album_idnhac', $number)->get();

            if ($nsxemalbum->id_nghesi_user > 0) {
                $usxemalbum = User::where('id', $nsxemalbum->id_nghesi_user)->first();
            }
            if ($nsxemalbum->idnghesi_userapi > 0) {
                $usxemalbum = UserAPI::where('id', $nsxemalbum->idnghesi_userapi)->first();
            }
            $albumgoiy = Album::where('nghesi_idalbum', '=', $xemalbum->nghesi_idalbum)
                ->where('id', '!=', Album::where('id', '=', $number)->pluck('id'))->get();
            // dd($albumgoiy);
            return view(
                'Auth.qlalbum.xemalbum',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' => $usxemalbum,
                    'theloai' =>   $tlxemalbum,
                    'nhac' =>  $nhacxemalbum,
                    'nghesi' =>  $nsxemalbum,
                    'album' =>   $xemalbum,
                    'albumgoiy' =>   $albumgoiy,
                    'contentFilter' => '-1',
                    'active' => '',
                    'loi' => '',
                ]
            );
        }
        if ($name == 'suanhac') {
            $music = Nhac::where('id', $number)->first();
            $ns = Nghesi::all();
            return view('Auth.qlnhac.suamusic', [
                'ttnguoidung' =>  Auth::guard('api')->user(),
                'album' => Album::all(),
                'music' => $music,
                'nghesi' =>  $ns,
                'active' => '',
                'loi' => '',
                'contentFilter' => '-1',
            ]);
        }
        if ($name == 'duyetmusic') {
            if ($type == 'albc') {
                $nhac = Nhac::where('id', $number)->update([
                    'xetduyet' => 1
                ]);
            }
            if ($type == 'albd') {
                $nhac = Nhac::where('id', $number)->update([
                    'xetduyet' => 0
                ]);
            }
            return redirect()->intended('/Administrator/qlnhac');
        }
        if ($name == "xemcomment") {
            return view('Auth.qlnhac.xemcomment', [
                'ttnguoidung' =>  Auth::guard('api')->user(),
                'album' => Album::all(),
                'comment' => Comment::where("idnhac", $number)->get(),
                'countComment' => Comment::where("idnhac", $number)->count(),
                'Nhacalbumbaihat' => $number,
                'active' => '',
                'loi' => '',
                'contentFilter' => '-1',
            ]);
        }
    }
    public function deletecommentAdmin(string $name)
    {
        if (Auth::guard('api')->check()) {
            $tl = Comment::where('id', $name)->delete();
            return response()->json(['response' => "ok"]);
        }

        return response()->json(['response' => "loi"]);
    }
    public function commentmusicAdmin(Request $request, string $name)
    {
        if ($request->input('query')) {
            if (Auth::guard('api')->check()) {
                $comment = new Comment;
                $comment->idnhac = $name;
                $comment->ten = Auth::guard('api')->user()->email;
                $comment->hinh = Auth::guard('api')->user()->image;
                $comment->noidung = $request->input('query');
                $comment->time = Carbon::now();
                $comment->save();
                return response()->json(['response' => "ok"]);
            }

            return response()->json(['response' => "no"]);
        }
    }
    public function suanghesi(Request $request)
    {
        $request->validate([
            'txttennghesi' => ['required'],
            'txtidnghesi' => ['required'],
            'txttype' => ['required'],

        ]);

        if ($request->input('txttype') == 'user') {
            $nghesi = Nghesi::where('id', $request->input('txtidnghesi'))->update([
                'tennghesi' => $request->input('txttennghesi'),

                'mota' => $request->input('txtmota'),
            ]);
            return redirect()->intended('/Administrator/qlnghesi');
        }
        if ($request->input('txttype') == 'userapi') {
            $nghesi = Nghesi::where('id', $request->input('txtidnghesi'))->update([
                'tennghesi' => $request->input('txttennghesi'),

                'mota' => $request->input('txtmota'),
            ]);
            return redirect()->intended('/Administrator/qlnghesi');
        } else {
            return view(
                'Auth.qlnghesi.suanghesi',
                [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'user' =>  User::all(),
                    'theloai' =>  Theloai::all(),
                    'userapi' =>  UserAPI::all(),
                    'nghesi' =>  Nghesi::where('id',  $request->input('txtidnghesi'))->first(),
                    'contentFilter' => '-1',
                    'active' => '',
                    'loi' => 'Lỗi',
                ]
            );
        }
    }
    public function suaalbum(Request $request)
    {

        $a = $request->validate([
            'txtidalbum' => ['required'],
            'txttenalbum' => ['required'],
            'txtnamphathanh' => ['required'],
            'optloains' => ['required'],
            'optloaitl' => ['required'],
            'txthinha' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('txthinha') != null) {
            $generatedimage = 'image' . time() . '-' . $request->file('txthinha')->getClientOriginalName();
            $request->file('txthinha')->move(public_path('images'), $generatedimage);

            if ($request->input('txtnamphathanh') > 0) {

                $al = Album::where('id', $request->input('txtidalbum'))->update([
                    'hinhalbum' =>  $generatedimage,
                    'tenalbum' => $request->input('txttenalbum'),
                    'namphathanh' => $request->input('txtnamphathanh'),
                    'nghesi_idalbum' => $request->input('optloains'),
                    'theloai_idalbum'  => $request->input('optloaitl'),
                ]);


                return redirect()->intended('/Administrator/qlalbum');
            } else {
                return view('Auth.qlalbum.suaalbum',  [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'loi' => 'Năm phát hành > 0',
                    'theloai' =>  Theloai::all(),
                    'nghesi' =>  Nghesi::all(),
                    'contentFilter' => '-1',
                    'active' => '',

                ]);
            }
        } else {
            if ($request->input('txtnamphathanh') > 0) {
                $al = Album::where('id', $request->input('txtidalbum'))->update([
                    'tenalbum' => $request->input('txttenalbum'),
                    'namphathanh' => $request->input('txtnamphathanh'),
                    'nghesi_idalbum' => $request->input('optloains'),
                    'theloai_idalbum'  => $request->input('optloaitl'),
                ]);


                return redirect()->intended('/Administrator/qlalbum');
            } else {
                return view('Auth.qlalbum.suaalbum',  [
                    'ttnguoidung' =>   Auth::guard('api')->user(),
                    'loi' => 'Năm phát hành > 0',
                    'theloai' =>  Theloai::all(),
                    'nghesi' =>  Nghesi::all(),
                    'contentFilter' => '-1',
                    'active' => '',

                ]);
            }
        }
    }
    public function suanhac(Request $request)
    {
        $request->validate([
            'txttennhac' => ['required'],
            'fnhac' => 'mimes:mp3',
            'txtmanhac' => ['required'],
            'txtgia' => ['required'],

            'fhinh' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'optloains' => ['required'],
            'optloaiphi' => ['required'],

        ]);
        if ($request->input('txtgia') <= 0) {
            $music = Nhac::where('id', $request->input('txtidnhac'))->first();
            $ns = Nghesi::all();
            return view('Auth.qlnhac.suamusic', [
                'ttnguoidung' =>  Auth::guard('api')->user(),
                'album' => Album::all(),
                'music' => $music,
                'nghesi' =>  $ns,
                'active' => '',
                'loi' => 'Giá không được < 0',
                'contentFilter' => '-1',
            ]);
        }
        if ($request->input('txtmotalyric')) {
            $lyri = $request->input('txtmotalyric');
        } else {
            $lyri = '';
        }
        if ($request->file('fnhac') != null) {
            $generatedmusic = 'music' . time() . '-' . $request->file('fnhac')->getClientOriginalName();
            $request->file('fnhac')->move(public_path('music'), $generatedmusic);
            if ($request->file('fhinh') != null) {
                $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
                $request->file('fhinh')->move(public_path('images'), $generatedimage);
                $nhac = Nhac::where('id', $request->input('txtidnhac'))
                    ->update([
                        'tennhac' => $request->input('txttennhac'),
                        'nhaclink' => $generatedmusic,
                        'imagemusic' => $generatedimage,
                        'album_idnhac'   => $request->input('optloains'),
                        'maNhac' => $request->input('txtmanhac'),
                        'gia' => $request->input('txtgia'),
                        'lyric' => $lyri,
                        'vip' => $request->input('optloaiphi'),

                    ]);
            } else {
                $nhac = Nhac::where('id', $request->input('txtidnhac'))
                    ->update([
                        'tennhac' => $request->input('txttennhac'),
                        'nhaclink' => $generatedmusic,

                        'album_idnhac'   => $request->input('optloains'),
                        'maNhac' => $request->input('txtmanhac'),
                        'gia' => $request->input('txtgia'),
                        'lyric' => $lyri,
                        'vip' => $request->input('optloaiphi'),
                    ]);
            }
        } else {
            if ($request->file('fhinh') != null) {
                $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
                $request->file('fhinh')->move(public_path('images'), $generatedimage);
                $nhac = Nhac::where('id', $request->input('txtidnhac'))
                    ->update([
                        'tennhac' => $request->input('txttennhac'),
                        'imagemusic' => $generatedimage,
                        'album_idnhac'   => $request->input('optloains'),
                        'maNhac' => $request->input('txtmanhac'),
                        'gia' => $request->input('txtgia'),
                        'lyric' => $lyri,
                        'vip' => $request->input('optloaiphi'),
                    ]);
            } else {
                $nhac = Nhac::where('id', $request->input('txtidnhac'))
                    ->update([
                        'tennhac' => $request->input('txttennhac'),
                        'album_idnhac'   => $request->input('optloains'),
                        'maNhac' => $request->input('txtmanhac'),
                        'gia' => $request->input('txtgia'),
                        'lyric' => $lyri,
                        'vip' => $request->input('optloaiphi'),
                    ]);
            }
        }




        return redirect()->intended('/Administrator/qlnhac');
        // dd('', $request->input());



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (strpos($id, '-') !== false) {
            $parts = explode('-', $id);
            if (count($parts) == 2 && is_numeric($parts[0]) && is_string($parts[1])) {
                if ($parts[1] == 'tl') {

                    $theloai = Theloai::where('id', $parts[0])
                        ->delete();
                    return redirect()->intended('/Administrator/qltheloai');
                }
                if ($parts[1] == 'ns') {
                    $nghesi = Nghesi::where('id', $parts[0])->first();
                    $album = Album::where('nghesi_idalbum', $parts[0])->get();
                    foreach ($album as $alb) {
                        Nhac::where('album_idnhac', $alb->id)
                            ->delete();
                    }
                    Album::where('nghesi_idalbum', $parts[0])->delete();
                    Nghesi::where('id', $parts[0])->delete();
                    return redirect()->intended('/Administrator/qlnghesi');
                }
                if ($parts[1] == 'alb') {
                    Nhac::where('album_idnhac', $parts[0])
                        ->delete();
                    Album::where('id', $parts[0])
                        ->delete();

                    return redirect()->intended('/Administrator/qlalbum');
                }
                if ($parts[1] == 'music') {
                    $nghesi = Nhac::where('id', $parts[0])
                        ->delete();
                    return redirect()->intended('/Administrator/qlnhac');
                }
            }
        } else {
            return redirect()->intended('/Administrator');
        }
    }
}