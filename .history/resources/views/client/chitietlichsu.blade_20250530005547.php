@extends('client.index')
@section('tittle', 'Chi tiết phiếu đặt hàng')
@section('main')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary"><i class="fas fa-receipt me-2"></i>Chi tiết phiếu đặt hàng</h3>
        <a href="{{ route('dathang.view') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Quay lại
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if ($ctdat->isNotEmpty())
                <h5 class="mb-4 fw-semibold">Mã phiếu đặt: 
                    <span class="text-primary">#{{ $ctdat[0]->idPhieuDat }}</span>
                </h5>
            @endif

            <div class="table-responsive  bg-light">
                <table class="table  table-hover align-middle shadow-sm">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col" class="text-start">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col" class="text-end">Đơn giá</th>
                            <th scope="col" class="text-end">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ctdat as $index => $ct)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $ct->sanPham->TenGoi }}</td>
                            <td class="text-center">{{ $ct->SoLuong }}</td>
                            <td class="text-center">{{ number_format($ct->DonGia, 0, ',', '.') }}đ</td>
                            <td class="text-center text-primary fw-bold">{{ number_format($ct->ThanhTien, 0, ',', '.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Tổng tiền --}}
            @php
                $phieuDatHang = $ctdat->first()->phieuDatHang;
                $tongTien = $phieuDatHang->TongTien;
            @endphp
            <div class="text-end mt-3">
                <h5 class="fw-semibold">{{ $TenKhuyenMai }} 
                    <span class="text-danger">
                        {{ number_format($tongTien* ($GiamGia / 100), 0, ',', '.') }} VND( Giảm {{ $GiamGia }}%)</th>
                    </span>
                </h5>
                <h5 class="fw-semibold">
                    Tổng tiền sau giảm: 
                    <span class="text-danger">
                        {{ number_format($tongTienSauGiam, 0, ',', '.') }}đ
                    </span>
                </h5>
            </div>
        </div>
    </div>
</div>

{{-- Style thêm --}}
<style>
    .table th, .table td {
        vertical-align: middle;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    h5 span {
        font-size: 1.2rem;
    }
</style>
@endsection
