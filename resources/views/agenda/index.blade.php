@extends('layouts.app', ['title' => 'Agenda Desa Lemahbang'])

@section('content')
<div class="max-w-6xl mx-auto py-12">

    <h1 class="text-3xl font-bold mb-10 text-center">
         Agenda Desa
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach ($agenda as $item)
            <a href="{{ route('agenda.show', $item->id_agenda) }}"
               class="group bg-white rounded-2xl shadow-md p-6
                      transition duration-300
                      hover:shadow-xl hover:-translate-y-1
                      border border-transparent hover:border-blue-300">

                {{-- Header --}}
                <h2 class="text-2xl font-bold text-gray-800
                           group-hover:text-blue-600 transition">
                    {{ $item->nama_agenda }}
                </h2>

                {{-- Deskripsi --}}
                <p class="text-gray-600 mt-3 leading-relaxed">
                    {{ Str::limit($item->deskripsi_agenda, 120) }}
                </p>

                <hr class="my-4">

                {{-- Info --}}
                <div class="space-y-1 text-sm text-gray-500">
                    <p>
                        📍 <span class="font-semibold">Lokasi:</span>
                        {{ Str::limit($item->lokasi_agenda, 120) }}
                    </p>

                    <p>
                        🗓️ <span class="font-semibold">Tanggal:</span>
                        {{ \Carbon\Carbon::parse($item->tanggal_agenda)->translatedFormat('d F Y') }}
                    </p>
                </div>

                {{-- Footer --}}
                <div class="mt-5 text-blue-600 font-semibold text-sm
                            opacity-0 group-hover:opacity-100 transition">
                    Lihat Detail →
                </div>

            </a>
        @endforeach
    </div>
</div>
@endsection
