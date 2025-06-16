<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use App\Models\KhuyenMai;
use Carbon\Carbon;
class UpdateTrangThaiKhuyenMai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    /**
     * The console command description.
     *
     * @var string
     */
   

    /**
     * Execute the console command.
     */
    protected $signature = 'khuyenmai:update-trangthai';
    protected $description = 'Tự động cập nhật trạng thái khuyến mãi theo ngày';

    public function handle(): void
    {
        $today = Carbon::today();

        // Cập nhật trạng thái đang diễn ra
        KhuyenMai::whereDate('NgayBatDau', '<=', $today)
                 ->whereDate('NgayKetThuc', '>=', $today)
                 ->update(['TrangThai' => 1]);

        // Cập nhật trạng thái tạm dừng (hết hạn hoặc chưa bắt đầu)
        KhuyenMai::where(function($query) use ($today) {
            $query->whereDate('NgayKetThuc', '<', $today)
                  ->orWhereDate('NgayBatDau', '>', $today);
        })->update(['TrangThai' => 0]);

        $this->info('Đã cập nhật trạng thái khuyến mãi.');
    }

    public function schedule(Schedule $schedule): void
    {
        $schedule->daily()->at('00:00')->command('khuyenmai:update-trangthai');
        // $schedule->command('khuyenmai:update-trangthai')->everyMinute(); // Chạy mỗi phút để kiểm tra và cập nhật trạng thái khuyến mãi
    }
}
