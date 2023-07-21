@extends('layouts.layout')
@section('title')
    Danh sách bài viết
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('msg'))
                <div class="alert alert-success text-center">
                   {{ session('msg') }}
                </div>
    @endif
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh sách /</span>bài viết</h4>
    <div class="card">
        <h5 class="card-header">Các bài viết</h5>
        <div class="table-responsive text-nowrap" >
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Tên người đăng</th>
                        <th>Create</th>
                        <th>Tên thể loại</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($list as  $item)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $item->id }}</strong></td>
                        <td>{{ $item->tieude }}</td>
                        <td>{{ $item->noidung }}</td>
                        <td>{{ $item->tennguoidang }}</td>
                        <td>{{ $item->theloai }}</td>
                        <td>{{ $item->createat }}</td>
                        
                        <td>
                            <div class="dropdown" >
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('baiviet.edit',['id'=>$item->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <button onclick="confirmDelete('{{ route('baiviet.destroy',['id'=>$item->id]) }}')" class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</button>
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
