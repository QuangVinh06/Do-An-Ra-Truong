@extends('Master.main')
@section('tittle','Quản lý khuyến mại')
@section('main')

<h2 class="text-center mb-4">Quản lý khuyến mãi</h2>

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

<div class="card p-4">
    <div class="card-header bg-primary text-white">
       
    </div>
    <form action="{{ isset($khuyenmai) ? route('QLkhuyenmai.update', $khuyenmai->id) : route('QLkhuyenmai.store') }}" method="POST">
        @csrf
        @if(isset($khuyenmai))
            @method('PUT')
        @endif

        <div class="row">
            <!-- Cột bên trái -->
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Mã khuyến mãi</label>
                    <input type="text" name="id" class="form-control" placeholder="Nhập mã khuyến mãi" value="{{ $khuyenmai->id ?? '' }}">
                </div>
                <div class="mb-2">
                    <label class="form-label">Tên khuyến mãi</label>
                    <input type="text" class="form-control" name="TenKhuyenMai" value="{{ $khuyenmai->TenKhuyenMai ?? '' }}" placeholder="Nhập tên khuyến mãi">
                </div>
                <div class="mb-2">
                    <label class="form-label">Giảm giá (%)</label>
                    <input type="number" class="form-control" name="GiamGia" value="{{ $khuyenmai->GiamGia ?? '' }}" placeholder="Nhập % giảm giá">
                </div>
            </div>

            <!-- Cột bên phải -->
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Trạng thái</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrangThai" value="1" {{ isset($khuyenmai) && $khuyenmai->TrangThai == 1 ? 'checked' : '' }}>
                            <label class="form-check-label">Đang diễn ra</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrangThai" value="0" {{ isset($khuyenmai) && $khuyenmai->TrangThai == 0 ? 'checked' : '' }}>
                            <label class="form-check-label">Tạm dừng</label>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label">Loại khách hàng</label>
                    <select name="idLoaiKhachHang" class="form-select" required>
                        <option selected disabled>Chọn loại khách hàng</option>
                        @foreach($loaiKhachHang as $lkh)
                            <option value="{{ $lkh->id }}" {{ isset($khuyenmai) && $khuyenmai->idLoaiKhachHang == $lkh->id ? 'selected' : '' }}>
                                {{ $lkh->TenLoaiKhachHang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
    <label class="form-label">Ngày bắt đầu</label>
    <input type="date" class="form-control" name="NgayBatDau" value="{{ $khuyenmai->NgayBatDau ?? '' }}">
</div>
<div class="mb-2">
    <label class="form-label">Ngày kết thúc</label>
    <input type="date" class="form-control" name="NgayKetThuc" value="{{ $khuyenmai->NgayKetThuc ?? '' }}">
</div>
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">{{ isset($khuyenmai) ? 'Cập nhật' : 'Thêm mới' }}</button>
            @if(isset($khuyenmai))
                <a href="{{ route('QLkhuyenmai.index') }}" class="btn btn-secondary">Hủy</a>
            @endif
        </div>
    </form>
</div>

<div class="card p-4 mt-4">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên khuyến mãi</th>
                <th>Giảm giá (%)</th>
                <th>Loại khách hàng</th>
                  <th>Ngày bắt đầu - Ngày kết thúc</th>
                <th>Trạng thái</th>
             
              
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($khuyenMai as $index => $km)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $km->TenKhuyenMai }}</td>
                <td>{{ $km->GiamGia }}%</td>
                <td>{{ $km->loaiKhachHang->TenLoaiKhachHang }}</td>
                <td>{{ $km->NgayBatDau}} - {{ $km->NgayKetThuc }}</td>
                <td>{{ $km->TrangThai ? 'Đang diễn ra' : 'Tạm dừng' }}</td>
                <td>
                    <form action="{{ route('QLkhuyenmai.edit', $km->id) }}" method="GET" style="display: inline;">
                       
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                  
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection