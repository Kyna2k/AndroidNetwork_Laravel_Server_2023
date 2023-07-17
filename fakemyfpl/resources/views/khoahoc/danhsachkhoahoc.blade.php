@extends('layouts.layout')
@section('title')
    Danh sách khóa học
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('msg'))
                <div class="alert alert-success text-center">
                   {{ session('msg') }}
                </div>
    @endif
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh sách /</span> Khóa học</h4>
    <div class="card">
        <h5 class="card-header">Các khóa học</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Tên</th>
                        <th>Loại</th>
                        <th>Hình ảnh</th>
                        <th>Ngày tạo</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($list as  $item)
                        
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $item->id }}</strong></td>
                        <td>{{ $item->NAME }}</td>
                        <td>
                            @if($item -> TYPE === "YOUTUBE")
            
                            <span class="badge bg-label-primary me-1">{{ $item->TYPE }}</span>
                            @else
                            <span class="badge bg-label-warning me-1">{{ $item->TYPE }}</span>
                            @endif
                        </td>
                        <td>
                            <img src="{{ $item->IMAGE }}" height="50px" style="object-fit: contain;" alt="">
                            </td>
                        <td>
                            {{ $item->CreateAt}}
                            </td>
                        <td> 
                            {{ $item->description}}
                        </td>
                        <td>
                            {{ $item->price}}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('khoahoc.editKhoaHoc',['id'=>$item->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <button onclick="confirmDelete('{{ route('khoahoc.delete',['id'=>$item->id]) }}')" class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach

             
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    const confirmDelete = (url) => swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            location.href = url;
        } else {
          swal("Your imaginary file is safe!");
        }
      });
  </script>
@endsection
