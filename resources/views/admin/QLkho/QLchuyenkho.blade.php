@extends('Master.main')

@section('main')
<h2 class="text-center mb-4 text-primary">Quản lý phiếu chuyển kho</h2>
<div class="container mt-5">  
    <div class="card"> 
        <div class="card-body">
            <form action="{{ route('QLphieuchuyenkho.index') }}" method="GET" class="d-flex mb-3">
                <input class="form-control me-2" type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
                <a href="{{ route('loadform') }}" class="btn btn-primary ms-2">Thêm phiếu chuyển kho</a> 
            </form> 
        </div>   
    </div>
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Phiếu Chuyển Kho
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">  
                <thead class="table-success">  
                    <tr>  
                        <th>STT</th>  
                        <th>Mã phiếu nhập</th>
                        <th>Ngày lập</th>  
                        <th>Chuyển từ kho</th>  
                        <th>Chuyển đến kho</th>  
                        <th>Người chuyển</th>  
                        <th>Ghi chú</th> 
                        <th>Hành động</th>
                    </tr>  
                </thead>  
                <tbody> 
                    @foreach ($pcks as $index => $pck)
                    <tr>  
                        <td>{{ $index + 1 }}</td>  
                        <td>{{ $pck->id }}</td>  
                        <td>{{ $pck->NgayLap }}</td>  
                        <td>{{ $pck->khoChuyen->TenKho }}</td>  
                        <td>{{ $pck->khoNhan->TenKho }}</td> 
                        <td>{{ $pck->NguoiChuyen }}</td> 
                        <td>{{ $pck->GhiChu }}</td>  
                        <td>
                            <a href="{{ route('QLphieuchuyenkho.show',$pck->id) }}" class="btn btn-warning btn-sm">Chi tiết</a> 
                            <a href="{{ route('QLphieuchuyenkho.edit', $pck->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                            <form action="{{ route('QLphieuchuyenkho.destroy', $pck->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này?');">
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