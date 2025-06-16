@extends('Master.main')

@section('main')


<div class="container mt-5">  
    <div class="mt-4 mb-3">  
        <a href="{{ route('QLphieunhapkho.index') }}" class="btn btn-secondary">Quay lại</a>  
    </div>  
    <h5>Mã phiếu nhập: {{ $nhap->id }}</h5>  
    <h5>Kho: {{ $nhap->kho->TenKho }}</h5>
    <table class="table table-bordered">  
        <thead>  
            <tr>  
                <th>STT</th>  
                <th>Mã sản phẩm</th>  
                <th>Tên sản phẩm</th>  
                <th>Số lượng</th>  
                <th>Đơn vị tính</th>  
            </tr>  
        </thead>  
        <tbody>
            @foreach ($ctnhap as $index=>$ct)
            <tr>  
                <td>{{ $index+1 }}</td>  
                <td>{{ $ct->idSanPham }}</td>  
                <td>{{ $ct->sanPham->TenSanPham }}</td>  
                <td>{{ $ct->SoLuong }}</td>  
                <td>{{ $ct->sanPham->donViTinh->TenDonViTinh }}  
                </td>  
            </tr>  
            @endforeach   
        </tbody>  
    </table>  
</div> 
@endsection