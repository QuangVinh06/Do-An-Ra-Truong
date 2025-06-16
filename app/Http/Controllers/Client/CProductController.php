<?php

namespace App\Http\Controllers\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\BaiViet;
use App\Models\KhachHang;
use App\Models\BangGia;
use App\Models\Maus;
class CProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{

    $sort = $request->sort;

    // Nếu cần sắp xếp theo giá thì JOIN bảng bang_gia
    if (in_array($sort, ['price_asc', 'price_desc'])) {
        $query = SanPham::query()
            ->leftJoin('bang_gia', 'san_phams.id', '=', 'bang_gia.idSanPham')
            ->select('san_phams.*', 'bang_gia.Gia')
            ->with(['LoaiSanPham', 'banggia']);
    } else {
        $query = SanPham::query()->with(['LoaiSanPham', 'banggia']);
    }

    // Tìm kiếm theo tên
    if ($request->filled('q')) {
        $query->where('TenGoi', 'like', '%' . $request->q . '%');
    }

    // Sắp xếp
    switch ($sort) {
        case 'az':
            $query->orderBy('TenGoi', 'asc');
            break;
        case 'za':
            $query->orderBy('TenGoi', 'desc');
            break;
        case 'price_asc':
            $query->orderBy('Gia', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('Gia', 'desc');
            break;
        case 'newest':
            $query->orderBy('san_phams.id', 'desc');
            break;
        case 'oldest':
            $query->orderBy('san_phams.id', 'asc');
            break;
        default:
            $query->orderBy('san_phams.id', 'desc');
            break;
    }
       $productcategory = LoaiSanPham::orderBy('id', 'DESC')->paginate(20);

    // Phân trang + giữ query string
    $data = $query->paginate(9)->appends($request->query());
    $colors= Maus::orderBy('id', 'DESC')->paginate(20);
    return view('client.sanpham', compact('data','colors','productcategory'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

        public function show(Request $request, $id)
    {
        
        $query = SanPham::query()->where('idLoaiSanPham', $id);
       $sort = $request->sort;

    // Nếu cần sắp xếp theo giá thì JOIN bảng bang_gia
    if (in_array($sort, ['price_asc', 'price_desc'])) {
        $query 
            ->leftJoin('bang_gia', 'san_phams.id', '=', 'bang_gia.idSanPham')
            ->select('san_phams.*', 'bang_gia.Gia')
            ->with(['LoaiSanPham', 'banggia']);
    } 

    // Tìm kiếm theo tên
    if ($request->filled('q')) {
        $query->where('TenGoi', 'like', '%' . $request->q . '%');
    }

    // Sắp xếp
    switch ($sort) {
        case 'az':
            $query->orderBy('TenGoi', 'asc');
            break;
        case 'za':
            $query->orderBy('TenGoi', 'desc');
            break;
        case 'price_asc':
            $query->orderBy('Gia', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('Gia', 'desc');
            break;
        case 'newest':
            $query->orderBy('san_phams.id', 'desc');
            break;
        case 'oldest':
            $query->orderBy('san_phams.id', 'asc');
            break;
        default:
            $query->orderBy('san_phams.id', 'desc');
            break;
    }

    $data = $query->paginate(9)->appends($request->query());
       $productcategory = LoaiSanPham::orderBy('id', 'DESC')->paginate(20);
        return view('client.sanpham', compact('data', 'productcategory'));
    }
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
     public function showProductDetail($id)
    {
    
        // Tìm sản phẩm theo ID
         $product = SanPham::with(['BangGia', 'DonViTinh', 'LoaiSanPham', 'Mau'])->findOrFail($id);
        $relatedProducts = SanPham::where('idLoaiSanPham', $product->idLoaiSanPham) // Lấy sản phẩm cùng loại
        ->where('id', '!=', $id) // Loại trừ sản phẩm hiện tại
        ->take(4) // Lấy tối đa 4 sản phẩm
        ->get();
     
       
        return view('client.ctsanpham', compact('product', 'relatedProducts'));

        
    }
}
