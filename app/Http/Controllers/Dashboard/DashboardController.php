<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; // Ensure correct base Controller is used

class DashboardController extends Controller
{
    // public function __construct(){

    //     $this->middleware(['auth']);
    // }
    public function index()
    {
        $user = 'Dalia Allafaf';
        $title = 'Store';
        $user = Auth::user();
        // dd($user);
        return view('dashboard.index', compact('user', 'title'));
        //  return View::make('dashboard', compact('user', 'title'));
        //  return response()->('dashboard', compact('user', 'title'));
    }
}
