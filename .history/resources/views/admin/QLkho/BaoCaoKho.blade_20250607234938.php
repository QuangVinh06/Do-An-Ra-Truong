@extends('Master.main')

@section('main')
<div class="col-lg-10 col-md-9 content">
    <h4 class="content-header text-center mb-4 fw-bold">Báo cáo tổng hợp kho</h4>

    <form method="GET" action="{{ route('QLchitietkho.baocao') }}">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="warehouse" class="form-label">Kho</label>
                <select class="form-select" name="warehouse" id="warehouse">
                    <option value="0">Tất cả</option>
                    @foreach ($kho as $k)
                        <option value="{{ $k->id }}" {{ request('warehouse') == $k->id ? 'selected' : '' }}>
                            {{ $k->TenKho }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Từ ngày</label>
                <input type="date" class="form-control" name="from" value="{{ request('from') }}">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Đến ngày</label>
                <input type="date" class="form-control" name="to" value="{{ request('to') }}">
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3"></div>
            <div class="col-md-3 mb-3"></div>
            <div class="col-md-3 mb-3"></div>
            <div class="col-md-3 mb-3 d-flex align-items-end">
                <a href="{{ route('baocaokho', request()->query()) }}" target="_blank">
                    <button type="button" class="btn btn-warning w-100">Xuất PDF</button>
                </a>
            </div>
        </div>
    </form>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6 class="text-muted">Tổng hàng tồn kho</h6>
                    <h4 class="fw-bold text-success">{{ $tongTon }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6 class="text-muted">Tổng hàng hư hỏng</h6>
                    <h4 class="fw-bold text-danger">{{ $tongHuHong }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6 class="text-muted">Tổng hàng lỗi</h6>
                    <h4 class="fw-bold text-warning">{{ $tongHangLoi }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="table-section mt-4">
        <h5 class="fw-bold mb-3">Danh sách sản phẩm</h5>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
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
        </div>
    </div>
    <div class="table-section mt-4">
        <h5 class="mt-5 mb-3 fw-bold">Danh sách hư hỏng, lỗi</h5>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
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
                    @if ($item->TrangThai == 2)
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
                                @case(0) <span class="badge bg-danger">Hư hỏng</span> @break
                                @case(1) <span class="badge bg-warning text-dark">Thiếu hàng</span> @break
                                @case(2) <span class="badge bg-info text-dark">Thừa hàng</span> @break
                                @case(3) <span class="badge bg-secondary">Hàng lỗi</span> @break
                                @default <span class="badge bg-light text-dark">Không rõ</span>
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
