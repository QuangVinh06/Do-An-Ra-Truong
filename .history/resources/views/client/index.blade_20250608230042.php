<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SƠN SELAC- Cửa hàng trực tuyến</title>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        a {
            text-decoration: none;
           
        }
        
        body {
            line-height: 1.5;
        }
        
        /* Header styles */
        .top-header {
            background-color: #333;
            color: white;
            padding: 10px 0;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .top-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .contact-info, .user-links {
            display: flex;
        }
        
        .contact-info span {
            margin-right: 20px;
        }
        
        .user-links a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }
        
        /* Logo section styles */
        .logo-container {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        
        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            text-decoration: none;
        }
        
        .logo .your {
            color: #4CAF50;
        }
        
        .logo .shop {
            color: #2196F3;
        }
        
        /* Navigation styles */
        .main-nav {
            background-color: white;
            border-bottom: 1px solid #eee;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .menu {
            display: flex;
            list-style: none;
        }
        
        .menu li {
            position: relative;
        }
        
        .menu li a {
            display: block;
            padding: 15px 20px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            transition: color 0.3s;
        }
        
        .menu li a:hover {
            color: #2196F3;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            width: 220px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: none;
            z-index: 1000;
        }
        
        .dropdown-menu li {
            width: 100%;
            border-bottom: 1px solid #eee;
            color: #333;
        }
        
        .dropdown-menu li:last-child {
            border-bottom: none;
        }
        .dropdown-menu .dropdown-item {
        color: #333 !important;
        font-weight: 500;
        transition: background 0.2s, color 0.2s;
        background-color: white; /* đảm bảo nền trắng */
        }
        .dropdown-menu .dropdown-item:hover {
            background-color: #f1f1f1; /* màu nền khi hover */
            color: #2196F3 !important; /* màu chữ khi hover */
        }
        
        .menu li:hover .dropdown-menu {
            display: block;
        }
        
        .cart-search {
            display: flex;
            align-items: center;
        }
        
        .search-icon, .cart-icon {
            font-size: 1.2rem;
            margin-left: 15px;
            cursor: pointer;
        }
        
        .cart-icon {
            position: relative;
        }
        
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #2196F3;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.7rem;
        }
        
        /* Hero banner styles */
        .hero-banner {
            background-color: #FFDE59;
            padding: 50px 0;
            position: relative;
            overflow: hidden;
        }
        
        .banner-content {
            width: 50%;
            padding-left: 5%;
        }
        
        .banner-title {
            font-size: 4rem;
            color: #FF5252;
            margin-bottom: 20px;
        }
        
        .banner-subtitle {
            font-size: 1.5rem;
            color: #FF7676;
            margin-bottom: 30px;
        }
        
        .btn-shop {
            display: inline-block;
            background: white;
            color: #4CAF50;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .btn-shop:hover {
            transform: translateY(-3px);
        }
        
        /* Products section styles */
       
      
        
 
        
        /* News section styles */
        .news-section {
            padding: 50px 0;
            background: #f9f9f9;
        }
        
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        
        .news-card {
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
        
            

        .menu > li {
            white-space: nowrap;    /* Ngăn chữ bị ngắt dòng */
        }
        .read-more {
            display: inline-block;
            background: #333;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            font-size: 0.9rem;
            border-radius: 3px;
            transition: background 0.3s;
        }
        
        .read-more:hover {
            background: #555;
        }
        
        /* Footer styles */
        .footer {
            background: white;
            padding-top: 50px;
            border-top: 1px solid #eee;
        }
        
        .brand-logos {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            opacity: 0.6;
        }
        
        .brand-logo img {
            height: 30px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: #2196F3;
        }
        
        .newsletter-form {
            display: flex;
        }
        
        .newsletter-input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-right: none;
        }
        
        .newsletter-btn {
            background: #333;
            color: white;
            border: none;
            padding: 0 15px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .newsletter-btn:hover {
            background: #555;
        }
        
        .social-links {
            display: flex;
            margin-top: 20px;
        }
        
        .social-link {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            color: #666;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }
        
        .social-link:hover {
            background: #2196F3;
            color: white;
        }
        
        .footer-bottom {
            padding: 15px 0;
            text-align: center;
            color: #999;
            font-size: 0.9rem;
            border-top: 1px solid #eee;
        }
        
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: #333;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s, background 0.3s;
            z-index: 1000;
        }
        
        .back-to-top:hover {
            opacity: 1;
            background: #555;
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            .products-grid, .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .banner-content {
                width: 100%;
                text-align: center;
                padding: 0 20px;
            }
            
            .banner-title {
                font-size: 3rem;
            }
           
            
            .mobile-menu-icon {
                display: block;
                font-size: 1.5rem;
                cursor: pointer;
            }
        }
        
        @media (max-width: 576px) {
            .products-grid, .news-grid, .footer-content {
                grid-template-columns: 1fr;
            }
            
            .contact-info {
                display: none;
            }
        }
    </style>

</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="contact-info">
                <span>Hotline 096.209.1111</span>
                <span>Email: info@selac.vn</span>
            </div>
          <div class="user-links">
            @auth
        <div class="dropdown">
            <a class=" dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name ?? 'Tài khoản' }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('client.thongtinkhachhang.edit', Auth::user()->VaiTro) }}">Thông tin khách hàng</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('doimatkhau.index', Auth::user()->VaiTro) }}">Đổi mật khẩu</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout', Auth::user()->VaiTro) }}">Đăng xuất</a>
                </li>
            </ul>
        </div>
    @else
        <a href="{{ route('admin.login') }}">Đăng nhập</a>
        <a href="{{ route('admin.register') }}">Đăng ký</a>
        <a href="{{ route('lienhe') }}">Liên hệ</a>
    @endauth
