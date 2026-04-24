<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    use HasFactory;

    protected $table = 'pemohon';

    protected $fillable = [
        'nomor_berkas',
        'nama_lengkap',
        'nik',
        'nik_hash',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email',
        'tanggal_pengajuan',
        'jenis_permohonan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_pengajuan' => 'date',
        'nik' => 'encrypted',
        'nama_lengkap' => 'encrypted',
        'tempat_lahir' => 'encrypted',
        'alamat' => 'encrypted',
        'no_hp' => 'encrypted',
        'email' => 'encrypted',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pemohon) {
            if ($pemohon->nik) {
                $pemohon->nik_hash = hash('sha256', $pemohon->nik);
            }
        });

        static::updating(function ($pemohon) {
            if ($pemohon->isDirty('nik')) {
                $pemohon->nik_hash = hash('sha256', $pemohon->nik);
            }
        });
    }

    // Daftar status yang valid (urutan pipeline)
    public const STATUS_FLOW = [
        'Pemeriksaan BAP',
        'Pemeriksaan oleh Pejabat',
        'Hasil BAP',
    ];

    public const STATUS_DETAILS = [
        'Hasil BAP' => ['Disetujui', 'Ditolak', 'Penangguhan'],
    ];

    // Mapping ke status tampilan pemohon
    public const APPLICANT_STATUS_MAPPING = [
        'Pemeriksaan BAP' => 'Dalam Proses Pemeriksaan',
        'Pemeriksaan oleh Pejabat' => 'Proses Pendalaman Pemeriksaan',
        'Hasil BAP' => 'Hasil BAP(Selesai)',
    ];

    public function statusHistories()
    {
        return $this->hasMany(StatusHistory::class)->orderBy('created_at', 'asc');
    }

    public function latestStatus()
    {
        return $this->hasOne(StatusHistory::class)->latestOfMany();
    }

    /**
     * Mendapatkan status terakhir (current status)
     */
    public function getCurrentStatusAttribute()
    {
        return $this->latestStatus?->status ?? 'Belum Diproses';
    }

    /**
     * Mendapatkan status untuk tampilan pemohon
     */
    public function getApplicantStatusAttribute()
    {
        $current = $this->current_status;
        return self::APPLICANT_STATUS_MAPPING[$current] ?? $current;
    }

    /**
     * Mendapatkan index status saat ini dalam pipeline
     */
    public function getCurrentStatusIndexAttribute(): int
    {
        $current = $this->current_status;
        $index = array_search($current, self::STATUS_FLOW);
        return $index !== false ? $index : -1;
    }

    /**
     * Mendapatkan status berikutnya dalam pipeline
     */
    public function getNextStatusAttribute(): ?string
    {
        $currentIndex = $this->current_status_index;
        if ($currentIndex === -1) {
            return self::STATUS_FLOW[0];
        }

        $latest = $this->latestStatus;
        if ($latest) {
            // Stay in the same status if rejected or suspended so it can be re-evaluated or stopped
            if ($latest->status === 'Hasil BAP' && ($latest->status_detail === 'Ditolak' || $latest->status_detail === 'Penangguhan')) {
                return null; 
            }
        }

        $nextIndex = $currentIndex + 1;
        return $nextIndex < count(self::STATUS_FLOW) ? self::STATUS_FLOW[$nextIndex] : null;
    }

    /**
     * Accessors for Masked Data
     */
    public function getMaskedNikAttribute()
    {
        try {
            $nik = $this->nik;
            if (!$nik) return '-';
            return substr($nik, 0, 4) . '************';
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return 'Data Error (Format)';
        }
    }

    public function getMaskedNamaLengkapAttribute()
    {
        try {
            $nama = $this->nama_lengkap;
            if (!$nama) return '-';
            $len = strlen($nama);
            return substr($nama, 0, 2) . str_repeat('*', max(0, $len - 2));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return 'Data Error (Format)';
        }
    }

    public function getMaskedTempatLahirAttribute()
    {
        try {
            $tempat = $this->tempat_lahir;
            if (!$tempat) return '-';
            return substr($tempat, 0, 2) . '******';
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return 'Data Error (Format)';
        }
    }

    public function getMaskedTanggalLahirAttribute()
    {
        return '**.**.****';
    }

    public function getMaskedAlamatAttribute()
    {
        try {
            $alamat = $this->alamat;
            if (!$alamat) return '-';
            return substr($alamat, 0, 5) . '****************';
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return 'Data Error (Format)';
        }
    }

    public function getMaskedNoHpAttribute()
    {
        try {
            $no = $this->no_hp;
            if (!$no) return '-';
            return substr($no, 0, 4) . '********';
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return 'Data Error (Format)';
        }
    }

    public function getMaskedEmailAttribute()
    {
        try {
            $email = $this->email;
            if (!$email) return '-';
            $parts = explode('@', $email);
            if (count($parts) < 2) return '*******';
            return substr($parts[0], 0, 2) . '***@' . $parts[1];
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return 'Data Error (Format)';
        }
    }
}
