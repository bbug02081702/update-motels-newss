<?php

namespace App\Http\Controllers;

use App\Models\Motels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MotelsController extends Controller
{
    // hien thi trang chu mac dinh cho user
    public function index(){
       $motels = DB::table('motels')->orderBy('created_at', 'DESC')->paginate(2);
       
    // xu ly tim kiem theo tieu de cho trang chu user
    if($title = request()->title){
      $motels = DB::table('motels')->orderBy('created_at', 'DESC')->where('title', 'LIKE', '%'.$title.'%')->get();
    }

    //xu ly tim kiem theo gia cho trang chu
    if($price = request()->price){
        $motels = DB::table('motels')->orderBy('created_at', 'DESC')->where('price', 'LIKE', '%'.$price.'%')->get();
    }
       return view('user.home.index', compact('motels'));
    }
    //
    // xu ly luot xem chi tiet bai viet
    public function showview($id){
        $post = Motels::find($id);
        $update = ['count_view' =>$post->count_view + 1,];
        Motels::where('id',$post->id)->update($update);

        $motels = DB::table('motels')->where('id',$id)->get();
        return view('motel.index',compact('motels'));
    }

    //hien thi trang chu quan ly cua admin
    public function adminhome(){
        $motels = Motels::orderBy('created_at', 'DESC')->paginate(2);
        // dd($motels);
        // xu ly tim kiem theo tieu de phong tro
        if($key=request()->key){
            $motels = Motels::orderBy('created_at', 'DESC')->where('title','like', '%'.$key.'%')->paginate(2);
          }
        return view('admin.managermotels.index', compact('motels'));
    }
    
    // hien thi giao dien them danh sach phong tro nhap tu form 
    public function create(){
        return view('admin.managermotels.add');
    }

    // xu ly khi them danh sach phong tro tu form da dc nhap 
    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required',
        ]);
        $motels = Motels::create($request->all());
        if($request->hasFile('images')){
            $request->file('images')->move('photocreate/', $request->file('images')->getClientOriginalName());
            $motels->images = $request->file('images')->getClientOriginalName();
            $motels->save();
        }
        return redirect()->route('admin/home')->with('Thongbao', 'Them danh sach phong tro thanh cong');
    }

    // hien thi giao dien sua danh sach phong tro 
    public function edit($id){
        $motels = Motels::find($id);
        return view('admin.managermotels.edit',compact('motels'));
    }

    // xu ly sua danh sach phong tro tu form
    public function update(Request $request, $id){
        $motels = Motels::find($id);
        $motels->update($request->all());
        return redirect()->route('admin/home')->with('Thongbao', 'Sua danh sach phong tro thanh cong');

    }

    // xu ly xoa danh sach phong tro theo id
    public function destroy($id){
        $motels = Motels::find($id);
        $motels->delete();
        return redirect()->route('admin/home')->with('Thongbao', 'Xoa danh sach phong tro thanh cong');
    }

}
