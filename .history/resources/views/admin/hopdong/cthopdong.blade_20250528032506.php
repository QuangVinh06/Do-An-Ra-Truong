<!-- resources/views/contracts/show.blade.php -->
@extends('Master.main')
@section('tittle','Quản lý chi tiết hợp đồng')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Chi tiết hợp đồng</h4>
            <a href="{{ route('QLhopdong.index') }}" class="btn btn-outline-secondary">Quay lại</a>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Mã phiếu đặt:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $hd->phieuDatHang->id   }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Tổng tiền hàng:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{$hd->phieuDatHang->TongTien  }} VNĐ
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Trạng thái cọc:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $hd->TrangThaiCoc }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Tên khách hàng:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $hd->phieuDatHang->khachHang->user->name ?? '' }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Tổng giá trị hợp đồng:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $hd->GiaTriGocHopDong ?? 0 }} VNĐ
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Tiền cọc:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $hd->TienCoc ?? 0 }} VNĐ
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col" class="text-center">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hd->phieuDatHang->chiTietPhieuDat  as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->sanPham->TenGoi }}</td>
                            <td>{{ $item->SoLuong }}</td>
                            <td>{{ $item->DonGia }} VNĐ</td>
                            <td>{{ $item->ThanhTien}} VNĐ</td>
                        </tr>
                      
                       
                        @endforeach
                    </tbody>
                </table>
            </div>

            
        </div>
    </div>
</div>


@endsection
