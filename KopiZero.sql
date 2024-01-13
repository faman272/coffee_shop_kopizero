-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table kopi_zero.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id_menu` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` tinyint NOT NULL,
  `H_Hot` decimal(10,2) NOT NULL,
  `H_Ice` decimal(10,2) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `menus_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `menus_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kopi_zero.menus: ~12 rows (approximately)
INSERT INTO `menus` (`id_menu`, `nama_menu`, `kategori_id`, `H_Hot`, `H_Ice`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
	(1, 'Americano', 1, 10000.00, 12000.00, 'Minuman kopi hitam yang terbuat dari satu atau dua shot espresso dicampur dengan air panas.', 'image/menu-img.png', NULL, NULL),
	(2, 'Espresso', 1, 10000.00, 0.00, 'Minuman kopi pekat yang dihasilkan dengan mengekstrak air panas melalui bubuk kopi.', 'image/menu-img.png', NULL, NULL),
	(3, 'Badak Susu', 2, 0.00, 12000.00, 'Minuman soda dengan tambahan susu dan es.', 'image/menu-img.png', NULL, NULL),
	(4, 'Kopi Sanger', 1, 12000.00, 15000.00, 'Minuman kopi unik dengan tambahan jahe, gula merah, dan santan.', 'image/menu-img.png', NULL, NULL),
	(5, 'Teh Hijau', 2, 6000.00, 7000.00, 'Minuman teh yang terbuat dari daun teh hijau, memberikan rasa segar dan kaya akan antioksidan.', 'image/menu-img.png', NULL, NULL),
	(6, 'Kopi Latte', 1, 13000.00, 15000.00, 'Minuman kopi yang terbuat dari espresso dicampur dengan susu steamed dan foam susu.', 'image/menu-img.png', NULL, NULL),
	(7, 'Lemon Tea', 2, 10000.00, 12000.00, 'Minuman teh segar dengan tambahan sari lemon, memberikan rasa segar dan nikmat.', 'image/menu-img.png', NULL, NULL),
	(8, 'Kopi Zero', 1, 13000.00, 15000.00, 'Minuman kopi tanpa tambahan gula atau pemanis, memberikan rasa kopi murni.', 'image/menu-img.png', NULL, NULL),
	(9, 'Cokelat Milk', 2, 10000.00, 12000.00, 'Minuman susu cokelat hangat maupun dingin yang lezat.', 'image/menu-img.png', NULL, NULL),
	(10, 'Tubruk', 1, 10000.00, 12000.00, 'Minuman kopi khas Indonesia dengan cara menyeduh kopi bubuk dan gula aren langsung di dalam gelas.', 'image/menu-img.png', NULL, NULL),
	(11, 'Matcha Milk', 2, 10000.00, 12000.00, 'Minuman susu dengan tambahan bubuk matcha, memberikan kombinasi unik rasa teh hijau dan kelembutan susu.\r\n', 'image/menu-img.png', NULL, NULL),
	(12, 'Teh Manis', 2, 6000.00, 7000.00, 'Minuman teh dengan tambahan gula, memberikan rasa manis yang nikmat.', 'image/menu-img.png', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
