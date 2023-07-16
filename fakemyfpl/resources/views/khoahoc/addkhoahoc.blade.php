@extends('layouts.layout')
@section('title')
    Thêm khóa học
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thêm </span>khóa học</h4>

    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin khóa học</h5>
            <small class="text-muted float-end">Default label</small>
          </div>
          <div class="card-body">
            <form action="{{ route('addKhoaHoc') }}" method="post" enctype="multipart/form-data">
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
                <label class="form-label" for="basic-default-fullname">Tên Khóa Học</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="basic-default-fullname" placeholder="Android Network" />
                @error('name')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
              </div>
              <!--radius-->
              <label class="form-label">Loại</label>
              <div style="display: flex; flex-direction: row;">
                <div class="form-check mt-2">
                  <input name="TYPE" class="form-check-input" type="radio" value="NORMAL" id="defaultRadio1" checked />
                  <label class="form-check-label" for="defaultRadio1"> NORMAL </label>
                </div>
                <div class="form-check  mt-2 ms-5">
                  <input name="TYPE" class="form-check-input" type="radio" value="YOUTUBE" id="defaultRadio2" />
                  <label class="form-check-label" for="defaultRadio2"> YOUTUBE </label>
                </div>
              </div>

              <!--/radius-->
              <div class="mb-3 mt-3">
                <label class="form-label" for="basic-default-company">Giá</label>
                <input type="text" value="{{ old('price') }}" name="price" class="form-control" id="basic-default-company" placeholder="2000" />
                @error('price')
                <span style="color: red;">{{ $message }}</span>
                @enderror  
            </div>


              <div class="mb-3">
                <label class="form-label" for="basic-default-message">Mô tả</label>
                <textarea id="basic-default-message" name="description" class="form-control" placeholder="Bạn nghĩ khóa học này có bịp không?">{{ old('price') }}</textarea>
              </div>
              <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input onchange="onFileSelected(event)" class="form-control" name="image" type="file" id="image" />
                @error('image')
                <span style="color: red;">{{ $message }}</span>
                @enderror  
            </div>
              <img style="object-fit: contain;" width="100%" id="ReviewImage" />
              <button type="submit" class="btn btn-primary mt-3">Thêm</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
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