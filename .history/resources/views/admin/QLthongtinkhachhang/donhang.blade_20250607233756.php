@extends('Master.main')
@section('tittle', 'Xem đơn hàng')
@section('main')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        padding: 10px 16px;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        transition: background-color 0.2s;
        border: none;
    }

    .back-btn:hover {
        background-color: #5a6268;
        color: white;
        text-decoration: none;
    }

    .back-btn i {
        margin-right: 8px;
    }

    .page-header {
        background: white;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border: 1px solid #dee2e6;
    }

    .page-title {
        margin: 0;
        color: #495057;
        font-size: 24px;
        font-weight: 600;
        text-align: center;
    }

    .customer-name {
        color: #007bff;
        font-weight: 700;
    }

    .error-message {
        color: #dc3545;
        text-align: center;
        font-size: 18px;
        margin: 40px 0;
    }

    .orders-container {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border: 1px solid #dee2e6;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        font-size: 15px;
    }

    .orders-table thead th {
        background-color: #495057;
        color: white;
        padding: 15px 12px;
        text-align: center;
        font-weight: 600;
        border: none;
        font-size: 14px;
    }

    .orders-table tbody td {
        padding: 15px 12px;
        text-align: center;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
    }

    .orders-table tbody tr:last-child td {
        border-bottom: none;
    }

    .orders-table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .orders-table tbody tr:hover {
        background-color: #e9ecef;
    }

    .order-id {
        font-weight: 600;
        color: #495057;
    }

    .order-date {
        color: #6c757d;
        font-size: 14px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-completed {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .total-amount {
        font-weight: 700;
        color: #28a745;
        font-size: 16px;
    }

    .detail-btn {
        padding: 8px 16px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 500;
        transition: background-color 0.2s;
        border: none;
        cursor: pointer;
    }

    .detail-btn:hover {
        background-color: #0056b3;
        color: white;
        text-decoration: none;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-icon {
        font-size: 48px;
        color: #dee2e6;
        margin-bottom: 15px;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #495057;
    }

    .empty-subtitle {
        font-size: 14px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .summary-info {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-top: 1px solid #dee2e6;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        color: #6c757d;
    }

    .total-orders {
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .page-header {
            padding: 20px 15px;
        }

        .page-title {
            font-size: 20px;
        }

        .orders-table thead th,
        .orders-table tbody td {
            padding: 10px 8px;
            font-size: 13px;
        }

        .detail-btn {
            padding: 6px 12px;
            font-size: 12px;
        }

        .status-badge {
            font-size: 11px;
            padding: 4px 8px;
        }
    }
</style>

<div class="container">
    @php
        $khachHang = $donHangs->first()->hopDong->phieuDatHang ?? null;
    @endphp
    
    <!-- Back Button -->
    <a href="{{ route('QLKhachHang.baocao') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>

    <!-- Page Header -->
    <div class="page-header">
        @if($khachHang)
            <h2 class="page-title">
                Đơn hàng của khách hàng: <span class="customer-name">{{ $khachHang->TenKhachHang }}</span>
            </h2>
        @else
            <h2 class="error-message">Không tìm thấy thông tin khách hàng</h2>
        @endif
    </div>

    <!-- Orders Table -->
    @if($donHangs->count() > 0)
        <div class="orders-container">
            <div class="table-responsive">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th style="width: 120px;">Mã đơn</th>
                            <th style="width: 150px;">Ngày đặt</th>
                            <th style="width: 130px;">Trạng thái</th>
                            <th style="width: 150px;">Tổng tiền</th>
                            <th style="width: 120px;">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donHangs as $donHang)
                            @php
                                $khachHang = $donHang->hopDong->phieuDatHang->khachHang ?? null;
                            @endphp
                            <tr>
                                <td>
                                    <span class="order-id">#{{ $donHang->id }}</span>
                                </td>
                                <td>
                                    <span class="order-date">{{ date('d/m/Y', strtotime($donHang->NgayLap)) }}</span>
                                </td>
                                <td>
                                    <span class="status-badge status-pending">
                                        {{ $donHang->TrangThai }}
                                    </span>
                                </td>
                                <td>
                                    <span class="total-amount">{{ number_format($donHang->hopDong->GiaTriGocHopDong, 0, ',', '.') }}đ</span>
                                </td>
                                <td>
                                    <a href="{{ route('QLKhachHang.xemctdonhang', $donHang->id) }}" class="detail-btn">
                                        <i class="fas fa-eye"></i> Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Summary Info -->
          
        </div>
    @else
        <div class="orders-container">
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="empty-title">Chưa có đơn hàng</div>
                <div class="empty-subtitle">Khách hàng này chưa có đơn hàng nào</div>
            </div>
        </div>
    @endif
    <a href="{{ route('baocaodonhang', $email) }}" target="_blank">
        <button type="button" class="secondary-btn">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 20v-6M12 4v6M6 12h12" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Xuất PDF
        </button>
    </a>
</div>
@endsection