-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 08, 2022 at 11:30 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_bahrin1`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agenda` int(5) NOT NULL AUTO_INCREMENT,
  `tema` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tema_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_agenda` text COLLATE latin1_general_ci NOT NULL,
  `tempat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pengirim` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tgl_posting` date NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `tema`, `tema_seo`, `isi_agenda`, `tempat`, `pengirim`, `tgl_mulai`, `tgl_selesai`, `tgl_posting`, `username`) VALUES
(30, 'Seminar "Membangun Portal Berita ala Detik.com"', 'seminar-membangun-portal-berita-ala-detikcom', 'Seminar ini akan membahas tentang konsep, proses, dan implementasi dalam membangun portal berita sekelas detik.com.<br>', 'Lab. Universitas Atmajaya Yogyakarta', 'HMJ TI (081843092580)', '2009-03-14', '2009-03-14', '2009-01-31', 'admin'),
(31, 'Bedah Buku "Membongkar Trik Rahasia Master PHP"', 'bedah-buku-membongkar-trik-rahasia-master-php', 'Acara bedah buku terbaru dari Lukmanul Hakim yang berjudul Membongkar Trik Rahasia Para Master PHP.<br>', 'Masih dalam konfirmasi', 'Enda (08192839849)', '2009-03-28', '2009-03-28', '2009-01-31', 'admin'),
(29, 'Workshop "3 Hari Menjadi Master PHP"', 'workshop-3-hari-menjadi-master-php', 'Workshop ini bertujuan untuk bla .. bla .. bla<br>', 'Jogja Expo Center', 'Adi (081893274848)', '2009-02-21', '2009-02-23', '2009-01-31', 'admin'),
(36, 'Workshop "VBA Programming for Excel"', 'workshop-vba-programming-for-excel', 'Tes<br><br>Pukul : 09.00 s/d 16.00 WIB<br>', 'Lab. Pusat Komputer UII', 'Aci (08189320984)', '2009-10-29', '2009-10-29', '2009-10-26', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(5) NOT NULL AUTO_INCREMENT,
  `jdl_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `album_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gbr_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `jdl_album`, `album_seo`, `gbr_album`) VALUES
