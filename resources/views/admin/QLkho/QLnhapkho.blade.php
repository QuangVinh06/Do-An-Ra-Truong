@extends('Master.main')

@section('main')
<h2 class="text-center mb-4 text-primary">Quản lý phiếu nhập kho</h2>
<div class="container mt-5">  
    <div class="card"> 
        <div class="card-body">
            <form action="{{ route('QLphieunhapkho.index') }}" method="GET" class="d-flex mb-3">
                <input class="form-control me-2" type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
                <a href="{{ route('QLphieunhapkho.create') }}" class="btn btn-primary ms-2">Thêm phiếu nhập kho</a> 
            </form> 
        </div>   
    </div>
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Phiếu Nhập Kho
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">  
                <thead class="table-success">  
                    <tr>  
                        <th>STT</th>  
                        <th>Mã phiếu nhập</th>  
                        <th>Ngày lập</th>  
                        <th>Kho</th>  
                        <th>Người giao hàng</th>  
                        <th>Ghi chú</th> 
                        <th>Hành động</th>
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
                            <a href="{{ route('QLphieunhapkho.show',$pnk->id) }}" class="btn btn-warning btn-sm">Chi tiết</a> 
                            <a href="{{ route('QLphieunhapkho.edit', $pnk->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                            <form action="{{ route('QLphieunhapkho.destroy', $pnk->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>  
                    </tr>
                    @endforeach    
                </tbody>  
            </table>
        </div>
    </div>
</div>  


@endsection