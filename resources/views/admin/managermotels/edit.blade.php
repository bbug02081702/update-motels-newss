@extends('admin.home.index')
@section('content')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <h1 class="text-center">Cap nhat danh sach phong tro</h1>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="row">
            @if ($message = Session::get('Thongbao'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
            @endif 
            @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
          </div>
          @endif
              <form action="{{route('admin/home/update', $motels->id)}}" method="post" enctye="mutilpart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="Title" class="form-label">Tieu de</label>
                    <input type="text" name="title" value="{{$motels->title}}" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Hinh anh</label>
                    <input type="file" name="images" value="{{$motels->images}}" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="area" class="form-label">Dien tich</label>
                    <input type="number" name="area" value="{{$motels->area}}" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Gia phong</label>
                    <input type="text" name="price" value="{{$motels->price}}" class="form-control" id="">
                </div> <div class="mb-3">
                    <label for="category_id" class="form-label">Danh muc</label>
                    <input type="number" name="category_id" value="{{$motels->category_id}}" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Dia chi</label>
                    <input type="text" name="address" value="{{$motels->address}}" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="approve" class="form-label">Trang thai</label>
                    <input type="text" name="approve" value="{{$motels->approve}}" class="form-control" id="">
                </div>
                
                <button type="submit" class="btn btn-primary">Dong y</button>
               
                <a href="{{route('admin/home')}}" type="button" class="btn btn-success">Tro ve</a>
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