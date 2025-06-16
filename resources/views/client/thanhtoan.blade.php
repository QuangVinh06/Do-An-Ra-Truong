@extends('client.index') 
@section('title', 'Trang thanh toán')
@section('main') 

<div class="container py-4 ">
             <div class="mb-3">
        <small class="breadcrumb" style="gap:4px; font-size:100%;">
            <a href="/">Trang chủ</a> <span>/</span> <span> Thanh toán</span>
        </small>
              </div>

    <div class="flex-grow-1 px-4">
        <h4 class="mb-4 text-primary fw-semibold">Chi tiết thanh toán</h4>

        @forelse($hds as $index => $hd)
        <div class="card mb-4 shadow-sm border-0 "style="background-color: #f0f8ff; border-color: #ccc; border-radius: 8px;">
            <div class="card-body">
                <div class="row g-4 align-items-center">
                    <!-- Thông tin đặt hàng -->
                    <div class="col-md-6">
                        <h5 class="mb-2 text-primary">Mã đặt hàng: #{{ $hd->idPhieuDat }}</h5>
                        <p class="mb-1"><i class="bi bi-calendar-check"></i> <strong>Ngày lập:</strong> {{ $hd->NgayLap }}</p>
                        <p class="mb-1"><i class="bi bi-box"></i> <strong>Số lượng sản phẩm:</strong> {{ $hd->phieuDatHang->TongSoLuong ?? 'N/A' }}</p>
                        <a href="{{ route('thanhtoan.show', $hd->id) }}" class="btn btn-outline-secondary btn-sm mt-2">Xem chi tiết</a>
                    </div>
                    
                    <!-- Thông tin thanh toán -->
                    <div class="col-md-6">
                        <p><strong>Thuế:</strong> <span class="badge bg-success">{{ number_format($hd->Thue, 2) }}%</span></p>
                        @if($hd->TongSoTienConLai > 0)
                        <p><strong>Tổng số tiền thanh toán:</strong> <span class="text-success fw-bold">{{ number_format($hd->TongSoTienConLai, 0, ',', '.') }} đ</span></p>
                        @elseif($hd->TongSoTienConLai == 0)
                        <p><strong>Số tiền đã thanh toán:</strong> <span class="text-danger fw-bold">{{ number_format($hd->GiaTriGocHopDong, 0, ',', '.') }} đ</span></p>
                        @endif
                    
                        @if($hd->TrangThaiCoc != 'Không yêu cầu cọc' && $hd->TrangThaiCoc != 'Đã đặt cọc') <!-- Fixed logical operator -->
                            @if($hd->TienCoc > 0)
                            <p><strong>Số tiền đặt cọc:</strong> 
                                <span class="text-warning fw-semibold">
                                    {{ number_format($hd->TienCoc ?? 0, 0, ',', '.') }} đ
                                </span>
                            </p>
                            @elseif($hd->TienCoc == 0)
                            <p><strong>{{ $hd->TrangThaiCoc }}</strong></p>
                            @endif
                        @endif 

                        <div class="d-flex flex-wrap gap-2 mt-3">
                            @if($hd->TienCoc > 0)
                            <form action="{{ url('/vnpay_payment') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="text"name="total" value="{{$hd->TienCoc  }}"hidden>
                                <input type="hidden" name="idHopDong" value="{{ $hd->id }}">
                                <input type="hidden" name="LoaiThanhToan" value="Đặt cọc">

                                <button type="submit" class="btn btn-outline-primary">Thanh toán cọc</button>
                            </form>
                            @endif
                            @if($hd->TongSoTienConLai > 0&&$hd->phieuDatHang->phuongthuc->TenPhuongThucThanhToan == 'Thanh toán online')
                            <form action="{{ url('/vnpay_payment') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="text"name="total" value="{{$hd->TongSoTienConLai }}" hidden>
                                <input type="hidden" name="idHopDong" value="{{ $hd->id }}">
                                <input type="hidden" name="LoaiThanhToan" value="Thanh toán toàn bộ">
                                <button type="submit" class="btn btn-outline-primary">Thanh toán đơn hàng</button>
                            </form>
                            @elseif($hd->TongSoTienConLai > 0&&$hd->phieuDatHang->phuongthuc->TenPhuongThucThanhToan == 'Thanh toán trực tiếp')
                            
                            <span>Vui lòng khi nhận hàng hãy thực hiện thanh toán số tiền còn lại </span>    
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p>Không có dữ liệu thanh toán.</p>
        @endforelse
    </div>
</div>
@endsection