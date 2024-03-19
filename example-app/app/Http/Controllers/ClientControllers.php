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
        $content = View::make('frontend.menu.trangchu',['name'=>'helo đã chuyền'])->render();
        return view('frontend.home', ['content' => $content]);
    }

    public function loadtrangchu(Request $request)
    {

        $content = View::make('frontend.menu.trangchu',['name'=>'helo đã chuyển hướng'])->render();

        return response()->json(['content' => $content]);
    }
    public function loadyeuthich(Request $request)
    {

        $content = View::make('frontend.menu.yeuthich',['name'=>'helo đã chuyển hướng'])->render();

        return response()->json(['content' => $content]);
    }
    
    public function loadlivechat(Request $request)
    {

        $content = View::make('frontend.menu.livechat',['name'=>'helo đã chuyển hướng'])->render();

        return response()->json(['content' => $content]);
    }
    public function loadMchart(Request $request)
    {

        $content = View::make('frontend.menu.Mchart',['name'=>'helo đã chuyển hướng'])->render();

        return response()->json(['content' => $content]);
    }
    public function loadranksong(Request $request)
    {

        $content = View::make('frontend.menu.ranksong',['name'=>'helo đã chuyển hướng'])->render();

        return response()->json(['content' => $content]);
    }
    public function loadtopic(Request $request)
    {

        $content = View::make('frontend.menu.topic',['name'=>'helo đã chuyển hướng'])->render();

        return response()->json(['content' => $content]);
    }
}