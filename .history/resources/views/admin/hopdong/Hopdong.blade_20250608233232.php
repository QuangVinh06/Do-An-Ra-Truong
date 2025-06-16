@extends('Master.main')
@section('tittle','Quản lý hợp đồng')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Quản lý hợp đồng</h4>
        </div>

        {{-- Thông báo --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="card-header bg-primary text-white">
            {{ isset($hopdong) ? 'Sửa hợp đồng' : 'Thêm hợp đồng' }}
        </div>

        <div class="card-body">
            <form action="{{ isset($hopdong) ? route('QLhopdong.update', $hopdong->id) : route('QLhopdong.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($hopdong)) @method('PUT') @endif

                <div class="row">
                    <div class="col-md-6">
                        {{-- Mã hợp đồng --}}
                        

                        {{-- Ngày giao --}}
                        <div class="mb-3">
                            <label for="NgayGiaoHang" class="form-label">Ngày giao</label>
                            <input type="date" class="form-control" id="NgayGiaoHang" name="NgayGiaoHang" value="{{ $hopdong->NgayGiaoHang ?? '' }}">
                        </div>

                        {{-- Người giao --}}
                        <div class="mb-3">
                            <label for="NguoiGiao" class="form-label">Người giao</label>
                            <input type="text" class="form-control" id="NguoiGiaoHang" name="NguoiGiaoHang" value="{{ $hopdong->NguoiGiaoHang ?? '' }}">
                        </div>

                        {{-- Giá trị hợp đồng --}}
                        
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="NgayLap" class="form-label">Ngày lập</label>
                            <input type="text" class="form-control" value="{{ now()->format('d/m/Y') }}" disabled>
                            <input type="hidden" name="NgayLap" value="{{ now()->format('Y-m-d') }}">
                        </div>

                        {{-- Thời gian kết thúc --}}
                        <div class="mb-3">
                            <label for="ThoiGianKetThuc" class="form-label">Thời gian kết thúc</label>
                            <input type="date" class="form-control" id="ThoiGianKetThuc" name="ThoiGianKetThuc" value="{{ $hopdong->ThoiGianKetThuc ?? '' }}">
                        </div>

                        {{-- Thuế --}}
                        <label for="Thue">Thuế (%)</label>
                        <input type="number" id="Thue" name="Thue" class="form-control" value="{{ $hopdong->Thue ?? '' }}" required>
                    </div>
                </div>

                {{-- Phiếu đặt và Tiền cọc --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="idPhieuDat" class="form-label">Phiếu đặt</label>
                        <select class="form-control" id="idPhieuDat" name="idPhieuDat" required>
                            <option value="">-- Chọn phiếu đặt --</option>
                            @foreach($PhieuDat as $pd)
                                <option value="{{ $pd->id }}" 
                                    {{ isset($hopdong) && $hopdong->idPhieuDat == $pd->id ? 'selected' : '' }}
                                    data-tongtien="{{ $pd->TongTien }}">
                                    Phiếu #{{ $pd->id }} - {{ number_format($pd->TongTien) }} đ - {{ date('d/m/Y', strtotime($pd->NgayLap)) }} - {{ $pd->TenKhachHang}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                   
                    @if(isset($hopdong))
                    <div class="mb-3">
                        <label for="GiaTriHopDong" class="form-label">Giá Trị Hợp Đồng</label>
                        <input type="text" class="form-control" value="{{ number_format($hopdong->GiaTriGocHopDong, 0, ',', '.') }} đ" disabled>
                    </div>
                
                    <div class="mb-3">
                        <label for="TienCoc" class="form-label">Tiền Cọc</label>
                        <input type="text" class="form-control" value="{{ number_format($hopdong->TienCoc, 0, ',', '.') }} đ" disabled>
                    </div>
                @endif
                </div>

                {{-- Trạng thái hợp đồng & trạng thái cọc --}}
               
              
                {{-- File hợp đồng --}}
                <div class="mb-3">
                    <label for="FileHopDong" class="form-label">Tệp hợp đồng</label>
                    
                    @if (isset($hopdong) && $hopdong->FileHopDong)
                        <p>File hiện tại: 
                            <a href="{{ asset($hopdong->FileHopDong) }}" target="_blank">
                                {{ basename($hopdong->FileHopDong) }}
                            </a>
                        </p>
                    @endif
                
                    <input type="file" name="FileHopDong" class="form-control" {{ isset($hopdong) ? '' : 'required' }}>
                </div>

                {{-- Submit --}}
                <div class=" mb-3">
                    @if(!isset($hopdong))
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    @endif
                    @if(isset($hopdong))
                        <a href="{{ route('QLhopdong.index') }}" class="btn btn-secondary">Hủy</a>
                    @endif
                </div>
            </form>
            <h2 class="text-center mb-4 text-primary">DANH SÁCH HỢP ĐỒNG</h2>

            <div class="row mb-1">  
                <form action="{{ route('QLhopdong.index') }}" method="GET" class="search-form ">
                    <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">  
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>     
            </div>        
            {{-- Bảng danh sách hợp đồng --}}
            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã HĐ</th>
                            <th>Phiếu đặt</th>
                            <th>Thuế</th>
                            <th>Ngày lập</th>
                            <th>Thời gian kết thúc</th>
                            <th>Ngày giao hàng</th>
                            <th>Thuế</th>
                            
                            <th>Trạng thái cọc</th>
                            <th>Trạng thái hợp đồng</th>
                            <th>File HĐ</th>
                            <th>Chi tiết</th>
                            <th style="width:150px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hds as $index => $hd)
                        <tr>
                            <td>{{ $hd->id }}</td>
                            <td>{{ $hd->idPhieuDat }}</td>
                            <td>{{ $hd->Thue }}%</td>
                            <td>{{ $hd->NgayLap }}</td>
                            <td>{{ $hd->ThoiGianKetThuc }}</td>
                            <td>{{ $hd->NgayGiaoHang }}</td>
                            <td>{{ $hd->Thue }}</td>
                            <td>{{ $hd->TrangThaiCoc }}</td>
                            <td>
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $ngayLap = \Carbon\Carbon::parse($hd->NgayLap);
                                    $thoiGianKetThuc = \Carbon\Carbon::parse($hd->ThoiGianKetThuc);
                                @endphp
                            
                                @if ($today->between($ngayLap, $thoiGianKetThuc))
                                    Đang thực hiện
                                @else
                                    Đã kết thúc
                                @endif
                            </td>                        
                            <!-- Thêm cột trạng thái cọc -->
                            {{-- <td>
                                
                                    {{ $hd->TrangThaiCoc }}
                           
                               
                            </td>
                        
                            <!-- Cột trạng thái hợp đồng -->
                            <td>
                              
                                    {{ $hd->TrangThaiHopDong }}
                                   
                            </td> --}}
                        
                            <td>
                                <a href="{{ route('hopdong.download', $hd->id) }}" class="btn btn-primary">Tải hợp đồng</a>

                            </td>
                            <td>
                                <a href="{{ route('QLhopdong.show', $hd->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                            </td>
                            <td>
                                <form action="{{ route('QLhopdong.edit', $hd->id) }}" method="GET" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Xem</button>
                                </form>
                                <form action="{{ route('QLhopdong.destroy', $hd->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa hợp đồng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" style="height:38px">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center">Không có hợp đồng nào.</td>
                        </tr>
                        @endforelse
                        
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    {{ $hds->links('pagination::bootstrap-5') }}
</div>  
@endsection
<!-- Modal xem PDF -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width:90%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfModalLabel">Xem file PDF</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <iframe id="pdfFrame" src="" width="100%" height="600px" style="border:none;"></iframe>
        </div>
      </div>
    </div>
  </div>
  