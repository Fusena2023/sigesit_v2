/*
 Navicat Premium Data Transfer

 Source Server         : 192.168.2.47
 Source Server Type    : PostgreSQL
 Source Server Version : 90519
 Source Host           : 192.168.2.47:5432
 Source Catalog        : ptig_big
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 90519
 File Encoding         : 65001

 Date: 16/09/2019 12:40:55
*/


-- ----------------------------
-- Sequence structure for master_berita_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."master_berita_id_seq";
CREATE SEQUENCE "public"."master_berita_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Table structure for master_berita
-- ----------------------------
DROP TABLE IF EXISTS "public"."master_berita";
CREATE TABLE "public"."master_berita" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "judul" varchar(255) COLLATE "pg_catalog"."default",
  "deskripsi" text COLLATE "pg_catalog"."default",
  "gambar" varchar(255) COLLATE "pg_catalog"."default",
  "show" bool,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Table structure for master_faq
-- ----------------------------
DROP TABLE IF EXISTS "public"."master_faq";
CREATE TABLE "public"."master_faq" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "pertanyaan" varchar(255) COLLATE "pg_catalog"."default",
  "jawaban" text COLLATE "pg_catalog"."default",
  "status" bool
)
;

-- ----------------------------
-- Records of master_faq
-- ----------------------------
INSERT INTO "public"."master_faq" VALUES (18, 'Apa itu aplikasi Pelayanan Terpadu Informasi Geospasial (PTIG)?', '<p>Aplikasi terpadu satu pintu untuk mendapatkan pelayanan publik yang terintegrasi yang disediakan oleh Badan Informasi Geospasial.</p>', 't');
INSERT INTO "public"."master_faq" VALUES (19, 'Dasar Hukum apa yang menaungi PTIG?', '<ul><br>	<li>UU No 4 Tahun 2011 tentang Informasi Geospasial;</li><br>	<li>Peraturan Pemerintah No 64 Tahun 2014 tentang Jenis dan Tarif Atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Badan Informasi Geospasial;</li><br>	<li>Peraturan Pemerintah No 96 Tahun 2012 tentang Pelaksanaan UU No 25 Tahun 2009 Tentang Pelayanan Publik;</li><br>	<li>Peraturan Kepala Badan Informasi Geospasial No 5 Tahun 2013 tentang Balai Layanan Jasa dan Produk Geospasial.</li><br></ul>', 't');
INSERT INTO "public"."master_faq" VALUES (20, 'Layanan Publik apa saja yang diberikan Badan Informasi Geospasial?', '<ul><br>	<li>Layanan Produk</li><br>	<li>Layanan Jasa</li><br></ul>', 'f');
INSERT INTO "public"."master_faq" VALUES (21, 'Siapa saja user aplikasi PTIG?', '<p>Semua user yang biasa berhubungan dengan BIG via telpon, email, surat, dan fax, akan dapat berhubungan langsung dengan BIG dengan membuat permohonan layanan melalui aplikasi ini.</p>', 'f');
INSERT INTO "public"."master_faq" VALUES (81, 'Tanya 1', '<p>Tanya 1</p>', 'f');

-- ----------------------------
-- Table structure for master_jenis_layanan
-- ----------------------------
DROP TABLE IF EXISTS "public"."master_jenis_layanan";
CREATE TABLE "public"."master_jenis_layanan" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "jenis_layanan" varchar(255) COLLATE "pg_catalog"."default",
  "deskripsi" text COLLATE "pg_catalog"."default",
  "icon" varchar(255) COLLATE "pg_catalog"."default",
  "show" bool,
  "batasan" int4,
  "url" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of master_jenis_layanan
