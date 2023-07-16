@extends('layouts.layout')
@section('title')
    Danh sách khóa học
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
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

        
                             <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong></strong></td>
                        <td></td>
                        <td>
                            <span class="badge bg-label-primary me-1">Youtube</span>
                            
                        
                        </td>
                        <td>
                            <img src="" height="50px" style="object-fit: contain;" alt="">
                            </td>
                        <td>
                            19/2/3000
                            </td>
                        <td> 
                            hihi
                        </td>
                        <td>
                            2000
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <button onclick="confirmDelete(55)" class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>

             
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection