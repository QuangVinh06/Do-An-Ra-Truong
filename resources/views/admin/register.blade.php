@extends('client.index')

@section('main')
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="ad_asset\css\style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .register-container {
            max-width: 450px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
        }
        .register-container h3 {
            font-weight: bold;
            color: #333;
        }
        .form-label {
            font-weight: 500;
            color: #555;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .text-center a {
            color: #007bff;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h3 class="text-center mb-4">Đăng ký tài khoản</h3>
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" id="name" name="name" >
            @error('name') <small class="text-danger"> {{$message}}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" >
            @error('email') <small class="text-danger"> {{$message}}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" >
            @error('password') <small class="text-danger"> {{$message}}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" >
            @error('confirm_password') <small class="text-danger"> {{$message}}</small> @enderror
        </div>
            
        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
    </form>

    <!-- Liên kết điều hướng -->
    <div class="text-center mt-3">
        <p>Đã có tài khoản? <a href="{{route('admin.login')}}" class="text-decoration-none">Đăng nhập ngay</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection