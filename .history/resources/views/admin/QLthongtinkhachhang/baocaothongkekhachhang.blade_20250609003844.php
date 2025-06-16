@extends('Master.main')
@section('tittle','Báo cáo thống kê khách hàng')
@section('main')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Cáo Thống Kê Khách Hàng</title>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --info: #4361ee;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }



        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .header h1 {
            color: var(--primary);
            font-size: 24px;
        }

        .date-selector {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .date-input {
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            outline: none;
            transition: var(--transition);
        }

        .date-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        .filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-weight: 500;
            color: #495057;
            font-size: 14px;
        }

        .filter-input, .filter-select {
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            outline: none;
            transition: var(--transition);
        }

        .filter-input:focus, .filter-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        .search-button {
            padding: 10px 20px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
        }

        .search-button:hover {
            background-color: var(--secondary);
        }

        .search-button i {
            font-size: 16px;
        }

        .table-container {
            overflow-x: auto;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background-color: var(--primary);
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }

        .data-table th:first-child {
            border-top-left-radius: var(--border-radius);
        }

        .data-table th:last-child {
            border-top-right-radius: var(--border-radius);
        }

        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .data-table tr:hover {
            background-color: #e9ecef;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success);
        }

        .status-inactive {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger);
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .action-button {
            padding: 8px 12px;
            background-color: white;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .action-button:hover {
            background-color: #f8f9fa;
        }

        .action-button.edit {
            color: var(--info);
        }

        .action-button.delete {
            color: var(--danger);
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 14px;
        }

        .pagination-controls {
            display: flex;
            gap: 10px;
        }

        .pagination-button {
            padding: 8px 12px;
            background-color: white;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .pagination-button:hover {
            background-color: #f8f9fa;
        }

        .pagination-button.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .summary-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .summary-card-title {
            color: #6c757d;
            font-size: 14px;
            font-weight: 500;
        }

        .summary-card-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark);
        }

        .summary-card-change {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
        }

        .summary-card-change.positive {
            color: #4cc9f0;
        }

        .summary-card-change.negative {
            color: #f72585;
        }

        .export-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .export-button {
            padding: 8px 15px;
            background-color: white;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .export-button:hover {
            background-color: #f8f9fa;
        }

        .no-data {
            text-align: center;
            padding: 40px 0;
            color: #6c757d;
        }

        .no-data i {
            font-size: 48px;
            margin-bottom: 10px;
            color: #ced4da;
        }

        .no-data p {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .no-data span {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .filters {
                grid-template-columns: 1fr;
            }
            
            .summary-cards {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .date-selector {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Báo Cáo Thống Kê Khách Hàng</h1>
            
        </div>

        <div class="summary-cards">
            <div class="summary-card">
                <div class="summary-card-title">Tổng số khách hàng</div>
                <div class="summary-card-value">{{ count($khachHang) }}</div>
                
            </div>
            <div class="summary-card">
                <div class="summary-card-title">Khách hàng mới</div>
                <div class="summary-card-value">  {{ $khachHang->where('loaikhachhang.TenLoaiKhachHang', 'Khách hàng mới')->count() }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-title">Khách hàng thân quen</div>
                <div class="summary-card-value">  {{ $khachHang->where('loaikhachhang.TenLoaiKhachHang', 'Khách hàng thân quen')->count() }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-title">Khách hàng quen</div>
                <div class="summary-card-value"> {{ $khachHang->where('loaikhachhang.TenLoaiKhachHang', 'Khách hàng quen')->count() }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-title">Khách hàng VIP</div>
                <div class="summary-card-value"> {{ $khachHang->where('loaikhachhang.TenLoaiKhachHang', 'Khách hàng vip')->count() }}</div>
            </div>
           
        </div>

        <form method="GET" action="{{ route('QLKhachHang.baocao') }}">
            <div class="filters">
                <div class="filter-group">
                    <label for="customer-id">Mã khách hàng</label>
                    <select id="customer-id" class="filter-select" name="customer_id">
                        <option value="">Tất cả</option>
                        @foreach ($khachHang as $kh)
                            <option value="{{ $kh->id }}">{{ $kh->user->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="filter-group">
                    <label for="customer-name">Tên khách hàng</label>
                    <input type="text" id="customer-name" name="customer_name" class="filter-input" placeholder="Nhập tên khách hàng" value="{{ request('customer_name') }}">
                </div>
        
                <div class="filter-group">
                    <label for="customer-type">Loại khách hàng</label>
                    <select id="customer-type" class="filter-select" name="customer_type">
                        <option value="">Tất cả</option>
                        <option value="Khách hàng mới" {{ request('customer_type') == 'Khách hàng mới' ? 'selected' : '' }}>Khách hàng mới</option>
                        <option value="Khách hàng thân quen" {{ request('customer_type') == 'Khách hàng thân quen' ? 'selected' : '' }}>Khách hàng thân quen</option>
                        <option value="Khách hàng quen" {{ request('customer_type') == 'Khách hàng quen' ? 'selected' : '' }}>Khách hàng quen</option>
                        <option value="Khách hàng vip" {{ request('customer_type') == 'Khách hàng vip' ? 'selected' : '' }}>Khách hàng VIP</option>
                    </select>
                </div>
        
                <div class="filter-group">
                  
                    <button class="search-button" type="submit" style="margin-top:-6px">
                        <i>🔍</i> Tìm kiếm
                    </button>
                    
                </div>
                <a href="{{ route('baocaokhachhang', request()->query()) }}" target="_blank">
                    <button type="button" class="search-button">
                        <i>📄</i>Xuất PDF
                    </button>
                </a>
            </div>
        </form>
        

      
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Loại khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                @foreach ($khachHang as $index => $kh)
                <tbody>
                    <tr>
                        <td>{{ $index + 1 }}</td>                        
                        <td>{{ $kh->user->name  }}</td>
                        <td>{{ $kh->loaikhachhang->TenLoaiKhachHang }}</td>
                        <td>{{ $kh->user->email }}</td>
                        <td>{{ $kh->SoDienThoai }}</td>
                        <td>{{ $kh->DiaChi }}</td>
                        <td>
                            <div class="actions">
                                <button class="action-button edit">
                                    <a href="{{ route('QLKhachHang.donhang',$kh->user->email) }}" class="action-button edit">
                                        <i>📦</i> Xem đơn hàng đã mua
                                    </a>
                                </button>
                              
                            </div>
                        </td>
                    </tr>
                    
                
                </tbody>
                @endforeach
            </table>
        </div>

    </div>
</body>
</html>
@endsection