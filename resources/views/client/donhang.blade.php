@extends('client.index') 

@section('main')
<div class="container py-4">
        <div class=" mb-3">
        <small class="breadcrumb" style="gap:4px; font-size:100%;">
            <a href="/">Trang chủ</a> <span>/</span> <span> Đơn hàng</span>
        </small>
    </div>
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="page-title">Quản lý đơn hàng</h3>
                <p class="page-subtitle">Theo dõi tình trạng đơn hàng của bạn</p>
            </div>
            <a class="btn-classic btn-return" href="{{ route('client.doitra2') }}">
                <i class="bi bi-arrow-left-right"></i>
                Trang đổi trả
            </a>
        </div>
        <hr class="classic-divider">
    </div>

    <!-- Orders Table -->
    <div class="classic-card">
        <div class="card-header-classic">
            <h5 class="card-title-classic">
                <i class="bi bi-list-ul"></i>
                Danh sách đơn hàng
            </h5>
        </div>
        
        <div class="table-wrapper">
            <table class="classic-table">
                <thead>
                    <tr>
                        <th width="8%" class="text-center">STT</th>
                        <th width="20%">Ngày lập đơn hàng</th>
                        <th width="18%" class="text-center" >Trạng thái</th>
                        <th width="18%">Tổng tiền</th>
                        <th width="20%" class="text-center">Thao tác</th>
                    </tr>
                    @csrf
                </thead>
                <tbody>
                    @forelse ($donHangs as $index => $dh)
                    <tr class="table-row">
                        <td class="text-center">
                            <span class="row-number">{{ $index + 1 }}</span>
                        </td>
                        <td>
                            <div class="date-info">
                                <i class="bi bi-calendar3 text-muted me-2"></i>
                                {{ date('d/m/Y', strtotime($dh->NgayLap)) }}
                            </div>
                        </td>
                        <td>
                            <span class="status-classic 
                            {{ $dh->TrangThai === 'Đã thanh toán toàn bộ' ? 'status-success' : 
                               ($dh->TrangThai === 'Đã giao hàng' ? 'status-success' : 'status-pending') }}">
                                {{ $dh->TrangThai }}
                            </span>
                        </td>
                        <td>
                            <span class="amount-classic">{{ number_format($dh->hopDong->GiaTriGocHopDong, 0, ',', '.') }} đ</span>
                        </td>
                        <td class="text-center">
                            <div class="action-group">
                                
                                <a href="{{ route('QLdonhang.show2', $dh->id) }}" class="btn-classic btn-detail">
                                    <i class="bi bi-eye"></i>
                                    Chi tiết
                                </a>
                                @if($dh->TrangThai === 'Đã thanh toán toàn bộ' || $dh->TrangThai === 'Đã giao hàng')
                                <a href="{{ route('QLdoitra.create', $dh->id) }}" class="btn-classic btn-exchange">
                                    Đổi trả
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-classic">
                                <div class="empty-icon-classic">
                                    <i class="bi bi-inbox"></i>
                                </div>
                                <h5 class="empty-title-classic">Chưa có đơn hàng</h5>
                                <p class="empty-text-classic">Bạn chưa có đơn hàng nào.<br>Hãy bắt đầu mua sắm ngay hôm nay!</p>
                                <a href="{{ route('client.home') }}" class="btn-classic btn-primary-classic">
                                    <i class="bi bi-bag-plus"></i>
                                    Bắt đầu mua sắm
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

<style>
.container {
    max-width: 1100px;
}

.page-header {
    border-bottom: 2px solid #dee2e6;
    padding-bottom: 1rem;
}

.page-title {
    color: #2c3e50;
    font-weight: bold;
    margin-bottom: 0.25rem;
}

.page-subtitle {
    color: #6c757d;
    margin-bottom: 0;
    font-style: italic;
}

.classic-divider {
    border-top: 1px solid #dee2e6;
    margin-top: 1rem;
}

.btn-classic {
    display: inline-block;
    padding: 8px 16px;
    border: 1px solid #ced4da;
    background-color: #f8f9fa;
    color: #495057;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.btn-classic:hover {
    background-color: #e9ecef;
    border-color: #adb5bd;
    color: #495057;
    text-decoration: none;
}

