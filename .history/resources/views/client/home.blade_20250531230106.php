@extends('client.index')

@section('main')
<style>  
.btn-view-all {
    display: inline-block;
    padding: 8px 28px;
    border-radius: 4px;
    background: #000000;
    color: #fff !important;
    font-weight: 500;
    text-decoration: none;
    border: none;
    transition: background 0.2s, color 0.2s;
    margin-top: 10px;
    box-shadow: 0 2px 8px rgba(33,150,243,0.08);
}
.btn-view-all:hover {
    background: #1769aa;
    color: #fff !important;
    text-decoration: none;
}
.text-center {
    text-align: center !important;
}
.hd a {
    text-decoration: none;
    color: inherit;
    transition: color 0.2s;
}

.hd a:hover .product-title {
    color: #2196F3;
}


.btn,
.btn-shop {
    display: inline-block;
    padding: 6px 18px;
    border-radius: 4px;
    border: none;
    background: #2196F3;
    color: #fff !important;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
    cursor: pointer;
    margin-right: 20px;
}

.btn-outline-primary {
    background: #fff;
    color: #2196F3 !important;
    border: 1px solid #2196F3;
}

.btn-outline-primary:hover {
    background: #2196F3;
    color: #fff !important;
}

.btn-primary:hover, .btn-shop:hover {
    background: #1769aa;
    color: #fff !important;
}
.news-section {
            padding: 50px 0;
            background: #f9f9f9;
        }
        
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        .news-card{
            position: relative;
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

                .news-img, .news-title {
                 cursor: pointer;
                 transition: transform 0.3s ease, filter 0.3s ease, color 0.3s ease;
                    }

            .news-img:hover {
              filter: brightness(1.1);
                transform: scale(1.05);
                }

            .news-title:hover {
                color: #1769aa;
               
            }

        .news-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .news-info {
            padding: 20px;
        }
        
        .news-title {
           min-height: 4.5rem;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .news-date {
            
            color: #999;
            font-size: 0.8rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .news-date i {
            margin-right: 5px;
        }
        
        .news-excerpt {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.9rem;
            line-height: 1.6;
        }

read-more {
    height: 40px;          
    line-height: 40px;      
    display: inline-block; 
    padding: 0 12px;       
    color: #f3f3f3;
    background: #000000;
    font-weight: 500;
    transition: color 0.2s;
    text-align: center;    
    white-space: nowrap;  
   
}
.read-more:hover {
    background: #444;
    color: #fff !important;
    text-decoration: none;
}

.product-card {
            background: white;
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
}
        
.product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
        
.products-grid{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
}
        
.product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
}
.products-section {
            padding: 50px 0;
}
        
.section-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 40px;
            position: relative;
}
        
.section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: #2196F3;
}
.product-info {
            padding: 15px;
}
        
.product-title {
            font-size: 1rem;
            margin-bottom: 10px;
            height: 40px;
            overflow: hidden;
            color: #333;
}
        
.product-price {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
 }
        
        .current-price {
            color: #FF5252;
            font-weight: bold;
            font-size: 1.1rem;
            margin-right: 10px;
        }
        
        .old-price {
            color: #999;
            text-decoration: line-through;
            font-size: 0.9rem;
        }
</style>
 <div class="hero-banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-title">SELAC</h1>
                <p class="banner-subtitle">Sơn bột tĩnh điện hàng đầu Việt Nam</p>
                <a href="{{ route('sanpham.index') }}" class="btn-shop">MUA NGAY</a>
            </div>
        </div>
    </div>
    
    <!-- Products Section -->
   <section class="products-section">
    <div class="container">
        <h2 class="section-title">Sản phẩm mới</h2>
        <div class="products-grid">
            @foreach($sanpham->take(8) as $sp)
                <div class="product-card">
                    <img src="{{ asset($sp->HinhAnh) }}" alt="" class="product-img">
                    <div class="product-info">
                        <h3 class="product-title">{{$sp->LoaiSanPham->TenLoaiSanPham }} - {{ $sp->TenGoi }}</h3>
                        <div class="product-price">
                            @if (is_numeric($sp->banggia?->Gia))
                            <span class="current-price">{{ number_format($sp->banggia->Gia, 0, ',', '.') }}₫</span>
                        @else
                            <span class="current-price">Chưa cập nhật</span>
                        @endif                        </div>
                        <div class="hd mt-2 d-flex gap-2">
                            <a href="{{ route('sanpham.chitiet', $sp->id) }}" class="btn btn-outline-primary btn-sm">Chi tiết</a>
                            @if (Auth::check())
                                            <a href="{{ route('dathang.add', $sp->id) }}" class="btn btn-primary">Đặt hàng</a>
                                        @else
                                            <button onclick="event.preventDefault(); alert('Vui lòng đăng nhập để đặt hàng'); window.location.href='{{ route('admin.login') }}';" 
                                                class="btn btn-primary">Đặt hàng</button>
                                        @endif                 
                             </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
   
 <div class="text-center mt-4">
    <a href="{{ route('sanpham.index') }}" class="btn-view-all">Xem tất cả</a>
</div>
</section>

    
    <section class="products-section">
    <div class="container">
        <h2 class="section-title">Danh mục sản phẩm</h2>
        <div class="products-grid">
            @foreach($productcategory->take(4) as $index => $cat)
              @php
        $images = [
            'https://selac.vn/images/link/7449lien-ket-4.jpg',
            'https://selac.vn/images/link/3637lien-ket-3.jpg',
             'https://selac.vn/images/link/1137son-noi-that.png',
        ];
        $img = $images[$index % count($images)];
    @endphp
                <div class="product-card text-center">
                    <a href="{{ route('sanphamtheodanhmuc.show', $cat->id) }}">
                        <img src="{{ $img }}" alt="{{ $cat->TenLoaiSanPham }}" class="product-img">
                        <div class="product-info">
                            <h3 class="product-title">{{ $cat->TenLoaiSanPham }}</h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
    <!-- News Section -->
  <section class="news-section">
    <div class="container">
        <h2 class="section-title">Hướng dẫn sử dụng</h2>
        <div class="news-grid">
            @foreach($huongdan as $bv)
                <div class="news-card">
                    <a href="{{ route('baiviet.show', $bv->id) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset($bv->HinhAnh ?? 'images/no-image.png') }}" alt="{{ $bv->TieuDe }}" class="news-img">
                        <div class="news-info">
                            <h3 class="news-title">{{ $bv->TieuDe }}</h3>
                            <div class="news-date">
                                <i class="far fa-calendar-alt"></i>
                                <span>{{ $bv->updated_at->format('d/m/Y') }}</span>
                            </div>
                            <p class="news-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($bv->NoiDung), 200) }}</p>
                            <a href="{{ route('baiviet.show', $bv->id) }}" class="read-more">Chi tiết</a>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
