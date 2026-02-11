@extends('layouts.app', ['title' => 'Status Permohonan Surat Desa Lemahbang'])

@section('content')
<div class="max-w-4xl mx-auto py-12">

    <h2 class="text-3xl font-bold mb-6 text-center">
         Riwayat Permohonan Surat
    </h2>

    {{-- Form Pencarian --}}
    <form action="{{ route('permohonan.riwayat.search') }}" method="POST"
          class="bg-white p-6 shadow rounded-xl mb-8 transition hover:shadow-lg">
        @csrf

        <label class="block mb-2 font-semibold">
            Masukkan ID Permohonan Anda
        </label>

        <input type="text" name="id_permohonan"
               class="w-full border px-4 py-2 rounded-lg focus:ring focus:ring-blue-200"
               placeholder="Contoh: 25"
               required
               maxlength="20"
               title="ID Hanya berisi angka tanpa tanda minus atau koma"
               pattern="[0-9]+"
               inputmode="numeric">

        <button class="mt-4 bg-gray-600 hover:bg-gray-700
                       text-white px-6 py-2 rounded-lg transition">
            Cari Permohonan
        </button>
    </form>

    {{-- Hasil --}}
    @isset($data)
        <h3 class="text-xl font-bold mb-4">
            Hasil Pencarian untuk ID Permohonan: {{ $id_permohonan }}
        </h3>

        @if ($data->isEmpty())
            <div class="bg-red-50 border border-red-200 p-4 rounded-lg text-red-700">
                Tidak ada permohonan yang ditemukan.
            </div>
        @endif

        <div class="space-y-6">
            @foreach ($data as $item)
                <div class="bg-white rounded-2xl shadow-md p-6
                            transition duration-300 hover:shadow-xl
                            hover:-translate-y-1">

                    {{-- Header --}}
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-semibold text-blue-600">
                            {{ $item->layanan->nama_layanan }}
                        </h3>

                        {{-- Status Badge --}}
                        @php
                            $statusColor = match($item->status_permohonan) {
                                'baru' => 'bg-blue-100 text-blue-700',
                                'proses' => 'bg-yellow-100 text-yellow-700',
                                'selesai' => 'bg-green-100 text-green-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp

                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                            {{ ucfirst($item->status_permohonan) }}
                        </span>
                    </div>

                    {{-- Info pemohon --}}
                    <p class="text-sm text-gray-600 mb-3">
                        <strong>Nama Pemohon:</strong>
                        {{ ($item->nama_pemohon) }}
                    </p>

                    {{-- Info --}}
                    <p class="text-sm text-gray-600 mb-3">
                        <strong>Tanggal Permohonan:</strong>
                        {{ date('d M Y', strtotime($item->tanggal_permohonan)) }}
                    </p>

                    {{-- Berkas --}}
                    <div class="mb-4">
                        <p class="font-semibold mb-1">📎 Berkas Permohonan Yang Telah Disertakan:</p>
                        <ul class="list-disc ml-6 text-sm">
                            @foreach ($item->berkas as $b)
                                <li>
                                    <a class="text-black-600">
                                        {{ $b->nama_berkas }}
                                    </a>
                                </li>
                                 <!-- <li> -->
                                    <!-- <a href="{{ asset('storage/' . $b->file_path) }}" -->
                                       <!-- target="_blank" -->
                                       <!-- class="text-blue-600 hover:underline"> -->
                                        <!-- {{ $b->nama_berkas }} -->
                                    <!-- </a> -->
                                <!-- </li> -->
                            @endforeach
                        </ul>
                    </div>

                    {{-- DETAIL TAMBAHAN JIKA SELESAI --}}
                    @if ($item->status_permohonan === 'selesai')
                        <details class="mt-4 bg-green-50 border border-green-200 rounded-lg p-4">
                            <summary class="cursor-pointer font-semibold text-green-700">
                                ℹ️ Informasi Pengambilan Surat
                            </summary>

                            <p class="mt-3 text-green-800 text-sm leading-relaxed">
                                Permohonan layanan
                                <strong>{{ $item->layanan->nama_layanan }}</strong>
                                Anda telah selesai diproses.
                                <br><br>
                                Silakan datang ke kantor desa pada jam kerja untuk pengambilan surat.
                                <br><br>
                                Terima kasih 🙏
                            </p>
                        </details>
                    @endif

                </div>
            @endforeach
        </div>
    @endisset

</div>
@endsection
