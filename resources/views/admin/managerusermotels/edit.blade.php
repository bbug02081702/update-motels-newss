@extends('admin.home.index')
@section('content')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <h1 class="text-center">Cap nhat danh sach phong tro</h1>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="row">
              <form action="{{route('admin/home/updatemanageruser', $users->id)}}" method="POST" enctype="mutilpart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" value="{{$users->username}}" class="form-control" id="" placeholder="Nhap username">
                </div>
                <div class="mb-3">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input type="file" name="avatar" value="{{$users->avatar}}" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" value="{{$users->email}}" class="form-control" id="" placeholder="Nhap email">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Quyen</label>
                    <select name="role" class="form-select" id="">
                            <option value="">Chon quyen:</option>
                            <option value="0" {{$users->role == "0" ? 'selected' : ''}}>User</option>
                            <option value="1" {{$users->role == "1"? 'selected' : ''}}>Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="created_at" class="form-label">Ngay tao</label>
                    <input type="date" name="created_at"  value="{{$users->created_at}}" class="form-control" id="">
                </div>
                
                <button type="submit" class="btn btn-primary">Dong y</button>
               
                <a href="{{route('admin/home/manageruser')}}" type="button" class="btn btn-success">Tro ve</a>
              </form>
          </div>
        </div>
      </div>
    </div>
      <!-- Optional JavaScript; choose one of the two! -->
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
@endsection