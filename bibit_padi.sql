-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Des 2024 pada 14.04
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibit_padi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `alternatif_id` int NOT NULL,
  `nama_bibit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`alternatif_id`, `nama_bibit`) VALUES
(1, 'Inpari 22 '),
(2, 'CIHERANG SS'),
(3, 'CILIWUNG'),
(4, 'Inpari 32'),
(5, 'Inpari 42'),
(6, 'IR 64'),
(7, 'Inpari 19'),
(8, 'Inpari 30 Ciheran Sub 1'),
(9, 'Inpari 31'),
(10, 'Inpari 33'),
(11, 'Inpari 38 Tadah Hujan Agritan'),
(12, 'Inpari 39 Tadah Hujan Agritan'),
(13, 'Inpari 44'),
(14, 'CIHERANG JANGER'),
(15, 'Hibrida SL 8 SHS'),
(21, 'coba');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_informasi`
--

CREATE TABLE `detail_informasi` (
  `detail_informasi_id` int NOT NULL,
  `alternatif_id` int DEFAULT NULL,
  `ketahanan_hama_id` int DEFAULT NULL,
  `umur_padi` int DEFAULT NULL,
  `tinggi_padi` float DEFAULT NULL,
  `rata_hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_informasi`
--

INSERT INTO `detail_informasi` (`detail_informasi_id`, `alternatif_id`, `ketahanan_hama_id`, `umur_padi`, `tinggi_padi`, `rata_hasil`) VALUES
(1, 1, 5, 118, 103, 5.8),
(3, 2, 4, 122, 112, 10),
(4, 3, 4, 121, 101, 5),
(5, 4, 5, 120, 97, 6.3),
(6, 5, 5, 112, 93, 7.11),
(7, 6, 4, 115, 85, 5),
(8, 7, 4, 104, 102, 6.7),
(9, 8, 5, 111, 101, 7.2),
(10, 9, 3, 119, 104, 6),
(11, 10, 3, 100, 93, 6.6),
(16, 11, 5, 115, 94, 5.71),
(17, 12, 5, 115, 98, 5.89),
(18, 13, 5, 114, 104, 6.53),
(19, 14, 4, 110, 118, 10),
(20, 15, 5, 90, 111, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ketahanan_hama`
--

CREATE TABLE `ketahanan_hama` (
  `ketahanan_hama_id` int NOT NULL,
  `ketahanan_hama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `normalisasi` varchar(2555) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ketahanan_hama`
--

INSERT INTO `ketahanan_hama` (`ketahanan_hama_id`, `ketahanan_hama`, `normalisasi`) VALUES
(3, 'Tahan > 2 Tipe Hama', '4'),
(4, 'Tahan 1-2 Tipe Hama', '3'),
(5, 'Agak Tahan 1-3 Tipe Hama', '2'),
(6, 'Tidak Tahan Terhadap Hama', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kriteria_id` int NOT NULL,
  `kriteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int NOT NULL,
  `normalisasi_kriteria` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kriteria_id`, `kriteria`, `bobot`, `normalisasi_kriteria`) VALUES
(1, 'umur padi', 30, 0.3),
(2, 'tinggi padi', 10, 0.1),
(3, 'ketahanan terhadap hama', 20, 0.2),
(4, 'rata-rata hasil', 40, 0.4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_utility`
--

CREATE TABLE `nilai_utility` (
  `utility_id` int NOT NULL,
  `nilai_umur_padi` float NOT NULL,
  `nilai_tinggi_padi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_ketahanan_hama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_rata_hasil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_informasi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai_utility`
--

INSERT INTO `nilai_utility` (`utility_id`, `nilai_umur_padi`, `nilai_tinggi_padi`, `nilai_ketahanan_hama`, `nilai_rata_hasil`, `detail_informasi_id`) VALUES
(207, 0.125, '0.54545454545455', '0', '0.16', 1),
(208, 0, '0.81818181818182', '0.5', '1', 3),
(209, 0.03125, '0.48484848484848', '0.5', '0', 4),
(210, 0.0625, '0.36363636363636', '0', '0.26', 5),
(211, 0.3125, '0.24242424242424', '0', '0.422', 6),
(212, 0.21875, '0', '0.5', '0', 7),
(213, 0.5625, '0.51515151515152', '0.5', '0.34', 8),
(214, 0.34375, '0.48484848484848', '0', '0.44', 9),
(215, 0.09375, '0.57575757575758', '1', '0.2', 10),
(216, 0.6875, '0.24242424242424', '1', '0.32', 11),
(217, 0.21875, '0.27272727272727', '0', '0.142', 16),
(218, 0.21875, '0.39393939393939', '0', '0.178', 17),
(219, 0.25, '0.57575757575758', '0', '0.306', 18),
(220, 0.375, '1', '0.5', '1', 19),
(221, 1, '0.78787878787879', '0', '1', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rangking`
--

CREATE TABLE `rangking` (
  `rangking_id` int NOT NULL,
  `utility_id` int DEFAULT NULL,
  `hasil_akhir` float DEFAULT NULL,
  `kriteria_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rangking`
--

INSERT INTO `rangking` (`rangking_id`, `utility_id`, `hasil_akhir`, `kriteria_id`) VALUES
(787, 207, 0.156045, 1),
(788, 208, 0.581818, 1),
(789, 209, 0.15786, 1),
(790, 210, 0.159114, 1),
(791, 211, 0.286792, 1),
(792, 212, 0.165625, 1),
(793, 213, 0.456265, 1),
(794, 214, 0.32761, 1),
(795, 215, 0.365701, 1),
(796, 216, 0.558492, 1),
(797, 217, 0.149698, 1),
(798, 218, 0.176219, 1),
(799, 219, 0.254976, 1),
(800, 220, 0.7125, 1),
(801, 221, 0.778788, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Visitor') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `nama`, `role`) VALUES
(6, 'yudha', 'yudha@gmail.com', '8ea08b838ecd36615e845ff35501e8c8', 'YUDHA CAESAR MAULANA', 'Visitor'),
(7, 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`alternatif_id`);

--
-- Indeks untuk tabel `detail_informasi`
--
ALTER TABLE `detail_informasi`
  ADD PRIMARY KEY (`detail_informasi_id`),
  ADD KEY `FK_ALTERNATIF_TO_INFORMASI` (`alternatif_id`),
  ADD KEY `FK_KETAHANAN_TO_INFORMASI` (`ketahanan_hama_id`);

--
-- Indeks untuk tabel `ketahanan_hama`
--
ALTER TABLE `ketahanan_hama`
  ADD PRIMARY KEY (`ketahanan_hama_id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kriteria_id`);

--
-- Indeks untuk tabel `nilai_utility`
--
ALTER TABLE `nilai_utility`
  ADD PRIMARY KEY (`utility_id`),
  ADD KEY `FK_DETAIL_INFORMASI_TO_UTILITY` (`detail_informasi_id`);

--
-- Indeks untuk tabel `rangking`
--
ALTER TABLE `rangking`
  ADD PRIMARY KEY (`rangking_id`),
  ADD KEY `FK_ALTERNATIF_TO_RANGKING` (`utility_id`),
  ADD KEY `FK_Kriteria_To_Rangking` (`kriteria_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `alternatif_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `detail_informasi`
--
ALTER TABLE `detail_informasi`
  MODIFY `detail_informasi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `ketahanan_hama`
--
ALTER TABLE `ketahanan_hama`
  MODIFY `ketahanan_hama_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `kriteria_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `nilai_utility`
--
ALTER TABLE `nilai_utility`
  MODIFY `utility_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT untuk tabel `rangking`
--
ALTER TABLE `rangking`
  MODIFY `rangking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=810;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_informasi`
--
ALTER TABLE `detail_informasi`
  ADD CONSTRAINT `FK_ALTERNATIF_TO_INFORMASI` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`alternatif_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_KETAHANAN_TO_INFORMASI` FOREIGN KEY (`ketahanan_hama_id`) REFERENCES `ketahanan_hama` (`ketahanan_hama_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_utility`
--
ALTER TABLE `nilai_utility`
  ADD CONSTRAINT `FK_DETAIL_INFORMASI_TO_UTILITY` FOREIGN KEY (`detail_informasi_id`) REFERENCES `detail_informasi` (`detail_informasi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rangking`
--
ALTER TABLE `rangking`
  ADD CONSTRAINT `FK_Kriteria_To_Rangking` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`kriteria_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UTILITY_TO_RANKING` FOREIGN KEY (`utility_id`) REFERENCES `nilai_utility` (`utility_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
