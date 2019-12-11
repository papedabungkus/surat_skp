DROP TABLE pangkatgol;

CREATE TABLE `pangkatgol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pangkat` varchar(45) DEFAULT NULL,
  `golongan` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO pangkatgol VALUES("1","PEMBINA UTAMA","IV/E");
INSERT INTO pangkatgol VALUES("2","PEMBINA UTAMA MADYA","IV/D");
INSERT INTO pangkatgol VALUES("3","PEMBINA UTAMA MUDA","IV/C");
INSERT INTO pangkatgol VALUES("4","PEMBINA TINGKAT I","IV/B");
INSERT INTO pangkatgol VALUES("5","PEMBINA","IV/A");
INSERT INTO pangkatgol VALUES("6","PENATA TINGKAT I","III/D");
INSERT INTO pangkatgol VALUES("7","PENATA","III/C");
INSERT INTO pangkatgol VALUES("8","PENATA MUDA TINGKAT I","III/B");
INSERT INTO pangkatgol VALUES("9","PENATA MUDA","III/A");
INSERT INTO pangkatgol VALUES("10","PENGATUR TINGKAT I","II/D");
INSERT INTO pangkatgol VALUES("11","PENGATUR","II/C");
INSERT INTO pangkatgol VALUES("12","PENGATUR MUDA TINGKAT I","II/B");
INSERT INTO pangkatgol VALUES("13","PENGATUR MUDA","II/A");
INSERT INTO pangkatgol VALUES("14","JURU TINGKAT I","I/D");
INSERT INTO pangkatgol VALUES("15","JURU","I/C");
INSERT INTO pangkatgol VALUES("16","JURU MUDA TINGKAT I","I/B");
INSERT INTO pangkatgol VALUES("17","JURU MUDA","I/A");



DROP TABLE tbl_disposisi;

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(10) NOT NULL AUTO_INCREMENT,
  `tujuan` varchar(250) NOT NULL,
  `pegawai` varchar(100) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `file_dispo` varchar(250) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_disposisi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_disposisi VALUES("1","Tim Satuan Pelaksana Sistem Pengendali Intern (SPI)","Drh. AZIZAH RIAS SADEWI","Ditindaklanjuti","Biasa","2019-12-12","sdfsfsfs","2484-images (15).jpg","1","1");
INSERT INTO tbl_disposisi VALUES("3","Manager Teknis Laboratorium KT ","DAVID SANJAYA SIPAYUNG, A.Md","Dipedomani","Rahasia","2019-12-10","dsfgfhgjhklkljklj","","1","1");



DROP TABLE tbl_instansi;

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `pimpinan` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nomortelp` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_instansi VALUES("1","Badan Karantina Pertanian","Stasiun Karantina Pertanian Kelas II Manokwari"," ","Jl. Trikora, Sowi IV Manokwari Papua Barat 98315","LUKAS SAIBA, SST.","-","https://skpmanokwari.go.id","skp_manokwari@ymail.com","(0986) 2211194","bkplogo-280x280.png","1");



DROP TABLE tbl_klasifikasi;

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(5) NOT NULL AUTO_INCREMENT,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_klasifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO tbl_klasifikasi VALUES("1","ST","Surat Tugas","Surat Tugas","1");
INSERT INTO tbl_klasifikasi VALUES("2","KP","Kepegawaian","Kepegawaian","1");
INSERT INTO tbl_klasifikasi VALUES("3","KU","Keuangan","Keuangan","1");
INSERT INTO tbl_klasifikasi VALUES("4","PK","Pemeriksaan","Pemeriksaan","1");
INSERT INTO tbl_klasifikasi VALUES("9","E","Administrasi","Administrasi Keuangan","1");



DROP TABLE tbl_pegawai;

CREATE TABLE `tbl_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(25) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `pangkat` varchar(25) DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

