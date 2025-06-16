@extends('Master.main')
@section('tittle', 'Chi tiết phiếu đặt hàng')
@section('main')
{{-- Tổng tiền --}}
<div class="text-end mt-3">
    <h5 class="fw-semibold">
        Tổng tiền ban đầu: 
        <span class="text-muted">{{ number_format($tongTienGoc, 0, ',', '.') }}đ</span>
    </h5>

    <h5 class="fw-semibold">
        Khuyến mãi: 
        <span class="text-primary" title="Giảm {{ $GiamGia }}%">
            {{ $TenKhuyenMai }}
        </span> 
        <span class="text-success ms-2">
            -{{ number_format($tienGiam, 0, ',', '.') }}đ
        </span>
    </h5>

    <h5 class="fw-semibold">
        Tổng tiền sau giảm: 
        <span class="text-danger">{{ number_format($tongTienSauGiam, 0, ',', '.') }}đ</span>
    </h5>
</div>

@endsection
