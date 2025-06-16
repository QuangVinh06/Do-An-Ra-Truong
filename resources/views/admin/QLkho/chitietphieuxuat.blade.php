@extends('Master.main')

@section('main')
<div class="container mt-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-4 text-primary">Chi tiết phiếu Xuất kho</h2>
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
            <label class="form-label fw-semibold">Mã phiếu xuất: {{ $phieunhap->id }}</label>
        </div>
        <div class="col-6">
            <label class="form-label fw-semibold">Người giao hàng: {{ $phieunhap->NguoiNhanHang }}</label>
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
                        <th>Tên kho xuất</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Màu</th>
                        <th>Số Lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ct as $index => $c)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $c->kho->TenKho }}</td>
                            <td>{{ $c->SanPham->TenGoi }}</td>
                            <td>{{ $c->SanPham->mau->TenMau }}</td>
                            <td class="text-end">{{ $c->SoLuong }}</td>
                            <td class="text-end">{{ $c->SanPham->banggia->Gia }}</td>
                            <td class="text-end">{{ $c->SanPham->banggia->Gia*$c->SoLuong }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end fw-semibold">Tông Tiền</td>
                        <td class="text-end fw-semibold">{{ $tongtien }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
