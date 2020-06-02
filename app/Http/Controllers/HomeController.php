<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;

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
    public function index()
    {
        $customers_count = DB::table('customers')->count();
        return view::make('app.dashboard')->with(['c_count'=>$customers_count]);
    }
}
