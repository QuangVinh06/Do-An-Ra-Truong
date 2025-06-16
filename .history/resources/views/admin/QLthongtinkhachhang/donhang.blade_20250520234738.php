@extends('Master.main')
@section('tittle', 'Xem đơn hàng')
@section('main')
<style>
    .table {
    font-size: 16px;
    text-align: center;
}

.text-primary {
    font-weight: bold;
}

.badge {
    font-size: 14px;
    padding: 5px 10px;
}
</style>
<div class="container mt-5">
    @php
        $khachHang = $donHangs->first()->hopDong->phieuDatHang->khachHang ?? null;
    @endphp
    @if ($khachHang)
    <a href="{{ route('QLKhachHang.baocao') }}" class="btn btn-outline-secondary">Quay lại</a>
    <h2 class="text-center mb-4">Xem đơn hàng của khách hàng: <span class="text-primary">{{ $khachHang->user->name }}</span></h2>
    @else
        <h2 class="text-center text-danger">Không tìm thấy thông tin khách hàng</h2>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Mã đơn</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donHangs as $donHang)
                    @php
                        $khachHang = $donHang->hopDong->phieuDatHang->khachHang ?? null;
                    @endphp
                    <tr>
                        <td>{{ $donHang->id }}</td>
                        <td>{{ $donHang->NgayLap }}</td>
                        <td>
                            <span class="badge  bg-warning ">
                               
                                {{ $donHang->TrangThai }}
                            </span>
                        </td>
                        <td>{{ number_format($donHang->TongTienThanhToan, 0, ',', '.') }} đ</td>
                        <td><a href="{{ route('QLKhachHang.xemctdonhang',$donHang->id) }}" class="btn btn-primary">Chi tiết</a> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection