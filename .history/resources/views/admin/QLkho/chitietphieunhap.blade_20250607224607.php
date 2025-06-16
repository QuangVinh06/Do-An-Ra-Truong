@extends('Master.main')

@section('main')
<div class="container mt-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-4 text-primary">Chi tiết phiếu nhập kho</h2>
    <h3 class="text-center mb-4 text-primary">{{ $phieunhap->NgayLap }}</h3>
    <h4 class="text-center mb-4 text-primary">Người lập: {{ $phieunhap->NguoiLap }}</h4>

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

    <!-- Form thông tin  -->
    <div class="row">
        <div class="col-6">
            <label class="form-label fw-semibold">Mã phiếu nhập: {{ $phieunhap->id }}</label>
            <br>
            <label class="form-label fw-semibold">Kho: {{ $phieunhap->kho->TenKho }}</label>
        </div>
        <div class="col-6">
            <br>
            <label class="form-label fw-semibold">Người gửi: {{ $phieunhap->NguoiGiaoHang }}</label>
        </div>
    </div>
    
    
    <!-- Danh sách  -->
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Sản Phẩm
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-success">
                    <tr>
                        <th>STT</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Loại Sản Phẩm</th>
                        <th>Màu</th>
                        <th>Số Lượng</th>
                        <th>Đơn Vị Tính</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ct as $index => $c)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $c->SanPham->TenGoi }}</td>
                            <td>{{ $c->SanPham->loaisanpham->TenLoaiSanPham }}</td>
                            <td>{{ $c->SanPham->mau->TenMau }}</td>
                            <td class="text-end">{{ $c->SoLuong }}</td>
                            <td>{{ $c->SanPham->donvitinh->TenDonViTinh }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
