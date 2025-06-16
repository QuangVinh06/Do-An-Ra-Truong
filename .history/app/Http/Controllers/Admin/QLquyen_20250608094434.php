<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quyen;
use App\Models\PhanQuyen;

use Illuminate\Support\Facades\Route;
class QLquyen extends Controller
{
   
    public function index(Request $request)
    {$query = $request->input('search');
    $data = Quyen::when($query, function ($q) use ($query) {
    $q->where('TenQuyen', 'like', "%{$query}%");
    })->orderBy('id', 'desc')->paginate(15);
        // // }
        //
        // $routes=[];
        // $all= Route::getRoutes();
        // 
        // foreach ($all as $route) {
        //     $name = $route->getName();
        //     $pos = strpos($name, 'admin');
        //     if ($pos !== false) {
        //       array_push($routes, $route->getName());
        //     }
        // }
      $resources = [];
$all = Route::getRoutes();

foreach ($all as $route) {
    $name = $route->getName();
    if (
        $name &&
        preg_match('/(\w+)\.(index|create|store|show|edit|update|destroy)$/', $name, $matches)
    ) {
        $resource = $matches[1];
        if (!array_key_exists($resource, $resources)) {
            $resources[$resource] = [];
        }
        $resources[$resource][] = $name;
    }
}


            $resources = array_slice($resources, 0, 31, true);




        return view('admin.TaiKhoan.QLQuyen', compact('data', 'resources'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
        return view('admin.TaiKhoan.QLQuyen', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'TenQuyen' => 'required|string|unique:quyens,TenQuyen',
            'routes' => 'required|array',
        ], [
            'TenQuyen.required' => 'Tên quyền không được để trống',
            'TenQuyen.unique' => 'Tên quyền đã tồn tại',
            'routes.required' => 'Vui lòng chọn ít nhất một route',
        ]);
        $rawRoutes = $request->routes ?? [];
        $allRoutes = [];
        
        foreach ($rawRoutes as $group) {
            $items = explode(',', $group); // Tách bằng dấu phẩy
            foreach ($items as $item) {
                $allRoutes[] = trim($item); // Thêm từng route vào mảng
            }
        }
       $routes = json_encode($allRoutes);
        Quyen::create([
            'TenQuyen' => $request->TenQuyen,
            'permission' => $routes
        ]);

        return redirect()->route('QLquyen.index')->with('success', 'Thêm quyền thành công');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Quyen $quyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quyen = Quyen::findOrFail($id);
    
        // Lấy lại danh sách resource-route như ở index
          $resources = [];
            $all = Route::getRoutes();
            
            foreach ($all as $route) {
                $name = $route->getName();
                if ($name && preg_match('/(\w+)\.(index|create|store|show|edit|update|destroy)$/', $name, $matches)
                ) {
                    $resource = $matches[1];
                    if (!in_array($resource, $resources)) {
                        $resources[$resource][] = $name;
                    }
                }
            }
          
       $permission = $quyen->permission ? json_decode($quyen->permission, true) : [];
      $rs = [];
    
    foreach ($permission as $route) {
        // Lấy phần trước dấu chấm
        $parts = explode('.', $route);
        if (!empty($parts[0]) && !in_array($parts[0], $rs)) {
            $rs[] = $parts[0];
        }
    }
        $data= Quyen::paginate(15);
       
        return view('admin.TaiKhoan.QLQuyen', compact('quyen', 'resources', 'data', 'rs','permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'TenQuyen' => 'required|string',
        ], [
            'TenQuyen.required' => 'Tên quyền không được để trống',
        ]);
        $rawRoutes = $request->routes ?? [];
        $allRoutes = [];
        foreach ($rawRoutes as $group) {
            $items = explode(',', $group);
            foreach ($items as $item) {
                $allRoutes[] = trim($item);
            }
        }
        $routes = json_encode($allRoutes);
    
        $quyen = Quyen::findOrFail($id);
        $quyen->TenQuyen = $request->TenQuyen;
        $quyen->permission = $routes;
        $quyen->save();
    
        return redirect()->route('QLquyen.index')->with('success', 'Cập nhật quyền thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quyen = Quyen::find($id);
        if (!$quyen) {
            return redirect()->back()->with('error', 'Quyền không tồn tại');
        }

        $quyen->delete();
        return redirect()->route('QLquyen.index')->with('success', 'Xóa quyền thành công');
    }
}
