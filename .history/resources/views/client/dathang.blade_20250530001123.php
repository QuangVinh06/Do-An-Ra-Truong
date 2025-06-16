@extends('client.index')

@section('main')
<div class="container py-4">

    {{-- Breadcrumb --}}
    <div class="mb-3 text-right ">
        <a href="{{ route('client.lichsudathang') }}" class="btn btn-outline-primary  btn-lg bg-light">Lịch sử đặt hàng</a>
    </div>
    <div class="container">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
             <h4 class="alert-heading">Thông báo</h4>
            <h7>{{ Session::get('success') }}</h7>
        </div>
       
        @endif
        @if(Session::has('warning'))
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Thông báo</h4>
           <h7>{{ Session::get('warning') }}</h7>
       </div>
        @endif
    </div>
    {{-- Bảng đặt hàng --}}
    <div class="table-responsive shadow-sm p-3 bg-light border rounded">
               
            <table class="table table-bordered align-middle text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        {{-- <th>Giá khuyến mại</th> --}}
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                    @csrf
                </thead>
                <tbody>
                    @if(isset($cart) && $cart->items)
                    @foreach ($cart->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{$item->image}}" width="60"></td>
                        <td>{{ $item->name }}</td>
                        <td >
                            @if(is_object($item->price))
                                {{ isset($item->price->Gia) ? number_format($item->price->Gia, 0, ',', '.') : '0' }} VND
                            @else
                                {{ number_format($item->price, 0, ',', '.') }} VND
                            @endif
                        </td>
                        {{-- <td>{{ number_format($item->GiaKhuyenMai ?? 0, 0, ',', '.') }} VND</td> --}}
                        <td><form action="{{ route('dathang.update',$item->id) }}"method="get">
                            <input type="number"name="quantity"value="{{ $item->quantity }}"min='0' style="width:60px;text-align:center">
                            <button class="btn-primary" style="width:100px;height:28px;border-radius:4px">Cập nhật</button>
                            </form>
                        </td>
                        <td>  @if(is_object($item->price) && isset($item->price->Gia))
                            {{ number_format($item->quantity * $item->price->Gia, 0, ',', '.') }} VND
                        @else
                            {{ number_format($item->quantity * (float)$item->price, 0, ',', '.') }} VND
                        @endif</td>

                        {{-- <td><input type="text" name="ghichu[{{ $item->id }}]" class="form-control" value="{{ $item->GhiChu ?? '' }}"></td> --}}
                        <td>
                            @if(isset($item->id))
                                <a onclick="return confirm('Bạn có muốn xoá ko')" 
                                   href="{{ route('dathang.delete', ['id' => $item->id]) }}" 
                                   class="btn btn-sm btn-danger">Xóa sản phẩm </a>
                            @else
                                <button class="btn btn-sm btn-danger" disabled>Xóa sản phẩm</button>
                            @endif
                       

                        </td>
                        </tr>
                    @endforeach
                    @endif

                    <tr>
                        <th colspan="5"class="text-right">Tổng số lượng</th>
                        <th colspan="2">{{ $cart->tongsoluong }}(sản phẩm)</th>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right">Tổng tiền</th>
                        <th colspan="2">{{ number_format($cart->tongtien, 0, ',', '.') }} VND</th>
                    </tr>
                    @if($GiamGia>0)
                    <tr>
                        
                        <th colspan="2">Khuyến mãi{{ number_format($cart->tongtien * ($GiamGia / 100), 0, ',', '.') }} VND</th>
                    </tr>
                @endif
                            <tr>
                        <th colspan="5" class="text-right">Tổng tiền thanh toán</th>
                        <th colspan="2">{{ number_format($cart->tongtien - ($cart->tongtien * ($GiamGia / 100)), 0, ',', '.') }} VND</th>
                
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="text-center">
               
               <hr>
               <div class="alert alert-success"role="alert">
                <a href="{{ route('dathang.clear') }}"onclick="return confirm('Bạn có muốn huỷ ko')"  class="btn btn-primary btn-sm">Huỷ phần đặt hàng hiện tại</a>
                    <a href="{{ route('sanpham.index') }}" class="btn btn-primary btn-sm">Tiếp tục mua hàng</a>

               </div>
         
            </div>
            
            <form action="{{ route('dathang.addOrder') }}" method="POST">
                @csrf
            {{-- Phương thức thanh toán --}}
           
                <!-- Các sản phẩm lấy từ session/cart -->
                
                <!-- Phương thức thanh toán -->
                <input type="radio" name="phuong_thuc" value="1" checked> Thanh toán qua tài khoản ngân hàng
                <input type="radio" name="phuong_thuc" value="2"> Thanh toán trực tiếp
            <br>
                <!-- Ghi chú -->
                <br>
                <label for="">Lưu ý cho người bán:    </label>
                <input style="width:25%;padding:4px 12px;"name="ghi_chu"></input>

                <div class="d-flex justify-content-center">
                <button class="btn-primary" style="width:200px;height:50px;border-radius:8px" type="submit" >Đặt hàng</button>
                </div>
            </form>
        {{-- </form> --}}
    </div>
</div>


@endsection
