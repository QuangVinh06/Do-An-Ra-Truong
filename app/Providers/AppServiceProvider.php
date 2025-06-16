<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\LoaiSanPham;
use App\Models\SanPham;
use App\Models\BaiViet;
use App\Models\KhachHang;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('client.*', function ($view) {
        $view->with('pc', LoaiSanPham::all());
    });
     View::composer('client.*', function ($view) {
        $view->with('sanpham', SanPham::with(['LoaiSanPham', 'banggia'])->latest()->get());
    });
      View::composer('client.*', function ($view) {
        $view->with('productcategory', LoaiSanPham::all());
    });
     View::composer('client.*', function ($view) {
        $view->with('huongdan', BaiViet::all());
    });
    }
}
