@extends('layouts.public')

@section('title', 'Lacak Berkas BAP - Kantor Imigrasi')

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-govt-navy overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon fill="currentColor" points="0,100 100,0 100,100"/>
            </svg>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="text-center max-w-3xl mx-auto">
                <span class="inline-block py-1 px-3 rounded-full bg-govt-blue/50 text-gold-400 text-sm font-semibold tracking-wider mb-4 border border-gold-500/20">
                    LAYANAN PUBLIK IMIGRASI
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">
                    <span class="text-gold-400">SIPAS BAP</span>
                </h1>
                <p class="text-2xl font-bold text-white mb-4">
                    (Sistem Pelacakan Status Berita Acara Pemeriksaan)
                </p>
                <p class="text-lg md:text-xl text-gray-300 mb-10 leading-relaxed">
                    Pantau proses Berita Acara Pemeriksaan (BAP) paspor Anda secara transparan, mudah, dan real-time langsung dari perangkat Anda.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#tracking" class="btn-gold text-lg px-8 py-3 shadow-lg shadow-gold-500/30">
                        Mulai Lacak Berkas
                    </a>
                    <a href="#tentang" class="btn-secondary text-lg px-8 py-3 bg-transparent text-white border-white/30 hover:bg-white/10">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Tracking Section --}}
    <section id="tracking" class="py-20 bg-gray-50 -mt-10 relative z-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card shadow-xl border-0">
                <div class="p-8 md:p-10">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-govt-light text-govt-dark mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Lacak Status Permohonan</h2>
                        <p class="text-gray-500 mt-2">Masukkan nomor NIK Anda untuk melihat progres BAP</p>
                    </div>

                    <form action="{{ route('tracking') }}" method="POST" class="max-w-2xl mx-auto">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <label for="nik" class="sr-only">NIK</label>
                                <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                                       class="input-field block w-full px-5 py-4 text-lg border-gray-300 rounded-xl focus:ring-govt-blue focus:border-govt-blue shadow-sm"
                                       placeholder="Maksimal 16 digit NIK" required>
                                @error('nik')
                                    <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <button type="submit" class="btn-primary py-4 px-8 text-lg rounded-xl shadow-md bg-govt-blue hover:bg-govt-dark whitespace-nowrap">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                Lacak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Company Profile / Tentang --}}
    <section id="tentang" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6 border-l-4 border-gold-500 pl-4">Tentang Layanan Kami</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        Sistem Pelacakan Berita Acara Pemeriksaan (BAP) ini merupakan inovasi pelayanan publik dari Direktorat Jenderal Imigrasi untuk memberikan kepastian layanan kepada masyarakat.
                    </p>
                    <div class="space-y-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-govt-light text-govt-blue">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Keamanan Data</h3>
                                <p class="mt-2 text-base text-gray-500">Privasi dan data pribadi Anda dilindungi dengan sistem keamanan standar pemerintah.</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-govt-light text-govt-blue">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Real-time</h3>
                                <p class="mt-2 text-base text-gray-500">Status berkas diperbarui langsung oleh petugas pada setiap tahapan proses pemeriksaan.</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-govt-light text-govt-blue">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Transparansi</h3>
                                <p class="mt-2 text-base text-gray-500">Alur proses yang jelas dari awal wawancara hingga keputusan akhir dari Kepala Kantor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-govt-light to-transparent rounded-2xl transform translate-x-4 translate-y-4 -z-10"></div>
                    <div class="bg-govt-dark rounded-2xl p-8 shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 text-gold-500/10">
                            <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-6 relative z-10">Alur Standar BAP</h3>
                        <div class="space-y-4 relative z-10">
                            <div class="flex items-center p-3 rounded-lg bg-white/5 border border-white/10">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gold-500 text-govt-dark font-bold mr-4">1</span>
                                <span class="text-gray-200">Dalam Proses Pemeriksaan</span>
                            </div>
                            <div class="flex items-center p-3 rounded-lg bg-white/5 border border-white/10">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gold-500 text-govt-dark font-bold mr-4">2</span>
                                <span class="text-gray-200">Proses Pendalaman Pemeriksaan</span>
                            </div>
                            <div class="flex items-center p-3 rounded-lg bg-white/5 border border-white/10">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gold-500 text-govt-dark font-bold mr-4">3</span>
                                <span class="text-gray-200">Hasil BAP(Selesai)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
