<?php

namespace App\Http\Controllers;

use App\Models\Pemohon;
use App\Models\StatusHistory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemohon = Pemohon::count();
        $belumDiproses = Pemohon::whereDoesntHave('statusHistories')->count();

        // Hitung berdasarkan status terakhir
        $statusCounts = [];
        foreach (Pemohon::STATUS_FLOW as $status) {
            $statusCounts[$status] = 0;
        }

        $pemohonWithStatus = Pemohon::with('latestStatus')->has('statusHistories')->get();
        foreach ($pemohonWithStatus as $p) {
            $currentStatus = $p->latestStatus?->status;
            if ($currentStatus && isset($statusCounts[$currentStatus])) {
                $statusCounts[$currentStatus]++;
            }
        }

        // Aktivitas terbaru
        $recentActivities = StatusHistory::with(['pemohon', 'updatedByUser'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Pemohon hari ini
        $todayCount = Pemohon::whereDate('tanggal_pengajuan', today())->count();

        return view('staff.dashboard', compact(
            'totalPemohon',
            'belumDiproses',
            'statusCounts',
            'recentActivities',
            'todayCount'
        ));
    }
}
