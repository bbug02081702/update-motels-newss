@extends('admin.home.index')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @section('category')
    <h1 class="text-center"> Quan ly danh muc phong tro</h1>
    <div class="container">
    <form action="" class="form-inline" method="get">
    <div class="form-group">
        <input name="category" class="form-control" id="" placeholder="Tim kiem theo ten danh muc">
    </div>
    <button type="submit" class="btn btn-primary">
     <i class="fas fa-search">
     </i>
    </button>
    </form>
      <a href="{{route('admin/home/category/add')}}" type="button" class="btn btn-success">Them</a>
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
                  <th scope="col">Danh muc</th>
                  <th scope="col">Ngay tao</th>
                  <th scope="col">Hanh dong</th>
                </tr>
              </thead>
              <tbody>
                @php
                 $no = 1;
                @endphp
              @if(count($category) > 0)
              @foreach($category as $index => $rowcategory)
                <tr>
                  <th scope="row">{{$index + $category->firstItem()}}</th>
                  <td><a href="{{url('/motels/list/'.$rowcategory->id)}}">{{$rowcategory->title}}</a></td>
                  <td>{{$rowcategory->category_id}}</td>
                  <td>{{$rowcategory->created_at}}</td>
                  <td>
                  <a href="{{route('admin/home/category/edit',$rowcategory->id)}}" type="button" class="btn btn-info">Sua</a>
                  <a href="{{route('admin/home/category/delete',$rowcategory->id)}}" type="button" class="btn btn-danger">Xoa</a>
                  </td>
                </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="4" class="text-center">Ko tim thay du lieu!!! Vui long thuc hien them du lieu!!!</td>
                </tr>
              @endif
              </tbody>
            </table>
            {{$category->appends(request()->all())->links()}}
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
