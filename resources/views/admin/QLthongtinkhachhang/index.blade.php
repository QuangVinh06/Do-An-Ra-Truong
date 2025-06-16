@extends('Master.main')
@section('main')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">Quản lý thông tin khách hàng</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-success text-white">Danh Sách khách hàng</div>
        <div class="card-body">
            <form action="{{ route('QLthongtinkhachhang.index') }}" method="GET" class="d-flex mb-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm theo tên hoặc loại khách hàng" value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </form>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th  width="5%" class="text-center">STT</th>
                        <th  width="15%">Tên khách hàng</th>
                        <th width="15%">Gmail</th>
                        <th width="30%">Địa chỉ</th>
                        <th width="12%">Số điện thoại</th>
                        <th width="10%">Loại khách hàng</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($khachHang as $index => $kh)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kh->user->name }}</td>
                            <td>{{ $kh->user->email }}</td>
                            <td>{{ $kh->DiaChi }}</td>
                            <td>{{ $kh->SoDienThoai }}</td>
                            <td>{{ $kh->loaikhachhang->TenLoaiKhachHang }}</td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
