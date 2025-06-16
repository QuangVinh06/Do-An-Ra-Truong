<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('tittle')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom fonts for this template-->
    <link href="{{ asset('ad_asset/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('ad_asset/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Custom CSS để làm sidebar cố định */
        #accordionSidebar {
            position: fixed !important;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            width: 224px; /* Chiều rộng mặc định của sidebar */
        }

        /* Điều chỉnh content wrapper để không bị che bởi sidebar */
        #content-wrapper {
            margin-left: 224px;
            transition: margin-left 0.3s ease;
        }

        /* Khi sidebar bị thu gọn */
        body.sidebar-toggled #accordionSidebar {
            width: 6.5rem;
        }

        body.sidebar-toggled #content-wrapper {
            margin-left: 6.5rem;
        }

        /* Responsive cho mobile */
        @media (max-width: 768px) {
            #accordionSidebar {
                margin-left: -224px;
                transition: margin-left 0.3s ease;
            }

            #content-wrapper {
                margin-left: 0;
            }

            body.sidebar-toggled #accordionSidebar {
                margin-left: 0;
                width: 224px;
            }

            body.sidebar-toggled #content-wrapper {
                margin-left: 0;
            }
        }

        /* Tùy chỉnh scrollbar cho sidebar */
        #accordionSidebar::-webkit-scrollbar {
            width: 6px;
        }

        #accordionSidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        #accordionSidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        #accordionSidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Đảm bảo topbar không bị che */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 999;
        }
    </style>
</head>

@php
    $user = Auth::guard('admin')->user();
@endphp

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Users"
                    aria-expanded="true" aria-controls="Users">
                    <span>Quản lý hệ thống</span>
                </a>
                <div id="Users" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Quản lý hệ thống</h6>
                        <a class="collapse-item" href="{{ route('QLtaikhoan.index') }}">Người dùng</a>
                        <a class="collapse-item" href="{{ route('QLquyen.index') }}">Quản lý quyền</a>
                        <a class="collapse-item" href="{{route('QLphanquyen.index')}}">Phân quyền</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>Quản lý giới thiệu sản phẩm</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{Route('MNproduct.index')}}">Quản lý sản phẩm</a>
                        <a class="collapse-item" href="{{ Route('QLbaiviet.index') }}">Quản lý Bài viết</a>
                        <a class="collapse-item" href="{{ Route('QLkhuyenmai.index') }}">Quản lý Khuyến mãi</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Categorires"
                    aria-expanded="true" aria-controls="Categorires">
                    <span>Quản lý danh mục</span>
                </a>
                <div id="Categorires" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Quản lý danh mục</h6>
                        <a class="collapse-item" href="{{Route('color.index')}}">Bảng màu</a>
                        <a class="collapse-item" href="{{Route('productcategory.index')}}">Loại sản phẩm</a>
                        <a class="collapse-item" href="{{ Route('phuongthucthanhtoan.index') }}">Phương thức thanh toán</a>
                        <a class="collapse-item" href="{{ Route('QLloaikhachhang.index') }}">Loại khách hàng</a>
                        <a class="collapse-item" href="{{ Route('QLkho.index') }}">Kho</a>
                        <a class="collapse-item" href="{{Route('donvitinh.index')}}">Đơn vị tính</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Sales"
                    aria-expanded="true" aria-controls="Sales">
                    <span>Quản lý bán hàng</span>
                </a>
                <div id="Sales" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Quản lý bán hàng</h6>
                        <a class="collapse-item" href="{{ route('Baogia.index') }}">Quản lý bảng giá</a>
                        <a class="collapse-item" href="{{ route('QLthongtinkhachhang.index') }}">Quản lý thông tin khách hàng</a>
                        <a class="collapse-item" href="{{ route('qlphieudat.index') }}">Quản lý đặt hàng</a>
                        <a class="collapse-item" href="{{ route('QLhopdong.index') }}">Quản lý hợp đồng</a>
                        <a class="collapse-item" href="{{ route('Qlhoadon.index') }}">Quản lý thanh toán</a>
                        <a class="collapse-item" href="{{ route('QLdonhang.index') }}">Quản lý đơn hàng</a>
                        <a class="collapse-item" href="{{ route('QLdoitra.index') }}">Quản lý đổi trả</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Kho"
                    aria-expanded="true" aria-controls="Kho">
                    <span>Quản lý kho</span>
                </a>
                <div id="Kho" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Quản lý kho</h6>
                        <a class="collapse-item" href="{{ route('QLchitietkho.index') }}">Quản lý chi tiết kho</a>
                        <a class="collapse-item" href="{{ route('QLphieunhapkho.index') }}">Quản lý nhập kho</a>
                        <a class="collapse-item" href="{{ route('QLxuatkho.index') }}">Quản lý xuất kho</a>
                        <a class="collapse-item" href="{{ route('QLphieukiemke.index') }}">Quản lý kiểm kê kho</a>
                        <a class="collapse-item" href="{{ route('QLphieuchuyenkho.index') }}">Quản lý chuyển kho</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bctk"
                    aria-expanded="true" aria-controls="bctk">
                    <span>Báo cáo thống kê</span>
                </a>
                <div id="bctk" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Báo cáo thống kê</h6>
                        <a class="collapse-item" href="{{ route('QLchitietkho.baocao') }}">Báo cáo thống kê kho hàng</a>
                        <a class="collapse-item" href="{{ route('QLsanpham.baoCaoSanPham') }}">Báo cáo thống kê sản phẩm</a>
                        <a class="collapse-item" href="{{ route('QLKhachHang.baocao') }}">Báo cáo thống kê khách hàng</a>
                        <a class="collapse-item" href="{{ route('QLdonhang.baocao') }}">Báo cáo doanh số bán hàng</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-user mr-2"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Tài khoản</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="{{ route('doimatkhau.index',$user->VaiTro) }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div>
                        <h1 class="h3 mb-4 text-gray-800"></h1>
     
                        @yield('main')
                    </div>
 
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đồng ý đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Bạn có muốn đăng xuất không ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ Route('logout',$user->VaiTro) }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('ad_asset/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('ad_asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('ad_asset/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('ad_asset/js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>