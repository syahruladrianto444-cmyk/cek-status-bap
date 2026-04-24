<?php

namespace App\Http\Controllers;

use App\Models\Pemohon;
use App\Models\StatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemohonController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemohon::with('latestStatus');

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                // Nama Lengkap terenkripsi, jadi tidak bisa LIKE
                $q->where('nomor_berkas', 'like', "%{$search}%")
                  ->orWhere('nik_hash', hash('sha256', $search));
            });
        }

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pengajuan', $request->tanggal);
        }

        // Filter status
        if ($request->filled('status')) {
            $statusFilter = $request->status;
            if ($statusFilter === 'Belum Diproses') {
                $query->whereDoesntHave('statusHistories');
            } else {
                $query->whereHas('latestStatus', function ($q) use ($statusFilter) {
                    $q->where('status', $statusFilter);
                });
            }
        }

        $pemohon = $query->orderBy('created_at', 'desc')->paginate(15);
        $pemohon->appends($request->query());

        return view('staff.pemohon.index', compact('pemohon'));
    }

    public function create()
    {
        return view('staff.pemohon.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_berkas' => 'required|unique:pemohon,nomor_berkas',
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email',
            'tanggal_pengajuan' => 'required|date',
            'jenis_permohonan' => 'required|string',
        ]);

        $validated['nik_hash'] = hash('sha256', $validated['nik']);

        Pemohon::create($validated);

        return redirect()->route('pemohon.index')
            ->with('success', 'Data pemohon berhasil ditambahkan.');
    }

    public function show(Pemohon $pemohon)
    {
        $pemohon->load(['statusHistories.updatedByUser']);
        $statusFlow = Pemohon::STATUS_FLOW;
        $statusDetails = Pemohon::STATUS_DETAILS;

        return view('staff.pemohon.show', compact('pemohon', 'statusFlow', 'statusDetails'));
    }

    public function edit(Pemohon $pemohon)
    {
        return view('staff.pemohon.edit', compact('pemohon'));
    }

    public function update(Request $request, Pemohon $pemohon)
    {
        $validated = $request->validate([
            'nomor_berkas' => 'required|unique:pemohon,nomor_berkas,' . $pemohon->id,
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email',
            'tanggal_pengajuan' => 'required|date',
            'jenis_permohonan' => 'required|string',
        ]);

        $validated['nik_hash'] = hash('sha256', $validated['nik']);

        $pemohon->update($validated);

        return redirect()->route('pemohon.show', $pemohon)
            ->with('success', 'Data pemohon berhasil diperbarui.');
    }

    public function destroy(Pemohon $pemohon)
    {
        $pemohon->delete();
        return redirect()->route('pemohon.index')
            ->with('success', 'Data pemohon berhasil dihapus.');
    }

    /**
     * Form update status
     */
    public function updateStatusForm(Pemohon $pemohon)
    {
        $pemohon->load('statusHistories');
        $currentStatus = $pemohon->current_status;
        $nextStatus = $pemohon->next_status;
        $statusDetails = Pemohon::STATUS_DETAILS;

        return view('staff.pemohon.update-status', compact(
            'pemohon', 'currentStatus', 'nextStatus', 'statusDetails'
        ));
    }

    /**
     * Proses update status (step-by-step)
     */
    public function updateStatus(Request $request, Pemohon $pemohon)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:' . implode(',', Pemohon::STATUS_FLOW),
            'status_detail' => 'nullable|string',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Validasi urutan status
        $nextStatus = $pemohon->next_status;
        if ($validated['status'] !== $nextStatus) {
            return back()->withErrors(['status' => 'Status harus diupdate secara berurutan. Status selanjutnya: ' . ($nextStatus ?? 'Sudah selesai')]);
        }

        // Validasi status_detail jika diperlukan
        $requiresDetail = isset(Pemohon::STATUS_DETAILS[$validated['status']]);
        if ($requiresDetail && empty($validated['status_detail'])) {
            return back()->withErrors(['status_detail' => 'Detail status harus diisi untuk status ini.']);
        }

        StatusHistory::create([
            'pemohon_id' => $pemohon->id,
            'status' => $validated['status'],
            'status_detail' => $validated['status_detail'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('pemohon.show', $pemohon)
            ->with('success', 'Status berhasil diperbarui ke: ' . $validated['status']);
    }

    /**
     * Redirect ke WhatsApp Pemohon
     */
    public function whatsapp(Pemohon $pemohon)
    {
        $no_hp = $pemohon->no_hp;
        // Bersihkan nomor HP
        $no_hp = preg_replace('/[^0-9]/', '', $no_hp);
        if (str_starts_with($no_hp, '0')) {
            $no_hp = '62' . substr($no_hp, 1);
        } elseif (!str_starts_with($no_hp, '62')) {
            $no_hp = '62' . $no_hp;
        }

        $latestStatus = $pemohon->latestStatus;
        $message = "";

        // Automated message only for 'Disetujui'
        if ($latestStatus && $latestStatus->status === 'Hasil BAP' && $latestStatus->status_detail === 'Disetujui') {
            $message = "Diberitahukan bahwa proses BAP Anda telah selesai dan dapat dilanjutkan pada tahap foto Paspor. Dipersilahkan datang ke Kantor Imigrasi Kelas I Non TPI Pemalang pada hari dan jam kerja.\n\nHari & Jam Pelayanan:\nSenin s/d Kamis : 08.00 - 15.00\nJumat : 08.00 - 15.30";
        }

        $url = "https://wa.me/{$no_hp}?text=" . urlencode($message);

        return redirect()->away($url);
    }
}
