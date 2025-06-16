@extends('Master.main')
@section('tittle','Quản lý loại sản phẩm')
@section('main')

<div class="container mt-4">
    <h4 class="text-center mb-4 text-primary">Quản lý loại sản phẩm</h4>

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
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   <form id="LoaiSanPhamForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="editmethod" value="POST"> 
    <div class="row">
        <div class="col-md-6">
            <div class="mb-2">
                <label for="" class="form-label">Mã loại sản phẩm</label>
                <input type="text" class="form-control" name="id">
                @error('id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-2">
                <label for="" class="form-label">Tên loại sản phẩm</label>
                <input type="text" class="form-control" name="TenLoaiSanPham">
                @error('TenLoaiSanPham')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
        </div>
       

    </div>
    <div class="mb-3">
        <button type="button" class="btn btn-primary"  id="addButton" onclick="submitForm('add')">Thêm</button>
        <button type="button" class="btn btn-warning" id="changeButton" style="display:none;"  onclick="submitForm('edit')">Sửa</button>
        
        <button type="button" class="btn btn-secondary" id="cancelButton" style="display:none;" onclick="cancelEdit()">Hủy</button>
    </div>
   </form>
   <form id="searchForm" action="{{ route('productcategory.index') }}" method="GET" class="mb-3">
    <input type="text" class="form-control w-25 d-inline" name="search" id="searchInput" placeholder="Tìm kiếm theo tên">
    <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
</form>
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã loại sản phẩm</th>
                <th>Tên loại sản phẩm</th> 
                
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data  as $index=>  $Model)
                <tr>
                    <td> {{ $index + 1 }}</td>
                    <td>{{ $Model ->id }}</td>
                    <td>{{ $Model ->TenLoaiSanPham }}</td>

                    <td class ="col-2 text-center">
                        
                        <button type="button" class="btn btn-warning btn-sm" onclick="editloaisanpham('{{ $Model->id }}', '{{ $Model->TenLoaiSanPham }}')">
                            Sửa
                        </button>
                        </form>
                        <form action="{{ route('productcategory.destroy', $Model->id) }}" method="POST" class="d-inline">
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
</div>



@endsection


<script>
   
    

    function submitForm(action) {
    let form = document.getElementById('LoaiSanPhamForm');
    let editmethod = document.getElementById('editmethod'); // Lấy input ẩn
    let id = document.querySelector('input[name="id"]').value;
    if (action === 'add') {
        form.action = "{{ route('productcategory.store') }}"; // Route thêm mới

    } else if (action === 'edit') {
        editmethod.value = "PUT"; // Khi bấm sửa thì chuyển sang PUT
        form.action = "{{ route('productcategory.update', ':id') }}".replace(':id',id); // Thay :id bằng mã màu // Route cập nhật
    }

    form.submit();
}

function editloaisanpham(id, TenLoaiSanPham) {
    let idInput = document.querySelector('input[name="id"]'); //lay the ma mau
    let TenLoaiSanPhamInput = document.querySelector('input[name="TenLoaiSanPham"]');
    let cancelButton = document.getElementById('cancelButton'); 
    let changeButton = document.getElementById('changeButton'); 

    idInput.value = id;//gán values cho the ma mau 
    idInput.readOnly = true; // Không cho sửa mã màu khi cập nhật
    TenLoaiSanPhamInput.value = TenLoaiSanPham;
    changeButton.style.display = "inline-block"; // Hiện nút sửa
    // Hide the cancel button
    cancelButton.style.display = "inline-block";
    addButton.style.display="none";
}


function cancelEdit() {
    let idInput = document.querySelector('input[name="id"]');
    let tenlspInput = document.querySelector('input[name="TenLoaiSanPham"]');
    let cancelButton = document.getElementById('cancelButton'); 
    let changeButton = document.getElementById('changeButton'); 
    idInput.value = '';
    idInput.readOnly = false;
    tenlspInput.value = '';
    changeButton.style.display = "none";
    // Hide the cancel button
    cancelButton.style.display = "none";
    addButton.style.display="inline-block";
}
</script>