.btn-return {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
}

.btn-return:hover {
    background-color: #218838;
    border-color: #1e7e34;
    color: white;
}

.btn-detail {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    margin-right: 5px;
}

.btn-detail:hover {
    background-color: #0056b3;
    border-color: #004085;
    color: white;
}

.btn-exchange {
    background-color: #fd7e14;
    border-color: #fd7e14;
    color: white;
}

.btn-exchange:hover {
    background-color: #e55a00;
    border-color: #dc5200;
    color: white;
}

.btn-primary-classic {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    padding: 10px 20px;
}

.btn-primary-classic:hover {
    background-color: #0056b3;
    border-color: #004085;
    color: white;
}

/* Classic Card */
.classic-card {
    background-color: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card-header-classic {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 1rem 1.5rem;
    border-radius: 6px 6px 0 0;
}

.card-title-classic {
    margin-bottom: 0;
    color: #495057;
    font-weight: bold;
    font-size: 1.1rem;
}

.card-title-classic i {
    margin-right: 8px;
    color: #6c757d;
}

/* Classic Table */
.table-wrapper {
    overflow-x: auto;
}

.classic-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.classic-table thead th {
    background-color: #f1f3f4;
    color: #495057;
    font-weight: bold;
    padding: 12px 16px;
    text-align: left;
    border-bottom: 2px solid #dee2e6;
    font-size: 14px;
}

.classic-table tbody td {
    padding: 12px 16px;
    border-bottom: 1px solid #dee2e6;
    color: #495057;
    vertical-align: middle;
}

.table-row:hover {
    background-color: #f8f9fa;
}

.table-row:nth-child(even) {
    background-color: #fafbfc;
}

.table-row:nth-child(even):hover {
    background-color: #f1f3f4;
}

/* Content Styling */
.row-number {
    display: inline-block;
    width: 24px;
    height: 24px;
    line-height: 24px;
    text-align: center;
    background-color: #e9ecef;
    color: #495057;
    border-radius: 50%;
    font-size: 12px;
    font-weight: bold;
}

.date-info {
    display: flex;
    align-items: center;
    font-size: 14px;
}

.status-classic {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.amount-classic {
    font-weight: bold;
    color: #28a745;
    font-size: 15px;
}

.action-group {
    display: flex;
    justify-content: center;
    gap: 5px;
    flex-wrap: wrap;
}

/* Empty State */
.empty-classic {
    text-align: center;
    padding: 3rem 2rem;
}

.empty-icon-classic {
    font-size: 3rem;
    color: #adb5bd;
    margin-bottom: 1rem;
}

.empty-title-classic {
    color: #6c757d;
    margin-bottom: 1rem;
    font-weight: bold;
}

.empty-text-classic {
    color: #6c757d;
    margin-bottom: 2rem;
    line-height: 1.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .page-header .d-flex {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .card-header-classic {
        padding: 1rem;
    }
    
    .classic-table thead th,
    .classic-table tbody td {
        padding: 8px 12px;
        font-size: 13px;
    }
    
    .action-group {
        flex-direction: column;
        gap: 4px;
    }
    
    .btn-classic {
        padding: 6px 12px;
        font-size: 12px;
        width: 100%;
        text-align: center;
    }
    
    .empty-classic {
        padding: 2rem 1rem;
    }
    
    .empty-icon-classic {
        font-size: 2.5rem;
    }
}

@media (max-width: 576px) {
    .classic-table {
        font-size: 12px;
    }
    
    .classic-table thead th:nth-child(2),
    .classic-table tbody td:nth-child(2) {
        display: none;
    }
    
    .status-classic {
        font-size: 10px;
        padding: 3px 8px;
    }
    
    .amount-classic {
        font-size: 13px;
    }
}

/* Print Styles */
@media print {
    .btn-classic,
    .action-group {
        display: none;
    }
    
    .classic-card {
        box-shadow: none;
        border: 1px solid #000;
    }
    
    .classic-table {
        font-size: 12px;
    }
}
</style>
@endsection