</div>
        </div>
    </div>
    
    <!-- Logo -->
    <div class="logo-container">
        <a href="#" class="logo">
            <span class="your">SELAC</span> <span class="shop">.VN</span>
        </a>
    </div>
    
    <!-- Main Navigation -->
    <nav class="main-nav">
        <div class="container nav-container">
            <ul class="menu">
                <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                <li><a href="{{ route('gioithieu') }}">Giới thiệu</a></li>
                <li>
                    <a href="{{ route('sanpham.index') }}">Sản phẩm ▾</a>
                    <ul class="dropdown-menu ">
                        @foreach ($pc->take(10) as $category)
                            <li><a style="font-size: 12px; font-weight: 600;" class="dropdown-item" href="{{ route('sanphamtheodanhmuc.show', $category->id) }}">{{ $category->TenLoaiSanPham }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ route('baiviet.index') }}">Hướng dẫn sử dụng</a></li>
                <li><a href="{{ route('khuyenmai.index') }}">Khuyến mãi</a></li>
                @Auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dathang.view') }}">Đặt hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('donhang.view') }}">Đơn hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('thanhtoan.index') }}">Thanh toán</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link href="{{ route('lienhe') }}">Liên hệ</a>
                </li>

                @endauth
            </ul>
            
            {{-- <div class="cart-search">
                <div class="search-icon">
                    <i class="fas fa-search"></i>
                </div>
                <div class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">0</span>
                </div>
            </div> --}}
        </div>
    </nav>
    
    <!-- Hero Banner -->
   @yield('main')
    <!-- Footer -->
    <footer class="footer">
    <div class="container">
        <div class="footer-content" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 30px; padding: 40px 0;">

            <!-- Cột 1: Liên hệ -->
            <div class="footer-column" style="flex: 1; min-width: 250px;">
                <h3>LIÊN HỆ VỚI CHÚNG TÔI</h3>
                <p><strong>Trụ sở chính:</strong><br>
                    Lô D1, KCN Tràng Duệ, An Dương, Hải Phòng<br>
                    Tel: (+84) 225.3929.268<br>
                    Mobile: (+84) 96.209.1111<br>
                    Email: info@selac.vn<br>
                    Website: https://selac.vn
                </p>
                <p><strong>VPGD tại Hà Nội</strong><br>
                    Số 9/25 đường Bùi Huy Bích, P. Hoàng Liệt, Quận Hoàng Mai<br>
                    Tel: (+84) 24.3.722.5115<br>
                    Mobile: (+84) 933.381.088<br>
                    Email: leha@selac.vn
                </p>
                <p><strong>Nhà máy sản xuất tại Bình Dương</strong><br>
                    CÔNG TY TNHH SƠN BỘT VLC<br>
                    Số 11, đường số 2, KCN Sóng Thần 3, P. Phú Tân, TP. Thủ Dầu Một<br>
                    Tel: (+84) 274.3631.693<br>
                    Hotline: (+84) 783.480.999<br>
                    Email: thanhtuan@selac.vn
                </p>
            </div>

           
            <div class="footer-column" style="flex: 1; min-width: 200px;">
                <h3>Thời gian làm việc</h3>
                <ul class="footer-links">
                    <li>Thứ Hai: 08:00 - 17:00</li>
                    <li>Thứ Ba: 08:00 - 17:00</li>
                    <li>Thứ Tư: 08:00 - 17:00</li>
                    <li>Thứ Năm: 08:00 - 17:00</li>
                    <li>Thứ Sáu: 08:00 - 17:00</li>
                    <li>Thứ Bảy: 08:00 - 17:00</li>
                    <li>Chủ Nhật: ĐÓNG CỬA</li>
                </ul>

              
            </div>

            <!-- Cột 3: Danh mục -->
            <div class="footer-column" style="flex: 1; min-width: 200px;">
                <h3>DANH MỤC</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('gioithieu') }}">Giới thiệu</a></li>
                    <li><a href="{{ route('sanpham.index') }}">Sản phẩm</a></li>

                    <li><a href="{{ route('baiviet.index') }}">Hướng dẫn sử dụng</a></li>
                    <li><a href="">Bản đồ</a></li>
                  
                </ul>
            </div>

            <!-- Cột 4: Kết nối Facebook -->
            <div class="footer-column" style="flex: 1; min-width: 250px;">
                <h3>KẾT NỐI SƠN SELAC</h3>
                <div class="facebook-plugin">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/selac.vn"
                        width="100%" height="200" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                        allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</footer>

    
    <!-- Back to Top Button -->
    <div class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>
    
    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Implement Quick View functionality
        function initQuickView() {
            // This is just a simplified version of the original code
            $(document).on('click', '.quick-view', function(e) {
                e.preventDefault();
                alert('Chức năng xem nhanh sản phẩm sẽ hiển thị ở đây');
            });
        }
        
        // Initialize Quick View
        $(document).ready(function() {
            initQuickView();
            
            // Back to top button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('.back-to-top').fadeIn();
                } else {
                    $('.back-to-top').fadeOut();
                }
            });

            // Click back to top
            $('.back-to-top').click(function() {
                $('html, body').animate({scrollTop: 0}, 600);
                return false;
            });
        });
    </script>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
   