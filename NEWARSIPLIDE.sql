-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Jun 2020 pada 07.46
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip_lide`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `banakun`
--

CREATE TABLE `banakun` (
  `id_ban` char(10) NOT NULL,
  `id_user` char(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `finish_date` date DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `datapengguna`
--

CREATE TABLE `datapengguna` (
  `id_datapengguna` char(10) NOT NULL,
  `nip` char(18) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `foto_profil` varchar(100) DEFAULT 'undefined',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `id_gender` char(1) DEFAULT NULL,
  `id_jabatan` char(5) DEFAULT NULL,
  `id_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `datapengguna`
--

INSERT INTO `datapengguna` (`id_datapengguna`, `nip`, `nama`, `tgl_lahir`, `foto_profil`, `create_time`, `update_time`, `id_gender`, `id_jabatan`, `id_user`) VALUES
('ADM0000000', '010203040506070809', 'Herlandro Tribiakto', '1999-09-10', 'undefined', '2020-02-10 00:00:00', '2020-02-10 00:00:00', 'M', 'JB000', 'USL0000000'),
('DP1fbe2211', '12924919491492144', 'Member Arsip', '0000-00-00', 'undefined', '2020-06-08 12:27:57', '2020-06-08 12:27:57', 'M', 'JB003', 'USLfcfc2a6'),
('DP90e88b73', '23941929148122', 'Chief Arsip', '0000-00-00', 'undefined', '2020-06-08 12:32:11', '2020-06-08 12:32:11', 'F', 'JB001', 'USL4faf1d1'),
('DPd0b2da67', '41412421424142', 'Operator', '0000-00-00', 'undefined', '2020-06-08 12:33:04', '2020-06-08 12:33:04', 'M', 'JB009', 'USLb65579d');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` char(20) NOT NULL,
  `id_dokumen` char(20) DEFAULT NULL,
  `id_kode` char(9) DEFAULT NULL,
  `id_upload` char(10) DEFAULT NULL,
  `no_agenda` varchar(50) DEFAULT NULL,
  `perihal` varchar(254) DEFAULT NULL,
  `dituju` varchar(254) DEFAULT NULL,
  `pengirim` varchar(254) DEFAULT NULL,
  `isi_disposisi` varchar(500) DEFAULT NULL,
  `tgl_penerimaan` date DEFAULT NULL,
  `tgl_pembuatan` date DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `sampah` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id_disposisi`, `id_dokumen`, `id_kode`, `id_upload`, `no_agenda`, `perihal`, `dituju`, `pengirim`, `isi_disposisi`, `tgl_penerimaan`, `tgl_pembuatan`, `create_time`, `update_time`, `sampah`) VALUES
('DI85113294710799a877', 'DK1dd6d4018056966484', '362.0.0.0', 'ADM0000000', '', '', 'faf', 'fsasf', 'asfaf', '2020-06-05', '2020-06-01', '2020-06-07 16:12:41', '2020-06-07 16:12:41', b'0'),
('DIa6f43810504971b7e7', 'DKada7d7710a8044bde9', '222.0.0.0', 'ADM0000000', '', '', 's', 'ssss', 's', '2020-06-03', '2020-06-02', '2020-06-07 16:10:19', '2020-06-07 16:10:19', b'0'),
('DIfbab0b442ad9949a20', 'DKa33c40ba4bfa7ee200', '145.0.0.0', 'ADM0000000', '', '', 's', 's', 's', '2020-06-06', '2020-06-01', '2020-06-07 16:03:19', '2020-06-07 16:03:19', b'0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` char(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nama_file` varchar(40) DEFAULT NULL,
  `ekstensi` varchar(5) DEFAULT NULL,
  `byte_file` varchar(10) DEFAULT NULL,
  `type_file` varchar(10) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`id_dokumen`, `nama`, `nama_file`, `ekstensi`, `byte_file`, `type_file`, `create_time`) VALUES
