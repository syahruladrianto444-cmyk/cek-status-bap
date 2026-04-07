@extends('layouts.staff')

@section('page-title', isset($pemohon) ? 'Edit Data Pemohon' : 'Tambah Pemohon Baru')

@section('content')
<div class="mb-6">
    <a href="{{ isset($pemohon) ? route('pemohon.show', $pemohon) : route('pemohon.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-govt-blue">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

<div class="max-w-4xl mx-auto">
    <div class="card p-8 border-t-4 border-t-govt-blue">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
            {{ isset($pemohon) ? 'Edit Berkas' : 'Registrasi Berkas BAP Baru' }}
        </h2>

        <form action="{{ isset($pemohon) ? route('pemohon.update', $pemohon) : route('pemohon.store') }}" method="POST">
            @csrf
            @if(isset($pemohon))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                {{-- Data Permohonan --}}
                <div class="md:col-span-2 border-b pb-4 mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-govt-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Data Permohonan
                    </h3>
                </div>

                <div>
                    <label for="nomor_berkas" class="block text-sm font-medium text-gray-700">Nomor Berkas <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_berkas" id="nomor_berkas" value="{{ old('nomor_berkas', $pemohon->nomor_berkas ?? 'BAP-'.date('Y').'-') }}" class="mt-1 input-field" required>
                    @error('nomor_berkas') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="jenis_permohonan" class="block text-sm font-medium text-gray-700">Jenis Layanan <span class="text-red-500">*</span></label>
                    <select name="jenis_permohonan" id="jenis_permohonan" class="mt-1 input-field" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Paspor Baru" {{ old('jenis_permohonan', $pemohon->jenis_permohonan ?? '') === 'Paspor Baru' ? 'selected' : '' }}>Paspor Baru</option>
                        <option value="Perpanjangan Paspor" {{ old('jenis_permohonan', $pemohon->jenis_permohonan ?? '') === 'Perpanjangan Paspor' ? 'selected' : '' }}>Perpanjangan Paspor</option>
                        <option value="Penggantian Hilang/Rusak" {{ old('jenis_permohonan', $pemohon->jenis_permohonan ?? '') === 'Penggantian Hilang/Rusak' ? 'selected' : '' }}>Penggantian Hilang/Rusak</option>
                    </select>
                    @error('jenis_permohonan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="tanggal_pengajuan" class="block text-sm font-medium text-gray-700">Tanggal Pengajuan <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" value="{{ old('tanggal_pengajuan', isset($pemohon) ? $pemohon->tanggal_pengajuan->format('Y-m-d') : date('Y-m-d')) }}" class="mt-1 input-field w-full md:w-1/2" required>
                    @error('tanggal_pengajuan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Data Diri Pemohon --}}
                <div class="md:col-span-2 border-b border-t pt-8 pb-4 mt-4 mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-govt-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Identitas Pemohon
                    </h3>
                </div>

                <div class="md:col-span-2">
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap Sesuai KTP <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $pemohon->nama_lengkap ?? '') }}" class="mt-1 input-field" required>
                    @error('nama_lengkap') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="nik" class="block text-sm font-medium text-gray-700">Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" id="nik" maxlength="16" value="{{ old('nik', $pemohon->nik ?? '') }}" class="mt-1 input-field font-mono" placeholder="16 digit NIK" required>
                    @error('nik') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $pemohon->tempat_lahir ?? '') }}" class="mt-1 input-field" required>
                    @error('tempat_lahir') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', isset($pemohon) ? $pemohon->tanggal_lahir->format('Y-m-d') : '') }}" class="mt-1 input-field" required>
                    @error('tanggal_lahir') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap (KTP) <span class="text-red-500">*</span></label>
                    <textarea name="alamat" id="alamat" rows="3" class="mt-1 input-field" required>{{ old('alamat', $pemohon->alamat ?? '') }}</textarea>
                    @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">No. WhatsApp/Handphone <span class="text-red-500">*</span></label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pemohon->no_hp ?? '') }}" class="mt-1 input-field" required>
                    @error('no_hp') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Aktif</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $pemohon->email ?? '') }}" class="mt-1 input-field">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200 mt-8 flex justify-end gap-3">
                <a href="{{ isset($pemohon) ? route('pemohon.show', $pemohon) : route('pemohon.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary shadow-md">
                    {{ isset($pemohon) ? 'Simpan Perubahan' : 'Daftarkan Berkas' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
