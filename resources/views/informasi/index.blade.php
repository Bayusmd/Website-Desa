@extends('layouts.app', ['title' => 'Informasi Desa Lemahbang'])

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16">

    {{-- Judul --}}
    <h2 class="text-4xl font-bold text-center mb-14 text-gray-800">
         Informasi Desa
    </h2>

    {{-- Grid Card --}}
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($informasi as $info)
            <a href="{{ route('informasi.show', $info->id_informasi) }}"
               class="group bg-white rounded-2xl shadow-md overflow-hidden
                      transition duration-300
                      hover:shadow-xl hover:-translate-y-1">

                {{-- Gambar --}}
                <div class="overflow-hidden">
                    <img src="{{ asset('storage/' . $info->gambar) }}"
                         class="h-48 w-full object-cover
                                transition duration-500
                                group-hover:scale-105">
                </div>

                {{-- Konten --}}
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800
                               group-hover:text-blue-600 transition">
                        {{ $info->judul }}
                    </h3>

                    <p class="text-gray-600 text-sm mt-3 leading-relaxed">
                        {{ Str::limit($info->deskripsi, 90) }}
                    </p>

                    <div class="mt-5 flex justify-between items-center">
                        <span class="text-blue-600 font-semibold text-sm">
                            Baca Selengkapnya →
                        </span>

                        <span class="text-xs text-gray-400">
                            Informasi Desa
                        </span>
                    </div>
                </div>

            </a>
        @endforeach
    </div>

</div>
@endsection