('DK1dd6d4018056966484', 'Story of Spirit', '09873797593437a92b2c19f92de0c7f0', '.docx', '17.56', NULL, '2020-06-07 16:12:41'),
('DK388d5a743034298c74', '17_11_1228', '429234aa940ec77972f6982b694ce47d', '.pdf', '132.89', NULL, '2020-06-07 01:06:29'),
('DKa33c40ba4bfa7ee200', 'test', '5cd7cbfe97b72459240a88c6f4623d18', '.png', '3301.67', NULL, '2020-06-07 16:03:19'),
('DKada7d7710a8044bde9', 'WhatsApp Image 2019-10-14 at 12_40_03 PM_jpeg', '92fe91ca232b1dba4be4e4a94043e8ae', '.pdf', '24.73', NULL, '2020-06-07 16:10:19'),
('DKf00591cff80bbb0589', 'Untitled-3 with text', '1424541b43ac1b4dd234b875b2d916e6', '.png', '530.37', NULL, '2020-06-08 12:24:47'),
('DKf200b96c53d186d730', '17_11_1228 Aceh Singkil', 'cd4604d203b5117cab515ae56bfbe426', '.docx', '24.13', NULL, '2020-06-07 16:11:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gender`
--

CREATE TABLE `gender` (
  `id_gender` char(1) NOT NULL,
  `nama` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gender`
--

INSERT INTO `gender` (`id_gender`, `nama`) VALUES
('F', 'Perempuan'),
('M', 'Laki-laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` char(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_role` char(5) DEFAULT 'RL003'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama`, `id_role`) VALUES
('JB000', 'Administrator', 'RL000'),
('JB001', 'Kepala Desa', 'RL002'),
('JB002', 'Kepala Seksi Pemerintahan', 'RL003'),
('JB003', 'Kepala Seksi Kesejahteraan', 'RL003'),
('JB004', 'Kepala Seksi Pelayanan', 'RL003'),
('JB005', 'Kepala Urusan Tata Usaha', 'RL003'),
('JB006', 'Kepala Urusan Keuangan', 'RL003'),
('JB007', 'Kepala Urusan Perencanaan', 'RL003'),
('JB008', 'Dukuh', 'RL003'),
('JB009', 'Staf', 'RL001'),
('JB010', 'Ketua - BPD', 'RL003'),
('JB011', 'Wakil Ketua - BPD', 'RL003'),
('JB012', 'Sekretaris - BPD', 'RL003'),
('JB013', 'Ketua POKJA Pemerintahan - BPD', 'RL003'),
('JB014', 'Ketua POKJA Kemasyarakatan - BPD', 'RL003'),
('JB015', 'Ketua POKJA Pembangunan - BPD', 'RL003'),
('JB016', 'Anggota - BPD', 'RL003'),
('JB017', 'Rukun Tetangga (RT)', 'RL003'),
('JB018', 'Rukun Warga (RW)', 'RL003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_arsip`
--

CREATE TABLE `jenis_arsip` (
  `id_jenisarsip` char(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode`
--

CREATE TABLE `kode` (
  `id_kode` char(9) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kode`
--

INSERT INTO `kode` (`id_kode`, `nama`) VALUES
('140.0.0.0', 'PEMERINTAHAN DESA / KELURAHAN'),
('141.0.0.0', 'Pamong Desa, Meliputi: Pencalonan, Pemilihan, Meninggal, Pengangkatan, Pemberhenian.'),
('142.0.0.0', 'Penghasilan Pamong Desa'),
('143.0.0.0', 'Kekayaan Desa'),
('144.0.0.0', 'Dewan Tingkat Desa, Dewan Marga, Rembug Desa'),
('145.0.0.0', 'Administrasi Desa'),
('146.0.0.0', 'Kewilayahan'),
('146.1.0.0', 'Pembentukan Desa/Kelurahan'),
('146.2.0.0', 'Pemekaran Desa/Kelurahan'),
('146.3.0.0', 'Perubahan Batas Wilayah / Perluasan Desa / Kelurahan'),
('146.4.0.0', 'Perubahan Nama Desa / Kelurahan'),
('146.5.0.0', 'Kerjasama Antar Desa / Kelurahan'),
('147.0.0.0', 'Lembaga-lembaga Tingkat Desa'),
('148.0.0.0', 'Perangkat Kelurahan'),
('148.1.0.0', 'Kepala Kelurahan'),
('148.2.0.0', 'Sekretaris Kelurahan'),
('148.3.0.0', 'Staf Kelurahan'),
('149.0.0.0', 'Dewan Kelurahan'),
('149.1.0.0', 'Rukun Tetangga'),
('149.2.0.0', 'Rukun Warga'),
('149.3.0.0', 'Rukun Kampung'),
('150.0.0.0', 'Legislatif MPR/DPR/DPD'),
('151.0.0.0', 'Keanggotaan MPR'),
('151.1.0.0', 'Pencalonan'),
('151.2.0.0', 'Pemberhentian'),
('151.3.0.0', 'Recall'),
('151.4.0.0', 'Pelanggaran'),
('152.0.0.0', 'Persidangan'),
('153.0.0.0', 'Kesejahteraan'),
('153.1.0.0', 'Keuangan'),
('153.2.0.0', 'Penghargaan'),
('154.0.0.0', 'Hak'),
('155.0.0.0', 'Keanggotaan DPR Pencalonan Pengangkatan'),
('156.0.0.0', 'Persidangan Sidang Pleno Dengan Pendapat / Rapat Komisi Reces'),
('157.0.0.0', 'Kesejahteraan'),
('157.1.0.0', 'Keuangan'),
('157.2.0.0', 'Penghargaan'),
('158.0.0.0', 'Jawaban Pemerintah'),
('159.0.0.0', 'Hak'),
('160.0.0.0', 'DPRD PROVINSI '),
('161.0.0.0', 'Keanggotaan'),
('161.1.0.0', 'Pencalonan'),
('161.2.0.0', 'Pengangkatan'),
('161.3.0.0', 'Pemberhentian'),
('161.4.0.0', 'Recall'),
('161.5.0.0', 'Meninggal'),
('161.6.0.0', 'Pelanggaran'),
('162.0.0.0', 'Persidangan'),
('162.1.0.0', 'Reses'),
('163.0.0.0', 'Kesejahteraan'),
('163.1.0.0', 'Keuangan'),
('163.2.0.0', 'Penghargaan'),
('164.0.0.0', 'Hak'),
('165.0.0.0', 'Sekretaris DPRD Provinsi'),
('170.0.0.0', 'DPRD KABUPATEN'),
('171.0.0.0', 'Keanggotaan'),
('171.1.0.0', 'Pencalonan'),
('171.2.0.0', 'Pengangkatan'),
('171.3.0.0', 'Pemberhentian'),
('171.4.0.0', 'Recall'),
('171.5.0.0', 'Pelanggaran'),
('172.0.0.0', 'Persidangan'),
('173.0.0.0', 'Kesejahteraan'),
('173.1.0.0', 'Keuangan'),
('173.2.0.0', 'Penghargaan'),
('174.0.0.0', 'Hak'),
('175.0.0.0', 'Sekretaris DPRD Kabupaten / Kota'),
('180.0.0.0', 'HUKUM'),
('180.1.0.0', 'Konstitusi'),
('180.1.1.0', 'Dasar Negara'),
('180.1.2.0', 'Undang – Undang Dasar'),
('180.2.0.0', 'GBHN'),
('180.3.0.0', 'Amnesti, Abolisi, dan Grasi'),
('181.0.0.0', 'Perdata'),
('181.1.0.0', 'Tanah'),
('181.2.0.0', 'Rumah'),
('181.3.0.0', 'Utang / Piutang'),
('181.3.1.0', 'Gadai'),
('181.3.2.0', 'Hipotik'),
('181.4.0.0', 'Notariat'),
('182.0.0.0', 'Pidana'),
('182.1.0.0', 'Penyidik Pegawai Negeri Sipil (PPNS)'),
('183.0.0.0', 'Peradilan'),
('183.1.0.0', 'Bantuan Hukum'),
('184.0.0.0', 'Hukum International'),
('185.0.0.0', 'Imigrasi'),
('185.1.0.0', 'Visa'),
('185.2.0.0', 'Paspor'),
('185.3.0.0', 'Exit'),
('185.4.0.0', 'Reentry'),
('185.5.0.0', 'Lintas Batas / Batas antar Negara'),
('186.0.0.0', 'Kepenjaraan'),
('187.0.0.0', 'Kejaksaan'),
('188.0.0.0', 'Peraturan Perundang-undangan'),
('188.1.0.0', 'TAP MPR'),
('188.2.0.0', 'Undang-undang'),
('188.3.0.0', 'Peraturan'),
('188.3.1.0', 'Peraturan Pemerintah'),
('188.3.2.0', 'Peraturan Menteri'),
('188.3.3.0', 'Peraturan Lembaga Non Departemen'),
('188.3.4.0', 'Peraturan Daerah'),
('188.3.4.1', 'Peraturan'),
('188.3.4.2', 'Peraturan Kabupaten / Kota'),
('188.4.0.0', 'Keputusan'),
('188.4.1.0', 'Presiden'),
('188.4.2.0', 'Menteri'),
('188.4.3.0', 'Lembaga Non Departemen'),
('188.4.4.0', 'Gubernur'),
('188.4.5.0', 'Bupati / Walikota'),
('188.5.0.0', 'Instruksi'),
('188.5.1.0', 'Presiden'),
('188.5.2.0', 'Menteri'),
('188.5.3.0', 'Lembaga Non Departemen'),
('188.5.4.0', 'Gubernur'),
('188.5.5.0', 'Bupati / Walikota'),
('189.0.0.0', 'Hukum Adat'),
('189.1.0.0', 'Tokoh Adat / Masyarakat'),
('190.0.0.0', 'HUBUNGAN LUAR NEGERI'),
('191.0.0.0', 'Perwakilan Asing'),
('192.0.0.0', 'Tamu Negara'),
('193.0.0.0', 'Kerjasama dengan Negara Asing'),
('193.1.0.0', 'Asean'),
('193.2.0.0', 'Bamtuan Luar Negeri / Hibah'),
('194.0.0.0', 'Perwakilan RI DI Luar Negeri / Hibah'),
('195.0.0.0', ' PBB'),
('196.0.0.0', 'Laporan Luar Negeri'),
('197.0.0.0', 'Hutang Luar Negeri PHLN / LOAN'),
('200.0.0.0', 'POLITIK'),
('201.0.0.0', 'Kebijaksanaan Umum'),
('202.0.0.0', 'Orde Baru'),
('203.0.0.0', 'Reformasi'),
('210.0.0.0', 'KEPARTAIAN'),
('211.0.0.0', 'Lambang Partai'),
('212.0.0.0', 'Kartu Tanda Anggota'),
('213.0.0.0', 'Bantuan Keuangan Parpol'),
('220.0.0.0', 'ORGANISASI KEMASYARAKATAN'),
('221.0.0.0', 'Berdasarkan Perjuangan'),
('221.1.0.0', 'Perintis Kemerdekaan'),
('221.2.0.0', 'Angkatan 45'),
('221.3.0.0', 'Veteran'),
('222.0.0.0', 'Berdasarkan Kekaryaan'),
('222.1.0.0', 'PEPBAPKI'),
('222.2.0.0', 'Wredatama'),
('223.0.0.0', 'Berdasarkan Kerohanian'),
('224.0.0.0', 'Lembaga Adat'),
('225.0.0.0', 'Lembaga Swadaya Masyarakat'),
('230.0.0.0', 'ORGANISASI PROFESI DAN FUNGSIONAL'),
('231.0.0.0', 'Ikatan Dokter Indonesia'),
('232.0.0.0', 'Persatuan Guru Republik Indonesia'),
('233.0.0.0', 'PERSATUAN SARJANA HUKUM INDONESIA'),
('234.0.0.0', 'Persatuan Advokat Indonesia'),
('235.0.0.0', 'Lembaga Bantuan Hukum'),
('236.0.0.0', 'Korps Pegawai Republik Indonesia'),
('237.0.0.0', 'Persatuan Wartawan Indonesia'),
('238.0.0.0', 'Ikatan Cendekiawan Muslim Indonesia (ICMII)'),
('239.0.0.0', 'Organisasi Profesi dan Fungsional lainnya'),
('240.0.0.0', 'ORGANISASI PEMUDA'),
('241.0.0.0', 'Komite Nasional Pemuda Indonesia'),
('242.0.0.0', 'Organisasi Mahasiswa'),
('243.0.0.0', 'Organisasi Pelajar'),
('244.0.0.0', 'Gerakan Pemuda Ansor'),
('245.0.0.0', 'Gerakan Pemuda Islam Indonesia'),
('246.0.0.0', 'Gerakan Pemuda Marhaenis'),
('250.0.0.0', 'ORGANISASI BURUH, TANI, NELAYAN DAN ANGKUTAN'),
('251.0.0.0', 'Federasi Buruh Seluruh Indonesia'),
('252.0.0.0', 'Organisasi Buruh International'),
('253.0.0.0', 'Himpunan Kerukunan Tani Indonesia'),
('254.0.0.0', 'Himpunan Nelayan Seluruh Indonesia'),
('255.0.0.0', 'Keluarga Supir Proposional Seluruh Indoneisa (SPSI)'),
('260.0.0.0', 'ORGANISASI WANITA'),
('261.0.0.0', 'Dharma Wanita'),
('262.0.0.0', 'Persatuan Wanita Indonesia'),
('263.0.0.0', 'Pemberdayaan Perempuan (Wanita)'),
('264.0.0.0', 'Kongres Wanita'),
('270.0.0.0', 'PEMILIHAN UMUM'),
('271.0.0.0', 'Pencalonan'),
('272.0.0.0', 'Nomor Urut Partai / Tanda Gambar '),
('273.0.0.0', 'Kampanye'),
('274.0.0.0', 'Petugas Pemilu'),
('275.0.0.0', 'Pemilih / Daftar Pemilh'),
('276.0.0.0', 'Sarana'),
('276.1.0.0', 'TPS'),
('276.2.0.0', 'Kendaraan'),
('276.3.0.0', 'Surat Suara'),
('276.4.0.0', 'Kotak Suara'),
('276.5.0.0', 'Dana'),
('277.0.0.0', 'Pemungutan Suara / Penghitungan Suara'),
('278.0.0.0', 'Penetapan Hasil Pemilu'),
('279.0.0.0', 'Penetapan Perolehan Jumlah Kursi Dan Calon Terpilih'),
('280.0.0.0', 'Pengucapan Sumpah Janji MPR, DPR, DPD'),
('300.0.0.0', 'KEAMANAN / KETERTIBAN'),
('301.0.0.0', 'Keamanan'),
('302.0.0.0', 'Ketertiban'),
('310.0.0.0', 'PERTAHANAN'),
('311.0.0.0', 'Darat'),
('312.0.0.0', 'Laut'),
('313.0.0.0', 'Udara'),
('314.0.0.0', 'Perbatasan'),
('320.0.0.0', 'KEMILITERAN'),
('321.0.0.0', 'Latihan Militer'),
('322.0.0.0', 'Wajib Militer'),
('323.0.0.0', 'Operasi Militer'),
('324.0.0.0', 'Kekayaan TNI Pejabat Sipil dari TNI'),
('324.1.0.0', 'TMMD'),
('330.0.0.0', 'KEAMANAN'),
('331.0.0.0', 'Kepolisian'),
('331.1.0.0', 'Polisi Pamong Praja'),
('331.2.0.0', 'Kamra'),
('331.3.0.0', 'Kamling'),
('331.4.0.0', 'Jaga Wana'),
('332.0.0.0', 'Huru – hara / Demonstrasi'),
('333.0.0.0', 'Senjata Api / Tajam'),
('334.0.0.0', 'Bahan Peledak'),
('335.0.0.0', 'Surat- surat kaleng'),
('336.0.0.0', 'Perjudian'),
('337.0.0.0', 'Pengaduan'),
('338.0.0.0', 'Himbauan / Larangan'),
('339.0.0.0', 'Terroris'),
('340.0.0.0', 'PERTAHANAN SIPIL'),
('341.0.0.0', 'Perlindungan Sipil'),
('350.0.0.0', 'KEJAHATAN'),
('351.0.0.0', 'Makar / Pemberontakan'),
('352.0.0.0', 'Pembunuhan'),
('353.0.0.0', 'Penganiayaan, Pencurian'),
('354.0.0.0', 'Subversi / Penyelundupan / Narkotika'),
('355.0.0.0', 'Pemalsuan'),
('356.0.0.0', 'Korupsi / Penyelewengan / Penyalahgunaan / Penyalahgunaan Jabatan'),
('357.0.0.0', 'Perkosaan / Perbuatan Cabul'),
('358.0.0.0', 'Kenakalan'),
('359.0.0.0', 'Kejahatan Lainnya'),
('360.0.0.0', 'BENCANA'),
('361.0.0.0', 'Gunung Berapi / Gempa'),
('362.0.0.0', 'Banjir / Tanah Longsor'),
('363.0.0.0', 'Angin Topan'),
('364.0.0.0', 'Kebakaran'),
('364.1.0.0', 'Pemadam Kebakaran'),
('365.0.0.0', 'Kekeringan'),
('366.0.0.0', 'Tsunami'),
('370.0.0.0', 'KECELAKAAN / SAR'),
('371.0.0.0', 'Darat'),
('372.0.0.0', 'Udara'),
('373.0.0.0', 'Laut'),
('374.0.0.0', 'Sungai / Danau');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_activity`
--

CREATE TABLE `log_activity` (
  `id_log` char(20) NOT NULL,
  `id_logtipe` char(5) DEFAULT NULL,
  `description` varchar(254) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_activity`
--

INSERT INTO `log_activity` (`id_log`, `id_logtipe`, `description`, `created_time`) VALUES
('LG0a1d2d25567e992468', 'LT001', 'Login Data ( id_user => USLb65579d, username => operator, email => undefined,  ), User Data ( id_datapengguna => DPd0b2da67 ). ID_TriggerUser => USL0000000', '2020-06-08 12:33:05'),
('LG9504a318aadc20022f', 'LT005', 'Create New Surat surat_masuk ( ID_Surat => SM12f508f16d3f1147f8 , ID_TriggerUser => ADM0000000 )', '2020-06-08 12:24:47'),
('LGcc00fc36b7585a98cd', 'LT003', '(ID_User => USL4faf1d1 , Email => undefined , Username => chief , ID_TriggerUser => USL0000000)', '2020-06-08 12:32:34'),
('LGd6cb6eb3143a54cf8b', 'LT001', 'Login Data ( id_user => USLfcfc2a6, username => member, email => undefined,  =>  ), User Data ( id_datapengguna => DP1fbe2211 ). ID_TriggerUser => USL0000000', '2020-06-08 12:27:57'),
('LGdfc5e81789418034f7', 'LT001', 'Login Data ( id_user => USL4faf1d1, username => Chief, email => undefined,  ), User Data ( id_datapengguna => DP90e88b73 ). ID_TriggerUser => USL0000000', '2020-06-08 12:32:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_tipe`
--

CREATE TABLE `log_tipe` (
  `id_logtipe` char(5) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_tipe`
--

INSERT INTO `log_tipe` (`id_logtipe`, `nama`) VALUES
('LT001', 'New Account'),
('LT002', 'Recover Surat'),
('LT003', 'Edit Account'),
('LT004', 'Change Password'),
('LT005', 'New Surat'),
('LT006', 'Edit Surat'),
('LT007', 'Delete Surat'),
('LT008', 'Upload Document'),
('LT009', 'Ban Account'),
('LT010', 'Unban Account'),
('LT011', 'Unknown Type'),
('LT012', 'Temporary Delete Surat'),
('LT013', 'Download File');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lupapass`
--

CREATE TABLE `lupapass` (
  `id_lupapass` char(10) NOT NULL,
  `kodeganti` varchar(30) DEFAULT NULL,
  `id_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lupapass`
--

INSERT INTO `lupapass` (`id_lupapass`, `kodeganti`, `id_user`) VALUES
('272af6148c', 'd668adebb5ebd2b3b7b9ac3ae3eee6', NULL),
('2bc68ee024', '667fdd5bb1bf98e4c460a53a089007', 'USL0000000'),
('80a030268e', '496c3609c68dbba40c938f5475d9e6', 'USL0000000'),
('9db81ed78c', 'c55c381d2d8e44a9f68f06929a203f', 'USL0000000'),
('ac03b6bdff', 'c53b68f1c3199a20c1387fa8ec95ad', NULL),
('ec55164194', 'de05c30285bec92c44ace89096eb65', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` char(5) NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `r_arsip` bit(1) NOT NULL DEFAULT b'0',
  `w_suratmasuk` bit(1) NOT NULL DEFAULT b'0',
  `w_suratkeluar` bit(1) NOT NULL DEFAULT b'0',
  `w_disposisi` bit(1) NOT NULL DEFAULT b'0',
  `dt_arsip` bit(1) NOT NULL DEFAULT b'0',
  `dtu_arsip` bit(1) NOT NULL DEFAULT b'0',
  `dp_arsip` bit(1) NOT NULL DEFAULT b'0',
  `admin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama`, `r_arsip`, `w_suratmasuk`, `w_suratkeluar`, `w_disposisi`, `dt_arsip`, `dtu_arsip`, `dp_arsip`, `admin`) VALUES
('RL000', 'Admin', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1'),
('RL001', 'Operator', b'1', b'1', b'1', b'0', b'1', b'1', b'0', b'0'),
('RL002', 'Chief', b'1', b'0', b'0', b'1', b'1', b'1', b'0', b'0'),
('RL003', 'Member', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_suratkeluar` char(20) NOT NULL,
  `id_dokumen` char(20) DEFAULT NULL,
  `id_kode` char(9) DEFAULT NULL,
  `id_upload` char(10) DEFAULT NULL,
  `no_surat` varchar(25) DEFAULT NULL,
  `surat_dikirim` varchar(254) DEFAULT NULL,
  `isi_ringkas` varchar(254) DEFAULT NULL,
  `keterangan` varchar(254) DEFAULT NULL,
  `lokasi_arsip` varchar(100) DEFAULT NULL,
  `tgl_penerimaan` date DEFAULT NULL,
  `tgl_pembuatan` date DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `sampah` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_suratkeluar`, `id_dokumen`, `id_kode`, `id_upload`, `no_surat`, `surat_dikirim`, `isi_ringkas`, `keterangan`, `lokasi_arsip`, `tgl_penerimaan`, `tgl_pembuatan`, `create_time`, `update_time`, `sampah`) VALUES
('SK38d67ecf5c5d417d0a', 'DKf200b96c53d186d730', '222.0.0.0', 'ADM0000000', 'safasf', 'fafaf', 'faf', 'afsfa', 'afasf', '2020-06-04', '2020-06-01', '2020-06-07 16:11:00', '2020-06-07 16:11:00', b'0'),
('SK8b4307ae5aca70e3dd', 'DK388d5a743034298c74', '145.0.0.0', 'ADM0000000', 'sd', 'ds', 'ds', 'ds', 'ds', '2020-06-03', '2020-06-07', '2020-06-07 01:06:29', '2020-06-07 01:06:29', b'0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_suratmasuk` char(20) NOT NULL,
  `id_dokumen` char(20) DEFAULT NULL,
  `id_kode` char(9) DEFAULT NULL,
  `id_upload` char(10) DEFAULT NULL,
  `no_surat` varchar(25) DEFAULT NULL,
  `asal_surat` varchar(254) DEFAULT NULL,
  `isi_ringkas` varchar(254) DEFAULT NULL,
  `keterangan` varchar(254) DEFAULT NULL,
  `lokasi_arsip` varchar(100) DEFAULT NULL,
  `tgl_penerimaan` date DEFAULT NULL,
  `tgl_pembuatan` date DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `sampah` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_suratmasuk`, `id_dokumen`, `id_kode`, `id_upload`, `no_surat`, `asal_surat`, `isi_ringkas`, `keterangan`, `lokasi_arsip`, `tgl_penerimaan`, `tgl_pembuatan`, `create_time`, `update_time`, `sampah`) VALUES
('SM12f508f16d3f1147f8', 'DKf00591cff80bbb0589', '145.0.0.0', 'ADM0000000', 'ad', 'dsaad', 'sad', 'sdaads', 'sada', '2020-06-06', '2020-06-08', '2020-06-08 12:24:47', '2020-06-08 12:24:47', b'0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userlogin`
--

CREATE TABLE `userlogin` (
  `id_user` char(10) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(254) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `userlogin`
--

INSERT INTO `userlogin` (`id_user`, `password`, `email`, `username`, `created_time`, `update_time`) VALUES
('USL0000000', '$2y$10$q07PTe3qt8PIGXPlBRfrQ.wKXHH6fOllpx49ze33eVQCdpZv73QSa', 'herlandrotoz@gmail.com', 'admin', NULL, NULL),
('USL4faf1d1', '$2y$10$B7IzUPbWgLdhWyFsh37dcu99Zzv4KdTRMNULCqGBvOdRrmJkGCur6', 'undefined', 'chief', NULL, '2020-06-08 12:32:34'),
('USLb65579d', '$2y$10$WJB3PhRFpHY.aFavsRcbKO9Cn7jMA8qR/s4VCXOLa.bKZRz0VB.Wy', 'undefined', 'operator', NULL, NULL),
('USLfcfc2a6', '$2y$10$TypQrUKSg1Q76qYOzYSu8.cA4hl/pUiqbVXzsE3mkFlSS9/I0tq7G', 'undefined', 'member', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `banakun`
--
ALTER TABLE `banakun`
  ADD PRIMARY KEY (`id_ban`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `datapengguna`
--
ALTER TABLE `datapengguna`
  ADD PRIMARY KEY (`id_datapengguna`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_gender` (`id_gender`);

--
-- Indeks untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD KEY `id_dokumen` (`id_dokumen`),
  ADD KEY `id_kode` (`id_kode`),
  ADD KEY `id_upload` (`id_upload`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indeks untuk tabel `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id_gender`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `fk_idrole` (`id_role`);

--
-- Indeks untuk tabel `jenis_arsip`
--
ALTER TABLE `jenis_arsip`
  ADD PRIMARY KEY (`id_jenisarsip`);

--
-- Indeks untuk tabel `kode`
--
ALTER TABLE `kode`
  ADD PRIMARY KEY (`id_kode`);

--
-- Indeks untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_logtipe` (`id_logtipe`);

--
-- Indeks untuk tabel `log_tipe`
--
ALTER TABLE `log_tipe`
  ADD PRIMARY KEY (`id_logtipe`);

--
-- Indeks untuk tabel `lupapass`
--
ALTER TABLE `lupapass`
  ADD PRIMARY KEY (`id_lupapass`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`) USING BTREE;

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_suratkeluar`),
  ADD KEY `id_dokumen` (`id_dokumen`),
  ADD KEY `id_kode` (`id_kode`),
  ADD KEY `id_upload` (`id_upload`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_suratmasuk`),
  ADD KEY `id_dokumen` (`id_dokumen`),
  ADD KEY `id_kode` (`id_kode`),
  ADD KEY `id_upload` (`id_upload`);

--
-- Indeks untuk tabel `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id_user`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `banakun`
--
ALTER TABLE `banakun`
  ADD CONSTRAINT `banakun_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `userlogin` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `datapengguna`
--
ALTER TABLE `datapengguna`
  ADD CONSTRAINT `datapengguna_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `datapengguna_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `userlogin` (`id_user`),
  ADD CONSTRAINT `datapengguna_ibfk_3` FOREIGN KEY (`id_gender`) REFERENCES `gender` (`id_gender`);

--
-- Ketidakleluasaan untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_ibfk_1` FOREIGN KEY (`id_dokumen`) REFERENCES `dokumen` (`id_dokumen`),
  ADD CONSTRAINT `disposisi_ibfk_2` FOREIGN KEY (`id_kode`) REFERENCES `kode` (`id_kode`),
  ADD CONSTRAINT `disposisi_ibfk_3` FOREIGN KEY (`id_upload`) REFERENCES `datapengguna` (`id_datapengguna`);

--
-- Ketidakleluasaan untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `fk_idrole` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Ketidakleluasaan untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  ADD CONSTRAINT `log_activity_ibfk_1` FOREIGN KEY (`id_logtipe`) REFERENCES `log_tipe` (`id_logtipe`);

--
-- Ketidakleluasaan untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `surat_keluar_ibfk_1` FOREIGN KEY (`id_dokumen`) REFERENCES `dokumen` (`id_dokumen`),
  ADD CONSTRAINT `surat_keluar_ibfk_2` FOREIGN KEY (`id_kode`) REFERENCES `kode` (`id_kode`),
  ADD CONSTRAINT `surat_keluar_ibfk_3` FOREIGN KEY (`id_upload`) REFERENCES `datapengguna` (`id_datapengguna`);

--
-- Ketidakleluasaan untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_1` FOREIGN KEY (`id_dokumen`) REFERENCES `dokumen` (`id_dokumen`),
  ADD CONSTRAINT `surat_masuk_ibfk_2` FOREIGN KEY (`id_kode`) REFERENCES `kode` (`id_kode`),
  ADD CONSTRAINT `surat_masuk_ibfk_3` FOREIGN KEY (`id_upload`) REFERENCES `datapengguna` (`id_datapengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
