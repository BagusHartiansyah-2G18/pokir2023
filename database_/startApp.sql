-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jan 2024 pada 16.43
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_usulan`
--

CREATE TABLE `daftar_usulan` (
  `kdUsulan` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdUser` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idKusulan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdLing` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hargaT` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `satuanT` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `penerima` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rt` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahapan` int(3) NOT NULL,
  `tahun` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `daftar_usulan`
--

INSERT INTO `daftar_usulan` (`kdUsulan`, `kdUser`, `idKusulan`, `kdLing`, `volume`, `hargaT`, `satuanT`, `penerima`, `rt`, `rw`, `catatan`, `created_at`, `updated_at`, `tahapan`, `tahun`) VALUES
('1', '01.13.00', '7', '2|D09|7.01.0.00.0.00.02.0000', '120', '0', '0', NULL, '1', '1', NULL, NULL, NULL, 1, 2025),
('1', '01.13.00', '7', '2|D09|7.01.0.00.0.00.02.0000', '120', '0', '0', NULL, '1', '1', NULL, NULL, NULL, 2, 2025);

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa`
--

CREATE TABLE `desa` (
  `kdDesa` varchar(30) NOT NULL,
  `kdKec` varchar(30) NOT NULL,
  `nmDesa` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `desa`
--

INSERT INTO `desa` (`kdDesa`, `kdKec`, `nmDesa`) VALUES
('D01', '7.01.0.00.0.00.01.0000', 'ARAB KENANGAN'),
('D01', '7.01.0.00.0.00.02.0000', 'AIR SUNING'),
('D01', '7.01.0.00.0.00.03.0000', 'BENETE'),
('D01', '7.01.0.00.0.00.04.0000', 'RARAK RONGES'),
('D01', '7.01.0.00.0.00.05.0000', 'MATAIYANG'),
('D01', '7.01.0.00.0.00.06.0000', 'KIANTAR'),
('D01', '7.01.0.00.0.00.07.0000', 'AI KANGKUNG'),
('D01', '7.01.0.00.0.00.08.0000', 'DASAN ANYAR'),
('D02', '7.01.0.00.0.00.01.0000', 'BANJAR'),
('D02', '7.01.0.00.0.00.02.0000', 'DESA LOKA'),
('D02', '7.01.0.00.0.00.03.0000', 'BUKIT DAMAI'),
('D02', '7.01.0.00.0.00.04.0000', 'BANGKAT MONTEH'),
('D02', '7.01.0.00.0.00.05.0000', 'KALIMANTONG'),
('D02', '7.01.0.00.0.00.06.0000', 'KOKARLIAN'),
('D02', '7.01.0.00.0.00.07.0000', 'KEMUNING'),
('D02', '7.01.0.00.0.00.08.0000', 'GOA'),
('D03', '7.01.0.00.0.00.01.0000', 'LAMUNGA'),
('D03', '7.01.0.00.0.00.02.0000', 'KELANIR'),
('D03', '7.01.0.00.0.00.03.0000', 'MALUK'),
('D03', '7.01.0.00.0.00.04.0000', 'LAMUNTET'),
('D03', '7.01.0.00.0.00.05.0000', 'LAMPOK'),
('D03', '7.01.0.00.0.00.06.0000', 'MANTAR'),
('D03', '7.01.0.00.0.00.07.0000', 'SEKONGKANG ATAS'),
('D03', '7.01.0.00.0.00.08.0000', 'BELO'),
('D04', '7.01.0.00.0.00.01.0000', 'BATU PUTIH'),
('D04', '7.01.0.00.0.00.02.0000', 'LAMUSUNG'),
('D04', '7.01.0.00.0.00.03.0000', 'MANTUN'),
('D04', '7.01.0.00.0.00.04.0000', 'MOTENG'),
('D04', '7.01.0.00.0.00.05.0000', 'MANEMENG'),
('D04', '7.01.0.00.0.00.06.0000', 'POTO TANO'),
('D04', '7.01.0.00.0.00.07.0000', 'SEKONGKANG BAWAH'),
('D04', '7.01.0.00.0.00.08.0000', 'BERU'),
('D05', '7.01.0.00.0.00.01.0000', 'BUGIS'),
('D05', '7.01.0.00.0.00.02.0000', 'MERARAN'),
('D05', '7.01.0.00.0.00.03.0000', 'PASIR PUTIH'),
('D05', '7.01.0.00.0.00.04.0000', 'TEPAS'),
('D05', '7.01.0.00.0.00.05.0000', 'MUJAHIDDIN'),
('D05', '7.01.0.00.0.00.06.0000', 'SENAYAN'),
('D05', '7.01.0.00.0.00.07.0000', 'TALONANG'),
('D06', '7.01.0.00.0.00.01.0000', 'DALAM'),
('D06', '7.01.0.00.0.00.02.0000', 'REMPE'),
('D06', '7.01.0.00.0.00.04.0000', 'TEPAS SEPAKAT'),
('D06', '7.01.0.00.0.00.05.0000', 'MURA'),
('D06', '7.01.0.00.0.00.06.0000', 'TEBO'),
('D06', '7.01.0.00.0.00.07.0000', 'TATAR'),
('D07', '7.01.0.00.0.00.01.0000', 'KUANG'),
('D07', '7.01.0.00.0.00.02.0000', 'SERAN'),
('D07', '7.01.0.00.0.00.04.0000', 'DESA BERU'),
('D07', '7.01.0.00.0.00.06.0000', 'TUA NANGA'),
('D07', '7.01.0.00.0.00.07.0000', 'TONGO'),
('D08', '7.01.0.00.0.00.01.0000', 'KERTASARI'),
('D08', '7.01.0.00.0.00.02.0000', 'SETELUK ATAS'),
('D08', '7.01.0.00.0.00.04.0000', 'SEMINAR SALIT'),
('D08', '7.01.0.00.0.00.06.0000', 'UPT. TAMBAK SARI'),
('D09', '7.01.0.00.0.00.01.0000', 'LABU LALAR'),
('D09', '7.01.0.00.0.00.02.0000', 'SETELUK TENGAH'),
('D09', '7.01.0.00.0.00.04.0000', 'SAPUGARA BREE'),
('D10', '7.01.0.00.0.00.01.0000', 'LALAR LIANG'),
('D10', '7.01.0.00.0.00.02.0000', 'TAPIR'),
('D11', '7.01.0.00.0.00.01.0000', 'MENALA'),
('D12', '7.01.0.00.0.00.01.0000', 'SAMPIR'),
('D13', '7.01.0.00.0.00.01.0000', 'SELOTO'),
('D14', '7.01.0.00.0.00.01.0000', 'SERMONG'),
('D15', '7.01.0.00.0.00.01.0000', 'TAMEKAN'),
('D16', '7.01.0.00.0.00.01.0000', 'TELAGA BERTONG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dinas`
--

