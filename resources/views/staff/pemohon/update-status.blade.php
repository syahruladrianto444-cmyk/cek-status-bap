@extends('layouts.staff')

@section('page-title', 'Update Status BAP')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('pemohon.show', $pemohon) }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-govt-blue">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Detail
    </a>
</div>

@if($nextStatus === null)
    <div class="max-w-2xl mx-auto">
        @if($currentStatus === 'Proses Penindakan di Kasubsi' && $pemohon->latestStatus?->status_detail === 'Penangguhan')
        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-xl shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-red-800">Status Ditangguhkan</h3>
                    <div class="mt-2 text-red-700">
                        <p>Status pemohon ditangguhkan dan <strong>tidak bisa membuat paspor lagi dalam jangka periode 6-12 bulan</strong> ke depan.</p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-6 rounded-r-xl shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-emerald-800">Proses BAP Selesai</h3>
                    <div class="mt-2 text-emerald-700">
                        <p>Pemohon dengan nomor berkas <strong>{{ $pemohon->nomor_berkas }}</strong> telah menyelesaikan seluruh tahapan BAP.</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Form Update --}}
        <div class="lg:col-span-2">
            <div class="card p-8 border-t-4 border-t-emerald-500">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900 border-b pb-3 mb-6">Pembaruan Tahap Proses</h2>
                    
                    <div class="bg-blue-50 bg-opacity-50 p-4 rounded-lg flex justify-between items-center mb-8 border border-blue-100">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Status Saat Ini</p>
                            <x-status-badge :status="$currentStatus" />
                        </div>
                        <div class="text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600 mb-1">Tahap Selanjutnya</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                {{ $nextStatus }}
                            </span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('pemohon.update-status.store', $pemohon) }}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="status" value="{{ $nextStatus }}">

                    {{-- Conditional Status Details --}}
                    @if(isset($statusDetails[$nextStatus]))
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keputusan / Tindakan <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                @foreach($statusDetails[$nextStatus] as $detail)
                                    <div>
                                        <input type="radio" name="status_detail" id="detail_{{ Str::slug($detail) }}" value="{{ $detail }}" class="peer sr-only" required>
                                        <label for="detail_{{ Str::slug($detail) }}" 
                                            class="block w-full px-4 py-3 border rounded-lg cursor-pointer transition-all border-gray-300 text-gray-700 hover:bg-gray-50 peer-checked:border-2 peer-checked:shadow-sm text-center font-medium
                                            @if($detail === 'Disetujui') peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700
                                            @elseif(in_array($detail, ['Ditolak', 'Tidak Disetujui'])) peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:text-red-700
                                            @else peer-checked:border-amber-500 peer-checked:bg-amber-50 peer-checked:text-amber-700 @endif
                                            ">
                                            {{ $detail }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('status_detail') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                            Keterangan Tambahan 
                            @if($nextStatus !== 'Selesai BAP')<span class="text-gray-400 font-normal ml-1">(Opsional)</span>@endif
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="4" 
                            class="input-field block w-full" 
                            placeholder="{{ $nextStatus === 'Selesai BAP' ? 'Contoh: Lanjut ke tahap foto paspor' : 'Catatan hasil wawancara atau alasan penolakan...' }}">{{ old('keterangan') }}</textarea>
                        @error('keterangan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-6 mt-8 border-t flex justify-end">
                        <button type="submit" class="btn-primary shadow-md px-8 py-3 bg-emerald-600 hover:bg-emerald-700 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan Perubahan Status
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Minimal Info Pemohon --}}
        <div class="lg:col-span-1">
            <div class="card p-6 border-t-4 border-t-govt-dark sticky top-24">
                <h3 class="font-bold text-gray-900 border-b pb-2 mb-4">Ringkasan Berkas</h3>
                
                <div class="space-y-4 text-sm">
                    <div>
                        <span class="text-gray-500 block mb-0.5">Nomor Berkas</span>
                        <span class="font-bold text-gray-900 font-mono">{{ $pemohon->nomor_berkas }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block mb-0.5">Nama Pemohon</span>
                        <span class="font-medium text-gray-900">{{ $pemohon->nama_lengkap }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block mb-0.5">Jenis Layanan</span>
                        <span class="font-medium text-gray-900">{{ $pemohon->jenis_permohonan }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block mb-0.5">Mulai Masuk</span>
                        <span class="font-medium text-gray-900">{{ $pemohon->tanggal_pengajuan->translatedFormat('d M Y') }}</span>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100">
                    <div class="p-3 bg-blue-50 rounded-lg text-xs leading-relaxed text-blue-800">
                        <strong class="block mb-1">Perhatian:</strong>
                        Pembaruan status ini bersifat final untuk tahapan ini dan akan tersimpan di riwayat berkas (Audit Trail).
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
