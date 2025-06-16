-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 16, 2025 lúc 08:46 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `son_8`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bai_viets`
--

CREATE TABLE `bai_viets` (
  `id` int(10) UNSIGNED NOT NULL,
  `TieuDe` varchar(255) NOT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  `NoiDung` text NOT NULL,
  `TomTat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bai_viets`
--

INSERT INTO `bai_viets` (`id`, `TieuDe`, `HinhAnh`, `NoiDung`, `TomTat`, `created_at`, `updated_at`) VALUES
(2, 'Phương pháp kiểm tra: Chịu chà sát bề mặt sơn bằng dung môi kiểm tra độ đóng rắn của sơn', '/img/baiviet/1747999538.png', '<p>&nbsp;</p><p><strong>Phương pháp kiểm tra:&nbsp; chịu chà sát bề mặt sơn bằng dung môi kiểm tra độ đóng rắn sơn bột tĩnh điện</strong></p><figure class=\"table\"><table><tbody><tr><td><strong>Mục đích</strong></td><td><p>Sơn bột được đóng rắn hoàn toàn sau khi sấy sẽ cho các đặc điểm hiệu năng hoàn chỉnh về cơ lý tính, độ bám dính của sơn, chống chịu lại các tác nhân bên ngoài xâm nhập (Độ ẩm, muối, ánh nắng,…).</p><p>Khả năng đóng rắn hoàn toàn của sơn xác định bằng nhiệt độ của vật thể và thời gian giữ tại nhiệt độ này. Phương pháp đo nhiệt độ vật thể được đo thiết bị đo kiểm nhiệt độ sẽ đảm bảo được chính xác điều kiện vận hành dây chuyền sản xuất.</p><p>Tuy nhiên, có thể sử dụng phương pháp chịu chà sát dung môi là một phương pháp đơn giản, giúp kiểm tra nhanh mức độ đóng rắn của màng sơn tại hiện trường sản xuất.</p></td></tr><tr><td><p>&nbsp;</p><p>&nbsp;</p><p><strong>Hóa chất và dụng cụ kiểm tra</strong></p></td><td><ul><li>Chuẩn bị hệ dung môi</li></ul><p>Đối với hệ sơn ngoài trời (<strong>Dòng sản phẩm T,Y</strong>), hệ sơn trong nhà (<strong>H,E,K,X</strong>) sử dụng hệ dung môi pha như sau:</p><p>Trộn hỗn hợp MEK (Methyl ethyl ketone) và xylene tỷ lệ (50/50) theo thể tích.</p><ul><li>Tăm bông hoặc vải cotton</li><li>Vật phẩm đã sơn</li></ul></td></tr><tr><td><p>&nbsp;</p><p><strong>Quy trình kiểm tra</strong></p></td><td><p>Ngấm đẫm tăm bông hoặc vải cotton vào dung môi đã pha theo tỷ lệ ở trên. Chà sát 50 vòng &nbsp;tăm bông trên bề mặt vật phẩm đã sơn với độ dài khoảng 2~4 cm (Một vòng được hiểu là một lần tiến và 1 lần lùi của tăm bông chà sát trên bề mặt màng sơn tại khoảng độ dài ở trên).</p><p>&nbsp;</p><p>&nbsp;</p></td></tr><tr><td><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p><strong>Kết quả</strong></p></td><td><p>Quan sát các hiện tượng tại vị trí chà sát và đánh giá theo thang điểm như sau:</p><figure class=\"table\"><table><tbody><tr><td>Chưa đóng rắn</td><td>Màng sơn bị tan hoàn toàn, nhìn thấy bề mặt kim loại trên vết lau &nbsp;.</td></tr><tr><td>Đóng rắn 1 phần</td><td>Bề mặt màng sơn bị mờ, màng sơn mềm, dễ bị trầy xước khi sử dụng móng tay cào trên bề mặt.</td></tr><tr><td>Đóng rắn hoàn toàn</td><td>Màng sơn bị mờ nhẹ, không bị mềm, khó bị trầy xước khi sử dụng móng tay cào trên bề mặt.</td></tr></tbody></table></figure><p>&nbsp;</p></td></tr></tbody></table></figure>', 'Phương pháp kiểm tra:  chịu chà sát bề mặt sơn bằng dung môi kiểm tra độ đóng rắn sơn bột tĩnh điện', NULL, '2025-06-08 09:14:26'),
(4, 'Hướng dẫn xử lý sự cố về nhiệt khi sử dụng Sơn tĩnh điện', '/img/baiviet/1747999635.jpg', '<p>Trong sơn bột tĩnh điện, nhiệt độ và thời gian sấy là một trong những yếu tố ảnh hưởng lớn đến chất lượng. Trên thực tế, sự cố thừa hoặc thiếu nhiệt diễn ra khá phổ biến tại các xưởng gia công. Sau đây chúng tôi xin được chia sẻ tới Quý khách hàng một số kinh nghiệm về sự cố này như sau:</p><p><strong>I, Nhận biết sản phẩm bị sự cố về nhiệt</strong></p><p><strong>&nbsp; &nbsp;1, Sản phẩm bị thiếu nhiệt: ​</strong></p><p>- Độ bóng cao hơn mẫu tiêu chuẩn, đối với sơn mờ/bán mờ thì màu sắc và độ bóng khác nhau. (Hình 1).</p><p>+ Lệch màu</p><p>Mẫu B (mẫu thiếu nhiệt) và mẫu A (mẫu chuẩn đạt nhiệt). Mẫu B đen hơn so với mẫu A (dE = 0,58) do đối với màu đen độ bóng cao hơn dẫn đến màu sắc đen hơn và ngược lại mẫu mờ hơn sẽ bạc hơn.</p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/IMG_20200819_144016.jpg\" alt=\"\"></figure><p><i>Hình 1: Đo độ lệch màu</i></p><p>+ Lệch độ bóng</p><p>Đối với sơn mờ và bán mờ, khi sấy thiếu nhiệt sẽ dẫn đến hiện tượng sơn bóng hơn so với mẫu chuẩn (mẫu đạt nhiệt). Nhìn ngoại quan có thế thấy mẫu B (mẫu thiếu nhiệt) có độ bóng cao hơn mẫu A (đạt nhiệt). (Hình 2)</p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/1.jpg\" alt=\"\"></figure><p><i>Hình 2: Ngoại quan độ bóng giữa mẫu đủ nhiệt và thiếu nhiệt</i></p><p>- Cơ lý tính không đạt: Bền va đập kém, bám dính kém.(Hình 3)</p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/IMG_20200817_112501.jpg\" alt=\"\"></figure><p><i>Hình 3: Hình ảnh kiểm tra bền va đập</i></p><p>- Bám dính kém</p><p>Kiểm tra bám dính cross-cut trên cả 2 mẫu cho thấy mẫu B bề mặt bị bong tróc còn mẫu A xung quanh vết cắt không bị bong tróc.</p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/5.jpg\" alt=\"\"></figure><p><i>Hình 4: Kiểm tra bám dính&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></p><p><strong>2, Sản phẩm bị thừa nhiệt:</strong></p><p>- Độ bóng thay đổi so với mẫu tiêu chuẩn (xu hướng bị mờ hơn so với mẫu chuẩn).(Hình5)</p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/6.jpg\" alt=\"\"></figure><p><i>Hình 5: Kiểm tra độ bóng</i></p><p>- Bề mặt chịu cào xước kém (do màng sơn bị lão hóa).(Hình 6)</p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/IMG_20200819_093701.jpg\" alt=\"\"></figure><p><i>Hình 6: Hình ảnh cào xước móng tay kém</i></p><p>- Màu sắc thay đổi so với mẫu tiêu chuẩn (xu hướng bị vàng hóa).(Hình 7a, 7b)</p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/4.jpg\" alt=\"\"></figure><p><i>Hình 7a: Cảm quan bằng mắt có thể thấy mẫu D vàng hơn mẫu C do thừa nhiệt dù cùng sử dụng chung một mẫu sơn</i></p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/IMG_20200817_112350.jpg\" alt=\"\"></figure><p><i>Hình 7b: Lệch màu kiểm tra bằng thiết bị đo màu​</i></p><p><strong>II, Giải pháp khắc phục</strong></p><p>- Trường hợp sản phẩm thiếu nhiệt được phát hiện sớm, đơn vị thi công có thể sấy thêm theo hướng dẫn của nhà sản xuất để hạn chế tối đa thiệt hại</p><p>- Trường hợp sản phẩm sấy thừa nhiệt hoặc thiếu nhiệt nhưng phát hiện muộn (khi đã tháo dỡ toàn bộ sản phẩm ra khỏi lò sấy, bị bụi bẩn bám trên bề mặt) chỉ có thể khắc phục bằng cách vệ sinh, làm sạch bề mặt sản phẩm và sơn phủ lại lần 2 theo hướng dẫn của nhà sản xuất</p><p><strong>III, Giải pháp phòng ngừa</strong></p><p>- Định kỳ 1-3 tháng/lần sử dụng máy chuyên dụng kiểm tra nhiệt độ không khí trong lò sấy và nhiệt độ vật cần sơn.</p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/1456901089342002094.jpg\" alt=\"\"></figure><p><i>Kiểm tra nhiệt độ bằng máy đo chuyên dụng</i></p><p>- Kiểm soát chặt chẽ thời gian và nhiệt độ sấy theo đúng khuyến cáo của nhà sản xuất sơn. Có thể dùng mẫu chuẩn để so màu hoặc độ bóng với các mẻ/lô sấy trong từng ka làm việc.</p><p>- Lập sổ ghi chép nhật ký thi công của từng lô sản phẩm để kiểm soát quá trình và có cơ sở khắc phục sự cố (nếu có)</p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/z1977610229065_0da06a19fddade295ac4cf6ebb5c4b34.jpg\" alt=\"\"></figure><p><i>Kiểm soát chặt chẽ thời gian sấy và nhiệt độ sấy</i></p><figure class=\"image\"><img src=\"https://selac.vn/images/Upload/images/z1977610224418_b2441b3393640bed132468b94585520b.jpg\" alt=\"\"></figure><p><i>Dùng mẫu chuẩn để so màu hoặc độ bóng​</i></p><p>- Kiểm tra độ bám dính của màng sơn sau khi sấy để kịp thời phát hiện và điều chỉnh nhiệt độ trong các lô hàng sấy sau (nếu sản phẩm có dấu hiệu như đã nêu trên)</p><p>- Kiểm tra sản phẩm bằng dung môi chuyên dụng</p>', 'I, Nhận biết sản phẩm bị sự cố về nhiệt', NULL, '2025-05-23 06:31:10'),
(5, 'HƯỚNG DẪN THI CÔNG SƠN TĨNH ĐIỆN', '/img/baiviet/1748007009.png', '<p><strong>I, ỨNG DỤNG CỦA CÔNG NGHỆ SƠN TĨNH ĐIỆN:</strong><br>Hiện nay công nghệ sơn tĩnh điện được ứng dụng rộng rãi trong rất nhiều ngành công nghiệp như: công nghiệp hàng hải, công nghiệp hàng không, công nghiệp chế tạo xe hơi và xe gắn máy,… đến các lĩnh vực như sơn trang trí, xây dựng công nghiệp, xây dựng dân dụng, …<br><strong>II, HỆ THỐNG THIẾT BỊ ỨNG DỤNG CÔNG NGHỆ SƠN TĨNH ĐIỆN:</strong><br><strong>Xử lý bề mặt:&nbsp;</strong><br>Bao gồm 4 bể hóa chất:<br>Bể chứa hoá chất tẩy dầu mỡ<br>Bể chứa axít tẩy gỉ sét<br>Bể chứa hoá chất định hình bề mặt<br>Bể chứa hoá chất phốt phát hoá bề mặt<br>Và 3 bể nước dùng để xử lý bề mặt vật liệu được sơn trước khi đưa vào phun sơn, nhằm mục đích tạo hiệu quả bám dính thật cao cho bột sơn.<br><strong>Thiết bị phun sơn:</strong>&nbsp;gồm súng sơn và bộ điều khiển<br>Súng sơn: có 2 loại:<br>&nbsp;&nbsp; -&nbsp;&nbsp; Súng sơn cầm tay&nbsp;<br>&nbsp;&nbsp; -&nbsp;&nbsp; Súng sơn tự động&nbsp;<br>Bộ điều khiển: gồm<br>&nbsp;&nbsp; -&nbsp;&nbsp; Lò sấy<br>&nbsp;&nbsp; -&nbsp;&nbsp; Buồng phun sơn&nbsp;<br>&nbsp;&nbsp; -&nbsp;&nbsp; Thiết bị thu hồi&nbsp;<br>&nbsp;&nbsp; -&nbsp;&nbsp; Máy rây bột<br><br><strong>III, QUÁ TRÌNH PHUN SƠN:</strong><br>Quy trình công nghệ hệ thống sơn tĩnh điện bột gồm 4 bước cơ bản sau:<br>Xử lý bề mặt (Pre-treatment)<br>Làm khô (Drying)<br>Phun sơn (Spray Painting)<br>Sấy (Paint Baking)<br><br><strong>Các bước chi tiết của quy trình:</strong><br><strong>Bước 1:</strong>&nbsp;Xử lý bề mặt sản phẩm trước khi sơn:&nbsp;<br>Sản phẩm (kim loại) trước khi sơn tĩnh điện phải được xử lý bề mặt. Thông thường sản phẩm được sơn tĩnh điện là kim loại. Ta xét trên bề mặt sắt:<br>Việc xử lý bề mặt sản phẩm nhằm mang lại các yêu cầu sau:<br>&nbsp; Sản phẩm sạch dầu mỡ công nghiệp (do việc gia công cơ khí)<br>&nbsp; Sản phẩm sạch rỉ sét.<br>&nbsp; Sản phẩm không rỉ sét trở lại trong thời gian chưa sơn.<br>&nbsp; Tạo lớp bao phủ tốt cho việc bám dính giữa lớp màng sơn và kim loại.</p><p>Do các yêu cầu trên mà việc xử lý bề mặt kim loại trước khi sơn thường được xử lý theo phương pháp nhúng sản phẩm vào các bể hóa chất.&nbsp;<br>Hệ thống các bể hóa chất bao gồm các bể sau:</p><p>Bể chứa hóa chất tẩy dầu mỡ.&nbsp;<br>Bể rửa nước<br>Bể chứa axit tẩy rỉ sét, thông thường là H2SO4 hoặc HCl.&nbsp;<br>Bể rửa nước.<br>Bể chứa hóa chất định hình bề mặt.<br>Bể chứa hóa chất Photphat hóa bề mặt.<br>Bể rửa nước.&nbsp;<br>Các bể này được xây và phủ nhựa Composite, hay làm bằng thép không rỉ.<br>Vật sơn được đựng trong các rọ làm bằng lưới thép không rỉ, di chuyển nhờ hệ thống balang điện qua các bể theo thứ tự trên.<br><strong>Bước 2:</strong>&nbsp;Sấy khô bề mặt sản phẩm trước khi sơn&nbsp;<br>Sản phẩm sau khi xử lý hóa chất phải được làm khô trước khi sơn, lò sấy khô sản phẩm có chức năng sấy khô hơi nước để nhanh chóng đưa sản phẩm vào sơn.<br>Thông thường lò sấy có dạng hình khối. Sản phẩm được treo trên xe gòng và đẩy vào lò.<br>Lò có nguồn nhiệt chính bằng bếp hồng ngoại tuyến hoặc Burner, nguyên liệu đốt là Gas.<br><strong>Bước 3:</strong>&nbsp;Sơn sản phẩm&nbsp;<br>Sản phẩm sau khi xử lý hóa chất và sấy khô được đưa vào buồng phun và thu hồi sơn.<br>Do đặc tính của sơn tĩnh điện bột là dạng sơn bột, nên khả năng bám dính của sơn lên bề mặt kim loại là nhờ lực tĩnh điện, chính vì vậy mà buồng phun sơn còn đóng một vai trò quan trọng là thu hồi lượng bột sơn dư, bột sơn thu hồi được trộn thêm vào bột sơn mới để tái sử dụng. Phần thu hồi này là đặc tính kinh tế ưu việt của sơn tĩnh điện.<br>Buồng phun sơn có 2 loại:<br><strong>Loại 1 súng phun:</strong>&nbsp;Sử dụng 1 súng phun, vật sơn được treo, móc bằng tay vào buồng phun.<br><strong>Loại 2 súng phun:</strong>&nbsp;Vật sơn di chuyển trên băng tải vào buồng phun, 2 súng phun ở 2 phía đối diện phun vào 2 mặt của sản phẩm.<br>Để sơn và thu hồi bột sơn, ta cần có thiết bị phun sơn tĩnh điện, và một hệ thống cấp khí gồm máy nén khí và máy tách ẩm.<br><br><strong>Bước 4:&nbsp;</strong>Sấy định hình và hoàn tất sản phẩm<br>Sau khi phun sơn, sản phẩm được đưa vào lò sấy. Nhiệt độ sấy: 180 độ C – 200 độ C trong 10 phút<br>Lò có nguồn nhiệt chính bằng bếp hồng ngoại tuyến hoặc Burner, nguyên liệu đốt là Gas.<br><strong>IV, THU HỒI BỘT SAU KHI SƠN:</strong>&nbsp;<br><strong>a. Hệ thống thu hồi:</strong>&nbsp;Dùng Filter hoặc cyclone<br><strong>b. Cách sử dụng lại bột thu hồi:</strong><br>Để có thể sử dụng bột thu hồi một cách hiệu quả nhất ta phải trộn bột thu hồi với bột mới theo tỉ lệ 0.5:1. Nếu bột có lẫn tạp chất hoặc độ tích điện yếu ta phải sử dụng máy sàng bột.</p>', 'I, ỨNG DỤNG CỦA CÔNG NGHỆ SƠN TĨNH ĐIỆN:', '2025-05-23 06:30:09', '2025-05-23 06:31:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bang_gia`
--

