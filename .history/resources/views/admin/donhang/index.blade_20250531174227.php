@extends('Master.main')
@section('tittle','Quản lý đơn hàng ')
@section('main')
<div class="container mt-5">  
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif



<div class="card-body">
    
    <h2 class="text-center mb-4 text-primary">DANH SÁCH ĐƠN HÀNG</h2>

    <div class="row mb-1">  
        <form action="{{ route('QLdonhang.index') }}" method="GET" class="search-form ">
            <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>     
    </div> 

    <table class="table table-bordered">  
        <thead>  
            <tr>  
                <th>STT</th>  
                 <th>Ngày lập</th>
                 <th>Mã hợp đồng</th>  
                <th>Tổng tiền thanh toán</th>  
                <th>Trạng thái</th>  
                <th>Chi tiết đơn hàng</th>
                <th>Thanh toán giao hàng </th>
            </tr>  
        </thead>  
        <tbody> 
            @foreach ($dhs as $index => $dh)
            <tr>  
                <td>{{ $index + 1 }}</td>  
                <td>{{ $dh->NgayLap }}</td>  
                <td>{{ $dh->idHopDong }}</td>  
                <td>{{ $dh->TongTienThanhToan }}</td> 
                <td>{{ $dh->TrangThai }}</td> 
             
                <td class="text-center">
                    <a href="{{ route('QLdonhang.show',$dh->id) }}" class="btn btn-primary">Chi tiết</a> 
                   
                </td>  
                <td>
                @if($dh->hopDong->TongSoTienConLai > 0&&$dh->hopDong->phieuDatHang->phuongthuc->TenPhuongThucThanhToan == 'Thanh toán trực tiếp')
                <form action="{{ route('QLdonhang.thanhtoan', $dh->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn đã nhận thanh toán?');">
                    @csrf
                    <button type="submit" class="btn btn-success">Đã nhận thanh toán</button>
                </form>
                @else 
                <span> Đã hoàn tất tổng tiền</span>
                @endif
                </td>    
                  
                    {{-- <form action="{{ route('QLdonhang.xacnhan', $dh->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xác nhận phiếu đặt này?');">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" {{ $dh->TrangThai !== 0 ? 'disabled' : '' }}>Xác nhận</button>
                    </form> --}}
           
                
            </tr>
            @endforeach    
        </tbody>  
    </table>  
</div>
<div class="d-flex justify-content-center">
    {{ $dhs->links('pagination::bootstrap-5') }}
</div>
@endsection