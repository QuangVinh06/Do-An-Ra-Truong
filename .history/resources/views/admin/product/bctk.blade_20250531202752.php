<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo thống kê sản phẩm</title>
    <style>
        :root {
            --primary-color: #4285f4;
            --secondary-color: #34a853;
            --accent-color: #fbbc05;
            --danger-color: #ea4335;
            --light-gray: #f8f9fa;
            --border-color: #e0e0e0;
            --text-color: #333;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 4px 16px rgba(0, 0, 0, 0.12);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f7fa;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Header */
        header {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header-title h1 {
            color: var(--primary-color);
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        
        .header-title p {
            color: #666;
            font-size: 14px;
        }
        
        /* Filters */
        .search-filters {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-bottom: 24px;
        }
        
        .filters-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .filter-item label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #555;
        }
        
        .filter-item select,
        .filter-item input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        
        .filter-item select:focus,
        .filter-item input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
        }
        
        .filter-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #3367d6;
            transform: translateY(-1px);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-color);
        }
        
        .btn-outline:hover {
            background-color: var(--light-gray);
            border-color: #ccc;
        }
        
        /* Dashboard Cards */
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 24px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }
        
        .card-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .card-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 12px;
        }
        
        .card-trend {
            display: flex;
            align-items: center;
            font-size: 12px;
            font-weight: 500;
        }
        
        .trend-up { color: var(--secondary-color); }
        .trend-down { color: var(--danger-color); }
        
        /* Product Stats Table */
        .product-stats {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 32px;
        }
        
        .stats-header {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            background: var(--light-gray);
        }
        
        .stats-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }
        
        .stats-actions select {
            padding: 8px 16px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }
        
        th, td {
            padding: 16px 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }
        
        th {
            background-color: var(--light-gray);
            font-weight: 600;
            color: #555;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        tbody tr {
            transition: background-color 0.2s ease;
        }
        
        tbody tr:hover {
            background-color: rgba(66, 133, 244, 0.05);
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }
        
        .product-name {
            font-weight: 500;
            color: var(--text-color);
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .product-description {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #666;
            font-size: 13px;
        }
        
        .quantity {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .price {
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .color-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .color-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 1px solid var(--border-color);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 16px;
            }
            
            header {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }
            
            .filters-row {
                grid-template-columns: 1fr;
            }
            
            .filter-buttons {
                justify-content: center;
            }
            
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .stats-header {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }
            
            .card-value {
                font-size: 24px;
            }
        }
        
        @media (max-width: 480px) {
            .table-container {
                font-size: 12px;
            }
            
            th, td {
                padding: 12px 8px;
            }
            
            .product-image {
                width: 40px;
                height: 40px;
            }
        }
        
        /* Loading state */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        
        .spinner {
            width: 32px;
            height: 32px;
            border: 3px solid var(--border-color);
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-title">
                <h1>Báo cáo thống kê sản phẩm</h1>
                <p>Tổng quan doanh số và hiệu suất sản phẩm</p>
            </div>
        </header>
        
        <div class="search-filters">
            <div class="filters-row">
                <div class="filter-item">
                    <label for="category">Danh mục loại sản phẩm</label>
                    <select id="category" name="category_id">
                        <option value="">Tất cả danh mục</option>
                        <option value="1">Sơn xe đạp</option>
                        <option value="2">Sơn ô tô</option>
                        <option value="3">Sơn công nghiệp</option>
                    </select>
                </div>
                <div class="filter-item">
                    <label for="period">Thời gian</label>
                    <select id="period">
                        <option value="month">Tháng này</option>
                        <option value="quarter">Quý này</option>
                        <option value="year">Năm này</option>
                    </select>
                </div>
                <div class="filter-item">
                    <label for="sort">Sắp xếp theo</label>
                    <select id="sort">
                        <option value="sales">Doanh số</option>
                        <option value="quantity">Số lượng</option>
                        <option value="profit">Lợi nhuận</option>
                    </select>
                </div>
            </div>
            
            <div class="filter-buttons">
                <button class="btn btn-outline">🔄 Đặt lại</button>
                <button class="btn btn-primary">🔍 Tìm kiếm</button>
            </div>
        </div>
        
        <div class="dashboard">
            <div class="card">
                <div class="card-title">Tổng sản phẩm</div>
                <div class="card-value">7</div>
                <div class="card-trend trend-up">📈 +12% so với tháng trước</div>
            </div>
            <div class="card">
                <div class="card-title">Doanh thu tháng</div>
                <div class="card-value">56.434.004đ</div>
                <div class="card-trend trend-up">📈 +8.5% so với tháng trước</div>
            </div>
            <div class="card">
                <div class="card-title">Sản phẩm bán chạy nhất</div>
                <div class="card-value" style="font-size: 18px;">T106R20-23</div>
                <div class="card-trend">🏆 85 sản phẩm đã bán</div>
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
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Màu sắc</th>
                            <th>Đơn vị tính</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjYwIiBoZWlnaHQ9IjYwIiByeD0iOCIgZmlsbD0iI0ZGNjk5NCIvPgo8dGV4dCB4PSIzMCIgeT0iMzUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxMiIgZmlsbD0id2hpdGUiIHRleHQtYW5jaG9yPSJtaWRkbGUiPlNPTjwvdGV4dD4KPC9zdmc+" alt="Sản phẩm" class="product-image">
                            </td>
                            <td>
                                <div class="product-name">T106R20-23</div>
                            </td>
                            <td>Sơn xe đạp</td>
                            <td>
                                <div class="product-description">Tên sản phẩm: T106R20-23 Chủng loại: Sơn ngoại nhà Mã: Đỏ bóng: 85 ± 5% Độ đậy: 60 ÷ 80 μ Hóa rắn: 200°C /10'</div>
                            </td>
                            <td>
                                <div class="color-indicator">
                                    <div class="color-dot" style="background-color: #FFD700;"></div>
                                    vàng sáng
                                </div>
                            </td>
                            <td>20kg/thùng</td>
                            <td><span class="quantity">85</span></td>
                            <td><span class="price">15.300.000 VNĐ</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjYwIiBoZWlnaHQ9IjYwIiByeD0iOCIgZmlsbD0iIzMzOTlGRiIvPgo8dGV4dCB4PSIzMCIgeT0iMzUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxMiIgZmlsbD0id2hpdGUiIHRleHQtYW5jaG9yPSJtaWRkbGUiPlNPTjwvdGV4dD4KPC9zdmc+" alt="Sản phẩm" class="product-image">
                            </td>
                            <td>
                                <div class="product-name">SP-002</div>
                            </td>
                            <td>Sơn ô tô</td>
                            <td>
                                <div class="product-description">Sơn chuyên dụng cho ô tô, chống gỉ sét, độ bền cao</div>
                            </td>
                            <td>
                                <div class="color-indicator">
                                    <div class="color-dot" style="background-color: #3399FF;"></div>
                                    xanh dương
                                </div>
                            </td>
                            <td>25kg/thùng</td>
                            <td><span class="quantity">72</span></td>
                            <td><span class="price">18.500.000 VNĐ</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjYwIiBoZWlnaHQ9IjYwIiByeD0iOCIgZmlsbD0iIzMzQ0M2NiIvPgo8dGV4dCB4PSIzMCIgeT0iMzUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxMiIgZmlsbD0id2hpdGUiIHRleHQtYW5jaG9yPSJtaWRkbGUiPlNPTjwvdGV4dD4KPC9zdmc+" alt="Sản phẩm" class="product-image">
                            </td>
                            <td>
                                <div class="product-name">SP-003</div>
                            </td>
                            <td>Sơn công nghiệp</td>
                            <td>
                                <div class="product-description">Sơn chống ăn mòn cho thiết bị công nghiệp</div>
                            </td>
                            <td>
                                <div class="color-indicator">
                                    <div class="color-dot" style="background-color: #33CC66;"></div>
                                    xanh lá
                                </div>
                            </td>
                            <td>30kg/thùng</td>
                            <td><span class="quantity">45</span></td>
                            <td><span class="price">22.634.004 VNĐ</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>