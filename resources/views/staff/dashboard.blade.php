@extends('layouts.staff')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Pemohon --}}
    <div class="card p-6 border-l-4 border-l-govt-blue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Pemohon</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $totalPemohon }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center text-govt-blue">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </div>
        <div class="mt-4 text-sm text-emerald-600 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            <span>+{{ $todayCount }} hari ini</span>
        </div>
    </div>

    {{-- Belum Diproses --}}
    <div class="card p-6 border-l-4 border-l-gray-400">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Belum Diproses</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $belumDiproses }}</h3>
            </div>
            <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    {{-- Pemeriksaan Pejabat --}}
    <div class="card p-6 border-l-4 border-l-amber-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Di Pejabat</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $statusCounts['Pemeriksaan oleh Pejabat'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 bg-amber-50 rounded-full flex items-center justify-center text-amber-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
        </div>
    </div>

    {{-- Selesai --}}
    <div class="card p-6 border-l-4 border-l-emerald-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Hasil BAP</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $statusCounts['Hasil BAP'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    {{-- Status Breakdown --}}
    <div class="xl:col-span-1">
        <div class="card flex flex-col h-full">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Distribusi Status</h3>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-center">
                <div class="space-y-4">
                    @foreach(\App\Models\Pemohon::STATUS_FLOW as $status)
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ $status }}</span>
                                <span class="text-sm font-bold text-gray-900">{{ $statusCounts[$status] ?? 0 }}</span>
                            </div>
                            @php
                                $total = array_sum($statusCounts) > 0 ? array_sum($statusCounts) : 1;
                                $percentage = (($statusCounts[$status] ?? 0) / $total) * 100;
                                $colorClass = match($status) {
                                    'Hasil BAP' => 'bg-emerald-500',
                                    'Pemeriksaan oleh Pejabat' => 'bg-amber-500',
                                    'Pemeriksaan BAP' => 'bg-blue-500',
                                    default => 'bg-gray-400'
                                };
                            @endphp
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="{{ $colorClass }} h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="xl:col-span-2">
        <div class="card h-full">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Aktivitas Terkini</h3>
                <a href="{{ route('pemohon.index') }}" class="text-sm text-govt-blue hover:underline">Lihat Semua</a>
            </div>
            <div class="p-0">
                @if($recentActivities->isEmpty())
                    <div class="p-8 text-center text-gray-500">
                        Belum ada aktivitas.
                    </div>
                @else
                    <ul class="divide-y divide-gray-100">
                        @foreach($recentActivities as $activity)
                            <li class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex space-x-4">
                                    <div class="flex-shrink-0 pt-1">
                                        <div class="w-10 h-10 rounded-full bg-govt-light flex items-center justify-center text-govt-blue font-bold shadow-sm">
                                            {{ strtoupper(substr($activity->updatedByUser->name ?? 'S', 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-900 font-medium">
                                            <span class="font-bold">{{ $activity->pemohon->nama_lengkap }}</span> ({{ $activity->pemohon->nomor_berkas }})
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            Status diperbarui menjadi 
                                            <x-status-badge :status="$activity->status" class="ml-1" />
                                        </p>
                                        @if($activity->status_detail)
                                            <p class="text-xs text-gray-500 mt-1">Detail: <span class="font-medium text-gray-700">{{ $activity->status_detail }}</span></p>
                                        @endif
                                        <div class="flex items-center mt-2 text-xs text-gray-400">
                                            <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $activity->created_at->diffForHumans() }} oleh {{ $activity->updatedByUser->name ?? 'System' }}
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 self-center">
                                        <a href="{{ route('pemohon.show', $activity->pemohon) }}" class="p-2 text-gray-400 hover:text-govt-blue hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="p-4 border-t border-gray-100">
                        {{ $recentActivities->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
