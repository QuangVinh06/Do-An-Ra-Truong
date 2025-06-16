@extends('Master.main')
<style>  
    body {  
        font-family: 'Times New Roman', Times, serif;  
        margin: 20px;  
        background-color: #f9f9f9;  
    }  
    .container {  
        max-width: 800px;  
        margin: auto;  
        background: white;  
        padding: 20px;  
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);  
        border-radius: 5px;  
    }  
    h2 {  
        text-align: center;  
    }  
    .form-group {  
        margin-bottom: 15px;  
    }  
    label {  
        display: block;  
        margin-bottom: 5px;  
    }  
    input[type="text"] {  
        width: 100%;  
        padding: 8px;  
        margin-top: 5px;  
        border: 1px solid #ccc;  
        border-radius: 4px;  
    }  
    button {  
        padding: 10px 15px;  
        background-color: #4CAF50;  
        color: white;  
        border: none;  
        border-radius: 4px;  
        cursor: pointer;  
        margin-right: 10px;  
    }  
    button:hover {  
        background-color: #45a049;  
    }
    .search-form {
        display: flex;
        margin-bottom: 15px;
    }
    .search-form input {
        flex: 1;
        margin-right: 10px;
    }
    table {  
        width: 100%;  
        border-collapse: collapse;  
        margin-top: 20px;  
    }  
    table, th, td {  
        border: 1px solid #cccccc;  
    }  
    th, td {  
        padding: 10px;  
        text-align: left;  
    }  
    th {  
        background-color: #f2f2f2;  
    }  
    </style>
@section('main')


<div class="container">  
    <h2>Quản lý Loại Khách Hàng</h2>   
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Form thêm và sửa -->
    <form action="{{ isset($loaikhachhang) ? route('QLloaikhachhang.update', $loaikhachhang->id) : route('QLloaikhachhang.store') }}" method="POST">
        @csrf
        @if(isset($loaikhachhang))
            @method('PUT')
        @endif
        <div class="form-group">  
            <label for="TenLoaiKhachHang">Tên loại khách hàng</label>  
            <input type="text" id="TenLoaiKhachHang" name="TenLoaiKhachHang" value="{{ $loaikhachhang->TenLoaiKhachHang ?? '' }}" required>  
        </div>

        <div class="form-group">  
            <label for="DieuKien">Điều kiện</label>  
            <input type="number" id="DieuKien" name="DieuKien" value="{{ $loaikhachhang->DieuKien ?? '0' }}" required>  
        </div>  

        <!-- Nút Thêm và Sửa -->
        <button type="submit" class="btn btn-warning btn-sm">{{ isset($loaikhachhang) ? 'Sửa' : 'Thêm' }} loại khách hàng</button>
        @if(isset($loaikhachhang))
            <a href="{{ route('QLloaikhachhang.index') }}"><button type="button">Hủy</button></a>
        @endif
    </form>

    <h3>Danh sách loại khách hàng</h3>  
    <form action="{{ route('QLloaikhachhang.index') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
        <button type="submit" class="btn btn-secondary">Tìm kiếm</button>  
    </form>  

    <table>  
        <thead>  
        <tr>  
            <th>STT</th>   
            <th>Tên loại khách hàng</th>
            <th>Điều kiện</th> 
            <th>Hành động</th>
        </tr>  
        </thead>  
        <tbody>
        @foreach ($lkhs as $index => $lkh)
        <tr>  
            <td>{{ $index + 1 }}</td>  
            <td>{{ $lkh->TenLoaiKhachHang }}</td>
            <td>Mua {{ $lkh->DieuKien}} sản phẩm </td> 
            <td>  
            <form action="{{ route('QLloaikhachhang.edit', $lkh->id) }}" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-sm">Sửa</button>
                </form>
                <form action="{{ route('QLloaikhachhang.destroy', $lkh->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn vị tính này?');">
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
@endsection