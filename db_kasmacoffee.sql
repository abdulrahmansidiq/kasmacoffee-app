-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Okt 2026 pada 21.11
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `pos-coffee`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `item_id` int NOT NULL,
  `price` int NOT NULL,
  `qty` int NOT NULL,
  `discount_item` int NOT NULL,
  `total` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`category_id`, `name`, `created`, `updated`) VALUES
(19, 'Hot Coffee', '0000-00-00 00:00:00', NULL),
(20, 'Iced Coffee', '0000-00-00 00:00:00', NULL),
(21, 'Snacks', '0000-00-00 00:00:00', NULL),
(22, 'Main Course', '0000-00-00 00:00:00', NULL),
(24, 'Coffee Beans', '0000-00-00 00:00:00', NULL),
(25, 'Non Coffee', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `gender`, `phone`, `address`, `created`, `updated`) VALUES
(2, 'Umum', 'L', '-', 'Default', '0000-00-00 00:00:00', NULL),
(3, 'Ibu Nani', 'P', '081234567890', 'Jl. M. Boya, Lr. Cendana', '0000-00-00 00:00:00', '2026-10-08 19:31:25'),
(9, 'Cece Meidha', 'P', '081234567890', 'Jl. M. Boya, Lr. Kampung Jawa', '0000-00-00 00:00:00', '2026-10-08 19:32:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `item_id` int NOT NULL,
  `barcode` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `category_id` int NOT NULL,
  `unit_id` int NOT NULL,
  `price` int DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `image` varchar(128) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`item_id`, `barcode`, `name`, `category_id`, `unit_id`, `price`, `stock`, `image`, `created`, `updated`) VALUES
(55, 'MP-001', 'Espresso', 19, 17, 15000, 98, 'item-261008-80220aa6a8.png', '2026-10-09 03:11:45', '2026-10-08 20:13:42'),
(56, 'MD-001', 'Ice Caffe Latte', 20, 17, 18000, 98, 'item-261008-833b567fec.png', '2026-10-09 03:12:38', '2026-10-08 20:13:55'),
(57, 'MP-002', 'V60 Manual Brew', 19, 17, 20000, 99, 'item-261008-a4cc044dbb.png', '2026-10-09 03:14:33', NULL),
(58, 'MD-002', 'Es Kopyor', 25, 17, 15000, 95, 'item-261008-de186cf116.png', '2026-10-09 03:15:14', NULL),
(59, 'SKG', 'Kentang Goreng', 21, 18, 15000, 97, 'item-261008-3ed1ad481a.png', '2026-10-09 03:16:22', NULL),
(60, 'MC-001', 'Nasi Goreng Spesial', 22, 18, 20000, 98, 'item-261008-ce417307ae.png', '2026-10-09 03:16:56', NULL),
(61, 'MC-002', 'Nasi Goreng Daging Ayam', 22, 18, 22000, 98, 'item-261008-9bc0f85835.png', '2026-10-09 03:17:25', NULL),
(62, 'MC-003', 'Nasi Goreng Seafood', 22, 18, 22000, 98, 'item-261008-addd1d5f5d.png', '2026-10-09 03:17:50', NULL),
(63, 'MC-004', 'Nasi Goreng Daging Sapi', 22, 18, 27000, 99, 'item-261008-5c8bb592c4.png', '2026-10-09 03:18:23', NULL),
(64, 'CB-001', 'Arabica Full Wash 250gr', 24, 21, 80000, 99, 'item-261008-57400f519e.png', '2026-10-09 03:19:08', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `kasir_id` int NOT NULL,
  `invoice` varchar(64) NOT NULL,
  `customer_id` int DEFAULT NULL,
  `total_price` int NOT NULL,
  `discount` int NOT NULL,
  `final_price` int NOT NULL,
  `cash` int NOT NULL,
  `remaining` int NOT NULL,
  `note` text NOT NULL,
  `no_meja` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `user_id` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`kasir_id`, `invoice`, `customer_id`, `total_price`, `discount`, `final_price`, `cash`, `remaining`, `note`, `no_meja`, `date`, `user_id`, `created`) VALUES
