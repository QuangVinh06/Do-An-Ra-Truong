@extends('Master.main')

@section('main')
<div class="container-fluid py-4">
    <!-- Tiêu đề -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center fw-bold text-primary">
                Thêm Phiếu Nhập Kho
            </h2>
        </div>
    </div>

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

    <div class="row">
        <!-- Form thêm thông tin phiếu nhập -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông Tin Phiếu Nhập Kho</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('QLphieunhapkho.store') }}" method="POST" id="formPhieuNhap">
                        @csrf
                        <div class="mb-3">
                            <label for="idKho" class="form-label fw-semibold">Kho</label>
                            <select id="idKho" name="idKho" class="form-select" required>
                                <option value="" selected disabled>-- Chọn Kho --</option>
                                @foreach ($kho as $k)
                                    <option value="{{ $k->id }}">{{ $k->TenKho }}</option>
                                @endforeach  
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="NguoiGiaoHang" class="form-label fw-semibold">Người Giao Hàng</label>
                            <input type="text" id="NguoiGiaoHang" name="NguoiGiaoHang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="GhiChu" class="form-label fw-semibold">Ghi Chú</label>
                            <textarea id="GhiChu" name="GhiChu" class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Form thêm thông tin sản phẩm -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ isset($sanpham) ? 'Sửa Sản Phẩm' : 'Thêm Sản Phẩm'}}</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ isset($sanpham) ? route('QLchitietthemphieunhap.update', $key) : route('QLchitietthemphieunhap.store') }}" method="POST">
                        @csrf
                        @if (isset($sanpham))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="idSanPham" class="form-label fw-semibold">Sản Phẩm</label>
                            <select id="idSanPham" name="idSanPham" class="form-select" required>
                                <option value="" selected disabled>-- Chọn Sản Phẩm --</option>
                                @foreach ($sps as $sp)
                                    <option value="{{ $sp->id }}" {{ isset($sanpham) && $sanpham['idSanPham'] == $sp->id ? 'selected' : '' }}>{{ $sp->TenGoi }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="SoLuong" class="form-label fw-semibold">Số Lượng</label>
                            <input type="number" id="SoLuong" name="SoLuong" class="form-control" value="{{ isset($sanpham) ? $sanpham['SoLuong'] : '' }}" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($sanpham) ? 'Sửa' : 'Thêm' }} sản phẩm</button>
                        @if(isset($sanpham))
                            <a href="{{ route('QLchitietthemphieunhap.create') }}" class="btn btn-secondary">Hủy</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Danh Sách Sản Phẩm</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Loại Sản Phẩm</th>
                            <th>Màu</th>
                            <th>Số Lượng</th>
                            <th>Đơn Vị Tính</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $chiTietTemp = session('chi_tiet_nhap', []);
                        @endphp

                        @if(count($chiTietTemp) > 0)
                            @foreach($chiTietTemp as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $item['tenSanPham'] }}</td>
                                    <td>{{ $item['tenLoai'] }}</td>
                                    <td>{{ $item['tenMau'] }}</td>
                                    <td class="text-end">{{ $item['SoLuong'] }}</td>
                                    <td>{{ $item['tenDonVi'] }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('QLchitietthemphieunhap.edit', $item['idSanPham']) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <form action="{{ route('QLchitietthemphieunhap.destroy', $item['idSanPham']) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-box-open me-2 fs-4"></i>
                                    <p class="mb-0">Chưa có sản phẩm nào trong danh sách</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('QLphieunhapkho.index') }}" class="btn btn-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Hủy
        </a>
        <button type="submit" class="btn btn-primary" form="formPhieuNhap" 
                @if(!isset($chiTietTemp) || count($chiTietTemp) == 0) disabled @endif>
            <i class="fas fa-save me-1"></i> Lưu Phiếu Nhập Kho
        </button>
    </div>
</div>
@endsection


