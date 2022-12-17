@extends('admin.home.index')

@section('content')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <body>
    <h1 class="text-center"> Them danh sach phong tro</h1>
    <div class="container">
      <div class="card">
        <div class="card-body">
            @if ($message = Session::get('Thongbao'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
            @endif 
          <div class="row">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
          </div>
          @endif
              <form action="{{route('admin/home/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="Title" class="form-label">Tieu de</label>
                    <input type="text" name="title" class="form-control" placeholder="Nhap tieu de">
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Hinh anh</label>
                    <input type="file" name="images" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">So dien thoai</label>
                    <input type="number" name="phone" class="form-control" id="" placeholder="Nhap so dien thoai">
                </div>
                <div class="mb-3">
                    <label for="area" class="form-label">Dien tich</label>
                    <input type="number" name="area" class="form-control" id="" placeholder="Nhap dien tich">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Gia phong</label>
                    <input type="text" name="price" class="form-control" id="" class="@error('title') is-invalid @enderror" placeholder="Nhap gia phong">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Dia chi</label>
                    <input type="text" name="address" class="form-control" id="" placeholder="Nhap dia chi">
                </div>
                <div class="mb-3">
                    <label for="approve" class="form-label">Trang thai</label>
                    <select name="approve" class="form-select" id="">
                                    <option selected>Chon trang thai:</option>
                                    <option value="0">Chua thue</option>
                                    <option value="1">Da thue</option>
                    </select>
                </div>
               
                <button type="submit" class="btn btn-primary">Dong y</button>
               
                <a href="{{route('admin/home')}}" type="button" class="btn btn-success">Tro ve</a>
              </form>
          </div>
        </div>
      </div>
    </div>
    <body>
      <!-- Optional JavaScript; choose one of the two! -->
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    </body>
@endsection
