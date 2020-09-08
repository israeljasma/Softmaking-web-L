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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //public function index(Request $request)
    public function index()
    {
        //Testting alerts
        //$request->session()->flash('success','test success message');
        //$request->session()->flash('warning','test warning message');
        //$request->session()->flash('error','test error message');
        return view('home');
    }
}
