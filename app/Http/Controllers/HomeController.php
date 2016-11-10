<?php

namespace App\Http\Controllers;

use App\Models\ErrorLog;
use GuzzleHttp\Client;
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
    public function index(Request $request)
    {
        return view('home')
            ->with('logs', ErrorLog::orderBy('creation_date', 'desc')
                ->orderBy('created_at', 'desc')
                ->simplePaginate(10)
            );
    }
}
