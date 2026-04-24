<?php

namespace App\Http\Controllers;

use App\Models\Pemohon;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function landing()
    {
        return view('public.landing');
    }

    public function track(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
        ]);

        $nik_hash = hash('sha256', $request->nik);

        $pemohon = Pemohon::where('nik_hash', $nik_hash)
            ->with(['statusHistories.updatedByUser'])
            ->latest()
            ->first();

        if (!$pemohon) {
            return back()
                ->withInput()
                ->withErrors(['nik' => 'Data tidak ditemukan. Pastikan NIK yang Anda masukkan sudah benar.']);
        }

        $statusFlow = Pemohon::STATUS_FLOW;

        return view('public.tracking-result', compact('pemohon', 'statusFlow'));
    }
}
