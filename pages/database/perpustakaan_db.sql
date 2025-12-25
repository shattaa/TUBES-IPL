-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Des 2025 pada 18.21
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
-- Database: `perpustakaan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_perpus`
--

CREATE TABLE `anggota_perpus` (
  `id` int(11) NOT NULL,
  `nis` char(9) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota_perpus`
--

INSERT INTO `anggota_perpus` (`id`, `nis`, `nama`, `alamat`, `no_hp`) VALUES
(3, '123456789', 'test', 'test', '085238948212');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_buku`
--

CREATE TABLE `daftar_buku` (
  `kode_buku` varchar(25) NOT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `penulis` varchar(45) DEFAULT NULL,
  `penerbit` varchar(45) DEFAULT NULL,
  `tahun_terbit` varchar(7) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 1,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `daftar_buku`
--

INSERT INTO `daftar_buku` (`kode_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, `status`) VALUES
('1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', 5, 'Tersedia'),
('2', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', 1, 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_buku`
--

CREATE TABLE `peminjaman_buku` (
  `id_peminjaman` int(11) NOT NULL,
  `kode_buku` varchar(25) NOT NULL,
  `judul_buku` varchar(50) DEFAULT NULL,
  `penulis` varchar(45) DEFAULT NULL,
  `penerbit` varchar(45) DEFAULT NULL,
  `tahun_terbit` varchar(7) DEFAULT NULL,
  `nis` char(9) NOT NULL,
  `nama_peminjam` varchar(35) DEFAULT NULL,
  `date` varchar(11) DEFAULT NULL,
  `due` varchar(11) DEFAULT NULL,
  `total_hari` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_buku`
--

CREATE TABLE `pengembalian_buku` (
  `id_pengembalian` int(11) NOT NULL,
  `kode_buku` varchar(25) DEFAULT NULL,
  `judul_buku` varchar(50) DEFAULT NULL,
  `penulis` varchar(45) DEFAULT NULL,
  `penerbit` varchar(45) DEFAULT NULL,
  `tahun_terbit` varchar(7) DEFAULT NULL,
  `nis` varchar(25) DEFAULT NULL,
  `nama_peminjam` varchar(35) DEFAULT NULL,
  `return_date` varchar(11) DEFAULT NULL,
  `elp` int(11) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengembalian_buku`
--

INSERT INTO `pengembalian_buku` (`id_pengembalian`, `kode_buku`, `judul_buku`, `penulis`, `penerbit`, `tahun_terbit`, `nis`, `nama_peminjam`, `return_date`, `elp`, `fine`) VALUES
(1, '1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', '31203921039', 'adam', '3002-03-12', 642094, 642093995),
(2, '1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', '31203921039', 'adam', '0001-01-01', 0, 0),
(3, '2', 'Contoh', 'Contoh', 'Contoh', '2000', '31203921039', 'adam', '0001-01-01', 0, 0),
(4, '1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', '31203921039', 'adam', '2025-12-25', 0, 0),
(5, '1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', '31203921039', 'adam', '2025-12-19', 1, 1000),
(6, '1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', '31203921039', 'adam', '2025-12-18', 0, 0),
(7, '1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', '31203921039', 'adam', '2025-12-26', 0, 0),
(8, '2', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', '123456789', 'test', '2025-12-21', 19, 38000),
(9, '1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', '123456789', 'test', '2025-12-31', 15, 30000),
(10, '2', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', '123456789', 'test', '2025-12-31', 5, 10000),
(11, '1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', '123456789', 'test', '2025-12-31', 14, 28000),
(12, '2', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', '123456789', 'test', '2025-12-31', 30, 60000),
(13, '2', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', '123456789', 'test', '2025-12-21', 12, 24000),
(14, '2', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', '123456789', 'test', '2025-12-21', 19, 38000),
(15, '1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2000', '123456789', 'test', '2025-12-25', 7, 14000),
(16, '2', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', '123456789', 'test', '2025-12-25', 6, 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota_perpus`
--
ALTER TABLE `anggota_perpus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_anggota_nis` (`nis`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD UNIQUE KEY `nis_2` (`nis`);

--
-- Indeks untuk tabel `daftar_buku`
--
ALTER TABLE `daftar_buku`
  ADD PRIMARY KEY (`kode_buku`);

--
-- Indeks untuk tabel `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `fk_peminjaman_buku` (`kode_buku`),
  ADD KEY `fk_peminjaman_anggota` (`nis`);

--
-- Indeks untuk tabel `pengembalian_buku`
--
ALTER TABLE `pengembalian_buku`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_perpus`
--
ALTER TABLE `anggota_perpus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_buku`
--
ALTER TABLE `pengembalian_buku`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD CONSTRAINT `anggota_perpus` FOREIGN KEY (`kode_buku`) REFERENCES `daftar_buku` (`kode_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_peminjaman_anggota` FOREIGN KEY (`nis`) REFERENCES `anggota_perpus` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_peminjaman_buku` FOREIGN KEY (`kode_buku`) REFERENCES `daftar_buku` (`kode_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kode_buku` FOREIGN KEY (`kode_buku`) REFERENCES `daftar_buku` (`kode_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
