<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Báo cáo doanh số bán hàng</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #000; }
        h1 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Báo cáo doanh số bán hàng</h1>
    @if ($tuNgay && $denNgay)
        <p><strong>Thời gian:</strong> Từ {{ $tuNgay }} đến {{ $denNgay }}</p>
    @else
        <p><strong>Thời gian:</strong> Tất cả</p>
    @endif
    <p><strong>Tổng đơn hàng:</strong> {{ count($dhs) }}</p>
    <p><strong>Tổng doanh thu:</strong> {{ number_format($dhs->sum('TongTienThanhToan'), 0, ',', '.') }}đ</p>
    
    <p><strong>Danh sách đơn hàng:</strong></p>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Ngày lập</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dhs as $index => $dh)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dh->id }}</td>
                    <td>{{ $dh->NgayLap }}</td>
                    <td>{{ $dh->hopDong->phieuDatHang->TenKhachHang ?? 'N/A' }}</td>
                    <td>{{ number_format($dh->TongTienThanhToan, 0, ',', '.') }}đ</td>
                    <td>{{ $dh->TrangThai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>
