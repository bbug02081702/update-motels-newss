<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Motels;
use App\Models\Districts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // hien thi giao dien quan danh sach user 
    public function indexUserManager(){
        $users = User::orderBy('created_at', 'DESC')->paginate(2);
             // xu ly tim kiem theo username
             
            
        return view('admin.managerusermotels.index',compact('users'));  
    }

    
    // hien thi giao dien them danh sach user nhap tu form 
    public function createUserManager(){
        return view('admin.managerusermotels.add');
    }

    // xu ly khi them danh sach user tu form da dc nhap 
    public function storeUserManager(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'email' => 'required',
            
        ]);
        $users = User::create($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('fotopegawai/', $request->file('avatar')->getClientOriginalName());
            $users->avatar = $request->file('avatar')->getClientOriginalName();
            $users->save();
         }
        return redirect()->route('admin/home/manageruser')->with('Thongbao', 'Them danh sach user thanh cong');
    }

    // hien thi giao dien sua danh sach phong tro 
    public function editUserManager($id){
        $users = User::find($id);
        return view('admin.managerusermotels.edit',compact('users'));
    }

    // xu ly sua user tu form
    public function updateUserManager(Request $request, $id){
        $users = User::find($id);
        $users->update($request->all());
        return redirect()->route('admin/home/manageruser')->with('Thongbao', 'Sua user thanh cong');

    }

    // xu ly xoa user theo id
    public function destroyUserManager($id){
        $users = User::find($id);
        $users->delete();
        return redirect()->route('admin/home/manageruser')->with('Thongbao', 'Xoa user thanh cong');
    }

//-----------------------------------USER-------------------------------------//
   public function homeUser(){
    // return view('user.home.activeuser');

    $users = DB::table('users')
    ->join('motels', 'users.id', '=', 'motels.id')
    ->select('users.*', 'motels.*')
    ->get();
    // dd($users);
     return view('user.home.info.account', compact('users'));
    // return view('user.home.info.account',compact('users'));
   }
//    $users = DB::table('users')
//    ->join('motels', 'users.id', '=', 'motels.id')
//    ->join('districts', 'users.id', '=', 'districts.id')
//    ->select('users.*', 'motels.*', 'districts.*')
//    ->get();
//    dd($users);
//    return view('user.home.activeuser',compact('users'));

}
