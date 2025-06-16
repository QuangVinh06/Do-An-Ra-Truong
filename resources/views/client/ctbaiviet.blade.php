@extends('client.index')

@section('main')
<style>
    .related-item {
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 10px;
    margin-bottom: 10px;
    transition: background 0.2s, color 0.2s;
    color: #222;
}

.related-item:hover p {
    color: #1976d2;
}
    .article-page {
       
    }
    .article-title {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }
    .article-meta {
        font-size: 14px;
        color: #6c757d;
    }
    .article-body {
        font-size: 16px;
        line-height: 1.6;
        color: #495057;
    }
    .article-body img {
        max-width: 100%;
        height: auto;
        margin: 20px 0;
    }
</style>
<div class="article-page py-4">
    <div class="container">
        <div class="mb-3">
            <ul class="breadcrumb" style="gap:4px; ">
                <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('baiviet.index') }}">Bài viết</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $baiviet->TieuDe }}</li>
        </ul>
    </div>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="sidebar">
                    @if(!empty($baiviet_lienquan))
                        <h5 class="mb-3">Bài viết liên quan</h5>
                        <div class="related-news">
                           @foreach($baiviet_lienquan as $bv)
                          <a href="{{ route('baiviet.show', $bv->id) }}" class="related-item mb-3 d-flex text-decoration-none" style="color: inherit;">
                              <img src="{{ asset($bv->HinhAnh ?? 'images/no-image.png') }}" alt="{{ $bv->TieuDe }}" class="me-2" style="width: 60px; height: 60px; object-fit: cover; margin-right: 10px;">
                          <div>
                              <p class="mb-0">{{ \Illuminate\Support\Str::limit($bv->TieuDe, 40) }}</p>
                          </div>
                        </a>
                    @endforeach
                        </div>
                    @endif

                   
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="card border-0 ">
                    <div class="card-body article-content">
                        <h1 class="article-title mb-3">{{ $baiviet->TieuDe }}</h1>

                        <div class="article-meta d-flex align-items-center mb-4">
                            <span class="text-muted me-3">
                                <i class="far fa-calendar-alt me-1"></i> 
                                Cập nhật: {{ $baiviet->updated_at->format('d/m/Y') }}
                            </span>
                            @if(!empty($baiviet->author))
                            <span class="text-muted">
                                <i class="far fa-user me-1"></i> 
                                {{ $baiviet->author }}
                            </span>
                            @endif
                        </div>

                        <div class="article-body" >
                            {!! $baiviet->NoiDung !!}
                        </div>

                        @if(!empty($baiviet->tags))
                        <div class="article-tags mt-4 pt-3 border-top">
                            <span class="fw-bold me-2">Tags:</span>
                            @foreach($baiviet->tags as $tag)
                                <a href="#" class="badge bg-light text-dark text-decoration-none me-1">{{ $tag }}</a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .breadcrumb {
        font-size: 14px;
        color: #555;
    }
    .breadcrumb a {
        color: #0d6efd;
        text-decoration: none;
    }
    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .sidebar .list-group-item {
        border-left: none;
        border-right: none;
        transition: all 0.2s ease;
    }
    .sidebar .list-group-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }
    .sidebar .list-group-item.active {
        background-color: #e7f1ff;
        color: #0d6efd;
        font-weight: 500;
    }

    .article-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
    }
    .article-content {
        background-color: #ffffff;
        padding: 2rem;
    }
    .article-body {
        font-size: 16px;
        line-height: 1.7;
        color: #444;
    }
    .article-body h2 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        font-weight: 600;
    }
    .article-body img {
        max-width: 100%;
        height: auto;
       
        margin: 1rem 0;
    }
    .article-body table {
        width: 100%;
        margin-bottom: 1rem;
        border-collapse: collapse;
    }
    .article-body table th,
    .article-body table td {
        padding: 0.75rem;
        border: 1px solid #dee2e6;
    }
    .article-body table th {
        background-color: #f8f9fa;
    }

    .related-news {
        border-top: 2px solid #e0e0e0;
        padding-top: 16px;
        margin-top: 12px;
    }
    .related-item {
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }
    .related-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .related-item img {
        border-radius: 6px;
    }

    @media (max-width: 991.98px) {
        .article-content {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const articleImages = document.querySelectorAll('.article-body img');
        articleImages.forEach(img => {
            img.classList.add('img-fluid');
            // Optional: Add lightbox trigger
        });
    });
</script>
@endpush
