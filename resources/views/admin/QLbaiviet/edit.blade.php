
@extends('Master.main')
@section('title', isset($baiviet) ? 'Chỉnh sửa bài viết' : 'Thêm bài viết mới')
@section('main')

<style>
    .ck-content {
        width: 100%;
        max-width: 100%; 
        height: 240px; 
        resize: vertical; 
        
    }
</style>
<div class="container mt-4">
    <h2 class="text-center mb-4">{{ isset($baiviet) ? 'Chỉnh sửa bài viết' : 'Thêm bài viết mới' }}</h2>

    <!-- Form thêm/sửa bài viết -->
    <div class="card">
        <div class="card-header bg-primary text-white">
          
        </div>
        <div class="card-body">
            <form action="{{ isset($baiviet) ? route('QLbaiviet.update', $baiviet->id) : route('QLbaiviet.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                 @if(isset($baiviet))
                     @method('PUT')
              @endif
                <div class="mb-3">
                    <label for="TieuDe" class="form-label">Tiêu đề bài viết</label>
                    <input type="text" name="TieuDe" id="title" class="form-control" placeholder="Nhập tiêu đề bài viết" value="{{ $baiviet->TieuDe ?? '' }}" required>
                </div>
                     <div class="mb-3">
                    <label for="TomTat" class="form-label">Tóm tắt bài viết</label>
                    <input type="text" name="TomTat" id="TomTat" class="form-control" placeholder="Nhập tóm tắt bài viết" value="{{ $baiviet->TomTat ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label for="HinhAnh" class="form-label">Ảnh đại diện</label>
                    @if(isset($baiviet) && $baiviet->HinhAnh)
                        <div class="mb-2">
                            <img src="{{$baiviet->HinhAnh}}" alt="HinhAnh" style="width: 150px; height: auto;">
                        </div>
                    @endif
                    <input type="file" name="HinhAnh" id="HinhAnh" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="NoiDung" class="form-label">Nội Dung</label>
                    <textarea name="NoiDung" id="NoiDung" class="form-control" rows="5" placeholder="Nhập nội dung bài viết">{!! $baiviet->NoiDung ?? '' !!}</textarea>
                </div>

                <button type="submit" class="btn btn-success">{{ isset($baiviet) ? 'Cập nhật' : 'Thêm mới' }}</button>
                <a href="{{ route('QLbaiviet.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#NoiDung')) 
        .catch(error => {
            console.error(error);
        });
</script>
@endsection