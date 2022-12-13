<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // hien thi giao dien quan danh sach user 
    public function indexUserManager(){
        $users = User::orderBy('created_at', 'DESC')->paginate(2);
        return view('admin.managerusermotels.index',compact('users'));
       
    }
}
