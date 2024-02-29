<?php

namespace App\Http\Controllers;

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
                        'contentFilter' => '0',
                        'active' => '0',
                    ]
                );
            } else {
                return view('Auth.login');
            }
        }
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('Auth.login');
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
                ]
            );
        } else {
            return view('Auth.login');
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
        $generatedimage = 'img' . time() . '-' . $request->file('txthinh')->getClientOriginalName();
        $request->file('txthinh')->move(public_path('img'), $generatedimage);
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
                if (Hash::check($request->password, $users->password)) {
                    Auth::guard('api')->login($users);
                    if (Auth::guard('api')->check()) {

                        return  redirect()->intended('/Administrator');
                    }
                } else {
                    return view('Auth.login');
                }
            } else {
                return view('Auth.login');
            }
        } catch (Exception $e) {
            return view('Auth.login');
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
    public function fillter(string $cn, string $name)
    {
        if ($cn == 'fillter' && $name == 'nv') {

            try {
                $searchUser = User::where('quyen', 2)
                    ->get();
                if (Auth::guard('api')->check()) {
                    return view(
                        'Auth.index',
                        [
                            'ttnguoidung' =>   Auth::guard('api')->user(),
                            'user' => $searchUser,
                            'contentFilter' => '1',
                            'active' => '0',
                        ]
                    );
                }
            } catch (Exception $e) {
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
