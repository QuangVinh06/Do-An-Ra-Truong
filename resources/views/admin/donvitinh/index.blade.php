@extends('Master.main')
@section('tittle','Quản lý đơn vị tính')
@section('main')

{{-- <div class="container mt-4">
    <h4 class="mb-3">Quản lý đơn vị tính</h4>

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
    
   <form id="DonViTinhForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="editmethod" value="POST"> 
    <div class="row">
        <div class="col-md-6">
            <div class="mb-2">
                <label for="" class="form-label">Mã đơn vị tính</label>
                <input type="text" class="form-control" name="id">
                @error('id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-2">
                <label for="" class="form-label">Tên đơn vị tính</label>
                <input type="text" class="form-control" name="TenDonViTinh">
                @error('TenDonViTinh')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
        </div>
       

    </div>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" onclick="submitForm('add')">Thêm</button>
        <button type="button" class="btn btn-warning" onclick="submitForm('edit')">Sửa</button>
    </div>
   </form>
   <form id="searchForm" action="{{ route('color.index') }}" method="GET" class="mb-3">
    <input type="text" class="form-control w-25 d-inline" name="keyword" id="searchInput" placeholder="Tìm kiếm theo tên">
    <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
</form>
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã đơn vị tính</th>
                <th>Tên đơn vị tính</th> 
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $Model)
                <tr>
                    <td style="width:50px">{{ $loop ->index + 1 }}</td>
                    <td> {{ $Model->id }}</td>
                    <td>{{ $Model ->TenDonViTinh }}</td>
                    

                    <td class ="col-2 text-center">
                        
                        <button type="button" class="btn btn-warning btn-sm" onclick="editdonvitinh('{{ $Model->id }}', '{{ $Model->TenDonViTinh }}')">
                            Sửa
                        </button>
                        </form>
                        <form action="{{ route('donvitinh.destroy', $Model->id) }}" method="POST" class="d-inline">
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
</div> --}}
<div class="container mt-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-4 text-primary">Quản lý đơn vị tính</h2>

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
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Thêm/Sửa  -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            {{ isset($donvitinh) ? 'Sửa đơn vị tính' : 'Thêm đơn vị tính' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($donvitinh) ? route('donvitinh.update', $donvitinh->id) : route('donvitinh.store') }}" method="POST">
                @csrf
                @if(isset($donvitinh))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="TenDonViTinh" class="form-label">Tên đơn vị tính</label>
                    <input type="text" id="TenDonViTinh" name="TenDonViTinh" class="form-control" value="{{ $donvitinh->TenDonViTinh ?? '' }}" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($donvitinh) ? 'Sửa' : 'Thêm' }} đơn vị tính</button>
                @if(isset($donvitinh))
                    <a href="{{ route('donvitinh.index') }}" class="btn btn-secondary">Hủy</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Danh sách  -->
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Đơn Vị Tính
        </div>
        <div class="card-body">
            <form action="{{ route('donvitinh.index') }}" method="GET" class="d-flex mb-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </form>
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>STT</th>
                        <th>Tên đơn vị tính</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dvts as $index => $dvt)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dvt->TenDonViTinh}}</td>
                            <td>
                                <a href="{{ route('donvitinh.edit', $dvt->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('donvitinh.destroy', $dvt->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn vị tính này?');">
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


{{-- <script>
   
    

    function submitForm(action) {
    let form = document.getElementById('DonViTinhForm');
    let editmethod = document.getElementById('editmethod'); // Lấy input ẩn
    let id = document.querySelector('input[name="id"]').value;
    if (action === 'add') {
        form.action = "{{ route('donvitinh.store') }}"; // Route thêm mới

    } else if (action === 'edit') {
        editmethod.value = "PUT"; // Khi bấm sửa thì chuyển sang PUT
        form.action = "{{ route('donvitinh.update', ':id') }}".replace(':id',id); // Thay :id bằng mã màu // Route cập nhật
    }

    form.submit();
}

function editdonvitinh(id, TenDonViTinh) {
    let idInput = document.querySelector('input[name="id"]'); //lay the ma mau
    let TenDonViTinhInput = document.querySelector('input[name="TenDonViTinh"]');
   
    idInput.value = id;//gán values cho the ma mau 
    idInput.readOnly = true; // Không cho sửa mã màu khi cập nhật
    TenDonViTinhInput.value = TenDonViTinh;
   
}

</script> --}}



