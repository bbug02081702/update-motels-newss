<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MotelsController;
use App\Http\Controllers\UserLoginController;

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

//--------------------------------ADMIN------------------------------------//
    //xu ly trang chu admin khi login user thanh cong
    Route::get('admin/home', 'adminhome')->name('admin/home');

    // xu ly hien thi danh sach ban ghi tu bang motels
    Route::get('admin/home/add', 'create')->name('admin/home/add'); //hien thi form them danh sach phong tro
    Route::post('admin/home/add','store')->name('admin/home/store'); //xu ly them danh sach phong tro tu form

    Route::get('admin/home/edit/{id}', 'edit')->name('admin/home/edit'); //hien thi form sua danh sach phong tro
    Route::post('admin/home/edit/{id}', 'update')->name('admin/home/update'); // xu ly sua danh sach phong tro tu form

    Route::get('admin/home/delete/{id}', 'destroy')->name('admin/home/delete'); // xu ly xoa danh sach phong tro
   
    //-------------------------------CATEGORY-----------------------------------------------------------//
    Route::get('admin/home/category', 'indexCategory')->name('admin/home/category');

    Route::get('admin/home/category/add', 'createCategory')->name('admin/home/category/add');// hien thi form them danh muc
    Route::post('admin/home/category/add', 'storeCategory')->name('admin/home/category/store');//xu ly them danh muc phong tro

    Route::get('admin/home/category/edit/{id}', 'editCategory')->name('admin/home/category/edit');
    Route::post('admin/home/category/update/{id}', 'updateCategory')->name('admin/home/category/update');

    Route::get('admin/home/category/delete/{id}', 'destroyCategory')->name('admin/home/category/delete');
});


//-----------------------------------USER-MANAGER-CONTROLLER-----------------------//
Route::controller(UserController::class)->group(function(){
    //------------------------------------ADMIN-USER----------------------------//
   Route::get('admin/home/manageruser', 'indexUserManager')->name('admin/home/manageruser');

   // xu ly hien thi danh sach ban ghi tu bang users
   Route::get('admin/home/addmanageruser', 'createUserManager')->name('admin/home/addmanageruser'); //hien thi form them user
   Route::post('admin/home/storemanageruser','storeUserManager')->name('admin/home/storemanageruser'); //xu ly them user tu form

   Route::get('admin/home/editmanageruser/{id}', 'editUserManager')->name('admin/home/editmanageruser'); //hien thi form sua user
   Route::post('admin/home/updatemanageruser/{id}', 'updateUserManager')->name('admin/home/updatemanageruser'); // xu ly sua user tu form

   Route::get('admin/home/deletemanageruser/{id}', 'destroyUserManager')->name('admin/home/deletenageruser'); // xu ly xoa user



   //----------------------------------------------USER-ACCOUNT--------------------------------//
   Route::get('user/home/info', 'homeUser')->name('user/home/info'); 
   //test url info
   Route::get('user/home/post', 'postUser')->name('user/home/post');


});


//------------------------login user-------------------//
Route::get('user/login', [UserLoginController::class, 'loginUser'])->name('user/login');
Route::post('user/loginuserproses', [UserLoginController::class, 'loginProsesUser'])->name('user/loginuserproses');

//register-user
Route::get('user/register', [UserLoginController::class, 'registerUser'])->name('user/register');
Route::post('user/registeruser', [UserLoginController::class, 'registerUserStore'])->name('user/registeruser');

//logout-user
Route::get('user/logout', [LoginController::class, 'logoutUser'])->name('user/logout');


//------------------------login admin-------------------//
//login-admin
Route::get('admin/login', [LoginController::class, 'login'])->name('admin/login');
Route::post('admin/loginproses', [LoginController::class, 'loginproses'])->name('admin/loginproses');

//register-admin
Route::get('admin/register', [LoginController::class, 'register'])->name('admin/register');
Route::post('admin/registeruser', [LoginController::class, 'registeruseradmin'])->name('admin/registeruser');

//logout-admin
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin/logout');


//---------------------------TONG QUAN ADMIN--------------------------//
Route::get('admin/dasboard', [MotelsController::class, 'dasboard'])->name('admin/dasboard');

