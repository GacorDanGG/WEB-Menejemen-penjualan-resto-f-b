-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2025 pada 09.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fp_ggmu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `total_amount`, `order_date`, `user_id`) VALUES
(21, 'ORD-1734723738', 13000, '2023-12-20 13:42:18', 3),
(22, 'ORD-1734723747', 35000, '2023-12-20 13:42:27', 3),
(23, 'ORD-1734723753', 3000, '2024-12-20 13:42:33', 3),
(24, 'ORD-1734723765', 16000, '2024-12-20 13:42:45', 3),
(25, 'ORD-1734723836', 30000, '2023-12-20 13:43:56', 1),
(26, 'ORD-1734723848', 21000, '2024-12-20 13:44:08', 1),
(27, 'ORD-1734723852', 3000, '2024-12-20 13:44:12', 1),
(28, 'ORD-1734723879', 12000, '2024-11-20 13:44:39', 4),
(29, 'ORD-1734723888', 23000, '2024-11-20 13:44:48', 4),
(30, 'ORD-1734723897', 10000, '2024-12-20 13:44:57', 4),
(31, 'ORD-1734723927', 39000, '2024-12-20 13:45:27', 2),
(33, 'ORD-1734830676', 13000, '2024-12-21 19:24:36', 1),
(34, 'ORD-1734830735', 165000, '2024-12-21 19:25:35', 1),
(37, 'ORD-1735456994', 30000, '2024-12-29 01:23:14', 1),
(38, 'ORD-1735457108', 30000, '2024-12-29 01:25:08', 1),
(39, 'ORD-1735475092', 30000, '2024-12-29 06:24:52', 1),
(40, 'ORD-1735475110', 30000, '2024-12-29 06:25:10', 1),
(41, 'ORD-1735476030', 50000, '2024-12-29 12:40:30', 1),
(42, 'ORD-1735476311', 300000, '2024-12-29 12:45:11', 1),
(43, 'ORD-1735604248', 100000, '2024-12-31 00:17:28', 1),
(44, 'ORD-1735606905', 125000, '2024-12-31 01:01:45', 1),
(47, 'ORD-1735808215', 50000, '2025-01-02 08:56:55', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(33, 21, 5, 1, 13000),
(34, 22, 1, 2, 10000),
(35, 22, 6, 1, 15000),
(36, 23, 7, 1, 3000),
(37, 24, 5, 1, 13000),
(38, 24, 8, 1, 3000),
(39, 25, 1, 3, 10000),
(40, 26, 6, 1, 15000),
(41, 26, 8, 2, 3000),
(42, 27, 7, 1, 3000),
(43, 28, 7, 4, 3000),
(44, 29, 4, 1, 10000),
(45, 29, 5, 1, 13000),
(46, 30, 4, 1, 10000),
(47, 31, 2, 3, 13000),
(48, 33, 1, 1, 10000),
(49, 33, 7, 1, 3000),
(50, 34, 3, 11, 15000),
(54, 37, 8, 10, 3000),
(55, 38, 8, 10, 3000),
(56, 39, 7, 5, 3000),
(57, 39, 8, 5, 3000),
(58, 40, 7, 5, 3000),
(59, 40, 8, 5, 3000),
(60, 41, 4, 5, 10000),
(61, 42, 3, 10, 15000),
(62, 42, 6, 10, 15000),
(63, 43, 1, 10, 10000),
(64, 44, 4, 5, 10000),
(65, 44, 6, 5, 15000),
(72, 47, 1, 5, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `image_url`) VALUES
(1, 'Ayam Goreng', 10000, 'assets/uploads/ayam goreng.jpeg'),
(2, 'Ayam Goreng + Nasi', 13000, 'assets/uploads/ayam+nazi.jpeg'),
(3, 'Ayam Goreng + Nasi + Minum', 15000, 'assets/uploads/ayam+nazi+minum.jpeg'),
(4, 'Ayam Bakar', 10000, 'assets/uploads/ayambkr.jpg'),
(5, 'Ayam Bakar+ Nasi', 13000, 'assets/uploads/ayambkr+nazi.jpeg'),
(6, 'Ayam Bakar + Nasi + Minum', 15000, 'assets/uploads/bkr+minum.jpeg'),
(7, 'Es Teh', 3000, 'assets/uploads/teh.jpeg'),
(8, 'Es Jeruk', 3000, 'assets/uploads/jrk.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `role` enum('owner','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'dega', '1234', 'owner'),
(2, 'dida', '1234', 'kasir'),
(3, 'evan', '1234', 'kasir'),
(4, 'kevin', '1234', 'kasir'),
(5, 'Nabi Adam', '1234', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
