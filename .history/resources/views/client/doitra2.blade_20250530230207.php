@extends('client.index')

@section('main')
<div class="container mt-4">
    <h2>Lịch sử đổi trả của bạn</h2>

    @if($doiTras->isEmpty())
        <p>Bạn chưa có phiếu đổi trả nào.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã phiếu</th>
                    <th>Ngày lập</th>
                    <th>Lý do đổi trả</th>
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
                        <td>{{ $phieu->GhiChu ?? 'Không có' }}</td>
                        <td>{{ $phieu->TrangThai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
