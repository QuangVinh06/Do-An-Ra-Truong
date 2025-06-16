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
    <h1><strong>Thống kê sản phẩm bán chạy</strong></h1>
    @if ($tuNgay && $denNgay)
        <p><strong>Thời gian:</strong> Từ {{ $tuNgay }} đến {{ $denNgay }}</p>
    @else
        <p><strong>Thời gian:</strong> Tất cả</p>
    @endif
    <p><strong>Doanh thu:</strong> {{ number_format($doanhThuThang, 0, ',', '.') }} VNĐ</p>
    <p><strong>Tổng sản phẩm:</strong> {{ $tongSanPham }}</p>
    <p><strong>Sản phẩm bán chạy nhất:</strong> 
        @if ($sanPhamBanChay->first())
            {{ $sanPhamBanChay->first()->TenGoi }} -  {{ $sanPhamBanChay->first()->tong_so_luong }} sản phẩm đã bán
        @else
            Không có dữ liệu
        @endif
    </p>      
    <p><strong>Chi tiết sản phẩm bán chạy</strong></p>
    <table>
        <thead>
            <tr>
                <th>STT</th>
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
            @foreach ($sanPhamBanChay as $index => $sp)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $sp->TenGoi }}</td>
                <td>{{ $sp->TenLoaiSanPham }}</td>
                <td>{{ $sp->MoTa }}</td>
                <td>
                    {{ $sp->TenMau }}
                </td>
                <td>{{ $sp->TenDonViTinh }}</td>
                <td>{{ number_format($sp->tong_so_luong) }}</td>
                <td>{{ number_format($sp->tong_tien, 0, ',', '.') }} VNĐ</td>
            </tr>
            
            @endforeach

        </tbody>
    </table>
</body>
</html>