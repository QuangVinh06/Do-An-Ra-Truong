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
        $sps = SanPham::orderBy('id', 'DESC')->paginate(5);
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
  

    public function baoCaoSanPham(Request $request) 
    {
        $tongSanPham = SanPham::count();
    
        // === Tính doanh thu theo khoảng thời gian ===
        $doanhThuQuery = DB::table('phieu_dat_hang');
    
        if ($request->filled('from_date')) {
            $doanhThuQuery->whereDate('NgayLap', '>=', $request->from_date);
        }
    
        if ($request->filled('to_date')) {
            $doanhThuQuery->whereDate('NgayLap', '<=', $request->to_date);
        }
    
        // Nếu không lọc thì mặc định là doanh thu tháng hiện tại
        if (!$request->filled('from_date') && !$request->filled('to_date')) {
            $doanhThuQuery->whereYear('NgayLap', now()->year)
                          ->whereMonth('NgayLap', now()->month);
        }
    
        $doanhThuThang = $doanhThuQuery->sum('TongTien');
    
        // === Truy vấn sản phẩm bán chạy ===
        $query = DB::table('chi_tiet_phieu_dat_hang')
            ->join('phieu_dat_hang', 'chi_tiet_phieu_dat_hang.idPhieuDat', '=', 'phieu_dat_hang.id')
            ->join('san_phams', 'chi_tiet_phieu_dat_hang.idSanPham', '=', 'san_phams.id')
            ->join('loai_san_phams', 'san_phams.idLoaiSanPham', '=', 'loai_san_phams.id')
            ->join('maus', 'san_phams.idMau', '=', 'maus.id')
            ->join('don_vi_tinh', 'san_phams.idDonViTinh', '=', 'don_vi_tinh.id')
            ->select(
                'san_phams.id',
                'san_phams.TenGoi',
                'san_phams.MoTa',
                'san_phams.HinhAnh',
                'loai_san_phams.TenLoaiSanPham as TenLoaiSanPham',
                'maus.TenMau',
                'don_vi_tinh.TenDonViTinh',
                DB::raw('SUM(chi_tiet_phieu_dat_hang.SoLuong) as tong_so_luong'),
                DB::raw('SUM(chi_tiet_phieu_dat_hang.ThanhTien) as tong_tien')
            );
    
        // Lọc theo ngày nếu có
        if ($request->filled('from_date')) {
            $query->whereDate('phieu_dat_hang.NgayLap', '>=', $request->from_date);
        }
    
        if ($request->filled('to_date')) {
            $query->whereDate('phieu_dat_hang.NgayLap', '<=', $request->to_date);
        }
    
        $query->groupBy(
            'san_phams.id',
            'san_phams.TenGoi',
            'san_phams.MoTa',
            'san_phams.HinhAnh',
            'loai_san_phams.TenLoaiSanPham',
            'maus.TenMau',
            'don_vi_tinh.TenDonViTinh'
        );
    
        // Nếu có lọc theo loại sản phẩm
        if ($request->filled('category_id')) {
            $query->where('san_phams.idLoaiSanPham', $request->category_id);
        }
    
        $sanPhamBanChay = $query->orderByDesc('tong_tien')->limit(10)->get();
    
        $thongKeTheoLoai = $sanPhamBanChay->groupBy('TenLoaiSanPham')->map(function ($items) {
            return [
                'tong_so_luong' => $items->sum('tong_so_luong'),
                'tong_tien' => $items->sum('tong_tien'),
                'san_phams' => $items
            ];
        });
    
        $danhMucLoai = DB::table('loai_san_phams')->get();
    
        return view('admin.product.bctk', [
            'tongSanPham' => $tongSanPham,
            'doanhThuThang' => $doanhThuThang,
            'sanPhamBanChay' => $sanPhamBanChay,
            'thongKeTheoLoai' => $thongKeTheoLoai,
            'danhMucLoai' => $danhMucLoai,
        ]);
    }
    
    

    
}