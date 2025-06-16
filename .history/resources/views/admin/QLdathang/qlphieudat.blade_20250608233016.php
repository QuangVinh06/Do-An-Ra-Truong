@extends('Master.main')
@section('tittle','Quản lý phiếu đặt hàng')
@section('main')
<div class="container mt-5">  
    <div class="row mb-1">  
        <form action="{{ route('qlphieudat.index') }}" method="GET" class="search-form ">
            <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>     
    </div> 
    <table class="table table-bordered">  
        <thead>  
            <tr>  
                <th>STT</th>  
                <th>Mã phiếu đặt</th>  
                <th>Ngày lập</th>  
                <th>Ghi chú</th>  
                <th>Tên khách hàng</th>  
                <th>Trạng thái</th>  
                <th>Phương thức thanh toán</th>  
                <th>Số sp</th> 
                <th>Khuyến mãi</th>
               
                <th>Chi tiết phiếu nhập</th>
                <th style="width:200px">Thao tác</th>
            </tr>  
        </thead>  
        <tbody> 
            @foreach ($pds as $index => $pd)
            <tr>  
                <td>{{ $index + 1 }}</td>  
                <td>{{ $pd->id }}</td>  
                <td>{{ $pd->NgayLap }}</td>  
                <td>{{ $pd->GhiChu }}</td> 
                <td>{{ $pd->TenKhachHang}}</td> 
                <td>@if($pd->TrangThai==1)Đã xác nhận đặt hàng
                    @else Chưa xác nhận đặt hàng
                @endif </td>  
                <td>{{ $pd->phuongthuc->TenPhuongThucThanhToan }}</td> 
                <td>{{ $pd->TongSoLuong }}</td>
                <td>{{ $pd->khuyenmai ? $pd->khuyenmai->TenKhuyenMai : 'Chưa có khuyến mại' }}</td>
                <td>
                    <a href="{{ route('qlphieudat.show',$pd->id) }}" class="btn btn-primary">Chi tiết</a> 
                </td>  
                <td>
                    <form action="{{ route('qlphieudat.xacnhan', $pd->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xác nhận phiếu đặt này?');">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" style="height: 40px" {{ $pd->TrangThai !== 0 ? 'disabled' : '' }}>Xác nhận</button>
                    </form>
                    <form action="{{ route('qlphieudat.destroy', $pd->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa phiếu đặt này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success " >Xóa</button>
                    </form>
                 
                </td>  
                
            </tr>
            @endforeach    
        </tbody>  
    </table>
    <div class="d-flex justify-content-center">
        {{ $pds->links('pagination::bootstrap-5') }}
    </div>  
</div>
@endsection
