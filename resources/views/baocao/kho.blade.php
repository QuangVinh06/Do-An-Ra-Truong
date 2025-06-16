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
        h4 { text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Báo cáo tổng hợp kho</h1>
    <p>Tổng hàng tồn kho: {{ $tongTon }}</p>           
    <p>Tổng hàng hư hỏng: {{ $tongHuHong }}</p>
    <p>Tổng hàng lỗi: {{ $tongHangLoi }}</p>
    <h4>Danh sách sản phẩm</h4>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Màu</th>
                <th>Đơn vị tính</th>
                <th>Số lượng tồn</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sanPhamThongKe as $index => $sp)
            @if ($sp->so_luong <= 0)
                @continue
            @endif
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $sp->ten_san_pham }}</td>
                <td>{{ $sp->loai }}</td>
                <td>{{ $sp->mau }}</td>
                <td>{{ $sp->don_vi }}</td>
                <td>{{ $sp->so_luong }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>  
<h4>Danh sách hư hỏng, lỗi</h4>
    <table>
        <thead>
            <tr>
                <th>Ngày</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Màu</th>
                <th>Đơn vị</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kiemKeChiTiet as $item)
                @if ($item->TrangThai == 1 || $item->TrangThai == 2)
                    @continue
                @endif
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->NgayLap)->format('d/m/Y') }}</td>
                    <td>{{ $item->ten_san_pham }}</td>
                    <td>{{ $item->loai }}</td>
                    <td>{{ $item->mau }}</td>
                    <td>{{ $item->don_vi }}</td>
                    <td>{{ $item->SoLuong }}</td>
                    <td>
                        @switch($item->TrangThai)
                            @case(0) <span >Hư hỏng</span> @break
                            @case(1) <span >Thiếu hàng</span> @break
                            @case(2) <span >Thừa hàng</span> @break
                            @case(3) <span >Hàng lỗi</span> @break
                            @default <span >Không rõ</span>
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>