@extends('layouts.app', ['title' => 'Layanan Aduan Masyarakat'])

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10">

    <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-8
                transition duration-300 hover:shadow-xl">

        {{-- Judul --}}
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">
                📢 Aduan Masyarakat
            </h2>
            <p class="text-gray-500 mt-2">
                Sampaikan aduan Anda dengan jelas dan benar
            </p>
        </div>

        <form action="{{ route('aduan.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Kategori --}}
            <div>
                <label class="block font-medium mb-1">
                    Kategori Aduan
                </label>

                <select name="kategori_aduan"
                        required
                        title="pilih salah satu kategori aduan"
                        class="w-full border px-4 py-2 rounded-lg
                               focus:ring focus:ring-blue-200
                               focus:border-blue-500
                               transition duration-200">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Infrastruktur">Infrastruktur</option>
                    <option value="Lingkungan">Lingkungan</option>
                    <option value="Pelayanan Publik">Pelayanan Publik</option>
                    <option value="Keamanan">Keamanan</option>
                    <option value="Keuangan">Keuangan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-medium mb-1">
                    Deskripsi Aduan
                </label>

                <textarea name="deskripsi_aduan" rows="4"
                        required
                        minlength="10"
                        title="Masukkan aduan anda minimal 10 karakter"
                          placeholder="Tuliskan aduan Anda secara detail, lengkap dan menggunakan bahas yang baik . . ."
                          class="w-full border px-4 py-2 rounded-lg
                                 focus:ring focus:ring-blue-200
                                 focus:border-blue-500
                                 transition duration-200"></textarea>
            </div>

            {{-- Tombol --}}
            <div class="pt-4 text-center">
                <button type="submit"
                        class="bg-gray-600 hover:bg-gray-700
                               text-white font-semibold
                               px-6 py-2 rounded-lg
                               transition duration-300
                               transform hover:-translate-y-0.5
                               hover:shadow-md">
                    Kirim Aduan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