CREATE TABLE `bang_gia` (
  `id` int(10) UNSIGNED NOT NULL,
  `NgayLap` date NOT NULL,
  `GhiChu` text NOT NULL,
  `idSanPham` int(10) UNSIGNED NOT NULL,
  `Gia` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bang_gia`
--

INSERT INTO `bang_gia` (`id`, `NgayLap`, `GhiChu`, `idSanPham`, `Gia`, `created_at`, `updated_at`) VALUES
(4, '2025-06-08', 'giá mới', 3, 150000, '2025-04-24 05:28:47', '2025-06-08 09:26:58'),
(6, '2025-04-24', 'giá niêm yết', 5, 180000, '2025-04-24 07:30:27', '2025-04-24 07:30:27'),
(8, '2025-04-25', 'giá niêm yết', 6, 230000, '2025-04-25 08:16:36', '2025-04-25 08:16:36'),
(9, '2025-04-26', 'giá niêm yết', 4, 177777, '2025-04-25 19:34:59', '2025-04-25 19:34:59'),
(10, '2025-05-21', 'giá niêm yết', 7, 170000, '2025-05-21 00:20:56', '2025-05-21 00:20:56'),
(11, '2025-05-23', 'Giá niêm yết', 8, 130000, '2025-05-23 03:32:40', '2025-05-23 03:32:40'),
(12, '2025-05-23', 'giá liên hệ', 9, 170000, '2025-05-23 03:36:51', '2025-05-23 03:36:51'),
(15, '2025-06-08', 'giá niêm yết', 13, 100000, '2025-06-08 09:18:10', '2025-06-08 09:18:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_khos`
--

CREATE TABLE `chi_tiet_khos` (
  `id` int(11) UNSIGNED NOT NULL,
  `idKho` int(11) UNSIGNED NOT NULL,
  `idSanPham` int(11) UNSIGNED NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_khos`
--

INSERT INTO `chi_tiet_khos` (`id`, `idKho`, `idSanPham`, `SoLuong`, `created_at`, `updated_at`) VALUES
(2, 1, 3, 99, '2025-05-14 23:37:52', '2025-05-30 10:08:29'),
(3, 1, 4, 100, '2025-05-14 23:37:52', '2025-05-14 23:37:52'),
(4, 2, 5, 84, '2025-05-14 23:38:23', '2025-06-07 08:15:45'),
(5, 2, 6, 91, '2025-05-14 23:38:24', '2025-06-08 10:26:41'),
(6, 2, 8, 44, '2025-05-14 23:38:24', '2025-06-08 10:26:41'),
(7, 3, 7, 194, '2025-05-14 23:38:47', '2025-05-30 10:08:37'),
(8, 3, 9, 84, '2025-05-14 23:38:47', '2025-05-28 02:02:45'),
(9, 1, 9, 8, '2025-05-28 02:04:15', '2025-06-08 10:18:22'),
(10, 4, 10, 15, '2025-06-07 08:22:28', '2025-06-07 08:43:57'),
(11, 4, 6, 128, '2025-06-07 08:37:42', '2025-06-08 10:26:41'),
(12, 2, 12, 100, '2025-06-08 09:04:07', '2025-06-08 09:04:07'),
(13, 3, 13, 30, '2025-06-08 09:51:39', '2025-06-08 10:18:07'),
(14, 4, 8, 15, '2025-06-08 10:25:15', '2025-06-08 10:26:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_phieu_chuyen_khos`
--

CREATE TABLE `chi_tiet_phieu_chuyen_khos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPhieuChuyenKho` int(10) UNSIGNED NOT NULL,
  `idSanPham` int(10) UNSIGNED NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_phieu_chuyen_khos`
--

INSERT INTO `chi_tiet_phieu_chuyen_khos` (`id`, `idPhieuChuyenKho`, `idSanPham`, `SoLuong`, `created_at`, `updated_at`) VALUES
(10, 7, 3, 15, '2025-05-15 01:04:44', '2025-05-15 01:04:44'),
(12, 8, 6, 15, '2025-06-08 10:24:34', '2025-06-08 10:24:34'),
(16, 9, 8, 15, '2025-06-08 10:26:41', '2025-06-08 10:26:41'),
(17, 9, 6, 13, '2025-06-08 10:26:41', '2025-06-08 10:26:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_phieu_dat_hang`
--

CREATE TABLE `chi_tiet_phieu_dat_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPhieuDat` int(10) UNSIGNED NOT NULL,
  `idSanPham` int(10) UNSIGNED NOT NULL,
  `SoLuong` int(10) UNSIGNED NOT NULL,
  `DonGia` int(10) UNSIGNED NOT NULL,
  `ThanhTien` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_phieu_dat_hang`
--

INSERT INTO `chi_tiet_phieu_dat_hang` (`id`, `idPhieuDat`, `idSanPham`, `SoLuong`, `DonGia`, `ThanhTien`, `created_at`, `updated_at`) VALUES
(43, 39, 6, 5, 230000, 1150000, NULL, NULL),
(44, 39, 4, 5, 177777, 888885, NULL, NULL),
(45, 40, 6, 10, 230000, 2300000, NULL, NULL),
(46, 41, 6, 5, 230000, 1150000, NULL, NULL),
(47, 42, 6, 5, 230000, 1150000, NULL, NULL),
(50, 44, 4, 20, 177777, 3555540, NULL, NULL),
(51, 45, 6, 10, 230000, 2300000, NULL, NULL),
(52, 46, 6, 15, 230000, 3450000, NULL, NULL),
(53, 46, 5, 19, 180000, 3420000, NULL, NULL),
(54, 47, 5, 4, 180000, 720000, NULL, NULL),
(55, 48, 6, 10, 230000, 2300000, NULL, NULL),
(56, 49, 4, 6, 177777, 1066662, NULL, NULL),
(57, 49, 5, 5, 180000, 900000, NULL, NULL),
(58, 50, 5, 15, 180000, 2700000, NULL, NULL),
(59, 51, 5, 15, 180000, 2700000, NULL, NULL),
(61, 53, 6, 7, 230000, 1610000, NULL, NULL),
(62, 54, 5, 4, 180000, 720000, NULL, NULL),
(63, 55, 4, 20, 177777, 3555540, NULL, NULL),
(64, 56, 6, 1, 230000, 230000, NULL, NULL),
(65, 57, 5, 1, 180000, 180000, NULL, NULL),
(66, 57, 4, 1, 177777, 177777, NULL, NULL),
(67, 57, 7, 3, 170000, 510000, NULL, NULL),
(68, 58, 3, 1, 100000, 100000, NULL, NULL),
(69, 58, 5, 1, 180000, 180000, NULL, NULL),
(70, 59, 7, 10, 170000, 1700000, NULL, NULL),
(73, 62, 3, 10, 120000, 1200000, NULL, NULL),
(74, 63, 5, 20, 180000, 3600000, NULL, NULL),
(75, 64, 9, 10, 170000, 1700000, NULL, NULL),
(76, 65, 9, 8, 170000, 1360000, NULL, NULL),
(77, 66, 8, 12, 130000, 1560000, NULL, NULL),
(78, 67, 8, 4, 130000, 520000, NULL, NULL),
(79, 68, 8, 6, 130000, 780000, NULL, NULL),
(80, 68, 7, 6, 170000, 1020000, NULL, NULL),
(81, 69, 9, 1, 170000, 170000, NULL, NULL),
(82, 70, 8, 11, 130000, 1430000, NULL, NULL),
(83, 70, 6, 6, 230000, 1380000, NULL, NULL),
(84, 71, 8, 1, 130000, 130000, NULL, NULL),
(85, 71, 9, 1, 170000, 170000, NULL, NULL),
(86, 72, 9, 10, 170000, 1700000, NULL, NULL),
(87, 73, 9, 1, 170000, 170000, NULL, NULL),
(88, 73, 5, 1, 180000, 180000, NULL, NULL),
(89, 74, 9, 1, 170000, 170000, NULL, NULL),
(90, 74, 3, 1, 100000, 100000, NULL, NULL),
(93, 76, 9, 1, 170000, 170000, NULL, NULL),
(94, 77, 8, 11, 130000, 1430000, NULL, NULL),
(95, 77, 9, 10, 170000, 1700000, NULL, NULL),
(96, 78, 9, 10, 170000, 1700000, NULL, NULL),
(97, 79, 6, 10, 230000, 2300000, NULL, NULL),
(98, 80, 8, 10, 130000, 1300000, NULL, NULL),
(99, 81, 9, 10, 170000, 1700000, NULL, NULL),
(100, 81, 5, 10, 180000, 1800000, NULL, NULL),
(101, 82, 5, 1, 180000, 180000, NULL, NULL),
(102, 83, 9, 1, 170000, 170000, NULL, NULL),
(104, 85, 5, 1, 180000, 180000, NULL, NULL),
(105, 86, 6, 10, 230000, 2300000, NULL, NULL),
(106, 87, 8, 10, 130000, 1300000, NULL, NULL),
(107, 88, 9, 10, 170000, 1700000, NULL, NULL),
(108, 89, 13, 1, 100000, 100000, NULL, NULL),
(109, 90, 9, 1, 170000, 170000, NULL, NULL),
(110, 91, 13, 10, 100000, 1000000, NULL, NULL),
(111, 91, 9, 1, 170000, 170000, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_phieu_kiem_kes`
--

CREATE TABLE `chi_tiet_phieu_kiem_kes` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPhieuKiemKe` int(10) UNSIGNED NOT NULL,
  `idSanPham` int(10) UNSIGNED NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `TrangThai` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_phieu_kiem_kes`
--

INSERT INTO `chi_tiet_phieu_kiem_kes` (`id`, `idPhieuKiemKe`, `idSanPham`, `SoLuong`, `TrangThai`, `created_at`, `updated_at`) VALUES
(32, 22, 7, 20, '2', '2025-05-15 00:57:51', '2025-05-15 00:57:51'),
(33, 23, 3, 5, '0', '2025-05-15 01:18:35', '2025-05-15 01:18:35'),
(34, 24, 9, 5, '3', '2025-05-15 01:19:01', '2025-05-15 01:19:01'),
(36, 25, 10, 5, '0', '2025-06-07 08:43:57', '2025-06-07 08:43:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_phieu_nhaps`
--

CREATE TABLE `chi_tiet_phieu_nhaps` (
  `id` int(10) UNSIGNED NOT NULL,
  `SoLuong` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `idPhieuNhap` int(10) UNSIGNED NOT NULL,
  `idSanPham` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_phieu_nhaps`
--

INSERT INTO `chi_tiet_phieu_nhaps` (`id`, `SoLuong`, `idPhieuNhap`, `idSanPham`, `created_at`, `updated_at`) VALUES
(31, 100, 26, 3, '2025-05-14 23:37:52', '2025-05-14 23:37:52'),
(32, 100, 26, 4, '2025-05-14 23:37:52', '2025-05-14 23:37:52'),
(33, 100, 27, 5, '2025-05-14 23:38:23', '2025-05-14 23:38:23'),
(34, 100, 27, 6, '2025-05-14 23:38:23', '2025-05-14 23:38:23'),
(35, 100, 27, 8, '2025-05-14 23:38:24', '2025-05-14 23:38:24'),
(42, 200, 28, 7, '2025-05-14 23:41:32', '2025-05-14 23:41:32'),
(43, 100, 28, 9, '2025-05-14 23:41:32', '2025-05-14 23:41:32'),
(44, 50, 29, 9, '2025-05-28 02:04:15', '2025-05-28 02:04:15'),
(45, 20, 30, 10, '2025-06-07 08:22:28', '2025-06-07 08:22:28'),
(46, 100, 31, 6, '2025-06-08 09:03:11', '2025-06-08 09:03:11'),
(47, 100, 33, 12, '2025-06-08 09:04:07', '2025-06-08 09:04:07'),
(50, 30, 34, 13, '2025-06-08 10:18:07', '2025-06-08 10:18:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_xuat_khos`
--

CREATE TABLE `chi_tiet_xuat_khos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_phieu_xuat_kho` int(10) UNSIGNED NOT NULL,
  `id_san_pham` int(10) UNSIGNED NOT NULL,
  `SoLuong` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_kho` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_xuat_khos`
--

INSERT INTO `chi_tiet_xuat_khos` (`id`, `id_phieu_xuat_kho`, `id_san_pham`, `SoLuong`, `created_at`, `updated_at`, `id_kho`) VALUES
(7, 9, 6, 5, '2025-05-14 23:59:41', '2025-05-14 23:59:41', 2),
(8, 10, 9, 10, '2025-05-28 00:40:47', '2025-05-28 00:40:47', 3),
(9, 11, 9, 1, '2025-05-28 02:02:45', '2025-05-28 02:02:45', 3),
(10, 11, 5, 1, '2025-05-28 02:02:45', '2025-05-28 02:02:45', 2),
(11, 12, 9, 1, '2025-05-30 10:08:29', '2025-05-30 10:08:29', 1),
(12, 12, 3, 1, '2025-05-30 10:08:29', '2025-05-30 10:08:29', 1),
(13, 13, 9, 10, '2025-05-30 10:08:33', '2025-05-30 10:08:33', 1),
(14, 14, 8, 6, '2025-05-30 10:08:37', '2025-05-30 10:08:37', 2),
(15, 14, 7, 6, '2025-05-30 10:08:37', '2025-05-30 10:08:37', 3),
(16, 15, 8, 4, '2025-05-30 10:08:42', '2025-05-30 10:08:42', 2),
(17, 16, 8, 11, '2025-06-01 08:36:41', '2025-06-01 08:36:41', 2),
(18, 16, 9, 10, '2025-06-01 08:36:41', '2025-06-01 08:36:41', 1),
(19, 17, 9, 10, '2025-06-07 08:15:45', '2025-06-07 08:15:45', 1),
(20, 17, 5, 10, '2025-06-07 08:15:45', '2025-06-07 08:15:45', 2),
(21, 18, 8, 10, '2025-06-07 08:27:14', '2025-06-07 08:27:14', 2),
(22, 19, 8, 10, '2025-06-08 03:53:52', '2025-06-08 03:53:52', 2),
(23, 20, 9, 10, '2025-06-08 09:09:07', '2025-06-08 09:09:07', 1),
(24, 21, 9, 1, '2025-06-08 10:18:22', '2025-06-08 10:18:22', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_phieu_doi_tra`
--

CREATE TABLE `ct_phieu_doi_tra` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPhieuDoiTra` int(10) UNSIGNED NOT NULL,
  `idDonHang` int(10) UNSIGNED NOT NULL,
  `idSanPham` int(10) UNSIGNED NOT NULL,
  `SoLuong` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_phieu_doi_tra`
--

INSERT INTO `ct_phieu_doi_tra` (`id`, `idPhieuDoiTra`, `idDonHang`, `idSanPham`, `SoLuong`) VALUES
(16, 22, 37, 9, 5),
(17, 23, 48, 5, 1),
(18, 24, 50, 8, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `NgayLap` date NOT NULL,
  `TongTienThanhToan` decimal(20,2) NOT NULL,
  `idHopDong` int(10) UNSIGNED NOT NULL,
  `TrangThai` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`id`, `NgayLap`, `TongTienThanhToan`, `idHopDong`, `TrangThai`, `created_at`, `updated_at`) VALUES
(8, '2025-05-13', 1265000.00, 20, 'Đã thanh toán toàn bộ', NULL, '2025-05-14 23:59:41'),
(13, '2025-05-15', 2530000.00, 29, 'Đã thanh toán toàn bộ', '2025-05-15 02:53:51', '2025-05-24 00:09:05'),
(14, '2025-05-15', 2835000.00, 32, 'Đã thanh toán toàn bộ', '2025-05-15 07:02:10', '2025-05-15 07:02:10'),
(19, '2025-05-15', 3911094.00, 36, 'Đã thanh toán toàn bộ', '2025-05-15 09:16:04', '2025-05-15 09:16:04'),
(20, '2025-05-15', 253000.00, 37, 'Đã thanh toán toàn bộ', '2025-05-15 09:23:02', '2025-05-15 09:24:51'),
(24, '2025-05-21', 911165.85, 38, 'Đã thanh toán toàn bộ', '2025-05-21 08:29:31', '2025-05-21 08:29:31'),
(25, '2025-05-21', 294000.00, 41, 'Đã thanh toán toàn bộ', '2025-05-21 08:57:42', '2025-05-24 00:09:41'),
(26, '2025-05-27', 792000.00, 48, 'Chưa hoàn tất thanh toán', '2025-05-27 09:23:31', '2025-05-27 09:23:31'),
(27, '2025-05-27', 3960000.00, 46, 'Đã thanh toán toàn bộ', '2025-05-27 10:27:09', '2025-05-27 10:27:09'),
(29, '2025-05-27', 1285200.00, 52, 'Đã thanh toán toàn bộ', '2025-05-27 11:03:26', '2025-05-27 11:04:05'),
(30, '2025-05-27', 1683000.00, 47, 'Đã thanh toán toàn bộ', '2025-05-27 13:00:54', '2025-05-27 13:04:53'),
(33, '2025-05-27', 1716000.00, 53, 'Đã thanh toán toàn bộ', '2025-05-27 13:26:57', '2025-05-27 13:26:57'),
(35, '2025-05-27', 520000.00, 54, 'Đã giao hàng', '2025-05-27 13:33:58', '2025-05-30 10:08:42'),
(36, '2025-05-27', 1782000.00, 55, 'Đã giao hàng', '2025-05-27 13:40:16', '2025-05-30 10:08:37'),
(37, '2025-05-28', 1683000.00, 56, 'Đã giao hàng', '2025-05-28 00:39:58', '2025-05-30 10:08:33'),
(38, '2025-05-28', 350000.00, 57, 'Đã giao hàng', '2025-05-28 01:59:56', '2025-05-28 02:02:45'),
(39, '2025-05-28', 270000.00, 58, 'Đã giao hàng', '2025-05-28 02:06:11', '2025-05-30 10:08:29'),
(40, '2025-06-01', 3098700.00, 59, 'Đã thanh toán toàn bộ', '2025-06-01 08:35:09', '2025-06-05 11:40:21'),
(41, '2025-06-05', 2277000.00, 60, 'Đã thanh toán toàn bộ', '2025-06-05 11:33:26', '2025-06-05 11:37:19'),
(42, '2025-06-06', 2163328.20, 44, 'Đã thanh toán toàn bộ', '2025-06-06 06:56:41', '2025-06-06 06:56:41'),
(43, '2025-06-06', 1430000.00, 61, 'Đã giao hàng', '2025-06-06 07:27:24', '2025-06-07 08:27:14'),
(44, '2025-06-07', 3850000.00, 62, 'Đã giao hàng', '2025-06-07 08:15:07', '2025-06-07 08:15:45'),
(45, '2025-06-07', 180000.00, 63, 'Đã thanh toán toàn bộ', '2025-06-07 10:04:59', '2025-06-07 10:06:56'),
(46, '2025-06-07', 170000.00, 64, 'Đã thanh toán toàn bộ', '2025-06-07 10:05:27', '2025-06-07 10:06:31'),
(48, '2025-06-07', 158400.00, 66, 'Đã thanh toán toàn bộ', '2025-06-07 10:18:03', '2025-06-07 11:13:34'),
(49, '2025-06-08', 2226400.00, 67, 'Đã thanh toán toàn bộ', '2025-06-07 23:46:46', '2025-06-07 23:46:46'),
(50, '2025-06-08', 1029600.00, 68, 'Đã thanh toán toàn bộ', '2025-06-08 03:53:13', '2025-06-08 03:55:04'),
(51, '2025-06-08', 1870000.00, 69, 'Đã giao hàng', '2025-06-08 08:54:33', '2025-06-08 09:09:07'),
(52, '2025-06-08', 80000.00, 70, 'Chưa hoàn tất thanh toán', '2025-06-08 09:52:15', '2025-06-08 09:52:15'),
(53, '2025-06-08', 1320000.00, 71, 'Đã thanh toán toàn bộ', '2025-06-08 09:55:43', '2025-06-08 09:55:43'),
(54, '2025-06-08', 170000.00, 72, 'Đã giao hàng', '2025-06-08 10:04:43', '2025-06-08 10:18:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_vi_tinh`
--

CREATE TABLE `don_vi_tinh` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenDonViTinh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `don_vi_tinh`
--

INSERT INTO `don_vi_tinh` (`id`, `TenDonViTinh`) VALUES
(1, '20kg/thùng'),
(2, '10kg/hộp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id` int(10) UNSIGNED NOT NULL,
  `SoTienThanhToan` decimal(20,2) NOT NULL,
  `NgayLap` date NOT NULL,
  `LoaiThanhToan` varchar(255) NOT NULL,
  `idHopDong` int(10) UNSIGNED NOT NULL,
  `PhuongThuc` varchar(255) DEFAULT NULL,
  `MaGiaoDich` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`id`, `SoTienThanhToan`, `NgayLap`, `LoaiThanhToan`, `idHopDong`, `PhuongThuc`, `MaGiaoDich`, `created_at`, `updated_at`) VALUES
(16, 120750.00, '2025-05-13', 'Đặt cọc', 19, 'NCB', '14954942', '2025-05-13 08:48:37', '2025-05-13 08:48:37'),
(17, 1086750.00, '2025-05-13', 'Thanh toán toàn bộ', 19, 'NCB', '14954944', '2025-05-13 08:49:19', '2025-05-13 08:49:19'),
(18, 1265000.00, '2025-05-13', 'Thanh toán toàn bộ', 20, 'NCB', '14954948', '2025-05-13 08:54:33', '2025-05-13 08:54:33'),
(22, 253000.00, '2025-05-15', 'Đặt cọc', 29, 'NCB', '14959181', '2025-05-15 02:53:51', '2025-05-15 02:53:51'),
(23, 2277000.00, '2025-05-15', 'Thanh toán toàn bộ', 29, 'NCB', '14959183', '2025-05-15 02:54:53', '2025-05-15 02:54:53'),
(24, 2835000.00, '2025-05-15', 'Thanh toán toàn bộ', 32, 'NCB', '14959531', '2025-05-15 06:53:20', '2025-05-15 06:53:20'),
(26, 283500.00, '2025-05-15', 'Đặt cọc', 33, 'NCB', '14959541', '2025-05-15 07:05:14', '2025-05-15 07:05:14'),
(27, 169050.00, '2025-05-15', 'Đặt cọc', 34, 'NCB', '14959716', '2025-05-15 09:06:23', '2025-05-15 09:06:23'),
(29, 3911094.00, '2025-05-15', 'Thanh toán toàn bộ', 36, 'NCB', '14959725', '2025-05-15 09:16:04', '2025-05-15 09:16:04'),
(30, 911165.85, '2025-05-21', 'Thanh toán toàn bộ', 38, 'NCB', '14971677', '2025-05-21 08:29:31', '2025-05-21 08:29:31'),
(31, 396000.00, '2025-05-27', 'Đặt cọc', 46, 'NCB', '14983768', '2025-05-27 10:27:09', '2025-05-27 10:27:09'),
(33, 142800.00, '2025-05-27', 'Đặt cọc', 52, 'NCB', '14983826', '2025-05-27 11:03:26', '2025-05-27 11:03:26'),
(34, 187000.00, '2025-05-27', 'Đặt cọc', 47, 'NCB', '14983965', '2025-05-27 13:00:54', '2025-05-27 13:00:54'),
(36, 171600.00, '2025-05-27', 'Đặt cọc', 53, 'NCB', '14983986', '2025-05-27 13:26:16', '2025-05-27 13:26:16'),
(37, 1544400.00, '2025-05-27', 'Thanh toán toàn bộ', 53, 'NCB', '14983987', '2025-05-27 13:26:57', '2025-05-27 13:26:57'),
(38, 520000.00, '2025-05-27', 'Thanh toán toàn bộ', 54, 'NCB', '14983995', '2025-05-27 13:33:58', '2025-05-27 13:33:58'),
(39, 198000.00, '2025-05-27', 'Đặt cọc', 55, 'NCB', '14984002', '2025-05-27 13:40:16', '2025-05-27 13:40:16'),
(40, 187000.00, '2025-05-28', 'Đặt cọc', 56, 'NCB', '14985037', '2025-05-28 00:39:58', '2025-05-28 00:39:58'),
(41, 350000.00, '2025-05-28', 'Thanh toán toàn bộ', 57, 'NCB', '14985278', '2025-05-28 02:01:53', '2025-05-28 02:01:53'),
(42, 344300.00, '2025-06-01', 'Đặt cọc', 59, 'NCB', '14993561', '2025-06-01 08:35:09', '2025-06-01 08:35:09'),
(43, 253000.00, '2025-06-05', 'Đặt cọc', 60, 'NCB', '15002504', '2025-06-05 11:33:26', '2025-06-05 11:33:26'),
(44, 2163328.20, '2025-06-06', 'Thanh toán toàn bộ', 44, 'NCB', '15004361', '2025-06-06 06:56:41', '2025-06-06 06:56:41'),
(45, 2163328.20, '2025-06-06', 'Thanh toán toàn bộ', 44, 'NCB', '15004361', '2025-06-06 07:03:46', '2025-06-06 07:03:46'),
(46, 2163328.20, '2025-06-06', 'Thanh toán toàn bộ', 44, 'NCB', '15004361', '2025-06-06 07:04:18', '2025-06-06 07:04:18'),
(48, 2163328.20, '2025-06-06', 'Thanh toán toàn bộ', 44, 'NCB', '15004361', '2025-06-06 07:05:10', '2025-06-06 07:05:10'),
(49, 2163328.20, '2025-06-06', 'Thanh toán toàn bộ', 44, 'NCB', '15004361', '2025-06-06 07:22:36', '2025-06-06 07:22:36'),
(50, 2163328.20, '2025-06-06', 'Thanh toán toàn bộ', 44, 'NCB', '15004361', '2025-06-06 07:23:12', '2025-06-06 07:23:12'),
(51, 2163328.20, '2025-06-06', 'Thanh toán toàn bộ', 44, 'NCB', '15004361', '2025-06-06 07:25:31', '2025-06-06 07:25:31'),
(52, 1430000.00, '2025-06-06', 'Thanh toán toàn bộ', 61, 'NCB', '15004406', '2025-06-06 07:27:24', '2025-06-06 07:27:24'),
(54, 3850000.00, '2025-06-07', 'Thanh toán toàn bộ', 62, 'NCB', '15006164', '2025-06-07 08:15:06', '2025-06-07 08:15:06'),
(55, 170000.00, '2025-06-07', 'Thanh toán toàn bộ', 64, 'NCB', '15006328', '2025-06-07 10:06:31', '2025-06-07 10:06:31'),
(56, 180000.00, '2025-06-07', 'Thanh toán toàn bộ', 63, 'NCB', '15006330', '2025-06-07 10:06:56', '2025-06-07 10:06:56'),
(58, 114400.00, '2025-06-08', 'Đặt cọc', 68, 'NCB', '15007287', '2025-06-08 03:53:13', '2025-06-08 03:53:13'),
(59, 187000.00, '2025-06-08', 'Đặt cọc', 69, 'NCB', '15007628', '2025-06-08 08:54:33', '2025-06-08 08:54:33'),
(60, 1683000.00, '2025-06-08', 'Thanh toán toàn bộ', 69, 'NCB', '15007629', '2025-06-08 08:55:15', '2025-06-08 08:55:15'),
(61, 1320000.00, '2025-06-08', 'Thanh toán toàn bộ', 71, 'NCB', '15007723', '2025-06-08 09:55:43', '2025-06-08 09:55:43'),
(62, 170000.00, '2025-06-08', 'Thanh toán toàn bộ', 72, 'NCB', '15007735', '2025-06-08 10:05:16', '2025-06-08 10:05:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hop_dong`
--

CREATE TABLE `hop_dong` (
  `id` int(10) UNSIGNED NOT NULL,
  `NgayLap` date NOT NULL,
  `ThoiGianKetThuc` date NOT NULL,
  `NgayGiaoHang` date NOT NULL,
  `NguoiGiaoHang` varchar(255) NOT NULL,
  `Thue` decimal(20,2) NOT NULL,
  `GiaTriGocHopDong` decimal(20,2) NOT NULL,
  `TongSoTienConLai` decimal(20,2) NOT NULL,
  `TienCoc` decimal(10,2) NOT NULL,
  `TrangThaiCoc` varchar(255) NOT NULL,
  `idPhieuDat` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `FileHopDong` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hop_dong`
--

INSERT INTO `hop_dong` (`id`, `NgayLap`, `ThoiGianKetThuc`, `NgayGiaoHang`, `NguoiGiaoHang`, `Thue`, `GiaTriGocHopDong`, `TongSoTienConLai`, `TienCoc`, `TrangThaiCoc`, `idPhieuDat`, `created_at`, `updated_at`, `FileHopDong`) VALUES
(19, '2025-05-13', '2025-06-08', '2025-05-31', 'Hương', 5.00, 1207500.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 41, NULL, NULL, 'private/public/hopdongs/1747151072_CV-Trinh-Quang-Vinh-Digital-Marketing.pdf'),
(20, '2025-05-13', '2025-05-25', '2025-05-14', 'Cường', 10.00, 1265000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 42, NULL, NULL, 'private/public/hopdongs/1747151617_CV-Trinh-Quang-Vinh-Digital-Marketing.pdf'),
(29, '2025-05-15', '2025-05-31', '2025-05-16', 'Dương', 10.00, 2530000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 48, NULL, NULL, 'private/public/hopdongs/1747278094_CV-Trinh-Quang-Vinh-Digital-Marketing.pdf'),
(31, '2025-05-15', '2025-05-22', '2025-05-16', 'Cường', 0.00, 720000.00, 0.00, 0.00, 'Không yêu cầu cọc', 47, NULL, NULL, 'private/public/hopdongs/1747279139_CV-Trinh-Quang-Vinh-Digital-Marketing.pdf'),
(32, '2025-05-15', '2025-05-31', '2025-05-16', 'Dương', 5.00, 2835000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 50, NULL, NULL, 'private/public/hopdongs/1747300711_De cuong CTDL va GT.pdf'),
(33, '2025-05-15', '2025-05-23', '2025-05-16', 'Bình', 5.00, 2835000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 51, NULL, NULL, 'private/public/hopdongs/1747317826_De cuong CTDL va GT.pdf'),
(34, '2025-05-15', '2025-05-24', '2025-05-16', 'Cường', 5.00, 1690500.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 53, NULL, NULL, 'private/public/hopdongs/1747324961_De cuong CTDL va GT.pdf'),
(36, '2025-05-15', '2025-05-24', '2025-05-16', 'Bình', 10.00, 3911094.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 55, NULL, NULL, 'private/public/hopdongs/1747325699_CV-Trinh-Quang-Vinh-Digital-Marketing.pdf'),
(37, '2025-05-15', '2025-05-24', '2025-05-16', 'Lam', 10.00, 253000.00, 0.00, 0.00, 'Không yêu cầu cọc', 56, NULL, NULL, 'private/public/hopdongs/1747326182_De cuong CTDL va GT.pdf'),
(38, '2025-05-21', '2025-05-31', '2025-05-31', 'Dung', 5.00, 911165.85, 0.00, 0.00, 'Đã thanh toán đặt cọc', 57, NULL, NULL, 'private/public/hopdongs/1747813374_CV-Trinh-Quang-Vinh-Digital-Marketing.pdf'),
(41, '2025-05-21', '2025-06-07', '2025-05-31', 'Nam', 5.00, 294000.00, 0.00, 0.00, 'Không yêu cầu cọc', 58, NULL, NULL, 'private/public/hopdongs/1747843061_Trinh-Quang-Vinh- Software Development Intern.pdf'),
(42, '2025-05-22', '2025-06-08', '2025-05-30', 'Lam', 5.00, 1785000.00, 1785000.00, 178500.00, 'Yêu cầu cọc 10% giá trị hợp đồng', 59, NULL, NULL, 'private/public/hopdongs/1747929106__C4_90_E1_BB_80_20C_C6_AF_C6_A0NG_20_C3_94N_20T_E1_BA_ACP_20KPDL.docx'),
(44, '2025-05-23', '2025-05-31', '2025-05-30', 'Thu', 10.00, 2163328.20, 0.00, 0.00, 'Đã thanh toán đặt cọc', 49, NULL, NULL, 'private/public/hopdongs/1748011261_De cuong CTDL va GT.pdf'),
(45, '2025-05-23', '2025-05-30', '2025-05-30', 'Dương', 10.00, 7557000.00, 7557000.00, 755700.00, 'Yêu cầu cọc 10% giá trị hợp đồng', 46, NULL, NULL, 'private/public/hopdongs/1748013025_CV-Trinh-Quang-Vinh-Digital-Marketing.pdf'),
(46, '2025-05-27', '2025-06-06', '2025-05-31', 'Cường', 10.00, 3960000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 63, NULL, NULL, 'private/public/hopdongs/1748361962_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(47, '2025-05-27', '2025-06-08', '2025-05-31', 'Nam', 10.00, 1870000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 64, NULL, NULL, 'storage/app/public/hopdongs/1748362514_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(48, '2025-05-27', '2025-06-01', '2025-05-29', 'Bình', 10.00, 792000.00, 792000.00, 0.00, 'Không yêu cầu cọc', 54, NULL, NULL, 'private/public/hopdongs/1748363011_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(49, '2025-05-27', '2025-06-01', '2025-05-30', 'Dương', 10.00, 2530000.00, 2530000.00, 253000.00, 'Yêu cầu cọc 10% giá trị hợp đồng', 45, NULL, NULL, 'private/public/hopdongs/1748363331_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(50, '2025-05-27', '2025-06-08', '2025-06-06', 'Cường', 10.00, 3911094.00, 3911094.00, 391109.40, 'Yêu cầu cọc 10% giá trị hợp đồng', 44, NULL, NULL, 'private/public/hopdongs/1748364271_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(51, '2025-05-27', '2025-06-07', '2025-05-30', 'Dương', 10.00, 2242773.50, 2242773.50, 224277.35, 'Yêu cầu cọc 10% giá trị hợp đồng', 39, NULL, NULL, 'private/public/hopdongs/1748365864_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(52, '2025-05-27', '2025-06-08', '2025-05-31', 'Dương', 5.00, 1428000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 65, NULL, NULL, 'private/public/hopdongs/1748368813_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(53, '2025-05-27', '2025-06-08', '2025-05-30', 'Hải', 10.00, 1716000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 66, NULL, NULL, 'private/public/hopdongs/1748377344_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(54, '2025-05-27', '2025-05-31', '2025-05-31', 'Nam', 0.00, 520000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 67, NULL, NULL, 'private/public/hopdongs/1748377990_CV-Trinh-Quang-Vinh-Digital-Marketing.pdf'),
(55, '2025-05-27', '2025-06-01', '2025-05-30', 'Lan', 10.00, 1980000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 68, NULL, NULL, 'private/public/hopdongs/1748378371_Trinh-Quang-Vinh- Software Development Intern.pdf'),
(56, '2025-05-28', '2025-06-08', '2025-05-31', 'Hùng', 10.00, 1870000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 72, NULL, NULL, 'private/public/hopdongs/1748417791_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(57, '2025-05-28', '2025-05-29', '2025-05-29', 'Cường', 0.00, 350000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 73, NULL, NULL, 'private/public/hopdongs/1748422796_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(58, '2025-05-28', '2025-05-31', '2025-05-31', 'Nam', 0.00, 270000.00, 0.00, 0.00, 'Không yêu cầu cọc', 74, NULL, NULL, 'private/public/hopdongs/1748423171_NVTDuAnhVinh.docx'),
(59, '2025-05-28', '2025-06-07', '2025-06-05', 'Nguyễn Văn A', 10.00, 3443000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 77, NULL, NULL, 'private/public/hopdongs/1748457257_1747452390_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(60, '2025-06-05', '2025-06-21', '2025-06-20', 'Lam', 10.00, 2530000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 79, NULL, NULL, 'private/public/hopdongs/1749146095_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(61, '2025-06-06', '2025-06-29', '2025-06-21', 'Nam', 10.00, 1430000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 80, NULL, NULL, 'private/public/hopdongs/1749220011_543-tb-dhhhvn_1.pdf'),
(62, '2025-06-07', '2025-06-14', '2025-06-14', 'Nguyễn Văn A', 10.00, 3850000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 81, NULL, NULL, 'private/public/hopdongs/1749309032_1747452390_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(63, '2025-06-07', '2025-06-18', '2025-06-11', 'Vinh', 0.00, 180000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 82, NULL, NULL, 'private/public/hopdongs/1749315899_1749300800_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(64, '2025-06-07', '2025-06-19', '2025-06-11', 'Hương', 0.00, 170000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 83, NULL, NULL, 'private/public/hopdongs/1749315927_bao-cao-khach-hang.pdf'),
(66, '2025-06-07', '2025-06-25', '2025-06-12', 'Dương', 0.00, 158400.00, 0.00, 0.00, 'Không yêu cầu cọc', 85, NULL, NULL, 'private/public/hopdongs/1749316683_1749300800_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(67, '2025-06-08', '2025-06-26', '2025-06-19', 'Dung', 10.00, 2226400.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 86, NULL, NULL, 'private/public/hopdongs/1749365107_1749315899_1749300800_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(68, '2025-06-08', '2025-06-28', '2025-06-26', 'Kiệt', 10.00, 1144000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 87, NULL, NULL, 'private/public/hopdongs/1749379835_1749315899_1749300800_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(69, '2025-06-08', '2025-06-21', '2025-06-21', 'Bình', 10.00, 1870000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 88, NULL, NULL, 'private/public/hopdongs/1749397960_1749300800_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(70, '2025-06-08', '2025-06-21', '2025-06-13', 'Nam', 0.00, 80000.00, 80000.00, 0.00, 'Không yêu cầu cọc', 89, NULL, NULL, 'private/public/hopdongs/1749401535_1749300800_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(71, '2025-06-08', '2025-06-22', '2025-06-14', 'Dương', 10.00, 1320000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 62, NULL, NULL, 'private/public/hopdongs/1749401593_1749300800_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf'),
(72, '2025-06-08', '2025-06-12', '2025-06-09', 'Nam', 0.00, 170000.00, 0.00, 0.00, 'Đã thanh toán đặt cọc', 90, NULL, NULL, 'private/public/hopdongs/1749402283_bao-cao-doanh-so.pdf'),
(73, '2025-06-09', '2025-06-19', '2025-06-11', 'Dung', 10.00, 1029600.00, 1029600.00, 102960.00, 'Yêu cầu cọc 10% giá trị hợp đồng', 91, NULL, NULL, 'private/public/hopdongs/1749434488_1749315899_1749300800_CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM (1).pdf');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `idLoaiKhachHang` int(10) UNSIGNED NOT NULL,
  `idTaiKhoan` int(10) UNSIGNED NOT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `SoDienThoai` char(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`id`, `idLoaiKhachHang`, `idTaiKhoan`, `DiaChi`, `SoDienThoai`, `created_at`, `updated_at`) VALUES
(1, 2, 19, 'hải phòng', '09075312112', '2025-04-25 22:20:25', '2025-06-06 07:25:43'),
(2, 3, 20, 'hà nội', '03512953012', '2025-04-25 22:27:14', '2025-05-28 11:27:43'),
(3, 2, 23, 'hải phòng', '09053422342', '2025-05-23 06:47:02', '2025-05-29 10:01:04'),
(5, 3, 25, 'hải phòng', '0549102341', '2025-05-27 13:20:37', '2025-05-27 13:40:41'),
(6, 1, 26, 'Hải Phòng', '0987654321', '2025-05-28 11:29:03', '2025-05-28 11:29:33'),
(7, 1, 27, 'Hải Phòng', '0349180231', '2025-06-02 23:58:21', '2025-06-03 00:22:08'),
(8, 2, 28, 'hải phòng', '03512953012', '2025-06-05 10:39:07', '2025-06-08 03:46:34'),
(9, 1, 29, 'Hải Phòng', '0987654321', '2025-06-07 08:08:10', '2025-06-07 08:09:31'),
(10, 3, 30, 'hải phòng', '03491802313', '2025-06-08 08:49:17', '2025-06-08 10:40:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khos`
--

CREATE TABLE `khos` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenKho` varchar(255) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khos`
--

INSERT INTO `khos` (`id`, `TenKho`, `DiaChi`, `created_at`, `updated_at`) VALUES
(1, 'Kho 1', 'Hải phòng', NULL, NULL),
(2, 'Kho 2', 'Hà Nội', NULL, NULL),
(3, 'kho 3', 'Đà Nẵng', '2025-04-04 09:07:14', '2025-04-04 09:07:14'),
(4, 'Kho 4', 'Hải Phòng', '2025-05-14 20:23:09', '2025-05-14 20:27:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyen_mais`
--

CREATE TABLE `khuyen_mais` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenKhuyenMai` varchar(255) NOT NULL,
  `GiamGia` decimal(10,2) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL DEFAULT 1,
  `idLoaiKhachHang` int(10) UNSIGNED NOT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyen_mais`
--

INSERT INTO `khuyen_mais` (`id`, `TenKhuyenMai`, `GiamGia`, `TrangThai`, `idLoaiKhachHang`, `NgayBatDau`, `NgayKetThuc`, `created_at`, `updated_at`) VALUES
(333, 'Khuyến mãi cho khách vip', 20.00, 1, 2, '2025-06-06', '2025-06-20', '2025-05-27 22:15:37', '2025-06-07 21:00:43'),
(1234, 'Khuyến mãi cho khách quen', 12.00, 1, 3, '2025-05-28', '2025-06-27', '2025-05-27 22:50:15', '2025-06-07 21:00:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_khach_hangs`
--

CREATE TABLE `loai_khach_hangs` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenLoaiKhachHang` varchar(255) NOT NULL,
  `DieuKien` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_khach_hangs`
--

INSERT INTO `loai_khach_hangs` (`id`, `TenLoaiKhachHang`, `DieuKien`, `created_at`, `updated_at`) VALUES
(1, 'Khách hàng mới', 0, '2025-04-15 19:24:40', '2025-04-26 08:07:50'),
(2, 'Khách hàng vip', 5, '2025-04-21 20:05:09', '2025-04-26 08:07:22'),
(3, 'Khách hàng quen', 2, '2025-04-26 08:08:02', '2025-06-07 22:33:41'),
(4, 'Khách hàng thân quen', 10, '2025-05-21 00:29:40', '2025-05-21 00:29:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_san_phams`
--

CREATE TABLE `loai_san_phams` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenLoaiSanPham` varchar(100) NOT NULL,
  `TrangThai` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_san_phams`
--

INSERT INTO `loai_san_phams` (`id`, `TenLoaiSanPham`, `TrangThai`, `created_at`, `updated_at`) VALUES
(1, 'Sơn bình gas', 1, NULL, NULL),
(2, 'Sơn xe đạp', 1, NULL, NULL),
(3, 'Sơn tủ điện', 1, NULL, NULL),
(4, 'Sơn nội thất', 1, NULL, NULL),
(5, 'Sơn nhôm', 1, NULL, NULL),
(6, 'Sơn giá kệ', 1, NULL, NULL),
(7, 'Sơn máng cáp', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `maus`
--

CREATE TABLE `maus` (
  `id` int(20) UNSIGNED NOT NULL,
  `TenMau` varchar(100) NOT NULL,
  `HinhAnh` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `maus`
--

INSERT INTO `maus` (`id`, `TenMau`, `HinhAnh`, `created_at`, `updated_at`) VALUES
(123, 'màu nâu sữa', '1748704594.9970h800mthang45.jpg', '2025-04-15 19:45:23', '2025-05-31 08:16:34'),
(303, 'màu lam ngọc', '1748704566.ảnh sơn xanh.jpg', '2025-05-18 00:34:35', '2025-05-31 08:16:06'),
(325, 'màu xanh đậm', '1748704556.sơn xe đạp.jpg', '2025-05-18 00:49:41', '2025-05-31 08:15:56'),
(326, 'xám bóng', '1748704543.73148280h106g03-78.jpg', '2025-05-18 00:46:19', '2025-05-31 08:15:43'),
(356, 'tím hồng', '1748704527.4773t206r24-21.jpg', '2025-05-18 01:06:34', '2025-05-31 08:15:27'),
(409, 'Sơn màu ghi sần cát', '1748704669_1035t770gk4-09.jpg', '2025-05-31 08:17:49', '2025-05-31 08:17:49'),
(603, 'Sơn phẳng, bóng, màu hồng', '1748704520.3477t106r20-23.jpg', '2025-05-23 03:29:40', '2025-05-31 08:15:20'),
(834, 'Sơn xanh phẳng', '1748704971_5734t106v18-34.jpg', '2025-05-31 08:22:51', '2025-05-31 08:22:51'),
(1001, 'Sơn phẳng màu đỏ độ bóng cao', '1748705140_1140h106c03-03.jpg', '2025-05-31 08:25:40', '2025-05-31 08:25:40'),
(1303, 'Sơn phẳng màu cam', '1748705091_1140h106c03-03.jpg', '2025-05-31 08:24:51', '2025-05-31 08:24:51'),
(2206, 'xám', '1748704510.ảnh sơn xám.jpg', '2025-05-23 03:34:56', '2025-05-31 08:15:10'),
(3026, 'vàng sáng', '1748704881.1807h106y04-03.jpg', '2025-04-03 23:33:26', '2025-05-31 08:21:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_30_130345_create_loai_san_phams_table', 1),
(5, '2025_03_30_130411_create_maus_table', 1),
(6, '2025_03_31_161019_don_vi_tinh', 2),
(7, '2025_03_30_141337_create_san_phams_table', 3),
(8, '2025_04_03_145720_create_bang_gias_table', 3),
(9, '2025_04_04_044921_create_khos_table', 4),
(10, '2025_04_04_044702_create_phieu_nhap_khos_table', 5),
(11, '2025_04_04_045441_create_chi_tiet_phieu_nhaps_table', 6),
(12, '2025_04_04_150821_create_loai_khach_hangs_table', 7),
(13, '2025_04_04_150711_create_khuyen_mais_table', 8),
(14, '2025_04_07_093905_quyens', 9),
(15, '2025_04_14_005521_phan_quyen', 10),
(16, '2025_04_11_090541_phuong_thuc_thanh_toan', 11),
(17, '2025_04_16_133842_phanquyen', 12),
(20, '2025_04_04_164944_san_phams', 13),
(23, '2025_04_24_113430_bang_gia', 14),
(24, '2025_04_26_035535_khach_hang', 15),
(26, '2025_04_26_151327_phieu_dat_hang', 16),
(27, '2025_04_26_151347_chi_tiet_phieu_dat_hang', 17),
(29, '2025_04_27_133510_hop_dong', 18),
(32, '2025_04_29_021130_don_hang', 19),
(33, '2025_05_11_104249_payment', 20),
(34, '2025_05_09_151918_hoa_don', 21),
(35, '2025_05_13_143417_phan_hoi_khach_hang', 22),
(36, '2025_05_14_033521_chi_tiet_khos', 23),
(37, '2025_05_14_033723_phieu_kiem_kes', 24),
(39, '2025_05_23_153949_phieu_doi_tra', 25),
(43, '2025_05_23_161030_ct_phieu_doi_tra', 26);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_hoi_khach_hang`
--

CREATE TABLE `phan_hoi_khach_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) NOT NULL,
  `idKhachHang` int(10) UNSIGNED NOT NULL,
  `idSanPham` int(10) UNSIGNED NOT NULL,
  `ThoiGian` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phan_hoi_khach_hang`
--

INSERT INTO `phan_hoi_khach_hang` (`id`, `comment`, `idKhachHang`, `idSanPham`, `ThoiGian`, `created_at`, `updated_at`) VALUES
(5, 'sp tốt', 1, 5, '2025-05-13 16:05:30', NULL, NULL),
(11, 'sản phẩm bị lỗi', 2, 6, '2025-05-13 17:06:09', NULL, NULL),
(12, 'sp hay', 2, 5, '2025-05-15 17:50:50', '2025-05-15 10:50:50', '2025-05-15 10:50:50'),
(13, 'sản phẩm dùng ổn', 1, 5, '2025-05-16 03:12:57', '2025-05-15 20:12:57', '2025-05-15 20:12:57'),
(14, 'Dùng tốt\r\n', 3, 9, '2025-05-27 20:09:51', '2025-05-27 13:09:51', '2025-05-27 13:09:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_quyen`
--

CREATE TABLE `phan_quyen` (
  `id` int(11) NOT NULL,
  `idTaiKhoan` int(10) UNSIGNED NOT NULL,
  `idQuyen` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phan_quyen`
--

INSERT INTO `phan_quyen` (`id`, `idTaiKhoan`, `idQuyen`) VALUES
(1, 1, 12),
(2, 7, 17),
(3, 1, 16),
(4, 22, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_chuyen_khos`
--

CREATE TABLE `phieu_chuyen_khos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idKhoChuyen` int(10) UNSIGNED NOT NULL,
  `idKhoNhan` int(10) UNSIGNED NOT NULL,
  `NguoiChuyen` varchar(255) NOT NULL,
  `NgayLap` date NOT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `NguoiLap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_chuyen_khos`
--

INSERT INTO `phieu_chuyen_khos` (`id`, `idKhoChuyen`, `idKhoNhan`, `NguoiChuyen`, `NgayLap`, `GhiChu`, `created_at`, `updated_at`, `NguoiLap`) VALUES
(7, 1, 4, 'Nguyen Thị B', '2025-05-15', NULL, '2025-05-15 01:00:30', '2025-05-15 01:00:30', NULL),
(8, 2, 4, 'Nguyen Thị B', '2025-06-07', NULL, '2025-06-07 08:37:42', '2025-06-07 08:37:42', 'Nguyễn Huy Du'),
(9, 2, 4, 'Ánh', '2025-06-08', NULL, '2025-06-08 10:25:15', '2025-06-08 10:25:15', 'Nguyễn Huy Du');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_dat_hang`
--

CREATE TABLE `phieu_dat_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `NgayLap` date NOT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  `TrangThai` int(10) UNSIGNED NOT NULL,
  `idPhuongThuc` int(10) UNSIGNED NOT NULL,
  `idKhuyenMai` int(10) UNSIGNED DEFAULT NULL,
  `TongTien` decimal(10,2) NOT NULL,
  `TongSoLuong` int(11) NOT NULL,
  `TenKhachHang` varchar(100) NOT NULL,
  `SoDienThoai` char(15) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `LoaiKhachHang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_dat_hang`
--

INSERT INTO `phieu_dat_hang` (`id`, `NgayLap`, `GhiChu`, `TrangThai`, `idPhuongThuc`, `idKhuyenMai`, `TongTien`, `TongSoLuong`, `TenKhachHang`, `SoDienThoai`, `Email`, `DiaChi`, `LoaiKhachHang`) VALUES
(39, '2025-05-13', NULL, 1, 2, NULL, 2038885.00, 10, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(40, '2025-05-13', NULL, 1, 1, NULL, 2300000.00, 10, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(41, '2025-05-13', NULL, 1, 1, NULL, 1150000.00, 5, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(42, '2025-05-13', NULL, 1, 1, NULL, 1150000.00, 5, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(44, '2025-05-13', NULL, 1, 2, NULL, 3555540.00, 20, 'huy du', '03512953012', 'Du123@gmail.com', 'hà nội', 'Khách hàng mới'),
(45, '2025-05-14', NULL, 1, 2, NULL, 2300000.00, 10, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(46, '2025-05-14', NULL, 1, 2, NULL, 6870000.00, 34, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(47, '2025-05-14', NULL, 1, 2, NULL, 720000.00, 4, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(48, '2025-05-15', NULL, 1, 2, NULL, 2300000.00, 10, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(49, '2025-05-15', NULL, 1, 1, NULL, 1966662.00, 11, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(50, '2025-05-15', NULL, 1, 1, NULL, 2700000.00, 15, 'huy du', '03512953012', 'Du123@gmail.com', 'hà nội', 'Khách hàng mới'),
(51, '2025-05-15', NULL, 1, 2, NULL, 2700000.00, 15, 'huy du', '03512953012', 'Du123@gmail.com', 'hà nội', 'Khách hàng mới'),
(53, '2025-05-15', NULL, 1, 2, NULL, 1610000.00, 7, 'huy du', '03512953012', 'Du123@gmail.com', 'hà nội', 'Khách hàng mới'),
(54, '2025-05-15', NULL, 1, 1, NULL, 720000.00, 4, 'huy du', '03512953012', 'Du123@gmail.com', 'hà nội', 'Khách hàng mới'),
(55, '2025-05-15', NULL, 1, 1, NULL, 3555540.00, 20, 'Khách hàng mới', '03512953012', 'Du123@gmail.com', 'hà nội', 'Khách hàng mới'),
(56, '2025-05-15', NULL, 1, 2, NULL, 230000.00, 1, 'huy du', '03512953012', 'Du123@gmail.com', 'hà nội', 'Khách hàng mới'),
(57, '2025-05-21', 'hàng', 1, 1, NULL, 867777.00, 5, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(58, '2025-05-21', NULL, 1, 2, NULL, 280000.00, 2, 'Quang vinh', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng mới'),
(59, '2025-05-22', NULL, 1, 1, NULL, 1700000.00, 10, 'huy du', '03512953012', 'Du123@gmail.com', 'hà nội', 'Khách hàng mới'),
(62, '2025-05-23', NULL, 1, 1, NULL, 1200000.00, 10, 'quang vinh', '09053422342', 'vquang2002@gmail.com', 'hải phòng', 'Khách hàng mới'),
(63, '2025-05-27', NULL, 1, 2, NULL, 3600000.00, 20, 'quang vinh', '09053422342', 'vquang2002@gmail.com', 'hải phòng', 'Khách hàng mới'),
(64, '2025-05-27', 'Giao hàng tới tận nơi', 1, 2, NULL, 1700000.00, 10, 'quang vinh', '09053422342', 'vquang2002@gmail.com', 'hải phòng', 'Khách hàng mới'),
(65, '2025-05-27', NULL, 1, 2, NULL, 1360000.00, 8, 'quang vinh', '09053422342', 'vquang2002@gmail.com', 'hải phòng', 'Khách hàng mới'),
(66, '2025-05-27', NULL, 1, 1, NULL, 1560000.00, 12, 'Hải', '0549102341', 'kk@gmail.com', 'hải phòng', 'Khách hàng mới'),
(67, '2025-05-27', NULL, 1, 1, NULL, 520000.00, 4, 'Hải', '0549102341', 'kk@gmail.com', 'hải phòng', 'Khách hàng mới'),
(68, '2025-05-27', NULL, 1, 2, NULL, 1800000.00, 12, 'Hải', '0549102341', 'kk@gmail.com', 'hải phòng', 'Khách hàng mới'),
(69, '2025-05-28', NULL, 0, 1, NULL, 170000.00, 1, 'Hải', '0549102341', 'kk@gmail.com', 'hải phòng', 'Khách hàng mới'),
(70, '2025-05-28', NULL, 0, 1, NULL, 2810000.00, 17, 'Hải', '0549102341', 'kk@gmail.com', 'hải phòng', 'Khách hàng mới'),
(71, '2025-05-28', NULL, 0, 1, NULL, 300000.00, 2, 'Hải', '0549102341', 'kk@gmail.com', 'hải phòng', 'Khách hàng mới'),
(72, '2025-05-28', NULL, 1, 2, NULL, 1700000.00, 10, 'quang vinh', '09053422342', 'vquang2002@gmail.com', 'hải phòng', 'Khách hàng mới'),
(73, '2025-05-28', NULL, 1, 1, NULL, 350000.00, 2, 'quang vinh', '09053422342', 'vquang2002@gmail.com', 'hải phòng', 'Khách hàng mới'),
(74, '2025-05-28', NULL, 1, 2, NULL, 270000.00, 2, 'quang vinh', '09053422342', 'vquang2002@gmail.com', 'hải phòng', 'Khách hàng mới'),
(76, '2025-05-29', NULL, 0, 1, 333, 149600.00, 1, 'quang vinh', '09053422342', 'vquang2002@gmail.com', 'hải phòng', 'Khách hàng mới'),
(77, '2025-05-28', NULL, 1, 2, NULL, 3130000.00, 21, 'huy du', '03512953012', 'Du123@gmail.com', 'hà nội', 'Khách hàng mới'),
(78, '2025-06-03', NULL, 0, 1, NULL, 1700000.00, 10, 'son', '0349180231', 'son@gmail.com', 'Hải Phòng', 'Khách hàng mới'),
(79, '2025-06-05', 'Giao hàng tới tận nơi', 1, 2, NULL, 2300000.00, 10, 'test', '03512953012', 'test@gmail.com', 'hải phòng', 'Khách hàng mới'),
(80, '2025-06-06', 'Giao hàng tới tận nơi', 1, 1, NULL, 1300000.00, 10, 'Quang vinh\r\n', '09075312112', 'vquang2003@gmail.com', 'hải phòng', 'Khách hàng vip'),
(81, '2025-06-07', NULL, 1, 1, NULL, 3500000.00, 20, 'Đào Thị Hạnh', '0987654321', 'Hanh@gmail.com', 'Hải Phòng', 'Khách hàng mới'),
(82, '2025-06-07', NULL, 1, 1, NULL, 180000.00, 1, 'test', '03512953012', 'test@gmail.com', 'hải phòng', 'Khách hàng mới'),
(83, '2025-06-07', NULL, 1, 1, NULL, 170000.00, 1, 'test', '03512953012', 'test@gmail.com', 'hải phòng', 'Khách hàng mới'),
(85, '2025-06-07', NULL, 1, 2, 1234, 158400.00, 1, 'test', '03512953012', 'test@gmail.com', 'hải phòng', 'Khách hàng quen'),
(86, '2025-06-08', 'Giao hàng tới tận nơi', 1, 1, 1234, 2024000.00, 10, 'test', '03512953012', 'test@gmail.com', 'hải phòng', 'Khách hàng quen'),
(87, '2025-06-08', NULL, 1, 2, 333, 1040000.00, 10, 'test', '03512953012', 'test@gmail.com', 'hải phòng', 'Khách hàng vip'),
(88, '2025-06-08', 'lưu ý', 1, 1, NULL, 1700000.00, 10, 'tester', '0349180231', 'tester@gmail.com', 'hải phòng', 'Khách hàng mới'),
(89, '2025-06-08', NULL, 1, 1, 333, 80000.00, 1, 'test', '03512953012', 'test@gmail.com', 'hải phòng', 'Khách hàng vip'),
(90, '2025-06-08', NULL, 1, 1, NULL, 170000.00, 1, 'tester', '0349180231', 'tester@gmail.com', 'hải phòng', 'Khách hàng mới'),
(91, '2025-06-09', 'luu y', 1, 1, 333, 936000.00, 11, 'test', '03512953012', 'test@gmail.com', 'hải phòng', 'Khách hàng vip');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_doi_tra`
--

CREATE TABLE `phieu_doi_tra` (
  `id` int(10) UNSIGNED NOT NULL,
  `NgayLap` date NOT NULL,
  `MoTa` varchar(255) NOT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  `TrangThai` varchar(255) NOT NULL,
  `idKhachHang` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_doi_tra`
--

INSERT INTO `phieu_doi_tra` (`id`, `NgayLap`, `MoTa`, `GhiChu`, `TrangThai`, `idKhachHang`) VALUES
(22, '2025-05-28', 'HÀNG LỖI', NULL, 'Đã hoàn thành đổi trả', 3),
(23, '2025-06-08', 'sai màu', NULL, 'Đã hoàn thành đổi trả', 8),
(24, '2025-06-08', 'Lý do đổi trả: lỗi hỏng', NULL, 'Đã hoàn thành đổi trả', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_kiem_kes`
--

CREATE TABLE `phieu_kiem_kes` (
  `id` int(10) UNSIGNED NOT NULL,
  `NgayLap` date NOT NULL,
  `idKho` int(10) UNSIGNED NOT NULL,
  `NguoiKiemKe` varchar(255) NOT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `NguoiLap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_kiem_kes`
--

INSERT INTO `phieu_kiem_kes` (`id`, `NgayLap`, `idKho`, `NguoiKiemKe`, `GhiChu`, `created_at`, `updated_at`, `NguoiLap`) VALUES
(22, '2025-05-15', 3, 'Nguyễn Hùng Việt', NULL, '2025-05-15 00:46:02', '2025-05-15 00:46:02', NULL),
(23, '2025-05-15', 1, 'anh', NULL, '2025-05-15 01:18:35', '2025-05-15 01:18:35', NULL),
(24, '2025-05-15', 3, 'anh', NULL, '2025-05-15 01:19:01', '2025-05-15 01:19:01', NULL),
(25, '2025-06-07', 4, 'Nguyễn Hùng Việt', NULL, '2025-06-07 08:37:10', '2025-06-07 08:37:10', 'Nguyễn Huy Du');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_nhap_khos`
--

CREATE TABLE `phieu_nhap_khos` (
  `id` int(10) UNSIGNED NOT NULL,
  `NgayLap` date NOT NULL,
  `NguoiGiaoHang` varchar(255) NOT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  `idKho` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `NguoiLap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_nhap_khos`
--

INSERT INTO `phieu_nhap_khos` (`id`, `NgayLap`, `NguoiGiaoHang`, `GhiChu`, `idKho`, `created_at`, `updated_at`, `NguoiLap`) VALUES
(26, '2025-05-15', 'Nguyễn Văn A', NULL, 1, '2025-05-14 23:37:52', '2025-05-14 23:37:52', NULL),
(27, '2025-05-15', 'Nguyễn Văn A', NULL, 2, '2025-05-14 23:38:23', '2025-05-14 23:38:23', NULL),
(28, '2025-05-15', 'Nguyễn Thị B', NULL, 3, '2025-05-14 23:38:47', '2025-05-14 23:38:47', NULL),
(29, '2025-05-28', 'Hải', NULL, 1, '2025-05-28 02:04:15', '2025-05-28 02:04:15', NULL),
(30, '2025-06-07', 'Nguyễn Văn A', NULL, 4, '2025-06-07 08:22:28', '2025-06-07 08:22:28', 'Nguyễn Huy Du'),
(31, '2025-06-08', 'Bình', NULL, 4, '2025-06-08 09:03:11', '2025-06-08 09:03:11', 'Nguyễn Huy Du'),
(33, '2025-06-08', 'Hải', NULL, 2, '2025-06-08 09:04:07', '2025-06-08 09:04:07', 'Nguyễn Huy Du'),
(34, '2025-06-08', 'Hải', NULL, 3, '2025-06-08 09:51:39', '2025-06-08 10:17:43', 'Nguyễn Huy Du');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_xuat_khos`
--

CREATE TABLE `phieu_xuat_khos` (
  `id` int(10) UNSIGNED NOT NULL,
  `NgayLap` date NOT NULL,
  `NguoiNhanHang` varchar(255) NOT NULL,
  `TongTien` int(11) NOT NULL DEFAULT 0,
  `GhiChu` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `NguoiLap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_xuat_khos`
--

INSERT INTO `phieu_xuat_khos` (`id`, `NgayLap`, `NguoiNhanHang`, `TongTien`, `GhiChu`, `created_at`, `updated_at`, `NguoiLap`) VALUES
(9, '2025-05-15', 'Cường', 1150000, NULL, '2025-05-14 23:59:41', '2025-05-14 23:59:41', NULL),
(10, '2025-05-28', 'Hùng', 1700000, NULL, '2025-05-28 00:40:47', '2025-05-28 00:40:47', NULL),
(11, '2025-05-28', 'Cường', 350000, NULL, '2025-05-28 02:02:45', '2025-05-28 02:02:45', NULL),
(12, '2025-05-30', 'Nam', 270000, NULL, '2025-05-30 10:08:29', '2025-05-30 10:08:29', NULL),
(13, '2025-05-30', 'Hùng', 1700000, NULL, '2025-05-30 10:08:33', '2025-05-30 10:08:33', NULL),
(14, '2025-05-30', 'Lan', 1800000, NULL, '2025-05-30 10:08:37', '2025-05-30 10:08:37', NULL),
(15, '2025-05-30', 'Nam', 520000, NULL, '2025-05-30 10:08:42', '2025-05-30 10:08:42', NULL),
(16, '2025-06-01', 'Nguyễn Văn A', 3130000, NULL, '2025-06-01 08:36:41', '2025-06-01 08:36:41', NULL),
(17, '2025-06-07', 'Nguyễn Văn A', 3500000, NULL, '2025-06-07 08:15:45', '2025-06-07 08:15:45', NULL),
(18, '2025-06-07', 'Nam', 1300000, NULL, '2025-06-07 08:27:14', '2025-06-07 08:27:14', 'Nguyễn Huy Du'),
(19, '2025-06-08', 'Kiệt', 1300000, NULL, '2025-06-08 03:53:52', '2025-06-08 03:53:52', 'Nguyễn Huy Du'),
(20, '2025-06-08', 'Bình', 1700000, NULL, '2025-06-08 09:09:07', '2025-06-08 09:09:07', 'Nguyễn Huy Du'),
(21, '2025-06-08', 'Nam', 170000, NULL, '2025-06-08 10:18:22', '2025-06-08 10:18:22', 'Nguyễn Huy Du');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong_thuc_thanh_toan`
--

CREATE TABLE `phuong_thuc_thanh_toan` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenPhuongThucThanhToan` varchar(255) NOT NULL,
  `CachThuc` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phuong_thuc_thanh_toan`
--

INSERT INTO `phuong_thuc_thanh_toan` (`id`, `TenPhuongThucThanhToan`, `CachThuc`, `created_at`, `updated_at`) VALUES
(1, 'Thanh toán online', 'thanh toán bằng tk ngân hàng', '2025-04-15 19:53:53', '2025-05-13 11:38:54'),
(2, 'Thanh toán trực tiếp', 'đưa trực tiếp', '2025-04-15 19:54:06', '2025-05-13 11:38:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyens`
--

CREATE TABLE `quyens` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenQuyen` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyens`
--

INSERT INTO `quyens` (`id`, `TenQuyen`, `permission`, `created_at`, `updated_at`) VALUES
(12, 'admin', '[\"admin.index\",\"QLthongtinkhachhang.index\",\"QLthongtinkhachhang.index\",\"QLthongtinkhachhang.create\",\"QLthongtinkhachhang.store\",\"QLthongtinkhachhang.show\",\"QLthongtinkhachhang.edit\",\"QLthongtinkhachhang.update\",\"QLthongtinkhachhang.destroy\",\"color.index\",\"color.create\",\"color.store\",\"color.show\",\"color.edit\",\"color.update\",\"color.destroy\",\"donvitinh.index\",\"donvitinh.create\",\"donvitinh.store\",\"donvitinh.show\",\"donvitinh.edit\",\"donvitinh.update\",\"donvitinh.destroy\",\"productcategory.index\",\"productcategory.create\",\"productcategory.store\",\"productcategory.show\",\"productcategory.edit\",\"productcategory.update\",\"productcategory.destroy\",\"Baogia.index\",\"Baogia.create\",\"Baogia.store\",\"Baogia.show\",\"Baogia.edit\",\"Baogia.update\",\"Baogia.destroy\",\"QLchitietkho.index\",\"QLchitietkho.create\",\"QLchitietkho.store\",\"QLchitietkho.show\",\"QLchitietkho.edit\",\"QLchitietkho.update\",\"QLchitietkho.destroy\",\"QLphieunhapkho.index\",\"QLphieunhapkho.create\",\"QLphieunhapkho.store\",\"QLphieunhapkho.show\",\"QLphieunhapkho.edit\",\"QLphieunhapkho.update\",\"QLphieunhapkho.destroy\",\"QLchitietthemphieunhap.index\",\"QLchitietthemphieunhap.create\",\"QLchitietthemphieunhap.store\",\"QLchitietthemphieunhap.show\",\"QLchitietthemphieunhap.edit\",\"QLchitietthemphieunhap.update\",\"QLchitietthemphieunhap.destroy\",\"QLchitietsuaphieunhap.index\",\"QLchitietsuaphieunhap.create\",\"QLchitietsuaphieunhap.store\",\"QLchitietsuaphieunhap.show\",\"QLchitietsuaphieunhap.edit\",\"QLchitietsuaphieunhap.update\",\"QLchitietsuaphieunhap.destroy\",\"QLphieukiemke.index\",\"QLphieukiemke.create\",\"QLphieukiemke.store\",\"QLphieukiemke.show\",\"QLphieukiemke.edit\",\"QLphieukiemke.update\",\"QLphieukiemke.destroy\",\"QLctthemkiemke.index\",\"QLctthemkiemke.create\",\"QLctthemkiemke.store\",\"QLctthemkiemke.show\",\"QLctthemkiemke.edit\",\"QLctthemkiemke.update\",\"QLctthemkiemke.destroy\",\"QLctsuakkiemke.index\",\"QLctsuakkiemke.create\",\"QLctsuakkiemke.store\",\"QLctsuakkiemke.show\",\"QLctsuakkiemke.edit\",\"QLctsuakkiemke.update\",\"QLctsuakkiemke.destroy\",\"QLphieuchuyenkho.index\",\"QLphieuchuyenkho.create\",\"QLphieuchuyenkho.store\",\"QLphieuchuyenkho.show\",\"QLphieuchuyenkho.edit\",\"QLphieuchuyenkho.update\",\"QLphieuchuyenkho.destroy\",\"QLctthemchuyenkho.index\",\"QLctthemchuyenkho.create\",\"QLctthemchuyenkho.store\",\"QLctthemchuyenkho.show\",\"QLctthemchuyenkho.edit\",\"QLctthemchuyenkho.update\",\"QLctthemchuyenkho.destroy\",\"QLctsuachuyenkho.index\",\"QLctsuachuyenkho.create\",\"QLctsuachuyenkho.store\",\"QLctsuachuyenkho.show\",\"QLctsuachuyenkho.edit\",\"QLctsuachuyenkho.update\",\"QLctsuachuyenkho.destroy\",\"QLxuatkho.index\",\"QLxuatkho.create\",\"QLxuatkho.store\",\"QLxuatkho.show\",\"QLxuatkho.edit\",\"QLxuatkho.update\",\"QLxuatkho.destroy\",\"QLkho.index\",\"QLkho.create\",\"QLkho.store\",\"QLkho.show\",\"QLkho.edit\",\"QLkho.update\",\"QLkho.destroy\",\"QLhopdong.index\",\"QLhopdong.create\",\"QLhopdong.store\",\"QLhopdong.show\",\"QLhopdong.edit\",\"QLhopdong.update\",\"QLhopdong.destroy\",\"MNproduct.index\",\"MNproduct.create\",\"MNproduct.store\",\"MNproduct.show\",\"MNproduct.edit\",\"MNproduct.update\",\"MNproduct.destroy\",\"QLloaikhachhang.index\",\"QLloaikhachhang.create\",\"QLloaikhachhang.store\",\"QLloaikhachhang.show\",\"QLloaikhachhang.edit\",\"QLloaikhachhang.update\",\"QLloaikhachhang.destroy\",\"QLkhuyenmai.index\",\"QLkhuyenmai.create\",\"QLkhuyenmai.store\",\"QLkhuyenmai.show\",\"QLkhuyenmai.edit\",\"QLkhuyenmai.update\",\"QLkhuyenmai.destroy\",\"qlphieudat.index\",\"qlphieudat.create\",\"qlphieudat.store\",\"qlphieudat.show\",\"qlphieudat.edit\",\"qlphieudat.update\",\"qlphieudat.destroy\",\"QLdonhang.index\",\"QLdonhang.create\",\"QLdonhang.store\",\"QLdonhang.show\",\"QLdonhang.edit\",\"QLdonhang.update\",\"QLdonhang.destroy\",\"phuongthucthanhtoan.index\",\"phuongthucthanhtoan.create\",\"phuongthucthanhtoan.store\",\"phuongthucthanhtoan.show\",\"phuongthucthanhtoan.edit\",\"phuongthucthanhtoan.update\",\"phuongthucthanhtoan.destroy\",\"Qlhoadon.index\",\"Qlhoadon.create\",\"Qlhoadon.store\",\"Qlhoadon.show\",\"Qlhoadon.edit\",\"Qlhoadon.update\",\"Qlhoadon.destroy\",\"QLdoitra.index\",\"QLdoitra.create\",\"QLdoitra.store\",\"QLdoitra.show\",\"QLdoitra.edit\",\"QLdoitra.update\",\"QLdoitra.destroy\",\"QLdoitra.create\",\"QLtaikhoan.index\",\"QLtaikhoan.create\",\"QLtaikhoan.store\",\"QLtaikhoan.show\",\"QLtaikhoan.edit\",\"QLtaikhoan.update\",\"QLtaikhoan.destroy\",\"QLquyen.index\",\"QLquyen.create\",\"QLquyen.store\",\"QLquyen.show\",\"QLquyen.edit\",\"QLquyen.update\",\"QLquyen.destroy\",\"QLphanquyen.index\",\"QLphanquyen.create\",\"QLphanquyen.store\",\"QLphanquyen.show\",\"QLphanquyen.edit\",\"QLphanquyen.update\",\"QLphanquyen.destroy\",\"QLbaiviet.index\",\"QLbaiviet.create\",\"QLbaiviet.store\",\"QLbaiviet.show\",\"QLbaiviet.edit\",\"QLbaiviet.update\",\"QLbaiviet.destroy\",\"loadform\",\"xemdonhang\",\"tongsoluong\",\"qlphieudat.xacnhan\",\"QLKhachHang.baocao\",\"QLKhachHang.xemctdonhang\",\"QLKhachHang.donhang\",\"baocaokhachhang\",\"baocaodonhang\",\"QLdonhang.baocao\",\"QLdonhang.thanhtoan\",\"baocaobanhang\",\"QLsanpham.baoCaoSanPham\",\"baocaosanpham\",\"QLchitietkho.baocao\",\"baocaokho\"]', '2025-04-17 08:39:42', '2025-06-08 19:17:39'),
(15, 'QL đơn vị tính', '[\"admin.index\",\"donvitinh.index\",\"donvitinh.create\",\"donvitinh.store\",\"donvitinh.show\",\"donvitinh.edit\",\"donvitinh.update\",\"donvitinh.destroy\"]', '2025-04-17 08:43:03', '2025-04-17 08:43:03'),
(16, 'QLkho', '[\"QLkho.index\",\"QLkho.create\",\"QLkho.store\",\"QLkho.show\",\"QLkho.edit\",\"QLkho.update\",\"QLkho.destroy\"]', '2025-04-21 08:41:41', '2025-04-21 08:41:41'),
(17, 'QLkho2', '[\"admin.index\",\"QLkho.index\",\"QLkho.create\",\"QLkho.store\",\"QLkho.show\",\"QLkho.edit\",\"QLkho.update\",\"QLkho.destroy\"]', '2025-04-21 08:43:30', '2025-04-21 08:43:30'),
(19, 'QLbanhang', '[\"QLthongtinkhachhang.index\",\"QLthongtinkhachhang.index\",\"QLthongtinkhachhang.create\",\"QLthongtinkhachhang.store\",\"QLthongtinkhachhang.show\",\"QLthongtinkhachhang.edit\",\"QLthongtinkhachhang.update\",\"QLthongtinkhachhang.destroy\",\"color.index\",\"color.create\",\"color.store\",\"color.show\",\"color.edit\",\"color.update\",\"color.destroy\",\"donvitinh.index\",\"donvitinh.create\",\"donvitinh.store\",\"donvitinh.show\",\"donvitinh.edit\",\"donvitinh.update\",\"donvitinh.destroy\",\"Baogia.index\",\"Baogia.create\",\"Baogia.store\",\"Baogia.show\",\"Baogia.edit\",\"Baogia.update\",\"Baogia.destroy\",\"QLhopdong.index\",\"QLhopdong.create\",\"QLhopdong.store\",\"QLhopdong.show\",\"QLhopdong.edit\",\"QLhopdong.update\",\"QLhopdong.destroy\",\"MNproduct.index\",\"MNproduct.create\",\"MNproduct.store\",\"MNproduct.show\",\"MNproduct.edit\",\"MNproduct.update\",\"MNproduct.destroy\",\"QLkhuyenmai.index\",\"QLkhuyenmai.create\",\"QLkhuyenmai.store\",\"QLkhuyenmai.show\",\"QLkhuyenmai.edit\",\"QLkhuyenmai.update\",\"QLkhuyenmai.destroy\",\"qlphieudat.index\",\"qlphieudat.create\",\"qlphieudat.store\",\"qlphieudat.show\",\"qlphieudat.edit\",\"qlphieudat.update\",\"qlphieudat.destroy\",\"QLdonhang.index\",\"QLdonhang.create\",\"QLdonhang.store\",\"QLdonhang.show\",\"QLdonhang.edit\",\"QLdonhang.update\",\"QLdonhang.destroy\",\"Qlhoadon.index\",\"Qlhoadon.create\",\"Qlhoadon.store\",\"Qlhoadon.show\",\"Qlhoadon.edit\",\"Qlhoadon.update\",\"Qlhoadon.destroy\",\"QLdoitra.index\",\"QLdoitra.create\",\"QLdoitra.store\",\"QLdoitra.show\",\"QLdoitra.edit\",\"QLdoitra.update\",\"QLdoitra.destroy\",\"QLdoitra.show\",\"QLbaiviet.index\",\"QLbaiviet.create\",\"QLbaiviet.store\",\"QLbaiviet.show\",\"QLbaiviet.edit\",\"QLbaiviet.update\",\"QLbaiviet.destroy\",\"sanphamtheodanhmuc.show\",\"client.thongtinkhachhang.edit\",\"thongtinkhachhang.update\",\"baiviet.index\",\"baiviet.show\",\"phanhoi.store\",\"phanhoi.destroy\",\"dathang.update\"]', '2025-06-01 00:45:54', '2025-06-01 00:45:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenGoi` varchar(255) NOT NULL,
  `MoTa` text NOT NULL,
  `HinhAnh` varchar(255) NOT NULL,
  `idLoaiSanPham` int(10) UNSIGNED NOT NULL,
  `idMau` int(10) UNSIGNED NOT NULL,
  `idDonViTinh` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_phams`
--

INSERT INTO `san_phams` (`id`, `TenGoi`, `MoTa`, `HinhAnh`, `idLoaiSanPham`, `idMau`, `idDonViTinh`, `created_at`, `updated_at`) VALUES
(3, 'H800M#45', 'Sơn bột tĩnh điện Hải Phòng Polyurethane (có ký hiệu P) là loại sơn bột tĩnh điện Polyurethane chịu được hóa chất tốt, chịu được tia tử ngoại, màng sơn không hoá vàng, hoá phấn. Vì vậy các loại sơn này thích hợp cho việc bảo vệ các chi tiết kim loại (sắt, nhôm,...) sử dụng ngoài trời.', '/img/sanpham/1745497308.jpg', 1, 3026, 1, '2025-04-24 05:21:48', '2025-04-24 05:21:48'),
(4, 'H800M#46', 'dsadasa', '/img/sanpham/1746195847.png', 1, 123, 1, '2025-04-24 06:41:58', '2025-05-02 07:24:07'),
(5, 'T106R20-23', 'Tên sản phẩm: T106R20-23\r\n\r\nChủng loại: Sơn ngoài nhà\r\n\r\nMã: \r\n\r\nĐộ bóng: 85 土 5%\r\n\r\nĐộ dày: 60 ÷ 80 µ\r\n\r\nHóa rắn: 200ºC /10\'', '/img/sanpham/1747555560.jpg', 2, 3026, 1, '2025-04-24 06:42:28', '2025-05-18 01:06:00'),
(6, 'T206L18-31', 'Sơn phẳng, bóng, màu lam cho bình Gas\n\nTên sản phẩm: T206L18-31\n\nChủng loại: Sơn ngoài nhà\n\nMã: \n\nĐộ bóng: >80%\n\nĐộ dày: 60 ÷ 80 µ\n\nHóa rắn: 200ºC /10\'', '/img/sanpham/1745502172.jpg', 1, 303, 1, '2025-04-24 06:42:52', '2025-05-18 00:35:04'),
(7, 'B146G03-63', 'Sơn ghi phẳng, mờ cho thang, máng cáp điện\r\nChủng loại: Sơn trong nhà\r\n\r\nMã: M5/170932\r\n\r\nĐộ bóng: 6 土 3%\r\n\r\nĐộ dày: 60 ÷ 80 µ\r\n\r\nHóa rắn: 180ºC /15\'', '/img/sanpham/1747812000.jpg', 7, 326, 1, '2025-05-21 00:20:00', '2025-05-21 00:20:00'),
(8, 'T206W06-03', 'Chủng loại: Sơn ngoài nhà\r\n\r\nMã: \r\n\r\nĐộ bóng: >80%\r\n\r\nĐộ dày: 60 ÷ 80 µ\r\n\r\nHóa rắn: 200ºC /10\'', '/img/sanpham/1747996320.jpg', 1, 603, 1, '2025-05-23 03:32:00', '2025-05-23 03:32:00'),
(9, 'H706H22-06', 'Sơn nhũ phẳng độ bóng cao dùng cho sơn bàn ghế sắt\r\nMã: M10/180150\r\n\r\nĐộ bóng: 85 土 5%\r\nĐộ dày: 60 ÷ 80 µ\r\n\r\nHóa rắn: 180ºC /15\'', '/img/sanpham/1747996543.jpg', 4, 2206, 1, '2025-05-23 03:35:43', '2025-05-23 03:35:43'),
(10, 'T770GK4-09', 'Tên sản phẩm: T770GK4-09\r\nChủng loại: Ngoài nhà\r\n\r\nMã: \r\n\r\nĐộ bóng: \r\nĐộ dày: 60 ÷ 120 µ\r\nHóa rắn: 200ºC /10\'', '/img/sanpham/1748704811.jpg', 5, 409, 1, '2025-05-31 08:20:11', '2025-05-31 08:20:11'),
(11, 'T106V18-34', 'Tên sản phẩm: T106V18-34\r\nChủng loại: Sơn ngoài nhà\r\n\r\nMã: \r\n\r\nĐộ bóng: G > 80%\r\n\r\nĐộ dày: 60 ÷ 80 µ\r\nHóa rắn: 200ºC /10\'', '/img/sanpham/1748705023.jpg', 6, 834, 1, '2025-05-31 08:23:43', '2025-05-31 08:23:43'),
(12, 'H106R10-01', 'Tên sản phẩm: H106R10-01\r\nChủng loại: Sơn trong nhà\r\n\r\nMã: \r\n\r\nĐộ bóng: G > 80%\r\n\r\nĐộ dày: 60 ÷ 80 µ\r\nHóa rắn: 180ºC /15\'', '/img/sanpham/1748705223.jpg', 3, 1001, 2, '2025-05-31 08:27:03', '2025-05-31 08:27:03'),
(13, 'H106C03-03', 'Tên sản phẩm: H106C03-03\r\nChủng loại: Sơn trong nhà dùng\r\nMã: \r\n\r\nĐộ bóng: G > 80%\r\nĐộ dày: 60 ÷ 80 µ\r\nHóa rắn: 180ºC /15\'', '/img/sanpham/1748705281.jpg', 6, 1303, 1, '2025-05-31 08:28:01', '2025-06-08 09:17:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('JOjh2fYXZP03RcWqCuMYKfQ1MUd2tdn9qiW4CYub', 28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibDZwT2NhNmt6cFBLQ2Q5OGl3MENDWEpJbHNHdzZ6NjI4QVB1STlPRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXRoYW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjg7czo3OiJjYXJ0XzI4IjtOO30=', 1749434415),
('Kqf38jgqL1KtOprsDMKuoWWzHzkclTNKjkpH1eJB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY29wMnkxTUtSSDVBTjlFQkUybWpuRXd5eThNTlFuMzVqN0EwRUVEQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90b25nc29ob3Bkb25nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1749436840);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `VaiTro` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `VaiTro`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Huy Du', 'Du@gmail.com', '$2y$12$J2CT2qjz3fozHkWBvkIrK.eEvEmgTqRbm90Gcp5ZTlnaYmM4OFCEG', 'admin', NULL, '2025-04-03 22:34:45', '2025-04-21 07:52:11'),
(7, 'huydu', 's@gmail.com', '$2y$12$W.HEWAyUxhSwOro3aDg4JuvcbfnzuVNhpfyh04CrMJEMQ8zr7eq5y', 'Admin', NULL, '2025-04-21 08:41:10', '2025-04-21 08:41:10'),
(19, 'Quang vinh\r\n', 'vquang2003@gmail.com', '$2y$12$pLMW4FFpA1WHh01ccjfkt.T0SLp6/T9V8wS2WIMDCTbfgynR8ZnTu', 'KhachHang', NULL, '2025-04-25 22:20:25', '2025-04-25 22:20:25'),
(20, 'huy du', 'Du123@gmail.com', '$2y$12$QfM/m5n1Yi812Kwz9XgPcuVhtkws5ETyxlBIigkFcdpxVl.pBrdWC', 'KhachHang', NULL, '2025-04-25 22:27:14', '2025-04-25 22:27:14'),
(22, 'hương', 'huong@gmail.com', '$2y$12$iOddIcxHwrMH1n3ydzyy0urLWqo7QsoVLgxbHdKe55kORjkzfU4Hu', 'Admin', NULL, '2025-05-21 22:51:47', '2025-05-21 22:51:47'),
(23, 'quang vinh', 'vquang2002@gmail.com', '$2y$12$RSXpTADa28k2oZ8xZuwetOSjcmwl.F6wC101Qhopn/yXaWfsfhmA2', 'KhachHang', NULL, '2025-05-23 06:47:02', '2025-05-23 06:47:02'),
(25, 'Hải', 'kk@gmail.com', '$2y$12$EfcwN.WG1oC0MDtu27VRK.CZipfS0raIRYWiAXgI4mWBvv2g8jtqC', 'KhachHang', NULL, '2025-05-27 13:20:37', '2025-05-27 13:20:37'),
(26, 'son123', 'ngocdo@gmail.com', '$2y$12$Jkq/MfNpBLmHXQawovxaT.zx4MTZnPt36BbmCJLrisHtyScw6FyfW', 'KhachHang', NULL, '2025-05-28 11:29:02', '2025-05-28 11:29:02'),
(27, 'son', 'son@gmail.com', '$2y$12$JyJWUn5MtQdP9cQ2ujRct.lPkVwfcto2kq.QuLcv05miGxKkmHyCK', 'KhachHang', NULL, '2025-06-02 23:58:21', '2025-06-02 23:58:21'),
(28, 'test', 'test@gmail.com', '$2y$12$plEShiO3/8f6wrx9c1cDZ.ifzElpwq0FtxeKTcmWBnpkeeXRW1mIm', 'KhachHang', NULL, '2025-06-05 10:39:07', '2025-06-05 10:39:07'),
(29, 'Đào Thị Hạnh', 'Hanh@gmail.com', '$2y$12$KPZac.JeaTtjH6Y3A5Uk0Ojs3gy/qJNTA5fnETXque7kPNkRVxhEq', 'KhachHang', NULL, '2025-06-07 08:08:10', '2025-06-07 08:08:10'),
(30, 'tester', 'tester@gmail.com', '$2y$12$oB7xiwhOliPBdnHu7SUZyuTXr7./3UvCRKoQFK3hotol4gXT3KFW.', 'KhachHang', NULL, '2025-06-08 08:49:16', '2025-06-08 10:48:12');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bai_viets`
--
ALTER TABLE `bai_viets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bang_gia`
--
ALTER TABLE `bang_gia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bang_gia_idsanpham_foreign` (`idSanPham`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `chi_tiet_khos`
--
ALTER TABLE `chi_tiet_khos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKho` (`idKho`),
  ADD KEY `idSanPham` (`idSanPham`);

--
-- Chỉ mục cho bảng `chi_tiet_phieu_chuyen_khos`
--
ALTER TABLE `chi_tiet_phieu_chuyen_khos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_phieu_chuyen_khos_idphieuchuyenkho_foreign` (`idPhieuChuyenKho`),
  ADD KEY `chi_tiet_phieu_chuyen_khos_idsanpham_foreign` (`idSanPham`);

--
-- Chỉ mục cho bảng `chi_tiet_phieu_dat_hang`
--
ALTER TABLE `chi_tiet_phieu_dat_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_phieu_dat_hang_idphieudat_foreign` (`idPhieuDat`),
  ADD KEY `chi_tiet_phieu_dat_hang_idsanpham_foreign` (`idSanPham`);

--
-- Chỉ mục cho bảng `chi_tiet_phieu_kiem_kes`
--
ALTER TABLE `chi_tiet_phieu_kiem_kes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_phieu_kiem_kes_idphieukiemke_foreign` (`idPhieuKiemKe`),
  ADD KEY `chi_tiet_phieu_kiem_kes_idsanpham_foreign` (`idSanPham`);

--
-- Chỉ mục cho bảng `chi_tiet_phieu_nhaps`
--
ALTER TABLE `chi_tiet_phieu_nhaps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_phieu_nhaps_idphieunhap_foreign` (`idPhieuNhap`),
  ADD KEY `chi_tiet_phieu_nhaps_idsanpham_foreign` (`idSanPham`);

--
-- Chỉ mục cho bảng `chi_tiet_xuat_khos`
--
ALTER TABLE `chi_tiet_xuat_khos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_xuat_khos_id_phieu_xuat_kho_index` (`id_phieu_xuat_kho`),
  ADD KEY `chi_tiet_xuat_khos_id_san_pham_index` (`id_san_pham`),
  ADD KEY `id_kho` (`id_kho`);

--
-- Chỉ mục cho bảng `ct_phieu_doi_tra`
--
ALTER TABLE `ct_phieu_doi_tra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ct_phieu_doi_tra_idphieudoitra_foreign` (`idPhieuDoiTra`),
  ADD KEY `ct_phieu_doi_tra_iddonhang_foreign` (`idDonHang`),
  ADD KEY `ct_phieu_doi_tra_idsanpham_foreign` (`idSanPham`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `don_hang_idhopdong_foreign` (`idHopDong`);

--
-- Chỉ mục cho bảng `don_vi_tinh`
--
ALTER TABLE `don_vi_tinh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoa_don_idhopdong_foreign` (`idHopDong`);

--
-- Chỉ mục cho bảng `hop_dong`
--
ALTER TABLE `hop_dong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hop_dong_idphieudat_foreign` (`idPhieuDat`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khach_hang_idloaikhachhang_foreign` (`idLoaiKhachHang`),
  ADD KEY `khach_hang_idtaikhoan_foreign` (`idTaiKhoan`);

--
-- Chỉ mục cho bảng `khos`
--
ALTER TABLE `khos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khos_tenkho_unique` (`TenKho`);

--
-- Chỉ mục cho bảng `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khuyen_mais_tenkhuyenmai_unique` (`TenKhuyenMai`),
  ADD KEY `khuyen_mais_idloaikhachhang_foreign` (`idLoaiKhachHang`);

--
-- Chỉ mục cho bảng `loai_khach_hangs`
--
ALTER TABLE `loai_khach_hangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loai_khach_hangs_tenloaikhachhang_unique` (`TenLoaiKhachHang`);

--
-- Chỉ mục cho bảng `loai_san_phams`
--
ALTER TABLE `loai_san_phams`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `maus`
--
ALTER TABLE `maus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `phan_hoi_khach_hang`
--
ALTER TABLE `phan_hoi_khach_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phan_hoi_khach_hang_idkhachhang_foreign` (`idKhachHang`),
  ADD KEY `phan_hoi_khach_hang_idsanpham_foreign` (`idSanPham`);

--
-- Chỉ mục cho bảng `phan_quyen`
--
ALTER TABLE `phan_quyen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phan_quyen_idquyen_foreign` (`idQuyen`),
  ADD KEY `fk_phanquyen_idTaiKhoan` (`idTaiKhoan`);

--
-- Chỉ mục cho bảng `phieu_chuyen_khos`
--
ALTER TABLE `phieu_chuyen_khos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phieu_chuyen_khos_idkhochuyen_foreign` (`idKhoChuyen`),
  ADD KEY `phieu_chuyen_khos_idkhonhan_foreign` (`idKhoNhan`);

--
-- Chỉ mục cho bảng `phieu_dat_hang`
--
ALTER TABLE `phieu_dat_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phieu_dat_hang_idphuongthuc_foreign` (`idPhuongThuc`),
  ADD KEY `phieu_dat_hang_idkhuyenmai_foreign` (`idKhuyenMai`);

--
-- Chỉ mục cho bảng `phieu_doi_tra`
--
ALTER TABLE `phieu_doi_tra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phieu_doi_tra_idkhachhang_foreign` (`idKhachHang`);

--
-- Chỉ mục cho bảng `phieu_kiem_kes`
--
ALTER TABLE `phieu_kiem_kes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phieu_kiem_kes_idkho_foreign` (`idKho`);

--
-- Chỉ mục cho bảng `phieu_nhap_khos`
--
ALTER TABLE `phieu_nhap_khos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phieu_nhap_khos_idkho_foreign` (`idKho`);

--
-- Chỉ mục cho bảng `phieu_xuat_khos`
--
ALTER TABLE `phieu_xuat_khos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phuong_thuc_thanh_toan`
--
ALTER TABLE `phuong_thuc_thanh_toan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `quyens`
--
ALTER TABLE `quyens`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_phams_idloaisanpham_foreign` (`idLoaiSanPham`),
  ADD KEY `san_phams_idmau_foreign` (`idMau`),
  ADD KEY `san_phams_iddonvitinh_foreign` (`idDonViTinh`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bai_viets`
--
ALTER TABLE `bai_viets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `bang_gia`
--
ALTER TABLE `bang_gia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_khos`
--
ALTER TABLE `chi_tiet_khos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_phieu_chuyen_khos`
--
ALTER TABLE `chi_tiet_phieu_chuyen_khos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_phieu_dat_hang`
--
ALTER TABLE `chi_tiet_phieu_dat_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_phieu_kiem_kes`
--
ALTER TABLE `chi_tiet_phieu_kiem_kes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_phieu_nhaps`
--
ALTER TABLE `chi_tiet_phieu_nhaps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_xuat_khos`
--
ALTER TABLE `chi_tiet_xuat_khos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `ct_phieu_doi_tra`
--
ALTER TABLE `ct_phieu_doi_tra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `don_vi_tinh`
--
ALTER TABLE `don_vi_tinh`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `hop_dong`
--
ALTER TABLE `hop_dong`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `khos`
--
ALTER TABLE `khos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;

--
-- AUTO_INCREMENT cho bảng `loai_khach_hangs`
--
ALTER TABLE `loai_khach_hangs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `loai_san_phams`
--
ALTER TABLE `loai_san_phams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3027;

--
-- AUTO_INCREMENT cho bảng `maus`
--
ALTER TABLE `maus`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5327;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `phan_hoi_khach_hang`
--
ALTER TABLE `phan_hoi_khach_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `phan_quyen`
--
ALTER TABLE `phan_quyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `phieu_chuyen_khos`
--
ALTER TABLE `phieu_chuyen_khos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `phieu_dat_hang`
--
ALTER TABLE `phieu_dat_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `phieu_doi_tra`
--
ALTER TABLE `phieu_doi_tra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `phieu_kiem_kes`
--
ALTER TABLE `phieu_kiem_kes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `phieu_nhap_khos`
--
ALTER TABLE `phieu_nhap_khos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `phieu_xuat_khos`
--
ALTER TABLE `phieu_xuat_khos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `phuong_thuc_thanh_toan`
--
ALTER TABLE `phuong_thuc_thanh_toan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `quyens`
--
ALTER TABLE `quyens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bang_gia`
--
ALTER TABLE `bang_gia`
  ADD CONSTRAINT `bang_gia_idsanpham_foreign` FOREIGN KEY (`idSanPham`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chi_tiet_khos`
--
ALTER TABLE `chi_tiet_khos`
  ADD CONSTRAINT `chi_tiet_khos_ibfk_1` FOREIGN KEY (`idKho`) REFERENCES `khos` (`id`),
  ADD CONSTRAINT `chi_tiet_khos_ibfk_2` FOREIGN KEY (`idSanPham`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `chi_tiet_phieu_chuyen_khos`
--
ALTER TABLE `chi_tiet_phieu_chuyen_khos`
  ADD CONSTRAINT `chi_tiet_phieu_chuyen_khos_idphieuchuyenkho_foreign` FOREIGN KEY (`idPhieuChuyenKho`) REFERENCES `phieu_chuyen_khos` (`id`),
  ADD CONSTRAINT `chi_tiet_phieu_chuyen_khos_idsanpham_foreign` FOREIGN KEY (`idSanPham`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `chi_tiet_phieu_dat_hang`
--
ALTER TABLE `chi_tiet_phieu_dat_hang`
  ADD CONSTRAINT `chi_tiet_phieu_dat_hang_idphieudat_foreign` FOREIGN KEY (`idPhieuDat`) REFERENCES `phieu_dat_hang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_phieu_dat_hang_idsanpham_foreign` FOREIGN KEY (`idSanPham`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chi_tiet_phieu_kiem_kes`
--
ALTER TABLE `chi_tiet_phieu_kiem_kes`
  ADD CONSTRAINT `chi_tiet_phieu_kiem_kes_idphieukiemke_foreign` FOREIGN KEY (`idPhieuKiemKe`) REFERENCES `phieu_kiem_kes` (`id`),
  ADD CONSTRAINT `chi_tiet_phieu_kiem_kes_idsanpham_foreign` FOREIGN KEY (`idSanPham`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `chi_tiet_phieu_nhaps`
--
ALTER TABLE `chi_tiet_phieu_nhaps`
  ADD CONSTRAINT `chi_tiet_phieu_nhaps_idphieunhap_foreign` FOREIGN KEY (`idPhieuNhap`) REFERENCES `phieu_nhap_khos` (`id`),
  ADD CONSTRAINT `chi_tiet_phieu_nhaps_idsanpham_foreign` FOREIGN KEY (`idSanPham`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `chi_tiet_xuat_khos`
--
ALTER TABLE `chi_tiet_xuat_khos`
  ADD CONSTRAINT `chi_tiet_xuat_khos_ibfk_1` FOREIGN KEY (`id_kho`) REFERENCES `khos` (`id`),
  ADD CONSTRAINT `chi_tiet_xuat_khos_id_phieu_xuat_kho_foreign` FOREIGN KEY (`id_phieu_xuat_kho`) REFERENCES `phieu_xuat_khos` (`id`),
  ADD CONSTRAINT `chi_tiet_xuat_khos_id_san_pham_foreign` FOREIGN KEY (`id_san_pham`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `ct_phieu_doi_tra`
--
ALTER TABLE `ct_phieu_doi_tra`
  ADD CONSTRAINT `ct_phieu_doi_tra_iddonhang_foreign` FOREIGN KEY (`idDonHang`) REFERENCES `don_hang` (`id`),
  ADD CONSTRAINT `ct_phieu_doi_tra_idphieudoitra_foreign` FOREIGN KEY (`idPhieuDoiTra`) REFERENCES `phieu_doi_tra` (`id`),
  ADD CONSTRAINT `ct_phieu_doi_tra_idsanpham_foreign` FOREIGN KEY (`idSanPham`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_idhopdong_foreign` FOREIGN KEY (`idHopDong`) REFERENCES `hop_dong` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `hoa_don_idhopdong_foreign` FOREIGN KEY (`idHopDong`) REFERENCES `hop_dong` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hop_dong`
--
ALTER TABLE `hop_dong`
  ADD CONSTRAINT `hop_dong_idphieudat_foreign` FOREIGN KEY (`idPhieuDat`) REFERENCES `phieu_dat_hang` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD CONSTRAINT `khach_hang_idloaikhachhang_foreign` FOREIGN KEY (`idLoaiKhachHang`) REFERENCES `loai_khach_hangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `khach_hang_idtaikhoan_foreign` FOREIGN KEY (`idTaiKhoan`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  ADD CONSTRAINT `khuyen_mais_idloaikhachhang_foreign` FOREIGN KEY (`idLoaiKhachHang`) REFERENCES `loai_khach_hangs` (`id`);

--
-- Các ràng buộc cho bảng `phan_hoi_khach_hang`
--
ALTER TABLE `phan_hoi_khach_hang`
  ADD CONSTRAINT `phan_hoi_khach_hang_idkhachhang_foreign` FOREIGN KEY (`idKhachHang`) REFERENCES `khach_hang` (`id`),
  ADD CONSTRAINT `phan_hoi_khach_hang_idsanpham_foreign` FOREIGN KEY (`idSanPham`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `phan_quyen`
--
ALTER TABLE `phan_quyen`
  ADD CONSTRAINT `fk_phanquyen_idTaiKhoan` FOREIGN KEY (`idTaiKhoan`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_phanquyen_idquyen` FOREIGN KEY (`idQuyen`) REFERENCES `quyens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phieu_chuyen_khos`
--
ALTER TABLE `phieu_chuyen_khos`
  ADD CONSTRAINT `phieu_chuyen_khos_idkhochuyen_foreign` FOREIGN KEY (`idKhoChuyen`) REFERENCES `khos` (`id`),
  ADD CONSTRAINT `phieu_chuyen_khos_idkhonhan_foreign` FOREIGN KEY (`idKhoNhan`) REFERENCES `khos` (`id`);

--
-- Các ràng buộc cho bảng `phieu_dat_hang`
--
ALTER TABLE `phieu_dat_hang`
  ADD CONSTRAINT `phieu_dat_hang_idkhuyenmai_foreign` FOREIGN KEY (`idKhuyenMai`) REFERENCES `khuyen_mais` (`id`),
  ADD CONSTRAINT `phieu_dat_hang_idphuongthuc_foreign` FOREIGN KEY (`idPhuongThuc`) REFERENCES `phuong_thuc_thanh_toan` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phieu_doi_tra`
--
ALTER TABLE `phieu_doi_tra`
  ADD CONSTRAINT `phieu_doi_tra_idkhachhang_foreign` FOREIGN KEY (`idKhachHang`) REFERENCES `khach_hang` (`id`);

--
-- Các ràng buộc cho bảng `phieu_kiem_kes`
--
ALTER TABLE `phieu_kiem_kes`
  ADD CONSTRAINT `phieu_kiem_kes_idkho_foreign` FOREIGN KEY (`idKho`) REFERENCES `khos` (`id`);

--
-- Các ràng buộc cho bảng `phieu_nhap_khos`
--
ALTER TABLE `phieu_nhap_khos`
  ADD CONSTRAINT `phieu_nhap_khos_idkho_foreign` FOREIGN KEY (`idKho`) REFERENCES `khos` (`id`);

--
-- Các ràng buộc cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  ADD CONSTRAINT `san_phams_iddonvitinh_foreign` FOREIGN KEY (`idDonViTinh`) REFERENCES `don_vi_tinh` (`id`),
  ADD CONSTRAINT `san_phams_idloaisanpham_foreign` FOREIGN KEY (`idLoaiSanPham`) REFERENCES `loai_san_phams` (`id`),
  ADD CONSTRAINT `san_phams_idmau_foreign` FOREIGN KEY (`idMau`) REFERENCES `maus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
