@extends('layouts.layout')
@section('title')
    Cập nhật sinh viên
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Cập nhật </span>Sinh viên</h4>

    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin sinh viên</h5>
            <small class="text-muted float-end">Default label</small>
          </div>
          <div class="card-body">
            <form action="{{ route('sinhvien.editSinhVien',['id'=>$sinhvien->id]) }}" method="post" enctype="multipart/form-data">
                {{-- @csrf Dùng để tạo ra token cho from liên quan đến vấn để bảo mật --}}
                @csrf
                {{-- Error form --}}
                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        Gửi yêu cầu không thành công </br>
                        Vui lòng kiểm tra lại
                    </div>
                @endif
                
                {{-- old dùng để lưu lại dữ liệu đã nhập, do errors sự dùng cách flash để reload khi sai --}}
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Mã sinh viên</label>
                <input type="text" value="{{ old('masinhvien') ?? $sinhvien->masinhvien }}" name="masinhvien" class="form-control" id="basic-default-fullname" placeholder="PS23156" />
                @error('masinhvien')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Lớp</label>
                <select class="form-select" name="id_lop" id="exampleFormControlSelect1" aria-label="Default select example">
                  @foreach ($listLop as $item)
                  @if ($item->id === $sinhvien->id_lop)
                  <option value="{{ $item->id }}" selected>{{ $item->malop }}</option>
                  @else
                  <option value="{{ $item->id }}">{{ $item->malop }}</option>
                  @endif
                  
                  @endforeach
                </select>
                @error('id_lop')
                <span style="color: red;">{{ $message }}</span>
                @enderror  
              </div>
              <div class="mb-3 mt-3">
                <label class="form-label" for="basic-default-company">Họ tên</label>
                <input type="text" value="{{ old('hoten') ?? $sinhvien->hoten}}" name="hoten" class="form-control" id="basic-default-company" placeholder="Phan Thanh Tèo" />
                @error('hoten')
                <span style="color: red;">{{ $message }}</span>
                @enderror  
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label" for="basic-default-company">Email</label>
                <input type="text" value="{{ old('email') ?? $sinhvien->email }}" name="email" class="form-control" id="basic-default-company" placeholder="huyps@fpt.edu.vn" />
                @error('email')
                <span style="color: red;">{{ $message }}</span>
                @enderror  
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label" for="basic-default-company">Khóa</label>
                <input type="text" value="{{ old('khoa')  ?? $sinhvien->khoa }}" name="khoa" class="form-control" id="basic-default-company" placeholder="MD17304" />
                @error('khoa')
                <span style="color: red;">{{ $message }}</span>
                @enderror  
            </div>

              <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input onchange="onFileSelected(event)" class="form-control" name="image" type="file" id="image" />
                @error('image')
                <span style="color: red;">{{ $message }}</span>
                @enderror  
            </div>
              <img src="{{ $sinhvien->IMAGE }}" style="object-fit: contain;" width="100%" id="ReviewImage" />
              <button type="submit" class="btn btn-primary mt-3">Thêm</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var imgtag = document.getElementById("ReviewImage");
    imgtag.onload = () =>{
      if(imgtag.src != ""){
        imgtag.height = "200";
      }
    }
    function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();
  
    var imgtag = document.getElementById("ReviewImage");
    imgtag.title = selectedFile.name;
  
    reader.onload = function(event) {
      imgtag.src = event.target.result;
    };
    imgtag.height = "200";
  
    reader.readAsDataURL(selectedFile);
  }
  </script>
@endsection