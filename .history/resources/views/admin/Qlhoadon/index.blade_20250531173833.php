@extends('Master.main')
@section('tittle','Quản lý hoá đơn')
@section('main')

<h4 class="mb-3">Quản lý hoá đơn</h4>
<div class=" justify-content-between mb-3">
    <div>
        <form action="{{ route('Qlhoadon.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm theo mã hợp đồng hoặc mã giao dịch" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
        </form>
    </div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã giao dịch</th>
            <th>Ngày lập</th> 
            <th class="text-center">Mã hợp đồng</thhoá>
            <th>Loại thanh toán</th>
            <th>Ngân hàng</th>
            <th>Số tiền</th>
            <th class="text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $Model)
            <tr>
                <td>{{ $loop ->index + 1 }}</td>
                <td> {{ $Model->MaGiaoDich }}</td>
                <td>{{ $Model ->NgayLap }}</td>
                <td class="text-center">{{ $Model ->idHopDong }}</td>   
                <td>{{ $Model ->LoaiThanhToan }}</td>
                <td>{{ $Model ->PhuongThuc }}</td>
                <td>{{ $Model ->SoTienThanhToan }}</td>                

                <td class ="col-2 text-center">
                    
                   
                    </form>
                    <form action="{{ route('Qlhoadon.destroy', $Model->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $donHangs->links('pagination::bootstrap-5') }}
        </div>
        
            
</table>
@endsection
