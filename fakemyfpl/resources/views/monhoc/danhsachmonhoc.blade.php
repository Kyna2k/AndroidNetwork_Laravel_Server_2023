@extends('layouts.layout')
@section('title')
    Danh sách môn học
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('msg'))
                <div class="alert alert-success text-center">
                   {{ session('msg') }}
                </div>
    @endif
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh sách /</span> Môn học</h4>
    <div class="card">
        <h5 class="card-header">Các môn học</h5>
        <div class="table-responsive text-nowrap" >
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã môn học</th>
                        <th>Tên môn học</th>
                        <th>Biểu tượng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($list as  $item)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $item->id }}</strong></td>
                        <td>{{ $item->mamon }}</td>
                        <td>{{ $item->tenmon }}</td>>
                        <td>
                            <img src="{{ $item->hinhanh }}"  height="50px" style="object-fit: contain;" alt="">
                            </td>
                        <td>
                        <td>
                            <div class="dropdown" >
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('monhoc.edit',['id'=>$item->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <button onclick="confirmDelete('{{ route('monhoc.destroy',['id'=>$item->id]) }}')" class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach

             
                   
                </tbody>
            </table>
           
        </div>
       
    </div>
    <div style="display: flex; justify-content: flex-end; margin: 20px ">
        {{ $list->links() }}
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
