@extends('client.index')
@section('tittle','Chi tiết đơn hàng')

@section('main')

<div class="container my-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Chi tiết đơn hàng</h2>
        <a href="{{ route('donhang.view') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Quay lại
        </a>
    </div>
    <hr>

    <!-- Thông tin khách hàng -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user me-2"></i> Thông tin khách hàng
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <tr>
                    <th style="width: 35%;">Họ tên</th>
                    <td>{{ $dh->hopDong->phieuDatHang->khachHang->user->name ?? '' }}</td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td>{{ $dh->hopDong->phieuDatHang->khachHang->SoDienThoai ?? '' }}</td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td>{{ $dh->hopDong->phieuDatHang->khachHang->DiaChi ?? '' }}</td>
                </tr>
                <tr>
                    <th>Loại khách hàng</th>
                    <td>{{ $dh->hopDong->phieuDatHang->khachHang->loaikhachhang->TenLoaiKhachHang ?? '' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Thông tin sản phẩm -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <i class="fas fa-shopping-cart me-2"></i> Thông tin sản phẩm
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;" class="text-center">STT</th>
                            <th>Tên sản phẩm</th>
                            <th style="width: 100px;" class="text-center">Số lượng</th>
                            <th style="width: 150px;" class="text-center">Tiền hàng</th>
                            <th style="width: 150px;" class="text-center">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dh->hopDong->phieuDatHang->chiTietPhieuDat as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->sanPham->TenGoi }}</td>
                            <td class="text-center">{{ $item->SoLuong }}</td>
                            <td class="text-end">{{ number_format($item->DonGia, 0, ',', '.') }} VNĐ</td>
                            <td class="text-end">{{ number_format($item->ThanhTien, 0, ',', '.') }} VNĐ</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Thuế:</strong></td>
                            <td class="text-end"><strong>{{ $dh->hopDong->Thue }}%</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Khuyến mại:</strong></td>
                            <td class="text-end"><strong>{{ $dh->hopDong->phieuDatHang->khachHang->loaikhachhang->GiamGia ?? '0' }}%</strong></td>
                        </tr>
                        <tr class="table-primary">
                            <td colspan="4" class="text-end"><strong>Tổng tiền:</strong></td>
                            <td class="text-end"><strong>{{ number_format($dh->hopDong->GiaTriGocHopDong, 0, ',', '.') }} VNĐ</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection