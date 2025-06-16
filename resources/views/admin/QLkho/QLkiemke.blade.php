@extends('Master.main')

@section('main')
<h2 class="text-center mb-4 text-primary">Quản lý phiếu kiểm kê</h2>
<div class="container mt-5">  
    <div class="card">
        <div class="card-header bg-primary text-white">
            Chọn kho kiểm kê
        </div>
        <div class="card-body">
            <form action="{{ route('QLphieukiemke.create') }}" method="GET" class="d-flex mb-3">
                <select id="kho" name="kho" class="form-select" required>
                    <option value="" selected disabled>-- Chọn kho --</option>
                    @foreach ($ks as $k)
                        <option value="{{ $k->id }}" >{{ $k->TenKho }}</option>
                    @endforeach 
                </select>
                <button type="submit" class="btn btn-success">Thêm phiếu kiểm kê</button>
            </form>
        </div>    
    </div>
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Phiếu Kiểm Kê
        </div>
        <div class="card-body">
            <form action="{{ route('QLphieukiemke.index') }}" method="GET" class="d-flex mb-3">
                <input class="form-control me-2" type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </form> 
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">  
                <thead class="table-success">  
                    <tr>  
                        <th>STT</th>  
                        <th>Mã phiếu kiểm kê</th>  
                        <th>Ngày lập</th>  
                        <th>Kho</th>  
                        <th>Người kiểm kê</th>  
                        <th>Ghi chú</th> 
                        <th>Hành động</th>
                    </tr>  
                </thead>  
                <tbody> 
                    @foreach ($pkks as $index => $pkk)
                    <tr>  
                        <td>{{ $index + 1 }}</td>  
                        <td>{{ $pkk->id }}</td>  
                        <td>{{ $pkk->NgayLap }}</td>  
                        <td>{{ $pkk->kho->TenKho }}</td>  
                        <td>{{ $pkk->NguoiKiemKe }}</td>  
                        <td>{{ $pkk->GhiChu }}</td>  
                        <td>
                            <a href="{{ route('QLphieukiemke.show',$pkk->id) }}" class="btn btn-warning btn-sm">Chi tiết</a> 
                            <a href="{{ route('QLphieukiemke.edit', $pkk->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                            <form action="{{ route('QLphieukiemke.destroy', $pkk->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này?');">
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