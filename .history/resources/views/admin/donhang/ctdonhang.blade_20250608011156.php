
@extends('Master.main')
@section('tittle','Quản lý chi tiết đơn hàng')

@section('main')

    <div class="container">
        <!-- Header -->
        <a href="{{ route('QLdonhang.index') }}" class="btn btn-outline-secondary">Quay lại</a>
        <hr>        
        <!-- Thông tin khách hàng -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user me-2"></i> Thông tin khách hàng
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 35%;">Họ tên</th>
                       <td> {{ $dh->hopDong->phieuDatHang->TenKhachHang  }}</td> 
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td> {{ $dh->hopDong->phieuDatHang->SoDienThoai }}</td> 
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td> {{ $dh->hopDong->phieuDatHang->DiaChi}}</td> 
                    </tr>
                    <tr>
                        <th>Loại khách hàng</th>
                        <td> {{ $dh->hopDong->phieuDatHang->LoaiKhachHang  }}</td> 
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- Thông tin sản phẩm -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-shopping-cart me-2"></i> Thông tin sản phẩm
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 60px;" class="text-center">STT</th>
                                <th>Tên sản phẩm</th>
                                <th style="width: 100px;" class="text-center">Số lượng</th>
                                <th style="width: 150px;" class="text-center">Tiền hàng</th>
                                <th style="width: 150px;" class="text-center">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Hàng trống -->
                            @foreach($dh->hopDong->phieuDatHang->chiTietPhieuDat  as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $item->sanPham->TenGoi }}</td>
                                <td>{{ $item->SoLuong }}</td>
                                <td>{{ $item->DonGia }} VNĐ</td>
                                <td>{{ $item->ThanhTien}} VNĐ</td>
                            </tr>
                                                 
                        @endforeach
                           
                         
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                            <td colspan="3" class="text-end">
                                <strong>Thuế:</strong>
                            </td>
                            <td colspan="3" class="text-right">
                                <strong id="totalAmount">{{ $dh->hopDong->Thue }}%</strong>
                            </td>
                            </tr>
                            <tr class="total-row">
                               
                                <td colspan="3" class="text-end">
                                    <strong>Khuyến mại:</strong>
                                </td>
                                @php
                                    $tongTienHang = $dh->hopDong->phieuDatHang->chiTietPhieuDat->sum('ThanhTien');
                                    $tongThanhToan = $dh->TongTienThanhToan;
                                    $tienGiam = $tongTienHang - $tongThanhToan;
                                    $khuyenMai = optional(optional($dh->hopDong->phieuDatHang->loaiKhachHang)->khuyenMai);
                                    $giamGia = $khuyenMai->GiamGia ?? 0;
                                @endphp


                                    <td colspan="3" class="text-end">
                                        <strong>{{ number_format($tienGiam) }} VND (Giảm {{ $giamGia }}%)</strong>                                        
                                    </td>                                    
                               
                            </tr>

                            <tr class="total-row">
                               
                                <td colspan="3" class="text-end">
                                    <strong>Tổng tiền:</strong>
                                </td>
                                <td colspan="3" class="text-right">
                                    <strong id="totalAmount">{{ $dh->TongTienThanhToan}}</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
       
        
        
    </div>
@endsection