-- ----------------------------
INSERT INTO "public"."master_jenis_layanan" VALUES (1, 'Layanan Produk', 'Produk Geospasial & Data Digital', 'images/kj8rhgt2Elnj51RvPYE2V55LMtWwwRCrhpiAPwZD.png', 't', 0, '#services-section2');
INSERT INTO "public"."master_jenis_layanan" VALUES (3, 'Layanan Diklat', 'Diklat di Bidang Informasi Geospasial', 'images/VuaIdTB5CpH12U0SY30SIvkzdtuL5AAuaZAcgHUi.png', 't', 11, '#services-section3');
INSERT INTO "public"."master_jenis_layanan" VALUES (4, 'Layanan Kunjungan Umum', 'Antrian Harian Mendapatkan Layanan Secara Umum', 'images/iAhveKfn8Q1pan8dVwqydi3KP1Tln3D4NV5VF71M.png', 't', 11, '#');
INSERT INTO "public"."master_jenis_layanan" VALUES (2, 'Layanan Jasa', 'Berupa Layanan Survey & Pemetaan', 'images/5gLGS88ALH2zGTeceCWmTYQ11mDr5hoWfdgjIVXQ.png', 't', 11, '#services-section');
INSERT INTO "public"."master_jenis_layanan" VALUES (78, 'Test Layanan', 'Test Layanan', 'images/1tWxSoaz81zdTYlS1A471Ium9szRgmF3mUvQaD7y.jpeg', 'f', 20, NULL);

-- ----------------------------
-- Table structure for master_layanan_digital
-- ----------------------------
DROP TABLE IF EXISTS "public"."master_layanan_digital";
CREATE TABLE "public"."master_layanan_digital" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "nama_layanan" varchar(255) COLLATE "pg_catalog"."default",
  "deskripsi" text COLLATE "pg_catalog"."default",
  "icon" varchar(255) COLLATE "pg_catalog"."default",
  "show" bool,
  "url" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of master_layanan_digital
-- ----------------------------
INSERT INTO "public"."master_layanan_digital" VALUES (5, 'Tanah Air', 'Indonesia', 'images/MLUwNpuegKkPrCc4f6lPNB4asWNmABGlmwnuSR5a.png', 't', 'http://tanahair.indonesia.go.id/');
INSERT INTO "public"."master_layanan_digital" VALUES (79, 'BIG - Coba', 'Coba', 'images/jR5KWsBmunn3VySTKJnhJ97bnfCPHSjHB059jFAK.png', 'f', 'https://www.big.go.id/');

-- ----------------------------
-- Table structure for master_layanan_diklat
-- ----------------------------
DROP TABLE IF EXISTS "public"."master_layanan_diklat";
CREATE TABLE "public"."master_layanan_diklat" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "nama_layanan_diklat" varchar(255) COLLATE "pg_catalog"."default",
  "deskripsi" text COLLATE "pg_catalog"."default",
  "gambar" varchar(255) COLLATE "pg_catalog"."default",
  "icon" varchar(255) COLLATE "pg_catalog"."default",
  "status" varchar(255) COLLATE "pg_catalog"."default",
  "id_pusat" int4
)
;