(21, 'Kartun', 'kartun', '476928sonic.jpg'),
(20, 'Pernikahan', 'pernikahan', '146667nikah.jpg'),
(18, 'Bayi', 'bayi', '246551silvestree.jpg'),
(12, 'Ilustrator', 'ilustrator', '987701family.jpg'),
(19, 'Binatang', 'binatang', '391479burung.jpg'),
(17, 'Arsitektur', 'arsitektur', '741638arche090.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id_banner` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id_banner`, `judul`, `url`, `gambar`, `tgl_posting`) VALUES
(4, 'Fresh Book', 'http://freshbooks.com', 'freshbook.jpg', '2009-02-05'),
(7, 'Cinema 21', 'http://21cineplex.com', 'cinema21.jpg', '2008-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `judul_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_berita` text COLLATE latin1_general_ci NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  `tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=97 ;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `judul_seo`, `isi_berita`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`) VALUES
(76, 23, 'dahlan', 'Laskar Pelangi Pecahkan Rekor', 'laskar-pelangi-pecahkan-rekor', 'Sukses film Laskar Pelangi dalam memecahkan rekor jumlah penonton memberi pembelajaran bahwa penonton film Indonesia bisa menerima inovasi. Mira Lesmana dari Miles Films yang memproduksi film ini mengatakan, sampai Rabu (12/11), pemutaran Laskar Pelangi di 100 layar bioskop di 25 kota menyedot lebih dari 4,4 juta penonton. Padahal, Kamis kemarin, jumlah kota yang memutar film itu bertambah dengan Padang, Tasikmalaya, dan Ambon. Sebelumnya, Ayat-ayat Cinta ditonton 3,7 juta penonton (Kompas, 26/10).<br><br>Jumlah penonton itu belum termasuk penonton layar tancap untuk menjangkau penonton di daerah yang belum memiliki gedung bioskop.<br><br>Menurut Mira, layar tancap di tiga lokasi di Belitung, tempat cerita berlokasi, menyedot penonton lebih dari 60.000 penonton dan di Bangka sekitar 80.000-an orang. Pemutaran layar tancap juga dilakukan di Rantau (Sumatera Utara) dan akan dilakukan di Natuna, Aceh (enam lokasi), Lombok, serta Papua di Timika, Sorong, dan Jayapura.<br><br>Kabar gembira lainnya, film ini menjadi salah satu film yang terpilih untuk menjadi bagian dari Berlin International Film Festival atau Berlinale 2009. Festival ini adalah sebuah peristiwa budaya terpenting di Jerman yang juga adalah salah satu festival film internasional paling bergengsi di dunia.<br><br>Film Laskar Pelangi diangkat dari novel berjudul sama karya Andrea Hirata. Film ini mengangkat realitas sosial masyarakat Belitung, tentang persahabatan, kegigihan dan harapan, dalam bingkai kemiskinan dan ketimpangan kelas sosial.<br><br>"Jumlah penonton dan panjangnya masa pemutaran film sejak 25 September memperlihatkan penonton butuh sesuatu yang baru, yang inovatif, walau yang ditampilkan realitas tidak gemerlap," papar Mira.<br><br>Selama ini, kebanyakan film Indonesia bertema drama cinta, horor, dan komedi, sementara Miles Films dalam empat film terakhirnya menggarap tema realisme sosial-politik.<br><br>Mira mengakui, inovasi itu tidak selalu berhasil secara komersial. Contohnya Gie, juga produksi Miles Films. Meskipun dari sisi kritik film dan kreativitas bagus, tetapi tidak sesukses Laskar Pelangi dalam pemasaran.<br><br>Produksi film ini menghabiskan biaya Rp 9 miliar dan 90 persen dikerjakan di dalam negeri. "Sound mixing dengan sistem Dolby dan transfer optis untuk suara belum bisa dikerjakan di dalam negeri," ujar Mira.<br><br>Miles Films dan para investor, antara lain Mizan Publishing, kini bersiap memproduksi lanjutan Laskar Pelangi. Sang Pemimpi adalah bagian novel tetralogi Andrea Hirata. (sumber: kompas.com)<br>', 'Minggu', '2009-02-01', '14:31:58', '76laskarpelangi.jpg', 12, 'laskar-pelangi'),
(69, 22, 'admin', 'Gelombang Solidaritas untuk Palestina', 'gelombang-solidaritas-untuk-palestina', 'Serangan Israel kepada Palestina yang terjadi mulai akhir Desember 2008 silam telah menewaskan hampir seribu nyawa manusia. Warga sipil yang kebanyakan perempuan dan anak-anak menjadi korban keganasan tentara Israel. Warga dunia pun marah. Saat ini, hampir setiap hari sejumlah unjuk rasa mengecam kebiadaban Israel terjadi di seluruh belahan dunia. Kejahatan Israel adalah kejahatan kemanusiaan dan sudah menjadi isu bersama umat manusia.<br><br>Kecaman tidak hanya datang dari umat Islam, tapi juga dari umat agama lain. Lihat saja sejumlah biksu yang tergabung dalam Perwakilan Umat Buddha Indonesia (Walubi), kemudian Persatuan Tionghoa Indonesia serta Dewan Pemuda Kristen Indonesia.<br><br>Mereka semua ikut berpatisipasi dalam aksi solidaritas untuk Palestina yang dilaksanakan di lapangan Monas, Jakarta Ahad (11/1/2009) lalu. Mereka mengutuk kebiadaban Israel. (sumber: sabili.co.id)<br>', 'Sabtu', '2009-01-31', '14:34:18', '11solidaritas.jpg', 11, 'gaza,israel,palestina'),
(78, 2, 'wiro', 'Cristiano Ronaldo Pemain Sepakbola Terbaik 2008', 'cristiano-ronaldo-pemain-sepakbola-terbaik-2008', 'Cristiano Ronaldo akhirnya terpilih sebagai Pemain Terbaik Dunia versi FIFA, mengalahkan Lionel Messi (Barcelona), dan Fernando Torres (Liverpool). Penetapan itu diumumkan di Zurich, Swiss, Senin atau Selasa (13/1) dini hari. Ronaldo menjadi pemain pertama dari Premier League yang menerima penghargaan itu. Sebelumnya, dia juga terpilih sebagai Pemain Terbaik Eropa (Ballon d''Or) dan baru saja dinobatkan sebagai Pemain Terbaik Dunia versi suporter.<br><br>Pemain Manchester United (MU) asal Portugal itu meraih 935 pemilih dari poling yang disebar ke seluruh dunia. Pemilihnya hanya dibatasi kapten tim dan pelatih. Hasil itu diumumkan oleh pemain legendaris Brasil, Pele.<br><br>Sementara itu, Lionel Messi berada di tempat kedua. Pemain Barcelona asal Argentina itu meraih 678 suara. Adapun striker Liverpool asal Spanyol, Fernando Torres, berada di tempat ketiga dengan 203 suara.<br><br>Musim lalu, Ronaldo memang tampil bagus. Dia mencetak 42 gol dan membawa Manchester United merebut gelar Premier League dan Liga Champions.<br><br>"Ini momen yang sangat indah buatku. Momen spesial dalam hidupku. Aku ingin mengatakan kepada ibu dan saudara perempuanku bahwa kembang api sudah saatnya disulut," kata Ronaldo seusai menerima penghargaan itu. (sumber: detiksport.com)<br>', 'Senin', '2009-02-02', '14:36:34', '92cristianoronaldo.jpg', 12, 'sepakbola'),
(71, 2, 'admin', 'Ronaldo "CR7" Pecahkan Transfer Termahal', 'ronaldo-cr7-pecahkan-transfer-termahal', 'Cristiano Ronaldo segera menjadi pemain termahal dunia, menumbangkan rekor Zinedine Zidane. Agen Ronaldo menyebut bahwa kliennya terikat pra kontrak 91 juta poundsterling dengan Real Madrid. Dengan transfer senilai Rp 1,5 triliun itu, maka CR7 dipastikan akan menjadi pemain termahal dunia. Tapi, itu mungkin baru terealisasi musim depan alias musim panas nanti.<br><br>Sport melansir bahwa Pemain Terbaik Dunia 2008 itu terikat kontrak dengan Madrid untuk jangka panjang. Bahkan, juga disebutkan bahwa agen Ronaldo, Jorge Mendes, akan terkena klausul penalti (penalty clause) 20 juta euro (18 juta pounds) jika Ronaldo tak hadir di Santiago Bernabeu, musim depan.<br><br>Sebelumnya, pemain berusia 23 tahun ini dikabarkan juga terikat kontrak dengan mantan presiden Madrid, Florentino Perez. Ronaldo akan menjadi alat kampanye Perez dalam pemilihan presiden Madrid, pertengahan Juli 2009.<br><br>Rekor pemain termahal dunia kini masih dipegang Zinedine Zidane dengan 46 juta poundsterling pada 2001. Perez juga menjadi aktor di balik kedatangan maestro asal Prancis itu dari Juventus ke Madrid.<br><br>Demikian juga runner up pemain termahal dunia, Luis Figo. Perez membajaknya dari rival bebuyutan Barcelona pada 2000 dengan nilai 38,7 juta pounds. Saat itu, Figo juga jadi alat kampanye Perez. (sumber: vivanews.com)<br>', 'Sabtu', '2009-01-31', '14:41:25', '97cristiano-ronaldo.jpg', 30, 'sepakbola'),
(72, 21, 'admin', 'Belajar Dari Krisis Amerika', 'belajar-dari-krisis-amerika', 'Ibarat karena nila setitik, rusak susu sebelanga. Dan di kolam susu inilah tampaknya warga dunia tengah menunggu kapan giliran nila itu datang yang akan benar-benar melumpuhkan sendi perekonomian di negaranya masing-masing, tak terkecuali kita di Indonesia.<br><br>Dan kini kita paham bahwa kondisi yang cukup serius kali ini memang awalnya bermula dari krisis nasional di AS, yang kemudian menyebar dengan cepat ke seluruh dunia. Namun jelas bahwa ia bukanlah penyebab utamanya seperti yang dituding oleh sejumlah media (lihat ''Runtuhnya Pusat Kapitalisme'', Editorial Harian Radar Bogor, 27/09/08).<br><br>Yang menjadi benang merah dari rentetan krisis ini justru adalah penerapan globalisasi dimana roda perekonomian banyak negara di dunia digantungkan. Sebab dalam sistem ekonomi global yang tengah dipraktikkan banyak negara saat ini, krisis yang dialami suatu negara akan menular bak virus ke negara-negara lain, khususnya bila krisis itu bermula dari negara-negara maju dan yang punya otoritas dalam peta perkonomian dunia.<br><br>Meski belum memiliki definisi yang mapan, istilah globalisasi banyak dihubungkan dengan peningkatan keterkaitan dan ketergantungan antarbangsa dan antarmanusia di seluruh dunia dunia melalui perdagangan, investasi, perjalanan, budaya populer, dan bentuk-bentuk interaksi yang lain sehingga batas-batas suatu negara menjadi bias (wikipedia.com).<br><br>Di alam globalisasi inilah, kesalingbergantungan antara negara satu dengan negara lain terjalin begitu kuat. Dengan begitu, sebuah negara yang telah maju diharapkan akan merangsang perekonomian negara-negara yang sedang berkembang lewat sistem pasar bebas yang saling terhubung dan kompetitif. Tak heran bila globalisasi dipercaya akan mampu membawa kemaslahatan pada segenap umat manusia di dunia.<br><br>Sebuah niat yang kedengarannya cukup mulia memang. Dan sejak diterapkan pada era 80-an, globalisasi menjadi sistem ekonomi (mencakup juga aspek sosial, budaya, dan komunikasi) yang populer di banyak negara. Tak terkecuali bagi negara kita tercinta yang kala itu berada di bawah rezim Orde Baru.<br><br>Tapi dengan adanya krisis global ini, untuk pertama kalinya kita disadarkan, betapa sistem globalisasi yang tengah dipraktikkan kebanyakan negara saat ini, ternyata juga berpotensi membawa umat manusia pada krisis berkepanjangan. Ditambah lagi betapa globalisasi ekonomi dunia kian hari kita lihat semu dan banal, yakni di mana triliunan dollar AS diperjualbelikan dan dipermainkan di pasar modal, tetapi hanya sebagian saja diantaranya yang benar-benar menyentuh sektor riil.<br><br>Dengan kondisi kesalingterhubungan dan kesalingbergantungan inilah globalisasi ekonomi menciptakan budaya ekonomi sebagai jaringan terbuka (open network) yang rawan terhadap kemacetan di suatu titik jaringan dan serangan virus ke seluruh jaringan. Serangan virus (semisal kemacetan likuiditas) di sebuah titik jaringan (seperti AS) dengan cepat menjalar ke seluruh jejaring global tanpa ada yang tersisa.<br><br>Maka di titik ini pulalah kita sadar betapa Indonesia sebagai salah satu peserta yang turut serta dalam sistem ekonomi global, cukup rentan terkena dampak krisis ini.<br><br>Sejatinya, krisis global ini memang lebih banyak berpengaruh pada industri keuangan, khususnya pasar modal. Ruang gerak pasar modal itu sendiri belum meluas bagi usaha dan bisnis yang dijalankan bagi kebanyakan masyarakat Indonesia.<br><br>Bisa disimak bahwa roda perekonomian di Kota Bogor sendiri lebih banyak digerakkan oleh sektor riil dan usaha kecil menengah (UKM). Kebanyakan dari mereka menjalankan usaha yang tak memiliki persinggungan langsung dengan investor, juga dikerjakan oleh SDM dari dalam negeri sendiri.<br><br>Karenanya, kita selaku warga Bogor patut menjadikan peristiwa krisis global saat ini sebagai momentum dalam mendukung segenap pelaku bisnis dan UKM kota Bogor. Sebab, sejarah negeri ini telah membuktikan bahwa para pelaku bisnis dan UKM-lah yang mampu bertahan ketika krisis menerpa Indonesia di tahun 1998.<br><br>Dan kepada merekalah kita bisa berharap krisis global kali ini takkan mampir ke Indonesia. (sumber: http://prys3107.blogspot.com/)<br>', 'Sabtu', '2009-01-31', '14:48:09', '44amerika.jpg', 8, 'amerika'),
(74, 19, 'admin', 'Google Chrome Susupi Microsoft', 'google-chrome-susupi-microsoft', 'Browser Microsoft, Internet Explorer (IE), bisa mendominasi karena tersedia secara default pada banyak komputer di pasaran. Google Chrome akan menggoyang dengan menyusup di lahan yang sama. Google rupanya sudah bersiap-siap menawarkan Google Chrome secara default pada komputer-komputer baru. Pichai juga menjanjikan Chrome akan keluar dari versi Beta (uji coba) pada awal 2009. \r\n\r\nJika Google berhasil menyusupkan Chrome dalam lahan yang selama ini jadi ''mainan'' Microsoft, lanskap perang browser akan mengalami perubahan. Saat ini Microsoft masih mendominasi pada kisaran 70 persen lewat Internet Explorer-nya, sedangkan Firefox menguasai sekitar 20 persen. (sumber: <a target="_blank" title="" href="http://detikinet.com">detikinet.com</a>)<br>', 'Sabtu', '2009-01-31', '13:34:25', '25chrome.jpg', 23, 'browser,google'),
(60, 19, 'admin', 'Digerus Firefox, IE Makin Melempem', 'digerus-firefox-ie-makin-melempem', 'Browser Mozilla Firefox sepertinya makin berkibar. Berdasarkan data terbaru dari biro penelitian Net Applications, Firefox menapak naik dengan menguasai 20,78 persen pangsa pasar browser pada bulan November, naik dari angka 19,97 persen di bulan Oktober.<br><br>Dikutip detikINET dari Afterdawn, Selasa (2/1/2/2008), Firefox kemungkinan sukses menggaet user yang sebelumnya mengandalkan browser Internet Explorer (IE) besutan Microsoft. Pasalnya, masih menurut data Net Applications, pangsa pasar IE kini menurun di bawah 70 persen untuk kali pertama sejak tahun 1998. IE sekarang menguasai 69,8 persen pangsa pasar dari sebelumnya 71,3 persen di bulan Oktober.<br><br>Padahal di masa jayanya di tahun 2003, IE pernah begitu dominan dengan menguasai 95 persen pasaran browser. Penurunan pangsa pasar IE ini disinyalir juga terkait musim liburan di AS di mana banyak perusahaan libur. Padahal browser IE banyak dipakai oleh kalangan perusahaan.<br><br>Adapun produk browser lainnya menunjukkan tren peningkatan. Apple Safari kini punya pangsa 7,13 persen dan Google Chrome sebesar 0,83 persen dari yang sebelumnya 0,74 persen. Sementara pangsa pasar Opera mengalami penurunan dari yang sebelumnya 0,75 persen menjadi 0,71 persen saja. (sumber: <a target="_blank" title="http://detikinet.com" href="http://detikinet.com">detikinet.com</a>)<br>', 'Sabtu', '2009-01-31', '13:58:31', '47firefox.jpg', 5, 'browser'),
(61, 22, 'admin', 'Sepatu Melayang Saat Bush Berpidato di Irak', 'sepatu-melayang-saat-bush-berpidato-di-irak', 'Apakah pemerintah AS sakit hati karena Presiden Bush ditimpuk sepatu? Sudah pasti. Tapi di Irak, sepatu melayang itu sebagai pamitan terindah untuk Bush. Muntazer Al Zaidi dieluk-elukkan di Irak. Tuntutan masyarakat agar dia dibebaskan juga semakin kencang. Mereka menilai tindakan Al Zaidi menimpuk Bush dengan sepatunya sebagai tindakan paling berani.<br><br>Sahabat Al Zaidi di stasiun TV Al Baghdadia, mengungkapkan betapa bencinya Al Zaidi pada Bush. Dia menganggap Bush sebagai tokoh yang memerintahkan perang di Irak.<br><br>"Melempari sepatu pada Bush merupakan ciuman pamitan terbaik hingga sejauh ini ... itu merupakan ungkapan bagaimana rakyat Irak dan bangsa Arab lainnya membenci Bush," tulis Musa Barhoumeh, editor koran independen Yordania, Al-Gahd, Selasa (16/12).<br><br>Di Washington, Al Zaidi dicap sebagai orang yang cuma mencari perhatian.<br><br>"Tak diketahui apa motivasi orang itu, ia tampaknya jelas hanya berusaha mendapatkan perhatian atas dirinya," kata Jurubicara Deplu AS, Roberet Wood, kepada para wartawan.<br><br>Pemerintah Irak mencap tindakan Zaidi sebagai ''memalukan'' dan menuntut permintaan maaf dari pemimpin redaksinya yang berkerdudukan di Kairo. Namun Bos Al Zaidi malah menuntut pembebasan reporternya itu. (sumber: <a target="_blank" title="http://inilah.com" href="http://inilah.com">inilah.com</a>)<br>', 'Sabtu', '2009-01-31', '14:04:27', '38bush.jpg', 12, 'amerika,george-bush'),
(62, 22, 'admin', 'Monumen Menghormati Pelempar Sepatu Bush', 'monumen-menghormati-pelempar-sepatu-bush', 'Wartawan pelempar sepatu ke arah mantan Presiden Amerika Serikat George W Bush Desember lalu, benar-benar menjadi pahlawan. Sebuah kota di Irak bahkan membuatkan monumen sepatu untuk menghormatinya. Seperti diberitakan Reuters, Jumat (30/1/2009), monumen sepatu yang terletak di kota Tikrit Irak tersebut diresmikan Kamis kemarin. Sepatu sepanjang dua meter itu dilapis material berwarna perunggu.<br><br>"Muntazar: Puasa (bicara) hingga pedang menyayat kebisuan dengan darah. Sunyi hingga mulut kami menyuarakan kebenaran," demikian tertulis di monument itu. Saat melemparkan sepatunya ke Bush dalam sebuah konferensi pers di Baghdad, wartawan televisi Al Baghdadia itu mengucapkan bahwa Bush merupakan orang yang bertangung jawab atas kematian ribuan warga Irak. Zaidi juga menyebut Bush dengan kata "anjing".<br><br>Sejak insiden itu Zaidi medekam di penjara Baghdad. Dia menghadapi tuntutan penyerangan terhadap tamu negara dengan ancaman hukuman penjara hingga 15 tahun.<br><br>Pimpinan rumah yatim piatu dan organisasi kesejahteraan anak Tikrit Fatin Abdul Qader mengatakan monumen itu didesain oleh Laith Al Amiri dengan bobot keseluruhan sekira 1,2 ton. Tema monumen tersebut adalah "Patung Semangat dan Kedermawanan".<br><br>"Monumen ini merupakan ekspresi penghargaan dan apresiasi kami untuk Muntazhar Zaidi akrena hati orang-orang Irak akan tenang dengan leparan sepatunya," kata Fatin. (sumber: <a target="_blank" title="http://sabili.co..id" href="http://sabili.co..id">sabili.co.id</a>)<br>', 'Sabtu', '2009-01-31', '14:11:28', '91bushet.jpg', 5, 'amerika,george-bush'),
(75, 21, 'admin', 'Krisis Ekonomi Amerika, Bukti Kegagalan Kapitalisme', 'krisis-ekonomi-amerika-bukti-kegagalan-kapitalisme', 'Presiden Ekuador, Rafael Correa menilai krisis yang terjadi di Amerika menjadi bukti kegagalan sistem kapitalis dan periode Kapitalisme telah berakhir serta ekonomi Amerika sebagai pasar terbesar dunia telah dililit krisis. (Kantor Berita Fars Prensa Latina Kuba).\r\n\r\nCorrea menambahkan, apa yang terjadi di Amerika tidak terbatas pada krisis keuangan, namun bukti kebuntuan sebuah sistem yang dibangun tanpa dicermati secara serius. Menurut Correa, solusi krisis sistem keuangan Amerika tidak akan bisa selesai dengan menyuntikkan dana 700 miliar dolar kepada bank-bank yang telah bangkrut, namun yang lebih penting lagi adalah Amerika harus melakukan perubahan fundamental. (sumber: hidayatullah.com)', 'Sabtu', '2009-01-31', '14:13:52', '54RafelKarera.jpg', 12, 'amerika'),
(79, 22, 'admin', 'Ahmadinejad: Gaza Akan Jadi Kuburan Israel', 'ahmadinejad-gaza-akan-jadi-kuburan-israel', 'Iran dan Israel tampaknya tidak akan pernah melakukan genjatan senjata. Presiden Iran Mahmoud Ahmadinejad melontarkan kata-kata serangan terhadap Israel dengan menyebut negara Yahudi itu akan segera lenyap dari bumi. "<span style="font-weight: bold; font-style: italic;">Kejahatan yang dilakukan rejim Zionis (Israel) terjadi karena mereka sadar sudah sampai di akhir dan segera lenyap dari muka bumi</span>," kata Ahmadinejad dalam pawai anti-Israel yang berlangsung di Teheran, seperti dilaporkan kantor berita Mehr dan dikutip DPA, Sabtu (13/12).<br><br>Dia mengatakan Israel sudah kehilangan arah dan kian sadar bahwa kelompok negara-negara kuat makin ragu untuk menunjukkan dukungan untuk negara Yahudi itu.<br><br>Ahmadinejad juga mengatakan bahwa kejahatan Israel di Gaza bertujuan mengganti pemimpin politik di wilayah itu agar sesuai dengan kepentingan politik Israel. (sumber: <a target="_blank" title="Situs Berita Inilah.com" href="http://inilah.com">inilah.com</a>)<br>', 'Senin', '2009-02-02', '14:23:39', '22ahmadinejad.jpg', 84, 'gaza,israel,palestina'),
(65, 23, 'admin', 'Michael Heart "Song for Gaza"', 'michael-heart-song-for-gaza', 'Banyak cara untuk men-support perjuangan rakyat Palestina di Gaza, salah satunya dengan lagu. Seorang penyanyi di Los Angeles Amerika Serikat - Michael Heart yang bernama asli Annas Allaf kelahiran Syiria, membuat sebuah lagu khusus yang dia tujukan untuk rakyat Gaza yang sampai saat ini masih jadi sasaran pembantaian oleh Zionis Israel.<br><br>Sejak dia merilis lagu yang berjudul "We will not go down" (Song for Gaza), lagu tersebut mendapat banyak respon, berupa komentar dukungan, sampai ia sendiri kewalahan menjawab dan membalas berbagai email yang masuk.<br><br>Michael Heart menggambarkan kondisi rakyat Gaza akan gempuran Zionis Israel dalam lagunya itu membuat kita merasa tersindir dan sedih akan nasib rakyat Gaza. Walaupun lagu itu baru di rilis, namun telah ratusan ribu orang melihatnya di youtube dan mendownload MP3 nya.<br><br>Awalnya dia berencana dengan menjual CD lagu MP3 nya itu dan hasil penjualannya akan dia donasikan untuk kepentingan amal kemanusiaan untuk penduduk Gaza, tapi karena dia merasa sulit kalau harus sendiri mendonasikan hasil penjualan CD MP3 nya, akhirnya dia memutuskan semua orang bisa mendownload gratis lagu tersebut. Dan dia berharap, setelah mendengarkan lagu itu, orang-orang akan tergerak hatinya untuk membantu rakyat Palestina di Gaza dengan mendonasikan uangnya ke lembaga-lembaga kemanusiaan yang ada atau organisasi yang didedikasikan untuk meringankan penderitaan rakyat Palestina.<br><br>Sebagai musisi Michael Heart sangat berterima kasih atas dukungan yang diberikan kepada dia atas lagu tersebut. Dan dia berharap setiap orang yang masih mempunyai hati nurani, mendukung perjuangan rakyat Palestina dan membantu mereka walau hanya dengan berupa doa.<br><br><br><span style="font-weight: bold;">WE WILL NOT GO DOWN (Song for Gaza)</span><br style="font-weight: bold;"><br style="font-style: italic;"><span style="font-style: italic;">A blinding flash of white light</span><br style="font-style: italic;"><span style="font-style: italic;">Lit up the sky over Gaza tonight</span><br style="font-style: italic;"><span style="font-style: italic;">People running for cover</span><br style="font-style: italic;"><span style="font-style: italic;">Not knowing whether they''re dead or alive</span><br style="font-style: italic;"><br style="font-style: italic;"><span style="font-style: italic;">They came with their tanks and their planes</span><br style="font-style: italic;"><span style="font-style: italic;">With ravaging fiery flames</span><br style="font-style: italic;"><span style="font-style: italic;">And nothing remains</span><br style="font-style: italic;"><span style="font-style: italic;">Just a voice rising up in the smoky haze</span><br style="font-style: italic;"><br style="font-style: italic;"><span style="font-style: italic;">We will not go down</span><br style="font-style: italic;"><span style="font-style: italic;">In the night, without a fight</span><br style="font-style: italic;"><span style="font-style: italic;">You can burn up our mosques and our homes and our schools</span><br style="font-style: italic;"><span style="font-style: italic;">But our spirit will never die</span><br style="font-style: italic;"><span style="font-style: italic;">We will not go down</span><br style="font-style: italic;"><span style="font-style: italic;">In Gaza tonight</span><br style="font-style: italic;"><br style="font-style: italic;"><span style="font-style: italic;">Women and children alike</span><br style="font-style: italic;"><span style="font-style: italic;">Murdered and massacred night after night</span><br style="font-style: italic;"><span style="font-style: italic;">While the so-called leaders of countries afar</span><br style="font-style: italic;"><span style="font-style: italic;">Debated on who''s wrong or right</span><br style="font-style: italic;"><br style="font-style: italic;"><span style="font-style: italic;">But their powerless words were in vain</span><br style="font-style: italic;"><span style="font-style: italic;">And the bombs fell down like acid rain</span><br style="font-style: italic;"><span style="font-style: italic;">But through the tears and the blood and the pain</span><br style="font-style: italic;"><span style="font-style: italic;">You can still hear that voice through the smoky haze</span><br style="font-style: italic;"><br style="font-style: italic;"><span style="font-style: italic;">We will not go down</span><br style="font-style: italic;"><span style="font-style: italic;">In the night, without a fight</span><br style="font-style: italic;"><span style="font-style: italic;">You can burn up our mosques and our homes and our schools</span><br style="font-style: italic;"><span style="font-style: italic;">But our spirit will never die</span><br style="font-style: italic;"><span style="font-style: italic;">We will not go down</span><br style="font-style: italic;"><span style="font-style: italic;">In Gaza tonight </span><br><br>(sumber: detik.com)<br>', 'Sabtu', '2009-01-31', '14:26:40', '24michaelheart.jpg', 23, 'gaza,israel,palestina'),
(66, 22, 'admin', 'Demo Kecam Israel Warnai Ibukota', 'demo-kecam-israel-warnai-ibukota', 'Aksi unjuk rasa menentang agresi militer Israel ke Jalur Gaza, Palestina kembali mewarnai Jakarta. Unjuk rasa kali ini dilakukan oleh Ormas Islam Hizbut Thahrir di kawasan Silang Monas, Jakarta. Sejak Minggu (4/1) pagi, para pengunjuk rasa nampak berbondong-bondong membawa karton besar bertuliskan ''Save Palestine'' dan foto anak-anak serta perempuan Palestina yang menjadi korban tak berdosa dari serangan biadab militer Israel.<br><br>Kepada warga Jakarta yang berolahraga di sekitar kawasan Monas, para pengunjuk rasa juga mengedarkan kotak sumbangan untuk didonasikan kepada korban warga Palestina.<br><br>Aksi unjuk rasa dan banyaknya warga Jakarta yang rutin berolahraga di kawasan Silang Monas setiap Minggu pagi, membuat kawasan itu cukup padat untuk dilalui kendaraan bermotor.<br><br>Serangan udara Israel yang dimulai pada 27 Desember 2008 sudah terjadi selama sepekan di Jalur Gaza dan menewaskan lebih 420 orang.<br><br>Meski mendapat kutukan keras dari dunia Internasional, termasuk Indonesia, Israel sampai saat ini belum menunjukkan tanda-tanda akan menghentikan aksi militernya. (sumber: inilah.com)<br>', 'Sabtu', '2009-01-31', '14:29:16', '32demo.jpg', 23, 'gaza,israel,palestina'),
(67, 2, 'admin', 'Ana Ivanovic Dinobatkan Sebagai Ratu Tenis 2008', 'ana-ivanovic-dinobatkan-sebagai-ratu-tenis-2008', 'Ana Ivanovic, dara kelahiran Belgrade pada tanggal 6 November 1987 sudah mulai bermain tenis sejak umur 5 tahun sesudah menonton Monica Seles di TV, mengingat nomor telpon sekolah tenis lokal dan memohon kepada orang tuanya untuk mengajak pergi ke sekolah itu. Kemudian di acara ulang tahunnnya yang ke-5, orang tuanya memberi hadiah berupa raket tenis dan sejak itu dia mulai jatuh cinta dengan dunia tenis. Kemudian Ana mulai berlatih tenis secara intens dengan Scott Byrnes pada bulan juli 2006.<br><br>Dragana, ibunya adalah seorang pengacara, sedangkan Miroslav bapaknya adalah seorang pebisnis, Milos kakaknya adalah seorang pemain basket dan seluruh keluarganya menyukai olahraga, tetapi tidak ada yang menyukai tenis seperti ana.<br><br>Senjata utamanya di tenis adalah pukulan forehand-nya, dan dia bisa main di segala jenis lapangan. Hobinya adalah menonton film di bioskop atau menonton DVD di rumah. Ana juga suka membaca, khususnya tentang Mitologi dan Sejarah Yunani. Ana juga senang sekali mendengarkan musik.<br><br>Pada tahun 2008 ini, setelah menjuarai Roland Garros prancis dengan mengalahkan Dinara safina dari rusia di final, maka saat ini peringkat Ana Ivanovic naik menjadi peringkat 1 dunia untuk petenis putri.<br>', 'Sabtu', '2009-01-31', '14:30:48', '20anaivanovic.jpg', 4, 'tenis'),
(73, 2, 'admin', 'Maria Kirilenko, Petenis Terseksi Versi WTA', 'maria-kirilenko-petenis-terseksi-versi-wta', 'Pesona kecantikan Maria Sharapova dan Ana Ivanovic sepertinya sudah mendapat saingan baru. Tidak jauh-jauh, nama Maria Kirilenko tiba-tiba menyeruak di daftar petenis terseksi pilihan responden WTA. Artinya, Maria sukses merengkuh gelar yang musim lalu diraih Maria Sharapova.<br><br>Setengah dari 7 ribu responden yang masuk ke WTA menyebut, kalau Maria adalah sosok petenis ideal dan paling proporsional di level bentuk tubuh. Meski hanya berperingkat 18 dunia, namun pesonanya di atas lapangan tenis menjadi daya tarik tersendiri.<br><br>"Tubuhnya sangat indah, siluetnya membuat setiap pria pasti penasaran ingin melihat lebih dekat. Yang jelas, ia memiliki kepribadian baik yang makin menyempurnakan pesona fisiknya," tulis seorang responden. Di kalangan petenis putri sendiri, sudah lama Maria menjadi saingan berat Masha dan Ana ivanovic.<br><br>Di situs pribadinya, petenis bernama asli Maria Yuryevna Kirilenko ini mengaku selalu menjaga proporsi tubuh dengan senam dan renang, selain tentu berlatih fisik tenis. "Olahraga adalah cermin hidupku, jika tak olahraga sehari saja, kadang membuat tubuhku terasa lemas dan tak bergairah," ujar Maria.&nbsp; (persda network/bud)<br><br>Meksi bersaing di lapangan dan dunia mode, namun ternyata sosok Maria Kirilenko adalah sobat sejati Maria Sharapova. Bukan hanya karena sama-sama berasal dari Rusia, namun gaya hidup mereka berdualah yang membuat Maria-Masha banyak memiliki kecocokan.<br>Selain suka fotografi, mereka berdua juga memiliki hobi berbelanja, terutama fashion dan perhiasan. Bukan untuk pamer memang, tapi mereka melakukan itu untuk tabungan dan investasi.<br><br>Di beberapa turnamen, Masha dan Maria memang tampak bersama tatkala berada di luar lapangan. Mereka biasanya menyingkir dari rombongan pemain lain, dan memilih berburu barang kesukaan mereka dengan menyisir bagian kota tempat mereka tengah bertanding. "Aku dan Masha seperti kakak beradik, bagiku dia lebih dari sekedar sahabat, dia begitu dewasa, apalagi saat kami berdua saling curhat," sebut Maria, di tennisnews. <br><br>Daftar petenis terseksi WTA:<br><ol><li>Maria Kirilenko (Russia)</li><li>Maria Sharapova (Russia)</li><li>Ana Ivanovic (Serbian)</li><li>Caroline Wozniacki (Danish)</li><li>Nicole Vaidisova (Czech)</li><li>Sania Mirza (Indian)</li><li>Ashley Harkleroad (American)</li><li>Gisela Dulko (Argentinian)</li><li>Samantha Stosur (Australian)<br></li></ol>', 'Sabtu', '2009-01-31', '15:01:49', '14mariakirilenko.jpg', 37, 'tenis'),
(77, 2, 'bahrin', 'Sharapova, Petenis Wanita Berpenghasilan Tertinggi', 'sharapova-petenis-wanita-berpenghasilan-tertinggi', 'Petenis asal Rusia, Maria Sharapova dengan penghasilan 26 juta dolar AS merupakan petenis wanita berpenghasilan tertinggi. Ia pernah menempati peringkat satu dunia, pasca mundurnya Justine Henin. Ia juga memiliki prestasi dengan menjuarai turnamen grand slam Australia Terbuka dan AS Terbuka. Namun, sebagian besar penghasilannya didapat dari kontrak iklannya bersama Pepsi, Colgate-Palmolive, Nike dan Motorola.<br><br>Berikutnya disusul Williams bersaudara dari Amerika, yaitu Serena Williams dengan penghasilan 14 juta dolar AS. Ia meraih tiga gelar juara tiap tahunnya semenjak tahun 2005. Ia juga merupakan model dari produk Hawlett-Packard, Nike, dan Kraft. Sedangkan kakak kandungnya, yaitu Venus Williams berpenghasilan 13 juta dolar AS. Ia mengalahkan adiknya di final Wimbledon tahun 2008. Ia memiliki dan menjalankan sendiri usaha fashion Eleven.<br><br>Di peringkat ke empat dan kelima adalah petenis Belgia yaitu Justine Henin dengan penghasilan 12,5 juta dolar AS. Dan petenis asal Serbia, yaitu Ana Ivanovic dengan penghasilan 6,5 juta dolar AS.<br>', 'Minggu', '2009-02-01', '19:58:16', '89sharapova.jpg', 18, 'tenis'),
(68, 2, 'admin', 'Roger Federer, Petenis Legenda Abad Ini', 'roger-federer-petenis-legenda-abad-ini', 'Siapa yang tak kenal dengan Roger Federer saat ini? Masih muda, ganteng, namun sudah jadi legenda. Bayangkan, dalam usia belum menginjak 26 tahun, ia sudah memecahkan rekor bertahan sebagai peringkat pertama dunia tenis selama 161 pekan berturut-turut. Ia memecahkan rekor Jimmy Connor yang sudah bertahan puluhan tahun. <br><br>Itu baru satu rekor. Sebelumnya, ia juga mendapat penghargaan Bagel Award, yakni penghargaan sebagai petenis paling banyak memenangkan set tenis dengan angka sempurna 6-0. "Saya hanya berusaha melakukan yang terbaik dan tidak berhenti memperbaiki kesalahan-kesalahan saya,"sebut Federer merendah tentang prestasinya itu.<br><br>Dengan kerendahhatian dan semangat untuk terus memperbaiki diri, pria keturunan campuran Swiss, German, dan Afrika Selatan ini sepertinya akan terus mengukir prestasi. Sebab, mengingat usia yang masih muda dan jarak nilai ATP dengan peringkat kedua dunia Rafael Nadal, cukup jauh, ia akan bisa terus bertahan di rangking satu dunia. Apalagi jika ia nantinya bisa memenangkan satu-satunya gelar tenis Grand Slam yang belum diraih, Perancis Terbuka. Ia akan jadi satu-satunya petenis pria yang bisa mengawinkan semua gelar tenis Grand Slam.<br><br>Roger Federer memang sepertinya terlahir untuk jadi legenda. Bahkan, menurut pengakuannya, sejak kecil ia sudah disebut banyak orang punya bakat gemilang di bidang olahraga. Tapi, menurut dirinya, bukan bakat yang membuatnya seperti sekarang. Kerja keras, ketekunan berlatih, dan keuletan di lapangan lah yang membuat dia bisa jadi juara sejati. "Saya terus berlatih untuk meningkatkan teknik permainan saya dan menambah kekuatan saya. Proses ini saya jalani sampai hari ini dan bahkan makin saya tingkatkan sejak saya jadi juara. Ini saya lakukan karena saya yakin masih banyak perbaikan yang harus terus dilakukan."<br><br>Dengan tekad untuk terus melakukan perbaikan itu, Roger Federer terus meretas jalan untuk mengukir rekor-rekor lainnya. Namun, semua rekor dan kemenangan yang diperolehnya, ternyata bukan hanya untuk kebanggaan dirinya. Melalui sebuah yayasan yang diberi nama seperti dirinya, Roger Federer Foundation, ia membantu anak-anak kurang beruntung di dunia terutama di Afrika Selatan. Sebagian hadiah yang diperoleh dari kemenangannya di kejuaraan tenis, digunakan untuk membantu anak-anak itu. Ia juga berperan banyak saat terjadi tsunami akhir tahun 2005. Saat itu, ia terpilih menjadi duta UNICEF, untuk membantu anak-anak yang jadi korban tsunami di Tamil Nadu, India. Ia juga berjanji untuk mengukir lebih banyak kemenangan guna mengumpulkan lebih banyak dana untuk yayasannya. Ia juga merelakan beberapa raketnya untuk dilelang guna disumbangkan melalui UNICEF. Roger Federer telah membuktikan, dengan kerja keras, semangat pantang menyerah, tekad kuat, dan kepedulian terhadap sesama, telah menjadikannya sebagai juara sejati.<br><br>Dari kisah sukses Roger Federer ini, kita dapat mengambil pelajaran bahwa dengan kerja keras disertai semangat pantang menyerahlah kita bisa mewujudkan cita-cita. Selain itu, kepedulian kepada sesama juga selayaknya dapat mendorong semangat kita untuk terus mengukir prestasi. (sumber: andriewongso.com)<br>', 'Sabtu', '2009-01-31', '18:59:14', '33federer.jpg', 15, 'tenis'),
(70, 19, 'admin', 'Kisah Sukses Google', 'kisah-sukses-google', 'Dalam daftar orang terkaya di Amerika baru-baru ini, terselip dua nama yang cukup fenomenal. Masih muda, usianya baru di awal 30-an, namun kekayaannya mencapai miliaran dolar. Nama kedua orang itu adalah Larry Page dan Sergey Brin. Mereka adalah pendiri Google, situs pencari data di internet paling terkenal saat ini.<br><br>Terlepas dari jumlah kekayaan mereka, ada beberapa hal yang perlu dicontoh dari kisah sukses mereka. Satu hal yang pertama, yang disebut Sergey Brin, yang kini menjabat sebagai Presiden Teknologi Google, yakni tentang kekuatan kesederhanaan. Menurutnya, simplicity web adalah hal yang disukai penjelajah internet. Dan, Google berhasil karena menggunakan filosofi tersebut, menghadirkan web yang bukan saja mudah untuk mencari informasi, namun juga menyenangkan orang.<br><br>Kunci sukses kedua adalah integritas mereka dalam mewujudkan impiannya. Mereka rela drop out dari program doktor mereka di Stanford University untuk mengembangkan google. Mereka pun pada awalnya tidak mencari keuntungan dari proyek tersebut. Malah, kedua orang itu berangkat dari sebuah ide sederhana. Yakni, bagaimana membantu banyak orang untuk mempermudah mencari sumber informasi dan data di dunia maya. Mereka sangat yakin, ide mereka akan sangat berguna bagi banyak orang untuk mempermudah mencari data apa saja di internet.<br><br>Kunci sukses lainnya yaitu mereka tidak melupakan jasa orang-orang yang mendukung kesuksesan mereka. Larry dan Sergey sangat memerhatikan kesejahteraan SDM di Google. Kantornya yang diberi nama Googleplex dinobatkan sebagai tempat bekerja terbaik di Amerika tahun 2007 oleh majalah Fortune. Di sana suasananya sangat kekeluargaan, ada makanan gratis tiga kali sehari, ada tempat perawatan bagi bayi ibu muda, bahkan sampai kursi pijat elektronik pun tersedia. Mereka sadar, di balik sukses inovasi yang dilakukan Google, ada banyak doktor matematika dan lulusan terbaik dari berbagai universitas yang membantu mereka.<br><br>Larry dan Sergey memang tak pernah menduga Google akan sesukses sekarang. Kedua orang yang terlahir dari keluarga ilmuwan – ayah Sergey adalah doktor matematika, sedangkan Larry adalah putra almarhum doktor pertama komputer di Amerika – ini memang hanya berangkat dari sebuah masalah sederhana. Mereka berusaha memecahkan masalah tersebut, dan berbagi dengan orang lain. Namun, justru dengan kesederhanaan dan integritas mereka, mampu membuat Google saat ini menjadi mesin pencari terdepan, dikunjungi lebih dari 300 juta orang perhari. Diterjemahkan dalam 88 bahasa dengan nilai saham mencapai lebih dari 500 dolar AS per lembar, membuat sebuah kesederhanaan menjelma menjadi kekuatan yang luar biasa.<br><br>Sebuah niat mulia, meski sesederhana apapun, jika dilandasi kerja keras dan integritas yang tinggi, akan menghasilkan sesuatu yang istimewa. Hal tersebut nampak dari contoh kisah sukses Larry Page dan Sergey Brin di atas. Google yang mereka dirikan terbukti telah membantu banyak orang untuk bisa mendapatkan apa saja dari internet. Dan kini, mereka pun mendapatkan imbalan yang bahkan tak diduga mereka sebelumnya. Kesuksesan sejati memang akan terasa saat kita bisa berbagi. Dan, Larry serta Sergey membuktikannya sendiri. (sumber: andriewongso.com)<br>', 'Minggu', '2009-01-25', '20:26:26', '73google.jpg', 7, 'google'),
(64, 19, 'wiro', 'Browser Safari Diklaim Paling Handal di Windows', 'browser-safari-diklaim-paling-handal-di-windows', 'Dibandingkan browser Internet lainnya, Apple mengklaim browser web Safari buatannya adalah yang paling handal digunakan jika digunkan di atas sistem operasi Windows. Hal tersebut disampaikan CEO Apple Steve Jobs saat mengumumkan versi terbaru Safari yang dapat berjalan di Windows.<br><br>"Kami kira para pengguna Windows akan benar-benar terkejut saat melihat begitu cepat dan menariknya berselancar di Internet menggunakan Safari," ujar Steve Jobs di acara Worldwide Developer Conference Apple di San Fransisco, AS, Senin (11/6). Ia mengklaim browser Safari dapat membuka sebuah halaman web dua kali lebih cepat dibandingkan Internet Explorer 7 di Windows dan masih lebih cepat dibandingkan Opera maupun Firefox.<br><br>Kehadiran Safari untuk para pengguna Windows akan semakin menyemarakkan persaingan browser web. Steve Jobs berharap peluncuran ini akan meningkatkan popularitas Safari yang baru mencapai 4,9 persen pangsa pasar browser web. Persaingan browser web saat ini masih didominasi IE dengan pangsa pasar 78 persen menyusul Firefox. Versi tes Safari 3 untuk Windows XP, Vista, dan Apple Macs OSX sudah dapat di-download dari situs Apple sejak Senin (11/6). (sumber: bbc.co.uk)<br>', 'Minggu', '2009-01-25', '20:35:26', '18safari.jpg', 4, 'browser'),
(58, 23, 'bahrin', 'Pelajaran Moral dari Film Laskar Pelangi', 'pelajaran-moral-dari-film-laskar-pelangi', '"Kalau Nak Pintar, Belajar! Kalau Nak Berhasil, Usaha!" Itulah mantra yang diberikan Tuk Bayan Tula kepada anak-anak laskar pelangi saat mau menghadapi ujian. Berikut beberapa fakta mengapa saya sangat menyukai film Laskar Pelangi (Petik hikmahnya ya):<br><br>1. Pelajaran itu bisa didapatkan dimana saja<br><br>Para Laskar Pelangi menimba ilmu di sekolah reot yang sangat tidak layak, kegigihan untuk menimba ilmu dan mengubah sejarah hidup membuat mereka mampu bangkit dan membuktikan bahwa mereka bisa menjadi yang terbaik. Sebagai blogger, belajarlah dari siapapun, baik master ataupun newbie, anda tidak akan rugi. Saya selalu senang belajar dari semua orang :)<br><br>2. Keinginan untuk memberi.<br><br>Keinginan untuk memberi akan membuat kita kuat dan bahagia. Berbagi itu Indah (seperti paman gober yang berbagi PR dengan saya). Semangat untuk memberikan yang terbaik akan membuat kita berusaha sekuat mungkin. Dari apa yang kita berikan pada orang lain, kitapun akan memetik hasilnya. Jangan takut kehilangan karena berbagi.<br><br>3. Semangat komunitas, lihat bagaimana mereka membangun tim.<br>Team building, walaupun saya seorang blogger, di BlogicThink saya bekerja bersama. Ada perbedaan sikap dalam menghadapi suatu masalah, dan tim yang baik akan menemukan jalan keluarnya. Saksikan bagaimana Laskar Pelangi memenangkan karnaval dan cerdas cermat. Terima kasih kepada Mas Ary yang mau berbagi dengan saya.<br><br>4. Kalau Nak Pintar, Belajar! Kalau Nak Berhasil, Usaha!<br>Saya suka bagian ini. Laskar pelangi mendatangi dukun untuk lulus dalam ujian. Sang Dukun yang bertempat di pilau terpencil mengngatkan untuk membaca mantra itu dipagi hari. Para Laskar pelangipun menurutinya. Dibawalah selembar mantra tersebut, dibaca didepan sekolah bersama keras-keras : Kalau Nak Pintar, Belajar! Kalau Nak Berhasil, Usaha!<br><br>Yups, suatu pelajaran bagi kita untuk tidak pendek akal ketika ingin menjadi blogger sukses. Saya memilih mewawancara Mas Jimmy, ketimbang membeli resep kebut semalam. Terima kasih untuk Mas Jimmy atas PRnya.<br><br>5. Gunakan waktu, mumpung masih muda<br><br>Ketika saya menonton Laskar Pelangi, saya ingat umur. Saya mengagumi mereka yang memiliki tekad belajar yang kuat, cerita tentang anak-anak kelas 5 SD ini memang mengagumkan. Saya jadi teringat Kawan Blogger saya Ruzdee yang mengenal internet saat kelas 5 SD, suatu kesempatan yang hebat. Semoga sukses kawan :)<br><br>6. Buku kucel mereka, adalah awal dari masa depan.<br><br>9 Laskar pelangi berkumpul dikelas saat sekolah mau dibuka, masih kurang 1 anak. Dalam suasana menunggu Ditampilkan buku kucel yang membuat haru penonton, efek dramatis berhasil dimunculkan. Melihat buku itu saya teringat buku catatan saya, saya memiliki buku catatan yang selalu habis dalam waktu kurang dari satu bulan, isinya adalah ide-ide bisnis.<br><br>Saya jadi ingat spydeey yang menjadikan blognya sebagai oret-oretan catatan belajar komputer dan internet, thanks atas PRnya Bro :)<br><br>7. Lintang, sang jenius yang tak berhenti bermimpi<br><br>Melihat lintang membuat saya melakukan refleksi. Saya tau rasanya putus sekolah. Dan saya tahu rasanya kehilangan kesempatan kuliah karena masalah biaya. Bagi saya itu bukan hambatan. Saya tahu saya akan berhasi. walau kadang dunia tak adil, sekarang saya coba menjawabn setiap permasalahan, dan saya bahagia.<br><br>8. Sekolah kecil itu mengalahkan sekolah dengan modal besar<br><br>Karena sekolah memang bukan soal modal. Pendidikan sejatinya bukan masalah hitung-hitungan material. Ini masalah nilai-nilai. SD Para Laskar Pelangi mengalahkan SD berfasilitas lengkap, karena mereka memiliki cita-cita, semangat, harapan dan kebijaksanaan seorang pendidik.<br><br>Saya adalah seorang trainer di organisasi saya dulu ketika mahasiswa. Anehnya, saya tidak suka sekolah, saya menganggapnya mengungkung pemikiran saya. Ada terlalu banyak pemikiran kaku dan tertinggal disana yang saya tidak sukai.<br><br>9. Ajari saya bermimpi<br><br>Seandainya kondisi membuat saya mundur, maka saya telah tertinggal sejak lama. Banting setir ke dunia bisnis adalah pilihan dari kesulitan ekonomi dan ketidakmampuan untuk melanjutkan kuliah. Awalnya saya down, namun saya tidak mau berlama-lama. Saya coba berusaha bangkit. Hari ini, saya dapat bangga akan ilmu manajemen pemasaran yang saya miliki. Bahkan ketika bertemu dengan kawan-kawan saya dibangku kuliah dulu. Beruntung, walaupun tidak bekerja seperti mereka, saya bangga menjadi seorang blogger dan bukan buruh orang lain. Btw, Om jadul ngasih PR ( Blognya kok suspend Om?)<br><br>10. Seperti Ikal saya berniat sekolah di Perancis<br><br>Jika Ikal pergi ke sorbonne dan berkeliling dunia saya berniat untuk belajar di Universitas Frankfurt, mungkinkah? kita tunggu saja nanti. (sumber: blogicthink.com)<br>', 'Minggu', '2009-01-25', '21:10:44', '46laskar.jpg', 6, 'laskar-pelangi'),
(85, 19, 'admin', 'Windows 7 Gantikan Windows Vista', 'windows-7-gantikan-windows-vista', 'Microsoft  ingin memudahkan rencana para administrator komputer yang akan bermigrasi ke Windows 7, namun sebuah tulisan di blog salam satu anggota tim Windows 7 berkata sebaliknya.\r\n\r\nSkenario uji coba terbaru menunjukkan, sebagian besar pengguna, proses upgrading akan menyulitkan, mengambil waktu kira-kira 30 menit. Prosentasi terbesar pengguna menyebut, migrasi butuh waktu hingga 21 jam.\r\n\r\nSalah satu anggota tim Windows dari Microsoft, Chris Hernandez, mengungkap hasi pengetesan timnya dengan berbagai merek komputer dan konfigurasi tipikal pengguna lewat simulasi pada tingkatan berbeda dari proses migrasi Vista ke Windwos pada Jumat akhir pekan lalu.\r\n\r\nTujuan simulasi untuk memastikan apakah upgrade dari Vista Service Pack (SP) 1 ke Windows 7, dalam lima persen percobaan utama, lebih cepat ketimbang upgrade dari Vista SP1 ke Vista SP2, ujar Chris.\r\n\r\nProses dari Vista SP1 ke Vista SP2 dipilih karena itu opsi instalasi paling umum digunakan Microsoft Product Support Services, yakni skenario repair (perbaikan ulang) di mana prosedur yang paling dianjurkan adalah melakukan re-instalasi sistem operasi (OS) yang sudah ada di komputer saat itu. Chris menampilkan hasil tes dalam blognya.\r\n\r\nTim mengetes konfigurasi komputer khusus hadware, merentang dari kategori hardware low-end (spesifikasi rendah), mid-range (spesifikasi menengah) dan high-end (spesifikasi atas). Kategori itu berlawanan dengan skenario pengguna pada umumnya yang berbasis pertanyaan seperti, berapa besar set data yang dibutuhkan pengguna dan bagaimana macam aplikasi tersebut diinstall.\r\n\r\nUntuk kategori komputer spesifikasi atas, Chris dan timnya mendefinisikan komputer dengan sistem operasi 32 bit dan memiliki CPU berprosesor Inter Core 2 Quad, yang bejalan di 2,4 GHz, memori 4GB dan hardisk 1 Terabyte .\r\n\r\nSementara, pengguna umumnya memiliki data sebesar 125 GB yang terikat dalam format dokumen, musik dan gambar dengan 40 aplikasi yang diinstal di komputer mereka.\r\n\r\nKinerja upgrade Vista SP1 ke Windows 7 pada hardware spesifikasi atas dengan konfigurasi pemilik pengguna kelas berat, membutuhkan 160 menit, atau sekitar 2,7 jam. Sebagai perbandingan, upgrade repair (perbaikan) dari Vista SP1 ke Vista SP1 dengan hadware yang sama dan penggunaan bera membutuhkan 176 menit, atau 2,9 jam.\r\n\r\nSkenario terburuk muncul pada konfigurasi hadware kelas menengah, yakni CPU 32 bit namun dengan software dan konfigurasi "pengguna super". Proses upgrading akan butuh waktu hingga 1.220 menit alias 20,3 jam. Padahal yang dianggap hadware kelas menengah, memiliki spesifikasi setara memory 2GB RAM, prosesor dual core, Athlon 64 X2, pada 2,6GHz dan hardisk 1 Terabyte.\r\n\r\nMereka yang dianggap pengguna super, memiliki profil lebih sadis dalam istilah penggunaan data, ketimbang pengguna kelas berat pada umumnya. Sebagai contoh, tim penguji menyebut pengguna super memiliki 650 GB data dan 40 aplikasi lebih yang terinstal dalam komputer mereka.\r\n\r\nLalu pada kelas rendah, pengguna medium, dengan 70 GB data dan 20 aplikasi, dengan memori sekitar 1 GB, prosesor 64 bit, AMD Athlon pada kecepatan 2,2 GHz, bakal butuh waktu bermigrasi sekitar 175 menit. Hardware yang lebih bertenaga, secara umum membutuhkan waktu instalasi lebih singkat.\r\n\r\nMicrosoft tidak selalu bisa mencapai target lima persen tujuan tim Chris yang telah dijanjikan. Dalam satu contoh, instalasi bersih (instalasi pertama pada komputer baru tanpa OS) Windows 7 pada hardware spesifikasi menengah membutuhkan 30 menit sementara instalasi bersih Vista SP1 butuhk 31 menit. Hanya saja, secara keseluruhan, tidak ada instalasi Windows 7 yang lebih lambat dibandingkan Vista.\r\n\r\nPertanyaan tersisa, apakah para toko dan ritel software akan mendengar rayuan Microsoft dan memutuskan hijrah ke Windows 7 lebih cepat? Tradisi yang berlaku, ritel IT akan cenderung menunggu Service Pack I sebelum mendatangkan versi terbaru Windows.\r\n\r\nWaktu yang akan menjadi sumber menentukan apakah kalangan profesional IT akan berpindah, sehingga Vista tak lagi menarik bagi ritel dan toko software. Jadi kehijrahan mereka ke Windows 7 dengan segera, menandakan pula, apakah para profesional IT suka dengan hasil pengujian waktu instal yang dilakukan Chris Hernandez.  internetnews/itz.\r\n', 'Minggu', '2009-10-25', '07:25:22', '19windows7.jpg', 12, 'komputer'),
(92, 23, 'admin', 'Pemilik Facebook akan Dibuat Filmnya', 'pemilik-facebook-akan-dibuat-filmnya', 'Sutradara David Fincher nampak jeli melihat peluang di tengah booming fenomena Facebook. Fincher akan menghadirkan sebuah film yang menceritakan tentang Mark Zuckerberg dan Facebook bagi para pencinta film dan Facebook tentunya.\r\n\r\nFincher mengaku rencana pembuatan film ini masih dinegosiasikan dengan pihak Zuckerberg. Dia hanya menyebutkan, filmya akan fokus menceritakan Mark Zuckerberg yang awalnya merancang Facebook sebatas untuk keperluan mahasiswa Universitas Harvard.\r\n\r\nFilm ini memaparkan bagaimana setelah itu Facebook kemudian berkembang menjadi fenomena yang mendunia sejak diluncurkan pada 2004.\r\n\r\nDalam penggarapan film ini, Fincher mengajak serta orang-orang kompeten di bidang film. Antara lain Aaron Sorkin, yang merupakan penulis naskah acara serial televisi ternama The West Wing.\r\n\r\nSementara itu, Columbia Pictures yang menamai film ini "The Social Network" dipercaya untuk memulai produksi film pada akhir tahun ini.\r\n\r\nSebagian orang menilai kehadiran film ini nantinya akan mengorek kembali kasus lama dimana tiga teman Zuckerberg, Cameron dan Tyler Winklevoss serta Divya Narendra mengklaim Zuckerberg telah mencuri ide mereka untuk membuat Facebook.\r\n\r\nPada saat Zuckerberg meluncurkan Facebook, mereka menuntut perkara atas Zuckerberg. Awal tahun ini, pengadilan AS memutuskan Facebook harus membayar USD65 juta untuk melunasi perkara ini.\r\n', 'Minggu', '2009-10-25', '07:36:47', '17mark_zuckerberg.jpg', 12, 'film');
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `judul_seo`, `isi_berita`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`) VALUES
(90, 29, 'admin', 'Ferrari 458 Polesan Teknologi Jepang', 'ferrari-458-polesan-teknologi-jepang', 'Barangkali hanya Jepang (diluar Italia) yang berani ''memoles'' bodi mobil dari Ferrari, sekaligus mengumumkan hasilnya kepada publik. Seperti dilakukan rumah modifikasi ASI terhadap Ferrari 458 yang oleh pabrikannya di Italia baru di launching.\r\n\r\nASI terkenal dengan keberaniannya menggarap proyek berisiko tinggi. Beberapa mobil berharga miliaran rupiah pernah digarap dan membuat tampilan mobil lebih sporty dan tambah dinamis dari versi standar.\r\n\r\nSebut saja, Bentley Continental GT (yang diberi julukan The ASI Tetsu GTR) dan Ferrari 430. Bahkan Ferrari milik seorang pengusaha muda di Indonesia pernah juga dimodifikasi (bodi) di Jepang pada 2007.\r\n\r\nCEO ASI Satoshi Kondo menjelaskan, bahwa tim rekayasanya telah bekerja keras memproduksi aerokit untuk Ferrari 458. ASI, katanya sengaja mengeluarkan sketsa dari hasil kerja mereka dengan terus melakukan finalisasi prototype yang ada, dan menghindari pencurian desain.\r\n\r\nSentuhan pada bagian depan dari kuda jingkrak menjadi salah satu yang menonjol. Di antaranya moncong yang baru, lubang udara lebih besar, dan dilanjutkan pada bagian roda. Dari sketsa gambar tampak terpasang sayap baru di bagian belakang.\r\n\r\nPaket body kit dari ASI mempertegas tampilan Ferrari sebagai hasil kawin silang dari gaya tuner Jepang dengan kendaraan eksotis khas Italia. ASI mengklaim, adanya perubahan dan penambahan pada bodi tidak mengurangi performa standar. Bahkan bobot kendaraan lebih ringan dari asli. (sumber: kompas.com)\r\n', 'Minggu', '2009-10-25', '07:44:05', '4ferrari458.jpg', 9, 'mobil'),
(86, 22, 'admin', 'Program 100 Hari Menkominfo Tifatul', 'program-100-hari-menkominfo-tifatul', 'Belum juga resmi diumumkan masuk jajaran kabinet, sejumlah calon menteri sudah berani membeberkan programnya. Salah satunya, Tifatul Sembiring. Tifatul disebut-sebut sebagai calon kuat Menkominfo (Menteri Komunikasi dan Informasi).\r\n\r\nApa saja program Tifatul? "100 Hari pertama? Kita targetkan sampai 2014 itu ada 10 ribu desa komputer. Presiden menargetkan tiga bulan ini ada 100 desa komputer harus tercapai," kata Tifatul di Gedung MPR/DPR, Jakarta, Selasa 20 Oktober 2009.\r\n\r\nKomputer-komputer ini, kata dia, bisa dimasukkan ke lembaga pendidikan untuk meningkatkan sumber daya manusia. Bagaimana SDM Indonesia bisa masuk ke bisnis supaya Indonesia bisa bersaing dengan negara-negara lain. Selain itu juga untuk meningkatkan e-goverment untuk meminimalisir korupsi, kolusi, kolusi dan nepotisme.\r\n\r\nDengan e-goverment, kata dia, maka nantinya semua urusan menjadi less paper. Artinya pegawai di tingkat pemda dan kecamatan, tidak lagi menerima uang tunai. "Tapi cukup menerima resi, sehingga sogok menyogok bisa diminimalisir," kata dia.\r\n\r\nTifatul sendiri mengaku tidak begitu asing dengan dunia Kominfo karena latar belakang pendidikannya cukup mendukung. Gelar sarjana strata satunya di bidang Informatika dan Komunikasi. Ia juga mengaju pernah bekerja selama delapan tahun di sistem informatika dan komunikasi PT Perusahaan Listrik Negara.\r\n\r\nSementara strata duanya di bidang politik internasional di Islamabad, Pakistan. "Itu saja sih, pinter ya belum, diupayakan sesuai," kata dia.\r\n\r\nNamun ia berharap bisa menembus tantangan Kominfo ke depan, yakni perbedaan kemudahan akses di kota besar dan desa. Selain itu juga soal infrastruktur yang masih lemah. Masalah lain, kurangnya tayangan edukatif di bidang informasi. "Dalam satu riset dikatakan 10 dari 75 tayangan di TV, radio masih bermasalah," kata dia.\r\n\r\nDia menambahkan, pelayanan informasi di Indonesia juga masih  lemah. Karena itu ia akan mengusahakan peningkatan layanan informasi ini. (Sumber: vivanews.com)\r\n', 'Minggu', '2009-10-25', '07:49:46', '27tifatul_sembiring.jpg', 10, 'komputer'),
(93, 23, 'admin', 'Dalam Dua Pekan, KCB 2 Ditonton 1,5 Juta Penonton', 'dalam-dua-pekan-kcb-2-ditonton-15-juta-penonton', 'Film Ketika Cinta Bertasbih (KCB) 2 diyakini bakal mereguk sukses seperti sekuel pertamanya Sejak diputar perdana tanggal 17 September lalu atau selama 15 hari, film garapan SinemArt telah disaksikan 1,5 juta penonton.\r\n\r\nRekor yang sama juga dialami KCB 1. "Pada pemutaran KCB 1 kami bisa memecah rekor pemutaran film di Indonesia, yaitu mendapat penonton sebanyak 100.000 perhari," ungkap Frans dari SinemArt saat promo film KCB 2 di Royal Plaza, Minggu (4/10).\r\n\r\nPihak SinemArt berharap KCB 2 bisa meraih prestasi minimal sama dengan KCB 1 dengan total 3 juta penonton. Untuk mencapai target tersebut, pihak SinemArt tak henti melakukan serangkaian promo di sejumlah kota di Tanah Air maupun di mancanegara.\r\n\r\n"Hari ini (Minggu, 4/10), Kholidi (Kholidi Asadil Alam, pemeran Azzam) dan Oki (Oki Setiana Dewi pemeran Anna) ke Hongkong untuk promo di sana," imbuh Frans. Pekan depan (10-12 Oktober 2009), giliran Meyda Sefira berangkat ke Makau untuk kegiatan yang sama.\r\n\r\nFilm besutan sutradara Chaerul Umam ini juga dijadwalkan diputar di Aceh pada tanggal 11-12 Oktober mendatang. Menurut Frans, pemutaran KCB 1 di kota yang dikenal dengan sebutan Serambi Mekkah ini ditonton 8.000 orang.\r\n\r\nPadahal di kota tersebut sama sekali tidak ada gedung bioskop. Karena itu kru SinemArt terpaksa mengusung peralatan khusus dari Jakarta dan memutar di sebuah gedung khusus selama dua hari dalam tujuh kali show.\r\n\r\nBertutur tentang kesan berperan di KCB 2, Kholidi beberapa waktu lalu mengaku paling terkesan dengan adegan kecelakaan saat membonceng Bu''e (Ninik L Karim). Karena ketika sepeda motornya terjatuh dia harus teriak memanggil ibundanya. "Bu''eee! Wah itu lumayan sulit," ungkap Kholidi.\r\n\r\nAdegan lain yang cukup berkesan adalah ketika pria asal Pasuruan ini terkapar di rumah sakit paska kecelakaan yang dia alami. "Ekspresi orang sakitnya kan harus dapat. Terus suaranya juga harus disesuaikan, tidak seperti kita ngomong biasa, jadi agak sedikit tertahan di tenggorokan, powernya tidak full seperti ngomong biasanya," bebernya.\r\n\r\nUntuk adegan itu Kholidi yang kini menempuh pendidikan di Universitas Al Azhar, Jakarta melakukan observasi pada beberapa orang yang pernah mengalami kecelakaan. "Aku juga tanya-tanya ke dokter. Ternyata di tempat tidurnya nggak bisa pakai bantal, posisi badannya harus lurus. Terus kalau ada gips di kaki, posisi jalan kita akan seperti apa. Biar nantinya terlihat lebih reel lah adengannya,"  pungkas Kholidi. (sumber: surya.co.id) \r\n', 'Minggu', '2009-10-25', '07:55:45', '54kcb2.jpg', 20, 'film'),
(91, 2, 'admin', 'Manchester United Incar Zidane Baru', 'manchester-united-incar-zidane-baru', 'Manchester United sedang mengincar pemain muda Perancis berdarah Aljazair. Pemain itu adalah Sofiane Feghouli yang baru berusia 19 tahun.\r\n\r\nSofiane Feghouli saat ini memperkuat tim Liga Perancis, Grenoble Foot 38. Posisinya adalah di lapangan tengah.\r\n\r\nPemain yang punya tinggi badan 178 cm itu disebut punya gaya bermain yang serupa dengan Zinedine Zidane. Feghouli sudah masuk dalam tim nasional Perancis U-21.\r\n\r\nTak hanya MU yang menginginkan pemain yang pernah ditolak Paris Saint-Germain itu. Tim-tim besar macam Barcelona, Liverpool dan Inter Milan juga sedang mengambil ancang-ancang untuk mengajukan tawaran.\r\n\r\nSeperti diberitakan Tribalfootball, MU sudah berencana untuk melakukan transaksi dengan Grenoble bulan Januari nanti. (Sumber: vivanews.com)\r\n', 'Minggu', '2009-10-25', '13:58:18', '62sofiane.jpg', 6, 'sepakbola'),
(95, 19, 'bahrin', 'Ubuntu di Java, Oracle  Java 7', 'ubuntu-java', 'Beberapa hari yang lalu, saya sudah menulis artikel mengenai bagaimana menginstal Sun Java 6 di Ubuntu via PPA. Pada artikel tersebut paket aplikasi Sun Java diunduh dari Launchpad PPA, namun Oracle Java 7 tidak bisa demikian karena masalah lisensi yaitu harus mengunduh langsung dari situsnya seperti halnya Flash Player. Untungnya ada pengurus blog WebUpd8 yang sudah membuatkan script untuk mengunduh dan menginstal Oracle Java 7 di komputer. Ditambah lagi, script tersebut sudah diunggah ke Launchpad sehingga kalian tidak perlu pusing-pusing menginstalnya. Baiklah mari kita mulai!\r\nUntuk menginstal script yang saya maksud silakan ketik perintah berikut di Terminal:\r\nview plainprint?\r\n1.	sudo add-apt-repository ppa:webupd8team/java\r\n2.	sudo apt-get update\r\n3.	sudo apt-get install oracle-jdk7-installer\r\nSelama proses instalasi, script secara otomatis akan mengunduh Oracle Java 7 dari situsnya kemudian menginstalnya di komputer. Jika kalian untuk menghapus Oracle Java 7, cukup ketik perintah berikut di Terminal:\r\nview plainprint?\r\n1.	sudo apt-get remove oracle-jdk7-installer\r\nvia: WebUpd8\r\nSumber: http://www.tahutek.net/2012/01/ubuntu-script-untuk-menginstal-oracle.html\r\n', 'Sabtu', '2012-03-17', '13:40:00', 'Ubuntujava.jpg', 12, 'Delphi-java'),
(94, 19, 'bahrin', 'Multitasking di Delphi 7.0', 'multitasking-delphi7', 'Windows, Linux, dan sistem operasi yang sekarang berkembang sudah mendukung multi-tasking misalnya Kita bisa mendengarkan musik (WinAmp) sambil ngetik (MS Word). Sementara itu “tanpa kita sadari”, program anti virus melakukan tugasnya dengan men-scan setiap ada file yang dibuka (background program). Multi-tasking artinya melakukan banyak pekerjaan, dalam hal ini menjalankan program,dalam satu waktu. Walaupun pada sistem yang masih menggunakan single prosesor sebenarnya tidak lebih dari pada pembagiam waktu kerja, task scheduling. Jadi OS sudah tahu, kapan membaca huruf apa yang diketik di keyboard, terus kapan megirim data ke buffer soundcard agar musik tidak skip dan sebagainya. Pada kecepatan prosesor yang GHz, tentu scheduling time akan berada di orde nanosecond, dan manusia tidak akan dapat membedakan.\r\nSelain di tingat OS, sebuah program juga bisa melakukan multitasking. Nah dalam postingan kali ini saya akan coba bahas bagaimana membuat sebuah program multi-tasking dengan Delphi. Tampilan programnya seperti gambar berikut:\r\nSeringkali kita membuat sebuah task di mana waktu eksekusi sampai selesai tersebut sangat lama. Jika tidak menggunakan multi-task akan membuat program kita seperti hang.\r\nCobalah klik tombol Normal, lalu coba pindahkan windows programnya. Apa yang terjadi? Program tidak merespon apa-apa (hang). Program tombol ini sebenarnya hanya menampilkan angka 0 sampai 3000 dengan jeda 1 milidetik\r\nprocedure TForm1.Button1Click(Sender: TObject);\r\nvar\r\ni:integer;\r\nbegin\r\nfor I := 0 to 3000 do\r\nbegin\r\nLabel1.Caption:=IntToStr(i);\r\nUpdate;\r\nsleep(1);\r\nend;\r\nend;\r\nBahkan ketika perintah Update dihilangkan, perubahan label1 tidak terlihat, tahu-tahu sudah menjadi 3000. Dalam prosedur ini, tidak ada handle untuk merespon message (misal mouse drag atau mouse click).\r\nSekarang kita sisipkan di looping for perintah untuk merespon message yaitu application processmessage. Klik tombol aplication.processmessage, lalu coba pindahkan formnya. Apa yang terjadi? Kita bisa memindahkan form, tapi saat dipindah, program berhenti menghitung. Arti dari Application.ProcessMessage adalah saat menerima message, program akan berhenti dulu dari task yang sekarang, dan mengerjakan message yang diterima, setelah selesai baru kembali ke task yang tadi.\r\nprocedure TForm1.Button2Click(Sender: TObject);\r\nvar\r\ni:integer;\r\nbegin\r\nfor I := 0 to 3000 do\r\nbegin\r\nApplication.ProcessMessages;\r\nLabel1.Caption:=IntToStr(i);\r\nUpdate;\r\nsleep(1);\r\nend;\r\nend;\r\nPertanyaannya, bagaimana agar program tetap menghitung walaupun form dipindah-pindahkan?\r\nPakailah Thread, copy paste dari Wikipedia:\r\nIn computer science, a thread of execution is the smallest unit of processing that can be scheduled by an operating system. It generally results from a fork of a computer program into two or more concurrently running tasks. The implementation of threads and processes differs from one operating system to another, but in most cases, a thread is contained inside a process. Multiple threads can exist within the same process and share resources such as memory, while different processes do not share these resources. In particular, the threads of a process share the latter’s instructions (its code) and its context (the values that its variables reference at any given moment). To give an analogy, multiple threads in a process are like multiple cooks reading off the same cook book and following its instructions, not necessarily from the same page.\r\nOn a single processor, multithreading generally occurs by time-division multiplexing (as in multitasking): the processor switches between different threads. This context switching generally happens frequently enough that the user perceives the threads or tasks as running at the same \r\ntime. On a multiprocessor or multi-core system, the threads or tasks will actually run at the same time, with each processor or core running a particular thread or task.\r\nMany modern operating systems directly support both time-sliced and multiprocessor threading with a process scheduler. The kernel of an operating system allows programmers to manipulate threads via the system call interface. Some implementations are called a kernel thread, whereas a lightweight process (LWP) is a specific type of kernel thread that shares the same state and information.\r\nPrograms can have user-space threads when threading with timers, signals, or other methods to interrupt their own execution, performing a sort of ad-hoc time-slicing.\r\n', 'Sabtu', '2012-03-17', '13:50:00', 'multitaskingdelphi.jpg', 11, 'Delphi-java'),
(96, 19, 'bahrin', 'Thread di Delphi 7.0', 'thread-delphi', 'Thread adalah sebuah class. Untuk membuat Thread, bisa lewat Delphi sendiri ataupun menggunakan komponen. Pada kesempatan ini thread dibuat lewat Delphi. Untuk membuat Thread di Delphi 2007, File/New/Others, di Delphi Files, pilih Thread Object.\r\nSetelah klik oK, Delphi akan menanyakan nama class dan nama thread. Ketika klik OK Delphi akan membuat sebuah file unit baru.\r\nDi dalam file unit tersebut ada sebuah prosedure yaitu prosedur execute. Prosedure inilah yang akan dikerjakan saat Thread dieksekusi:\r\nprocedure MyThread.Execute;\r\nvar\r\ni:integer;\r\nbegin\r\nSetName;\r\n{ Place thread code here }\r\nfor I := 0 to 3000 do\r\nbegin\r\nTheNumber:=i;\r\nSynchronize(UpdateLabel);\r\nsleep(1);\r\nend; \r\nend;\r\nPerintah yang akan dikerjakan sama yaitu menampilkan 0-3000 ke Label. Cuma karena akan mengubah property komponen VCL dalam thread, disarankan untuk menggunakan metode Synchronize. Oleh karena itu dibuatlah sebuah prosedur UpdateLabel:\r\nprocedure MyThread.UpdateLabel;\r\nbegin\r\nForm1.Label1.Caption:=IntToStr(TheNumber);\r\nend;\r\nTheNumber adalah variable berbentuk integer yang dideklarasikan di private deklarasi.\r\nUntuk menjalankan Thread ini tinggal digunakan resume setelah Thread dibuat (create):\r\nprocedure TForm1.Button3Click(Sender: TObject);\r\nbegin\r\nif (not ThreadRun)   then\r\nbegin\r\nMyThread1:=MyThread.Create(true);\r\nMyThread1.Resume;\r\nend;\r\nend;\r\nSekarang coba klik button Thread dan coba pindahkan Formnya. Apa yang terjadi? Form bisa dipindah-pindah dan proses perhitngan pun tetap berjalan. Artinya program ini melakukan multitasking, yaitu menghitung dan merespon message event mouse.\r\nSemoga bermanfaat.\r\n', 'Sabtu', '2012-03-17', '14:00:00', 'threaddelphi.jpg', 13, 'Delphi-java');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `id_download` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_file` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `hits` int(3) NOT NULL,
  PRIMARY KEY (`id_download`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id_download`, `judul`, `nama_file`, `tgl_posting`, `hits`) VALUES
(3, 'Membuat Shopping Cart dengan PHP', 'shopping cart.pdf', '2009-02-17', 4),
(5, 'Skrip Captcha', 'captcha.rar', '2009-02-06', 3),
(1, 'Kalender Tahun 2009', 'kalender2009.rar', '2009-02-06', 7),
(8, 'Wallpaper PHP', 'PHP_weapon.jpg', '2009-10-28', 2),
(9, 'Slide  Pemrograman VBA Excell', 'Excell_VBA.ppt', '2009-11-03', 4);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id_gallery` int(5) NOT NULL AUTO_INCREMENT,
  `id_album` int(5) NOT NULL,
  `jdl_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gallery_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_gallery`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `id_album`, `jdl_gallery`, `gallery_seo`, `keterangan`, `gbr_gallery`) VALUES
(3, 12, 'Duduk di Sofa', 'duduk-di-sofa', 'Sekeluarga sedang duduk di sofa.', '27587family sofa.jpg'),
(4, 12, 'Didepan Rumah', 'didepan-rumah', 'Sekeluarga sedang berada di ladang.', '258819family field.jpg'),
(5, 12, 'Keluarga Bahagia', 'keluarga-bahagia', 'Si anak memperlihatkan lukisan.', '697448family.jpg'),
(18, 21, 'Naruto and Crew', 'naruto-and-crew', 'Naruto dan kawan-kawan.', '586303naruto-and-crew.jpg'),
(7, 19, 'Lebah', 'lebah', 'Lebah besar terbang.', '322906lebah.jpg'),
(8, 17, 'Bangunan Jepang', 'bangunan-jepang', 'Bangunan khas jepang', '370422arche037.jpg'),
(9, 17, 'Candi Merang', 'candi-merang', 'Bangunan candi khas kerajaan', '346527arche014.jpg'),
(10, 18, 'Cukur Janggut', 'cukur-janggut', 'Bayi unik sedang cukur rambut', '892395macho4.jpg'),
(11, 18, 'Push Up', 'push-up', 'Bayi unik sedang melakukan push-up', '991546macho1.jpg'),
(12, 19, 'Kuda Nyengir', 'kuda-nyengir', 'Gini nih kalau kuda lagi nyengir.', '658447kuda.jpg'),
(13, 21, 'Super Mario Bross', 'super-mario-bross', 'Game klasik 3D Mario Bross.', '601318mario bros.jpg'),
(32, 21, 'Naruto', 'naruto', 'Kartun ninja jepang Naruto', '45440naruto.jpg'),
(15, 21, 'Superman', 'superman', 'Superman kecil mau beraksi', '689147superman.jpg'),
(17, 21, 'Spongebob', 'spongebob', 'Spongebob', '22491sponge_bob_2.jpg'),
(21, 21, 'Monster', 'monster', 'Film Monster Inc dari Pixar Studio', '937683monster.jpg'),
(19, 21, 'Robot', 'robot', 'Funny 3D Robot', '240447robot.jpg'),
(20, 21, 'Koboi', 'koboi', 'Game dari Film Desperados', '791595desperado.jpg'),
(27, 21, 'Sonic', 'sonic', 'Sonic and Friend', '152618sonic.jpg'),
(24, 21, 'Final Fantasy X', 'final-fantasy-x', 'Rinoa Final Fantasy', '743164fantasy.jpg'),
(31, 21, 'Kungfu Panda', 'kungfu-panda', 'Jack Black', '550598panda2.jpg'),
(33, 21, 'Maskot Euro 2008', 'maskot-euro-2008', 'Trix dan Flix di Euro 2008', '816528mascot.jpg'),
(14, 21, 'Harry Potter', 'harry-potter', 'Game Harry Potter', '735687potter.jpg'),
(42, 21, 'Avatar', 'avatar', 'Eng si Gundul Avatar', '874877avatar.jpg'),
(16, 21, 'Shrek', 'shrek', 'Film 3D Shrek 2', '527801shrek06_800.jpg'),
(44, 21, 'Kenshin', 'kenshin', 'Kenshin Himura', '494110himura.jpg'),
(45, 21, 'Sun Goku', 'sun-goku', 'Goku Cilik', '266845goku.JPG'),
(46, 21, 'Virtual Girl', 'virtual-girl', 'Gadis Cantik 3D', '837921Girl.jpg'),
(23, 18, 'Nurul Sakinah Bahrin', 'nurul-sakinah', 'nurul sakinah lagi naik kereta', 'PICT0020.jpg'),
(25, 18, 'Sakinah23', 'sakinah23', 'kinah pakai muslimah', 'PICT0023.jpg'),
(26, 18, 'Sakinah24', 'sakinah24', 'sakinah 24', 'PICT0026.jpg'),
(28, 18, 'sakinah25', 'sakinah25', 'nurul sakinah25', 'PICT0025.jpg'),
(29, 18, 'sakinah26', 'sakinah26', 'sakinah', 'PICT0026.jpg'),
(30, 18, 'sakinah27', 'sakinah27', 'sakinah27', 'PICT0027.jpg'),
(34, 18, 'sakinah28', 'sakinah28', 'sakinah28', 'PICT0028.jpg'),
(35, 18, 'sakinah29', 'sakinah29', 'sakinah29', 'PICT0029.jpg'),
(36, 18, 'sakinah30', 'sakinah30', 'sakinah30', 'PICT0030.jpg'),
(37, 18, 'sakinah31', 'sakinah31', 'sakinah31', 'PICT0031.jpg'),
(38, 18, 'sakinah32', 'sakinah32', 'sakinah32', 'PICT0032.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi`
--

CREATE TABLE IF NOT EXISTS `hubungi` (
  `id_hubungi` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_hubungi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hubungi`
--

INSERT INTO `hubungi` (`id_hubungi`, `nama`, `email`, `subjek`, `pesan`, `tanggal`) VALUES
(1, 'Ariawan', 'ariawan@gmail.com', 'Mohon Informasi', 'Mohon informasi mengenai buku yang diterbitkan oleh Lokomedia.', '2008-02-10'),
(4, 'lukman', 'lukman@hakim', 'Request Code', 'Tolong dunk ..', '2009-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `katajelek`
--

CREATE TABLE IF NOT EXISTS `katajelek` (
  `id_jelek` int(11) NOT NULL AUTO_INCREMENT,
  `kata` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `ganti` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_jelek`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `katajelek`
--

INSERT INTO `katajelek` (`id_jelek`, `kata`, `ganti`) VALUES
(4, 'sex', 's**'),
(2, 'bajingan', 'b*******'),
(3, 'bangsat', 'b******');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kategori_seo`) VALUES
(19, 'Teknologi', 'teknologi'),
(2, 'Olahraga', 'olahraga'),
(21, 'Ekonomi', 'ekonomi'),
(22, 'Politik', 'politik'),
(23, 'Hiburan', 'hiburan'),
(29, 'Otomotif', 'otomotif'),
(30, 'Agama', 'agama'),
(31, 'Pendidikan', 'pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id_komentar` int(5) NOT NULL AUTO_INCREMENT,
  `id_berita` int(5) NOT NULL,
  `nama_komentar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_komentar` text COLLATE latin1_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `jam_komentar` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_komentar`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_berita`, `nama_komentar`, `url`, `isi_komentar`, `tgl`, `jam_komentar`, `aktif`) VALUES
(12, 71, 'Wisnu', 'wisnu.wordpress.com', 'pertamax', '2009-02-02', '08:10:23', 'Y'),
(13, 71, 'Adrian', 'adrian.blogspot.com', 'CR 7 emang idola gua, melesat terus ya prestasinya.', '2009-02-02', '09:06:01', 'Y'),
(15, 79, 'Armen', 'detik.com', 'ahmadinejad emang idolaku', '2009-02-03', '10:05:20', 'Y'),
(17, 74, 'Lukman', 'http://hakim.com', 'apakah browser google secanggih search enginenya?', '2009-02-21', '10:12:23', 'Y'),
(34, 92, 'Rudi', 'bukulokomedia.com', ' Kalau  tentang  gue,  kapan  dibuat  filmnya  ya?   ', '2009-10-28', '21:21:21', 'Y'),
(22, 77, 'Raihan', 'bukulokomedia.com', 'mas .. tolong kirimin source code proyek lokomedia&nbsp; ke email saya di raihan@gmail.com', '2009-08-25', '16:30:00', 'Y'),
(23, 77, 'Wawan', 'bukulokomedia.com', 'woi .. kunjungin dong website saya di http://bukulokomedia.com, jangan lupa kasih komen dan sarannya ya.', '2009-08-25', '16:31:50', 'Y'),
(36, 92, 'bahrin', 'www.bahrin.com', 'seruuuuuuuuu.....m ieeeeeeeeeeee.... .......  ', '2012-03-15', '16:52:44', 'Y'),
(37, 61, 'bahrin', 'www.bahrin.com', ' asyik...hantm  saja  ......   ', '2012-03-15', '20:40:54', 'Y'),
(38, 96, 'wiwi', 'www.wiwiw.com', ' okeyyyyyy   ', '2012-03-17', '17:44:49', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `status` enum('user','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Manajemen User', '?module=user', '', '', 'N', 'user', 'Y', 1, ''),
(18, 'Berita', '?module=berita', '', '', 'Y', 'user', 'Y', 6, 'semua-berita.html'),
(19, 'Banner', '?module=banner', '', '', 'N', 'admin', 'Y', 9, ''),
(37, 'Profil', '?module=profil', '<b>Bahrin.com</b> merupakan website resmi dari penulis freelance yang bermarkas di Jl.Perintis Kemerdekaan 7 Blok G No. 4 Tamalanrea Makassar Sulsel. Dirintis pertama kali oleh Bahrin Dahlan pada tanggal 14 Maret 2012.<br><br>Produk unggulan dari penulis  adalah buku-buku serta aksesoris bertema JAVA, MySQL,J2ME, Delphi, C/C++, PASCAL, Visual Basic, Android dan PHP (<span style="font-weight: bold; font-style: italic;">PHP: Hypertext Preprocessor</span>) yang merupakan pemrograman Internet paling handal saat ini.\r\n<center style="text-decoration: underline;"><b>CURICULUM VITAE</b></center>\r\n<ul><li><blockquete>\r\nNAMA LENGKAP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		                :  B A H R I N D A H L A N,  S.Kom\r\n</blockquete></li><li><blockquete>NIDN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				: 09040575001\r\n</blockquete></li><li><blockquete>TEMPAT TGL.LAHIR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		: CAMPAGAYA/JENEPONTO, 04 MEI 1975\r\n</blockquete></li><li><blockquete>ALAMAT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			                : JL. PERINTIS KEMERDEKAAN VII BLOK G No.04 MAKASSAR\r\n</blockquete></li><li><blockquete>AGAMA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ISLAM\r\n</blockquete></li><li><blockquete>PENDIDIKAN TERAKHIR	                : SARJANA STRATA SATU(S1) TEKNIK INFORMATIKA\r\n			                   FAK.ILMU KOMPUTER  UMI MAKASSAR\r\n</blockquete></li><li><blockquete>No.TELPON/HP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		                : +685240447537</blockquete><br><blockquete>&nbsp;<b>RIWAYAT KARIR :</b> <br></blockquete></li></ul><ol><li><blockquete>ASISTEN DOSEN TEKNIK INFORMATIKA FAKULTAS ILMU KOMPUTER UNIVERSITAS MUSLIM INDONESIA MAKASSAR TAHUN 2002-2005 <br></blockquete></li><li><blockquete>DOSEN TETAP UNIVERSITAS ICHSAN GORONTALO TAHUN 2005-SEKARANG <br></blockquete></li><li><blockquete>DOSEN LUAR BIASA STMIK ICHSAN GORONTALO TAHUN 2005-SEKARANG <br></blockquete></li><li><blockquete>DOSEN LUAR BIASA JURUSAN TEKNIK INFORMATIKA FAKULTAS TEKNIK UNIVERSITAS NEGERI GORONTALO 2006-SEKARANG <br></blockquete></li><li><blockquete>DOSEN LUAR BIASA TEKNIK INFORMATIKA FIKOM UMI MAKASSAR TAHUN 2008-2010 <br></blockquete></li><li><blockquete>MAHASISWA PASCASARJANA KONSENTRASI TEKNIK INFORMATIKA UNIVERSITAS HASANUDDIN MAKASSAR ANGKATAN 2008&nbsp; </blockquete></li></ol><ul><li> <blockquete>MAKASSAR, 17 MARET 2012\r\n\r\n\r\n\r\n\r\n\r\n								        B A H R I N DAHLAN, S.Kom\r\n								        NIDN. 09040575001\r\n</blockquete></li></ul>', 'ungteknik_kecil.jpg', 'Y', 'admin', 'Y', 3, 'profil-kami.html'),
(10, 'Manajemen Modul', '?module=modul', '', '', 'Y', 'admin', 'Y', 2, ''),
(31, 'Kategori', '?module=kategori', '', '', 'N', 'admin', 'Y', 5, ''),
(33, 'Poling', '?module=poling', '', '', 'N', 'admin', 'Y', 10, ''),
(34, 'Tag (Label)', '?module=tag', '', '', 'N', 'admin', 'Y', 6, ''),
(35, 'Komentar', '?module=komentar', '', '', 'N', 'admin', 'Y', 7, ''),
(36, 'Download', '?module=download', '', '', 'Y', 'admin', 'Y', 8, 'semua-download.html'),
(40, 'Hubungi Kami', '?module=hubungi', '', '', 'Y', 'admin', 'Y', 12, 'hubungi-kami.html'),
(41, 'Agenda', ' ?module=agenda', '', '', 'Y', 'user', 'Y', 4, 'semua-agenda.html'),
(42, 'Shoutbox', '?module=shoutbox', '', '', 'Y', 'admin', 'Y', 13, ''),
(43, 'Album', '?module=album', '', '', 'N', 'admin', 'Y', 14, ''),
(44, 'Galeri Foto', '?module=galerifoto', '', '', 'Y', 'admin', 'Y', 15, ''),
(45, 'Templates', '?module=templates', '', '', 'N', 'admin', 'Y', 16, ''),
(46, 'Kata Jelek', '?module=katajelek', '', '', 'N', 'admin', 'Y', 17, '');

-- --------------------------------------------------------

--
-- Table structure for table `poling`
--

CREATE TABLE IF NOT EXISTS `poling` (
  `id_poling` int(5) NOT NULL AUTO_INCREMENT,
  `pilihan` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `rating` int(5) NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_poling`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `poling`
--

INSERT INTO `poling` (`id_poling`, `pilihan`, `rating`, `aktif`) VALUES
(1, 'Internet Explorer', 15, 'Y'),
(2, 'Mozilla Firefox', 79, 'Y'),
(3, 'Google Chrome', 21, 'Y'),
(4, 'Opera', 22, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `shoutbox`
--

CREATE TABLE IF NOT EXISTS `shoutbox` (
  `id_shoutbox` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `website` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_shoutbox`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `shoutbox`
--

INSERT INTO `shoutbox` (`id_shoutbox`, `nama`, `website`, `pesan`, `tanggal`, `jam`, `aktif`) VALUES
(1, 'lukman', 'lukman.com', 'tes :-) aja ;-D ha ha ha <:D>', '2009-11-02', '00:00:00', 'Y'),
(2, 'hakim', 'hakim.com', 'tes :-) aja ;-D ha ha ha <:D>\r\ndfa\r\nfdas\r\nfdsa\r\nfdasf\r\n:-(', '2009-11-02', '00:00:00', 'Y'),
(3, 'daryono', 'bukulokomedia.com', 'ku tes lagi<br>\r\ntes :-) aja ;-D ha ha ha &lt;:D&gt;<br>\r\ndfa<br>\r\nfdas<br>\r\nfdsa<br>\r\nfdasf<br>\r\n:-(', '2009-11-02', '13:55:00', 'Y'),
(5, 'iin', 'uin-suka.ac.id', 'tes aja euy ;-D boi', '2009-11-03', '11:36:06', 'Y'),
(6, 'bahrin', 'bahrin.com', ';-D', '2012-03-15', '16:33:36', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE IF NOT EXISTS `statistik` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '1',
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statistik`
--

INSERT INTO `statistik` (`ip`, `tanggal`, `hits`, `online`) VALUES
('127.0.0.2', '2009-09-11', 1, '1252681630'),
('127.0.0.1', '2009-09-11', 17, '1252734209'),
('127.0.0.3', '2009-09-12', 8, '1252817594'),
('127.0.0.1', '2009-10-24', 8, '1256381921'),
('127.0.0.1', '2009-10-26', 108, '1256620074'),
('127.0.0.1', '2009-10-27', 52, '1256686769'),
('127.0.0.1', '2009-10-28', 124, '1256792223'),
('127.0.0.1', '2009-10-29', 9, '1256828032'),
('127.0.0.1', '2009-10-31', 3, '1257047101'),
('127.0.0.1', '2009-11-01', 85, '1257113554'),
('127.0.0.1', '2009-11-02', 11, '1257207543'),
('127.0.0.1', '2009-11-03', 165, '1257292312'),
('127.0.0.1', '2009-11-04', 12, '1257351239'),
('127.0.0.1', '2012-03-15', 119, '1331877856'),
('127.0.0.1', '2012-03-16', 10, '1331926283'),
('127.0.0.1', '2012-03-17', 153, '1332036397'),
('127.0.0.1', '2012-03-18', 6, '1332138143'),
('127.0.0.1', '2012-03-19', 88, '1332217098'),
('127.0.0.1', '2012-03-21', 9, '1332398316'),
('127.0.0.1', '2012-04-11', 5, '1334167626'),
('127.0.0.1', '2012-04-13', 32, '1334343265'),
('127.0.0.1', '2012-04-16', 4, '1334622214'),
('127.0.0.1', '2012-05-02', 1, '1335961838'),
('127.0.0.1', '2012-05-04', 9, '1336193044'),
('127.0.0.1', '2012-05-16', 2, '1337164586'),
('127.0.0.1', '2012-07-14', 7, '1342255434'),
('::1', '2017-04-09', 10, '1491765916'),
('::1', '2017-04-10', 8, '1491801880'),
('::1', '2019-01-15', 60, '1547533872'),
('::1', '2021-02-02', 18, '1612242916'),
('::1', '2021-11-15', 8, '1636968874'),
('::1', '2022-02-09', 9, '1644372442'),
('::1', '2022-04-13', 3, '1649841351'),
('::1', '2022-09-08', 4, '1662629230');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int(5) NOT NULL AUTO_INCREMENT,
  `nama_tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tag_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `count` int(5) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id_tag`, `nama_tag`, `tag_seo`, `count`) VALUES
(1, 'Palestina', 'palestina', 4),
(2, 'Gaza', 'gaza', 4),
(9, 'Tenis', 'tenis', 5),
(10, 'Sepakbola', 'sepakbola', 3),
(8, 'Laskar Pelangi', 'laskar-pelangi', 2),
(11, 'Amerika', 'amerika', 10),
(12, 'George Bush', 'george-bush', 2),
(13, 'Browser', 'browser', 5),
(14, 'Google', 'google', 2),
(15, 'Israel', 'israel', 4),
(16, 'Komputer', 'komputer', 3),
(17, 'Film', 'film', 2),
(19, 'Mobil', 'mobil', 0),
(20, 'Delphi-java', 'delphi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id_templates` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pembuat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `folder` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_templates`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id_templates`, `judul`, `pembuat`, `folder`, `aktif`) VALUES
(1, 'Standar', 'Lukmanul Hakim', 'templates/standar', 'Y'),
(2, 'Building', 'Lukmanul Hakim', 'templates/building', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@detik.com', '08238923848', 'admin', 'N', 'pjuk8hqd8ms7lqmvuj8oujr5f2'),
('bahrin', '958f62f9f8b7f348d08943189fda3b15', 'Bahrin Dahlan', 'majongbahrin@yahoo.co.id', '09945849545', 'user', 'N', '958f62f9f8b7f348d08943189fda3b15'),
('dahlan', '4e5ad0dc4d478726661c8c2b3ea31777', 'Dahlan Majong', 'bahrin_dl3@yahoo.com', '0895485045958', 'user', 'N', '4e5ad0dc4d478726661c8c2b3ea31777'),
('wiro', '7577bfe4fecd40c43e6140344d90ce0e', 'Wiro Sableng', 'wiro@detik.com', '038039403948', 'user', 'N', '14c0676a2ff6f9ecd3f3c1cc0c1e8e7f'),
('sriwahyuni', '59131944e28ae75b11d858b0700ad2a2', 'Sri Wahyuni Umuur', 'sriwahyuniummur@yahoo.co.id', '085240788399', 'user', 'N', '59131944e28ae75b11d858b0700ad2a2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
