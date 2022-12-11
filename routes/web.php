<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MotelsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::controller(MotelsController::class)->group(function(){
    // hien thi trang chu user
    Route::get('/','index')->name('index');
    Route::get('motels/list/{id}', 'showview')->name('motels/list/view');

    //xu ly trang chu admin khi login user thanh cong
    Route::get('admin/home', 'adminhome')->name('admin/home');

    // xu ly hien thi danh sach ban ghi tu bang motels
    Route::get('admin/home/add', 'create')->name('admin/home/add'); //hien thi form them danh sach phong tro
    Route::post('admin/home/add','store')->name('admin/home/store'); //xu ly them danh sach phong tro tu form

    Route::get('admin/home/edit/{id}', 'edit')->name('admin/home/edit'); //hien thi form sua danh sach phong tro
    Route::post('admin/home/edit/{id}', 'update')->name('admin/home/update'); // xu ly sua danh sach phong tro tu form

    Route::get('admin/home/delete/{id}', 'destroy')->name('admin/home/delete'); // xu ly xoa danh sach phong tro

});
//login-admin
Route::get('admin/login', [LoginController::class, 'login'])->name('admin/login');
Route::post('admin/loginproses', [LoginController::class, 'loginproses'])->name('admin/loginproses');

//register-admin
Route::get('admin/register', [LoginController::class, 'register'])->name('admin/register');
Route::post('admin/registeruser', [LoginController::class, 'registeruseradmin'])->name('admin/registeruser');

//logout-admin
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin/logout');
