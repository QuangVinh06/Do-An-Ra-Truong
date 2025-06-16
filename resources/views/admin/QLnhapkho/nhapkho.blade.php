@extends('Master.main')

@section('main')


<div class="container mt-4">
    <h1 class="mb-4">Quản lý nhập kho</h1>
    <a href="" class="btn btn-primary">Quay lại</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <form action="{{ route('ThemPhieuNhapKho.store') }}" method="POST" id="nhapKhoForm">
        @csrf
        
        <div class="row mb-3">
            <div class="col-md-6">
                
                <div class="form-group mb-3">
                    <label for="MaKho">Kho</label>
                    <select class="form-control" id="MaKho" name="MaKho" required>
                        <option value="">-- Chọn kho --</option>
                        @foreach($KhoList as $kho)
                            <option value="{{ $kho->id }}">{{ $kho->TenKho }}</option>
                        @endforeach
                    </select>
                    @error('MaKho') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="GhiChu">Ghi chú</label>
                    <textarea class="form-control" id="GhiChu" name="GhiChu"></textarea>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="NguoiGiaoHang">Người giao</label>
                    <input type="text" class="form-control" id="NguoiGiaoHang" name="NguoiGiaoHang" required>
                    @error('NguoiGiaoHang') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="card mb-3">
                    <div class="card-header">Thêm sản phẩm</div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="MaSanPham">Mã sản phẩm</label>
                            <select class="form-control" id="MaSanPham">
                                <option value="">-- Chọn sản phẩm --</option>
                                @foreach($SanPhamList as $sp)
                                    <option value="{{ $sp->MaSanPham }}">{{ $sp->TenGoi }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="SoLuong">Số lượng</label>
                            <input type="number" class="form-control" id="SoLuong" min="1">
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary" id="btnThemSanPham">Thêm</button>
                            <button type="button" class="btn btn-warning" id="btnSuaSanPham" style="display: none;">Sửa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 36px"> <button type="submit" class="btn btn-success mt-3">Lưu phiếu nhập kho</button></div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="chiTietTable">
                  
                </tbody>
            </table>
        </div>
        
       
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        let editRowIndex = null;
        let rowCount = 0;
        
        // Xử lý khi chọn kho
        $('#MaKho').change(function() {
            const maKho = $(this).val();
            if (maKho) {
                // Ở đây có thể gọi AJAX để lấy thông tin Kho nếu cần
                // Ví dụ lấy địa chỉ kho và hiển thị vào ô DiaChi
            }
        });
        
        // Nút thêm sản phẩm
        $('#btnThemSanPham').click(function() {
            const maSanPham = $('#MaSanPham').val();
            const soLuong = $('#SoLuong').val();
            
            if (!maSanPham || !soLuong || soLuong <= 0) {
                alert('Vui lòng chọn sản phẩm và nhập số lượng hợp lệ');
                return;
            }
            
            // Lấy thông tin sản phẩm
            const tenSanPham = $('#MaSanPham option:selected').text();
            
            rowCount++;
            const newRow = `
                <tr>
                    <td>${rowCount}</td>
                    <td>${maSanPham}
                        <input type="hidden" name="san_pham[${rowCount}][MaSanPham]" value="${maSanPham}">
                    </td>
                    <td>${tenSanPham}
                    <td>
                        ${soLuong}
                        <input type="hidden" name="san_pham[${rowCount}][SoLuong]" value="${soLuong}">
                    </td>
                    <td>Thùng</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning edit-item" data-index="${rowCount}">Sửa</button>
                        <button type="button" class="btn btn-sm btn-danger delete-item" data-index="${rowCount}">Xóa</button>
                    </td>
                </tr>
            `;
            
            $('#chiTietTable').append(newRow);
            resetForm();
        });
        
        // Sửa dòng chi tiết
        $(document).on('click', '.edit-item', function() {
            editRowIndex = $(this).data('index');
            const row = $(this).closest('tr');
            
            const maSanPham = row.find('input[name^="san_pham"][name$="[MaSanPham]"]').val();
            const soLuong = row.find('input[name^="san_pham"][name$="[SoLuong]"]').val();
            
            $('#MaSanPham').val(maSanPham);
            $('#SoLuong').val(soLuong);
            
            $('#btnThemSanPham').hide();
            $('#btnSuaSanPham').show();
        });
        
        // Cập nhật sửa đổi
        $('#btnSuaSanPham').click(function() {
            if (editRowIndex !== null) {
                const maSanPham = $('#MaSanPham').val();
                const soLuong = $('#SoLuong').val();
                
                if (!maSanPham || !soLuong || soLuong <= 0) {
                    alert('Vui lòng chọn sản phẩm và nhập số lượng hợp lệ');
                    return;
                }
                
                const tenSanPham = $('#MaSanPham option:selected').text().split(' - ')[1];
                const row = $(`tr:has(button[data-index="${editRowIndex}"])`);
                
                row.find('td:eq(1)').html(`${maSanPham}<input type="hidden" name="san_pham[${editRowIndex}][MaSanPham]" value="${maSanPham}">`);
                row.find('td:eq(2)').text(tenSanPham);
                row.find('td:eq(3)').html(`${soLuong}<input type="hidden" name="san_pham[${editRowIndex}][SoLuong]" value="${soLuong}">`);
                
                resetForm();
                $('#btnThemSanPham').show();
                $('#btnSuaSanPham').hide();
                editRowIndex = null;
            }
        });
        
        // Xóa dòng chi tiết
        $(document).on('click', '.delete-item', function() {
            $(this).closest('tr').remove();
            updateRowNumbers();
        });
        
        // Cập nhật lại số thứ tự
        function updateRowNumbers() {
            let counter = 1;
            $('#chiTietTable tr').each(function() {
                $(this).find('td:first').text(counter);
                counter++;
            });
            rowCount = counter - 1;
        }
        
        // Reset form thêm sản phẩm
        function resetForm() {
            $('#MaSanPham').val('');
            $('#SoLuong').val('');
        }
        
        // Kiểm tra trước khi submit form
        $('#nhapKhoForm').submit(function(e) {
            if ($('#chiTietTable tr').length === 0) {
                e.preventDefault();
                alert('Vui lòng thêm ít nhất một sản phẩm vào phiếu nhập kho');
            }
        });
    });
</script>

@endsection