(61, 'MM2610080001', 2, 22000, 0, 22000, 25000, 3000, '', '5', '2026-10-08', 1, '2026-10-09 03:23:54'),
(62, 'MM2610080001', 2, 42000, 5000, 37000, 40000, 3000, '-', '', '2026-10-08', 5, '2026-10-09 03:50:54'),
(63, 'MM2610080001', 2, 15000, 0, 15000, 15000, 0, '-', '', '2026-10-08', 5, '2026-10-09 03:57:51'),
(64, 'MM2610080001', 2, 108000, 0, 108000, 110000, 2000, '-', '', '2026-10-08', 5, '2026-10-09 03:58:33');

--
-- Trigger `kasir`
--
DELIMITER $$
CREATE TRIGGER `del_detail` AFTER DELETE ON `kasir` FOR EACH ROW BEGIN
	DELETE FROM kasir_detail
    WHERE kasir_id = OLD.kasir_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir_detail`
--

CREATE TABLE `kasir_detail` (
  `detail_id` int NOT NULL,
  `kasir_id` int NOT NULL,
  `item_id` int NOT NULL,
  `price` int NOT NULL,
  `qty` int NOT NULL,
  `discount_item` int NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kasir_detail`
--

INSERT INTO `kasir_detail` (`detail_id`, `kasir_id`, `item_id`, `price`, `qty`, `discount_item`, `total`) VALUES
(72, 61, 62, 22000, 1, 0, 22000),
(73, 62, 60, 20000, 1, 0, 20000),
(74, 62, 61, 22000, 1, 0, 22000),
(75, 63, 58, 15000, 1, 0, 15000),
(76, 64, 58, 15000, 3, 0, 45000),
(77, 64, 56, 18000, 1, 0, 18000),
(78, 64, 55, 15000, 1, 0, 15000),
(79, 64, 59, 15000, 2, 0, 30000);

--
-- Trigger `kasir_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `kasir_detail` FOR EACH ROW BEGIN
	UPDATE item SET stock = stock - 		NEW.qty
    WHERE item_id = NEW.item_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_return` AFTER DELETE ON `kasir_detail` FOR EACH ROW BEGIN
	UPDATE item SET stock = stock + 		OLD.qty
    WHERE item_id = OLD.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `log_id` int NOT NULL,
  `keterangan` text NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`log_id`, `keterangan`, `created_by`, `created`) VALUES
