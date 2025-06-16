<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng của {{ $email }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .column {
            width: 48%;
        }
    </style>
</head>
<body>
    @php
        $khachHang = $donHangs->first()->hopDong->phieuDatHang ?? null;
    @endphp
    <h2>Danh sách đơn hàng của {{ $khachHang->TenKhachHang }}</h2>
    @foreach ($donHangs as $index=>$dh )
        <hr>
        <h3>Đơn hàng {{ $index + 1 }}</h3>
        
                <p><strong>Ngày lập:</strong> {{ \Carbon\Carbon::parse($dh->NgayLap)->format('d/m/Y') }}</p>
                
                <p><strong>Trạng thái:</strong> {{ $dh->TrangThai }}</p>
            
                <p><strong>Tiền Hàng:</strong> {{ number_format($dh->hopDong->phieuDatHang->chiTietPhieuDat->sum('ThanhTien'), 0, ',', '.') }}đ</p>
                <p><strong>Thuế:</strong> {{ $dh->hopDong->Thue}}%</p>
                @php
                    $tongTienHang = $dh->hopDong->phieuDatHang->chiTietPhieuDat->sum('ThanhTien');
                    $tongThanhToan = $dh->TongTienThanhToan;
                    $tienthue = $dh->hopDong->Thue;
                    $tienGiam = $tongThanhToan - $tongTienHang - ($tongTienHang * $tienthue / 1000);
                @endphp
                <p><strong>Khuyến mãi:</strong> {{ number_format($tienGiam, 0, ',', '.') }}đ</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($dh->hopDong->GiaTriGocHopDong, 0, ',', '.') }}đ</p>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $dsChiTiet = $chiTietTheoDonHang[$dh->id] ?? []; @endphp
                @forelse ($dsChiTiet as $i => $chiTiet)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $chiTiet['SanPham'] }}</td>
                        <td>{{ $chiTiet['SoLuong'] }}</td>
                        <td>{{ number_format($chiTiet['DonGia'], 0, ',', '.') }}đ</td>
                        <td>{{ number_format($chiTiet['ThanhTien'], 0, ',', '.') }}đ</td>
                    </tr>
                @empty
                    <tr><td colspan="5">Không có chi tiết đơn hàng</td></tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
    
</body>
</html>
