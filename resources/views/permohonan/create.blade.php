@extends('layouts.app', ['title' => 'Pengajuan Permohonan Surat Desa Lemahbang'])

@section('content')
<div class="max-w-4xl mx-auto pt-20 pb-20">

    <h2 class="text-3xl font-bold mb-6 text-center">
        Ajukan Permohonan Surat
    </h2>

    <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white p-8 rounded-xl shadow-md w-full md:w-2/3 mx-auto">
        @csrf

        <input type="hidden" name="Layanan_surat_id_layanan" value="{{ $layanan->id_layanan }}">

        {{-- Nama Layanan --}}
        <div class="mb-6">
            <p class="text-sm text-gray-500">Layanan yang dipilih</p>
            <h3 class="text-xl font-semibold text-blue-600">
                {{ $layanan->nama_layanan }}
            </h3>
        </div>

        {{-- Data Pemohon --}}
        <div class="space-y-4">

            <div>
                <label class="block font-medium mb-1">NIK Pemohon</label>
                <input type="text" inputmode="numeric"
                    name="nik_pemohon"
                    value="{{ old('nik_pemohon') }}"
                    minlength="16"
                    maxlength="16"
                    title="NIK harus berupa 16 digit angka"
                    pattern="[0-9]{16}"
                    placeholder="Masukkan NIK anda (Max:16 digit)"
                       class="border w-full px-4 py-2 rounded focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Pemohon</label>
                <input type="text" required name="nama_pemohon"
                    value="{{ old('nama_pemohon') }}"
                    minlength="3"
                    pattern="[A-Za-z\s]+"
                    title="Nama Pemohon minimal berisi 3 karakter dan hanya boleh berisi huruf dan spasi"
                    placeholder="Masukkan Nama Lengkap Anda"
                    class="border w-full px-4 py-2 rounded focus:ring focus:ring-blue-200 @error('nama_pemohon') border-red-500 @enderror">
                       @error('nama_pemohon')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">Alamat Pemohon</label>
                <textarea name="alamat_pemohon" rows="3"
                        required
                        value="{{ old('alamat_pemohon') }}"
                        title="Masukkan Alamat Anda (Nama Dusun RT/RW)"
                        placeholder="Masukkan Alamat Anda (Nama Dusun dan RT/RW)"
                          class="border w-full px-4 py-2 rounded focus:ring focus:ring-blue-200"></textarea>
                    <p class="text-xs text-gray-500 mt-1">
                        Contoh: Dusun Patih RT 01 / RW 08
                    </p>
            </div>

            <div>
                <label class="block font-medium mb-1">No WhatsApp</label>
                <input type="text" inputmode="numeric" name="no_whatsapp"
                    pattern="[0-9]*"
                    value="{{ old('no_whatsapp') }}"
                    minlength="10"
                    maxlength="15"
                    title="Masukkan nomor WhatsApp yang valid (hanya angka)"
                    placeholder="Masukkan No Wa Anda (Contoh: 081234567890)"
                    class="border w-full px-4 py-2 rounded focus:ring focus:ring-blue-200 @error('no_whatsapp') border-red-500 @enderror">
                        @error('no_whatsapp')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                <p class="text-xs text-gray-500 mt-1">
                    Gunakan format 08xxxxxxxxxx atau 628xxxxxxxxxx
                </p>
            </div>

            <div>
                <label class="block font-medium mb-1">Email Pemohon</label>
                <input type="email" required
                    name="email_pemohon"
                    value="{{ old('email_pemohon') }}"
                    title="Masukkan alamat email yang valid"
                    placeholder="Masukkan Email Anda (Contoh: anda123@gmail.com)"
                       class="border w-full px-4 py-2 rounded focus:ring focus:ring-blue-200  @error('email_pemohon') border-red-500 @enderror">
                       @error('email_pemohon')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
            </div>

        </div>

        {{-- Upload Berkas --}}
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-3 flex items-center gap-2">
                📎 Unggah Berkas Persyaratan
            </h3>

            <div class="space-y-4">
                @foreach ($layanan->syarat as $s)
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <label class="block font-medium mb-1">
                            {{ $s->nama_syarat }}
                        </label>

                        <input type="file"
                               name="berkas[{{ $s->id_syarat }}]"
                               accept=".jpg,.jpeg,.png"
                               required
                               title="Unggah File sesuai dengan format"
                               class="block w-full text-sm border rounded px-3 py-2">

                        <p class="text-xs text-gray-500 mt-1">
                            Format: JPG / JPEG / PNG · Maksimal 2 MB
                        </p>

                        @error('berkas.'.$s->id_syarat)
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Tombol --}}
        <div class="mt-8 text-center">
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white
                           px-6 py-2 rounded-lg transition">
                Kirim Permohonan
            </button>
        </div>

    </form>
</div>
@endsection
