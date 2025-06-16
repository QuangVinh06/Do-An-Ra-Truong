@extends('Master.main')

@section('main')
<div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Danh Sách Sản Phẩm</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chiTietDonHang as $index => $sp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sp->sanPham->TenGoi }}</td>
                            <td>{{ $sp->SoLuong }}</td>
                            <td>{{ $sp->sanPham->banggia->Gia }}</td>
                            <td>{{ $sp->SoLuong * $sp->sanPham->banggia->Gia }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection