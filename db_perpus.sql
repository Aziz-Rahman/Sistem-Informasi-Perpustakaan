-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2016 at 04:17 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `anggota_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_identitas` enum('KTP','SIM','Kartu Pelajar','Kartu Mahasiswa') NOT NULL,
  `no_identitas` varchar(20) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat_asal` varchar(100) NOT NULL,
  `alamat_saat_ini` varchar(100) NOT NULL,
  `jenis_anggota` enum('Pelajar','Mahasiswa','Umum') NOT NULL,
  `nama_institusi` varchar(50) NOT NULL,
  `alamat_institusi` varchar(100) NOT NULL,
  `deposit` int(11) NOT NULL,
  `tgl_pendaftaran` date NOT NULL,
  PRIMARY KEY (`anggota_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`anggota_id`, `jenis_identitas`, `no_identitas`, `nama_lengkap`, `jenis_kelamin`, `no_telp`, `email`, `alamat_asal`, `alamat_saat_ini`, `jenis_anggota`, `nama_institusi`, `alamat_institusi`, `deposit`, `tgl_pendaftaran`) VALUES
(1, 'Kartu Mahasiswa', '1233', 'Gogon Ska', 'L', '087755664444', 'gogon_ska@email.com', 'Semarang', 'Jakarta Pusat', 'Pelajar', 'SMK Bisa Bisa Aja', 'Jakarta', 0, '2016-03-05'),
(3, 'Kartu Mahasiswa', '787878787878', 'Mirna', 'P', '089888555444', 'mrrer@gmail.com', 'Semarang', 'Jakarta Pusat', 'Mahasiswa', 'UNJ', 'Jakarta', 0, '2016-04-08'),
(4, 'Kartu Mahasiswa', '323253543656', 'Chika', 'P', '089888777668', 'chika@umail.com', 'Tegal', 'Jakarta Pusat', 'Umum', 'PT cHIKAdfdf', 'Jakarta', 0, '2015-04-06'),
(6, 'SIM', '54654654645', 'Rere korona', 'P', '087888998776', 'rere@ymail.com', 'Bogor', 'Jakarta', 'Pelajar', 'SMK Soleh deh', 'Jakarta', 0, '2016-04-14'),
(7, 'Kartu Mahasiswa', '123232323232243', 'Marlin Oke', 'L', '089888777999', 'marlin@gmail.com', 'Tegal', 'Jakarta', 'Mahasiswa', 'STMIK Nusa Mandiri', 'Cengkareng', 0, '2016-04-17'),
(8, 'Kartu Mahasiswa', '777787898', 'Jhoni Dep', 'L', '089866777765', 'jhon@gmail.com', 'Surabaya', 'Cilacap', 'Pelajar', 'SMK Soleh', 'Bekasi', 100000, '2016-04-17'),
(9, 'SIM', '666666666666666', 'Mesyi ajah', 'P', '089866337765', 'mesyi@gmail.com', 'Surabaya', 'Bogor', 'Mahasiswa', 'Ui', 'Bogor', 100000, '2016-04-17'),
(10, 'Kartu Mahasiswa', '7887878787', 'Jany', 'P', '081222343555', 'jany@gmail.com', 'Surakarta', 'Jakarta', 'Mahasiswa', 'Universitas Surakarta', 'Surakarta', 0, '2016-04-23'),
(11, 'Kartu Mahasiswa', '8888787879', 'Tea', 'P', '089777888776', 'tea@ymail.com', 'Sukabumi', 'Jakarta', 'Pelajar', 'SMP yoi', 'Jakarta Selatan', 0, '2016-04-23'),
(12, 'Kartu Mahasiswa', '11156655', 'Marjono Suherman', 'L', '089888999999', 'marjono@yahoo.co.id', 'Bintaro', 'Pluit', 'Mahasiswa', 'Nusa Mandiri', 'Cengkareng', 100000, '2016-04-25'),
(13, 'Kartu Pelajar', '8787878787', 'Ticka Anastasya', 'P', '089888777666', 'tc@ymail.com', 'Bandung', 'Cengkareng', 'Umum', 'PT. Imut dan Manis', 'Jakarta Barat', 100000, '2016-05-01'),
(14, 'KTP', '1111111111111', 'Ugi Handayani', 'P', '089888777888', 'ugi_h@gmail.com', 'Tegal', 'Jakarta Barat', 'Umum', 'PT. Karya Bangsa', 'Jakarta Pusat', 100000, '2016-05-01'),
(15, 'KTP', '3172000000000', 'hardi', 'L', '0856789123', 'srihardi@yahoo.com', 'jakarta', 'budi muli no12', 'Mahasiswa', 'bsi cengkareng', 'cengkareng', 1000000, '2016-05-02'),
(16, 'KTP', '2313', 'zdfdf', 'L', '3424234', 'dfsdf', 'sdfdsf', 'sdfsd', 'Pelajar', 'afafa', 'dfsaf', 3423424, '2016-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `buku_id` varchar(20) NOT NULL,
  `buku_judul` varchar(100) NOT NULL,
  `kategori_id` int(3) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `deskripsi_fisik` varchar(100) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `buku_deskripsi` text NOT NULL,
  `buku_jumlah` int(11) NOT NULL,
  `buku_cover` varchar(15) NOT NULL,
  PRIMARY KEY (`buku_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`buku_id`, `buku_judul`, `kategori_id`, `penulis`, `penerbit`, `deskripsi_fisik`, `isbn`, `buku_deskripsi`, `buku_jumlah`, `buku_cover`) VALUES
('B04160000000001', 'Trik Kolaborasi Android dengan PHP Mysql', 2, 'Awan Pribadi Basuki', 'Lokomedia', '238 Halaman, 14 x 21 cm', '978-602-14306-4-4', 'Trik Kolaborasi Android dengan PHP Mysql', 999, 'book_5gafn.jpg'),
('B04160000000002', '10 Pengusaha Sukses', 5, 'Sudarmadi', 'Erlangga', '32 lmbr', '222', '10 Pengusaha sukses dari 0', 1000, 'book_l0eyj.jpg'),
('B04160000000003', 'Belajar data base menggunakan MYSQL', 1, 'Agil Suparman', 'Erlangga', '553 Lembar, 18 x 11', '123-3421-651-1-1', 'Belajar data base menggunakan MYSQL', 1000, 'book_l0qb7.jpg'),
('B04160000000004', 'Bahasa Arab Otodidak', 7, 'Abah', 'Maxikom', '45LEMBAR', '887-877-8688', 'Panduan lengkap bahasa arab otodidak', 1001, 'book_3b1lv.jpg'),
('B04160000000005', 'belajar komputer', 1, 'Ardi', 'Erlangga', '232 lmbr ', '2323232323211666', 'Panduan Praktis Belajar Komputer', 1000, 'book_7avhz.jpg'),
('B05160000000006', 'Belajar Masak', 4, 'Fikri Hartono', 'Erlangga', '200 Lembar, Dimensi: 12 x 14 cm', '111-23-112-111', 'Cara cepat belajar masak', 1000, 'book_jgabv.jpg'),
('B05160000000007', 'Membangun website dengan php dan angular js', 1, 'Jhonson', 'Maxikom', '156 Lembar Dimensi: 22 x 14 cm', '232-123-222-111', 'Keren bingit bro', 1000, 'book_aal8r.jpg'),
('B05160000000008', 'Mengenal Ajax', 1, 'Soerarso', 'Bunafit', '168 Lembar, Dimensi: 23 x 14 cm', '444-333-432-322', 'Dahsyatnya menggunakan ajax', 1000, 'book_63u82.jpg'),
('B05160000000009', 'Membuat Animasi dengan Canvas HTML5', 1, 'Markotop', 'OneDay', '260 Lembar, Dimensi: 23 x 15 cm', '555-234-333-111', 'Kecanggihan Canvas html 5', 1001, 'book_ochb9.jpg'),
('B06160000000010', 'Studi kelayakan bisnis dan investasi', 5, 'Freddy Rangkuti', 'Airlangga', '270 Lembar, Dimensi 20 Cm X 15 Cm', '', 'Studi kelayakan bisnis dan investasi', 130, 'book_si7if.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE IF NOT EXISTS `detail_peminjaman` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(15) NOT NULL,
  `buku_id` varchar(20) NOT NULL,
  `session_id` varchar(30) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=505 ;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`no`, `id_peminjaman`, `buku_id`, `session_id`) VALUES
(380, 16051, 'B04160000000005', 'b6ij44bevctkle02fsnq9prvl7'),
(381, 16051, 'B04160000000003', 'b6ij44bevctkle02fsnq9prvl7'),
(382, 16052, 'B04160000000001', 'b6ij44bevctkle02fsnq9prvl7'),
(383, 16053, 'B04160000000002', 'b6ij44bevctkle02fsnq9prvl7'),
(384, 16053, 'B04160000000005', 'b6ij44bevctkle02fsnq9prvl7'),
(385, 16053, 'B04160000000003', 'b6ij44bevctkle02fsnq9prvl7'),
(386, 16054, 'B04160000000003', 'b6ij44bevctkle02fsnq9prvl7'),
(387, 16055, 'B04160000000005', 'b6ij44bevctkle02fsnq9prvl7'),
(388, 16056, 'B04160000000004', 'b6ij44bevctkle02fsnq9prvl7'),
(389, 16057, 'B04160000000003', 'b6ij44bevctkle02fsnq9prvl7'),
(390, 16058, 'B04160000000004', 'b6ij44bevctkle02fsnq9prvl7'),
(391, 16058, 'B04160000000002', 'b6ij44bevctkle02fsnq9prvl7'),
(392, 16058, 'B04160000000001', 'b6ij44bevctkle02fsnq9prvl7'),
(393, 16051, 'B04160000000005', 'b6ij44bevctkle02fsnq9prvl7'),
(394, 16051, 'B04160000000003', 'b6ij44bevctkle02fsnq9prvl7'),
(395, 16052, 'B04160000000004', 'b6ij44bevctkle02fsnq9prvl7'),
(396, 16053, 'B04160000000002', 'b6ij44bevctkle02fsnq9prvl7'),
(397, 16053, 'B04160000000001', 'b6ij44bevctkle02fsnq9prvl7'),
(398, 16053, 'B04160000000005', 'b6ij44bevctkle02fsnq9prvl7'),
(399, 16054, 'B04160000000004', 'b6ij44bevctkle02fsnq9prvl7'),
(400, 16054, 'B04160000000003', 'b6ij44bevctkle02fsnq9prvl7'),
(401, 16055, 'B04160000000003', 'b6ij44bevctkle02fsnq9prvl7'),
(402, 16056, 'B04160000000004', 'b6ij44bevctkle02fsnq9prvl7'),
(403, 16056, 'B04160000000005', 'b6ij44bevctkle02fsnq9prvl7'),
(404, 16057, 'B04160000000003', '3gh2ntm9s1dku42m33qv750ok0'),
(405, 16057, 'B04160000000001', '3gh2ntm9s1dku42m33qv750ok0'),
(406, 16058, 'B04160000000002', '3gh2ntm9s1dku42m33qv750ok0'),
(407, 16058, 'B04160000000005', '3gh2ntm9s1dku42m33qv750ok0'),
(408, 16058, 'B04160000000004', '3gh2ntm9s1dku42m33qv750ok0'),
(409, 16059, 'B04160000000003', '3gh2ntm9s1dku42m33qv750ok0'),
(410, 160510, 'B04160000000001', '3gh2ntm9s1dku42m33qv750ok0'),
(411, 160511, 'B04160000000004', '3gh2ntm9s1dku42m33qv750ok0'),
(412, 160511, 'B04160000000002', '3gh2ntm9s1dku42m33qv750ok0'),
(413, 160512, 'B05160000000008', 'bcgr0kqcavoontvkfgvasua592'),
(414, 160513, 'B05160000000006', 'bcgr0kqcavoontvkfgvasua592'),
(415, 160514, 'B04160000000003', 'bcgr0kqcavoontvkfgvasua592'),
(416, 160514, 'B04160000000002', 'bcgr0kqcavoontvkfgvasua592'),
(417, 160514, 'B05160000000009', 'bcgr0kqcavoontvkfgvasua592'),
(418, 160515, 'B04160000000005', 'bcgr0kqcavoontvkfgvasua592'),
(419, 160516, 'B05160000000007', 'bcgr0kqcavoontvkfgvasua592'),
(420, 160517, 'B04160000000004', 'bcgr0kqcavoontvkfgvasua592'),
(421, 160518, 'B04160000000002', 'bcgr0kqcavoontvkfgvasua592'),
(422, 160518, 'B05160000000008', 'bcgr0kqcavoontvkfgvasua592'),
(423, 160518, 'B05160000000009', 'bcgr0kqcavoontvkfgvasua592'),
(424, 160518, 'B05160000000006', 'bcgr0kqcavoontvkfgvasua592'),
(425, 160519, 'B04160000000001', 'bcgr0kqcavoontvkfgvasua592'),
(426, 160520, 'B04160000000002', 'bcgr0kqcavoontvkfgvasua592'),
(427, 160520, 'B05160000000008', 'bcgr0kqcavoontvkfgvasua592'),
(428, 160521, 'B04160000000003', 'bcgr0kqcavoontvkfgvasua592'),
(429, 160522, 'B04160000000002', 'bcgr0kqcavoontvkfgvasua592'),
(430, 160523, 'B04160000000005', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(431, 160524, 'B05160000000007', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(432, 160524, 'B04160000000003', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(433, 160525, 'B05160000000007', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(434, 160526, 'B05160000000009', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(435, 160527, 'B05160000000008', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(436, 160528, 'B05160000000006', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(437, 160528, 'B05160000000009', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(438, 160529, 'B04160000000002', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(439, 160530, 'B05160000000008', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(440, 160531, 'B04160000000004', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(441, 160532, 'B04160000000003', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(442, 160532, 'B04160000000002', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(443, 160533, 'B04160000000004', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(444, 160534, 'B04160000000003', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(445, 160534, 'B05160000000009', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(446, 160534, 'B04160000000002', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(447, 160535, 'B04160000000001', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(448, 160535, 'B05160000000009', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(449, 160536, 'B04160000000003', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(450, 160537, 'B05160000000009', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(451, 160537, 'B05160000000006', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(452, 160538, 'B04160000000005', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(453, 160539, 'B04160000000003', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(454, 160539, 'B05160000000008', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(455, 160540, 'B05160000000007', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(456, 160541, 'B05160000000007', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(457, 160541, 'B04160000000005', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(458, 160542, 'B05160000000006', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(459, 160543, 'B04160000000002', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(460, 160544, 'B04160000000005', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(461, 160544, 'B05160000000009', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(462, 160545, 'B05160000000008', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(463, 160546, 'B04160000000005', 'uchkmkbrsar8qlblvk8dgnlhd0'),
(474, 160547, 'B05160000000008', 'b4tfpiju69jos22m5om1pd6is3'),
(475, 160548, 'B05160000000007', 'b4tfpiju69jos22m5om1pd6is3'),
(476, 160548, 'B05160000000006', 'b4tfpiju69jos22m5om1pd6is3'),
(477, 160549, 'B05160000000009', 'tgta4umk7hmf8mnvsv16lj3e92'),
(478, 160550, 'B05160000000007', '9bvivh05nv1lvthvenjbfrqur5'),
(479, 160551, 'B05160000000008', '9bvivh05nv1lvthvenjbfrqur5'),
(480, 160551, 'B05160000000006', '9bvivh05nv1lvthvenjbfrqur5'),
(481, 160552, 'B04160000000003', '9bvivh05nv1lvthvenjbfrqur5'),
(483, 160553, 'B05160000000008', '133ggbpmk54ovousmmfufr45k4'),
(485, 160553, 'B05160000000009', '133ggbpmk54ovousmmfufr45k4'),
(486, 0, 'B05160000000008', '5e9i0qlbu3k09nsgf3gil9tul4'),
(487, 160554, 'B05160000000007', 'nhfv5db1ruuarg45e7cnah4e00'),
(488, 160555, 'B04160000000005', 'qkrgiav6niqageu7ul9s11dl02'),
(489, 160656, 'B04160000000004', 'q73qba6q7cdnk3gs1kid4hv8o2'),
(490, 160657, 'B04160000000001', 'q73qba6q7cdnk3gs1kid4hv8o2'),
(491, 160657, 'B05160000000007', 'q73qba6q7cdnk3gs1kid4hv8o2'),
(492, 160658, 'B04160000000003', 'q73qba6q7cdnk3gs1kid4hv8o2'),
(493, 160658, 'B05160000000009', 'q73qba6q7cdnk3gs1kid4hv8o2'),
(494, 160658, 'B05160000000008', 'q73qba6q7cdnk3gs1kid4hv8o2'),
(495, 160659, 'B04160000000001', 'q73qba6q7cdnk3gs1kid4hv8o2'),
(496, 160660, 'B05160000000008', 'q73qba6q7cdnk3gs1kid4hv8o2'),
(504, 0, 'B04160000000004', 'q73qba6q7cdnk3gs1kid4hv8o2');

-- --------------------------------------------------------

--
-- Table structure for table `fitur_slider`
--

CREATE TABLE IF NOT EXISTS `fitur_slider` (
  `id_slider` int(2) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(15) NOT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fitur_slider`
--

INSERT INTO `fitur_slider` (`id_slider`, `judul`, `keterangan`, `gambar`) VALUES
(1, 'gggggg', 'yeahh', 'baner_os3.jpg'),
(4, 'fff', 'dfefef', 'baner_m20.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kas_perpus`
--

CREATE TABLE IF NOT EXISTS `kas_perpus` (
  `id_kas` int(11) NOT NULL AUTO_INCREMENT,
  `pengembalian_id` int(11) DEFAULT NULL,
  `id_status_buku` int(11) DEFAULT NULL,
  `kas` int(11) NOT NULL,
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `kas_perpus`
--

INSERT INTO `kas_perpus` (`id_kas`, `pengembalian_id`, `id_status_buku`, `kas`) VALUES
(35, 96, 0, 2000),
(36, 97, 0, 4000),
(37, 100, 0, 2000),
(38, 101, 0, 6000),
(39, 105, 0, 2000),
(40, 0, 1601, 75000),
(41, 109, 0, 2000),
(42, 110, 0, 4000),
(44, 0, 1603, 77000),
(45, 0, 1604, 80000),
(46, 142, 0, 4000),
(47, 143, 0, 2000),
(48, 144, 0, 4000),
(50, 146, 0, 2000),
(51, 147, 0, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kategori_id` int(3) NOT NULL AUTO_INCREMENT,
  `kategori_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`) VALUES
(1, 'Komputer'),
(2, 'Android'),
(4, 'Cerita'),
(5, 'Enterpreneurships'),
(6, 'Sejarah'),
(7, 'Agama');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id_peminjaman` int(15) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `status_peminjaman` enum('-1','1') NOT NULL,
  PRIMARY KEY (`id_peminjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='status_peminjaman\r\n---------------------\r\n\r\n-1 = Terpinjam\r\n1 = kembali\r\n';

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `anggota_id`, `tgl_pinjam`, `tgl_jatuh_tempo`, `status_peminjaman`) VALUES
(16051, 1, '2016-01-01', '2016-01-09', '1'),
(16052, 4, '2016-01-03', '2016-01-12', '1'),
(16053, 3, '2016-01-10', '2016-01-21', '1'),
(16054, 5, '2016-02-03', '2016-02-13', '1'),
(16055, 11, '2016-02-05', '2016-02-14', '1'),
(16056, 12, '2016-02-05', '2016-02-14', '1'),
(16057, 4, '2016-02-09', '2016-02-18', '1'),
(16058, 6, '2016-02-10', '2016-02-19', '1'),
(16059, 10, '2016-02-13', '2016-02-23', '1'),
(160510, 11, '2016-02-13', '2016-02-23', '1'),
(160511, 14, '2016-02-27', '2016-03-01', '1'),
(160512, 8, '2016-02-28', '2016-03-02', '1'),
(160513, 4, '2016-02-29', '2016-03-15', '1'),
(160514, 15, '2016-02-29', '2016-03-16', '1'),
(160515, 9, '2016-03-01', '2016-03-14', '1'),
(160516, 1, '2016-03-02', '2016-03-17', '1'),
(160517, 3, '2016-03-03', '2016-03-19', '1'),
(160518, 7, '2016-03-03', '2016-03-19', '1'),
(160519, 10, '2016-03-04', '2016-03-20', '1'),
(160520, 4, '2016-03-05', '2016-03-21', '1'),
(160521, 4, '2016-03-05', '2016-03-22', '1'),
(160522, 5, '2016-04-18', '2016-04-25', '1'),
(160523, 14, '2016-04-19', '2016-04-26', '1'),
(160524, 10, '2016-04-20', '2016-04-27', '1'),
(160525, 12, '2016-04-21', '2016-04-28', '1'),
(160526, 11, '2016-04-22', '2016-04-29', '1'),
(160527, 13, '2016-04-22', '2016-04-29', '1'),
(160528, 9, '2016-04-22', '2016-04-29', '1'),
(160529, 15, '2016-04-29', '2016-05-13', '1'),
(160530, 5, '2016-04-29', '2016-05-13', '1'),
(160531, 1, '2016-04-30', '2016-05-14', '1'),
(160532, 12, '2016-04-30', '2016-05-14', '1'),
(160533, 14, '2016-04-30', '2016-05-14', '1'),
(160534, 13, '2016-04-30', '2016-05-14', '1'),
(160535, 10, '2016-04-30', '2016-05-14', '1'),
(160536, 4, '2016-04-30', '2016-05-14', '1'),
(160537, 11, '2016-05-01', '2016-05-16', '1'),
(160538, 3, '2016-05-01', '2016-05-16', '1'),
(160539, 10, '2016-05-02', '2016-05-17', '1'),
(160540, 11, '2016-05-02', '2016-05-17', '1'),
(160541, 5, '2016-05-03', '2016-05-18', '1'),
(160542, 4, '2016-05-03', '2016-05-17', '1'),
(160543, 14, '2016-05-03', '2016-05-17', '1'),
(160544, 3, '2016-05-03', '2016-05-17', '1'),
(160545, 13, '2016-05-04', '2016-05-18', '1'),
(160546, 12, '2016-05-04', '2016-05-17', '1'),
(160547, 4, '2016-05-12', '2016-05-19', '1'),
(160548, 7, '2016-05-13', '2016-05-20', '1'),
(160549, 15, '2016-05-14', '2016-05-21', '1'),
(160550, 4, '2016-05-14', '2016-05-21', '1'),
(160551, 15, '2016-05-14', '2016-05-21', '1'),
(160552, 14, '2016-05-14', '2016-05-21', '1'),
(160553, 6, '2016-05-16', '2016-05-23', '1'),
(160554, 3, '2016-05-19', '2016-05-26', '1'),
(160555, 6, '2016-05-19', '2016-05-26', '1'),
(160656, 14, '2016-06-01', '2016-06-15', '1'),
(160657, 10, '2016-06-01', '2016-06-09', '1'),
(160658, 11, '2016-06-01', '2016-06-15', '1'),
(160659, 15, '2016-06-02', '2016-06-16', '-1'),
(160660, 13, '2016-06-02', '2016-06-16', '-1');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE IF NOT EXISTS `pengembalian` (
  `pengembalian_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(15) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `denda` double NOT NULL,
  PRIMARY KEY (`pengembalian_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=154 ;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`pengembalian_id`, `id_peminjaman`, `tgl_kembali`, `denda`) VALUES
(96, 16051, '2016-01-10', 2000),
(97, 16052, '2016-01-14', 4000),
(98, 16053, '2016-01-20', 0),
(99, 16054, '2016-02-13', 0),
(100, 16055, '2016-02-15', 2000),
(101, 16056, '2016-02-17', 6000),
(102, 16057, '2016-02-18', 0),
(103, 16058, '2016-02-19', 0),
(104, 16059, '2016-02-21', 0),
(105, 160510, '2016-02-24', 2000),
(106, 160511, '2016-03-01', 0),
(107, 160512, '2016-03-02', 0),
(108, 160513, '2016-03-16', 2000),
(109, 160514, '2016-03-16', 0),
(110, 160515, '2016-03-16', 4000),
(111, 160516, '2016-03-16', 0),
(112, 160517, '2016-03-18', 0),
(113, 160518, '2016-03-18', 0),
(114, 160519, '2016-03-19', 0),
(115, 160520, '2016-03-19', 0),
(116, 160521, '2016-03-18', 0),
(117, 160522, '2016-04-25', 0),
(118, 160523, '2016-04-26', 0),
(119, 160524, '2016-04-27', 0),
(120, 160525, '2016-04-28', 0),
(121, 160526, '2016-05-06', 0),
(122, 160527, '2016-05-06', 0),
(123, 160528, '2016-05-06', 0),
(124, 160529, '2016-05-11', 0),
(125, 160530, '2016-05-12', 0),
(126, 160531, '2016-05-12', 0),
(127, 160532, '2016-05-12', 0),
(128, 160533, '2016-05-12', 0),
(129, 160534, '2016-05-12', 0),
(130, 160535, '2016-05-12', 0),
(131, 160536, '2016-05-12', 0),
(132, 160537, '2016-05-12', 0),
(133, 160538, '2016-05-12', 0),
(134, 160539, '2016-05-12', 0),
(135, 160540, '2016-05-12', 0),
(136, 160541, '2016-05-12', 0),
(137, 160542, '2016-05-12', 0),
(138, 160544, '2016-05-12', 0),
(139, 160543, '2016-05-12', 0),
(140, 160545, '2016-05-12', 0),
(141, 160546, '2016-05-12', 0),
(142, 160547, '2016-05-21', 4000),
(143, 160549, '2016-05-22', 2000),
(144, 160548, '2016-05-22', 4000),
(145, 160550, '2016-05-21', 0),
(146, 160551, '2016-05-22', 2000),
(147, 160552, '2016-05-22', 2000),
(148, 160553, '2016-05-23', 0),
(149, 160554, '2016-05-26', 0),
(150, 160555, '2016-05-26', 0),
(151, 160656, '2016-06-09', 0),
(152, 160657, '2016-06-09', 0),
(153, 160658, '2016-06-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id_pesan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `isi_pesan` text NOT NULL,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `nama`, `email`, `telp`, `isi_pesan`) VALUES
(1, 'Maman', 'maman@gmail.com', '089888777666', 'Choose from the large selection of latest pre-made blocks - jumbotrons, hero images');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE IF NOT EXISTS `petugas` (
  `petugas_id` int(3) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(40) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `status_perkawinan` enum('Menikah','Single') NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(33) NOT NULL COMMENT '1 = active, 2 = non active, 3 = suspend',
  `status_petugas` enum('1','2','3') CHARACTER SET latin5 NOT NULL,
  PRIMARY KEY (`petugas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='1 = active\r\n2 = non active\r\n3 = suspend' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`petugas_id`, `nama_lengkap`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `status_perkawinan`, `no_telp`, `email`, `alamat`, `foto`, `username`, `password`, `status_petugas`) VALUES
(1, 'Aziz Rahman Aji', 'L', '1980-12-14', 'Cilacap', 'Menikah', '08988742799', 'aziz_rahman@gmail.com', 'Jakarta', 'admin_oyo.jpg', 'admin', '3fc0a7acf087f549ac2b266baf94b8b1', '1'),
(3, 'Candra', 'L', '2016-05-18', 'jkt', 'Menikah', '08976767676', 'tn@gmail.com', 'jkt', 'admin_g2g.jpg', 'cs', '81dc9bdb52d04dc20036dbd8313ed055', '3'),
(4, 'Mayang Sari', 'P', '1991-05-04', 'Bumuayu', 'Single', '081272222111', 'mayang@gmail.com', 'Jakarta Pusat', 'admin_0Sq.jpg', 'mayang', '3fc0a7acf087f549ac2b266baf94b8b1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `status_buku`
--

CREATE TABLE IF NOT EXISTS `status_buku` (
  `id_status_buku` int(11) NOT NULL,
  `buku_id` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` enum('Hilang','Rusak') NOT NULL,
  `optional` varchar(100) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `biaya_ganti` int(11) NOT NULL,
  PRIMARY KEY (`id_status_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_buku`
--

INSERT INTO `status_buku` (`id_status_buku`, `buku_id`, `tanggal`, `keterangan`, `optional`, `anggota_id`, `biaya_ganti`) VALUES
(1601, 'B05160000000009', '2016-04-13', 'Rusak', 'Ancur man', 14, 75000),
(1603, 'B05160000000008', '2016-05-17', 'Rusak', 'Ancur dilalap sijago merah', 3, 77000),
(1604, 'B04160000000005', '2016-05-12', 'Rusak', 'dikencingin adik', 12, 80000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
