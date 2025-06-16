@extends('Master.main')
@section('tittle','Quản lý đổi trả')

@section('main')
    <style>
      
        h1 {
            color: #2a5885;
            text-align: center;
            margin-bottom: 30px;
        }
        .search-section {
            display: flex;
            margin-bottom: 20px;
            gap: 10px;
        }
        .search-section input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .search-section button {
            padding: 10px 15px;
            background-color: #2a5885;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-section button:hover {
            background-color: #1e3f66;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .action-btn {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .view-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination button {
            margin: 0 5px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            background-color: white;
            cursor: pointer;
        }
        .pagination button.active {
            background-color: #2a5885;
            color: white;
            border-color: #2a5885;
        }
        .add-new {
            margin-bottom: 20px;
        }
        .add-new button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

<body>
    <div class="container">
        <h1>Quản lý đổi trả</h1>
      
        <form action="{{ route('QLdoitra.index') }}" method="GET" class="search-form ">
            <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>    
        
        <table>
            <thead>
                <tr>
                    <th >Ngày lập</th>
                    <th>Khách hàng</th>
                    <th>Mô tả</th>
                    <th>Ghi chú</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $Model)
                <tr>
                    <td style="width:150px">{{ $Model->NgayLap }}</td>
                    <td style="width:150px">{{ $Model->khachHang->user->name }}</td>
                    <td style="width:200px;height:100px">{{$Model->MoTa}}</td>
                    <td>{{ $Model->GhiChu }}</td>
                    <td>{{ $Model->TrangThai }}</td>
                    <td style="width:150px">
                        <a href="{{ route('QLdoitra.show', $Model->id) }}" class="btn btn-primary">Chi tiết</a>
                        
                    </td>
                    <td>
                    <form action="{{ route('QLdoitra.destroy', $Model->id) }}" method="POST" style="display: inline;width:150px" onsubmit="return confirm('Bạn có chắc chắn muốn xóa phiếu đổi trả này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success " >Xóa</button>
                    </form> 
                    <a href="{{ route('phieuDoiTra.xacnhan', $Model->id) }}" 
                        class="btn btn-success"
                        onclick="return confirm('Bạn có chắc chắn muốn xác nhận đã đổi trả?')">
                        Xác nhận đổi trả
                     </a>                </td>              
                 </tr>
                @endforeach

        </table>
       
    </div>

    <script>
        document.getElementById('addNewBtn').addEventListener('click', function() {
            window.open('return_detail.html', '_blank');
        });
        
        const viewButtons = document.querySelectorAll('.view-btn');
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                window.open('return_detail.html', '_blank');
            });
        });
        
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                if(confirm('Bạn có chắc chắn muốn xoá phiếu đổi trả này không?')) {
                    alert('Đã xoá phiếu đổi trả!');
                }
            });
        });
    </script>
</body>
@endsection