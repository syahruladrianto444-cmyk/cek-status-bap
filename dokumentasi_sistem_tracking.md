# DOKUMENTASI SISTEM PELACAKAN STATUS BAP (BERITA ACARA PEMERIKSAAN)

## 1. PENJELASAN SISTEM
Sistem Pelacakan Status Berkas BAP (Berita Acara Pemeriksaan) merupakan sebuah platform berbasis web yang dirancang khusus untuk memenuhi kebutuhan pelayanan publik di lingkungan Kantor Imigrasi. Sistem ini bertujuan untuk meningkatkan transparansi dan memberikan kemudahan bagi masyarakat (Pemohon) dalam melacak sejauh mana proses permohonan mereka berjalan secara *real-time*. Di sisi lain, aplikasi ini berfungsi sebagai Sistem Informasi Manajemen bagi para petugas (staf dan admin) instansi untuk mengatur, mencatat, dan memonitor jalannya berkas BAP secara tertib melalui rekam jejak digital (Audit Trail).

## 2. SPESIFIKASI WEBSITE
Sistem ini dikembangkan menggunakan teknologi standar industri modern:
*   **Bahasa Pemrograman**: PHP (versi 8.x)
*   **Framework Utama**: Laravel 10 (Arsitektur MVC - *Model, View, Controller*)
*   **Desain Antarmuka (Frontend)**: Menggunakan Blade Templating Engine yang dipadukan dengan framework CSS modern Tailwind untuk UI yang responsif dan elegan.
*   **Database**: Relational Database Management System (mendukung MySQL/MariaDB) untuk menjaga integritas data dan riwayat relasional status.
*   **Sistem Keamanan**: Proteksi bawaan Laravel meliputi CSRF Token perlindungan form, autentikasi middleware, hashing sandi (Bcrypt), dan perlindungan injeksi SQL.

## 3. FLOW SISTEM (ALUR KERJA)

### A. Alur Pemohon (Masyarakat/Publik)
1.  **Akses Web Publik**: Pemohon mengunjungi halaman beranda situs web (Landing Page).
2.  **Input Nomor Berkas**: Pemohon memasukkan Nomor Berkas (contoh: `BAP-2024-0001`) yang telah didapatkan.
3.  **Proses Validasi**: Sistem memverifikasi kecocokan nomor registrasi berkas di dalam database secara instan.
4.  **Hasil Lacak (*Tracking Result*)**: Bila data terverifikasi, layar akan menampilkan informasi profil pemohon (disensor otomatis sebagian hurufnya guna melindungi privasi). Terdapat pula rancangan balok *Timeline* vertikal yang mendeskripsikan riwayat pemeriksaan berkas secara kronologis hingga ke langkah akhir.

### B. Alur Staf / Admin Imigrasi (Internal)
1.  **Sistem Autentikasi**: Petugas mengakses URL belakang layar (`/login`) dengan akun E-mail dan Kata Sandi terdaftar.
2.  **Dashboard Pemantauan**: Setelah masuk, jendela Dasbor langsung menyuguhkan laporan analitik visual seperti Total Pemohon, Berkas Antre, Rekapitulasi Berkas yang Selesai, dan Daftar Riwayat Aktivitas Log yang terbaru.
3.  **Manajemen Pemohon**: Navigasi ke panel "Daftar Pemohon". Di halaman ini petugas dapat mendaftarkan pemohon baru ke dalam database atau membuka rincian penuh suatu pemohon.
4.  **Proses Update Status**: Tugas pokok. Petugas memilih pemohon dan melakukan pembaruan tahap progres. 
    *   *Siklus Standar*: Belum Diproses $\rightarrow$ Wawancara BAP $\rightarrow$ Proses Penindakan di Kasubsi $\rightarrow$ Diajukan ke Kepala Kantor $\rightarrow$ Selesai BAP.
    *   Petugas juga dapat menyematkan Sub-status seperti "Disetujui", "Ditolak", atau "Siklus Ditangguhkan" sesuai rekomendasi lapangan beserta catatan detail.
5.  **Logging Otomatis**: Setiap entri diperbarui, sistem akan menanamkan jejak digital berisi Waktu Tepat dan Petugas Siapa yang merubah data, menjaga mutu Audit Trail.

---

## 4. PENJELASAN RINCI SETIAP TAMPILAN UI (USER INTERFACE)

Berikut merupakan detail dari tiap-tiap jendela tatap muka dalam peramban web:

