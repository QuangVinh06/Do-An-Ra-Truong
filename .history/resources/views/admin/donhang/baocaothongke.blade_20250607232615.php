@extends('Master.main')
@section('tittle','Báo cáo thống kê doanh số bán hàng')
@section('main')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
            --success-color: #38b000;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
    
 
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        h1 {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .date {
            font-size: 0.9rem;
            color: #666;
        }
        
        .filters {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        
        label {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }
        
        select, input {
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        
        select:focus, input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }
        
        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.15);
        }
        
        .secondary-btn {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--border-color);
        }
        
        .secondary-btn:hover {
            background-color: #f8f9fa;
            color: var(--secondary-color);
        }
        
        .summary {
            background-color: var(--light-bg);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .stat-card {
            background-color: white;
            padding: 1.2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            min-width: 200px;
            flex: 1;
        }
        
        .stat-title {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.5rem;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            color: var(--success-color);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }
        
        th {
            background-color: var(--light-bg);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #555;
            border-bottom: 1px solid var(--border-color);
        }
        
        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            color: #333;
        }
        
        tr:hover {
            background-color: #f8f9fa;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        .status {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-completed {
            background-color: rgba(56, 176, 0, 0.1);
            color: var(--success-color);
        }
        
        .money {
            font-weight: 600;
            color: var(--text-color);
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }
        
        .page-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: white;
            color: var(--text-color);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .page-btn:hover, .page-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .footer {
            margin-top: 2rem;
            text-align: right;
            font-size: 0.9rem;
            color: #777;
        }
        
        /* Icons */
        .icon {
            width: 18px;
            height: 18px;
        }
        
        @media (max-width: 768px) {
            .filters {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .stat-card {
                min-width: 100%;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>

<body>
    <div class="container">
        <header>
            <div>
                <h1>Báo cáo thống kê doanh số bán hàng</h1>
            </div>
        </header>
    
        <form method="GET">
            <div class="filters">
                <div class="filter-group">
                    <label for="order-id">Mã đơn hàng</label>
                    <select id="order-id" name="search">
                        <option value="">Tất cả</option>
                        @foreach($dhs as $dh)
                            <option value="{{ $dh->id }}" {{ request('search') == $dh->id ? 'selected' : '' }}>
                                {{ $dh->id }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="filter-group">
                    <label for="from-date">Từ ngày</label>
                    <input type="date" id="from-date" name="from_date" value="{{ request('from_date') }}">
                </div>
    
                <div class="filter-group">
                    <label for="to-date">Đến ngày</label>
                    <input type="date" id="to-date" name="to_date" value="{{ request('to_date') }}">
                </div>
            </div>
    
            <div class="buttons">
                <button type="submit" id="search-btn">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Tìm kiếm
                </button>
            
                <a href="{{ route('baocaobanhang', request()->query()) }}" target="_blank">
                <button type="button" class="secondary-btn">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 20v-6M12 4v6M6 12h12" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Xuất PDF
                </button>
                </a>
            </div>
        </form>
        
        <div class="summary">
            <div style="margin-bottom: 2rem;">
                <canvas id="salesChart" height="500" width="800"></canvas>
            </div>
        </div>
        <div class="summary">
            
            <div class="stat-card">
                <p class="stat-title">Tổng số đơn hàng</p>
                <p class="stat-value">{{ count($dhs) }}</p>
                
            </div>
    
            <div class="stat-card">
                <p class="stat-title">Tổng doanh thu</p>
                <p class="stat-value">
                    {{ number_format($dhs->sum('TongTienThanhToan'), 0, ',', '.') }}đ
                </p>
               
            </div>
        </div>
    
        <table>
            <thead>
            <tr>
                <th>STT</th>
                <th class="text-center">Mã đơn hàng</th>
                <th>Ngày lập</th>
                <th>Tên khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($dhs as $index => $dh)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-center">{{ $dh->id }}</td>
                    <td>{{ $dh->NgayLap }}</td>
                    <td>{{ $dh->hopDong->phieuDatHang->TenKhachHang ?? 'N/A' }}</td>
                    <td class="money">{{ number_format($dh->TongTienThanhToan, 0, ',', '.') }}đ</td>
                    <td><span class="status status-completed">{{ $dh->TrangThai }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
       
        <div class="footer">
            <p>© 2025 - Hệ thống quản lý đơn hàng</p>
        </div>
        
    </div>
    
    <script>
        const today = new Date();
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    
        if (!document.getElementById('from-date').value)
            document.getElementById('from-date').valueAsDate = firstDay;
        if (!document.getElementById('to-date').value)
            document.getElementById('to-date').valueAsDate = today;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = {!! json_encode($doanhThuTheoNgay->keys()) !!};
        const data = {!! json_encode($doanhThuTheoNgay->values()) !!};

        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu theo ngày',
                    data: data,
                    borderColor: '#4361ee',
                    backgroundColor: 'rgb(67, 184, 238)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#4361ee',
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                }
            }
        });
    </script>
    </body>

@endsection