@extends('Master.main')

@section('main')
<h2 class="text-center mb-4 text-primary">Quản lý xuất kho</h2>
<div class="container mt-5"> 
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif 
    <div class="card">
        <div class="card-header bg-primary text-white">
            Đơn hang cần xuất kho
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">  
                <thead class="table-success">  
                    <tr> 
                        <th>STT</th>  
                        <th>Mã đơn hàng</th>  
                        <th>Tổng tiền thanh toán</th>
                        <th>Hành động</th>
                    </tr>
                </thead>  
                <tbody>
                    @foreach ($donhangs as $index => $dh)
                    <tr>  
                        <td>{{ $index + 1 }}</td>  
                        <td>{{ $dh->id }}</td> 
                        <td class="text-end">{{ $dh->GiaTriGocHopDong }}</td>
                        <td>
                            <a href="{{ route('QLxuatkho.edit', $dh->id) }}" class="btn btn-primary btn-sm">Kiểm tra kho</a>
                            <a href="{{ route('xemdonhang', $dh->id) }}" class="btn btn-warning btn-sm">Chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    
    </div>
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Phiếu Xuất Kho
        </div>
        <div class="card-body">
            <form action="{{ route('QLxuatkho.index') }}" method="GET" class="d-flex mb-3">
                <input class="form-control me-2" type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </form> 
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">  
                <thead class="table-success">  
                    <tr>  
                        <th>STT</th>  
                        <th>Mã phiếu xuất</th>  
                        <th>Ngày lập</th>
                        <th>Người giao hàng</th>
                        <th>Tổng tiền thanh toán</th>
                        <th>Ghi chú</th> 
                        <th>Hành động</th>
                    </tr>  
                </thead>  
                <tbody> 
                    @foreach ($psks as $index => $psk)
                    <tr>  
                        <td>{{ $index + 1 }}</td>  
                        <td>{{ $psk->id }}</td>  
                        <td>{{ $psk->NgayLap }}</td>   
                        <td>{{ $psk->NguoiNhanHang }}</td>
                        <td class="text-end">{{ $psk->TongTien}}</td>  
                        <td>{{ $psk->GhiChu }}</td>  
                        <td>
                            <a href="{{ route('QLxuatkho.show',$psk->id) }}" class="btn btn-warning btn-sm">Chi tiết</a> 
                        </td>  
                    </tr>
                    @endforeach    
                </tbody>  
            </table>
        </div>
    </div>
</div>  


@endsection