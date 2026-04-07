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
            'nomor_berkas' => 'required|string',
        ]);

        $pemohon = Pemohon::where('nomor_berkas', $request->nomor_berkas)
            ->with(['statusHistories.updatedByUser'])
            ->first();

        if (!$pemohon) {
            return back()
                ->withInput()
                ->withErrors(['nomor_berkas' => 'Data tidak ditemukan. Pastikan nomor berkas yang Anda masukkan sudah benar.']);
        }

        $statusFlow = Pemohon::STATUS_FLOW;

        return view('public.tracking-result', compact('pemohon', 'statusFlow'));
    }
}
