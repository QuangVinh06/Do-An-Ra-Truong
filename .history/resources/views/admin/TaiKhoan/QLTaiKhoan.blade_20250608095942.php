@extends('Master.main')

@section('main')
<div class="container mt-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-4 text-primary">Quản lý người dùng</h2>

    <!-- Thông báo -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
    <!-- Form Thêm/Sửa Tài khoản -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            {{ isset($taikhoan) ? 'Sửa Tài Khoản' : 'Thêm Tài Khoản' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($taikhoan) ? route('QLtaikhoan.update', $taikhoan->id) : route('QLtaikhoan.store') }}" method="POST">
                @csrf
                @if(isset($taikhoan))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="TenTaiKhoan" class="form-label">Tên Tài Khoản</label>
                    <input type="text" id="TenTaiKhoan" name="TenTaiKhoan" class="form-control" value="{{ $taikhoan->name ?? '' }}" required>
                </div>
                @if(!isset($taikhoan))
                    <div class="mb-3">
                        <label for="MatKhau" class="form-label">Mật Khẩu</label>
                        <input type="password" id="MatKhau" name="MatKhau" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="MatKhauNhapLai" class="form-label">Nhập Lại Mật Khẩu</label>
                        <input type="password" id="MatKhauNhapLai" name="MatKhauNhapLai" class="form-control" required>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="Gmail" class="form-label">Gmail</label>
                    <input type="email" id="Gmail" name="Gmail" class="form-control" value="{{ $taikhoan->email ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="VaiTro" class="form-label">Vai Trò</label>
                <input type="text" id="VaiTro" name="VaiTro" class="form-control" value="{{ $taikhoan->VaiTro ?? '' }}" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($taikhoan) ? 'Sửa' : 'Thêm' }} Tài Khoản</button>
                @if(isset($taikhoan))
                    <a href="{{ route('QLtaikhoan.index') }}" class="btn btn-secondary">Hủy</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Danh sách tài khoản -->
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Tài Khoản
        </div>
        <div class="card-body">
            <form action="{{ route('QLtaikhoan.index') }}" method="GET" class="d-flex mb-3">
                <input style="width: 600px;" type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm theo tên tài khoản hoặc email" value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </form>
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>STT</th>
                        <th>Tên Tài Khoản</th>
                        <th>Email</th>
                        <th>Vai Trò</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tks as $index => $tk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $tk->name }}</td>
                            <td>{{ $tk->email }}</td>
                            <td>{{ $tk->VaiTro }}</td>
                            <td>
                                <form action="{{ route('QLtaikhoan.edit', $tk->id) }}" method="GET" style="display: inline;">
                                  
                                    <button type="submit" class="btn btn-warning btn-sm">Sửa</button>
                                </form>
                                <form action="{{ route('QLtaikhoan.destroy', $tk->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             <div class="mt-4">
              {{ $tks->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
