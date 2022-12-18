@extends('admin.home.index')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @section('content')
    <h1 class="text-center"> Quan ly danh sach phong tro</h1>
    <div class="container">
    <form action="" class="form-inline" method="get">
    <div class="form-group">
        <input name="key" class="form-control" id="" placeholder="Tim kiem theo tieu de">
    </div>
    <button type="submit" class="btn btn-primary">
     <i class="fas fa-search">
     </i>
    </button>
    </form>
      <a href="{{route('admin/home/add')}}" type="button" class="btn btn-success">Them</a>
      <div class="card">
        <div class="card-body">
          <div class="row">
            @if ($message = Session::get('Thongbao'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
            @endif 
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Tieu de</th>
                  <th scope="col">Hinh anh</th>
                  <th scope="col">So dien thoai</th>
                  <th scope="col">Dien tich</th>
                  <th scope="col">Gia phong</th>
                  <th scope="col">Dia chi</th>
                  <th scope="col">Trang thai</th>
                  <th scope="col">Hanh dong</th>
                </tr>
              </thead>
              <tbody>
                @php
                 $no = 1;
                @endphp
              @if(count($motels) > 0)
              @foreach($motels as $index => $row)
                <tr>
                  <th scope="row">{{$index + $motels->firstItem()}}</th>
                  <td><a href="{{url('/motels/list/'.$row->id)}}">{{$row->title}}</a></td>
                  <td>
                    <img src="{{asset('fotopegawai/'.$row->images)}}" style="width:48px;" alt="">
                  </td>
                  <td>{{$row->phone}}</td>
                  <td>{{$row->area}} m&#178</td>
                  <td>{{$row->price}} VND</td>
                  <td>{{$row->address}}</td>
                  <td>
                    @if($row->approve==1)
                    <a href="{{ route('admin/home/changestatusmotels', $row->id) }}" class="badge bg-success">Da thue</a>
                    @else
                    <a href="{{ route('admin/home/changestatusmotels', $row->id) }}" class="badge bg-danger">Chua thue</a>
                    @endif
                  </td>
                  <td>
                  <a href="{{route('admin/home/edit', $row->id)}}" type="button" class="btn btn-info">Sua</a>
                  <a href="{{route('admin/home/delete', $row->id)}}" type="button" class="btn btn-danger">Xoa</a>
                  </td>
                </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="9" class="text-center">Ko tim thay du lieu!!! Vui long thuc hien them du lieu!!!</td>
                </tr>
              @endif
              </tbody>
            </table>
            {{$motels->appends(request()->all())->links()}}
          </div>
        </div>
      </div>
    </div>
    @endsection
      <!-- Optional JavaScript; choose one of the two! -->
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
