@extends('client.index') 
@section('main')
    <style>
        .header {
            color: blue;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 12px 20px;
            border-radius: 25px;
            display: inline-block;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
        }

        .title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .subtitle {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .main-content {
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 40px;
        }

        .left-section {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .form-group {
            background: #f8fafc;
            padding: 30px;
            border-radius: 16px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

      

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 12px;
            color: #334155;
            font-size: 16px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .right-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 20px;
            padding: 30px;
            height: fit-content;
            border: 2px solid #e2e8f0;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '📦';
            font-size: 24px;
        }

        .product-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-row {
            display: flex;
            gap: 15px;
        }

        .input-row input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .input-row input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .add-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

       
        .products-table {
            margin-top: 30px;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .table-header {
            color: black;
            padding: 20px;
            font-weight: 600;
            text-align: center;
            font-size: 18px;
        }

        .table-content {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #f8fafc;
            font-weight: 600;
            color: #334155;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            font-size: 14px;
            color: #64748b;
        }

        .delete-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .delete-btn:hover {
            background: #dc2626;
            transform: scale(1.05);
        }

        .submit-section {
            grid-column: 1 / -1;
            text-align: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #e2e8f0;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
        }

        .icon {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 20px;
            }
            
            .container {
                margin: 10px;
                border-radius: 12px;
            }
            
            .header {
                padding: 20px;
            }
            
            .title {
                font-size: 24px;
            }
            
            .input-row {
                flex-direction: column;
            }
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-elements::before,
        .floating-elements::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-elements::before {
            top: -100px;
            right: -100px;
            animation-delay: -3s;
        }

        .floating-elements::after {
            bottom: -100px;
            left: -100px;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
    </style>

     <div class="container py-4">
            <div class=" mb-3">
        <small class="breadcrumb" style="gap:4px; font-size:100%;">
            <a href="/">Trang chủ</a> <span>/</span> <span> <a href="{{ url()->previous() }}">Đơn hàng</a></span>/ <span> đổi trả </span>
        </small>
              </div>
   
        {{-- Thông báo thành công / cảnh báo --}}
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Thông báo</h4>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        @if(Session::has('warning'))
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Thông báo</h4>
                <p>{{ Session::get('warning') }}</p>
            </div>
        @endif
        
    
        <div class="header text-center mb-4">
            <h1 class="title">Phiếu Đổi Trả Hàng</h1>
        </div>
    
        {{-- Form đổi trả --}}
        <form action="{{ route('doitra.store') }}" method="POST">
            @csrf
            <div class="row">
                {{-- Cột trái --}}
                <div class="left-section col-md-6">
                    <a href="{{ route('donhang.view') }}" class="btn btn-outline-primary rounded-pill" style="width:200px">                        <i class="fas fa-arrow-left me-1"></i> Quay lại
                    </a>

                    <div class="form-group mb-3">
                        <label for="mo_ta">
                            <span class="icon">📝</span> Mô tả lý do đổi trả
                        </label>
                        <textarea name="mo_ta" id="mo_ta" class="form-control"
                        placeholder="Vui lòng mô tả chi tiết lý do đổi trả sản phẩm..."
                        required rows="4" style="width: 100%;">{{ old('mo_ta', $pdt->MoTa ?? '') }}</textarea>
                    </div>
    
                    <div class="form-group mb-3">
                        <label for="ghi_chu">
                            <span class="icon">💭</span> Ghi chú thêm
                        </label>
                        <input type="text" name="ghi_chu" id="ghi_chu" class="form-control"
                               placeholder="Thêm ghi chú hoặc yêu cầu đặc biệt..."
                               value="{{ old('ghi_chu', $pdt->GhiChu ?? '') }}"style="height:100px">
                    </div>
                </div>
    
                {{-- Cột phải --}}
                <div class="right-section" style="margin-top: 80px;">
                    <h3 class="section-title mb-3">Sản phẩm đổi trả</h3>
                    <input type="hidden" name="idDonHang" value="{{ $dh->id }}">

                    <div class="product-form mb-3">
                        @foreach($dh->hopDong->phieuDatHang->chiTietPhieuDat as $index => $item)

                        <div class="input-group mb-2" data-id="{{ $item->sanPham->id }}">
                            <input type="hidden" class="product-id" value="{{ $item->sanPham->id }}">
                            <input type="text" class="form-control product-name" value="{{ $item->sanPham->TenGoi }}" readonly>
                            <input type="number" class="form-control mx-2 product-qty" placeholder="Số lượng"
                                   min="0" value="0" max="{{ $item->SoLuong }}" style="max-width: 100px;"
                                   data-max="{{ $item->SoLuong }}">
                            <button type="button" class="btn btn-success add-btn" onclick="addOrUpdateProduct(this)">Thêm</button>
                        </div>
                        @endforeach
                    </div>
    
                    {{-- Tùy chọn hiển thị danh sách sản phẩm thêm sau này --}}
                    <div class="products-table">
                        <div class="table-header fw-bold ">Danh sách sản phẩm đổi trả</div>
                        <table class="table table-bordered table-content">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="productList">
                               
                            </tbody>
                        </table>
                        <div id="hiddenInputs"></div>

                    </div>
                </div>
            </div>
    
            {{-- Nút gửi --}}
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px;">
                    Gửi Phiếu Đổi Trả
                </button>
            </div>
        </form>
    </div>

    <script>
        let productIndex = 0;
    
        function addOrUpdateProduct(button) {
            const group = button.closest('.input-group');
            const productId = group.querySelector('.product-id').value;
            const name = group.querySelector('.product-name').value;
            const qtyInput = group.querySelector('.product-qty');
            const qty = parseInt(qtyInput.value);
            const maxQty = parseInt(qtyInput.dataset.max);
    
            if (qty <= 0 || qty > maxQty) {
                alert('Số lượng không hợp lệ.');
                return;
            }
    
            let existingRow = document.querySelector(`#productList tr[data-id="${productId}"]`);
            if (existingRow) {
                // Cập nhật số lượng hiển thị
                existingRow.querySelector('.product-qty-display').innerText = qty;
    
                // Cập nhật input ẩn
                document.querySelector(`#hiddenInputs input[name="so_luongs[${productId}]"]`).value = qty;
    
                button.innerText = "Cập nhật";
                button.classList.remove('btn-success');
                button.classList.add('btn-warning');
            } else {
                productIndex++;
    
                // Thêm dòng vào bảng
                const row = document.createElement('tr');
                row.setAttribute('data-id', productId);
                row.innerHTML = `
                    <td>${productIndex}</td>
                    <td>${name}</td>
                    <td class="product-qty-display">${qty}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">Xóa</button></td>
                `;
                document.getElementById('productList').appendChild(row);
    
                // Thêm input ẩn
                const hiddenInputs = document.getElementById('hiddenInputs');
                const inputSanPham = document.createElement('input');
                inputSanPham.type = 'hidden';
                inputSanPham.name = `san_pham_ids[]`;
                inputSanPham.value = productId;
    
                const inputSoLuong = document.createElement('input');
                inputSoLuong.type = 'hidden';
                inputSoLuong.name = `so_luongs[${productId}]`;
                inputSoLuong.value = qty;
    
                hiddenInputs.appendChild(inputSanPham);
                hiddenInputs.appendChild(inputSoLuong);
    
                button.innerText = "Cập nhật";
                button.classList.remove('btn-success');
                button.classList.add('btn-warning');
            }
        }
    
        function deleteRow(btn) {
            const row = btn.closest('tr');
            const productId = row.getAttribute('data-id');
            row.remove();
            updateIndexes();
    
            // Xóa input ẩn
            const hiddenInputs = document.getElementById('hiddenInputs');
            hiddenInputs.querySelectorAll(`input[name="so_luongs[${productId}]"], input[value="${productId}"]`)
                .forEach(input => input.remove());
    
            // Reset nút Thêm
            const group = document.querySelector(`.input-group[data-id="${productId}"]`);
            if (group) {
                const button = group.querySelector('button');
                button.innerText = "Thêm";
                button.classList.remove('btn-warning');
                button.classList.add('btn-success');
            }
        }
    
        function updateIndexes() {
            const rows = document.querySelectorAll('#productList tr');
            rows.forEach((row, index) => {
                row.cells[0].innerText = index + 1;
            });
            productIndex = rows.length;
        }
    </script>
    
 @endsection
    