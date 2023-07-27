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
            <form action="{{ route('lichhoc.update',['id'=>$lichhoc->id]) }}" method="post" enctype="multipart/form-data">
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
                    <label class="form-label" for="basic-default-fullname">Phòng học</label>
                    <input type="text" value="{{ old('phonghoc') ?? $lichhoc->phonghoc }}" name="phonghoc" class="form-control" id="basic-default-fullname" placeholder="PS23156" />
                    @error('phonghoc')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="html5-datetime-local-input" class="col-md-2 col-form-label">Thời gian</label>
                    <div class="mb-3">
                      <input
                        class="form-control"
                        type="datetime-local"
                        name="thoigian"
                        value="{{ old('thoigian') ?? $lichhoc->thoigian }}"
                        id="html5-datetime-local-input"
                      />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Loại</label>
                    <div style="display: flex; flex-direction: row;">
                      <div class="form-check mt-2">
                        <input name="loai" class="form-check-input" type="radio" value="NORMAL" id="defaultRadio1" {{$lichhoc->loai === "NORMAL" ? 'checked' : ''  }} />
                        <label class="form-check-label" for="defaultRadio1">NORMAL</label>
                      </div>
                      <div class="form-check  mt-2 ms-5">
                        <input name="loai" class="form-check-input" type="radio" value="Protect the project" id="defaultRadio2" {{$lichhoc->loai !== "NORMAL" ? 'checked' : ''  }} />
                        <label class="form-check-label" for="defaultRadio2">Protect the project</label>
                      </div>
                    </div>
                </div>
            

                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Lớp</label>
                    <select class="form-select" name="id_lop" id="exampleFormControlSelect1" aria-label="Default select example">
                  @foreach ($listlop as $item)
                  @if ($item->id === $lichhoc->id_lop)
                  <option value="{{ $item->id }}" selected>{{ $item->malop }}</option>
                      
                  @else
                  <option value="{{ $item->id }}">{{ $item->tengiaovien }}</option>
                      
                  @endif
                  @endforeach
                    </select>
                    @error('id_loaibaiviet')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror  
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Giáo viên</label>
                    <select class="form-select" name="id_giaovien" id="exampleFormControlSelect1" aria-label="Default select example">
                  @foreach ($listgiaovien as $item)
                  @if ($item->id === $lichhoc->id_giaovien)
                  <option value="{{ $item->id }}" selected>{{ $item->tengiaovien }}</option>
                      
                  @else
                  <option value="{{ $item->id }}">{{ $item->tengiaovien }}</option>
                      
                  @endif
                  @endforeach
                    </select>
                    @error('id_giaovien')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror  
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Môn học</label>
                    <select class="form-select" name="id_monhoc" id="exampleFormControlSelect1" aria-label="Default select example">
                  @foreach ($listmonhoc as $item)
                        @if ($item->id === $lichhoc->id_monhoc)
                        <option value="{{ $item->id }}" selected>{{ $item->tenmon }}</option>
                            
                        @else
                        <option value="{{ $item->id }}">{{ $item->tenmon }}</option>
                            
                        @endif
                  @endforeach
                    </select>
                    @error('id_giaovien')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror  
                </div>
              <button type="submit" class="btn btn-primary mt-3">Sửa</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection