@extends('layouts.layout')
@section('title')
    Thêm lịch học
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thêm </span>lịch học</h4>

    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin lịch học</h5>
            <small class="text-muted float-end">Default label</small>
          </div>
          <div class="card-body">
            <form action="{{ route('lichhoc.tool') }}" method="post" enctype="multipart/form-data">
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
                    <label for="exampleFormControlSelect1" class="form-label">Lớp</label>
                    <select class="form-select" name="id_lop" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Chọn lớp</option>
                  @foreach ($listlop as $item)
                  <option value="{{ $item->id }}">{{ $item->malop }}</option>
                  @endforeach
                    </select>
                    @error('id_loaibaiviet')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror  
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Giáo viên</label>
                    <select class="form-select" name="id_giaovien" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Chọn giáo viên</option>
                  @foreach ($listgiaovien as $item)
                  <option value="{{ $item->id }}">{{ $item->tengiaovien }}</option>
                  @endforeach
                    </select>
                    @error('id_giaovien')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror  
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Môn học</label>
                    <select class="form-select" name="id_monhoc" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Chọn môn học</option>
                  @foreach ($listmonhoc as $item)
                  <option value="{{ $item->id }}">{{ $item->tenmon }}</option>
                  @endforeach
                    </select>
                    @error('id_giaovien')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror  
                </div>

              <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input onchange="onFileSelected(event)" class="form-control" name="data" type="file" id="image" />
                @error('data')
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
@endsection