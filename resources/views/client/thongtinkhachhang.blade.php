@extends('client.index')
@section('main')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Tiêu đề trang -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold text-primary mb-1">Thông tin cá nhân</h2>
                    <p class="text-muted mb-0">Quản lý thông tin tài khoản của bạn</p>
                </div>
               
            </div>

            <!-- Thẻ thông tin người dùng -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Sidebar thông tin tài khoản -->
                       
                        
                        <!-- Form thông tin cá nhân -->
                        <div class="col-md-9">
                            <div class="profile-content p-4">
                                @if (session('success'))
                                    <div class="alert alert-success d-flex align-items-center rounded-3 border-0" role="alert">
                                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                                        <div>{{ session('success') }}</div>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger d-flex align-items-center rounded-3 border-0" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                                        <div><strong>Lỗi:</strong> {{ session('error') }}</div>
                                    </div>
                                @endif

                                <form action="{{ route('thongtinkhachhang.update')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <h5 class="card-title fw-bold mb-4">
                                                <i class="bi bi-person-lines-fill me-2 text-primary"></i>Thông tin cơ bản
                                            </h5>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="TenTaiKhoan" class="form-label">Tên tài khoản</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0">
                                                    <i class="bi bi-person text-muted"></i>
                                                </span>
                                                <input type="text" name="name" class="form-control border-start-0 bg-light" value="{{ $khachHang->user->name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="Gmail" class="form-label">Địa chỉ email</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-envelope text-muted"></i>
                                                </span>
                                                <input type="email" name="email" class="form-control" value="{{ $khachHang->user?->email }}" placeholder="Nhập địa chỉ email">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="DiaChi" class="form-label">Địa chỉ</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-geo-alt text-muted"></i>
                                                </span>
                                                <input type="text" name="DiaChi" class="form-control" value="{{ $khachHang->DiaChi }}" placeholder="Nhập địa chỉ" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="SoDienThoai" class="form-label">Số điện thoại</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-telephone text-muted"></i>
                                                </span>
                                                <input type="text" name="SoDienThoai" class="form-control" value="{{ $khachHang->SoDienThoai }}" placeholder="Nhập số điện thoại" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="card-title fw-bold mb-4 border-top pt-4">
                                                <i class="bi bi-star me-2 text-primary"></i>Thông tin hạng khách hàng
                                            </h5>
                                            <div class="customer-level-info bg-light p-4 rounded-3 mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="level-icon me-3">
                                                        <i class="bi bi-award fs-1 text-primary"></i>
                                                    </div>
                                                    <div>
                                                     
                                                        <h6 class="mb-1">Hạng khách hàng hiện tại: <span class="text-primary fw-bold">{{ $khachHang->loaikhachhang->TenLoaiKhachHang }}</span></h6>
                                                        <p class="mb-0 text-muted">Số đơn hàng đã hoàn thành: <span class="fw-bold">                {{ $soDonHangHoanThanh }}


                                                        <p class="mb-0 small text-muted">Hoàn thành thêm đơn hàng để nâng cấp hạng thành viên và nhận nhiều ưu đãi hơn.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-check2 me-1"></i>Cập nhật thông tin
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* CSS cho trang thông tin cá nhân */
    .avatar-circle {
        width: 80px;
        height: 80px;
        background-color: var(--bs-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar-initials {
        color: white;
        font-size: 32px;
        font-weight: bold;
        text-transform: uppercase;
    }
    
    .profile-sidebar {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .nav-pills .nav-link.active {
        background-color: var(--bs-primary);
    }
    
    .nav-pills .nav-link {
        color: #495057;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link:hover:not(.active) {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
    }
    
    .form-control:focus,
    .input-group-text {
        border-color: #dee2e6;
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.15);
    }
    
    .input-group-text {
        border-right: none;
    }
    
    .form-control[readonly] {
        background-color: #f8f9fa;
        opacity: 0.8;
    }
    
    /* Responsive */
    @media (max-width: 767.98px) {
        .profile-sidebar {
            height: auto;
            margin-bottom: 1.5rem;
        }
        
        .avatar-circle {
            width: 60px;
            height: 60px;
        }
        
        .avatar-initials {
            font-size: 24px;
        }
    }
</style>
@endpush
@endsection