@extends('Master.main')

@section('main')
<div class="container mt-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-4 text-primary">Chi tiết phiếu kiểm kê</h2>
    <h3 class="text-center mb-4 text-primary">{{ $phieukiemke->NgayLap }}</h3>
    <h4 class="text-center mb-4 text-primary">Người lập: {{ $phieukiemke->NguoiLap }}</h4>

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
            <label class="form-label fw-semibold">Mã phiếu nhập: {{ $phieukiemke->id }}</label>
            <br>
            <label class="form-label fw-semibold">Kho: {{ $phieukiemke->kho->TenKho }}</label>
        </div>
        <div class="col-6">
            <br>
            <label class="form-label fw-semibold">Người kiểm kê: {{ $phieukiemke->NguoiKiemKe }}</label>
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
                        <th>Số Lượng</th>
                        <th>Đơn Giá</th>
                        <th>Thành Tiền</th>
                        <th>Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $ct = $phieukiemke->chitietphieukiemke;
                        $tongtien = 0;
                        foreach ($ct as $c) {
                            if (isset($c->sanPham->banggia->Gia)) {
                                $tongtien += $c->SoLuong * $c->sanPham->banggia->Gia;
                            }
                        }
                    @endphp
                    @foreach($ct as $index => $c)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td >{{ $c->sanPham->TenGoi }}</td>
                            <td style="width: 10%" class="text-end">{{ $c->SoLuong}}</td>
                            @if (isset($c->sanPham->banggia->Gia))
                                <td class="text-end">{{ $c->sanPham->banggia->Gia }}</td>
                                <td class="text-end">{{ $c->SoLuong*$c->sanPham->banggia->Gia}}</td>
                            @else
                                <td class="text-end">Chưa có giá</td>
                                <td class="text-end">Chưa có giá</td>
                            @endif
                            <td>
                                @if ($c->TrangThai == 0)
                                    <span class="badge bg-danger">Hư Hỏng</span>
                                @elseif ($c->TrangThai == 1)
                                    <span class="badge bg-warning">Thiếu hàng</span>
                                @elseif ($c->TrangThai == 2)
                                    <span class="badge bg-info">Thừa hàng</span>
                                @elseif ($c->TrangThai == 3)
                                    <span class="badge bg-secondary">Hàng lỗi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td></td>
                            <td>Tổng tiền</td>
                            <td></td>
                            <td></td>
                            <td class="text-end">{{ $tongtien }}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
