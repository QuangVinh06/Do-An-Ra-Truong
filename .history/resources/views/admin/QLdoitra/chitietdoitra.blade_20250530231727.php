@extends('Master.main')
@section('tittle','Chi tiết đổi trả')

@section('main')
    <title>Chi tiết phiếu đổi trả</title>
    <style>
    
        h1 {
            color: #2a5885;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-section {
            margin-bottom: 30px;
        }
        .customer-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            flex: 1;
            min-width: 250px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        .image-container {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .image-placeholder {
            width: 150px;
            height: 150px;
            margin: 0 auto;
            border: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
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
        .action-row {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .add-product {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .save-btn {
            background-color: #2a5885;
            color: white;
        }
        .cancel-btn {
            background-color: #f44336;
            color: white;
        }
        .back-btn {
            background-color: #888;
            color: white;
        }
        .remove-btn {
            color: red;
            cursor: pointer;
            background: none;
            border: none;
            font-size: 16px;
        }
        .summary-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .summary-box {
            width: 300px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .summary-total {
            font-weight: bold;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>

<body>
    <div class="container">
        <h1>Chi tiết phiếu đổi trả</h1>
        <a href="{{ route('QLdoitra.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Quay lại
        </a>
        <hr>
        <div class="form-section">
            <div class="customer-info">
                <div class="form-group">
                    <label >Mã hợp đồng:<span> {{ $donHang ? $donHang->hopDong->id : 'Không có đơn hàng'}}</span></label>
                    
                    </div>
                <br>
                    <div class="form-group">
                    <label for="customerName">Thông tin khách hàng:</label>
                    <input type="text" id="customerName"value={{$doitra->khachHang->SoDienThoai }} readonly>
                    <input type="text" id="customerName"value={{$doitra->khachHang->user->email}} readonly>

                </div>
               
                
                <div class="form-group">
                    <label for="returnDate">Ngày đổi trả:</label>
                    <input type="date" id="returnDate" value="{{ \Carbon\Carbon::parse($doitra->NgayLap)->format('Y-m-d') }}">
                </div>
            </div>
            
            <div class="form-group">
                <label for="returnReason">Lý do đổi trả:</label>
                <textarea id="returnReason" placeholder="Nhập lý do đổi trả">{{ $doitra->MoTa }}</textarea>
            </div>
            <div class="form-group">
                <label for="returnReason">Ghi chú:</label>
                <textarea id="returnReason" placeholder="Nhập ghi chú">{{ $doitra->GhiChu }}</textarea>
            </div>
          
        </div>
        <div class="summary-section">
            <div class="summary-box">
                <div class="summary-item">
                    <span>Tổng sản phẩm:</span>
                    <span>{{ $ctdoitra->sum('SoLuong') }}</span>
                </div>
               
                
               
            </div>
        </div>
        <h2>Danh sách sản phẩm đổi trả</h2>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody id="productList">
                @foreach($ctdoitra as $index => $ct)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ct->sanPham->TenGoi }}</td>
                    <td>{{ $ct->SoLuong }}</td>
                </tr>
            @endforeach
                
            </tbody>
        </table>
        
      
       
        
       
        
        
    </div>

   
</body>
@endsection
