-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.27-0ubuntu0.21.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table IoT_Agri.plants: ~5 rows (approximately)
/*!40000 ALTER TABLE `plants` DISABLE KEYS */;
REPLACE INTO `plants` (`id`, `name`, `plant_type_id`, `growth_period`, `planting_time`, `plant_density`, `width_bed`, `height_bed`, `row_spacing`, `tree_spacing`, `soil_type_id`, `info`, `created_at`, `created_user`, `updated_at`, `updated_user`) VALUES
	(1, 'Khoai tây', 3, '105 - 145 ngày', 'Gieo trồng thích hợp từ tháng 10 - 11. tháng 1, 2 cho thu hoạch.', '850 - 1100 củ/ ha', '17-20 cm', '7-10 cm', '20 - 25 cm', '17-20cm', 3, 'Thông tin tham khảo.\nCó thể trồng với lượng củ cao hơn tùy thuộc vào tập quán từng vùng và loại củ giống.', '2021-08-07 00:08:47', 'hopdt1404@gmail.com', '2021-11-24 16:08:43', 'hopdt1404@gmail.com'),
	(2, 'Ngô ngọt', 1, '65 - 85 ngày', 'Cây có thể trồng quanh năm - thích ứng rộng với thời tiết', '1500 - 1600 cây / sào bắc bộ ( ~ 0.2 kg hạt giống)', '30 - 35 cm', '10-15 cm', '40 cm', '30 - 35 cm', 4, 'Là cây chịu hạn, chịu úng kém hơn các giống ngô khác, phải bón phân, tưới nước đầy đủ và đúng thời kỳ, không được để trong ruộng bị úng nước.', '2021-10-31 23:38:41', 'hopdt1404@gmail.com', '2021-11-24 16:08:07', 'hopdt1404@gmail.com'),
	(3, 'Cà tím', 3, '60 - 80 ngày', 'Cây trồng quanh năm. Tránh những tháng rét (11, 12, 1)', '2500 - 3500 cây /sào bắc bộ', '40 cm', '7 - 10 cm', '50 - 70 cm', '50 cm', 4, 'Cà tím là loại cây cho năng suất cao và rất mau thu hoạch chỉ trong vòng khoảng 2 tháng', '2021-10-31 23:44:58', 'hopdt1404@gmail.com', '2021-11-24 16:09:00', 'hopdt1404@gmail.com'),
	(4, 'Đậu nành', 1, '110 - 130 ngày', 'Có thể trồng \nVụ đông xuân: tháng 11-12 dương lịch hàng năm và thu hoạch vào tháng 2-3 dương lịch\nVụ xuân hè: tháng 2 -3 dương lịch và thu hoạch vào tháng 5-6 dương lịch.\nVụ hè thu: tháng 4-5 dương dịch và thu hoạch vào tháng 7-8 dương lịch', 'khoảng 2.0 - 2,2 kg hạt / sào bắc bộ (3600 - 4000)', '25 - 30 cm', '7 - 10 cm', '40 - 45 cm', '15 -20 cm', 3, 'Cây đậu tương là cây thực phẩm có hiệu quả kinh tế lại dễ trồng. Sản phẩm từ cây đậu tương được sử dụng rất đa dạng như dùng trực tiếp hạt thô hoặc chế biến thành đậu phụ, ép thành dầu đậu nành, nước tương, làm bánh kẹo, sữa đậu nành, okara… đáp ứng nhu cầu đạm trong khẩu phần ăn hàng ngày của người cũng như gia súc', '2021-10-31 23:58:13', 'hopdt1404@gmail.com', '2021-11-24 16:09:04', 'hopdt1404@gmail.com'),
	(5, 'Dưa leo', 3, '105 - 130', 'Các tỉnh phía Bắc:\n+ Vụ xuân: 20/02 - 15/03,\n+ Vụ thu đông: 10/09 - 10/10\n\nCác tỉnh Nam Bộ\n+ Vụ đông: 25/10 - 25/12\n+ Vụ xuân: 20/01 - 25/02\n\nCác tỉnh Tây nguyên\n+ Vụ đông: 25/10 - 25/12\n+ Vụ xuân hè: 25/01 - 30/02', '3800 cây / sào bắc bộ', '60 cm', '10 cm', '60 cm', '30 cm', 2, 'Không nên trồng dưa chuột ở những vùng có mưa kéo dài, những vùng có nhiệt độ thấp (nhiệt độ dưới 15,5oC), thay đổi thất thường, chênh lệch nhiệt độ ngày và đêm quá lớn, nhiệt độ thích hợp từ 15,5oC đến 35oC\nDưa chuột thích hợp với đất có thành phần cơ giới nhẹ như cát pha, đất thịt nhẹ, thoát nước tốt, không quá phèn, mặn. Chọn đất vụ trước không trồng họ bầu bí là tốt nhất.', '2021-11-01 19:56:16', 'hopdt1404@gmail.com', '2021-11-24 16:09:07', 'hopdt1404@gmail.com');
/*!40000 ALTER TABLE `plants` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
