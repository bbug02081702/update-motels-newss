@extends('admin.home.index')
@section('content') 
<div class="page-wrapper">
  <div class="card mb-0">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="profile-view">
            <div class="profile-img-wrap">
              <div class="profile-img">
                <a href="#">
                  <img alt="" src="{{Auth::user()->avatar}}" alt="{{ Auth::user()->name }}">
                </a>
              </div>
            </div>
            <div class="profile-basic">
              <div class="row">
                <div class="col-md-5">
                  <div class="profile-info-left">
                    <h3 class="user-name m-t-0 mb-0">{{ Auth::user()->username}}</h3>
                    <div class="staff-id">User ID : {{Auth::user()->id}}</div>
                    <div class="small doj text-muted">Ngay tao: {{ Auth::user()->created_at}}</div>
                  </div>
                </div>
                <div class="col-md-7">
                  <ul class="personal-info">
                    <li>
                      <div class="title">So dien thoai: </div>
                      <div class="text">
                        <a href="">{{Auth::user()->phone}}</a>
                      </div>
                    </li>
                    <li>
                      <div class="title">Email:</div>
                      <div class="text">
                        <a href="">{{ Auth::user()->email}}</a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="pro-edit">
              <a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#">
                <i class="fa fa-pencil"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
@endsection