@extends('client.index')
<head>
        <link rel="stylesheet" href="{{ asset('ad_asset/css/style.css') }}">
    </head>
@section('main')
    <body>
        <main>
            <div class="container">
                <div class="login-container">
                    <div class="login-header">
                        <div class="paint-icon">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <h3>Đăng nhập vào tài khoản</h3>
                        <p class="text-muted">Chào mừng quý khách đến với SELAC Paint</p>
                       
                    </div>
                    
                    <form action="" method="POST" role="form">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i> Email
                            </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn">
                            @error('email') <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{$message}}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i> Mật khẩu
                            </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                            @error('password') <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{$message}}</small> @enderror
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p>Chưa có tài khoản? <a href="{{ Route('admin.register') }}" class="text-decoration-none fw-bold" style="color: var(--secondary-color);">Đăng ký ngay</a></p>
                    </div>
                </div>
                
                @if ($errors->any())
                <div class="alert alert-danger mx-auto" style="max-width: 450px;">
                    <h5 class="mb-3"><i class="fas fa-exclamation-triangle me-2"></i>Có lỗi xảy ra!</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-times-circle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </main>

        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
@endsection