<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nr = rand(0, 4);
        switch($nr){
            case 0: $data = "Hi, "; break;
            case 1: $data = "Hallo, "; break;
            case 2: $data = "Willkommen, "; break;
            case 3: $data = "Hey, "; break;
            case 4: $data = "Guten Tag, "; break;
            default: $data = "Hi, "; break;
        }

        return view('welcome', compact('data'));
    }
}