-- ----------------------------
-- Records of master_layanan_diklat
-- ----------------------------
INSERT INTO "public"."master_layanan_diklat" VALUES (27, 'Sistem Informasi Geografis (SIG) Tingkat Dasar', '<p>Tarif : &nbsp;Rp.7.000.000,00<br /><br>Durasi : 10 (sepuluh) hari kerja (82 JP)</p><br><br><p>TUJUAN<br /><br>Membekali &nbsp;peserta dengan pengetahuan dan keterampilan dalam pemanfaatan teknologi SIG.</p>', NULL, NULL, NULL, 12);
INSERT INTO "public"."master_layanan_diklat" VALUES (28, 'Sistem Informasi Geografis (SIG) Tingkat Lanjut', '<p>Tarif : &nbsp;Rp.7.000.000,00<br /><br>Durasi : 10 (sepuluh) hari kerja (82 JP)</p><br><br><p>TUJUAN<br /><br>Membekali peserta dengan pengetahuan dan keterampilan melakukan analisis dan pembuatan model untuk berbagai aplikasi.</p>', NULL, NULL, NULL, 13);
INSERT INTO "public"."master_layanan_diklat" VALUES (30, 'SIG Desktop Open Source', '<p>Tarif : &nbsp;Rp. 4.000.000,00<br /><br>Durasi : 5 (lima) hari kerja (40 JP)</p><br><br><p>TUJUAN<br /><br>Membekali peserta dengan pengetahuan dan keterampilan dalam pemanfaatan teknologi SIG.</p>', NULL, NULL, NULL, 16);
INSERT INTO "public"."master_layanan_diklat" VALUES (31, 'SIG Berbasis Web', '<p>Tarif : &nbsp;Rp. 4.000.000,00<br /><br>Durasi : 5 (lima) hari kerja (40 JP)</p><br><br><p>TUJUAN<br /><br>Memberikan pemahaman dan keterampilan kepada peserta dalam hal membangun dan mengelola teknologi Web GIS Open Source.</p>', NULL, NULL, NULL, 9);
INSERT INTO "public"."master_layanan_diklat" VALUES (32, 'Survei dan Pemetaan Tingkat Dasar', '<p>Tarif : &nbsp;Rp. 4.000.000,00<br /><br>Durasi : 15 (lima belas) hari kerja (40 JP)</p><br><br><p>TUJUAN<br /><br>Memberi pemahaman dan keterampilan tentang dasar-dasar survei pemetaan terestris.&nbsp;</p>', NULL, NULL, NULL, 7);
INSERT INTO "public"."master_layanan_diklat" VALUES (26, 'Layanan Pendidikan dan Pelatihan Geospasial', '', 'images/UDzGkR5yntUORSLAWnooKe9aiNVuHaiCr58Zx0lJ.png', NULL, 'active', 17);
INSERT INTO "public"."master_layanan_diklat" VALUES (29, 'Sistem Informasi Geografis (SIG) Tingkat Manajer', '<p>Tarif :  Rp. 3.000.000,00<br /><br>Durasi : 4 (empat) hari kerja (32 JP)</p><br><br><p>TUJUAN<br /><br>Memberikan pembekalan kepada para pembuat kebijakan dan pengambil keputusan dalam hal penggunaan teknologi geospasial secara efektif.</p>', NULL, NULL, NULL, 13);
INSERT INTO "public"."master_layanan_diklat" VALUES (83, 'Layanan Diklat', '<p>Layanan Diklat</p>', 'images/bAKWIyVF13xt9sYs7SLjwUvWxo2RaVuzyCYcBvLK.jpeg', NULL, NULL, 6);

-- ----------------------------
-- Table structure for master_layanan_jasa
-- ----------------------------
DROP TABLE IF EXISTS "public"."master_layanan_jasa";
CREATE TABLE "public"."master_layanan_jasa" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "nama_layanan_jasa" varchar(255) COLLATE "pg_catalog"."default",
  "deskripsi" text COLLATE "pg_catalog"."default",
  "gambar" varchar(255) COLLATE "pg_catalog"."default",
  "icon" varchar(255) COLLATE "pg_catalog"."default",
  "status" varchar(255) COLLATE "pg_catalog"."default",
  "id_pusat" int4
)
;

-- ----------------------------
-- Records of master_layanan_jasa
-- ----------------------------
INSERT INTO "public"."master_layanan_jasa" VALUES (22, 'Delineasi Batas Wilayah Peta Desa', 'Peta penetapan batas Desa adalah peta yang menyajikan batas Desa hasil penetapan berbasis peta dasar atau citra tegak resolusi tinggi. Dalam proses penetapan batas desa dapat digunakan metode Kartometrik.', 'images/YDNz9ZOHLvRrcUEVz93E7L7UnH4YfYiHOkuwt0uW.jpeg', 'flaticon-ideas', 'active', 6);
INSERT INTO "public"."master_layanan_jasa" VALUES (23, 'Pembuatan Simpul Jaringan', 'Simpul Jaringan adalah institusi yang bertanggungjawab dalam penyelenggaraan pengumpulan, pemeliharaan, pemutakhiran, penggunaan dan penyebarluasan Data Geospasial (DG) dan Informasi Geospasial (IG) tertentu.', 'images/vKdwDgwPZ9CltOSNpHoGTwnxSzA0vROZwspwRw2S.jpeg', 'flaticon-analysis', NULL, 14);
INSERT INTO "public"."master_layanan_jasa" VALUES (24, 'Konsultasi Tata Ruang', 'Penyusunan Peta Rencana Tata Ruang wajib dikonsultasikan kepada BIG, untuk dilakukan asistensi dan supervisi peta rencana tata ruang, memverifikasi terhadap data geospasial dan informasi geospasial', 'images/pNYhpArZu842I556k4Ynh4iOyC1WdE6N1yMCSzXV.jpeg', 'flaticon-web-design', NULL, 9);
INSERT INTO "public"."master_layanan_jasa" VALUES (25, 'Pembuatan Unsur Peta Dasar', NULL, 'images/85Pd7AtOeQyqqkr0NtAeUmEmHu1ndWuPSJ2eAuC8.jpeg', 'flaticon-innovation', NULL, 12);
INSERT INTO "public"."master_layanan_jasa" VALUES (82, 'Layanan Baru', 'Layanan Baru', 'images/VQfcIMAYqOfHwxBLMQk2e7Thgot8zuozhUwcXKDJ.jpeg', NULL, NULL, 6);

