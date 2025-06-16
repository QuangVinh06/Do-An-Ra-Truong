@extends($user->VaiTro==='KhachHang'?'client.index':'Master.main')
<style>body {
    background-color: #f8f9fa; /* Màu nền nhẹ nhàng */
}

.card {
    border: none;
    background-color: #ffffff;
}

.card h2 {
    font-weight: bold;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}</style>
@section('main')
    @if(session('error'))
        <div class="alert alert-danger text-center mt-3">{{ session('error') }}</div>
    @endif
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 10px;">
            <form action="{{ route('doimatkhau.update', $user->id) }}" method="POST">
                @csrf
                @method('POST')
                <h2 class="text-center mb-4 text-primary">Đổi Mật Khẩu</h2>
                <div class="form-group mb-3">
                    <label for="old_password" class="form-label">Mật khẩu cũ:</label>
                    <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Nhập mật khẩu cũ" required>
                </div>
                <div class="form-group mb-3">
                    <label for="new_password" class="form-label">Mật khẩu mới:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                </div>
                <div class="form-group mb-4">
                    <label for="confirm_password" class="form-label">Nhập lại mật khẩu mới:</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu mới" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
@endsection