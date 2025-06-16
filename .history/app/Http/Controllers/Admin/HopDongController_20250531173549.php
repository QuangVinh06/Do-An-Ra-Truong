<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\DonHang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HopDong;
use Illuminate\Support\Facades\Storage;

use App\Models\PhieuDatHang;
use App\Http\Controllers\Admin\DocumentController;
class HopDongController extends Controller
{
    public function index(Request $request)
    {  
        $query = $request->input('search'); 
        $hds = HopDong::when($query, function ($q) use ($query) {
                $q->where('id', 'like', '%' . $query . '%');
        })->orderBy('id', 'desc')->paginate(5);
        $PhieuDat = PhieuDatHang::where('TrangThai', 1)->whereDoesntHave('hopdong')->get(); // Chỉ lấy phiếu đặt trạng thái 1
        return view('admin.hopdong.HopDong', compact('hds','PhieuDat'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'NgayLap' => ['required', 'date', 'after_or_equal:today'],
            'ThoiGianKetThuc' => ['required', 'date', 'after:NgayLap'],
            'NgayGiaoHang' => ['required', 'date', 'after:NgayLap'],
            'NguoiGiaoHang' => ['required', 'string', 'max:255'],
            'Thue' => ['required', 'numeric', 'between:0,100'],
            'idPhieuDat' => ['required', 'exists:phieu_dat_hang,id'],
            'FileHopDong' => ['required', 'file', 'mimes:pdf,doc,docx']
        ]);
    
        $ngayLap = Carbon::parse($data['NgayLap']);
        $thoiGianKetThuc = Carbon::parse($data['ThoiGianKetThuc']);
        $ngayGiaoHang = Carbon::parse($data['NgayGiaoHang']);
    
        if (!$ngayGiaoHang->between($ngayLap, $thoiGianKetThuc)) {
            return back()->withInput()->withErrors([
                'NgayGiaoHang' => 'Ngày giao hàng phải nằm trong khoảng từ ngày lập đến ngày kết thúc hợp đồng.'
            ]);
        }
    
        // Tính giá trị hợp đồng và tiền cọc
        $phieuDat = PhieuDatHang::find($data['idPhieuDat']);
        $giaTriGocHopDong = $phieuDat->TongTien;
        $thue = $data['Thue'];
    
        $giaTriHopDong = $giaTriGocHopDong + ($giaTriGocHopDong * $thue / 100);
        $tienCoc = $giaTriHopDong >= 1000000 ? $giaTriHopDong * 0.1 : 0;
        $trangThaiCoc = $giaTriHopDong >= 1000000 ? 'Yêu cầu cọc 10% giá trị hợp đồng' : 'Không yêu cầu cọc';
    
        // Chuẩn bị dữ liệu
        $storeData = [
            'NgayLap' => $data['NgayLap'],
            'ThoiGianKetThuc' => $data['ThoiGianKetThuc'],
            'NgayGiaoHang' => $data['NgayGiaoHang'],
            'NguoiGiaoHang' => $data['NguoiGiaoHang'],
            'Thue' => $thue,
            'GiaTriGocHopDong' => $giaTriHopDong,
            'TienCoc' => $tienCoc,
            'TrangThaiCoc' => $trangThaiCoc,
            'TongSoTienConLai' => $giaTriHopDong,
            'idPhieuDat' => $data['idPhieuDat'],
        ];
        // Xử lý file đính kèm
        if ($request->hasFile('FileHopDong')) {
            $file = $request->file('FileHopDong');
            $fileName = time() . '_' . $file->getClientOriginalName();
        
            $destinationPath = storage_path('app/private/public/hopdongs');
        
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        
            $file->move($destinationPath, $fileName);
        
            // Lưu đường dẫn đúng để download
            $storeData['FileHopDong'] = 'private/public/hopdongs/' . $fileName;
        }
        
        // Lưu
        $hopDong = HopDong::create($storeData);
        if ($hopDong) {
            // Trường hợp không yêu cầu cọc → Tạo đơn hàng ngay
            if ($hopDong->GiaTriGocHopDong <1000000) {
                DonHang::create([
                    'idHopDong' => $hopDong->id,
                    'NgayLap' => now(),
                    'TrangThai' => 'Chưa hoàn tất thanh toán',
                    'TongTienThanhToan' => $hopDong->GiaTriGocHopDong,
                ]);
            }
        
            return redirect()->route('QLhopdong.index')->with('success', 'Thêm hợp đồng và đơn hàng thành công');
        }
    
        return back()->with('error', 'Vui lòng thử lại');
    }
    
    
    public function download($id)
    {
        $hopDong = HopDong::findOrFail($id);
    
        // Giả sử giá trị trong DB là: private/public/hopdongs/1748...pdf
        $filePath = storage_path('app/' . $hopDong->FileHopDong);
    
        if (!file_exists($filePath)) {
            return response()->json([
                'error' => 'File không tồn tại.',
                'duong_dan_ktra' => $filePath,
            ]);
        }
    
        return response()->download($filePath);
    }
    
    
    public function edit(string $id)
    {
        $hds = HopDong::with(['phieuDatHang'])->get();
        
        $hopdong = HopDong::with(['phieuDatHang'])->findOrFail($id);
        
        $PhieuDat = PhieuDatHang::where('TrangThai', 1)->get(); // Chỉ lấy phiếu đặt trạng thái 1

        return view('admin.hopdong.HopDong', compact('hds', 'PhieuDat', 'hopdong'));
    }
    public function update(Request $request, string $id)
{
    $hopdong = HopDong::findOrFail($id);

    $data = $request->validate([
        'NgayLap' => ['required', 'date', 'after_or_equal:today'],
        'ThoiGianKetThuc' => ['required', 'date', 'after:NgayLap'],
        'NgayGiaoHang' => ['required', 'date', 'after:NgayLap'],
        'NguoiGiaoHang' => ['required', 'string', 'max:255'],
        'Thue' => ['required', 'numeric', 'between:0,100'],
        'idPhieuDat' => ['required', 'exists:phieu_dat_hang,id'],
        'FileHopDong' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:51200'],
    ]);

    // Kiểm tra ngày hợp lệ
    $ngayLap = Carbon::parse($data['NgayLap']);
    $thoiGianKetThuc = Carbon::parse($data['ThoiGianKetThuc']);
    $ngayGiaoHang = Carbon::parse($data['NgayGiaoHang']);

    if (!$ngayGiaoHang->between($ngayLap, $thoiGianKetThuc)) {
        return back()->withInput()->withErrors([
            'NgayGiaoHang' => 'Ngày giao hàng phải nằm trong khoảng từ ngày lập đến ngày kết thúc hợp đồng.'
        ]);
    }

    // Tính lại Giá trị hợp đồng và Tiền cọc
    $phieuDat = PhieuDatHang::find($data['idPhieuDat']);
    if (!$phieuDat) {
        return back()->with('error', 'Không tìm thấy phiếu đặt hàng.');
    }

    $tongTien = $phieuDat->TongTien;
    $thue = $data['Thue'];
    $giaTriHopDong = $tongTien + ($tongTien * $thue / 100);
    $tienCoc = $giaTriHopDong > 1000000 ? $giaTriHopDong * 0.1 : 0;
    $trangThaiCoc = $giaTriHopDong >= 1000000
    ? 'Yêu cầu cọc 10% giá trị hợp đồng'
    : 'Không yêu cầu cọc';
    // Cập nhật dữ liệu
    $updateData = [
        'NgayLap' => $data['NgayLap'],
        'ThoiGianKetThuc' => $data['ThoiGianKetThuc'],
        'NgayGiaoHang' => $data['NgayGiaoHang'],
        'NguoiGiaoHang' => $data['NguoiGiaoHang'],
        'Thue' => $thue,
        'GiaTriGocHopDong' => $giaTriHopDong,
        'TongSoTienConLai' => $giaTriHopDong,
        'TienCoc' => $tienCoc,
        'TrangThaiCoc' => $trangThaiCoc,
        'idPhieuDat' => $data['idPhieuDat'],
    ];

    // Cập nhật file nếu có
    if ($request->hasFile('FileHopDong')) {
        if ($hopdong->FileHopDong && file_exists(public_path($hopdong->FileHopDong))) {
            unlink(public_path($hopdong->FileHopDong));
        }

        $file = $request->file('FileHopDong');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/hopdongs', $fileName);
        $updateData['FileHopDong'] = str_replace('public/', 'storage/', $filePath);
    }

    $hopdong->update($updateData);

    return redirect()->route('QLhopdong.index')->with('success', 'Cập nhật hợp đồng thành công.');
}


    public function show(string $id)
    {
        $hd = HopDong::findOrFail($id);
        $PhieuDat = PhieuDatHang::where('TrangThai', 1)->get(); // Chỉ lấy phiếu đặt trạng thái 1
        return view('admin.hopdong.cthopdong', compact('hd','PhieuDat'));
    }

    public function destroy(string $id)
    {
        $hopdong = HopDong::findOrFail($id);
        
        // Xóa ảnh trước khi xóa bản ghi
        if ($hopdong->FileHopDong && file_exists(public_path($hopdong->FileHopDong))) {
            unlink(public_path($hopdong->FileHopDong));
        }

        $hopdong->delete();
        return redirect()->route('QLhopdong.index')->with('success', 'Xóa hợp đồng thành công.');
    }
 
}