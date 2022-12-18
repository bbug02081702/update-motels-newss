<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Motels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MotelsController extends Controller
{
    // hien thi trang chu mac dinh cho user
    public function index(){
       $motels = DB::table('motels')->orderBy('created_at', 'DESC')->paginate(2);//sap xep danh sach bai viet theo thu tu bai dang moi nhat
       $motels_countview = DB::table('motels')->orderBy('count_view', 'DESC')->paginate(2); // sap sep danh sach bai viet thoe thu tu bai dang co luet xem cao nhat
       
    // xu ly tim kiem theo tieu de cho trang chu user
    if($title = request()->title){
      $motels = DB::table('motels')->orderBy('created_at', 'DESC')->where('title', 'LIKE', '%'.$title.'%')->paginate(2);
    }

    //xu ly tim kiem theo gia cho trang chu
    if($price = request()->price){
        $motels = DB::table('motels')->orderBy('created_at', 'DESC')->where('price', 'LIKE', '%'.$price.'%')->paginate(2);
    }

     // xu ly tim kiem theo vi tri cho trang chu user
     if($address = request()->address){
        $motels = DB::table('motels')->orderBy('created_at', 'DESC')->where('address', 'LIKE', '%'.$address.'%')->paginate(2);
     }

       return view('user.home.content.container', compact('motels', 'motels_countview'));
    }


    // xu ly luot xem chi tiet bai viet
    public function showview($id){
        $post = Motels::find($id);
        $update = ['count_view' =>$post->count_view + 1,];
        Motels::where('id',$post->id)->update($update);

        $motels = DB::table('motels')->where('id',$id)->get();
        
        return view('motel.content',compact('motels'));
    }

//------------------------------ADMIN--------------------------------------//
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
            'images' => 'required',
            'price' => 'required',
            
        ]);
        $motels = Motels::create($request->all());
        if($request->hasFile('images')){
            $request->file('images')->move('fotopegawai/', $request->file('images')->getClientOriginalName());
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

    // xu ly thay doi trang thai phong tro theo id
    public function changeStatusMotels($id){
        $getStatusMotels = Motels::select('approve')->where('id', $id)->first();
        if($getStatusMotels->approve == 1){
             $approve = 0;
        }else{
            $approve = 1;
        }
        Motels::where('id', $id)->update(['approve'=>$approve]);
        return redirect()->back();

    }

    // hien thi giao dien chi tiet thong tin useradmin
    public function profileAdmin(){
        return view('admin.home.adminprofile');    
    }

    // xu ly update thong tin admin
    function updateProfileAdmin(Request $request){
           
        $validator = \Validator::make($request->all(),[
            'username'=>'required',
            'email'=> 'required|email|unique:users,email,'.Auth::user()->id,
            
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
             
        }
    }

    function updateAdminPicture(Request $request){
        $path = 'users/images/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_'.date('Ymd').uniqid().'.jpg';

        //tai anh moi len
        $upload = $file->move(public_path($path), $new_name);
        
        if( !$upload ){
            return response()->json(['status'=>0,'msg'=>'Đã xảy ra lỗi, tải ảnh mới lên không thành công.']);
        }else{
            //Lay anh cu
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['avatar'];

            if( $oldPicture != '' ){
                if( \File::exists(public_path($path.$oldPicture))){
                    \File::delete(public_path($path.$oldPicture));
                }
            }

            //Update DB
            $update = User::find(Auth::user()->id)->update(['picture'=>$new_name]);

            if( !$upload ){
                return response()->json(['status'=>0,'msg'=>'Đã xảy ra lỗi, cập nhật ảnh trong db không thành công.']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Ảnh hồ sơ của bạn đã được cập nhật thành công']);
            }
        }
    }


    function changeAdminPassword(Request $request){
        //Validate form
        $validator = \Validator::make($request->all(),[
            'oldpassword'=>[
                'required', function($attribute, $value, $fail){
                    if( !\Hash::check($value, Auth::user()->password) ){
                        return $fail(__('Mật khẩu hiện tại không chính xác'));
                    }
                },
                'min:4',
                'max:30'
             ],
             'newpassword'=>'required|min:8|max:30',
             'cnewpassword'=>'required|same:newpassword'
         ],[
             'oldpassword.required'=>'Nhập mật khẩu hiện tại của bạn',
             'oldpassword.min'=>'Mật khẩu cũ phải có ít nhất 4 ký tự',
             'oldpassword.max'=>'Mật khẩu cũ không được lớn hơn 30 ký tự',
             'newpassword.required'=>'Nhập mật khẩu mới',
             'newpassword.min'=>'Mật khẩu mới phải có ít nhất 4 ký tự',
             'newpassword.max'=>'Mật khẩu mới không được lớn hơn 30 ký tự',
             'cnewpassword.required'=>'Nhập lại mật khẩu mới của bạn',
             'cnewpassword.same'=>'Mật khẩu mới và các nhận mật khẩu mới phải khớp'
         ]);

        if( !$validator->passes() ){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
             
         $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

         if( !$update ){
             return response()->json(['status'=>0,'msg'=>'Đã xảy ra lỗi, Không thể cập nhật mật khẩu trong db']);
         }else{
             return response()->json(['status'=>1,'msg'=>'Mật khẩu của bạn đã được thay đổi thành công']);
         }
        }
    }
    

    // hien thi giao dien quan ly danh muc phong tro
    public function indexCategory(){
        $category = Motels::orderBy('created_at', 'DESC')->paginate(2);
          // xu ly tim kiem theo ten danh muc
        if($key = request()->category){
             $category =  Motels::orderBy('created_at', 'DESC')->where('category_id', 'LIKE', '%'.$key.'%')->paginate(2);
        }
        return view('admin.managermotels.category.index',compact('category'));
    }

    // hien thi giao dien them danh muc phong tro
    public function createCategory(){
        return view('admin.managermotels.category.add');
    }

    // xu ly them danh muc phong tro
    public function storeCategory(Request $request){
        $category = Motels::create($request->all());
        return redirect()->route('admin/home/category')->with('Thongbao', 'Them danh muc thanh cong');
    }

    //hien giao dien sua danh muc phong tro
    public function editCategory($id){
       $category = Motels::find($id);
       return view('admin/managermotels/category/edit',compact('category'));
    }

    // xu ly sua danh muc phong tro
    public function updateCategory(Request $request, $id){
        $category = Motels::find($id);
        $category->update($request->all());
        return redirect()->route('admin/home/category')->with('Thongbao', 'Sua thanh cong danh muc');
    }

    //xu ly xoa danh muc phong tro
    public function destroyCategory($id){
        $category = Motels::find($id);
        $category->delete();
        return redirect()->route('admin/home/category')->with('Thongbao', 'Xoa thanh cong danh muc');
    }
  
//---------------------------DASBOARD AMDIN----------------------------//  
    public function dasboard(){
        $countUsers = User::all()->count(); //thong ke tong so nguoi dung
        $countPost = Motels::all()->count(); // thong ke tong so bai dang 
        $countMotelsOk = Motels::where('approve','1')->count(); // thong ke tong so phong tro da thue
        $countMotelsNotOk = Motels::where('approve', '0')->count(); //thong ke tong so phong tro chua thue
        // dd($countPost);
        
        return view('admin.home.dasboard',compact('countUsers', 'countPost', 'countMotelsOk', 'countMotelsNotOk'));
    }
    
}
