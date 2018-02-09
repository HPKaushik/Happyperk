<?php

namespace App\Http\Controllers;
use \App\Lib\hp_utils;
use Auth;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mgr = new \App\ResourceMgr\CategoryMgr();
//return $resl = $mgr->getAll();
// return $utils = hp_utils::getProductCount();
//    if (Auth::user()->hasRole('Admin')) {
//          return 'working';
//        }
//       return $roles = Auth::user()->roles()->get();
       return view('home');
    }
}
