@extends('client.layout')

@section('content')
<div class="container mt-4">
    <h2>Lịch sử đổi trả</h2>

    @if($doiTras->isEmpty())
        <p>Bạn chưa có phiếu đổi trả nào.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã phiếu</th>
                    <th>Ngày lập</th>
                    <th>Mô tả</th>
                    <th>Ghi chú</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doiTras as $phieu)
                    <tr>
                        <td>{{ $phieu->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($phieu->NgayLap)->format('d/m/Y') }}</td>
                        <td>{{ $phieu->MoTa }}</td>
                        <td>{{ $phieu->GhiChu }}</td>
                        <td>{{ $phieu->TrangThai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