-- ----------------------------
-- Table structure for master_pusat
-- ----------------------------
DROP TABLE IF EXISTS "public"."master_pusat";
CREATE TABLE "public"."master_pusat" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "nama_pusat" varchar(255) COLLATE "pg_catalog"."default",
  "status" bool
)
;

-- ----------------------------
-- Records of master_pusat
-- ----------------------------
INSERT INTO "public"."master_pusat" VALUES (6, 'Pusat Pemetaan Rupabumi dan Toponim (PPRT)', 't');
INSERT INTO "public"."master_pusat" VALUES (7, 'Pusat Jaring Kontrol Geodesi dan Geodinamika (PJKGG)', 't');
INSERT INTO "public"."master_pusat" VALUES (8, 'Pusat Pemetaan Batas Wilayah (PPBW)', 't');
INSERT INTO "public"."master_pusat" VALUES (9, 'Pusat Pemetaan Kelautan dan Lingkungan Pantai (PKLP)', 't');
INSERT INTO "public"."master_pusat" VALUES (10, 'Pusat Pemetaan Kelautan dan Lingkungan Pantai (PKLP)', 't');
INSERT INTO "public"."master_pusat" VALUES (11, 'Pusat Pemetaan dan Integrasi Tematik (PPIT)', 't');
INSERT INTO "public"."master_pusat" VALUES (12, 'Pusat Pengelolaan dan Penyebarluasan IG (PPIG)', 't');
INSERT INTO "public"."master_pusat" VALUES (13, 'Pusat Standardisasi dan Kelembagaan IG (PSKIG)', 't');
INSERT INTO "public"."master_pusat" VALUES (14, 'Pusat Penelitian, Promosi dan Kerja Sama (PPKS)', 't');
INSERT INTO "public"."master_pusat" VALUES (15, 'Biro Perencanaan, Kepegawaian dan Hukum (PKH)', 't');
INSERT INTO "public"."master_pusat" VALUES (16, 'Biro Umum dan Keuangan (UK)', 't');
INSERT INTO "public"."master_pusat" VALUES (17, 'Inspektorat', 't');
INSERT INTO "public"."master_pusat" VALUES (80, 'Pusat Ujicoba', 'f');

-- ----------------------------
-- Table structure for master_tentang
-- ----------------------------
DROP TABLE IF EXISTS "public"."master_tentang";
CREATE TABLE "public"."master_tentang" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "deskripsi" text COLLATE "pg_catalog"."default",
  "lokasi_big" varchar(255) COLLATE "pg_catalog"."default",
  "lokasi_tatapmuka" varchar(255) COLLATE "pg_catalog"."default",
  "status" bool,
  "status_lokasi" bool,
  "email" varchar(255) COLLATE "pg_catalog"."default",
  "telpon" varchar(255) COLLATE "pg_catalog"."default",
  "website" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of master_tentang
-- ----------------------------
INSERT INTO "public"."master_tentang" VALUES (1, 'Pelayanan Terpadu Informasi Geospasial (PTIG) dibentuk untuk mempermudah pengguna informasi geospasial dari kementerian/lembaga, pemerintah daerah, institusi pendidikan dan swasta mendapatkan layanan produk dan jasa geospasial.', 'Pusat Penelitian, Promosi dan Kerja Sama Badan Informasi Geospasial Jl. Raya Jakarta-Bogor Km. 46 Cibinong Bogor 16911', 'Gedung Pelayanan Terpadu Informasi Geospasial', 't', 't', 'info@big.go.id', '021 875 3155', 'http://www.big.go.id/');