### 1. Halaman Landing / Beranda (Publik)
Merupakan gerbang utama platform bagi publik dengan *hero-banner* atraktif yang responsif. Terdapat form pencarian intuitif berbentuk bilah input bertuliskan "Cari Nomor Berkas". Di lapis menu bawah, sistem menyajikan *company profile* mengenai transparansi serta visual ringkas langkah standar penyelesaian BAP.
> *[Catatan untuk Editor: Sisipkan Screenshot halaman index (localhost:8000/) di posisi ini]*
<div align="center">
  <img src="https://placehold.co/800x400/eeeeee/666666.jpg?text=++(Screenshot+Halaman+Landing)++" alt="Halaman Landing" />
</div>

<br>

### 2. Halaman Hasil Pelacakan / Tracking (Publik)
Halaman interaktif yang muncul setelah publik menginput pencarian BAP. Tersusun atas dua palet, yakni Identitas Aman (Nama disensor dan Jenis Permohonan) serta Bagan *Timeline Vertical* (Riwayat Waktu). Kartu baris paling atas menunjukkan tahapan saat ini atau *"Current Status"*. 
> *[Catatan untuk Editor: Sisipkan Screenshot hasil pencarian tracking (localhost:8000/tracking) di posisi ini]*
<div align="center">
  <img src="https://placehold.co/800x400/eeeeee/666666.jpg?text=++(Screenshot+Halaman+Tracking)++" alt="Halaman Tracking" />
</div>

<br>

### 3. Halaman Login (Staf/Admin)
Muka otentikasi berupa *form* minimalis di tengah layar untuk para pegawai imigrasi. Mengemas isian kolom E-Mail dan Kata sandi yang ditopang keamanan dasar Laravel.
> *[Catatan untuk Editor: Sisipkan Screenshot form login staff (localhost:8000/login) di posisi ini]*
<div align="center">
  <img src="https://placehold.co/800x400/eeeeee/666666.jpg?text=++(Screenshot+Halaman+Login)++" alt="Halaman Login" />
</div>

<br>

### 4. Halaman Dashboard (Staf/Admin)
Ruang kerja digital petugas (CMS). Terbagi menjadi grid *Summary Cards* (Total, Belum Proses, dsb) dengan aksen ikon berwarna di tiap label. Terdapat tabel "Aktivitas Terbaru" di sektor bawah layar, menayangkan langsung siapa yang baru saja memproses dokumen pada hari yang berjalan.
> *[Catatan untuk Editor: Sisipkan Screenshot dashboard staff (localhost:8000/dashboard) di posisi ini]*
<div align="center">
  <img src="https://placehold.co/800x400/eeeeee/666666.jpg?text=++(Screenshot+Halaman+Dashboard)++" alt="Halaman Dashboard" />
</div>

<br>

### 5. Halaman Daftar Pemohon
Bentuk antarmuka data *table grid* yang menyajikan *List* populasi seluruh pemohon yang ada dalam sistem. Terdapat kolom NIK, Nama Lengkap, Nomor Berkas, Status Saat ini (disertai label warna warni misal hijau untuk 'Disetujui'), dan tombol "Aksi" multifungsi (Detail, Edit Pemohon).
> *[Catatan untuk Editor: Sisipkan Screenshot halaman tabel daftar pemohon (localhost:8000/pemohon) di posisi ini]*
<div align="center">
  <img src="https://placehold.co/800x400/eeeeee/666666.jpg?text=++(Screenshot+Halaman+Daftar+Pemohon)++" alt="Halaman Daftar Pemohon" />
</div>

<br>

### 6. Halaman Detail Pemohon
Berisi halaman profil lengkap seorang pemohon. Sisi panel satu menjabarkan identitas biografi administratif (Alamat, NIK Terbuka, Tanggal Permohonan). Sisi panel satunya berupa tabel memanjang ihwal daftar riwayat perpindahan dokumen BAP lengkap per tiap detiknya beserta siapa nama pegawai yang mengubahnya.
> *[Catatan untuk Editor: Sisipkan Screenshot halaman rincian profil / detail pemohon di posisi ini]*
<div align="center">
  <img src="https://placehold.co/800x400/eeeeee/666666.jpg?text=++(Screenshot+Halaman+Detail+Pemohon)++" alt="Halaman Detail Pemohon" />
</div>

<br>

### 7. Halaman Form Update Status
Sebuah halaman form antarmuka bagi staf untuk merotasi tahapan dokumen. Staf mengisi komponen *Dropdown* level yang dikehendaki, Sub-status keterangan, dan *Text Area* bila perlu memberikan "Catatan Penting" (seperti alasan kenapa file ditolak/ditangguhkan). Menjadi penggerak laju alur sistem operasi ini.
> *[Catatan untuk Editor: Sisipkan Screenshot formulir update status (halaman update-status) di posisi ini]*
<div align="center">
  <img src="https://placehold.co/800x400/eeeeee/666666.jpg?text=++(Screenshot+Halaman+Form+Update+Status)++" alt="Halaman Update Status" />
</div>