(158, 'Tambah Kategori | Nama Kategori : The Palm Sugar Boom ', 'admin', '2026-10-09 03:07:05'),
(159, 'Ubah Kategori | Nama Kategori : Espresso Based ', 'admin', '2026-10-09 03:07:31'),
(160, 'Tambah Kategori | Nama Kategori : Manual Brew ', 'admin', '2026-10-09 03:07:40'),
(161, 'Hapus Kategori | Nama Kategori : Espresso Based ', 'admin', '2026-10-09 03:07:52'),
(162, 'Hapus Kategori | Nama Kategori : Manual Brew ', 'admin', '2026-10-09 03:07:55'),
(163, 'Tambah Kategori | Nama Kategori : Hot Coffee ', 'admin', '2026-10-09 03:08:15'),
(164, 'Tambah Kategori | Nama Kategori : Iced Coffee ', 'admin', '2026-10-09 03:08:23'),
(165, 'Tambah Kategori | Nama Kategori : Snacks ', 'admin', '2026-10-09 03:08:31'),
(166, 'Tambah Kategori | Nama Kategori : Main Course ', 'admin', '2026-10-09 03:08:37'),
(167, 'Tambah Kategori | Nama Kategori : Non Coffee ', 'admin', '2026-10-09 03:09:14'),
(168, 'Tambah Satuan | Nama Satuan : Cup ', 'admin', '2026-10-09 03:09:30'),
(169, 'Tambah Satuan | Nama Satuan : Porsi  ', 'admin', '2026-10-09 03:09:39'),
(170, 'Tambah Satuan | Nama Satuan : Pcs  ', 'admin', '2026-10-09 03:09:45'),
(171, 'Tambah Satuan | Nama Satuan : Gram ', 'admin', '2026-10-09 03:09:52'),
(172, 'Tambah Satuan | Nama Satuan : Pack  ', 'admin', '2026-10-09 03:10:01'),
(173, 'Tambah Kategori | Nama Kategori : Coffee Beans ', 'admin', '2026-10-09 03:10:13'),
(174, 'Hapus Kategori | Nama Kategori : Non Coffee ', 'admin', '2026-10-09 03:10:21'),
(175, 'Tambah Kategori | Nama Kategori : Non Coffee ', 'admin', '2026-10-09 03:10:24'),
(176, 'Tambah Item | Kode Item : Espresso | Nama Item : Espresso | Kategory : 19 | Satuan : 17 | Harga : 15000 | Gambar Item : item-261008-80220aa6a8.png', 'admin', '2026-10-09 03:11:45'),
(177, 'Tambah Item | Kode Item : ICL1 | Nama Item : Ice Caffe Latte | Kategory : 20 | Satuan : 17 | Harga : 18000 | Gambar Item : item-261008-833b567fec.png', 'admin', '2026-10-09 03:12:38'),
(178, 'Ubah Item | Kode Item : Esp005 | Nama Item : Espresso | Kategory : 19 | Satuan : 17 | Harga : 15000 | Gambar Item : ', 'admin', '2026-10-09 03:13:01'),
(179, 'Ubah Item | Kode Item : MP-001 | Nama Item : Espresso | Kategory : 19 | Satuan : 17 | Harga : 15000 | Gambar Item : ', 'admin', '2026-10-09 03:13:42'),
(180, 'Ubah Item | Kode Item : MD-001 | Nama Item : Ice Caffe Latte | Kategory : 20 | Satuan : 17 | Harga : 18000 | Gambar Item : ', 'admin', '2026-10-09 03:13:55'),
(181, 'Tambah Item | Kode Item : MP-002 | Nama Item : V60 Manual Brew | Kategory : 19 | Satuan : 17 | Harga : 20000 | Gambar Item : item-261008-a4cc044dbb.png', 'admin', '2026-10-09 03:14:33'),
(182, 'Tambah Item | Kode Item : MD-002 | Nama Item : Es Kopyor | Kategory : 25 | Satuan : 17 | Harga : 15000 | Gambar Item : item-261008-de186cf116.png', 'admin', '2026-10-09 03:15:14'),
(183, 'Tambah Item | Kode Item : SKG | Nama Item : Kentang Goreng | Kategory : 21 | Satuan : 18 | Harga : 15000 | Gambar Item : item-261008-3ed1ad481a.png', 'admin', '2026-10-09 03:16:22'),
(184, 'Tambah Item | Kode Item : MC-001 | Nama Item : Nasi Goreng Spesial | Kategory : 22 | Satuan : 18 | Harga : 20000 | Gambar Item : item-261008-ce417307ae.png', 'admin', '2026-10-09 03:16:56'),
(185, 'Tambah Item | Kode Item : MC-002 | Nama Item : Nasi Goreng Daging Ayam | Kategory : 22 | Satuan : 18 | Harga : 22000 | Gambar Item : item-261008-9bc0f85835.png', 'admin', '2026-10-09 03:17:25'),
(186, 'Tambah Item | Kode Item : MC-003 | Nama Item : Nasi Goreng Seafood | Kategory : 22 | Satuan : 18 | Harga : 22000 | Gambar Item : item-261008-addd1d5f5d.png', 'admin', '2026-10-09 03:17:50'),
(187, 'Tambah Item | Kode Item : MC-004 | Nama Item : Nasi Goreng Daging Sapi | Kategory : 22 | Satuan : 18 | Harga : 27000 | Gambar Item : item-261008-5c8bb592c4.png', 'admin', '2026-10-09 03:18:23'),
(188, 'Tambah Item | Kode Item : CB-001 | Nama Item : Arabica Full Wash 250gr | Kategory : 24 | Satuan : 21 | Harga : 80000 | Gambar Item : item-261008-57400f519e.png', 'admin', '2026-10-09 03:19:08'),
(189, 'Stock Masuk | Item : 55 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:20:10'),
(190, 'Stock Masuk | Item : 57 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2026-10-08', 'admin', '2026-10-09 03:20:27'),
(191, 'Stock Masuk | Item : 57 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:21:01'),
(192, 'Stock Masuk | Item : 59 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:21:18'),
(193, 'Stock Masuk | Item : 58 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:21:37'),
(194, 'Stock Masuk | Item : 56 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:21:55'),
(195, 'Stock Masuk | Item : 63 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:22:13'),
(196, 'Stock Masuk | Item : 62 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:22:29'),
(197, 'Stock Masuk | Item : 61 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:22:46'),
(198, 'Stock Masuk | Item : 60 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:23:03'),
(199, 'Stock Masuk | Item : 64 | Type : Masuk | Detail :   | Qty : 99 | Tanggal : 2019-11-11', 'admin', '2026-10-09 03:23:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int UNSIGNED NOT NULL,
  `nama_usaha` varchar(100) NOT NULL DEFAULT 'KopiPOS',
  `alamat` text,
  `telepon` varchar(20) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `nama_usaha`, `alamat`, `telepon`, `logo`) VALUES
