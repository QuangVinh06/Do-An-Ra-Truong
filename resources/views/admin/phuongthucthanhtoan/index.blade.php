@extends('Master.main')

@section('main')

<style>  
   
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
<div class="container">  
    <h4 class="text-center mb-4 text-primary">Quản lý phương thức thanh toán</h4>   

    <!-- Form thêm và sửa -->
    <form action="{{ isset($phuongthucthanhtoan) ? route('phuongthucthanhtoan.update', $phuongthucthanhtoan->id) : route('phuongthucthanhtoan.store') }}" method="POST">
        @csrf
        @if(isset($phuongthucthanhtoan))
            @method('PUT')
        @endif
        <div class="form-group">  
            <label for="">Tên phương thức thanh toán</label>  
            <input type="text" id="TenPhuongThucThanhToan" name="TenPhuongThucThanhToan" value="{{ $phuongthucthanhtoan->TenPhuongThucThanhToan ?? '' }}" required>  
        </div>
        <div class="form-group">  
            <label for="">Cách thức hoạt động</label>  
            <input type="text" id="CachThuc" name="CachThuc" value="{{ $phuongthucthanhtoan->CachThuc ?? '' }}" required>  
        </div>  

        <!-- Nút Thêm và Sửa -->
        <button type="submit"  class="btn btn-primary">{{ isset($phuongthucthanhtoan) ? 'Sửa' : 'Thêm' }} phương thức thanh toán</button>
        @if(isset($phuongthucthanhtoan))
            <a href="{{ route('phuongthucthanhtoan.index') }}"><button type="button">Hủy</button></a>
        @endif
    </form>
    <hr>
    <h4 class="text-center mb-4 text-primary">Danh sách phương thức thanh toán</h4>  
    <form action="{{ route('phuongthucthanhtoan.index') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
        <button type="submit" class="btn btn-secondary">Tìm kiếm</button>  
    </form>  

    <table>  
        <thead>  
        <tr>  
            <th>STT</th>   
            <th>Tên phương thức thanh toán</th>
            <th>Cách thức hoạt động</th>  
            <th>Hành động</th>
        </tr>  
        </thead>  
        <tbody>
        @foreach ($tt as $index => $tts)
        <tr>  
            <td>{{ $index + 1 }}</td>  
            <td>{{ $tts->TenPhuongThucThanhToan }}</td>
            <td>{{ $tts->CachThuc }}</td>  
            <td>  
            <form action="{{ route('phuongthucthanhtoan.edit', $tts->id) }}" method="GET" style="display: inline;">
                    @csrf
                    <button class="btn btn-warning btn-sm" type="submit">Sửa</button>
                </form>
                <form action="{{ route('phuongthucthanhtoan.destroy', $tts->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa phương thức thanh toán này?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Xóa</button>
                </form>
            </td>  
        </tr>
        @endforeach   
        </tbody>  
    </table>  
</div>
@endsection
