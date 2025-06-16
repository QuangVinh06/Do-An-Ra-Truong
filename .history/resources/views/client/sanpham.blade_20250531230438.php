<!-- filepath: c:\Users\LTC\Downloads\app-banson_v3\app-banson_v3\resources\views\client\sanpham.blade.php -->
@extends('client.index')

@section('main')
<style>
    
    body {
        background-color: #f9f9f9;
        font-family: 'Arial', sans-serif;
    }

    /* Breadcrumb */
    

    /* Danh mục sản phẩm */
    .list-group {
        border-radius: 10px;
        overflow: hidden;
   
    }

    .list-group-item {
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #f1f1f1;
        color: #0d6efd;
    }

    .list-group-item.bg-primary {
        background-color: #0d6efd !important;
        color: white !important;
    }

    /* Card sản phẩm */
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        height: 250px;
        object-fit: cover;
        border-bottom: 1px solid #ddd;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        font-size: 16px;
        color: #666;
    }

    .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }
   
    .list-group-item.active  {
       color: rgb(28, 51, 180) !important;
      background-color: #ffffff !important;
        font-weight: bold; 
    }

</style>

<div class="container-fluid py-4">
    {{-- BREADCRUMB --}}
 <div class="container mb-3">
        <small class="breadcrumb" style="gap:4px">
            <a href="/">Trang chủ</a> <span>/</span> <span> Sản phẩm</span>
        </small>
    </div>

    <div class="container">
        
        <div class="row">
          
            <div class="col-md-3 mb-4">
                <div class="list-group shadow-sm">
                    <div class="list-group-item bg-primary text-white fw-bold text-center">Danh mục sản phẩm</div>
                    @foreach( $productcategory as $pdc)
                          <a href="{{ Route('sanphamtheodanhmuc.show',$pdc->id) }}" class="list-group-item list-group-item-action  py-3  {{ request()->is('sanpham/' . $pdc->id) ? 'active' : '' }}">{{ $pdc->TenLoaiSanPham }}  </a>
                    @endforeach
                  
                  
                </div>
            </div>

            
            <div class="col-md-9">
                <!-- Bộ lọc sản phẩm + sắp xếp -->
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-2">
                   <form method="GET" action="" class="d-flex align-items-center mb-0" style="gap: 8px;">


                        <input type="text"  name="q" class="form-control me-2" placeholder="Tìm kiếm sản phẩm..." value="{{ request('q') }}" style="min-width: 180px;">
                        <button type="submit" style="width: 120px;" class="btn btn-primary me-2">Tìm kiếm</button>
                    </form>

                 


                    <div class="d-flex align-items-center">
                        <span class="me-2 fw-bold">Sắp xếp:</span>
                        <form method="GET" action="" class="mb-0">
                            <select name="sort" class="form-control" style="min-width: 160px;" onchange="this.form.submit()">
                                <option value="">Mặc định</option>
                                <option value="az" {{ request('sort')=='az' ? 'selected' : '' }}>A → Z</option>
                                <option value="za" {{ request('sort')=='za' ? 'selected' : '' }}>Z → A</option>
                                <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                                <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Hàng mới nhất</option>
                                <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>Hàng cũ nhất</option>
                            </select>
                            <!-- Giữ lại các tham số lọc khi sắp xếp -->
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        </form>
                    </div>
                </div>
                <div class="row">
                    @foreach ($data as $sp)
                        <div class="col-md-6 col-lg-4 mb-4 d-flex">
                            <div class="card shadow-sm w-100">
                               <a href="{{ route('sanpham.chitiet', $sp->id) }}">
                                   <img src="{{ asset($sp->HinhAnh) }}" class="card-img-top" alt="Hình sản phẩm">
                               </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{$sp->LoaiSanPham->TenLoaiSanPham }} - {{ $sp->TenGoi }}</h5>
                                    <p class="card-text">@if (is_numeric($sp->banggia?->Gia))
                                        <span class="current-price">{{ number_format($sp->banggia->Gia, 0, ',', '.') }}₫</span>
                                    @else
                                        <span class="current-price">Chưa cập nhật</span>
                                    @endif</p>
                                    <div class="mt-auto d-flex justify-content-between">
                                        <a href="{{ Route('sanpham.chitiet', $sp->id) }}" class="btn btn-outline-primary">Chi tiết</a>
                                        @if (is_numeric($sp->banggia?->Gia))
                                        @if (Auth::check())
                                            <a href="{{ route('dathang.add', $sp->id) }}" class="btn btn-primary">Đặt hàng</a>
                                        @else
                                            <button onclick="event.preventDefault(); alert('Vui lòng đăng nhập để đặt hàng'); window.location.href='{{ route('admin.login') }}';" 
                                                class="btn btn-primary">Đặt hàng</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                  <div class="mt-4">
              {{ $data->links('pagination::bootstrap-5') }}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection