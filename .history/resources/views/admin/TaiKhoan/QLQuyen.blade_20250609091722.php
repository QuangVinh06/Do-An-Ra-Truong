@extends('Master.main')

@section('main')
<div class="container mt-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-4 text-primary">Quản lý quyền</h2>

    <!-- Thông báo -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Thêm/Sửa  -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            {{ isset($quyen) ? 'Sửa quyền' : 'Thêm quyền' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($quyen) ? route('QLquyen.update', $quyen->id) : route('QLquyen.store') }}" method="POST">
                @csrf
                @if(isset($quyen))
                    @method('PUT')
                @endif
                <div class="form-group ">
                    <label for="TenQuyen" class="form-label">Tên quyền</label>
                    <input type="text" id="TenQuyen" name="TenQuyen" class="form-control" value="{{ $quyen->TenQuyen ?? '' }}" required>
                </div>
                <div class="form-group ">
                    
                   <div class="form-group">
    <div class="row">
        @foreach ($resources as $resource => $routes)
            <div class="col-md-3 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="routes[]" value="{{ implode(',', $routes) }}"
                        @if(isset($quyen) && in_array($resource, $rs ?? [], true)) checked @endif>
                    <label class="form-check-label">
                        {{ $resource }}
                    </label>
                </div>
            </div>
        @endforeach 
<div class="col-md-3 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="routes[]" value="loadform,xemdonhang,tongsoluong"
                    @if(isset($quyen) && in_array('loadform', $permission ?? [], true)) checked @endif>
                <label class="form-check-label">
                  themphieuchuyenkho
                </label>
            </div>

        </div>
        <div class="col-md-3 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="routes[]" value="qlphieudat.xacnhan"
                    @if(isset($quyen) && in_array('qlphieudat.xacnhan', $permission ?? [], true)) checked @endif>
                <label class="form-check-label">
                    Xác nhận phiếu đặt
                </label>
            </div>
        </div>
        <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="routes[]" value="QLKhachHang.baocao,QLKhachHang.xemctdonhang,QLKhachHang.donhang,baocaokhachhang,baocaodonhang"
                                @if(isset($quyen) && in_array('QLKhachHang.baocao', $permission ?? [], true)) checked @endif>
                            <label class="form-check-label">
                                Báo cáo khách hàng
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="routes[]" value="QLdonhang.baocao,QLdonhang.thanhtoan,baocaobanhang"
                                @if(isset($quyen) && in_array('QLdonhang.baocao', $permission ?? [], true)) checked @endif>
                            <label class="form-check-label">
                                Báo cáo doanh số
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="routes[]" value="QLsanpham.baoCaoSanPham,baocaosanpham"
                                @if(isset($quyen) && in_array('QLsanpham.baoCaoSanPham', $permission ?? [], true)) checked @endif>
                            <label class="form-check-label">
                                Báo cáo sản phẩm
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="routes[]" value="QLchitietkho.baocao,baocaokho"
                                @if(isset($quyen) && in_array('QLchitietkho.baocao', $permission ?? [], true)) checked @endif>
                            <label class="form-check-label">
                                Báo cáo kho
                            </label>
                        </div>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($quyen) ? 'Sửa' : 'Thêm' }} quyền</button>
                @if(isset($quyen))
                    <a href="{{ route('QLquyen.index') }}" class="btn btn-secondary">Hủy</a>
                @endif
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Quyền
        </div>
        <div class="card-body">
            <form action="{{ route('QLquyen.index') }}" method="GET" class="d-flex mb-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm..." value="{{ request('search') }}">

                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </form>
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>STT</th>
                        <th>Tên quyền</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $q)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $q->TenQuyen}}</td>
                            <td>
                                <a href="{{ route('QLquyen.edit', $q->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('QLquyen.destroy', $q->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa quyền này?');">
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
</div>
@endsection