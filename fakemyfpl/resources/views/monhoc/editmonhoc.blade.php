@extends('layouts.layout')
@section('title')
    Thêm môn học
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thêm </span>Môn học</h4>

    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin môn học</h5>
            <small class="text-muted float-end">Default label</small>
          </div>
          <div class="card-body">
            <form action="{{ route('monhoc.update',['id'=>$monhoc->id]) }}" method="post" enctype="multipart/form-data">
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
                <label class="form-label" for="basic-default-fullname">Mã môn học</label>
                <input type="text" value="{{ old('mamon') ?? $monhoc->mamon }}" name="mamon" class="form-control" id="basic-default-fullname" placeholder="CP17307" />
                @error('mamon')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Mã môn học</label>
                <input type="text" value="{{ old('tenmon')?? $monhoc->tenmon }}" name="tenmon" class="form-control" id="basic-default-fullname" placeholder="CP17307" />
                @error('tenmon')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input onchange="onFileSelected(event)" class="form-control" name="hinhanh" type="file" id="image" />
                @error('hinhanh')
                <span style="color: red;">{{ $message }}</span>
                @enderror  
            </div>
            <img src="{{ $monhoc->hinhanh }}" style="object-fit: contain;" width="100%" id="ReviewImage" />
              <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
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