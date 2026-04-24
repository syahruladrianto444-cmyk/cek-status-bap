<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kantor Imigrasi - Tracking BAP')</title>
    <meta name="description" content="Sistem Pelacakan Status Berita Acara Pemeriksaan (BAP) Kantor Imigrasi">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-gradient-to-r from-govt-dark via-govt-blue to-govt-navy shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('landing') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-kemenkumham.png') }}" alt="Logo Pusat" class="h-10 w-auto">
                    <img src="{{ asset('images/logo-imigrasi.png') }}" alt="Logo Imigrasi" class="h-10 w-auto">
                    <div class="hidden sm:block border-l-2 border-gold-500 pl-3">
                        <span class="text-white font-bold text-lg tracking-tight block leading-tight">SIPAS BAP</span>
                        <span class="text-gold-400 text-[10px] block tracking-normal uppercase">Sistem Pelacakan Status Berita Acara Pemeriksaan</span>
                    </div>
                </a>

                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('landing') }}" class="text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        Beranda
                    </a>
                    <a href="{{ route('landing') }}#tentang" class="text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        Tentang
                    </a>
                    <a href="{{ route('landing') }}#tracking" class="text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        Lacak Berkas
                    </a>
                </div>

                {{-- Mobile menu button --}}
                <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="md:hidden text-white p-2 rounded-lg hover:bg-white/10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile menu --}}
            <div id="mobileMenu" class="hidden md:hidden pb-4 space-y-1">
                <a href="{{ route('landing') }}" class="block text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm">Beranda</a>
                <a href="{{ route('landing') }}#tentang" class="block text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm">Tentang</a>
                <a href="{{ route('landing') }}#tracking" class="block text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm">Lacak Berkas</a>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-govt-dark text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo-kemenkumham.png') }}" alt="Logo Pusat" class="h-10 w-auto">
                        <img src="{{ asset('images/logo-imigrasi.png') }}" alt="Logo Imigrasi" class="h-10 w-auto">
                        <div>
                            <span class="text-white font-bold text-lg">SIPAS BAP</span>
                            <span class="text-gold-400 text-[10px] block">Kantor Imigrasi Kelas I Non TPI Pemalang</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Sistem Pelacakan Status Berita Acara Pemeriksaan (BAP) untuk memberikan transparansi dan kemudahan bagi pemohon.
                    </p>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Tautan</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('landing') }}" class="hover:text-gold-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('landing') }}#tentang" class="hover:text-gold-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('landing') }}#tracking" class="hover:text-gold-400 transition-colors">Lacak Berkas</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Kontak</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start space-x-3">
                            <svg class="w-4 h-4 text-gold-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Jl. Perintis Kemerdekaan, Beji, Kec. Taman, Kabupaten Pemalang, Jawa Tengah 52361, Indonesia</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-gold-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>+62 813-3344-580</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-gold-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>bapinteldakimpml@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-700 text-center">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Kantor Imigrasi. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

</body>
</html>
