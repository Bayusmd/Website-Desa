@extends('layouts.app', ['title' => 'Status Aduan Masyarakat'])

@section('content')
<div class="max-w-4xl mx-auto py-12">

    <h2 class="text-3xl font-bold mb-6 text-center">
         Riwayat Aduan Masyarakat
    </h2>

    {{-- Form Pencarian --}}
    <form action="{{ route('aduan.riwayat.search') }}" method="POST"
          class="bg-white p-6 shadow rounded-xl mb-8 transition hover:shadow-lg">
        @csrf

        <label class="block mb-2 font-semibold">
            Masukkan ID Aduan Anda
        </label>

        <input type="text" name="id_aduan"
               class="w-full border px-4 py-2 rounded-lg focus:ring focus:ring-blue-200"
               placeholder="Contoh: 25"
               required
               maxlength="20"
               title="ID Hanya berisi angka tanpa tanda minus atau koma"
               pattern="[0-9]+"
               inputmode="numeric">

        <button class="mt-4 bg-gray-600 hover:bg-gray-700
                       text-white px-6 py-2 rounded-lg transition">
            Cari Aduan
        </button>
    </form>


    {{-- HASIL TRACKING --}}
        @isset($aduan)
        <h3 class="text-xl font-bold mb-4">
            Hasil Pencarian untuk ID Permohonan: {{ $id_aduan }}
        </h3>

        <div class="mt-8 bg-white rounded-2xl shadow-md p-6
                    transition duration-300 hover:shadow-xl">

            {{-- Header --}}
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-semibold text-blue-600">
                        Detail Aduan
                    </h3>
                    <p class="text-sm text-gray-500">
                        ID Aduan: <strong>{{ $aduan->id_aduan }}</strong>
                    </p>
                </div>

                {{-- STATUS BADGE --}}
                @php
                    $statusColor = match($aduan->status_aduan) {
                        'baru' => 'bg-blue-100 text-blue-700',
                        'proses' => 'bg-yellow-100 text-yellow-700',
                        'selesai' => 'bg-green-100 text-green-700',
                        default => 'bg-gray-100 text-gray-700',
                    };
                @endphp

                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                    {{ ucfirst($aduan->status_aduan) }}
                </span>
            </div>

            {{-- INFORMASI --}}
            <div class="space-y-3 text-sm text-gray-700">

                <div>
                    <strong>Kategori Aduan:</strong><br>
                    {{ $aduan->kategori_aduan }}
                </div>

                <div>
                    <strong>Tanggal Aduan:</strong><br>
                    {{ \Carbon\Carbon::parse($aduan->tanggal_aduan)->format('d M Y') }}
                </div>

                <div>
                    <strong>Deskripsi Aduan:</strong><br>
                    <div class="bg-gray-50 border rounded-lg p-3 mt-1">
                        {{ $aduan->deskripsi_aduan }}
                    </div>
                </div>

            </div>

        </div>
    @endisset

</div>
@endsection
