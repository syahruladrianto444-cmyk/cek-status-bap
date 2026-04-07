@extends('layouts.staff')

@section('page-title', 'Detail Pemohon')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('pemohon.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-govt-blue">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar
    </a>
    
    <div class="flex space-x-3">
        <a href="{{ route('pemohon.edit', $pemohon) }}" class="btn-secondary text-sm px-4 py-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit Data
        </a>
        
        @if($pemohon->next_status !== null)
            <a href="{{ route('pemohon.update-status', $pemohon) }}" class="btn-primary text-sm px-4 py-2 bg-emerald-600 hover:bg-emerald-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Update Status
            </a>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Info Kolom Kiri --}}
    <div class="lg:col-span-1 space-y-6">
        <div class="card p-6 border-t-4 border-t-govt-blue h-full">
            <h3 class="text-lg font-bold text-gray-900 mb-6 border-b pb-3">Informasi Berkas</h3>
            
            <div class="space-y-5">
                <div>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Nomor Berkas</p>
                    <p class="text-lg font-bold text-govt-dark bg-gray-100 px-3 py-1.5 rounded inline-block border border-gray-200">
                        {{ $pemohon->nomor_berkas }}
                    </p>
                </div>
                
                <div>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Status Saat Ini</p>
                    <x-status-badge :status="$pemohon->current_status" class="text-sm px-3 py-1" />
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Jenis Layanan</p>
                        <p class="text-sm font-medium text-gray-900">{{ $pemohon->jenis_permohonan }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Tanggal Masuk</p>
                        <p class="text-sm font-medium text-gray-900">{{ $pemohon->tanggal_pengajuan->translatedFormat('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-bold text-gray-900 mt-8 mb-6 border-b pb-3">Data Diri</h3>
            
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1">Nama Lengkap</p>
                    <p class="text-base font-bold text-gray-900">{{ $pemohon->nama_lengkap }}</p>
                </div>
                
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1">NIK</p>
                    <p class="text-sm font-medium text-gray-900 font-mono">{{ $pemohon->nik }}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-1">Tempat Lahir</p>
                        <p class="text-sm text-gray-900">{{ $pemohon->tempat_lahir }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-1">Tanggal Lahir</p>
                        <p class="text-sm text-gray-900">{{ $pemohon->tanggal_lahir->translatedFormat('d M Y') }}</p>
                    </div>
                </div>
                
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1">Alamat Lengkap</p>
                    <p class="text-sm text-gray-900 leading-relaxed">{{ $pemohon->alamat }}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-1">No. Handphone</p>
                        <p class="text-sm text-gray-900">{{ $pemohon->no_hp }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-1">Email</p>
                        <p class="text-sm text-gray-900 truncate">{{ $pemohon->email ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Timeline di kolom kanan --}}
    <div class="lg:col-span-2">
        <div class="card p-6 md:p-8 h-full bg-gray-50/50">
            <h3 class="text-xl font-bold text-gray-900 mb-8 border-b pb-3 border-gray-200">Timeline Proses BAP</h3>
            
            @if($pemohon->statusHistories->isEmpty())
                <div class="bg-white border-2 border-dashed border-gray-300 rounded-xl p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum Ada Proses</h3>
                    <p class="mt-2 text-gray-500 max-w-sm mx-auto">Berkas ini belum diproses. Silakan update status untuk memulai proses BAP tahap pertama.</p>
                    
                    <a href="{{ route('pemohon.update-status', $pemohon) }}" class="btn-primary mt-6">
                        Mulai Proses BAP
                    </a>
                </div>
            @else
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                    @include('components.status-timeline', ['pemohon' => $pemohon, 'statusFlow' => $statusFlow])
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
