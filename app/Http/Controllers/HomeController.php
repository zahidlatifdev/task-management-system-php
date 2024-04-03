<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Organization;

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

        $organization = Organization::find(1);

       return view('home', compact('organization'));
    }
}
