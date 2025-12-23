@extends('layouts.app', ['title' => 'Perangkat Desa Lemahbang'])

@section('content')
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Judul --}}
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900">
                Perangkat Desa
            </h1>
            <p class="text-gray-600 mt-2">
                Pemerintah Desa Lemahbang
            </p>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">

            @foreach ($perangkat as $item)
                <div
                    class="group bg-white rounded-2xl overflow-hidden
                           shadow-md transition-all duration-500
                           hover:shadow-2xl hover:-translate-y-3">

                    {{-- Foto --}}
                    <div class="h-80 overflow-hidden">
                        <img
                            src="{{ asset('storage/' . $item->foto) }}"
                            alt="{{ $item->nama }}"
                            class="w-full h-full object-cover
                                   transition-transform duration-700
                                   group-hover:scale-110">
                    </div>

                    {{-- Nama & Jabatan --}}
                    <div
                        class="bg-gray-900 text-white py-5 px-3
                               text-center transition
                               group-hover:bg-gray-500">

                        <h3 class="font-extrabold text-lg  tracking-wide">
                            {{ $item->nama }}
                        </h3>

                        <p class="text-sm opacity-90 mt-1">
                            {{ $item->jabatan }}
                        </p>
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</section>
@endsection
