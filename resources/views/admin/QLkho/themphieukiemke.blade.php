@extends('Master.main')

@section('main')
<div class="container-fluid py-4">
    <!-- Tiêu đề -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center fw-bold text-primary">
                Thêm Phiếu Kiểm Kê
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
                    <h5 class="mb-0">Thông Tin Phiếu Kiểm Kê</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('QLphieukiemke.store') }}" method="POST" id="formPhieuNhap">
                        @csrf
                        <div class="mb-3">
                            <label for="idKho" class="form-label fw-semibold">Kho: {{ $kho->TenKho }}</label>
                            <input type="hidden" id="idKho" name="idKho" value="{{ $kho->id }}">
                        </div>
                        <div class="mb-3">
                            <label for="NguoiKiemKe" class="form-label fw-semibold">Người Kiểm Kê</label>
                            <input type="text" id="NguoiKiemKe" name="NguoiKiemKe" class="form-control" required>
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
                    <form action="{{ isset($sanpham) ? route('QLctthemkiemke.update', $key) : route('QLctthemkiemke.store') }}" method="POST">
                        @csrf
                        @if (isset($sanpham))
                            @method('PUT')
                        @endif
                        <input type="hidden" id="idKho" name="idKho" value="{{ $kho->id }}">
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
                        <div class="mb-3">
                            <label for="TrangThai" class="form-label fw-semibold">Trạng thái</label>
                            <select id="TrangThai" name="TrangThai" class="form-select" required>
                                <option value="" selected disabled>-- Chọn Trạng Thái --</option>
                                <option value="0" {{ isset($sanpham) && $sanpham['TrangThai'] == 0 ? 'selected' : '' }}>Hư Hỏng</option>
                                <option value="1" {{ isset($sanpham) && $sanpham['TrangThai'] == 1 ? 'selected' : '' }}>Thiếu hàng so với số liệu</option>
                                <option value="2" {{ isset($sanpham) && $sanpham['TrangThai'] == 2 ? 'selected' : '' }}>Thừa hàng so với số liệu</option>
                                <option value="3" {{ isset($sanpham) && $sanpham['TrangThai'] == 3 ? 'selected' : '' }}>Hàng lỗi</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($sanpham) ? 'Sửa' : 'Thêm' }} sản phẩm</button>
                        @if(isset($sanpham))
                            <a href="{{ route('QLctthemkiemke.create') }}" class="btn btn-secondary">Hủy</a>
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
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $chiTietTemp = session('chi_tiet_kiemke', []);
                        @endphp

                        @if(count($chiTietTemp) > 0)
                            @foreach($chiTietTemp as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $item['tenSanPham'] }}</td>
                                    <td class="text-end">{{ $item['SoLuong'] }}</td>
                                    <td class="text-end">{{ $item['DonGia'] }}</td>
                                    <td class="text-end">{{ $item['DonGia']*$item['SoLuong'] }}</td>
                                    <td>
                                        @if ($item['TrangThai'] == 0)
                                            <span class="badge bg-danger">Hư Hỏng</span>
                                        @elseif ($item['TrangThai'] == 1)
                                            <span class="badge bg-warning">Thiếu hàng</span>
                                        @elseif ($item['TrangThai'] == 2)
                                            <span class="badge bg-info">Thừa hàng</span>
                                        @elseif ($item['TrangThai'] == 3)
                                            <span class="badge bg-secondary">Hàng lỗi</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('QLctthemkiemke.edit',$index) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <form action="{{ route('QLctthemkiemke.destroy', $index) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
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
        <a href="{{ route('QLphieukiemke.index') }}" class="btn btn-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Hủy
        </a>
        <button type="submit" class="btn btn-primary" form="formPhieuNhap" 
                @if(!isset($chiTietTemp) || count($chiTietTemp) == 0) disabled @endif>
            <i class="fas fa-save me-1"></i> Lưu Phiếu Kiểm Kê
        </button>
    </div>
</div>
@endsection
@section('script')
<script>
    document.getElementById('idKho').addEventListener('change', function() {
        let khoId = this.value;
        if (khoId) {
            fetch(`/getSanPhamByKho/${khoId}`)
                .then(response => response.json())
                .then(data => {
                    let selectSanPham = document.getElementById('idSanPham');
                    selectSanPham.innerHTML = '<option value="" selected disabled>-- Chọn Sản Phẩm --</option>';
                    data.forEach(sanpham => {
                        let option = document.createElement('option');
                        option.value = sanpham.id;
                        option.textContent = sanpham.TenGoi;
                        selectSanPham.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
@endsection
