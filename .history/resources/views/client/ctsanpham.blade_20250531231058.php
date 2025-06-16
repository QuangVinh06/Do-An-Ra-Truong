@extends('client.home')
@section('main')


<style type="text/css" media="all">
    body {
  font-family: 'Inter', sans-serif;
  background-color: #f7f7f9;
  color: #333;
  
}

.container {
  max-width: 1200px;
  margin: auto;
  

}

.breadcrumb {
  font-size: 14px;
  margin-top: 20px;
  margin-bottom: 20px;
  color: #888;
}

.product-card {
  height: 600px;
  display: flex;
  gap: 40px;
  background: white;

  padding: 30px;
  border-radius: 16px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
}

.product-left {
  flex: 1;
}

.product-right {
  flex: 1.2;
}

  .main-image {
        width: 90%; /* Chiếm toàn bộ chiều rộng container */
        height: 80%; /* Đặt chiều cao cố định */
        object-fit: cover; 
        object-position: top; /* Đặt vị trí hình ảnh ở trên cùng */
        border-radius: 12px;
        margin-bottom: 10px;
    }

    .thumbnail-row img {
        width: 80px; /* Kích thước nhỏ hơn cho hình ảnh thumbnail */
        height: 80px; /* Đặt chiều cao cố định */
        object-fit: cover; /* Đảm bảo hình ảnh không bị méo */
        margin-right: 8px;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .thumbnail-row img:hover {
        transform: scale(1.1); /* Phóng to nhẹ khi hover */
    }
.product-right h1 {
  font-size: 24px;
  margin-bottom: 10px;
}

.brand {
  font-size: 14px;
  color: #777;
  margin-bottom: 20px;
}

.status {
  color: green;
  font-weight: 600;
}

.price {
  font-size: 20px;
  margin-bottom: 20px;
}

.current-price {
  color: #e74c3c;
  font-weight: 700;
}

.old-price {
  text-decoration: line-through;
  color: #aaa;
  margin-left: 10px;
}

.features {
  margin-bottom: 20px;
}

.features li {
  margin-bottom: 8px;
}

label {
  display: block;
  margin-top: 20px;
  margin-bottom: 6px;
  font-weight: 600;
}

.size-options .size {
  padding: 8px 14px;
  margin-right: 10px;
  background: #f1f1f1;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.size.active {
  background: #ff6b00;
  color: white;
}

.color-options .color {
  display: inline-block;
  width: 24px;
  height: 24px;
  margin-right: 8px;
  border-radius: 50%;
  border: 1px solid #ccc;
  cursor: pointer;
}

.color.black { background: #000; }
.color.white { background: #fff; }
.color.silver { background: #aaa; }
.color.blue { background: #3498db; }

.quantity {
  margin: 20px 0;
  display: flex;
  align-items: center;
}

.quantity button {
  width: 32px;
  height: 32px;
  border: none;
  background: #eee;
  font-size: 18px;
  cursor: pointer;
}

.quantity input {
  width: 50px;
  text-align: center;
  margin: 0 8px;
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.add-to-cart {
  background: #ff6b00;
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
  transition: background 0.3s;
  
}

.add-to-cart:hover {
  background: #e05a00;
}

.related-products {
        margin-top: 40px;
    }

    .related-products h2 {
        margin-bottom: 20px;
        font-size: 20px;
        font-weight: bold;
    }
.related-products img{
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }

    
    .related-products .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .related-products .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

  </style>
</head>
<body>
  <div class="container">
    <nav class="breadcrumb">
        <a href="{{ route('client.home') }}">Trang chủ</a> > 
        <a href="{{ route('sanpham.index') }}">Sản phẩm</a> > 
        <span>{{ $product->TenGoi }}</span>
    </nav>

    <div class="product-card">
      <div class="product-left">
        <img src="{{  asset($product->HinhAnh) }}" class="main-image">
        {{-- <div class="thumbnail-row">
          <img src="thumb1.jpg" alt="">
    
        </div> --}}
      </div>

      <div class="product-right">
        <h1> {{ $product->LoaiSanPham->TenLoaiSanPham .' - '.$product->TenGoi }}</h1>
       
        <div class="price">
          @if (is_numeric($product->banggia?->Gia))
          <span class="current-price">{{ number_format($product->banggia->Gia, 0, ',', '.') }}₫</span>
      @else
          <span class="current-price">Chưa cập nhật</span>
      @endif          
        </div>



         <div>


          <label>Mô tả: </label>
           {{ $product->MoTa }}
        </div>


        <div class="options">
          <label>Đơn vị tính</label>
           {{ $product->DonViTinh->TenDonViTinh }}
          </div>
          
             <div class="options">
          <label>Loại sản phẩm</label>
           {{ $product->loaiSanPham->TenLoaiSanPham }}
          </div>
          @if (is_numeric($product->banggia?->Gia))
          <label>Số lượng</label>
   
          <form action="{{ route('dathang.add', $product->id) }}" method="GET">
            @csrf
           <div class="quantity">
    <button type="button" class="btn-decrease">-</button>
    <input type="text" id="quantity-input" name="quantity" value="1" min="1">
    <button type="button" class="btn-increase">+</button>
  </div>
            <div>
              <button type="submit" class="btn-primary add-to-cart" style="width:250px;border-radius:4px">THÊM VÀO ĐẶT HÀNG</button>
            </div>
          </form> 
          @endif

        </div>

        
    
    </div>

    <div class="related-products">
    <h2>Sản phẩm tương tự</h2>
    <div class="row" style="margin-bottom:15px;">
        @foreach ($relatedProducts as $related)
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="{{ asset($related->HinhAnh) }}" class="card-img-top" alt="{{ $related->TenGoi }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $related->TenGoi }}</h5>
                        <p class="card-text">
                          @if (is_numeric($related->banggia?->Gia))
                          <span class="current-price">{{ number_format($related->banggia->Gia, 0, ',', '.') }}₫</span>
                      @else
                          <span class="current-price">Chưa cập nhật</span>
                      @endif                        </p>
                        <a href="{{ route('sanpham.chitiet', $related->id) }}" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
 <div style="margin-bottom: 20px" class="reviews-section mt-5 bg-white rounded-4 shadow-sm p-4">
    <h2 class="fw-bold mb-4 border-bottom pb-3">
        <i class="bi bi-chat-left-text me-2"></i>Phản hồi khách hàng
    </h2>
    
    @if(Auth::check())
        <form action="{{ route('phanhoi.store', $product->id) }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <textarea name="comment" class="form-control rounded-3" rows="3" placeholder="Chia sẻ suy nghĩ của bạn về sản phẩm này..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send me-2"></i>Gửi phản hồi
            </button>
        </form>
    @else
        <div class="alert alert-warning rounded-3 d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
            <div>
                Vui lòng <a href="{{ route('admin.login') }}" class="alert-link">đăng nhập</a> để đặt hàng và chia sẻ phản hồi của bạn.
            </div>
        </div>
    @endif
    
    <!-- Danh sách phản hồi -->
    <div class="customer-reviews mt-4">
        @forelse($product->phanHoiKhachHangs as $ph)
            <div class="review-item mb-3 border-bottom pb-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        {{ strtoupper(substr($ph->khachHang->user->name, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">{{ $ph->khachHang->user->name }}</h5>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($ph->ThoiGian)->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                <p class="review-text mb-2">{{ $ph->comment }}</p>
                
                @if(Auth::check() && Auth::user()->khachHang->user->id == $ph->idKhachHang)
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('phanhoi.destroy', $ph->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa phản hồi này?')">
                                <i class="bi bi-trash me-1"></i>Xóa
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-4 text-muted">
                <i class="bi bi-chat-square-text fs-1"></i>
                <p class="mt-2">Chưa có phản hồi nào. Hãy là người đầu tiên chia sẻ ý kiến!</p>
            </div>
        @endforelse
    </div>
</div>
  </div>
 

<!-- Sản phẩm liên quan -->

</body>


 <script>
    document.addEventListener('DOMContentLoaded', function () {
        const decreaseButton = document.querySelector('.btn-decrease');
        const increaseButton = document.querySelector('.btn-increase');
        const quantityInput = document.getElementById('quantity-input');
        

        // Giảm số lượng
        decreaseButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
           
              }
        });

        // Tăng số lượng
        increaseButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            
            quantityInput.value = currentValue + 1;
             
        });

        // Đảm bảo chỉ nhập số hợp lệ
        quantityInput.addEventListener('input', function () {
            if (isNaN(quantityInput.value) || parseInt(quantityInput.value) < 1) {
                quantityInput.value = 1;
            }
        });
    });
</script>

@endsection