<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class ClientControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        return view('frontend.home', ['activerity' => 0, 'content' => '']);
    }

    public function loadtrangchu()
    {
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