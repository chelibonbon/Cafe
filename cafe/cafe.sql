-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 02:42 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `harga_satuan` int(50) NOT NULL,
  `harga_mentah` int(100) DEFAULT NULL,
  `stok` enum('Tersedia','Tidak tersedia') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `deskripsi`, `kategori`, `harga_satuan`, `harga_mentah`, `stok`, `foto`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(34, 'BR01', 'Grilled Cheese Sandwich', 'Roti sourdough isi keju mozzarella dan cheddar yang dipanggang hingga renyah.', '2', 13000, 7000, 'Tersedia', '1744947898_The-Ultimate-Grilled-Cheese_EXPS_TOHD24_11861_AlejandroMonfort_5.jpg', NULL, '2025-04-17 22:44:58', NULL, NULL, 'Chelsica\r\n', NULL, NULL),
(35, 'BR02', 'Caesar Salad', 'Selada Romaine segar, crouton, keju parmesan, dan saus Caesar creamy.', '2', 20000, 13000, 'Tidak tersedia', '1744947996_images.jpeg', NULL, '2025-04-17 22:46:36', '2025-04-17 22:48:45', NULL, 'Chelsica\r\n', 'Chelsica\r\n', NULL),
(36, 'BR03', 'Truffle Fries', 'Kentang goreng renyah dengan minyak truffle dan parutan keju parmesan.', '2', 12000, 8000, 'Tersedia', '1744948044_easy-homemade-truffle-fries-recipe-1375725-hero-02-a9d4ccb2e72544469c044f6ddd728bf3.jpg', NULL, '2025-04-17 22:47:24', '2025-04-17 22:48:36', NULL, 'Chelsica\r\n', 'Chelsica\r\n', NULL),
(37, 'BR04', 'Chocolate Lava Cake', 'Kue coklat hangat dengan lelehan coklat di dalam, disajikan dengan es krim vanila.', '4', 23000, 15000, 'Tersedia', '1744948188_updated-lava-cakes7.webp', NULL, '2025-04-17 22:49:48', NULL, NULL, 'Chelsica\r\n', NULL, NULL),
(38, 'BR05', 'Berry Cheesecake', 'Cheesecake lembut dengan topping saus berry segar.', '4', 22000, 12000, 'Tersedia', '1744948241_plated-blueberry-cheesecake-hero.jpg', NULL, '2025-04-17 22:50:41', NULL, NULL, 'Chelsica\r\n', NULL, NULL),
(39, 'BR06', ' Caramel Macchiato', 'Espresso dengan susu steamed dan sirup karamel, disajikan panas atau dingin.', '6', 25000, 14000, 'Tersedia', '1744948380_images (1).jpeg', NULL, '2025-04-17 22:53:00', '2025-04-17 22:56:25', NULL, 'Chelsica\r\n', 'Chelsica\r\n', NULL),
(40, 'BR07', 'starfruit', 'minuman dengan banyak warna dan rasa', '6', 23000, 16000, 'Tersedia', '1744948775_Capture.JPG', NULL, '2025-04-17 22:59:35', NULL, NULL, 'Chelsica\r\n', NULL, NULL),
(41, 'BR08', 'spider donut', 'donut berkualitas laba laba', '4', 32000, 18000, 'Tersedia', '1744948853_eeeee.JPG', NULL, '2025-04-17 23:00:53', NULL, NULL, 'Chelsica\r\n', NULL, NULL),
(42, 'BR09', 'cold lazy drink', 'minuman dingin', '6', 2000, 1000, 'Tidak tersedia', '1744948941_sanssss.JPG', NULL, '2025-04-17 23:02:21', NULL, NULL, 'Chelsica\r\n', NULL, NULL),
(43, 'BR10', 'butterscotch cinnamon pie', 'pie dibuat dari cinta', '4', 12000, 4000, 'Tersedia', '1744949008_Capture.JPG', NULL, '2025-04-17 23:03:28', NULL, NULL, 'Chelsica\r\n', NULL, NULL),
(45, 'BR07', 'cookies', 'makanan ringan adonan lezat', '7', 13000, 8000, '', '1745074933_th.jpeg', NULL, '2025-04-19 22:02:13', '2025-04-19 10:02:24', NULL, 'sim', 'sim', NULL),
(46, 'BR09', 'cheesecake merah', 'cheesecake lembut', '8', 18000, 9000, 'Tersedia', '1745075777_th (1).jpeg', NULL, '2025-04-19 22:16:17', NULL, NULL, 'sim', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(50) NOT NULL,
  `id_user` int(50) NOT NULL,
  `nama_kasir` varchar(255) NOT NULL,
  `nik` int(50) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `id_user`, `nama_kasir`, `nik`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(18, 5, 'sim', 29872, NULL, '2025-04-17 19:19:44', '2025-04-17 19:20:29', NULL, 'Chelsica\r\n', 'Chelsica\r\n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(15) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `status` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(2, 'makanan', NULL, '2025-04-17 21:01:37', '2025-04-17 21:09:10', NULL, 'Chelsica\r\n', 'Chelsica\r\n', NULL),
(4, 'dessert', NULL, '2025-04-17 21:01:50', '2025-04-17 21:09:15', NULL, 'Chelsica\r\n', 'Chelsica\r\n', NULL),
(6, 'minuman', NULL, '2025-04-17 22:53:13', NULL, NULL, 'Chelsica\r\n', NULL, NULL),
(8, 'pie', NULL, '2025-04-19 10:15:01', '2025-04-19 10:15:16', NULL, 'sim', 'sim', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `activity` text NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id`, `waktu`, `date`, `nama_user`, `username`, `activity`, `ip_address`) VALUES
(317, '2025-04-19 13:52:54', '2025-04-19', 'fei', 'guest', 'fei logged out', '180.242.195.130'),
(318, '2025-04-19 13:53:32', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n successfully logged in', '180.242.195.130'),
(319, '2025-04-19 13:53:33', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(320, '2025-04-19 14:08:17', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n logged out', '180.242.195.130'),
(321, '2025-04-19 14:15:11', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n successfully logged in', '180.242.195.130'),
(322, '2025-04-19 14:15:12', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(323, '2025-04-19 14:15:15', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(324, '2025-04-19 14:19:38', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n visited log activity', '180.242.195.130'),
(325, '2025-04-19 14:19:46', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n logged out', '180.242.195.130'),
(326, '2025-04-19 14:22:36', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi successfully logged in', '180.242.195.130'),
(327, '2025-04-19 14:22:37', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(328, '2025-04-19 14:23:50', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi visited log activity', '180.242.195.130'),
(329, '2025-04-19 14:23:55', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi logged out', '180.242.195.130'),
(330, '2025-04-19 14:24:07', '2025-04-19', 'sim', 'sim@e', 'sim successfully logged in', '180.242.195.130'),
(331, '2025-04-19 14:24:08', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(332, '2025-04-19 14:24:32', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(333, '2025-04-19 14:29:51', '2025-04-19', 'sim', 'sim@e', 'sim visited log activity', '180.242.195.130'),
(334, '2025-04-19 14:29:54', '2025-04-19', 'sim', 'sim@e', 'sim logged out', '180.242.195.130'),
(335, '2025-04-19 14:30:04', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe successfully logged in', '180.242.195.130'),
(336, '2025-04-19 14:30:05', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(337, '2025-04-19 14:31:11', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(338, '2025-04-19 14:31:14', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(339, '2025-04-19 14:31:28', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(340, '2025-04-19 14:31:37', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(341, '2025-04-19 14:31:57', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe visited log activity', '180.242.195.130'),
(342, '2025-04-19 14:32:03', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe logged out', '180.242.195.130'),
(343, '2025-04-19 14:56:37', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe successfully logged in', '180.242.195.130'),
(344, '2025-04-19 14:56:37', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(345, '2025-04-19 14:59:38', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe logged out', '180.242.195.130'),
(346, '2025-04-19 15:00:29', '2025-04-19', 'sim', 'sim@e', 'sim successfully logged in', '180.242.195.130'),
(347, '2025-04-19 15:00:29', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(348, '2025-04-19 15:00:52', '2025-04-19', 'sim', 'sim@e', 'sim successfully added to kategori', '180.242.195.130'),
(349, '2025-04-19 15:00:57', '2025-04-19', 'sim', 'sim@e', 'sim edit to kategori', '180.242.195.130'),
(350, '2025-04-19 15:01:02', '2025-04-19', 'sim', 'sim@e', 'sim edit to kategori', '180.242.195.130'),
(351, '2025-04-19 15:01:17', '2025-04-19', 'sim', 'sim@e', 'sim deleted kategori with ID \'6\'', '180.242.195.130'),
(352, '2025-04-19 15:02:13', '2025-04-19', 'sim', 'sim@e', 'sim successfully added \'cookies\' to barang', '180.242.195.130'),
(353, '2025-04-19 15:02:19', '2025-04-19', 'sim', 'sim@e', 'sim edit \'cookiess\' to barang', '180.242.195.130'),
(354, '2025-04-19 15:02:33', '2025-04-19', 'sim', 'sim@e', 'sim edit \'cookies\' to barang', '180.242.195.130'),
(355, '2025-04-19 15:02:46', '2025-04-19', 'sim', 'sim@e', 'sim logged out', '180.242.195.130'),
(356, '2025-04-19 15:03:03', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe successfully logged in', '180.242.195.130'),
(357, '2025-04-19 15:03:04', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(358, '2025-04-19 15:05:00', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(359, '2025-04-19 15:05:30', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe visited log activity', '180.242.195.130'),
(360, '2025-04-19 15:05:41', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe logged out', '180.242.195.130'),
(361, '2025-04-19 15:05:59', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe successfully logged in', '180.242.195.130'),
(362, '2025-04-19 15:06:00', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(363, '2025-04-19 15:07:20', '2025-04-19', 'sim', 'sim@e', 'sim successfully logged in', '180.242.195.130'),
(364, '2025-04-19 15:07:21', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(365, '2025-04-19 15:08:40', '2025-04-19', 'sim', 'sim@e', 'sim logged out', '180.242.195.130'),
(366, '2025-04-19 15:09:04', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi successfully logged in', '180.242.195.130'),
(367, '2025-04-19 15:09:04', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(368, '2025-04-19 15:09:44', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi logged out', '180.242.195.130'),
(369, '2025-04-19 15:11:46', '2025-04-19', 'sim', 'sim@e', 'sim successfully logged in', '180.242.195.130'),
(370, '2025-04-19 15:11:47', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(371, '2025-04-19 15:12:49', '2025-04-19', 'sim', 'sim@e', 'sim logged out', '180.242.195.130'),
(372, '2025-04-19 15:14:41', '2025-04-19', 'sim', 'sim@e', 'sim successfully logged in', '180.242.195.130'),
(373, '2025-04-19 15:14:41', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(374, '2025-04-19 15:15:02', '2025-04-19', 'sim', 'sim@e', 'sim successfully added to kategori', '180.242.195.130'),
(375, '2025-04-19 15:15:11', '2025-04-19', 'sim', 'sim@e', 'sim edit to kategori', '180.242.195.130'),
(376, '2025-04-19 15:15:16', '2025-04-19', 'sim', 'sim@e', 'sim edit to kategori', '180.242.195.130'),
(377, '2025-04-19 15:15:29', '2025-04-19', 'sim', 'sim@e', 'sim deleted kategori with ID \'7\'', '180.242.195.130'),
(378, '2025-04-19 15:16:17', '2025-04-19', 'sim', 'sim@e', 'sim successfully added \'cheesecake merah\' to barang', '180.242.195.130'),
(379, '2025-04-19 15:16:34', '2025-04-19', 'sim', 'sim@e', 'sim logged out', '180.242.195.130'),
(380, '2025-04-19 15:16:57', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe successfully logged in', '180.242.195.130'),
(381, '2025-04-19 15:16:57', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(382, '2025-04-19 15:18:20', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(383, '2025-04-19 15:18:48', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(384, '2025-04-19 15:18:53', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe visited log activity', '180.242.195.130'),
(385, '2025-04-19 15:18:59', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe logged out', '180.242.195.130'),
(386, '2025-04-19 15:19:16', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe successfully logged in', '180.242.195.130'),
(387, '2025-04-19 15:19:17', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(388, '2025-04-19 15:20:38', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe successfully logged in', '180.242.195.130'),
(389, '2025-04-19 15:20:38', '2025-04-19', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(390, '2025-04-19 15:21:47', '2025-04-19', 'Chloe', 'Chloe@e', 'Failed login attempt', '180.242.195.130'),
(391, '2025-04-19 15:22:36', '2025-04-19', 'sim', 'sim@e', 'sim successfully logged in', '180.242.195.130'),
(392, '2025-04-19 15:22:37', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(393, '2025-04-19 15:23:43', '2025-04-19', 'sim', 'sim@e', 'sim logged out', '180.242.195.130'),
(394, '2025-04-19 15:24:44', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi successfully logged in', '180.242.195.130'),
(395, '2025-04-19 15:24:44', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(396, '2025-04-19 15:25:28', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(397, '2025-04-19 15:25:54', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(398, '2025-04-19 15:26:22', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi logged out', '180.242.195.130'),
(399, '2025-04-19 15:27:06', '2025-04-19', 'sim', 'sim@e', 'sim successfully logged in', '180.242.195.130'),
(400, '2025-04-19 15:27:06', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(401, '2025-04-19 15:30:42', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(402, '2025-04-19 15:30:58', '2025-04-19', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(403, '2025-04-19 15:32:48', '2025-04-19', 'sim', 'sim@e', 'sim visited log activity', '180.242.195.130'),
(404, '2025-04-19 15:32:54', '2025-04-19', 'sim', 'sim@e', 'sim logged out', '180.242.195.130'),
(405, '2025-04-19 15:33:59', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi successfully logged in', '180.242.195.130'),
(406, '2025-04-19 15:34:00', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(407, '2025-04-19 15:35:37', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi visited log activity', '180.242.195.130'),
(408, '2025-04-19 15:35:43', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi logged out', '180.242.195.130'),
(409, '2025-04-19 15:37:14', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n successfully logged in', '180.242.195.130'),
(410, '2025-04-19 15:37:14', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(411, '2025-04-19 15:38:05', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n restored kategori with ID \'6\'', '180.242.195.130'),
(412, '2025-04-19 15:38:10', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n permanently delete kategori with ID \'7\'', '180.242.195.130'),
(413, '2025-04-19 15:38:55', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n visited log activity', '180.242.195.130'),
(414, '2025-04-19 15:41:51', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(415, '2025-04-19 15:42:02', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(416, '2025-04-19 15:42:15', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n logged out', '180.242.195.130'),
(417, '2025-04-19 15:51:25', '2025-04-19', 'vivi', 'guest', 'vivi Visited dashboard', '180.242.195.130'),
(418, '2025-04-19 15:51:34', '2025-04-19', 'vivi', 'guest', 'vivi logged out', '180.242.195.130'),
(419, '2025-04-19 15:53:49', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n successfully logged in', '180.242.195.130'),
(420, '2025-04-19 15:53:50', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(421, '2025-04-19 15:53:57', '2025-04-19', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n logged out', '180.242.195.130'),
(422, '2025-04-19 16:04:53', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi successfully logged in', '180.242.195.130'),
(423, '2025-04-19 16:04:54', '2025-04-19', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(424, '2025-04-20 18:22:30', '2025-04-21', 'Chloe', 'Chloe@e', 'Chloe successfully logged in', '180.242.195.130'),
(425, '2025-04-20 18:22:31', '2025-04-21', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(426, '2025-04-20 18:46:45', '2025-04-21', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(427, '2025-04-20 18:53:01', '2025-04-21', 'sim', 'sim@e', 'sim successfully logged in', '180.242.195.130'),
(428, '2025-04-20 18:53:01', '2025-04-21', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(429, '2025-04-20 18:53:15', '2025-04-21', 'sim', 'sim@e', 'sim logged out', '180.242.195.130'),
(430, '2025-04-20 18:53:24', '2025-04-21', 'Guest', 'guest', 'Failed login attempt', '180.242.195.130'),
(431, '2025-04-20 18:53:30', '2025-04-21', 'Guest', 'guest', 'Failed login attempt', '180.242.195.130'),
(432, '2025-04-20 18:53:35', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi successfully logged in', '180.242.195.130'),
(433, '2025-04-20 18:53:36', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(434, '2025-04-20 18:56:09', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(435, '2025-04-20 18:59:11', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(436, '2025-04-20 18:59:18', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi logged out', '180.242.195.130'),
(437, '2025-04-20 18:59:29', '2025-04-21', 'Chloe', 'Chloe@e', 'Chloe successfully logged in', '180.242.195.130'),
(438, '2025-04-20 18:59:29', '2025-04-21', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(439, '2025-04-20 19:01:47', '2025-04-21', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(440, '2025-04-20 19:01:55', '2025-04-21', 'Chloe', 'Chloe@e', 'Chloe Visited dashboard', '180.242.195.130'),
(441, '2025-04-20 19:02:21', '2025-04-21', 'Chloe', 'Chloe@e', 'Chloe visited log activity', '180.242.195.130'),
(442, '2025-04-20 19:05:05', '2025-04-21', 'Chloe', 'Chloe@e', 'Chloe logged out', '180.242.195.130'),
(443, '2025-04-20 19:06:25', '2025-04-21', 'sim', 'sim@e', 'sim successfully logged in', '180.242.195.130'),
(444, '2025-04-20 19:06:25', '2025-04-21', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(445, '2025-04-20 19:11:19', '2025-04-21', 'sim', 'sim@e', 'sim Visited dashboard', '180.242.195.130'),
(446, '2025-04-20 19:47:30', '2025-04-21', 'sim', 'sim@e', 'sim visited log activity', '180.242.195.130'),
(447, '2025-04-20 19:48:50', '2025-04-21', 'sim', 'sim@e', 'sim logged out', '180.242.195.130'),
(448, '2025-04-20 19:49:02', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi successfully logged in', '180.242.195.130'),
(449, '2025-04-20 19:49:03', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(450, '2025-04-20 19:53:15', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(451, '2025-04-20 19:54:33', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(452, '2025-04-20 20:00:04', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(453, '2025-04-20 20:00:17', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi Visited dashboard', '180.242.195.130'),
(454, '2025-04-20 20:11:30', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi visited log activity', '180.242.195.130'),
(455, '2025-04-20 20:15:17', '2025-04-21', 'Lumi', 'Lumi@r', 'Lumi logged out', '180.242.195.130'),
(456, '2025-04-20 20:15:33', '2025-04-21', 'Guest', 'guest', 'Failed login attempt', '180.242.195.130'),
(457, '2025-04-20 20:16:05', '2025-04-21', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n successfully logged in', '180.242.195.130'),
(458, '2025-04-20 20:16:06', '2025-04-21', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(459, '2025-04-20 20:19:25', '2025-04-21', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(460, '2025-04-20 20:19:32', '2025-04-21', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(461, '2025-04-20 20:19:38', '2025-04-21', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(462, '2025-04-20 20:22:51', '2025-04-21', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n deleted user with ID \'7\'', '180.242.195.130'),
(463, '2025-04-20 20:36:20', '2025-04-21', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n visited log activity', '180.242.195.130'),
(464, '2025-04-20 20:36:32', '2025-04-21', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n visited log activity', '180.242.195.130'),
(465, '2025-04-20 20:42:00', '2025-04-21', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.195.130'),
(466, '2025-04-26 01:45:25', '2025-04-26', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n successfully logged in', '180.242.192.204'),
(467, '2025-04-26 01:45:26', '2025-04-26', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n Visited dashboard', '180.242.192.204'),
(468, '2025-04-26 01:49:55', '2025-04-26', 'Chelsica\r\n', 'chelsicachelsica@gmail.com', 'Chelsica\r\n logged out', '180.242.192.204');

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(50) NOT NULL,
  `nomor_nota` varchar(50) NOT NULL,
  `grand_total` int(100) NOT NULL,
  `bayar` int(100) DEFAULT NULL,
  `kembali` int(100) DEFAULT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `foto_pembayaran` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_kasir` varchar(255) DEFAULT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `nomor_nota`, `grand_total`, `bayar`, `kembali`, `metode_pembayaran`, `foto_pembayaran`, `keterangan`, `id_kasir`, `tanggal`) VALUES
(103, '250418-001', 89000, 100000, 11000, 'Cash', '', 'lunas', '2', '2025-04-18 04:06:11'),
(104, '250418-002', 37000, NULL, NULL, 'BCA', '1744975037_8bd91da3d386839830ab.jpg', 'pending\r\n', NULL, '2025-04-18 06:14:12'),
(105, '250418-003', 56000, 57000, 1000, 'Cash', '', 'lunas', '1', '2025-04-18 07:35:30'),
(106, '250418-004', 105000, 120000, 15000, 'E-Wallet', '', 'lunas', '2', '2025-04-18 07:37:18'),
(107, '250418-005', 92000, NULL, NULL, 'Cash', '1744981060_3ed985c0500d97a9ffc8.jpg', 'lunas', NULL, '2025-04-18 07:48:58'),
(108, '250418-006', 32000, NULL, NULL, 'BCA', '1744999436_c5ed3be106aa96435cc2.jpg', 'gagal', NULL, '2025-04-18 13:03:49'),
(109, '250418-007', 23000, NULL, NULL, 'BCA', '1744999936_dc4d5d03a35b5be559dc.jpg', 'lunas', '1', '2025-04-18 13:12:10'),
(110, '250418-008', 64000, NULL, NULL, 'DANA', '1745000224_a74ce6111a8a4cc87d5d.png', 'lunas', '1', '2025-04-18 13:16:58'),
(111, '250418-009', 23000, NULL, NULL, 'BCA', '1745000591_9dc49575b1dc0142b0e8.jpg', 'lunas', '1', '2025-04-18 13:21:06'),
(112, '250418-010', 25000, NULL, NULL, 'Cash', '', 'pending', NULL, '2025-04-18 13:23:52'),
(113, '250418-011', 23000, 33000, 10000, 'BCA', '1745000660_da03e205734fa041cb0a.jpg', 'lunas', '1', '2025-04-18 13:24:15'),
(114, '250418-012', 34000, NULL, NULL, 'BCA', '1745001264_aa341a44a752baf30959.jpg', 'lunas', '2', '2025-04-18 13:34:19'),
(115, '250418-013', 23000, NULL, NULL, 'BCA', '1745001415_c7140d965f8b2d8ba78f.jpg', 'lunas', '1', '2025-04-18 13:36:48'),
(116, '250418-014', 23000, NULL, NULL, 'BCA', '1745035665_5dce777329f3d7ad7be6.jpg', 'lunas', '2', '2025-04-18 23:07:39'),
(117, '250419-001', 32000, 33000, 1000, 'Cash', '', 'lunas', '2', '2025-04-19 11:13:48'),
(118, '250419-002', 22000, NULL, NULL, 'BCA', '1745036150_c582aa028f9c03d63527.png', 'lunas', '2', '2025-04-19 11:15:38'),
(119, '250419-003', 47000, NULL, NULL, 'BCA', '1745045607_ace4c184d59fcf532125.jpg', 'lunas', '5', '2025-04-19 13:53:22'),
(120, '250419-004', 559000, NULL, NULL, 'BCA', '1745058104_16f40e530a287aa27a52.jpg', 'lunas', '1', '2025-04-19 17:21:24'),
(121, '250419-005', 85000, 89000, 4000, 'Cash', '', 'lunas', '5', '2025-04-19 22:04:49'),
(122, '250419-006', 49000, NULL, NULL, 'BCA', '1745075212_1380924e2427aa9b23bd.jpeg', 'lunas', '2', '2025-04-19 22:06:30'),
(123, '250419-007', 96000, 100000, 4000, 'Cash', '', 'lunas', '5', '2025-04-19 22:18:09'),
(124, '250419-008', 64000, NULL, NULL, 'BCA', '1745076009_43c85f580c86a5eb1fe8.jpeg', 'lunas', '2', '2025-04-19 22:19:49'),
(125, '250419-009', 46000, NULL, NULL, 'E-Wallet', '1745076073_c2058c5245bb1c150106.jpeg', 'gagal', '2', '2025-04-19 22:21:08'),
(126, '250421-001', 64000, NULL, NULL, 'Cash', '', 'pending', NULL, '2025-04-21 01:42:02'),
(127, '250421-002', 18000, NULL, NULL, 'BCA', '1745174967_ee5ebb2db76dac4788d3.jpeg', 'lunas', '2', '2025-04-21 01:47:03'),
(128, '250421-003', 12000, NULL, NULL, 'BCA', '1745175394_a274f5c1b33047be2e4e.jpeg', 'gagal', '2', '2025-04-21 01:56:27'),
(129, '250421-004', 18000, NULL, NULL, 'BCA', '1745179236_c81f021ab319d36611bf.jpeg', 'pending', NULL, '2025-04-21 03:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(15) NOT NULL,
  `kode_pemesanan` varchar(25) NOT NULL,
  `nomor_meja` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah` int(25) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `id_user` int(15) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status_pemesanan` varchar(100) DEFAULT NULL,
  `nomor_nota` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `kode_pemesanan`, `nomor_meja`, `kode_barang`, `jumlah`, `catatan`, `id_user`, `tanggal`, `status_pemesanan`, `nomor_nota`) VALUES
(7, '1', '04', '41', 2, 'donut donut', 1, '2025-04-18 04:06:11', 'proses', '250418-001'),
(8, '1', '04', '39', 1, '', 1, '2025-04-18 04:06:11', 'proses', '250418-001'),
(9, 'KP-250418-003', '05', '43', 2, 'wwwwwwww', 1, '2025-04-18 06:14:12', 'proses', '250418-002'),
(10, 'KP-250418-003', '05', '34', 1, '', 1, '2025-04-18 06:14:12', 'proses', '250418-002'),
(11, 'KP-250418-005', '07', '36', 1, 'ww', 1, '2025-04-18 07:35:30', 'proses', '250418-003'),
(12, 'KP-250418-005', '07', '38', 2, 'ww', 1, '2025-04-18 07:35:30', 'proses', '250418-003'),
(13, 'KP-250418-007', '09', '41', 1, '', 1, '2025-04-18 07:37:18', 'proses', '250418-004'),
(14, 'KP-250418-007', '09', '40', 1, '', 1, '2025-04-18 07:37:18', 'proses', '250418-004'),
(15, 'KP-250418-007', '09', '39', 2, '', 1, '2025-04-18 07:37:18', 'proses', '250418-004'),
(16, 'KP-250418-010', '09', '40', 4, '', 1, '2025-04-18 07:48:58', 'proses', '250418-005'),
(17, 'KP-250418-011', '10', '41', 1, 'ee', 1, '2025-04-18 13:03:49', 'proses', '250418-006'),
(18, 'KP-250418-012', '11', '40', 1, '', 2, '2025-04-18 13:12:10', 'proses', '250418-007'),
(19, 'KP-250418-013', '08', '41', 2, 'k', 1, '2025-04-18 13:16:58', 'proses', '250418-008'),
(20, 'KP-250418-014', '13', '40', 1, '', 1, '2025-04-18 13:21:06', 'proses', '250418-009'),
(21, 'KP-250418-015', '04', '39', 1, '', 1, '2025-04-18 13:23:52', 'proses', '250418-010'),
(22, 'KP-250418-016', '07', '37', 1, '', 1, '2025-04-18 13:24:15', 'selesai', '250418-011'),
(23, 'KP-250418-017', '12', '36', 1, '', 2, '2025-04-18 13:34:19', 'gagal', '250418-012'),
(24, 'KP-250418-017', '12', '38', 1, '', 2, '2025-04-18 13:34:19', 'gagal', '250418-012'),
(25, 'KP-250418-019', '14', '40', 1, '', 1, '2025-04-18 13:36:48', 'selesai', '250418-013'),
(26, 'KP-250418-020', '15', '37', 1, '', 1, '2025-04-18 23:07:39', 'proses', '250418-014'),
(27, 'KP-250419-001', '15', '41', 1, '', 2, '2025-04-19 11:13:48', 'proses', '250419-001'),
(28, 'KP-250419-002', '12', '38', 1, '', 2, '2025-04-19 11:15:38', 'selesai', '250419-002'),
(29, 'KP-250419-003', '07', '38', 1, 'e', 3, '2025-04-19 13:53:22', 'proses', '250419-003'),
(30, 'KP-250419-003', '07', '39', 1, '', 3, '2025-04-19 13:53:22', 'proses', '250419-003'),
(31, 'KP-250419-005', '13', '41', 6, '', 1, '2025-04-19 17:21:24', 'selesai', '250419-004'),
(32, 'KP-250419-005', '13', '40', 5, '', 1, '2025-04-19 17:21:24', 'selesai', '250419-004'),
(33, 'KP-250419-005', '13', '37', 1, 'buat lebih lezat', 1, '2025-04-19 17:21:24', 'selesai', '250419-004'),
(34, 'KP-250419-005', '13', '38', 6, '', 1, '2025-04-19 17:21:24', 'selesai', '250419-004'),
(35, 'KP-250419-005', '13', '34', 1, '', 1, '2025-04-19 17:21:24', 'selesai', '250419-004'),
(36, 'KP-250419-005', '13', '43', 7, '', 1, '2025-04-19 17:21:24', 'selesai', '250419-004'),
(37, 'KP-250419-011', '17', '43', 2, 'kurangin cinnamon', 3, '2025-04-19 22:04:49', 'proses', '250419-005'),
(38, 'KP-250419-011', '17', '38', 1, '', 3, '2025-04-19 22:04:49', 'proses', '250419-005'),
(39, 'KP-250419-011', '17', '45', 3, '', 3, '2025-04-19 22:04:49', 'proses', '250419-005'),
(40, 'KP-250419-014', '18', '45', 2, '', 3, '2025-04-19 22:06:30', 'proses', '250419-006'),
(41, 'KP-250419-014', '18', '37', 1, '', 3, '2025-04-19 22:06:30', 'proses', '250419-006'),
(42, 'KP-250419-016', '20', '46', 4, 'tambahin cheese lagi', 3, '2025-04-19 22:18:09', 'proses', '250419-007'),
(43, 'KP-250419-016', '20', '43', 2, '', 3, '2025-04-19 22:18:09', 'proses', '250419-007'),
(44, 'KP-250419-018', '20', '41', 2, 'spider', 3, '2025-04-19 22:19:49', 'selesai', '250419-008'),
(45, 'KP-250419-019', '20', '37', 2, '', 3, '2025-04-19 22:21:08', 'gagal', '250419-009'),
(46, 'KP-250421-001', '20', '41', 2, '', 3, '2025-04-21 01:42:02', 'proses', '250421-001'),
(47, 'KP-250421-002', '12', '46', 1, '', 3, '2025-04-21 01:47:03', 'proses', '250421-002'),
(48, 'KP-250421-003', '23', '43', 1, '', 2, '2025-04-21 01:56:27', 'proses', '250421-003'),
(49, 'KP-250421-004', '9', '46', 1, '', 2, '2025-04-21 03:00:31', 'proses', '250421-004');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_app`
--

CREATE TABLE `pengaturan_app` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_app` varchar(100) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `logo` varchar(255) DEFAULT 'assets/img/default-logo.png',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan_app`
--

INSERT INTO `pengaturan_app` (`id_pengaturan`, `nama_app`, `owner`, `judul`, `logo`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Cafe', '1745077299_d182908b25f5f748eb45.jpg', '2025-04-16 06:43:50', '2025-04-16 06:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `level` int(15) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `level`, `token`, `expiry`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'chelsicachelsica@gmail.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'Chelsica\r\n', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Lumi@r', 'c4ca4238a0b923820dcc509a6f75849b', 'Lumi', 1, NULL, NULL, NULL, NULL, '2025-04-17 07:18:42', NULL, NULL, 'Chelsica\r\n', NULL),
(3, 'Chloe@e', 'a87ff679a2f3e71d9181a67b7542122c', 'Chloe', 4, NULL, NULL, NULL, '2025-04-16 08:06:48', '2025-04-17 07:18:32', NULL, NULL, 'Chelsica\r\n', NULL),
(5, 'sim@e', 'c81e728d9d4c2f636f067f89cc14862c', 'sim', 2, NULL, NULL, NULL, '2025-04-17 07:19:44', '2025-04-17 07:20:28', NULL, 'Chelsica\r\n', 'Chelsica\r\n', NULL),
(7, 'vivi@e', 'e38731262c555be0e87f805dcb57ac3b', 'vivi', 4, NULL, NULL, 0, '2025-04-19 10:51:24', NULL, '2025-04-20 15:22:50', NULL, NULL, 'Chelsica\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
