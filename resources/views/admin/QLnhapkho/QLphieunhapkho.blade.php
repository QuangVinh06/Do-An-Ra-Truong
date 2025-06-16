@extends('Master.main')

@section('main')
<div class="container mt-5">  
    <div class="row mb-1">  
        <form action="{{ route('QLphieunhapkho.index') }}" method="GET" class="search-form ">
            <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            <a href="{{ route('ThemPhieuNhapKho.index') }}" class="btn btn-primary">Thêm phiếu nhập kho</a> 
        </form>     
    </div> 
    <table class="table table-bordered">  
        <thead>  
            <tr>  
                <th>STT</th>  
                <th>Mã phiếu nhập</th>  
                <th>Ngày lập</th>  
                <th>Kho</th>  
                <th>Người giao hàng</th>  
                <th>Ghi chú</th>  
                <th></th>  
                <th></th>  
            </tr>  
        </thead>  
        <tbody> 
            @foreach ($pnks as $index => $pnk)
            <tr>  
                <td>{{ $index + 1 }}</td>  
                <td>{{ $pnk->id }}</td>  
                <td>{{ $pnk->NgayLap }}</td>  
                <td>{{ $pnk->kho->TenKho }}</td>  
                <td>{{ $pnk->NguoiGiaoHang }}</td>  
                <td>{{ $pnk->GhiChu }}</td>  
                <td>
                    <a href="{{ route('QLphieunhapkho.show',$pnk->id) }}" class="btn btn-primary">Chi tiết</a> 
                </td>  
                <td>
                    <form action="{{ route('QLphieunhapkho.destroy', $pnk->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Xóa</button>
                    </form>
                </td>  
            </tr>
            @endforeach    
        </tbody>  
    </table>  
</div>  


@endsection