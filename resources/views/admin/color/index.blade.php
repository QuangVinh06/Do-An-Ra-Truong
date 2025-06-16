@extends('Master.main')
@section('tittle','Quản lý bảng màu')
@section('main')

<div class="container mt-4">
    <h4 class="mb-3 text-center mb-4 text-primary">Quản lý bảng màu</h4>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
        @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
   <form id="colorForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="editmethod" value="POST"> 
    <div class="row">
        <div class="col-md-6">
            <div class="mb-2">
                <label for="" class="form-label">Mã màu</label>
                <input type="text" class="form-control" name="id">
                @error('id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-2">
                <label for="" class="form-label">Tên màu</label>
                <input type="text" class="form-control" name="TenMau">
                @error('TenMau')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-2">
                <label for="" class="form-label">Ảnh</label>
                <input id="filepath" type="file" class="form-control" name="HinhAnh" id="image" onchange="previewImage(event)">
                <br>
                <img id="preview" src="" width="100" height="120" style="display: none; margin-top: 10px;">
                @error('HinhAnh')
                <div class="text-danger">{{ $message }}</div>
               @enderror
            </div>

        </div>

    </div>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" id="addButton"onclick="submitForm('add')">Thêm</button>
        <button type="button" class="btn btn-warning" id="changeButton" style="display:none;"  onclick="submitForm('edit')">Sửa</button>
        
        <button type="button" class="btn btn-secondary" id="cancelButton" style="display:none;" onclick="cancelEdit()">Hủy</button>
    </div>
   </form>
   <form id="searchForm" action="{{ route('color.index') }}" method="GET" class="mb-3">
    <input type="text" class="form-control w-25 d-inline" name="search" id="searchInput" placeholder="Tìm kiếm theo tên hoặc mã" value="{{ request()->query('search') }}">
    <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
</form>
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Màu</th>
                <th>Tên màu</th> 
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $Model)
                <tr>
                    <td>{{ $loop ->index + 1 }}</td>
                    <td>{{ $Model ->id }}</td>
                   
                    <td>{{ $Model ->TenMau }}</td>
                    <td class ="col-2">
                        <img src="{{ asset('storage/images/'.$Model->HinhAnh) }}" width="100" height="50" >
                    </td>

                    <td class ="col-2 text-center">
                        
                        <button type="button" class="btn btn-warning btn-sm" onclick="editColor('{{ $Model->id }}', '{{ $Model->TenMau }}', '{{ asset('storage/images/'.$Model->HinhAnh) }}')">
                            Sửa
                        </button>
                        </form>
                        <form action="{{ route('color.destroy', $Model->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

         
            
                
    </table>
    <div class="d-flex justify-content-center" style="width: 100%; display: flex;">
        {{ $data->links('pagination::bootstrap-4') }}
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
    let id = document.querySelector('input[name="id"]').value;
    if (action === 'add') {
        form.action = "{{ route('color.store') }}"; // Route thêm mới

    } else if (action === 'edit') {
        editmethod.value = "PUT"; // Khi bấm sửa thì chuyển sang PUT
        form.action = "{{ route('color.update', ':id') }}".replace(':id',id); // Thay :id bằng mã màu // Route cập nhật
    }

    form.submit();
}

function editColor(id, tenMau, hinhAnh) {
    let idInput = document.querySelector('input[name="id"]'); //lay the ma mau
    let tenMauInput = document.querySelector('input[name="TenMau"]');
    let preview = document.getElementById('preview');
    idInput.value = id;//gán values cho the ma mau 
    idInput.readOnly = true; // Không cho sửa mã màu khi cập nhật
    tenMauInput.value = tenMau;
    preview.src = hinhAnh;
    changeButton.style.display="inline-block";
    preview.style.display = "block";
    cancelButton.style.display = "inline-block";
    addButton.style.display="none";
}
function cancelEdit() {
    let idInput = document.querySelector('input[name="id"]');
    let tenMauInput = document.querySelector('input[name="TenMau"]');
    let preview = document.getElementById('preview');
    let cancelButton = document.getElementById('cancelButton'); 
    let changeButton = document.getElementById('changeButton'); 
    idInput.value = '';
    idInput.readOnly = false;
    tenMauInput.value = '';
    preview.src = '';
    preview.style.display = "none";
    changeButton.style.display = "none";
    // Hide the cancel button
    cancelButton.style.display = "none";
    addButton.style.display="inline-block";
}
</script>



