@extends('admin.home.index')
@section('adminprofile')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle admin_picture" src="{{Auth::user()->avatar}}">
              </div>
              <h3 class="profile-username text-center admin_name">{{Auth::user()->username}}</h3>
              <p class="text-muted text-center">Admin</p>
              <input type="file" name="admin_image" id="admin_image" style="opacity: 0;height:1px;display:none">
              <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_picture_btn">
                <b>Thay doi anh</b>
              </a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#personal_info" data-toggle="tab">Thong tin ca nhan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#change_password" data-toggle="tab">Thay doi mat khau</a>
                </li>
              </ul>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="personal_info">
                  <form class="form-horizontal" method="POST" action="{{route('admin/home/updateprofileadmin')}}" id="AdminInfoForm">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Username" value="{{ Auth::user()->username }}" name="username">
                        <span class="text-danger error-text username_error"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}" name="email">
                        <span class="text-danger error-text email_error"></span>
                      </div>
                    </div>
                    <!-- <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">So dien thoai</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName2" placeholder="So dien thoai" value="{{ Auth::user()->phone }}" name="phone">
                        <span class="text-danger error-text phone_error"></span>
                      </div>
                    </div> -->
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Luu thay doi</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="change_password">
                  <form class="form-horizontal" action="{{route('admin/home/changeadminpassword')}}" method="POST" id="changePasswordAdminForm">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Mat khau cu</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputName" placeholder="Nhap mat khau cu" name="oldpassword">
                        <span class="text-danger error-text oldpassword_error"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Mat khau moi</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="newpassword" placeholder="Xac nhan mat khau moi" name="newpassword">
                        <span class="text-danger error-text newpassword_error"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Xac nhan mat khau moi</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="cnewpassword" placeholder="Xac nhan mat khau moi" name="cnewpassword">
                        <span class="text-danger error-text cnewpassword_error"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Cap nhat mat khau</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection