@extends('client.index')

@section('main')
<div class="container-fluid py-4">
       <div class="container mb-3">
        <small class="breadcrumb" style="gap:4px; font-size:100%;">
            <a href="/">Trang chủ</a> <span>/</span> <span> Khuyến mãi</span>
        </small>
    </div>
<div class="container py-4">


    <div class="bg-dark text-white rounded p-5 mb-4 text-center shadow  bg-light">
        <h2 class="display-5 fw-bold">Chương Trình Khuyến Mãi</h1>
        <p class="lead">Khám phá các ưu đãi đặc biệt dành cho khách hàng thân thiết</p>
        <div class="d-flex justify-content-center gap-4 mt-4">
            <div>
                <h2 class="text-primary">{{ count($khuyenMais) }}</h3>
                <p class="mb-0">Chương trình</p>
            </div>
            <div class="vr bg-light"></div>
            <div style="margin-left: 20px;">
                <h2 class="text-success">50%</h2>
                <p class="mb-0">giảm giá lên đến</p>
            </div>
        </div>
    </div>

 
    
    <div id="cardsView" class="row g-4">
        @foreach ($khuyenMais as $index => $km)
        <div class="col-md-4" data-customer-type="{{ $km->loaiKhachHang->TenLoaiKhachHang }}" data-discount="{{ $km->GiamGia }}">
            <div class="card shadow h-100 border-primary">
                <div style="height: 100px" class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $km->TenKhuyenMai }}</h5>
                    <span class="badge bg-light text-dark">{{ $km->GiamGia }}% OFF</span>
                </div>
                <div class="card-body">
                    <p><i class="bi bi-person-check-fill"></i> Đối tượng: {{ $km->loaiKhachHang->TenLoaiKhachHang }}</p>
                    <p><i class="bi bi-check-circle-fill"></i> Điều kiện: {{ $km->loaiKhachHang->DieuKien }} đơn hàng</p>
                    <p><i class="bi bi-percent"></i> Tiết kiệm: {{ $km->GiamGia }}%</p>
                    <p><i class="bi bi-bag-fill"></i>{{ $km->TrangThai ===1 ? 'Đang diễn ra' : 'Hết hạn' }}</p>
                    <p><i class="bi bi-calendar-event-fill"></i> Thời gian: 
                        {{ \Carbon\Carbon::parse($km->NgayBatDau)->format('d/m/Y') }} - 
                        {{ \Carbon\Carbon::parse($km->NgayKetThuc)->format('d/m/Y') }}
                    </p>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    <!-- Dạng bảng -->
    <div id="tableView" class="table-responsive mt-5  bg-light" style="display: none;">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Loại khách hàng</th>
                    <th>Điều kiện</th>
                    <th>Chương trình</th>
                    <th>Giảm giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($khuyenMais as $index => $km)  
                <tr>  
                    <td>{{ $km->loaiKhachHang->TenLoaiKhachHang }}</td>  
                    <td>{{ $km->loaiKhachHang->DieuKien }} đơn hàng</td>  
                    <td>{{ $km->TenKhuyenMai }}</td>  
                    <td>{{ $km->GiamGia }}%</td>  
                    <td>{{ \Carbon\Carbon::parse($km->NgayBatDau)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($km->NgayKetThuc)->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge bg-info text-dark">{{ $km->GiamGia }}%</span>
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Không tìm thấy -->


<!-- Bảng loại khách hàng -->


<div style="margin-top: 100px" class="table-responsive mb-4">
    <table class="table table-bordered table-hover align-middle text-center">
        <h2 class="text-center text-primary fs-4">Danh sách loại khách hàng</h2>
        <thead class="table-primary">
            <tr>
                <th>STT</th>
                <th>Tên loại khách hàng</th>
                <th>Điều kiện</th>
                <th>Số chương trình áp dụng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loaikhachhang as $index => $loai)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $loai->TenLoaiKhachHang }}</td>
                    <td>{{ $loai->DieuKien }} đơn hàng</td>
                    <td>
                        {{ $khuyenMais->where('idLoaiKhachHang', $loai->id)->count() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
