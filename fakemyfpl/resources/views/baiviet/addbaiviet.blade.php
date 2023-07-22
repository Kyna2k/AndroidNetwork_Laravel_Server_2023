@extends('layouts.layout')
@section('title')
    Thêm bài viết
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thêm </span> bài viết</h4>

    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin bài viết</h5>
            <small class="text-muted float-end">Default label</small>
          </div>
          <div class="card-body">
            <form action="{{ route('baiviet.store') }}" method="post">
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
                <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                <input type="text" value="{{ old('tieude') }}" name="tieude" class="form-control" id="basic-default-fullname" placeholder="CP17307" />
                @error('tieude')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nội dung</label>
                <textarea type="text"  name="noidung" class="form-control" id="basic-default-fullname" placeholder="CP17307" >{{ old('noidung') }}</textarea>
                @error('noidung')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Loại bài việt</label>
                <select class="form-select" name="id_loaibaiviet" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Chọn loại</option>
                  @foreach ($loaibaiviet as $item)
                  <option value="{{ $item->id }}">{{ $item->theloai }}</option>
                  @endforeach
                </select>
                @error('id_lop')
                <span style="color: red;">{{ $message }}</span>
                @enderror  
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Tên người đăng</label>
                <input type="text" value="{{ old('tennguoidang') }}" name="tennguoidang" class="form-control" id="basic-default-fullname" placeholder="CP17307" />
                @error('tennguoidang')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary mt-3">Thêm</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection