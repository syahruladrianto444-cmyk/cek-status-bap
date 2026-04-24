@extends('layouts.public')

@section('title', 'Hasil Pelacakan - ' . $pemohon->nomor_berkas)

@section('content')
<div class="bg-gray-50 py-12 min-h-[calc(100vh-64px-300px)]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('landing') }}" class="inline-flex items-center text-sm font-medium text-govt-blue hover:text-govt-dark">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column: Applicant Info --}}
            <div class="lg:col-span-1 border-0">
                <div class="card p-6 h-full border-t-4 border-t-govt-blue">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-3">Informasi Pemohon</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Nomor Berkas</p>
                            <p class="text-base font-semibold text-govt-dark mt-1 bg-gray-100 p-2 rounded-md inline-block">{{ $pemohon->nomor_berkas }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 font-medium">NIK</p>
                            <p class="text-base font-medium text-gray-900">{{ $pemohon->masked_nik }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 font-medium">Nama Lengkap</p>
                            <p class="text-base font-medium text-gray-900">{{ $pemohon->masked_nama_lengkap }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 font-medium">Tempat, Tgl Lahir</p>
                            <p class="text-base font-medium text-gray-900">{{ $pemohon->masked_tempat_lahir }}, {{ $pemohon->masked_tanggal_lahir }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 font-medium">Tanggal Pengajuan</p>
                            <p class="text-base font-medium text-gray-900">{{ $pemohon->tanggal_pengajuan->translatedFormat('d F Y') }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 font-medium">Jenis Permohonan</p>
                            <span class="inline-flex items-center px-2.5 py-1 mt-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $pemohon->jenis_permohonan }}
                            </span>
                        </div>

                        <div class="pt-4 mt-4 border-t border-gray-100">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-blue-800">Privasi Terjaga</h3>
                                        <div class="mt-2 text-xs text-blue-700">
                                            <p>Data pribadi Anda disamarkan untuk alasan keamanan dan privasi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Status Timeline --}}
            <div class="lg:col-span-2">
                <div class="card p-6 border-t-4 border-t-gold-500 h-full">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3 flex justify-between items-center">
                        <span>Status Permohonan Saat Ini</span>
                        <x-status-badge :status="$pemohon->current_status" />
                    </h3>

                    @if($pemohon->statusHistories->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada proses</h3>
                            <p class="mt-1 text-sm text-gray-500">Berkas permohonan baru didaftarkan dan belum mulai diproses.</p>
                        </div>
                    @else
                        {{-- Include Timeline Component --}}
                        <div class="mt-4">
                            @include('components.status-timeline', ['pemohon' => $pemohon, 'statusFlow' => $statusFlow])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
