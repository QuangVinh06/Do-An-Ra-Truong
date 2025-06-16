<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiSanPham;
use App\Models\SanPham;
use App\Models\DonViTinh;
use App\Models\Maus;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request){
        // $query = $request->input('search'); // Lấy từ khóa tìm kiếm
        // $sps = SanPham::with(['loaiSanPham', 'Maus','DonViTinh'])
        //     ->when($query, function ($q) use ($query) {
        //         $q->where('TenSanPham', 'like', '%' . $query . '%');
        //     })->orderBy('MaSanPham', 'desc')->get();
        $LoaiSanPham = LoaiSanPham::all();
        $DonViTinh = DonViTinh::all();
        $Mau = Maus::all();
        $sps = SanPham::orderBy('id', 'DESC')->paginate(20);
        return view('admin.product.index', compact('sps','DonViTinh','LoaiSanPham','Mau'));
    }


    public function store(Request $request)
    {
    $data = $request->validate([
        'TenGoi' => 'required|string|max:255',
        'MoTa' => 'nullable|string',
        'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'idLoaiSanPham' => 'required|exists:loai_san_phams,id',
        'idDonViTinh' => 'required|exists:don_vi_tinh,id',
        'idMau' => 'required|exists:maus,id',
    ]);
   
    if ($request->hasFile('HinhAnh')) {
        $image = $request->file('HinhAnh');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/img/sanpham'), $filename);
        $data['HinhAnh'] = '/img/sanpham/' . $filename;
    }

    if (SanPham::create($data)) {
        return redirect()->route('MNproduct.index')->with('success', 'Thêm sản phẩm thành công.');
    } else {
        return redirect()->back()->with('error', 'Vui lòng thử lại');
    }
    }


    public function edit(string $id)
    {
        $sps = SanPham::with(['loaiSanPham', 'mau', 'donViTinh'])->get();
        
        $sanpham = SanPham::with(['loaiSanPham', 'mau', 'donViTinh'])->findOrFail($id);
        
        $LoaiSanPham = LoaiSanPham::all();
        $DonViTinh = DonViTinh::all();
        $Mau = Maus::all(); // Kiểm tra lại tên model này, có thể nên là Mau::all()
        
        return view('admin.product.index', compact('sps', 'LoaiSanPham', 'DonViTinh', 'Mau', 'sanpham'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sanPham = SanPham::findOrFail($id);
        
        $data = $request->validate([
            'TenGoi' => 'required|string|max:255',
            'MoTa' => 'nullable|string',
            'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'idLoaiSanPham' => 'required|exists:loai_san_phams,id',
            'idDonViTinh' => 'required|exists:don_vi_tinh,id',
            'idMau' => 'required|exists:maus,id',
            
        ]);

        if ($request->hasFile('HinhAnh')) {
            // Xóa ảnh cũ nếu có
            if ($sanPham->HinhAnh && file_exists(public_path($sanPham->HinhAnh))) {
                unlink(public_path($sanPham->HinhAnh));
            }
            
            $image = $request->file('HinhAnh');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/img/sanpham'), $filename);
            $data['HinhAnh'] = '/img/sanpham/' . $filename;
        }
        
        $sanPham->update($data);
        return redirect()->route('MNproduct.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanPham = SanPham::findOrFail($id);
        
        // Xóa ảnh trước khi xóa bản ghi
        if ($sanPham->HinhAnh && file_exists(public_path($sanPham->HinhAnh))) {
            unlink(public_path($sanPham->HinhAnh));
        }
        
        $sanPham->delete();
        return redirect()->route('MNproduct.index')->with('success', 'Xóa sản phẩm thành công.');
    }
    public function baocao(){
        return view('admin.product.bctk');
    }
    public function baoCaoSanPham()
    {
        $thongKeSanPham = DB::table('chi_tiet_phieu_dat_hang')
        ->join('san_phams', 'chi_tiet_phieu_dat_hang.idSanPham', '=', 'san_phams.id')
        ->select(
            'san_phams.id',
            DB::raw('SUM(chi_tiet_phieu_dat_hang.SoLuong) as tong_so_luong'),
            DB::raw('SUM(chi_tiet_phieu_dat_hang.ThanhTien) as tong_tien')
        )
        ->groupBy('san_phams.id')
        ->orderByDesc('tong_tien')
        ->limit(5)
        ->get();

    // Bước 2: Lấy thông tin sản phẩm theo danh sách ID đã có và nạp quan hệ
    $sanPhamChiTiet = SanPham::with(['loaiSanPham', 'DonViTinh', 'Mau'])
        ->whereIn('id', $thongKeSanPham->pluck('id'))
        ->get()
        ->map(function ($sp) use ($thongKeSanPham) {
            $thongKe = $thongKeSanPham->firstWhere('id', $sp->id);
            $sp->tong_so_luong = $thongKe->tong_so_luong;
            $sp->tong_tien = $thongKe->tong_tien;
            return $sp;
        });

    // Trả về kết quả (hoặc view, hoặc JSON)
    return view('admin.product.bctk', compact('sanPhamChiTiet'));
}
    
}