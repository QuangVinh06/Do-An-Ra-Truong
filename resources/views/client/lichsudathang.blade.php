@extends('client.index')
@section('tittle','Lịch sử đặt hàng')
@section('main')
<div class="container mt-4 ">
        
       <div class=" mb-3">
        <small class="breadcrumb" style="gap:4px; font-size:100%;">
            <a href="/">Trang chủ</a> <span>/</span> <span> <a href="{{ url()->previous() }}">Đặt hàng</a></span> / <span>Lịch sử đặt hàng</span>
        </small>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="text-primary mb-3"><i class="fas fa-history me-2"></i>Lịch sử đặt hàng</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('dathang.view') }}" class="btn btn-outline-primary rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">Ngày đặt</th>
                            <th class="py-3 text-center">Trạng thái</th>
                            <th class="py-3 text-center">Phương thức thanh toán</th>
                            <th class="py-3 text-center">Số lượng</th>
                            <th class="py-3 text-center">Khuyến mãi</th>
                            <th class="py-3 text-center">Tổng tiền</th>
                            <th class="py-3 ">Xem</th>
                            <th class="py-3 ">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($phieuDatIds as $index => $pd)
                        <tr>
                            <td class="align-middle">
                                <span class="text-muted"><i class="far fa-calendar-alt me-1"></i>{{ date('d/m/Y', strtotime($pd->NgayLap)) }}</span>
                            </td>
                            <td class="text-center">
                                @if($pd->TrangThai == 2)
                                    <span class="badge bg-warning text-dark rounded-pill">Đang kiểm tra đặt hàng</span>
                                @elseif($pd->TrangThai == 1)
                                    <span class="badge bg-info rounded-pill">Đã xác nhận đặt hàng	</span>

                                   
                                @endif
                            </td>
                            <td class="text-center">
                                @if($pd->phuongthuc->TenPhuongThucThanhToan == 'Online')
                                    <span><i class="fas fa-credit-card me-1 text-success"></i>{{ $pd->phuongthuc->TenPhuongThucThanhToan }}</span>
                                @else
                                    <span><i class="fas fa-money-bill-wave me-1 text-primary"></i>{{ $pd->phuongthuc->TenPhuongThucThanhToan }}</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <span class=" text-dark">{{ $pd->TongSoLuong }}</span>
                            </td>
                            <td class="text-center">
                                @if($pd->khuyenmai)
                                    <span class="text-success"><i class="fas fa-tag me-1"></i>{{ $pd->khuyenmai->TenKhuyenMai }}</span>
                                @else
                                    <span class="text-muted"><i class="fas fa-times me-1"></i>Chưa có khuyến mãi</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="fw-bold">{{ number_format($pd->TongTien, 0, ',', '.') }}đ</span>
                            </td>
                            <td class="">
                                <a href="{{ route('qlphieudat.show2',$pd->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Chi tiết
                                </a>
                            </td>
                            <td class="r">
                                <form action="{{ route('qlphieudat.destroy2', $pd->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn huỷ phiếu đặt này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i> Xóa phiếu đặt
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(count($phieuDatIds) == 0)
    <div class="text-center py-5">
        <img src="{{ asset('client/images/empty-cart.svg') }}" alt="No Orders" style="width: 120px; opacity: 0.5;">
        <h5 class="mt-3 text-muted">Bạn chưa có đơn hàng nào</h5>
        <p class="text-muted">Hãy đặt hàng ngay để trải nghiệm dịch vụ của chúng tôi!</p>
        <a href="{{ route('sanpham.index') }}" class="btn btn-primary mt-2">
            <i class="fas fa-shopping-cart me-1"></i> Mua sắm ngay
        </a>
    </div>
    @endif
</div>

<style>
    .table th {
        font-weight: 600;
        color: #555;
    }
    
    .table tbody tr {
        transition: all 0.2s;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }
    
    .btn-outline-primary, .btn-outline-danger {
        border-width: 1px;
        font-weight: 500;
    }
    
    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
</style>

<!-- Make sure to include Font Awesome in your project -->
@push('scripts')
<script>
    // You can add any JavaScript functionality here
</script>
@endpush
@endsection