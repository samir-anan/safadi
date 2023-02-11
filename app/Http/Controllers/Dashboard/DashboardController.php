<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct(){
        // $this->middleware(['auth']);
        // $this->middleware(['auth'])->except(['index']);
        // $this->middleware(['auth'])->only(['index']);
    }

    public function index()
    {
        return view('dashboard.index');
//        return View::make('dashboard')->with([
//            'name' => 'Mohammed Safadi'
//        ]);
//        return response()->view('dashboard',[
//            'name' => 'Mohammed Safadi'
//        ]);
//        return Response::view('dashboard',[
//            'name' => 'Mohammed Safadi'
//        ]);
    }
}