-- ----------------------------
-- Table structure for tiket_layanan_diklat
-- ----------------------------
DROP TABLE IF EXISTS "public"."tiket_layanan_diklat";
CREATE TABLE "public"."tiket_layanan_diklat" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "no_tiket" varchar(255) COLLATE "pg_catalog"."default",
  "tanggal" date,
  "mulai" varchar(255) COLLATE "pg_catalog"."default",
  "selesai" varchar(255) COLLATE "pg_catalog"."default",
  "status" int4,
  "id_master_layanandiklat" int4,
  "id_pengguna" int4,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of tiket_layanan_diklat
-- ----------------------------
INSERT INTO "public"."tiket_layanan_diklat" VALUES (42, 'C001', '2019-05-23', '09:00', '10:00', 2, 26, 33, '2019-05-23 03:33:08', '2019-08-26 03:56:05');
INSERT INTO "public"."tiket_layanan_diklat" VALUES (70, 'C001', '2019-08-26', '13:00', '14:00', 2, 31, 33, '2019-08-26 04:01:19', '2019-08-26 04:01:57');
INSERT INTO "public"."tiket_layanan_diklat" VALUES (85, 'C001', '2019-09-11', '14:30', '16:00', 2, 30, 54, '2019-09-11 07:29:13', '2019-09-11 07:39:01');

-- ----------------------------
-- Table structure for tiket_layanan_jasa
-- ----------------------------
DROP TABLE IF EXISTS "public"."tiket_layanan_jasa";
CREATE TABLE "public"."tiket_layanan_jasa" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "no_tiket" varchar(255) COLLATE "pg_catalog"."default",
  "tanggal" date,
  "mulai" varchar(255) COLLATE "pg_catalog"."default",
  "selesai" varchar(255) COLLATE "pg_catalog"."default",
  "status" int4,
  "id_master_layananjasa" int4,
  "id_pengguna" int4,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of tiket_layanan_jasa
-- ----------------------------
INSERT INTO "public"."tiket_layanan_jasa" VALUES (39, 'A001', '2019-05-23', '10:00', '10:30', 2, 25, 33, '2019-03-23 01:53:14', '2019-05-23 03:59:38');
INSERT INTO "public"."tiket_layanan_jasa" VALUES (37, 'A001', '2019-05-22', '08:00', '08:30', 2, 22, 33, '2019-05-22 03:11:02', '2019-08-26 03:57:51');
INSERT INTO "public"."tiket_layanan_jasa" VALUES (69, 'A001', '2019-08-26', '13:00', '14:00', 2, 24, 33, '2019-08-26 03:37:23', '2019-08-26 03:59:35');
INSERT INTO "public"."tiket_layanan_jasa" VALUES (38, 'A002', '2019-05-22', '09:30', '10:00', 2, 24, 33, '2019-05-22 09:49:33', '2019-08-26 04:09:07');
INSERT INTO "public"."tiket_layanan_jasa" VALUES (84, 'A001', '2019-09-11', '10:00', '12:00', 1, 22, 54, '2019-09-10 07:43:05', NULL);
INSERT INTO "public"."tiket_layanan_jasa" VALUES (77, 'A001', '2019-09-18', '08:00', '08:15', 2, 24, 33, '2019-09-04 08:34:56', '2019-09-10 07:45:52');

-- ----------------------------
-- Table structure for tiket_layanan_kunjungan_umum
-- ----------------------------
DROP TABLE IF EXISTS "public"."tiket_layanan_kunjungan_umum";
CREATE TABLE "public"."tiket_layanan_kunjungan_umum" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "no_tiket" varchar(255) COLLATE "pg_catalog"."default",
  "tanggal" date,
  "status" int4,
  "id_pengguna" int4,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of tiket_layanan_kunjungan_umum
