@extends('client.index')
@section('tittle','Trang thanh toán')
@section('main')
<div class="card-body">
    <a href="{{ route('thanhtoan.index') }}" class="btn btn-outline-secondary">Quay lại</a>
    <hr>
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0"style="margin-left:100px">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông tin phiếu đặt</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary">
                            <strong>Mã phiếu đặt:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="text-dark">{{ $hd->phieuDatHang->id }}</span>
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary">
                            <strong>Tiền hàng:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="text-success fw-bold">{{ number_format($hd->phieuDatHang->TongTien, 0, ',', '.') }} VNĐ</span>
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary">
                            <strong>Thuế:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="text-dark">{{ $hd->Thue }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card shadow-sm border-0" style="width:400px">
                <div class="card-header bg-success text-white" >
                    <h5 class="mb-0">Thông tin thanh toán</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <p class="mb-0">
                            <strong class="text-secondary">Giá trị gốc đặt hàng:</strong>
                            <span id="hienThiGiaTri" class="text-success fw-bold">{{ number_format($hd->GiaTriGocHopDong, 0, ',', '.') }} đ</span>
                        </p>
                        <p class="mb-0">
                            <strong class="text-secondary">Số tiền còn lại cần thanh toán:</strong>
                            <span id="hienThiGiaTri" class="text-success fw-bold">{{ number_format($hd->TongSoTienConLai, 0, ',', '.') }} đ</span>
                        </p>
                        <p class="mb-0">
                            <strong class="text-secondary">Phương thức thanh toán:</strong>
                            <span id="hienThiGiaTri" class="text-success fw-bold">{{$hd->phieuDatHang->phuongthuc->TenPhuongThucThanhToan   }}</span>
                        </p>
                    </div>
    
                   
                </div>
            </div>
        </div>
    </div>
<hr>
<div class="table-responsive mx-auto" style="max-width: 900px;">
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary">
                    <th scope="col" style="width:50px"class="text-center">STT</th>
                    <th scope="col"style="width:100px">Tên sản phẩm</th>
                    <th scope="col"style="width:100px">Số lượng</th>
                    <th scope="col" style="width:100px">Giá</th>
                    <th scope="col"style="width:100px">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hd->phieuDatHang->chiTietPhieuDat  as $index => $item)
                <tr>
                    <td class="text-center"style="width:100px">{{ $index + 1 }}</td>
                    <td style="width:100px">{{ $item->sanPham->TenGoi }}</td>
                    <td style="width:100px">{{ $item->SoLuong }}</td>
                    <td style="width:100px">{{ $item->DonGia }} VNĐ</td>
                    <td style="width:150px">{{ $item->ThanhTien}} VNĐ</td>
                </tr>
              
               
                @endforeach
            </tbody>
        </table>
    </div>

    
</div>
@endsection