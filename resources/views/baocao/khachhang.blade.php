<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Báo cáo thống kê khách hàng</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #000; }
        h1 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Báo cáo thống kê khách hàng</h1>
    @if ($tuNgay && $denNgay)
        <p><strong>Thời gian:</strong> Từ {{ $tuNgay }} đến {{ $denNgay }}</p>
    @else
        <p><strong>Thời gian:</strong> Tất cả</p>
    @endif
    <p><strong>Tổng khach hàng:</strong> {{ count($khachhangs) }}</p>
    @foreach ($solungkhach as $kh)
        <p><strong>{{ $kh['LoaiKhachHang'] }}</strong>: {{ $kh['SoLuong']  }}</p>
    @endforeach
    <p><strong>Danh sách khách hàng:</strong></p>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên khách hàng</th>
                <th>Loại khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($khachhangs as $index => $kh)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kh->user->name}}</td>
                    <td>{{ $kh->loaikhachhang->TenLoaiKhachHang }}</td>
                    <td>{{ $kh->user->email}}</td>
                    <td>{{ $kh->SoDienThoai}}</td>
                    <td>{{ $kh->DiaChi}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>
