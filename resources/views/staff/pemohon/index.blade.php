@extends('layouts.staff')

@section('page-title', 'Data Pemohon BAP')

@section('content')
<div class="card">
    {{-- Filtering & Actions --}}
    <div class="p-6 border-b border-gray-200">
        <form method="GET" action="{{ route('pemohon.index') }}" class="flex flex-col lg:flex-row gap-4 items-end">
            <div class="flex-1 w-full relative">
                <label for="search" class="sr-only">Cari</label>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       class="input-field block w-full pl-10 h-10" 
                       placeholder="Cari nama, NIK, atau no berkas...">
            </div>
            
            <div class="w-full lg:w-48">
                <label for="status" class="block text-xs font-medium text-gray-700 mb-1">Filter Status</label>
                <select name="status" id="status" class="input-field block w-full h-10 py-0 text-sm">
                    <option value="">Semua Status</option>
                    <option value="Belum Diproses" {{ request('status') === 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
                    @foreach(\App\Models\Pemohon::STATUS_FLOW as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="w-full lg:w-48">
                <label for="tanggal" class="block text-xs font-medium text-gray-700 mb-1">Filter Tanggal Masuk</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}" 
                       class="input-field block w-full h-10 py-0 text-sm">
            </div>

            <div class="flex gap-2 w-full lg:w-auto">
                <button type="submit" class="btn-primary h-10 items-center bg-govt-dark flex-1 lg:flex-none">
                    Terapkan
                </button>
                @if(request()->hasAny(['search', 'status', 'tanggal']))
                    <a href="{{ route('pemohon.index') }}" class="btn-secondary h-10 items-center px-4" title="Reset Filter">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
                <a href="{{ route('pemohon.create') }}" class="btn-gold h-10 items-center ml-auto">
                    <svg class="w-5 h-5 mr-1 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Tambah
                </a>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No. Berkas</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Identitas Pemohon</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Masuk</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status Terakhir</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pemohon as $p)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-sm font-medium bg-gray-100 text-gray-800 font-mono">
                            {{ $p->nomor_berkas }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm font-bold text-gray-900">{{ $p->nama_lengkap }}</div>
                                <div class="text-xs text-gray-500 font-mono mt-0.5">NIK: {{ $p->nik }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $p->tanggal_pengajuan->translatedFormat('d M Y') }}</div>
                        <div class="text-xs text-blue-600 font-medium mt-0.5">{{ $p->jenis_permohonan }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <x-status-badge :status="$p->current_status" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                             @if($p->current_status === 'Hasil BAP')
                                 <a href="{{ route('pemohon.whatsapp', $p) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 border border-emerald-500 text-xs font-medium rounded-lg text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-colors" title="Hubungi via WhatsApp">
                                     <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                    Hubungi
                                </a>
                             @endif
                            <a href="{{ route('pemohon.show', $p) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-govt-blue bg-blue-50 hover:bg-blue-100 transition-colors">
                                Detail
                            </a>
                             <form action="{{ route('pemohon.destroy', $p) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini? Semua riwayat status juga akan terhapus.');" class="inline">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-red-200 text-xs font-medium rounded-lg text-red-700 bg-red-50 hover:bg-red-100 transition-colors" title="Hapus Data">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                 </button>
                             </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Tidak ada data pemohon yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($pemohon->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $pemohon->links() }}
    </div>
    @endif
</div>
@endsection
