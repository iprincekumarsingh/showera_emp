<?php

use App\Http\Controllers\AttendanceTrackerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::post('/check_in', [AttendanceTrackerController::class, 'in_time']);
Route::post('/check_out', [AttendanceTrackerController::class, 'out_time']);
Route::get('/get_data', [AttendanceTrackerController::class, 'get_in_status']);
Route::get('/get_out_data', [AttendanceTrackerController::class, 'get_out_status']);