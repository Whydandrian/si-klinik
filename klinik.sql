-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 04:24 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `biaya_pasien`
--

CREATE TABLE `biaya_pasien` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(10) NOT NULL,
  `kode_pasien` varchar(6) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `harga_obat` int(11) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biaya_pasien`
--

INSERT INTO `biaya_pasien` (`id`, `id_transaksi`, `kode_pasien`, `id_obat`, `harga_obat`, `jumlah`, `harga_total`) VALUES
(1, 'TRANS001', 'PSN001', 1, 10000, 2, 14000),
(2, 'TRANS002', 'PSN002', 11, 50000, 2, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `kode_layanan` varchar(8) NOT NULL,
  `nama_layanan` varchar(50) NOT NULL,
  `harga_layanan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `kode_layanan`, `nama_layanan`, `harga_layanan`) VALUES
(1, 'LYN001', 'Rawat Inap VVIP', '250000'),
(2, 'LYN002', 'Rawat Jalan', '15000'),
(3, 'LYN003', 'Rawat Inap Kelas', '150000'),
(5, 'LYN004', 'Pelayanan Diagnostik', '50000'),
(7, 'LYN005', 'Medical Checkup', '75000'),
(8, 'LYN006', 'Pelayanan IGD', '200000'),
(9, 'LYN007', 'Pelayanan ICU', '300000'),
(10, 'LYN008', 'Pelayanan Fisioterapi', '125000'),
(11, 'LYN009', 'Pelayanan Radiologi', '100000'),
(12, 'LYN010', 'Pelayanan Gizi', '75000'),
(13, 'LYN011', 'Pelayanan Umum', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `jenis_obat`) VALUES
(1, 'Paracetamol', 'tablet'),
(2, 'Amoxcilin', 'kapsul'),
(3, 'Bodrex Flu Batuk', 'tablet'),
(4, 'Metformin', 'tablet'),
(5, 'Acebutolol', 'Antiaritmia'),
(6, 'Adalimumab', 'Antipiretik'),
(7, 'Albumin', 'infus'),
(8, 'Remdesivir', 'antivirus'),
(9, 'Oxycodone', 'analgesik'),
(10, 'Mycophenolate Mofetil', 'immunosupresan'),
(11, 'Lysine dan Asam Amino Esensial Oral', 'suplemen'),
(12, 'Indinavir', 'antivirus'),
(13, 'Fondaparinux', 'antikoagulan'),
(14, 'Vitamin B Complex', 'vitamin'),
(15, 'Vitamin C', 'vitamin');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `kode_pasien` varchar(6) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `golongan_darah` varchar(2) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `jenis_pasien` varchar(15) NOT NULL,
  `alamat_pasien` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `kode_pasien`, `nama_pasien`, `jenis_kelamin`, `golongan_darah`, `telepon`, `jenis_pasien`, `alamat_pasien`) VALUES
(1, 'PSN001', 'Amirul Ihsan An Nabawi', 'laki-laki', 'o', '082336527765', 'baru', 'Jl. Ahmad Dahlan No. 12, Blok-D, Malang'),
(0, 'PSN002', 'Abdul Malik Hasibullah', 'Laki-laki', 'A', '081216930728', 'lama', 'Jl. Kenanga Indah No. 127A Blok C Barat, Kota Malang');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `pendidikan` varchar(15) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama_pegawai`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `jabatan`, `agama`, `alamat`, `pendidikan`, `foto`) VALUES
(1, 'Handoko', 'Laki-laki', '1996-12-11', 'Jakarta', 'Perawat', 'Islam', 'Jakarta', 'Dokter', 'user-default.png'),
(2, 'Budi Hartono', 'laki-laki', '1996-12-11', 'Probolinggo', 'Dokter Gigi', 'Islam', 'Bandung', 'Dokter', 'user-default.png'),
(3, 'Ilham Maulana Dedi Kusuma Negara', 'Laki-laki', '1996-12-11', 'Bandung', 'Admin pendaftaran', 'Islam', 'Jakarta', 'Dokter', 'user-default.png'),
(4, 'Meli Goelsaw', 'Perempuan', '1991-08-11', 'Semarang', 'Apoteker', 'Kristen', 'Jakarta', 'Dokter', 'user-default.png'),
(5, 'Jumhari', 'laki-laki', '1977-12-11', 'Pati', 'Dokter Kulit', 'Islam', 'Bandung', 'Dokter', 'user-default.png'),
(6, 'Husnaini', 'perempuan', '1987-11-11', 'Jember', 'Dokter Anak', 'Islam', 'Jember', 'Dokter', 'user-default.png'),
(7, 'Susi Pujiastuti', 'perempuan', '1990-10-11', 'Jakarta', 'Dokter Kandungan', 'Islam', 'Jakarta', 'Dokter', 'user-default.png'),
(8, 'I Gede Putut Raharja', 'laki-laki', '1989-12-11', 'Bali', 'Dokter Umum', 'Hindu', 'Bali', 'Dokter', 'user-default.png'),
(9, 'Kaliman Oktaviani', 'perempuan', '1991-02-11', 'Surabaya', 'Dokter Mata', 'Islam', 'Surabaya', 'Dokter', 'user-default.png'),
(10, 'Zaenal Abidin', 'laki-laki', '1995-09-11', 'Pasuruan', 'Dokter Penyakit Dalam', 'Islam', 'Pasuruan', 'Dokter', 'user-default.png'),
(11, 'Syahrullah Aminul Hasan', 'Laki-laki', '1992-10-11', 'Sidoarjo', 'CS', 'Islam', 'Sidoarjo', 'Dokter', 'user-default.png'),
(12, 'Cintya Anindya Bela', 'perempuan', '1993-12-11', 'Yogyakarta', 'Dokter Kandungan', 'Islam', 'Jakarta', 'Dokter', 'user-default.png'),
(14, 'Abdullah Muzakir', 'Laki-laki', '2006-08-07', 'Probolinggo', 'Admin Obat', 'Islam', 'Kalimantan', 'Sarjana', '2074526295_check-circle-solid-60.png');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `kode_daftar` varchar(6) NOT NULL,
  `kode_pasien` varchar(6) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `keluhan` varchar(250) NOT NULL,
  `kode_layanan` varchar(8) NOT NULL,
  `poli_tujuan` varchar(20) NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `kode_daftar`, `kode_pasien`, `tgl_daftar`, `keluhan`, `kode_layanan`, `poli_tujuan`, `keterangan`) VALUES
(1, 'REG001', 'PSN001', '2021-07-15', 'Sakit kepala cenat cenut bagian belakang, perut mual dan nafsu makan hilang', 'LYN011', 'Poli Umum', 'dalam rentan waktu 3 jam sering muntah'),
(2, 'REG002', 'PSN002', '2021-07-15', 'Rabun saat melihat objek di jarak 15 meter', 'LYN004', 'Poli Mata', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(4, 'Wahyudi', 'administrator', '0192023a7bbd73250516f069df18b500', 'admin'),
(5, 'Admin Bagian Pendaftaran', 'budiutomo', '97f3c717da19b4697ae9884e67aabce6', 'admin_daftar'),
(9, 'Meli Salsabila', 'salsabila', '8b63b2922634ffaeab2019e50f13dd20', 'admin_obat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_pasien`
--
ALTER TABLE `biaya_pasien`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_id` (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`kode_layanan`),
  ADD KEY `layanan_id` (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obat_id` (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`kode_pasien`),
  ADD KEY `pasien_id` (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_id` (`id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`kode_daftar`),
  ADD KEY `daftar_id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biaya_pasien`
--
ALTER TABLE `biaya_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