INSERT INTO tbl_pegawai VALUES("1","19650401 198903 1 001","LUKAS SAIBA, SST.","Penata Tingkat I","III/D","2019-04-01","KEPALA SKP KELAS II MANOKWARI");
INSERT INTO tbl_pegawai VALUES("2","19750601 200912 1 002","GUSNI TANDUNG, S.P.","Penata","III/C","2018-04-01","KEPALA URUSAN TATA USAHA");
INSERT INTO tbl_pegawai VALUES("3","19830624 200901 2 005","Drh. YUNI SULISTYOWATI","PENATA Tk. I","III/D","2019-04-01","MEDIK VETERINER MUDA");
INSERT INTO tbl_pegawai VALUES("4","19810707 201101 2 015","Drh. Y U L I A T I","PENATA","III/C","2017-10-01","MEDIK VETERINER MUDA");
INSERT INTO tbl_pegawai VALUES("5","19840127 201101 2 011","Drh. IMANUEL MAHESI MAKAMBAN","PENATA","III/C","2017-04-01","MEDIK VETERINER MUDA");
INSERT INTO tbl_pegawai VALUES("6","19800322 201101 2 005","Drh. AYU KENCANA PUTRI","PENATA","III/C","2016-01-10","MEDIK VETERINER MUDA");
INSERT INTO tbl_pegawai VALUES("7","19620711 199007 1 001","A S I R, SST.","PENATA","III/C","2016-10-01","ADMINISTRASI");
INSERT INTO tbl_pegawai VALUES("8","19760701 201101 2 005","NYNDHIA LAKSMI DEWI PARAMA PUSPITA, S.P.","PENATA MUDA Tk. I","III/B","2016-10-01","POPT AHLI PERTAMA");
INSERT INTO tbl_pegawai VALUES("9","19801002 201101 1 004","DORBEN SENOK TEKEN, S.E.","PENATA","III/C","2019-04-01","ADMINISTRASI");
INSERT INTO tbl_pegawai VALUES("10","19890804 201801 2 002","Drh. EVA AGUSTINA SIAHAAN","PENATA MUDA Tk. I","III/B","2019-01-01","MEDIK VETERINER MUDA");
INSERT INTO tbl_pegawai VALUES("11","19940719 201902 1 001","Drh. AJI BONDHAN KOTTAMA","PENATA MUDA Tk. I","III/B","2019-02-01","CALON MEDIK VETERINER PERTAMA");
INSERT INTO tbl_pegawai VALUES("12","19930718 201902 2 001","Drh. AZIZAH RIAS SADEWI","PENATA MUDA Tk. I","III/B","2019-02-01","CALON MEDIK VETERINER PERTAMA");
INSERT INTO tbl_pegawai VALUES("13","19900305 201403 2 002","RIMBA BOROH, S.Si.","PENATA MUDA Tk. I","III/B","2019-04-01","POPT AHLI PERTAMA");
INSERT INTO tbl_pegawai VALUES("14","19870614  201403 2 002","PRASASTI WAHYU HARYATI, S.Si.","PENATA MUDA Tk. I","III/B","2019-04-01","POPT AHLI PERTAMA");
INSERT INTO tbl_pegawai VALUES("15","19851005 200912 1 006","HADY M. GOZALI, A.Md","PENATA MUDA","III/A","2016-10-01","PARAMEDIK VETERINER PELAKSANA LANJUTAN");
INSERT INTO tbl_pegawai VALUES("16","19900319 201101 1 001","RONAL MANGGAU\', A.Md","PENATA MUDA","III/A","2017-10-01","PARAMEDIK VETERINER PELAKSANA LANJUTAN");
INSERT INTO tbl_pegawai VALUES("17","19820314 200912 2 004","RETNO WULANSARI, A.Md","PENATA MUDA","III/A","2018-04-01","ADMINISTRASI");
INSERT INTO tbl_pegawai VALUES("18","19891001 201801 1 001","ALDRIN SAKTI SIRANDAN. S.Si","PENATA MUDA","III/A","2019-01-01","POPT AHLI PERTAMA");
INSERT INTO tbl_pegawai VALUES("19","19910529 201801 2 002","PATRICIA CLAUDYA TOREY, S.Si","PENATA MUDA","III/A","2019-01-01","POPT AHLI PERTAMA");
INSERT INTO tbl_pegawai VALUES("20","19880424 201801 2 001","AGUSTINA LOISA SAWEN, S.Si","PENATA MUDA","III/A","2019-01-01","POPT AHLI PERTAMA");
INSERT INTO tbl_pegawai VALUES("21","19880801 201902 2 001","SUKMA EKAWATY SALAM, SH","PENATA MUDA","III/A","2019-01-01","CALON ANALIS HUKUM");
INSERT INTO tbl_pegawai VALUES("22","19880915 201903 1 008","SAZALI AMRI, SE","PENATA MUDA","III/A","2019-01-01","CALON ANALIS KEUANGAN");
INSERT INTO tbl_pegawai VALUES("23","19780907 200212 1 003","LABAN KENDE","PENATA MUDA","III/A","2019-04-01","ADMINISTRASI");
INSERT INTO tbl_pegawai VALUES("24","19661112 200212 1 002","STEPANUS SESA","PENATA MUDA","III/A","2019-04-01","ADMINISTRASI");
INSERT INTO tbl_pegawai VALUES("25","19760512 200212 1 002","RONALD SIRAIT","PENATA MUDA","III/A","2019-04-01","ADMINISTRASI");
INSERT INTO tbl_pegawai VALUES("26","19791202 201101 1 009","DULLANG GALA, A.Md","PENGATUR Tk. I","II/D","2016-10-01","POPT TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("27","19830103 201101  1 008","JEDI EBEN HAEZAR TIMPALEN, A.Md","PENATA MUDA","III/A","2018-10-01","PARAMEDIK VETERINER PELAKSANA");
INSERT INTO tbl_pegawai VALUES("28","19820906 200604 1 015","SEPTINUS INDOW","PENGATUR","II/C","2014-04-01","POPT TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("29","19930103 201902 1 002","YONATHAN RICARDO, A.Md","PENGATUR","II/C","2019-02-01","CALON POPT TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("30","19901029 201902 1 002","AFRIKO, A.Md","PENGATUR","II/C","2019-02-01","CALON POPT TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("31","19920107 201902 1 003","ELDO JANUARDI, A.Md","PENGATUR","II/C","2019-02-01","CALON POPT TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("32","19890411 201902 1 003","HERNANDO SULISTIYO, A.Md","PENGATUR","II/C","2019-02-01","CALON POPT TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("33","1993714 201902 1 001","DAVID SANJAYA SIPAYUNG, A.Md","PENGATUR","II/C","2019-02-01","CALON POPT TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("34","19960716 201902 1 001","AHMAD NAJIHAL AMAL, A.Md","PENGATUR","II/C","2019-02-01","CALON PARAMEDIK VETERINER TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("35","19960925 201902 2 002","IKA RINA SETIYANI, A. Md","PENGATUR","II/C","2019-02-01","CALON PARAMEDIK VETERINER TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("36","19960807 201902 1 001","IRVAN ALEY AL AHMAD, A.Md","PENGATUR","II/C","2019-02-01","CALON PARAMEDIK VETERINER TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("37","19880714 201902 1 001","YUSUF BURAKO, A.Md","PENGATUR","II/C","2019-02-01","CALON PARAMEDIK VETERINER TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("38","19850311 201101 1 013","ELYAN SIDAURUK","PENGATUR MUDA Tk. I","II/B","2016-10-01","POPT TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("39","19800208 201101 2 010","SARI TAYEB","PENGATUR MUDA Tk. I","II/B","2016-10-01","POPT TERAMPIL PELAKSANA");
INSERT INTO tbl_pegawai VALUES("44","","","","","0000-00-00","");



DROP TABLE tbl_sett;

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `surat_tugas` tinyint(2) NOT NULL,
  `surat_perintah_tugas` tinyint(2) NOT NULL,
  `tbl_pegawai` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_sett`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_sett VALUES("1","10","10","10","10","5","10","1");



DROP TABLE tbl_surat_keluar;

CREATE TABLE `tbl_surat_keluar` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_keluar VALUES("16","1","Balai ABCDD","dsfgdgs","dgsdfgsgsfgsgss","trtrtrt","2019-12-10","2019-12-08","","sdfgsfgsfgsgs","1");
INSERT INTO tbl_surat_keluar VALUES("18","3","a:1:{i:0;s:2:\"23\";}","024/TU.040/K.54.E/12/2019","Untuk melaksanakan tugas perjalanan dinas, dalam rangka Menghadiri Undangan Workshop Penyusunan Laporan Keuangan (SIMAK-BMN) Semester II TA. 2018 Lingkup Badan Karantina Pertanian pada tanggal 08 s/d 17 Januari 2019 di The Sahira Hotel Jl. A. Yani No. 17 – 23, Tanah Sareal, Kota Bogor, Jawa Barat.","ST","2019-12-10","2019-12-10","","Surat Tugas","1");
INSERT INTO tbl_surat_keluar VALUES("19","4","a:2:{i:0;s:1:\"2\";i:1;s:1:\"4\";}","hjkhkhjhjhkjk","hjkhjkhkj","ST","2019-12-10","2019-12-10","","Surat Tugas","1");
INSERT INTO tbl_surat_keluar VALUES("21","6","a:2:{i:0;s:2:\"32\";i:1;s:2:\"35\";}","drtyrtyryrty","rtyryrty","ST","2019-12-11","2019-12-11","","Surat Perintah Tugas","1");



DROP TABLE tbl_surat_masuk;

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `lampiran` text NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_masuk VALUES("1","1","1234567890","Pemprov Papua Barat","sadfafawfrewawe","","","2019-12-09","2019-12-08","7800-images (15).jpg","eerwerwrwewrer","1","1");



DROP TABLE tbl_surat_perintah_tugas;

CREATE TABLE `tbl_surat_perintah_tugas` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `dasar` text NOT NULL,
  `penerima_tugas` varchar(100) NOT NULL,
  `peruntukan` text NOT NULL,
  `tgl_ttd` date NOT NULL,
  `tempat_ttd` varchar(45) NOT NULL,
  `nama_ttd` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_perintah_tugas VALUES("2","6","drtyrtyryrty","rtyrtyry","a:2:{i:0;s:2:\"32\";i:1;s:2:\"35\";}","rtyryrty","2019-12-11","Manokwari","1","","1");



DROP TABLE tbl_surat_tugas;

CREATE TABLE `tbl_surat_tugas` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `pertimbangan` text NOT NULL,
  `dasar` text NOT NULL,
  `penerima_tugas` varchar(100) NOT NULL,
  `peruntukan` text NOT NULL,
  `tgl_ttd` date NOT NULL,
  `tempat_ttd` varchar(45) NOT NULL,
  `nama_ttd` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_tugas VALUES("2","3","024/TU.040/K.54.E/12/2019","Sehubungan dengan Undangan Badan Karantina Pertanian
dalam rangka Workshop Penyusunan Laporan Keuangan
Semester II TA. 2018 Lingkup Badan Karantina Pertanian.","Surat Badan Karantina Pertanian Nomor : 20392 / KU.110/K.1 / 12 / 2018 tanggal 27 Desember 2018 
DIPA Stasiun Karantina Pertanian Kelas II Manokwari Nomor : SP DIPA 018.12.2.499496/2019, tanggal 05 Desember 2018","a:1:{i:0;s:1:\"2\";}","Untuk melaksanakan tugas perjalanan dinas, dalam rangka Menghadiri Undangan Workshop Penyusunan Laporan Keuangan (SIMAK-BMN) Semester II TA. 2018 Lingkup Badan Karantina Pertanian pada tanggal 08 s/d 17 Januari 2019 di The Sahira Hotel Jl. A. Yani No. 17 – 23, Tanah Sareal, Kota Bogor, Jawa Barat.","2019-12-10","Manokwari","0","","1");
INSERT INTO tbl_surat_tugas VALUES("3","4","hjkhkhjhjhkjk","hjkhjkhkhk","hkhkhjkhkjhkhkkhhk","a:2:{i:0;s:1:\"2\";i:1;s:1:\"4\";}","hjkhjkhkj","2019-12-10","jhjkhjkhjk","1","","1");



DROP TABLE tbl_user;

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO tbl_user VALUES("1","admin","21232f297a57a5a743894a0e4a801fc3","Administrator","-","1");
INSERT INTO tbl_user VALUES("2","pengguna2","8b097b8a86f9d6a991357d40d3d58634","Pengguna Biasa Juga Manusia Biasa","123456789","2");
INSERT INTO tbl_user VALUES("3","pengguna3","8b097b8a86f9d6a991357d40d3d58634","Pengguna Biasa Juga Manusia Biasa","123456789","3");
INSERT INTO tbl_user VALUES("4","pengguna4","8b097b8a86f9d6a991357d40d3d58634","Pengguna Biasa Juga Manusia Biasa","123456789","3");
INSERT INTO tbl_user VALUES("5","pengguna5","8b097b8a86f9d6a991357d40d3d58634","Pengguna Biasa Juga Manusia Biasa","123456789","3");
INSERT INTO tbl_user VALUES("6","pengguna6","8b097b8a86f9d6a991357d40d3d58634","Pengguna Biasa Juga Manusia Biasa","123456789","3");



DROP TABLE tindakan_disposisi;

CREATE TABLE `tindakan_disposisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tindakan` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO tindakan_disposisi VALUES("1","Diketahui");
INSERT INTO tindakan_disposisi VALUES("2","Dipedomani");
INSERT INTO tindakan_disposisi VALUES("3","Ditindaklanjuti");
INSERT INTO tindakan_disposisi VALUES("4","Konsultasikan");
INSERT INTO tindakan_disposisi VALUES("5","Arsip");
INSERT INTO tindakan_disposisi VALUES("6","Lain-lain");



DROP TABLE tujuan_disposisi;

CREATE TABLE `tujuan_disposisi` (
  `id` int(11) NOT NULL,
  `kepada` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tujuan_disposisi VALUES("1","Kepala Urusan Tata Usaha");
INSERT INTO tujuan_disposisi VALUES("2","Tim Satuan Pelaksana Sistem Pengendali Intern (SPI)");
INSERT INTO tujuan_disposisi VALUES("3","Koord. Jabatan Fungsional KH");
INSERT INTO tujuan_disposisi VALUES("4","Koord. Jabatan Fungsional KT");
INSERT INTO tujuan_disposisi VALUES("5","Manager Administrasi / Mutu Laboratorium");
INSERT INTO tujuan_disposisi VALUES("6","Manager Teknis Laboratorium KH ");
INSERT INTO tujuan_disposisi VALUES("7","Manager Teknis Laboratorium KT ");
INSERT INTO tujuan_disposisi VALUES("8","Bendahara Pengeluaran");
INSERT INTO tujuan_disposisi VALUES("9","Bendahara Penerima PNBP");
INSERT INTO tujuan_disposisi VALUES("10","Tim Pelaksana SMM");
INSERT INTO tujuan_disposisi VALUES("11","Unit Layanan Pengadaan (ULP)");
INSERT INTO tujuan_disposisi VALUES("12","Para Penanggungjawab Wilayah Kerja");
INSERT INTO tujuan_disposisi VALUES("13","PPNS / Intelejen / Polisi Khusus Karantina");
INSERT INTO tujuan_disposisi VALUES("14","Petugas Operator SIMAK-BMN");
INSERT INTO tujuan_disposisi VALUES("15","Petugas Operator SAK");
INSERT INTO tujuan_disposisi VALUES("16","Petugas SIKAWAN");
INSERT INTO tujuan_disposisi VALUES("17","Petugas E-PLAQ");
INSERT INTO tujuan_disposisi VALUES("18","Pengelola Informasi Teknologi");



