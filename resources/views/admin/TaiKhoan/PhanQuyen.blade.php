@extends('Master.main')
@section('tittle','Phân quyền tài khoản')
@section('main')

<div class="container mt-5">
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

    <!-- Form Thêm/Sửa -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            {{ isset($phanquyen) ? 'Sửa phân quyền' : 'Thêm phân quyền' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($phanquyen) ? route('QLphanquyen.update', $phanquyen->id) : route('QLphanquyen.store') }}" method="POST">
                @csrf
                @if(isset($phanquyen))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="idTaiKhoan" class="form-label">Tài khoản</label>
                    <select id="idTaiKhoan" name="idTaiKhoan" class="form-select" required>
                        @foreach ($taikhoan as $tk)
                            <option value="{{ $tk->id }}" @if(isset($phanquyen) && $phanquyen->idTaiKhoan == $tk->id) selected @endif>
                                {{ $tk->name }} - {{ $tk->email }} - {{ $tk->VaiTro }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="idQuyen" class="form-label">Quyền</label>
                    <select id="idQuyen" name="idQuyen" class="form-select" required>
                        @foreach ($quyen as $q)
                            <option value="{{ $q->id }}" @if(isset($phanquyen) && $phanquyen->idQuyen == $q->id) selected @endif>
                                {{ $q->TenQuyen }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($phanquyen) ? 'Cập nhật' : 'Thêm' }} phân quyền</button>
                @if(isset($phanquyen))
                    <a href="{{ route('QLphanquyen.index') }}" class="btn btn-secondary">Hủy</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Danh sách -->
    <div class="card">
        <div class="card-header bg-success text-white">Danh sách phân quyền</div>
        <div class="card-body">
            <form action="{{ route('QLphanquyen.index') }}" method="GET" class="d-flex mb-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm..." value="{{ request('search') }}">
                <button class="btn btn-success">Tìm</button>
            </form>

            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>STT</th>
                        <th>Tên tài khoản</th>
                        <th>Vai trò</th>
                        <th>Quyền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pqs as $index => $pq)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pq->user->name }}</td>
                            <td>{{ $pq->user->VaiTro }}</td>
                            <td>{{ $pq->quyen->TenQuyen }}</td>
                            <td>
                                <a href="{{ route('QLphanquyen.edit', $pq->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                <form action="{{ route('QLphanquyen.destroy', $pq->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Xác nhận xóa?')">
                                    @csrf @method('DELETE')
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
