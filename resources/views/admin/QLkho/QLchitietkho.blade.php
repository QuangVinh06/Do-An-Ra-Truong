@extends('Master.main')

@section('main')
<div class="container mt-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-4 text-primary">Sản phẩm trong kho</h2>

    <!-- Thông báo -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Thêm/Sửa  -->
    <div class="card">
        <form action="{{ route('QLchitietkho.index') }}" method="GET" class="d-flex mb-3">
            <select id="search" name="search" class="form-select" required>
                <option value=0 selected>Tất cả</option>
                @foreach ($ks as $k)
                    <option value="{{ $k->id }}" >{{ $k->TenKho }}</option>
                @endforeach 
            </select>
            <input type="text" class="form-form-select" name="searchSP" placeholder="Tìm kiếm sản phẩm...">
            
            <button type="submit" class="btn btn-success">Tìm kiếm</button>
        </form>
    </div>
    <!-- Danh sách  -->
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Sản Phẩm
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Màu</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sanpham as $index => $sp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sp->sanpham->TenGoi }}</td>
                            <td>{{ $sp->sanpham->loaisanpham->TenLoaiSanPham }}</td>
                            <td>{{ $sp->sanpham->mau->TenMau }}</td>
                            <td class="text-end"> {{ $sp->TongSoLuong }}</td>
                            
                            <td>{{ $sp->sanpham->donvitinh->TenDonViTinh }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
