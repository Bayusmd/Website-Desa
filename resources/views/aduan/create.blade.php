@extends('layouts.app', ['title' => 'Layanan Aduan Masyarakat'])

@section('content')
<div class="bg-gray-50 py-8">

    <div class="max-w-xl mx-auto px-4">
        {{-- Tombol --}}
        <div class="flex justify-end mb-4">
            <a href="{{ route('aduan.riwayat') }}"
               class="bg-gray-600 hover:bg-gray-700 font-semibold
                      text-white text-sm px-4 py-2
                      rounded-lg shadow transition">
                Lihat Status Aduan
            </a>
        </div>

    {{-- NOTIFIKASI SUKSES --}}
    @if (session('success'))
        <div
            x-data="{ open: true }"
            x-show="open"
            x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
        >
            <div
                @click.outside="open = false"
                class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 text-center"
            >
                <div class="text-green-600 text-5xl mb-4">✔</div>

                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Berhasil!
                </h2>

                <p class="text-gray-600 mb-6">
                    {!! session('success') !!}
                </p>

                <button
                    @click="open = false"
                    class="bg-green-600 hover:bg-green-700
                           text-white px-6 py-2 rounded-lg
                           transition"
                >
                    OK
                </button>
            </div>
        </div>
    @endif











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
                    <option value="infrastruktur">Infrastruktur</option>
                    <option value="pemerintahan">Pemerintahan</option>
                    <option value="lingkungan">Lingkungan</option>
                    <option value="kesehatan">Kesehatan</option>
                    <option value="keamanan">Keamanan</option>
                    <option value="pelayanan">Pelayanan</option>
                    <option value="keuangan">Keuangan</option>
                    <option value="lainnya">Lainnya</option>
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






