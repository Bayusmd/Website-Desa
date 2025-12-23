@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-16">

    {{-- Card Utama --}}
    <div class="bg-white rounded-2xl shadow-lg p-8">

        {{-- Judul --}}
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            {{ $agenda->nama_agenda }}
        </h1>

        {{-- Meta Info --}}
        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-6">
            <span class="flex items-center gap-2">
                📅
                {{ \Carbon\Carbon::parse($agenda->tanggal_agenda)->translatedFormat('d F Y') }}
            </span>

            <span class="flex items-center gap-2">
                📍
                {{ $agenda->lokasi_agenda }}
            </span>
        </div>

        <hr class="mb-6">

        {{-- Deskripsi --}}
        <div class="prose max-w-none text-gray-700 leading-relaxed">
            {{ $agenda->deskripsi_agenda }}
        </div>

        {{-- Footer --}}
        <div class="mt-10 flex justify-between items-center">
            <a href="{{ url('/agenda') }}"
               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold transition">
                ← Kembali ke Agenda
            </a>

            <span class="text-xs text-gray-400">
                Agenda Desa
            </span>
        </div>

    </div>

</div>
@endsection
