<?php

namespace App\Http\Controllers;

use App\Models\ErrorLog;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Auth;

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
        $projectIds = ProjectUser::where('user_id', '=', Auth::user()->id)->pluck('project_id');

        return view('home')
            ->with('logs',
                ErrorLog::whereIn('project_id', $projectIds)
                ->orderBy('creation_date', 'desc')
                ->orderBy('created_at', 'desc')
                ->simplePaginate(50)
            );
    }

    public function viewLog(ErrorLog $log, Request $request)
    {
        return view('log')
            ->with('errorLog', $log);
    }
}
