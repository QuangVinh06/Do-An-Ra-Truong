@extends('Master.main')

@section('main')
<div >
    <!-- Tiêu đề -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center fw-bold text-primary">
                Thông tin xuất kho
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
    <form action="{{ route('QLxuatkho.store') }}" method="POST" id="formPhieuNhap">
        @csrf
        <div class="card border-0 shadow-sm mb-4">
            <!-- Form thêm thông tin phiếu nhập -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông Tin Phiếu Xuất Kho</h5>
                </div>
                <div class="card-body p-4">
                    <input type="hidden" name="idDonHang" value="{{ $donhang->id }}">
                    <div class="mb-3">
                        <label for="NguoiGiaoHang" class="form-label fw-semibold">Người Giao Hàng</label>
                        <input type="text" id="NguoiGiaoHang" name="NguoiGiaoHang" class="form-control" value="{{ $donhang->hopDong->NguoiGiaoHang }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="GhiChu" class="form-label fw-semibold">Ghi Chú</label>
                        <textarea id="GhiChu" name="GhiChu" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        <!-- Danh sách sản phẩm -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Danh Sách Sản Phẩm</h5>
            </div>
            <div class="card-body p-0">
                @php
                    $sanpham = session('dssanpham', []);
                    $kho = session('kho', []);
                @endphp
                @foreach ($sanpham as $index => $item)
                    <div style="padding: 20px;">
                        <label class="form-check form-check-inline">
                            <span class="form-check-label">{{ $item['TenSanPham'] }} - Số lượng: {{ $item['SoLuong'] }}</span>
                        </label>
                        <div>
                            @if ($sanpham[$index]['TrangThai'] == 'Không đủ hàng')
                                <span class="text-danger">Không đủ hàng</span>
                            @endif
                            @if ($item['TrangThai'] == 'Đủ hàng')
                                <select name="kho[]" class="form-select">
                                @foreach ($kho as $k)
                                    @if ($k['idSanPham'] == $item['idSanPham'])
                                        <option value="{{ $k['idKho'] }}">{{ $k['TenKho'] }}</option>
                                    @endif
                                @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('QLxuatkho.index') }}" class="btn btn-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Hủy
        </a>
        <button type="submit" class="btn btn-primary" form="formPhieuNhap"  >
            <i class="fas fa-save me-1"></i> Xác nhận
        </button>
    </div>
</div>
@endsection