CREATE TABLE `dinas` (
  `kdDinas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmDinas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dinas`
--

INSERT INTO `dinas` (`kdDinas`, `nmDinas`, `created_at`, `updated_at`) VALUES
('1.01.2.22.0.00.01.0000', 'DINAS PENDIDIKAN DAN KEBUDAYAAN', NULL, NULL),
('1.02.0.00.0.00.01.0000', 'DINAS KESEHATAN', NULL, NULL),
('1.02.0.00.0.00.01.0001', 'PUSKESMAS POTO TANO', NULL, NULL),
('1.02.0.00.0.00.01.0002', 'PUSKESMAS JEREWEH', NULL, NULL),
('1.02.0.00.0.00.01.0003', 'PUSKESMAS SETELUK', NULL, NULL),
('1.02.0.00.0.00.01.0004', 'PUSKESMAS BRANG REA', NULL, NULL),
('1.02.0.00.0.00.01.0005', 'PUSKESMAS BRANG ENE', NULL, NULL),
('1.02.0.00.0.00.01.0006', 'PUSKESMAS SEKONGKANG', NULL, NULL),
('1.02.0.00.0.00.01.0007', 'PUSKESMAS TALIWANG', NULL, NULL),
('1.02.0.00.0.00.01.0008', 'PUSKESMAS TONGO', NULL, NULL),
('1.02.0.00.0.00.01.0009', 'PUSKESMAS MALUK', NULL, NULL),
('1.02.0.00.0.00.02.0000', 'RUMAH SAKIT UMUM DAERAH ASY-SYIFA', NULL, NULL),
('1.03.1.04.0.00.01.0000', 'DINAS PEKERJAAN UMUM DAN PENATAAN RUANG', NULL, NULL),
('1.04.0.00.0.00.01.0000', 'DINAS PERUMAHAN DAN PERMUKIMAN', NULL, NULL),
('1.05.0.00.0.00.01.0000', 'SATUAN POLISI PAMONG PRAJA', NULL, NULL),
('1.05.0.00.0.00.02.0000', 'DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN', NULL, NULL),
('1.05.0.00.0.00.03.0000', 'BADAN PENANGGULANGAN BENCANA DAERAH', NULL, NULL),
('1.06.0.00.0.00.01.0000', 'DINAS SOSIAL', NULL, NULL),
('2.07.3.32.0.00.01.0000', 'DINAS TENAGA KERJA DAN TRANSMIGRASI', NULL, NULL),
('2.08.2.14.0.00.01.0000', 'DINAS PENGENDALIAN PENDUDUK KELUARGA BERENCANA PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK', NULL, NULL),
('2.09.0.00.0.00.01.0000', 'DINAS KETAHANAN PANGAN', NULL, NULL),
('2.11.0.00.0.00.01.0000', 'DINAS LINGKUNGAN HIDUP', NULL, NULL),
('2.12.0.00.0.00.01.0000', 'DINAS KEPENDUDUKAN PENCATATAN SIPIL', NULL, NULL),
('2.13.0.00.0.00.01.0000', 'DINAS PEMBERDAYAAN MASYARAKAT DAN DESA', NULL, NULL),
('2.15.0.00.0.00.01.0000', 'DINAS PERHUBUNGAN', NULL, NULL),
('2.16.2.20.2.21.01.0000', 'DINAS KOMUNIKASI DAN INFORMATIKA', NULL, NULL),
('2.17.3.30.3.31.01.0000', 'DINAS KOPERASI PERINDUSTRIAN DAN PERDAGANGAN', NULL, NULL),
('2.18.0.00.0.00.01.0000', 'DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU', NULL, NULL),
('2.24.2.23.0.00.01.0000', 'DINAS KEARSIPAN DAN PERPUSTAKAAN', NULL, NULL),
('3.25.0.00.0.00.01.0000', 'DINAS PERIKANAN', NULL, NULL),
('3.26.2.19.0.00.01.0000', 'DINAS PARIWISATA PEMUDA DAN OLAHRAGA', NULL, NULL),
('3.27.0.00.0.00.01.0000', 'DINAS PERTANIAN', NULL, NULL),
('4.01.2.10.0.00.01.0000', 'SEKRETARIAT DAERAH', NULL, NULL),
('4.02.0.00.0.00.01.0000', 'SEKRETARIAT DPRD', NULL, NULL),
('5.01.5.05.0.00.01.0000', 'BADAN PERENCANAAN PEMBANGUNAN DAERAH', NULL, NULL),
('5.02.0.00.0.00.01.0000', 'BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH', NULL, NULL),
('5.02.0.00.0.00.02.0000', 'BADAN PENDAPATAN DAERAH', NULL, NULL),
('5.03.5.04.0.00.01.0000', 'BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA', NULL, NULL),
('5.05.0.00.0.00.01.0000', 'BADAN RISET DAN INOVASI DAERAH', NULL, NULL),
('6.01.0.00.0.00.01.0000', 'INSPEKTORAT DAERAH', NULL, NULL),
('7.01.0.00.0.00.01.0000', 'KECAMATAN TALIWANG', NULL, NULL),
('7.01.0.00.0.00.01.0001', 'KELURAHAN KUANG', NULL, NULL),
('7.01.0.00.0.00.01.0002', 'KELURAHAN SAMPIR', NULL, NULL),
('7.01.0.00.0.00.01.0003', 'KELURAHAN MENALA', NULL, NULL),
('7.01.0.00.0.00.01.0004', 'KELURAHAN DALAM', NULL, NULL),
('7.01.0.00.0.00.01.0005', 'KELURAHAN BUGIS', NULL, NULL),
('7.01.0.00.0.00.01.0006', 'KELURAHAN TELAGA BERTONG', NULL, NULL),
('7.01.0.00.0.00.01.0007', 'KELURAHAN ARAB KENANGAN', NULL, NULL),
('7.01.0.00.0.00.02.0000', 'KECAMATAN SETELUK', NULL, NULL),
('7.01.0.00.0.00.03.0000', 'KECAMATAN MALUK', NULL, NULL),
('7.01.0.00.0.00.04.0000', 'KECAMATAN BRANG REA', NULL, NULL),
('7.01.0.00.0.00.05.0000', 'KECAMATAN BRANG ENE', NULL, NULL),
('7.01.0.00.0.00.06.0000', 'KECAMATAN POTO TANO', NULL, NULL),
('7.01.0.00.0.00.07.0000', 'KECAMATAN SEKONGKANG', NULL, NULL),
('7.01.0.00.0.00.08.0000', 'KECAMATAN JEREWEH', NULL, NULL),
('8.01.0.00.0.00.01.0000', 'BADAN KESATUAN BANGSA DAN POLITIK', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamus_usulan`
--

CREATE TABLE `kamus_usulan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nmUsulan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdDinas` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kamus_usulan`
--

INSERT INTO `kamus_usulan` (`id`, `nmUsulan`, `satuan`, `harga`, `kdDinas`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'PENINGKATAN JALAN LINGKUNGAN', 'METER', '1000000', '1.03.1.04.0.00.01.0000', 'fisik', '2023-06-03 08:58:10', '2023-06-03 08:58:10'),
(5, 'HIBAH UANG', 'PAKET', '0', '4.01.2.10.0.00.01.0000', 'hibah', '2023-06-04 03:04:22', '2023-06-04 03:04:22'),
(7, 'Peningkatan Jalan Lingkungan', 'Meter', '0', '1.04.0.00.0.00.01.0000', 'fisik', '2024-01-19 06:12:03', '2024-01-19 06:12:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
--

CREATE TABLE `keuangan` (
  `kdUang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdPengirim` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdPenerima` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `keterangan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keuangan`
--

INSERT INTO `keuangan` (`kdUang`, `kdPengirim`, `kdPenerima`, `nominal`, `aktif`, `keterangan`, `created_at`, `updated_at`) VALUES
('1', '000000', '01.13.00', '500000000', '1', '-', '2023-06-05 17:32:07', NULL),
('1', '111111', '000000', '5000000000', '1', '-', '2023-06-05 17:29:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lingkungan`
--

CREATE TABLE `lingkungan` (
  `kdLing` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdDesa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdKec` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmLing` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lingkungan`
--

INSERT INTO `lingkungan` (`kdLing`, `kdDesa`, `kdKec`, `nmLing`, `created_at`, `updated_at`) VALUES
('1', 'D09', '7.01.0.00.0.00.02.0000', 'SELAYAR', '2023-06-03 13:14:52', NULL),
('2', 'D09', '7.01.0.00.0.00.02.0000', 'MANDAR', '2023-06-03 14:18:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_31_061127_create_timer', 2),
(6, '2023_05_31_061252_create_keuangan', 2),
(7, '2023_05_31_061338_create_lingkungan', 2),
(8, '2023_05_31_061524_create_dinas', 2),
(9, '2023_05_31_090124_create_desa', 2),
(10, '2023_05_31_090228_create_kecamatan', 2),
(11, '2023_06_03_065036_create_kamus_usulan', 3),
(12, '2023_06_03_065155_create_daftar_usulan', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `timer`
--

CREATE TABLE `timer` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateS` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateE` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeS` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeE` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `kdUser` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `timer`
--

INSERT INTO `timer` (`id`, `judul`, `dateS`, `dateE`, `timeS`, `timeE`, `keterangan`, `aktif`, `kdUser`, `created_at`, `updated_at`) VALUES
(8, 'penginputan pokir', '2024-01-18', '2024-01-25', '00:00', '00:00', '1', '1', 'MDAwMDAw', '2023-06-05 15:29:17', '2024-01-20 08:27:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `kdUser` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdJaba` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `act` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`kdUser`, `name`, `username`, `password`, `kdJaba`, `remember_token`, `created_at`, `updated_at`, `act`) VALUES
('000000', 'PEMDA KSB', '0.0.0.', 'O6i12g1', '6', NULL, '2023-06-01 13:15:07', '2023-06-01 13:15:07', 0),
('01.13.00', 'AMIRUDDIN, S.E.', '01.13.00', 'WONVBR', '1', NULL, NULL, NULL, 1),
('01.14.12', 'ANDI LAWENG, S.H.,M.H.', '01.14.12', 'Dp6BUa', '1', NULL, NULL, NULL, 1),
('11.15.16', 'KONDI PRANATA', '11.15.16', '6vq0Cp', '1', NULL, NULL, NULL, 1),
('111111', 'BUPATI KSB', '1.1.1.', 'WzRg1j', '7', NULL, NULL, NULL, 1),
('13.15.08', 'MOHAMMAD HATTA', '13.15.08', 'ZckC7w', '1', NULL, NULL, NULL, 1),
('13.21.00', 'MUSTAPA, HZ.', '13.21.00', 'NhP90V', '1', NULL, NULL, NULL, 1),
('13.21.14', 'MUHAMMAD NUR, S.H.', '13.21.14', 'Sbg5YT', '1', NULL, NULL, NULL, 1),
('13.21.19', 'MUHAMMAD SALEH, S.E.', '13.21.19', 'Ny4rSs', '1', NULL, NULL, NULL, 1),
('13.21.25', 'MUHAMMAD YAMIN', '13.21.25', 'wcb0x0', '1', NULL, NULL, NULL, 1),
('14.21.00', 'NURJANNAH', '14.21.00', '7mHc6p', '1', NULL, NULL, NULL, 1),
('19.21.00', 'SUDARLI, S.Pd.', '19.21.00', '1iPcwA', '1', NULL, NULL, NULL, 1),
('19.25.00', 'Drs. SYAFRUDDIN, M.Si.', '19.25.00', 'ligPBc', '1', NULL, NULL, NULL, 1),
('22221', 'Tim Verifikasi SETWAN', '2.2.2.1', 'a2h53h', '2', NULL, '2023-06-01 13:15:07', '2023-06-01 13:15:07', 1),
('22222', 'Tim Verifikasi TAPD', '2.2.2.2', 't6n18b', '3', NULL, '2023-06-01 13:15:07', '2023-06-01 13:15:07', 1),
('36527', 'BAHARUNG', '36527', '346KoF', '1', NULL, NULL, NULL, 1),
('36533', 'HASANUDDIN', '36533', 'UHvS5q', '1', NULL, NULL, NULL, 1),
('36538', 'MASADI, S.E.', '36538', 'FIgaAA', '1', NULL, NULL, NULL, 1),
('36545', 'TAUFIQURRAHMAN', '36545', 'm7dOI8', '1', NULL, NULL, NULL, 1),
('36659', 'MERLIZA, S.Sos.I., MM', '36659', 'rAqbo4', '1', NULL, NULL, NULL, 1),
('36708', 'AGUSFIAN, S.E.', '36708', '6VTgyw', '1', NULL, NULL, NULL, 1),
('36739', 'AHMAD, S.Ag.', '36739', 'svMCDY', '1', NULL, NULL, NULL, 1),
('36787', 'H.RIYADI, S.E.', '36787', 'h283yX', '1', NULL, NULL, NULL, 1),
('36839', 'IKHWANSYAH', '36839', 'uTtBXp', '1', NULL, NULL, NULL, 1),
('39479', 'ABDUL HAMAN', '39479', 'wTEq80', '1', NULL, NULL, NULL, 1),
('40921', 'MANCAWARI, LM.,S.IP', '40921', 'Q0qndl', '1', NULL, NULL, NULL, 1),
('41671', 'ABIDIN NASAR, S.P.,M.P', '41671', 'DHiiOh', '1', NULL, NULL, NULL, 1),
('43678', 'AHERUDDIN, S.E.,M.E..', '43678', 'SzFEPc', '1', NULL, NULL, NULL, 1),
('44207', 'KAHARUDDIN UMAR', '44207', 'YTC87M', '1', NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar_usulan`
--
ALTER TABLE `daftar_usulan`
  ADD PRIMARY KEY (`kdUsulan`,`kdUser`,`tahapan`,`tahun`);

--
-- Indeks untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`kdDesa`,`kdKec`);

--
-- Indeks untuk tabel `dinas`
--
ALTER TABLE `dinas`
  ADD PRIMARY KEY (`kdDinas`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kamus_usulan`
--
ALTER TABLE `kamus_usulan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`kdUang`,`kdPengirim`);

--
-- Indeks untuk tabel `lingkungan`
--
ALTER TABLE `lingkungan`
  ADD PRIMARY KEY (`kdLing`,`kdDesa`,`kdKec`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `timer`
--
ALTER TABLE `timer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`kdUser`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kamus_usulan`
--
ALTER TABLE `kamus_usulan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `timer`
--
ALTER TABLE `timer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
