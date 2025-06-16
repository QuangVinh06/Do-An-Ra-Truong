@extends('Master.main')

@section('main')

<div class="container mt-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-4 text-primary">Quản lý kho</h2>

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
@if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif
    <!-- Form Thêm/Sửa  -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            {{ isset($kho) ? 'Sửa kho' : 'Thêm kho' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($kho) ? route('QLkho.update', $kho->id) : route('QLkho.store') }}" method="POST">
                @csrf
                @if(isset($kho))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="TenKho" class="form-label">Tên kho</label>
                    <input type="text" id="TenKho" name="TenKho" class="form-control" value="{{ $kho->TenKho ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="DiaChi" class="form-label">Địa chỉ</label>
                    <input type="text" id="DiaChi" name="DiaChi" class="form-control" value="{{ $kho->DiaChi ?? '' }}" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($kho) ? 'Sửa' : 'Thêm' }} kho</button>
                @if(isset($kho))
                    <a href="{{ route('QLkho.index') }}" class="btn btn-secondary">Hủy</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Danh sách  -->
    <div class="card">
        <div class="card-header bg-success text-white">
            Danh Sách Kho
        </div>
        <div class="card-body">
            <form action="{{ route('QLkho.index') }}" method="GET" class="d-flex mb-3">
                <input style="height:40px" type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </form>
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>STT</th>
                        <th>Tên kho</th>
                        <th>Địa chỉ</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ks as $index => $k)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $k->TenKho}}</td>
                            <td>{{ $k->DiaChi }}</td>
                            <td>
                                <a href="{{ route('QLkho.edit', $k->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('QLkho.destroy', $k->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa kho này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
