<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dash', function () {
    return view('dashboard');
})
->middleware(['auth']);





require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';