-- ----------------------------
INSERT INTO "public"."tiket_layanan_kunjungan_umum" VALUES (44, 'D001', '2019-05-24', 2, 33, '2019-05-24 02:13:47', '2019-05-24 03:51:39');
INSERT INTO "public"."tiket_layanan_kunjungan_umum" VALUES (51, 'D002', '2019-07-30', 2, 33, '2019-07-30 05:44:57', '2019-07-30 05:51:22');
INSERT INTO "public"."tiket_layanan_kunjungan_umum" VALUES (64, 'D001', '2019-08-20', 2, 63, '2019-08-20 04:00:00', '2019-08-26 03:54:59');
INSERT INTO "public"."tiket_layanan_kunjungan_umum" VALUES (49, 'D001', '2019-07-30', 2, 47, '2019-07-30 05:35:31', '2019-08-26 03:55:10');
INSERT INTO "public"."tiket_layanan_kunjungan_umum" VALUES (71, 'D001', '2019-08-26', 2, 33, '2019-08-26 04:04:42', '2019-08-26 04:10:01');
INSERT INTO "public"."tiket_layanan_kunjungan_umum" VALUES (86, 'D001', '2019-09-11', 2, 54, '2019-09-11 07:42:47', '2019-09-11 07:45:59');

-- ----------------------------
-- Table structure for tiket_layanan_kunjungan_umum_detail
-- ----------------------------
DROP TABLE IF EXISTS "public"."tiket_layanan_kunjungan_umum_detail";
CREATE TABLE "public"."tiket_layanan_kunjungan_umum_detail" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "personil" varchar(255) COLLATE "pg_catalog"."default",
  "keperluan" varchar(255) COLLATE "pg_catalog"."default",
  "id_pusat" int4,
  "id_tiket_kunjunganumum" int4
)
;

-- ----------------------------
-- Records of tiket_layanan_kunjungan_umum_detail
-- ----------------------------
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (45, 'Alados', 'Meeting', 7, 44);
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (46, 'Simanjuntak', 'Konsultasi', 11, 44);
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (50, 'bu retno', 'konsul', 6, 49);
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (52, 'hjfjhfhjg', 'asd', 6, 51);
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (53, 'bcnfn', 'dsf', 8, 51);
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (65, 'Ibu Ati', 'Wawancara', 12, 64);
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (66, 'Pak Bambang', 'Pencarian Produk', 11, 64);
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (72, 'Bapak A', 'Keperluan A', 9, 71);
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (73, 'Bapak B', 'Keperluan B', 7, 71);
INSERT INTO "public"."tiket_layanan_kunjungan_umum_detail" VALUES (87, 'Pak Indra', 'Test', 12, 86);

-- ----------------------------
-- Table structure for tiket_layanan_produk
-- ----------------------------
DROP TABLE IF EXISTS "public"."tiket_layanan_produk";
CREATE TABLE "public"."tiket_layanan_produk" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "no_tiket" varchar(255) COLLATE "pg_catalog"."default",
  "tanggal" date,
  "status" int4,
  "id_pengguna" int4,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of tiket_layanan_produk
