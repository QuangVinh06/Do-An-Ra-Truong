@extends('client.index') 

@section('main')
<div class="container py-4">
    <!-- Tiêu đề trang -->
    <button class="btn-doi-tra" style=" background-color:rgb(15, 210, 8);  color: #fff;border: none; padding: 10px 20px;border-radius: 5px;  font-size: 16px; cursor: pointer;  transition: background-color 0.3s ease; ">Trang đổi trả</button>
    <hr>
    <!-- Bảng đơn hàng -->
    <div class="card shadow-sm border-0 bg-light">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr >
                            <th class="py-3 text-center" width="5%">STT</th>
                            <th class="py-3" width="15%">Ngày lập đơn hàng</th>
                            <th class="py-3" width="15%">Trạng thái</th>
                            <th class="py-3" width="15%">Tổng tiền</th>
                            <th class="py-3 text-center" width="15%"></th>
                        </tr>
                        @csrf
                    </thead>
                    <tbody>
                        @forelse ($donHangs as $index => $dh)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ date('d/m/Y', strtotime($dh->NgayLap)) }}</td>
                            <td class="">
                                <span class="badge rounded-pill px-3 py-2 
                                {{ $dh->TrangThai === 'Đã thanh toán toàn bộ' ? 'bg-success text-white' : 'bg-secondary text-white' }}">
                                {{ $dh->TrangThai }}
                            </span></td>
                            <td class="fw-bold">{{ number_format($dh->TongTienThanhToan, 0, ',', '.') }} đ</td>
                            <td class="text-center">
                                <a href="{{ route('QLdonhang.show2', $dh->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye-fill me-1"></i> Chi tiết
                                </a>
                                @if($dh->TrangThai === 'Đã thanh toán toàn bộ')<a href="{{ route('QLdoitra.create', $dh->id) }}" class="btn btn-sm btn-primary">Đổi trả</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-cart-x text-muted" style="font-size: 2rem;"></i>
                                    <p class="text-muted mt-2 mb-0">Không có đơn hàng nào.</p>
                                    <a href="{{ route('client.home') }}" class="btn btn-outline-primary btn-sm mt-3">
                                        <i class="bi bi-bag-plus me-1"></i> Mua sắm ngay
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Phân trang -->
  
</div>
@endsection

<style>
    .table th {
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .badge {
        font-weight: 500;
    }
    
    .page-link {
        color: #0d6efd;
        border-radius: 0.25rem;
        margin: 0 2px;
    }
    
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
