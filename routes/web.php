<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
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
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/register', function () {
    return redirect('login');
});

Route::controller(AdminController::class)->middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::get('/user', 'index');
    });
});

Route::get('/room-911',  [
    RoomController::class,
    'index'
]);

Route::post('/room/register', [
    RoomController::class,
    'register'
])->name('room.register');

Route::post('/room/exit', [
    RoomController::class,
    'exit'
])->name('room.exit');
