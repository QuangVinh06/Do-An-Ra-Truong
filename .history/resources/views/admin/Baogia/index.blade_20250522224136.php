@extends('Master.main')
@section('tittle','Quản lý báo gia')
@section('main')

<div class="container mt-4">
    <h4 class="mb-3">Quản lý bảng báo giá</h4>

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
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            {{ isset($banggia) ? 'Sửa bảng giá' : 'Thêm báo giá' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($banggia) ? route('Baogia.update', $banggia->id) : route('Baogia.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($banggia))
                    @method('PUT')
                @endif
           
                <div class="mb-3">
                    <label for="idSanPham" class="form-label">Sản phẩm</label>
                    <select id="idSanPham" name="idSanPham" class="form-select" required>
                        <option value="" selected>--Sản phẩm--</option>
                        @foreach ($sps as $sp)
                            <option value="{{ $sp->id }}" {{ isset($banggia) && $banggia->idSanPham == $sp->id ? 'selected' : '' }}>
                                {{ $sp->TenGoi }}
                            </option>
                        @endforeach       
                    </select>
                </div>
                
                
                <div class="mb-3">
                    <label for="Gia" class="form-label">Giá</label>
                    <input type="text" id="Gia" name="Gia" class="form-control" value="{{ $banggia->Gia ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="TenGoi" class="form-label">Ghi chú</label>
                    <input type="text" id="GhiChu" name="GhiChu" class="form-control" value="{{ $banggia->GhiChu ?? '' }}" required>
                </div> 
                <button type="submit" class="btn btn-primary">{{ isset($banggia) ? 'Sửa' : 'Thêm' }} bảng giá</button>
                @if(isset($banggia))
                    <a href="{{ route('Baogia.index') }}" class="btn btn-secondary">Hủy</a>
                @endif
                
            </form>
        </div>
    </div>

    <!-- Danh sách  -->
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách bảng báo giá sản phẩm
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-success">
                    <tr>
                        <th>Ngày lập</th>                       
                        <th>Tên sản phẩm </th>
                        <th>Giá</th>
                        <th>Ghi Chú</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bg as $index => $c)
                        <tr>
                            <td>{{ $c->NgayLap }}</td>
                            <td>{{ $c->sanpham->TenGoi }}</td>
                            <td>{{ $c->Gia }}</td>
                            <td>{{ $c->GhiChu }}</td>
                            <td>
                               
                                <form action="{{ route('Baogia.destroy', $c->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
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


<script>
    function previewImage(event) {
        let input = event.target;
        let preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            let reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block"; // Hiện ảnh khi đã chọn file
            }
            
            reader.readAsDataURL(input.files[0]); // Đọc file ảnh
        } else {
            preview.style.display = "none"; // Ẩn nếu không có ảnh
        }
    }

    function submitForm(action) {
    let form = document.getElementById('colorForm');
    let editmethod = document.getElementById('editmethod'); // Lấy input ẩn
    let MaMau = document.querySelector('input[name="MaMau"]').value;
    if (action === 'add') {
        form.action = "{{ route('color.store') }}"; // Route thêm mới

    } else if (action === 'edit') {
        editmethod.value = "PUT"; // Khi bấm sửa thì chuyển sang PUT
        form.action = "{{ route('color.update', ':id') }}".replace(':id',MaMau); // Thay :id bằng mã màu // Route cập nhật
    }

    form.submit();
}

function editColor(maMau, tenMau, hinhAnh) {
    let maMauInput = document.querySelector('input[name="MaMau"]'); //lay the ma mau
    let tenMauInput = document.querySelector('input[name="TenMau"]');
    let preview = document.getElementById('preview');
    maMauInput.value = maMau;//gán values cho the ma mau 
    maMauInput.readOnly = true; // Không cho sửa mã màu khi cập nhật
    tenMauInput.value = tenMau;
    preview.src = hinhAnh;
   
    preview.style.display = "block";
}

</script>