-- ----------------------------
INSERT INTO "public"."tiket_layanan_produk" VALUES (41, 'B001', '2019-05-29', 1, 33, '2019-05-23 03:06:03', '2019-05-23 03:06:03');
INSERT INTO "public"."tiket_layanan_produk" VALUES (48, 'B001', '2019-07-30', 1, 47, '2019-07-30 05:34:46', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (57, 'B001', '2019-08-19', 1, 54, '2019-08-19 10:07:34', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (58, 'B002', '2019-08-19', 1, 33, '2019-08-19 10:45:16', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (62, 'B003', '2019-08-20', 1, 33, '2019-08-20 03:43:23', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (60, 'B001', '2019-08-20', 2, 59, '2019-08-20 03:23:22', '2019-08-20 00:00:00');
INSERT INTO "public"."tiket_layanan_produk" VALUES (61, 'B002', '2019-08-20', 2, 54, '2019-08-20 03:41:04', '2019-08-20 00:00:00');
INSERT INTO "public"."tiket_layanan_produk" VALUES (67, 'B004', '2019-08-20', 2, 54, '2019-08-20 06:42:59', '2019-08-20 00:00:00');
INSERT INTO "public"."tiket_layanan_produk" VALUES (68, 'B001', '2019-08-22', 1, 54, '2019-08-22 04:00:47', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (74, 'B001', '2019-08-26', 1, 33, '2019-08-26 04:06:47', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (75, 'B002', '2019-08-26', 1, 54, '2019-08-26 04:11:15', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (90, 'B003', '2019-09-13', 1, 33, '2019-09-12 06:35:50', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (91, 'B003', '2019-09-13', 1, 33, '2019-09-12 06:37:57', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (93, 'B003', '2019-09-12', 1, 92, '2019-09-12 06:40:26', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (94, 'B004', '2019-09-12', 1, 92, '2019-09-12 06:41:06', NULL);
INSERT INTO "public"."tiket_layanan_produk" VALUES (89, 'B002', '2019-09-12', 2, 54, '2019-09-12 06:31:17', '2019-09-12 00:00:00');
INSERT INTO "public"."tiket_layanan_produk" VALUES (88, 'B001', '2019-09-12', 2, 54, '2019-09-11 09:53:09', '2019-09-12 00:00:00');

-- ----------------------------
-- Table structure for users_internal
-- ----------------------------
DROP TABLE IF EXISTS "public"."users_internal";
CREATE TABLE "public"."users_internal" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default",
  "email" varchar(255) COLLATE "pg_catalog"."default",
  "password" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of users_internal
-- ----------------------------
INSERT INTO "public"."users_internal" VALUES (1, 'Administrator', 'admin@gmail.com', '$2y$10$uakHYNLIqis73.HXCo9CvuZ9sykuUdxvo63PAAlrIi9E/RIWu9rm2');

-- ----------------------------
-- Table structure for users_pengguna
-- ----------------------------
DROP TABLE IF EXISTS "public"."users_pengguna";
CREATE TABLE "public"."users_pengguna" (
  "id" int4 NOT NULL DEFAULT nextval('master_berita_id_seq'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default",
  "email" varchar(255) COLLATE "pg_catalog"."default",
  "password" varchar(255) COLLATE "pg_catalog"."default",
  "alamat" varchar(255) COLLATE "pg_catalog"."default",
  "no_telp" varchar(255) COLLATE "pg_catalog"."default",
  "jenis_pengguna" int4,
  "aktifasi" bool,
  "created_at" timestamp(6),
  "updated_at" timestamp(6),
  "alamat_instansi" varchar(255) COLLATE "pg_catalog"."default",
  "jenis_instansi" varchar(255) COLLATE "pg_catalog"."default",
  "instansi" varchar(255) COLLATE "pg_catalog"."default",
  "direktorat" varchar(255) COLLATE "pg_catalog"."default",
  "npwp" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of users_pengguna
-- ----------------------------
INSERT INTO "public"."users_pengguna" VALUES (33, 'Ikhsan', 'ikhsankurniawan.ikhwan@gmail.com', '$2y$10$37h2AcgCT.lpmS7itpGp3e5dMY2eDLP3jPzxZRPri3oS4ykoW.e0.', 'Condet Raya deket mesjid', '085889404006', 1, 't', '2019-05-17 03:19:42', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."users_pengguna" VALUES (34, 'Alados Artado', 'aladosart1215@gmail.com', '$2y$10$0NnJZ6fFyFBLLMbCOWD99OgMJwUrCnQPq/yhKf5HEWT.6kcuIylD6', NULL, '085889404006', 2, 't', '2019-05-17 03:20:07', NULL, 'Jalan Pelita 45 kampung tengah', 'Kementerian', 'ESDM', 'Minerba', '123123');
INSERT INTO "public"."users_pengguna" VALUES (47, 'Theresia Retno Wulan', 'noibako@gmail.com', '$2y$10$oFl.S6AXCbVQgoL3YTZ3m.f3yqFtjqbEINa71l/FHSh9uTJgF0ahS', 'Nirwana Estate HH 19', '083811958941', 1, 't', '2019-05-29 07:19:23', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."users_pengguna" VALUES (54, 'Hilza', 'hilzanovita@gmail.com', '$2y$10$Hrk9lRZedSVndz.L6PeRpebXDHmUz4MkrO90JQpghkjF5iwFNyyHe', 'Jakarta', '081314068911', 1, 't', '2019-08-19 10:05:47', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."users_pengguna" VALUES (59, 'Novita', 'novita@gmail.com', '$2y$10$xZc5mICOgqyC.hQpyA14JOesT5VKgzk7GbCzrSSqlWxuIR4Z2aR66', 'Jakarta Selatan', '081133232323', 1, 't', '2019-08-20 03:16:05', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."users_pengguna" VALUES (63, 'JANUAR', 'abadijaya@gmail.com', '$2y$10$pFZMZEVQIXDXXhZju.g5TOdFLrfuyY5RPeomblxmTrWPP7OA1Hyl.', NULL, '0813111131312', 2, 't', '2019-08-20 03:56:25', NULL, 'JAKARTA BARAT', 'Lainnya', 'PT. ABADI JAYA', 'PURCHASING', '12.12.12.121.000');
INSERT INTO "public"."users_pengguna" VALUES (76, 'Fahri S', 'fahrisafari95@gmail.com', '$2y$10$s3KkeYdDxd2thNpON97GtexiH9fWuoQkE6kfGPgXgo7AqIGpOuUVy', NULL, '0813131311', 2, 't', '2019-08-26 04:28:09', NULL, 'Jakarta Timur', 'Lembaga', 'Lembaga A', 'Direktorat A', '123.1243.23.23.2..32.32');
INSERT INTO "public"."users_pengguna" VALUES (92, 'Kholil', 'kerjaankholil@gmail.com', '$2y$10$GIqPPzbNeTelF0jSsde9D.TcIbqCz/aS2WAj75V8hnpeaUMsxGS2K', 'Jakarta', '081313111311', 1, 't', '2019-09-12 06:39:34', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."master_berita_id_seq"
OWNED BY "public"."master_berita"."id";
SELECT setval('"public"."master_berita_id_seq"', 95, true);

-- ----------------------------
-- Primary Key structure for table master_berita
-- ----------------------------
ALTER TABLE "public"."master_berita" ADD CONSTRAINT "master_berita_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table master_faq
-- ----------------------------
ALTER TABLE "public"."master_faq" ADD CONSTRAINT "master_berita_copy1_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table master_jenis_layanan
-- ----------------------------
ALTER TABLE "public"."master_jenis_layanan" ADD CONSTRAINT "master_berita_copy2_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table master_layanan_digital
-- ----------------------------
ALTER TABLE "public"."master_layanan_digital" ADD CONSTRAINT "master_berita_copy3_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table master_layanan_diklat
-- ----------------------------
ALTER TABLE "public"."master_layanan_diklat" ADD CONSTRAINT "master_berita_copy4_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table master_layanan_jasa
-- ----------------------------
ALTER TABLE "public"."master_layanan_jasa" ADD CONSTRAINT "master_berita_copy5_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table master_pusat
-- ----------------------------
ALTER TABLE "public"."master_pusat" ADD CONSTRAINT "master_berita_copy6_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table master_tentang
-- ----------------------------
ALTER TABLE "public"."master_tentang" ADD CONSTRAINT "master_berita_copy7_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tiket_layanan_diklat
-- ----------------------------
ALTER TABLE "public"."tiket_layanan_diklat" ADD CONSTRAINT "master_tentang_copy2_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tiket_layanan_jasa
-- ----------------------------
ALTER TABLE "public"."tiket_layanan_jasa" ADD CONSTRAINT "master_tentang_copy3_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tiket_layanan_kunjungan_umum
-- ----------------------------
ALTER TABLE "public"."tiket_layanan_kunjungan_umum" ADD CONSTRAINT "master_tentang_copy4_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tiket_layanan_kunjungan_umum_detail
-- ----------------------------
ALTER TABLE "public"."tiket_layanan_kunjungan_umum_detail" ADD CONSTRAINT "master_tentang_copy5_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tiket_layanan_produk
-- ----------------------------
ALTER TABLE "public"."tiket_layanan_produk" ADD CONSTRAINT "master_tentang_copy6_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table users_internal
-- ----------------------------
ALTER TABLE "public"."users_internal" ADD CONSTRAINT "master_tentang_copy7_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table users_pengguna
-- ----------------------------
ALTER TABLE "public"."users_pengguna" ADD CONSTRAINT "master_tentang_copy1_pkey" PRIMARY KEY ("id");
