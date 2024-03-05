<?php

namespace App\Http\Controllers;

use App\Models\Nghesi;
use App\Models\Theloai;
use App\Models\User;
use App\Models\UserAPI;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class AdminControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(string $name)
    {
        if ($name === 'Administrator') {
            if (Auth::guard('api')->check()) {

                return view(
                    'Auth.index',
                    [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'user' =>  User::all(),
                        'userapi' =>  UserAPI::all(),
                        'usercount' =>  User::all()->count(),
                        'userapicount' =>  UserAPI::all()->count(),
                        'contentFilter' => '0',
                        'active' => '0',
                    ]
                );
            } else {
                return view('Auth.login', ['loi' => '']);
            }
        }
        return view('welcome');
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
        $user->trangthai = 1;
        $user->save();
        return redirect()->intended('/Administrator');
    }
    public function loginuser(Request $request)
    {

        // dd('a');

        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            $users = User::where("email", $request->input('email'))->first();
            if ($credentials) {
                if ($users->trangthai != 0) {
                    if (Hash::check($request->password, $users->password)) {
                        Auth::guard('api')->login($users);
                        if (Auth::guard('api')->check()) {

                            return  redirect()->intended('/Administrator');
                        }
                    } else {
                        return view('Auth.login', ['loi' => 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại']);
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
                        'contentFilter' => '0',
                        'active' => '0',
                    ]
                );
            }
        } catch (Exception $e) {
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
            ]);

            if ($request->input('txtmatkhau') != null) {
                if ($request->input('idnguoidungselect') == 'userbt') {
                    $user = User::where('id', $request->input('idnguoidung'))
                        ->update([
                            'password' => Hash::make($request->input('txtmatkhaumoi')),
                            'vip' => $request->input('optloaindvip'),
                            'quyen' => $request->input('optloaind')
                        ]);
                    return redirect()->intended('/Administrator');
                }
                if ($request->input('idnguoidungselect') == 'usergg') {
                    $user = UserAPI::where('id', $request->input('idnguoidung'))
                        ->update([
                            'password' => Hash::make($request->input('txtmatkhaumoi')),
                            'vip' => $request->input('optloaindvip'),
                            'quyen' => $request->input('optloaind')
                        ]);
                    return redirect()->intended('/Administrator');
                }
            } else {
                if ($request->input('idnguoidungselect') == 'userbt') {
                    $user = User::where('id', $request->input('idnguoidung'))
                        ->update([

                            'vip' => $request->input('optloaindvip'),
                            'quyen' => $request->input('optloaind')
                        ]);
                    return redirect()->intended('/Administrator');
                }
                if ($request->input('idnguoidungselect') == 'usergg') {
                    $user = UserAPI::where('id', $request->input('idnguoidung'))
                        ->update([

                            'vip' => $request->input('optloaindvip'),
                            'quyen' => $request->input('optloaind')
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
                'contentFilter' => '0',
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
                'nghesi' =>  Nghesi::all(),
                'contentFilter' => '0',
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
                'contentFilter' => '0',
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
            'contentFilter' => '0',
            'active' => '',
        ]);
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
                        'contentFilter' => '0',
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
                'contentFilter' => '0',
                'active' => '',
            ]);
        } else {
            $tl = new Theloai();
            $tl->tentheloai = $request->input('txttheloai');
            $tl->save();
            return redirect()->intended('/Administrator/qltheloai');
        }
    }
    public function themns(Request $request)
    {
        $request->validate([
            'txtnghesi' => ['required'],
            'optloains' => ['required'],
        ]);
        $idnghesibt = User::where('email', $request->input('optloains'))->first();
        $idnghesiapi = UserAPI::where('email', $request->input('optloains'))->first();
        // dd($idnghesiapi->id, $idnghesibt);
        if ($idnghesibt) {
            $ktNghesia = Nghesi::where('id_nghesi_user', $idnghesibt);
            if ($ktNghesia) {
                return view(
                    'Auth.qlnghesi.themnghesi',
                    [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'user' =>  User::where('quyen', 4)->get(),
                        'theloai' =>  Theloai::all(),
                        'userapi' =>  UserAPI::where('quyen', 4)->get(),
                        'nghesi' =>  Nghesi::all(),
                        'contentFilter' => '0',
                        'active' => '',
                        'loi' => 'Emai: ' . $request->input('optloains') . '. Đã là nghệ sĩ, vui lòng chọn Eamil khác.',
                    ]
                );
            } else {
                $ns = new Nghesi();
                $ns->tennghesi = $request->input('txtnghesi');
                $ns->id_nghesi_user = $idnghesibt->id;
                $ns->save();
                return redirect()->intended('/Administrator/qlnghesi');
            }
        }
        if ($idnghesiapi) {
            $ktNghesi = Nghesi::where('idnghesi_userapi', $idnghesiapi);
            if ($ktNghesi) {
                return view(
                    'Auth.qlnghesi.themnghesi',
                    [
                        'ttnguoidung' =>   Auth::guard('api')->user(),
                        'user' =>  User::where('quyen', 4)->get(),
                        'theloai' =>  Theloai::all(),
                        'userapi' =>  UserAPI::where('quyen', 4)->get(),
                        'nghesi' =>  Nghesi::all(),
                        'contentFilter' => '0',
                        'active' => '',
                        'loi' => 'Emai: ' . $request->input('optloains') . '. Đã là nghệ sĩ, vui lòng chọn Eamil khác.',
                    ]
                );
            } else {
                $ns = new Nghesi();
                $ns->tennghesi = $request->input('txtnghesi');
                $ns->idnghesi_userapi = $idnghesiapi->id;
                $ns->save();
                return redirect()->intended('/Administrator/qlnghesi');
            }
        }
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
                        ->delete();

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
            }
            if (count($parts) == 2 && is_string($parts[0]) && is_string($parts[1])) {
                $cn = $parts[0];
                $name = $parts[1];
                $checkquyen = Auth::guard('api')->user();
                if ($cn == 'fillter' && $name == 'nv') {

                    try {
                        if ($checkquyen != 2) {
                            $searchUser = User::where('quyen', 2)
                                ->get();
                            if (Auth::guard('api')->check()) {
                                return view(
                                    'Auth.index',
                                    [
                                        'ttnguoidung' =>   Auth::guard('api')->user(),
                                        'user' => $searchUser,
                                        'userapi' =>  [],
                                        'contentFilter' => '1',
                                        'active' => '0',
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
                                    'contentFilter' => '2',
                                    'active' => '0',
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
                                    'contentFilter' => '3',
                                    'active' => '0',
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (strpos($id, '-') !== false) {
            $parts = explode('-', $id);
            if (count($parts) == 2 && is_numeric($parts[0]) && is_string($parts[1])) {
                if (is_string($parts[1]) == 'tl') {
                    $theloai = Theloai::where('id', $parts[0])
                        ->delete();
                }


                return redirect()->intended('/Administrator/qltheloai');
            }
        } else {
            return redirect()->intended('/Administrator');
        }
    }
}
