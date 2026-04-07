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
    ];

    // Daftar status yang valid (urutan pipeline)
    public const STATUS_FLOW = [
        'Wawancara BAP',
        'Proses Penindakan di Kasubsi',
        'Diajukan ke Kepala Kantor',
        'Selesai BAP',
    ];

    public const STATUS_DETAILS = [
        'Proses Penindakan di Kasubsi' => ['Disetujui', 'Ditolak', 'Penangguhan'],
        'Diajukan ke Kepala Kantor' => ['Disetujui', 'Tidak Disetujui'],
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
            // Stay in the same status if rejected so it can be re-evaluated
            if ($latest->status === 'Proses Penindakan di Kasubsi' && $latest->status_detail === 'Ditolak') {
                return self::STATUS_FLOW[$currentIndex]; 
            }
            if ($latest->status === 'Diajukan ke Kepala Kantor' && $latest->status_detail === 'Tidak Disetujui') {
                return self::STATUS_FLOW[$currentIndex]; 
            }
            // If Penangguhan, stop the flow entirely
            if ($latest->status === 'Proses Penindakan di Kasubsi' && $latest->status_detail === 'Penangguhan') {
                return null;
            }
        }

        $nextIndex = $currentIndex + 1;
        return $nextIndex < count(self::STATUS_FLOW) ? self::STATUS_FLOW[$nextIndex] : null;
    }
}
