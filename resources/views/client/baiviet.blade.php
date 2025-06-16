@extends('client.index')
@section('main')


 <style type="text/css" media="all">
    * {
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body {
  margin: 0;
  padding: 0;
  background: #fff;
  color: #333;
}

.containe {
  display: flex;
  padding: 20px;
  max-width: 1200px;
  margin: auto;
}

.sidebar {
  width: 25%;
  padding-right: 20px;
}

.sidebar h2,
.sidebar h3 {
  font-weight: bold;
  margin-bottom: 10px;
}

.menu {
  list-style: none;
  padding: 0;
  margin-bottom: 30px;
}

.menu li {
  padding: 8px 0;
  cursor: pointer;
}

.menu .active {
  font-weight: bold;
  color: #007bff;
}

.related-news .related-item {
  display: flex;
  gap: 10px;
  margin-bottom: 15px;
}

.related-item img {
width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
    background: #f5f5f5;
}

.content {
  width: 75%;
}

.news-item {
  display: flex;
  gap: 20px;
  margin-bottom: 30px;
  color: #333;
}
.news-item a:hover h3{
  color: #007bff;
}
p{
  color: #333;
}



.news-item img {
   width: 180px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    background: #f5f5f5;
}

.info h3 {
  margin-top: 0;
  font-size: 18px;
  color: #333;
}

.meta {
  font-size: 13px;
  color: #777;
  margin: 5px 0;
}

.info p {
  font-size: 14px;
  margin-bottom: 10px;
}

button {
  padding: 8px 16px;
  background: #111;
  color: white;
  border: none;
  cursor: pointer;
}

button:hover {
  background: #444;
}

  </style>

<div>
    <body>
        <div class="container mb-3">
        <div class="breadcrumb" style="gap:4px; ">
            <a href="/">Trang chủ</a> /
            <a href="#">Bài viết</a>
        </div>
    </div>

  <div class="containe">

    <aside class="sidebar">
     
      <h3>Các bài viết khác</h3>
     <div class="related-news">
    @foreach($baiviet_lienquan as $bv)
    <div class="related-item">
        <img src="{{ asset($bv->HinhAnh ?? 'images/no-image.png') }}" alt="{{ $bv->TieuDe }}">
        <p>{{ \Illuminate\Support\Str::limit($bv->TieuDe, 40) }}</p>
    </div>
        @endforeach
</div>
  </aside>
   <main class="content">
    <h2>Bài viết hướng dẫn thi công</h2>
    @foreach($baiviet as $bv)
    <a style="text-decoration: none; color: inherit;" href="{{ route('baiviet.show', $bv->id) }}">
        <div class="news-item">
            <img src="{{ asset($bv->HinhAnh ?? 'images/no-image.png') }}" alt="">
            <div class="info">
                <h3>{{ $bv->TieuDe }}</h3>
                <div class="meta">
                    📅 {{ $bv->updated_at->format('d/m/Y') }} | 📝 
                </div>
                <p>{{ \Illuminate\Support\Str::limit(strip_tags($bv->TomTat), 100) }}</p>
                <a href="{{ route('baiviet.show', $bv->id) }}">
                    <button>Đọc tiếp</button>
                </a>
            </div>
        </div>
    </a>
    @endforeach

    {{-- Phân trang --}}
    <div class="mt-4">
        {{ $baiviet->links('pagination::bootstrap-5') }}
    </div>
</main>
  </div>
</body>
</div>


@endsection