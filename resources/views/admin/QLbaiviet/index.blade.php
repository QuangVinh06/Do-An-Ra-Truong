<!-- filepath: c:\Users\LTC\Downloads\app-banson_v3\app-banson_v3\resources\views\admin\QLbaiviet\index.blade.php -->
@extends('Master.main')
@section('title', 'Quản lý bài viết')
@section('main')

<div class="container mt-4">
    <h2 class="text-center mb-4">Quản lý bài viết</h2>

    <!-- Thông báo thành công -->
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

    <div class="mb-3">
        <form action="{{ route('QLbaiviet.index') }}" method="GET" class="d-flex">
            <input style=" width:400px " type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm bài viết..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>
    </div>

    <!-- Nút thêm bài viết -->
    <div class="mb-3 text-end">
        <a href="{{ route('QLbaiviet.create') }}" class="btn btn-primary">Thêm bài viết mới</a>
    </div>

    <!-- Danh sách bài viết -->
    <div class="card">
        <div class="card-header bg-primary text-white">
 
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Ảnh đại diện</th>
                        <th>Tóm Tắt</th>
                        <th style="width: 150px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($baiviet as $index => $bv)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $bv->TieuDe }}</td>
                            <td>
                                @if($bv->HinhAnh)
                                    <img src="{{$bv->HinhAnh }}" alt="Thumbnail" style="width: 100px; height: 100px;">
                                @else
                                    Không có ảnh
                                @endif
                            </td>
                            <td>{{ $bv->TomTat }}</td>
                            <td >
                                <a href="{{ route('QLbaiviet.edit', $bv->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                <form action="{{ route('QLbaiviet.destroy', $bv->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Phân trang -->
            <div class="d-flex justify-content-center mt-3">
                {{ $baiviet->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection