@extends('client.index') 

@section('main')
<div class="container py-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">Đơn hàng của tôi</h2>
            <p class="text-muted mb-0">Theo dõi và quản lý đơn hàng của bạn</p>
        </div>
        <a class="btn btn-return-page" href="{{ route('client.doitra2') }}">
            <i class="bi bi-arrow-left-right me-2"></i>
            Trang đổi trả
        </a>
    </div>

    <!-- Orders Table Card -->
    <div class="orders-card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div class="header-icon">
                    <i class="bi bi-bag-check"></i>
                </div>
                <div class="ms-3">
                    <h5 class="mb-0 fw-semibold">Danh sách đơn hàng</h5>
                    <small class="text-muted">Tất cả đơn hàng của bạn</small>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th width="8%">
                                <div class="th-content">
                                    <span>STT</span>
                                </div>
                            </th>
                            <th width="20%">
                                <div class="th-content">
                                    <i class="bi bi-calendar3 me-2"></i>
                                    <span>Ngày lập</span>
                                </div>
                            </th>
                            <th width="18%">
                                <div class="th-content">
                                    <i class="bi bi-flag me-2"></i>
                                    <span>Trạng thái</span>
                                </div>
                            </th>
                            <th width="18%">
                                <div class="th-content">
                                    <i class="bi bi-currency-dollar me-2"></i>
                                    <span>Tổng tiền</span>
                                </div>
                            </th>
                            <th width="20%">
                                <div class="th-content">
                                    <i class="bi bi-gear me-2"></i>
                                    <span>Thao tác</span>
                                </div>
                            </th>
                        </tr>
                        @csrf
                    </thead>
                    <tbody>
                        @forelse ($donHangs as $index => $dh)
                        <tr class="order-row">
                            <td>
                                <div class="order-number">
                                    {{ $index + 1 }}
                                </div>
                            </td>
                            <td>
                                <div class="order-date">
                                    <i class="bi bi-calendar-event text-primary me-2"></i>
                                    <span>{{ date('d/m/Y', strtotime($dh->NgayLap)) }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="status-wrapper">
                                    <span class="status-badge 
                                    {{ $dh->TrangThai === 'Đã thanh toán toàn bộ' ? 'status-success' : 
                                       ($dh->TrangThai === 'Đã giao hàng' ? 'status-success' : 'status-secondary') }}">
                                        <i class="bi {{ $dh->TrangThai === 'Đã thanh toán toàn bộ' || 
                                                      $dh->TrangThai === 'Đã giao hàng' ? 'bi-check-circle' : 'bi-clock' }} me-1"></i>
                                        {{ $dh->TrangThai }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="order-total">
                                    <span class="amount">{{ number_format($dh->TongTienThanhToan, 0, ',', '.') }}</span>
                                    <span class="currency">đ</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('QLdonhang.show2', $dh->id) }}" class="btn-action btn-detail" title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                        <span>Chi tiết</span>
                                    </a>
                                    @if($dh->TrangThai === 'Đã thanh toán toàn bộ' || $dh->TrangThai === 'Đã giao hàng')
                                    <a href="{{ route('QLdoitra.create', $dh->id) }}" class="btn-action btn-return" title="Đổi trả">
                                        <i class="bi bi-arrow-repeat"></i>
                                        <span>Đổi trả</span>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bi bi-cart-x"></i>
                                    </div>
                                    <h4 class="empty-title">Không có đơn hàng nào</h4>
                                    <p class="empty-text">Bạn chưa có đơn hàng nào. Hãy bắt đầu mua sắm ngay!</p>
                                    <a href="{{ route('client.home') }}" class="btn-shop-now">
                                        <i class="bi bi-bag-plus me-2"></i>
                                        Mua sắm ngay
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
</div>

<style>
/* Main Styles */
.container {
    max-width: 1200px;
}

/* Header Styles */
.btn-return-page {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-return-page:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    color: white;
}

/* Card Styles */
.orders-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.card-header {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    padding: 24px 32px;
    border-bottom: 1px solid #e2e8f0;
}

.header-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
}

.table-container {
    background: white;
    padding: 0;
}

/* Table Styles */
.modern-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.modern-table thead tr {
    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
}

.modern-table th {
    padding: 20px 24px;
    font-weight: 600;
    font-size: 14px;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e2e8f0;
}

.th-content {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.modern-table td {
    padding: 20px 24px;
    border-bottom: 1px solid #f1f5f9;
}

.order-row {
    transition: all 0.3s ease;
    background: white;
}

.order-row:hover {
    background: linear-gradient(135deg, #fafbff, #f0f4ff);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
}

/* Content Styles */
.order-number {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: #3730a3;
    margin: 0 auto;
}

.order-date {
    display: flex;
    align-items: center;
    font-weight: 500;
    color: #374151;
}

.status-wrapper {
    display: flex;
    justify-content: flex-start;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.status-success {
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    color: #166534;
    border: 1px solid #86efac;
}

.status-secondary {
    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
    color: #475569;
    border: 1px solid #cbd5e1;
}

.order-total {
    font-weight: 700;
    color: #059669;
}

.amount {
    font-size: 16px;
}

.currency {
    font-size: 14px;
    margin-left: 2px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.btn-detail {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    color: #1e40af;
    border-color: #93c5fd;
}

.btn-detail:hover {
    background: linear-gradient(135deg, #bfdbfe, #93c5fd);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    color: #1e40af;
}

.btn-return {
    background: linear-gradient(135deg, #fed7aa, #fdba74);
    color: #c2410c;
    border-color: #fb923c;
}

.btn-return:hover {
    background: linear-gradient(135deg, #fdba74, #fb923c);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(251, 146, 60, 0.3);
    color: #c2410c;
}

.btn-action i {
    margin-right: 6px;
    font-size: 14px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 40px;
    color: #6b7280;
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    font-size: 32px;
    color: #9ca3af;
}

.empty-title {
    font-size: 24px;
    font-weight: 700;
    color: #374151;
    margin-bottom: 12px;
}

.empty-text {
    font-size: 16px;
    color: #6b7280;
    margin-bottom: 32px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.btn-shop-now {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    padding: 14px 28px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn-shop-now:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 16px;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 16px;
    }
    
    .card-header {
        padding: 20px 16px;
    }
    
    .modern-table th,
    .modern-table td {
        padding: 16px 12px;
    }
    
    .th-content {
        font-size: 12px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 6px;
    }
    
    .btn-action {
        justify-content: center;
        width: 100%;
    }
    
    .order-number {
        width: 28px;
        height: 28px;
        font-size: 12px;
    }
    
    .status-badge {
        padding: 6px 12px;
        font-size: 11px;
    }
}

@media (max-width: 576px) {
    .modern-table th:nth-child(2),
    .modern-table td:nth-child(2) {
        display: none;
    }
    
    .empty-state {
        padding: 60px 20px;
    }
    
    .empty-icon {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
    
    .empty-title {
        font-size: 20px;
    }
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.orders-card {
    animation: fadeIn 0.6s ease-out;
}

.order-row {
    animation: fadeIn 0.6s ease-out;
}
</style>
@endsection