(1, 'KasmaCoffee', 'Jl. M. Boya No.122', '081234567890', 'logo-261008-47e3cdda4f.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `stock_id` int NOT NULL,
  `item_id` int NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(256) NOT NULL,
  `qty` int NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`stock_id`, `item_id`, `type`, `detail`, `qty`, `date`, `created`, `user_id`) VALUES
(54, 55, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:20:10', 1),
(56, 57, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:21:01', 1),
(57, 59, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:21:18', 1),
(58, 58, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:21:37', 1),
(59, 56, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:21:55', 1),
(60, 63, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:22:13', 1),
(61, 62, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:22:29', 1),
(62, 61, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:22:46', 1),
(63, 60, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:23:03', 1),
(64, 64, 'in', ' ', 99, '2019-11-11', '2026-10-09 03:23:23', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

CREATE TABLE `unit` (
  `unit_id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`unit_id`, `name`, `created`, `updated`) VALUES
(17, 'Cup', '0000-00-00 00:00:00', NULL),
(18, 'Porsi ', '0000-00-00 00:00:00', NULL),
(19, 'Pcs ', '0000-00-00 00:00:00', NULL),
(20, 'Gram', '0000-00-00 00:00:00', NULL),
(21, 'Pack ', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(256) DEFAULT NULL,
  `level` int NOT NULL COMMENT '1:admin,2:kasir',
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `address`, `level`, `photo`) VALUES
(1, 'admin', 'd4e8e6deaa7b1f8381e09e3e6b83e36f0b681c5c', 'admin', '-', 1, 'user-1-261008-1612ffc3a2.png'),
(5, 'bintangpratama', '4b621b39f1a5ffa0fe0e1a92e1f8ce584ebc55bc', 'Bintang Pratama', 'Jl. Terimas,  Gg. Sukajadi', 2, 'user-5-261008-a350ec0e95.png'),
(6, 'lydia', 'd4e8e6deaa7b1f8381e09e3e6b83e36f0b681c5c', 'Lydia Safira Utami', 'Jl. M. Boya, Lr. Krakatau', 1, 'user-6-261008-a181a9ab65.png');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`kasir_id`);

--
-- Indeks untuk tabel `kasir_detail`
--
ALTER TABLE `kasir_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `kasir`
--
ALTER TABLE `kasir`
  MODIFY `kasir_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `kasir_detail`
--
ALTER TABLE `kasir_detail`
  MODIFY `detail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
