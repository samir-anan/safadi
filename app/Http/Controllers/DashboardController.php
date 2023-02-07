<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index')->with([
            'name' => 'Mohammed Safadi'
        ]);
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
