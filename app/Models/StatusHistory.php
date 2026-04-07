<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    use HasFactory;

    protected $table = 'status_histories';

    protected $fillable = [
        'pemohon_id',
        'status',
        'status_detail',
        'keterangan',
        'updated_by',
    ];

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class);
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
