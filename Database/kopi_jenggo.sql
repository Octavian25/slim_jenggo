-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Mar 2021 pada 00.22
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kopi_jenggo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_barang`
--

CREATE TABLE `tm_barang` (
  `id_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tm_barang`
--

INSERT INTO `tm_barang` (`id_barang`, `nama_barang`, `qty`, `harga`) VALUES
('TB001', 'CHOCO', 100, 15000),
('TB002', 'COFFE BLEND', 100, 20000),
('TB003', 'TESTING ADD', 12, 200000),
('TB004', 'Barang COBA1', 19, 20),
('TB005', 'Barang COBA1', 19, 20),
('TB006', 'Barang COBA1', 19, 20),
('TB007', 'Barang COBA1', 19, 20),
('TB008', 'Barang COBA1', 19, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_cabang`
--

CREATE TABLE `tm_cabang` (
  `id_cabang` varchar(50) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `alamat_cabang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tm_cabang`
--

INSERT INTO `tm_cabang` (`id_cabang`, `nama_cabang`, `alamat_cabang`) VALUES
('CB001', 'CABANG MUARA SARI', 'MUARA SARI 1 '),
('CB002', 'CABANG STTB', 'SOEKARNO HATTA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_menu`
--

CREATE TABLE `tm_menu` (
  `id_menu` varchar(50) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `id_cabang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tm_menu`
--

INSERT INTO `tm_menu` (`id_menu`, `id_barang`, `nama_barang`, `harga_barang`, `id_cabang`) VALUES
('MN001', 'TB001', 'CHOCHO LATTE 2', 20000, 'CB002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_operasional`
--

CREATE TABLE `tm_operasional` (
  `keterangan` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `id_cabang` varchar(50) NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `id_operasional` int(11) NOT NULL,
  `tanggal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tm_operasional`
--

INSERT INTO `tm_operasional` (`keterangan`, `harga`, `id_cabang`, `input_by`, `id_operasional`, `tanggal`) VALUES
('BAYAR WIFI INDIHOME', 260000, 'CB001', 'octa25', 3, '2021-03-12'),
('BAYAR WIFI INDIHOME', 260000, 'CB001', 'octa25', 4, '2021-03-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_pegawai`
--

CREATE TABLE `tm_pegawai` (
  `id_pegawai` varchar(50) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `gaji` int(11) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `id_cabang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tm_pegawai`
--

INSERT INTO `tm_pegawai` (`id_pegawai`, `nama_pegawai`, `alamat`, `jenis_kelamin`, `gaji`, `no_telp`, `id_cabang`) VALUES
('TP001', 'OCTAVIAN', 'LEUWI PANJANG', 'pria', 6000000, '085923892389', 'CB001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tt_detail_barang`
--

CREATE TABLE `tt_detail_barang` (
  `detail_barang` varchar(50) NOT NULL,
  `id_menu` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tt_detail_pegawai_absensi`
--

CREATE TABLE `tt_detail_pegawai_absensi` (
  `detail_pegawai` varchar(50) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tt_ebsensi`
--

CREATE TABLE `tt_ebsensi` (
  `id_absensi` varchar(50) NOT NULL,
  `tanggal_absensi` date NOT NULL,
  `detail_pegawai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tt_head_barang`
--

CREATE TABLE `tt_head_barang` (
  `no_faktur` varchar(50) NOT NULL,
  `detail_barang` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `id_cabang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tt_operasional`
--

CREATE TABLE `tt_operasional` (
  `id_operasional` int(11) NOT NULL,
  `nama_operasional` varchar(255) NOT NULL,
  `harga_operasional` int(11) NOT NULL,
  `tanggal_operasional` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tt_order_bahan_baku`
--

CREATE TABLE `tt_order_bahan_baku` (
  `id_order` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `id_cabang` varchar(50) NOT NULL,
  `no_faktur` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tt_order_bahan_baku`
--

INSERT INTO `tt_order_bahan_baku` (`id_order`, `tanggal`, `id_cabang`, `no_faktur`, `status`) VALUES
('c90f8031-6a8e-427c-b48e-0063abe0626c', '2021-03-12', 'CB001', 'c90f8031-6a8e-427c-b48e-0063abe0626c', 'menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tt_order_bahan_baku_detail`
--

CREATE TABLE `tt_order_bahan_baku_detail` (
  `no_faktur` varchar(50) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tt_order_bahan_baku_detail`
--

INSERT INTO `tt_order_bahan_baku_detail` (`no_faktur`, `id_barang`, `qty`, `total_harga`, `id_order`) VALUES
('c90f8031-6a8e-427c-b48e-0063abe0626c', 'TB001', 5, 75000, 4),
('c90f8031-6a8e-427c-b48e-0063abe0626c', 'TB002', 5, 100000, 5),
('c90f8031-6a8e-427c-b48e-0063abe0626c', 'TB003', 5, 1000000, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `level` enum('gudang','owner','cabang') NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `id_cabang` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `hit` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `level`, `created_at`, `last_login`, `id_cabang`, `token`, `hit`, `password`) VALUES
(1, 'octa25', 'octavian', 'owner', '03-04-202', '03-04-202', 'CB001', '405a9f8b02ca77137c53f17dfb65345dd5bed827', 31, '123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tm_barang`
--
ALTER TABLE `tm_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tm_cabang`
--
ALTER TABLE `tm_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indeks untuk tabel `tm_menu`
--
ALTER TABLE `tm_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- Indeks untuk tabel `tm_operasional`
--
ALTER TABLE `tm_operasional`
  ADD PRIMARY KEY (`id_operasional`);

--
-- Indeks untuk tabel `tm_pegawai`
--
ALTER TABLE `tm_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- Indeks untuk tabel `tt_detail_barang`
--
ALTER TABLE `tt_detail_barang`
  ADD PRIMARY KEY (`detail_barang`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `tt_detail_pegawai_absensi`
--
ALTER TABLE `tt_detail_pegawai_absensi`
  ADD PRIMARY KEY (`detail_pegawai`);

--
-- Indeks untuk tabel `tt_ebsensi`
--
ALTER TABLE `tt_ebsensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `detail_pegawai` (`detail_pegawai`);

--
-- Indeks untuk tabel `tt_head_barang`
--
ALTER TABLE `tt_head_barang`
  ADD PRIMARY KEY (`no_faktur`),
  ADD KEY `detail_barang` (`detail_barang`);

--
-- Indeks untuk tabel `tt_operasional`
--
ALTER TABLE `tt_operasional`
  ADD PRIMARY KEY (`id_operasional`);

--
-- Indeks untuk tabel `tt_order_bahan_baku`
--
ALTER TABLE `tt_order_bahan_baku`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `tt_order_bahan_baku_detail`
--
ALTER TABLE `tt_order_bahan_baku_detail`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `no_faktur` (`no_faktur`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tm_operasional`
--
ALTER TABLE `tm_operasional`
  MODIFY `id_operasional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tt_order_bahan_baku_detail`
--
ALTER TABLE `tt_order_bahan_baku_detail`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tm_menu`
--
ALTER TABLE `tm_menu`
  ADD CONSTRAINT `tm_menu_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tm_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_menu_ibfk_2` FOREIGN KEY (`id_cabang`) REFERENCES `tm_cabang` (`id_cabang`);

--
-- Ketidakleluasaan untuk tabel `tm_pegawai`
--
ALTER TABLE `tm_pegawai`
  ADD CONSTRAINT `tm_pegawai_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `tm_cabang` (`id_cabang`);

--
-- Ketidakleluasaan untuk tabel `tt_detail_barang`
--
ALTER TABLE `tt_detail_barang`
  ADD CONSTRAINT `tt_detail_barang_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `tm_menu` (`id_menu`);

--
-- Ketidakleluasaan untuk tabel `tt_ebsensi`
--
ALTER TABLE `tt_ebsensi`
  ADD CONSTRAINT `tt_ebsensi_ibfk_1` FOREIGN KEY (`detail_pegawai`) REFERENCES `tt_detail_pegawai_absensi` (`detail_pegawai`);

--
-- Ketidakleluasaan untuk tabel `tt_head_barang`
--
ALTER TABLE `tt_head_barang`
  ADD CONSTRAINT `tt_head_barang_ibfk_1` FOREIGN KEY (`detail_barang`) REFERENCES `tt_detail_barang` (`detail_barang`);

--
-- Ketidakleluasaan untuk tabel `tt_order_bahan_baku`
--
ALTER TABLE `tt_order_bahan_baku`
  ADD CONSTRAINT `tt_order_bahan_baku_ibfk_1` FOREIGN KEY (`no_faktur`) REFERENCES `tt_order_bahan_baku_detail` (`no_faktur`);

--
-- Ketidakleluasaan untuk tabel `tt_order_bahan_baku_detail`
--
ALTER TABLE `tt_order_bahan_baku_detail`
  ADD CONSTRAINT `tt_order_bahan_baku_detail_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tm_barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `tm_cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
