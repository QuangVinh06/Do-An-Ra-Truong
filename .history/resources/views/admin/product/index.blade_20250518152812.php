@extends('Master.main')
@section('title','Quản lý sản phẩm')
@section('main')
<div class="container mt-4">
    <h2 class="text-center mb-4 text-primary">Quản lý sản phẩm</h2>

    <form action="{{ isset($sanpham) ? route('MNproduct.update', $sanpham->id) : route('MNproduct.store') }}" method="POST" enctype="multipart/form-data">  
        @csrf
        @if(isset($sanpham))
            @method('PUT')
        @endif
        
        <div class="row">
            <div class="col-md-6">
                
                <div class="mb-2">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="TenGoi" value="{{ $sanpham->TenGoi ?? '' }}">
                </div>
                <div class="mb-2">
                    <label class="form-label">Loại sản phẩm</label>
                    <select class="form-select" name="idLoaiSanPham">
                        @foreach($LoaiSanPham as $lsp)
                            <option value="{{ $lsp->id }}" {{ isset($sanpham) && $sanpham->idLoaiSanPham == $lsp->id ? 'selected' : '' }}>
                                {{ $lsp->TenLoaiSanPham }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Mô tả</label>
                    <textarea class="form-control" name="MoTa">{{ $sanpham->MoTa ?? '' }}</textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label">Đơn vị tính</label>
                    <select class="form-select" name="idDonViTinh">
                        @foreach($DonViTinh as $dvt)
                            <option value="{{ $dvt->id }}" {{ isset($sanpham) && $sanpham->idDonViTinh == $dvt->id ? 'selected' : '' }}>
                                {{ $dvt->TenDonViTinh }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Chọn màu</label>
                    <select class="form-select" name="idMau">
                        @foreach($Mau as $m)
                            <option value="{{ $m->id }}" {{ isset($sanpham) && $sanpham->idMau == $m->id ? 'selected' : '' }}>
                                {{ $m->TenMau }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Ảnh</label>
                    <input type="file" class="form-control" name="HinhAnh">
                    @if(isset($sanpham) && $sanpham->HinhAnh)
                        <div class="mt-2">
                            <img src="{{ $sanpham->HinhAnh }}" width="100px">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">{{ isset($sanpham) ? 'Cập nhật' : 'Thêm mới' }}</button>
            @if(isset($sanpham))
                <a href="{{ route('MNproduct.index') }}" class="btn btn-secondary">Hủy</a>
            @endif
        </div>
    </form>

    <div class="mb-3">
        <input type="text" class="form-control w-25 d-inline" placeholder="Tìm kiếm theo tên">
        <button class="btn btn-secondary">Tìm kiếm</button>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Loại sản phẩm</th>
                <th>Ảnh</th>
                <th>Đơn vị tính</th>
                <th>Màu</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sps as $index => $sp)
            <tr>  
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sp->TenGoi }}</td>  
                <td>{{ $sp->MoTa }}</td>  
                <td>{{ $sp->loaiSanPham->TenLoaiSanPham }}</td>  
                <td><img src="{{ $sp->HinhAnh }}" width="100px"></td>  
                <td>{{ $sp->DonViTinh->TenDonViTinh }}</td>  
                <td>{{ $sp->Mau->TenMau }}</td> 
                
                <td>
                    <form action="{{ route('MNproduct.edit', $sp->id) }}" method="GET" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                    <form action="{{ route('MNproduct.destroy', $sp->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="btn btn-warning">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection


