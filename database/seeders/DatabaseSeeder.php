<?php

namespace Database\Seeders;

use App\Models\Pemohon;
use App\Models\StatusHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin & Staff Users
        $admin = User::create([
            'name' => 'Admin Imigrasi',
            'email' => 'admin@imigrasi.go.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $staff1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@imigrasi.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        $staff2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@imigrasi.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        $staffUsers = [$admin, $staff1, $staff2];

        // Data Pemohon (20+ records)
        $pemohonData = [
            ['nomor_berkas' => 'BAP-2024-0001', 'nama_lengkap' => 'Ahmad Rizky Pratama', 'nik' => '3201011234560001', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1990-05-15', 'alamat' => 'Jl. Sudirman No. 10, Jakarta Pusat', 'no_hp' => '081234567001', 'email' => 'ahmad.rizky@email.com', 'tanggal_pengajuan' => '2024-01-05', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0002', 'nama_lengkap' => 'Dewi Sartika Putri', 'nik' => '3201011234560002', 'tempat_lahir' => 'Bandung', 'tanggal_lahir' => '1988-08-20', 'alamat' => 'Jl. Asia Afrika No. 25, Bandung', 'no_hp' => '081234567002', 'email' => 'dewi.sartika@email.com', 'tanggal_pengajuan' => '2024-01-06', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0003', 'nama_lengkap' => 'Muhammad Fajar Hidayat', 'nik' => '3201011234560003', 'tempat_lahir' => 'Surabaya', 'tanggal_lahir' => '1995-03-10', 'alamat' => 'Jl. Tunjungan No. 45, Surabaya', 'no_hp' => '081234567003', 'email' => 'fajar.hidayat@email.com', 'tanggal_pengajuan' => '2024-01-07', 'jenis_permohonan' => 'Perpanjangan Paspor'],
            ['nomor_berkas' => 'BAP-2024-0004', 'nama_lengkap' => 'Rina Wati Susanti', 'nik' => '3201011234560004', 'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '1992-11-25', 'alamat' => 'Jl. Pemuda No. 30, Semarang', 'no_hp' => '081234567004', 'email' => 'rina.susanti@email.com', 'tanggal_pengajuan' => '2024-01-08', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0005', 'nama_lengkap' => 'Agus Prabowo', 'nik' => '3201011234560005', 'tempat_lahir' => 'Yogyakarta', 'tanggal_lahir' => '1985-07-12', 'alamat' => 'Jl. Malioboro No. 15, Yogyakarta', 'no_hp' => '081234567005', 'email' => 'agus.prabowo@email.com', 'tanggal_pengajuan' => '2024-01-10', 'jenis_permohonan' => 'Perpanjangan Paspor'],
            ['nomor_berkas' => 'BAP-2024-0006', 'nama_lengkap' => 'Nur Halimah', 'nik' => '3201011234560006', 'tempat_lahir' => 'Medan', 'tanggal_lahir' => '1993-02-14', 'alamat' => 'Jl. Gatot Subroto No. 50, Medan', 'no_hp' => '081234567006', 'email' => 'nur.halimah@email.com', 'tanggal_pengajuan' => '2024-01-12', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0007', 'nama_lengkap' => 'Hendra Wijaya', 'nik' => '3201011234560007', 'tempat_lahir' => 'Makassar', 'tanggal_lahir' => '1991-09-30', 'alamat' => 'Jl. Pettarani No. 20, Makassar', 'no_hp' => '081234567007', 'email' => 'hendra.wijaya@email.com', 'tanggal_pengajuan' => '2024-01-13', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0008', 'nama_lengkap' => 'Sri Mulyani', 'nik' => '3201011234560008', 'tempat_lahir' => 'Denpasar', 'tanggal_lahir' => '1987-04-18', 'alamat' => 'Jl. Bypass Ngurah Rai No. 8, Denpasar', 'no_hp' => '081234567008', 'email' => 'sri.mulyani@email.com', 'tanggal_pengajuan' => '2024-01-15', 'jenis_permohonan' => 'Perpanjangan Paspor'],
            ['nomor_berkas' => 'BAP-2024-0009', 'nama_lengkap' => 'Dani Kurniawan', 'nik' => '3201011234560009', 'tempat_lahir' => 'Palembang', 'tanggal_lahir' => '1994-12-05', 'alamat' => 'Jl. Jendral Sudirman No. 100, Palembang', 'no_hp' => '081234567009', 'email' => 'dani.kurniawan@email.com', 'tanggal_pengajuan' => '2024-01-16', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0010', 'nama_lengkap' => 'Fitri Handayani', 'nik' => '3201011234560010', 'tempat_lahir' => 'Manado', 'tanggal_lahir' => '1996-06-22', 'alamat' => 'Jl. Sam Ratulangi No. 35, Manado', 'no_hp' => '081234567010', 'email' => 'fitri.handayani@email.com', 'tanggal_pengajuan' => '2024-01-17', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0011', 'nama_lengkap' => 'Reza Firmansyah', 'nik' => '3201011234560011', 'tempat_lahir' => 'Pontianak', 'tanggal_lahir' => '1989-01-28', 'alamat' => 'Jl. Gajah Mada No. 60, Pontianak', 'no_hp' => '081234567011', 'email' => 'reza.firmansyah@email.com', 'tanggal_pengajuan' => '2024-01-18', 'jenis_permohonan' => 'Perpanjangan Paspor'],
            ['nomor_berkas' => 'BAP-2024-0012', 'nama_lengkap' => 'Lina Marlina', 'nik' => '3201011234560012', 'tempat_lahir' => 'Banjarmasin', 'tanggal_lahir' => '1990-10-08', 'alamat' => 'Jl. A. Yani No. 40, Banjarmasin', 'no_hp' => '081234567012', 'email' => 'lina.marlina@email.com', 'tanggal_pengajuan' => '2024-01-20', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0013', 'nama_lengkap' => 'Wahyu Nugroho', 'nik' => '3201011234560013', 'tempat_lahir' => 'Malang', 'tanggal_lahir' => '1993-07-19', 'alamat' => 'Jl. Ijen No. 12, Malang', 'no_hp' => '081234567013', 'email' => 'wahyu.nugroho@email.com', 'tanggal_pengajuan' => '2024-01-22', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0014', 'nama_lengkap' => 'Anisa Rahma', 'nik' => '3201011234560014', 'tempat_lahir' => 'Bogor', 'tanggal_lahir' => '1997-03-03', 'alamat' => 'Jl. Pajajaran No. 55, Bogor', 'no_hp' => '081234567014', 'email' => 'anisa.rahma@email.com', 'tanggal_pengajuan' => '2024-01-23', 'jenis_permohonan' => 'Perpanjangan Paspor'],
            ['nomor_berkas' => 'BAP-2024-0015', 'nama_lengkap' => 'Irfan Hakim', 'nik' => '3201011234560015', 'tempat_lahir' => 'Tangerang', 'tanggal_lahir' => '1986-08-11', 'alamat' => 'Jl. MH Thamrin No. 70, Tangerang', 'no_hp' => '081234567015', 'email' => 'irfan.hakim@email.com', 'tanggal_pengajuan' => '2024-01-24', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0016', 'nama_lengkap' => 'Maya Anggraini', 'nik' => '3201011234560016', 'tempat_lahir' => 'Bekasi', 'tanggal_lahir' => '1994-05-27', 'alamat' => 'Jl. Ahmad Yani No. 88, Bekasi', 'no_hp' => '081234567016', 'email' => 'maya.anggraini@email.com', 'tanggal_pengajuan' => '2024-01-25', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0017', 'nama_lengkap' => 'Eko Prasetyo', 'nik' => '3201011234560017', 'tempat_lahir' => 'Depok', 'tanggal_lahir' => '1988-12-16', 'alamat' => 'Jl. Margonda Raya No. 33, Depok', 'no_hp' => '081234567017', 'email' => 'eko.prasetyo@email.com', 'tanggal_pengajuan' => '2024-01-26', 'jenis_permohonan' => 'Perpanjangan Paspor'],
            ['nomor_berkas' => 'BAP-2024-0018', 'nama_lengkap' => 'Ratna Dewi', 'nik' => '3201011234560018', 'tempat_lahir' => 'Cirebon', 'tanggal_lahir' => '1991-09-04', 'alamat' => 'Jl. Siliwangi No. 22, Cirebon', 'no_hp' => '081234567018', 'email' => 'ratna.dewi@email.com', 'tanggal_pengajuan' => '2024-01-27', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0019', 'nama_lengkap' => 'Bagus Setiawan', 'nik' => '3201011234560019', 'tempat_lahir' => 'Solo', 'tanggal_lahir' => '1995-11-20', 'alamat' => 'Jl. Slamet Riyadi No. 45, Solo', 'no_hp' => '081234567019', 'email' => 'bagus.setiawan@email.com', 'tanggal_pengajuan' => '2024-01-28', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0020', 'nama_lengkap' => 'Yuni Astuti', 'nik' => '3201011234560020', 'tempat_lahir' => 'Surakarta', 'tanggal_lahir' => '1992-04-09', 'alamat' => 'Jl. Urip Sumoharjo No. 18, Surakarta', 'no_hp' => '081234567020', 'email' => 'yuni.astuti@email.com', 'tanggal_pengajuan' => '2024-01-29', 'jenis_permohonan' => 'Perpanjangan Paspor'],
            ['nomor_berkas' => 'BAP-2024-0021', 'nama_lengkap' => 'Taufik Hidayat', 'nik' => '3201011234560021', 'tempat_lahir' => 'Padang', 'tanggal_lahir' => '1987-06-01', 'alamat' => 'Jl. Khatib Sulaiman No. 14, Padang', 'no_hp' => '081234567021', 'email' => 'taufik.hidayat@email.com', 'tanggal_pengajuan' => '2024-01-30', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0022', 'nama_lengkap' => 'Kartini Wulandari', 'nik' => '3201011234560022', 'tempat_lahir' => 'Lampung', 'tanggal_lahir' => '1993-08-17', 'alamat' => 'Jl. Raden Intan No. 77, Bandar Lampung', 'no_hp' => '081234567022', 'email' => 'kartini.wulandari@email.com', 'tanggal_pengajuan' => '2024-02-01', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0023', 'nama_lengkap' => 'Joko Widodo Putra', 'nik' => '3201011234560023', 'tempat_lahir' => 'Pekanbaru', 'tanggal_lahir' => '1990-02-22', 'alamat' => 'Jl. Jendral Sudirman No. 200, Pekanbaru', 'no_hp' => '081234567023', 'email' => 'joko.wp@email.com', 'tanggal_pengajuan' => '2024-02-02', 'jenis_permohonan' => 'Perpanjangan Paspor'],
            ['nomor_berkas' => 'BAP-2024-0024', 'nama_lengkap' => 'Putri Ayu Lestari', 'nik' => '3201011234560024', 'tempat_lahir' => 'Samarinda', 'tanggal_lahir' => '1996-10-31', 'alamat' => 'Jl. P. Antasari No. 9, Samarinda', 'no_hp' => '081234567024', 'email' => 'putri.lestari@email.com', 'tanggal_pengajuan' => '2024-02-03', 'jenis_permohonan' => 'Paspor Baru'],
            ['nomor_berkas' => 'BAP-2024-0025', 'nama_lengkap' => 'Bambang Hermawan', 'nik' => '3201011234560025', 'tempat_lahir' => 'Balikpapan', 'tanggal_lahir' => '1984-01-14', 'alamat' => 'Jl. Jendral Sudirman No. 5, Balikpapan', 'no_hp' => '081234567025', 'email' => 'bambang.hermawan@email.com', 'tanggal_pengajuan' => '2024-02-05', 'jenis_permohonan' => 'Paspor Baru'],
        ];

        // Create pemohon records
        foreach ($pemohonData as $data) {
            Pemohon::create($data);
        }

        // Create varied status histories for realism
        $statusScenarios = [
            // Pemohon 1: Selesai BAP (completed all steps)
            1 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara telah dilaksanakan', 'days_ago' => 30],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Disetujui', 'keterangan' => 'Berkas memenuhi syarat', 'days_ago' => 25],
                ['status' => 'Hasil BAP', 'status_detail' => 'Disetujui', 'keterangan' => 'Disetujui oleh Kepala Kantor', 'days_ago' => 20],
                ['status' => 'Hasil BAP', 'status_detail' => 'Disetujui', 'keterangan' => 'Lanjut ke tahap foto paspor', 'days_ago' => 15],
            ],
            // Pemohon 2: Diajukan ke Kepala Kantor
            2 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara selesai', 'days_ago' => 20],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Disetujui', 'keterangan' => 'Diproses oleh Kasubsi', 'days_ago' => 15],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => null, 'keterangan' => 'Menunggu keputusan Kepala Kantor', 'days_ago' => 10],
            ],
            // Pemohon 3: Proses di Kasubsi - Ditolak
            3 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara dilaksanakan', 'days_ago' => 15],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Ditolak', 'keterangan' => 'Dokumen tidak lengkap, harap melengkapi', 'days_ago' => 10],
            ],
            // Pemohon 4: Proses di Kasubsi - Penangguhan
            4 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara telah dilakukan', 'days_ago' => 12],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Penangguhan', 'keterangan' => 'Ditangguhkan menunggu verifikasi tambahan', 'days_ago' => 7],
            ],
            // Pemohon 5: Selesai BAP
            5 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara selesai dilaksanakan', 'days_ago' => 28],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Disetujui', 'keterangan' => 'Berkas lengkap dan valid', 'days_ago' => 22],
                ['status' => 'Hasil BAP', 'status_detail' => 'Disetujui', 'keterangan' => 'Permohonan disetujui', 'days_ago' => 18],
                ['status' => 'Hasil BAP', 'status_detail' => 'Disetujui', 'keterangan' => 'Lanjut ke tahap foto paspor', 'days_ago' => 14],
            ],
            // Pemohon 6: Pemeriksaan BAP saja
            6 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara jadwal hari ini', 'days_ago' => 5],
            ],
            // Pemohon 7: Hasil BAP - Tidak Disetujui
            7 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Selesai wawancara', 'days_ago' => 18],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Disetujui', 'keterangan' => 'Lanjut ke tahap berikutnya', 'days_ago' => 14],
                ['status' => 'Hasil BAP', 'status_detail' => 'Ditolak', 'keterangan' => 'Perlu verifikasi ulang dokumen', 'days_ago' => 10],
            ],
            // Pemohon 8: Proses di Pejabat
            8 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara dilakukan', 'days_ago' => 10],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => null, 'keterangan' => 'Sedang diproses oleh Pejabat', 'days_ago' => 6],
            ],
            // Pemohon 9: Pemeriksaan BAP
            9 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Jadwal wawancara telah dilaksanakan', 'days_ago' => 3],
            ],
            // Pemohon 10: Hasil BAP
            10 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara selesai', 'days_ago' => 25],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Disetujui', 'keterangan' => 'Disetujui Pejabat', 'days_ago' => 20],
                ['status' => 'Hasil BAP', 'status_detail' => 'Disetujui', 'keterangan' => 'Disetujui Kepala Kantor', 'days_ago' => 16],
                ['status' => 'Hasil BAP', 'status_detail' => 'Disetujui', 'keterangan' => 'Lanjut ke tahap foto paspor', 'days_ago' => 12],
            ],
            // Pemohon 11-15: Various states
            11 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara dilakukan', 'days_ago' => 8],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Disetujui', 'keterangan' => 'Berkas valid', 'days_ago' => 4],
            ],
            12 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Selesai wawancara', 'days_ago' => 6],
            ],
            13 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara BAP selesai', 'days_ago' => 22],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Disetujui', 'keterangan' => 'Telah disetujui', 'days_ago' => 17],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => null, 'keterangan' => 'Menunggu keputusan', 'days_ago' => 13],
            ],
            14 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara telah dilakukan', 'days_ago' => 4],
            ],
            15 => [
                ['status' => 'Pemeriksaan BAP', 'status_detail' => null, 'keterangan' => 'Wawancara selesai', 'days_ago' => 16],
                ['status' => 'Pemeriksaan oleh Pejabat', 'status_detail' => 'Disetujui', 'keterangan' => 'Dokumen lengkap', 'days_ago' => 12],
                ['status' => 'Hasil BAP', 'status_detail' => 'Disetujui', 'keterangan' => 'Permohonan disetujui', 'days_ago' => 8],
                ['status' => 'Hasil BAP', 'status_detail' => 'Disetujui', 'keterangan' => 'Lanjut ke tahap foto paspor', 'days_ago' => 5],
            ],
        ];

        // pemohon 16-25 have no status yet (Belum Diproses)

        foreach ($statusScenarios as $pemohonId => $statuses) {
            foreach ($statuses as $statusData) {
                StatusHistory::create([
                    'pemohon_id' => $pemohonId,
                    'status' => $statusData['status'],
                    'status_detail' => $statusData['status_detail'],
                    'keterangan' => $statusData['keterangan'],
                    'updated_by' => $staffUsers[array_rand($staffUsers)]->id,
                    'created_at' => now()->subDays($statusData['days_ago']),
                    'updated_at' => now()->subDays($statusData['days_ago']),
                ]);
            }
        }
    }
}
