@extends('Master.main')
@section('tittle','Báo cáo thống kê sản phẩm')
@section('main')

<head>

    <style>
        :root {
            --primary-color: #4285f4;
            --secondary-color: #34a853;
            --accent-color: #fbbc05;
            --danger-color: #ea4335;
            --light-gray: #f8f9fa;
            --border-color: #e0e0e0;
            --text-color: #333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
 
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .header-title h1 {
            color: var(--primary-color);
            font-size: 24px;
            font-weight: 500;
        }
        
        .header-title p {
            color: #666;
            font-size: 14px;
        }
        
        .header-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #3367d6;
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border-color);
        }
        
        .btn-outline:hover {
            background-color: var(--light-gray);
        }
        
        .search-filters {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .filters-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .filter-item {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-item label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }
        
        .filter-item select,
        .filter-item input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 14px;
        }
        
        .filter-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .card-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .card-value {
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .card-trend {
            display: flex;
            align-items: center;
            font-size: 12px;
        }
        
        .trend-up {
            color: var(--secondary-color);
        }
        
        .trend-down {
            color: var(--danger-color);
        }
        
        .product-stats {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .stats-header {
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }
        
        .stats-title {
            font-size: 16px;
            font-weight: 500;
        }
        
        .stats-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        th {
            background-color: var(--light-gray);
            font-weight: 500;
            color: #555;
            font-size: 14px;
        }
        
        tbody tr:hover {
            background-color: rgba(66, 133, 244, 0.05);
        }
        
        .status {
            padding: 4px 8px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-available {
            background-color: rgba(52, 168, 83, 0.1);
            color: var(--secondary-color);
        }
        
        .status-low {
            background-color: rgba(251, 188, 5, 0.1);
            color: var(--accent-color);
        }
        
        .status-out {
            background-color: rgba(234, 67, 53, 0.1);
            color: var(--danger-color);
        }
        
        .progress-bar {
            height: 6px;
            background-color: #e0e0e0;
            border-radius: 3px;
            overflow: hidden;
            margin-top: 5px;
        }
        
        .progress-fill {
            height: 100%;
            border-radius: 3px;
        }
        
        .charts-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        @media (max-width: 992px) {
            .charts-container {
                grid-template-columns: 1fr;
            }
        }
        
        .chart-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .chart-title {
            font-size: 16px;
            font-weight: 500;
        }
        
        .chart-canvas {
            width: 100%;
            height: 250px;
            background-color: #f9f9f9;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .pagination-item {
            width: 32px;
            height: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .pagination-item.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .pagination-item:hover:not(.active) {
            background-color: var(--light-gray);
        }
        
        footer {
            text-align: center;
            padding: 20px 0;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-title">
                <h1>Báo cáo thống kê sản phẩm</h1>
            </div>
            
        </header>
        
        <div class="search-filters">
            <div class="filters-row">
                <div class="filter-item">
                    <label for="product-code">Mã sản phẩm</label>
                    <input type="text" id="product-code" placeholder="Nhập mã sản phẩm...">
                </div>
                <div class="filter-item">
                    <label for="product-name">Tên sản phẩm</label>
                    <input type="text" id="product-name" placeholder="Nhập tên sản phẩm...">
                </div>
                <div class="filter-item">
                    <label for="category">Danh mục loại sản phẩm</label>
                    <select id="category">
                        <option value="">Tất cả danh mục</option>
                        <option value="1">Điện thoại</option>
                       
                    </select>
                </div>
            </div>
           
            <div class="filter-buttons">
                <button class="btn btn-outline">Đặt lại</button>
                <button class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
        
        <div class="dashboard">
            <div class="card">
                <div class="card-title">Tổng sản phẩm</div>
                <div class="card-value">{{ $tongSanPham }}</div>
            </div>
            <div class="card">
                <div class="card-title">Doanh thu tháng</div>
                <div class="card-value">{{ number_format($doanhThuThang, 0, ',', '.') }}đ</div>
            </div>
            <div class="card">
                <div class="card-title">Sản phẩm bán chạy</div>
                <div class="card-value">{{ $sanPhamBanChay->first()->TenSanPham ?? 'Không có' }}</div>
            </div>
        </div>
       
        </div>
        
    
        
        <div class="product-stats">
            <div class="stats-header">
                <div class="stats-title">Chi tiết sản phẩm bán chạy</div>
                <div class="stats-actions">
                    <select>
                        <option value="sales">Theo doanh số</option>
                        <option value="units">Theo số lượng</option>
                        <option value="profit">Theo lợi nhuận</option>
                    </select>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Màu</th>
                        <th>Đơn vị tính</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($sanPhamBanChay as $index => $sp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sp->TenGoi }}</td>
                            <td>{{ $sp->loaiSanPham->TenLoaiSanPham }}</td>
                            <td>{{ $sp->MoTa }}</td>
                            <td>{{ $sp->MauSac }}</td>
                            <td>{{ $sp->DonViTinh }}</td>
                            <td>{{ $sp->tong_so_luong }}</td>
                            <td>{{ number_format($sp->tong_tien, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
         
        </div>
        
        
        
        
    </div>
</body>
</html>
@endsection