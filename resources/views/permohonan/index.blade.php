@extends('layouts.app', ['title' => 'Layanan Permohonan Surat Desa Lemahbang'])

@section('content')
<center>
    <h2 class="text-3xl font-bold mb-6">Layanan Permohonan Surat</h2>
</center>

<div class="pt-15 pb-15">
<div class="grid md:grid-cols-3 gap-6">
    @foreach ($layanan as $item)
        <a href="{{ route('permohonan.create', $item->id_layanan) }}"
           class="group bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300" >
            {{-- Header --}}
                <div class="mb-3">

                    <h2 class="text-lg font-bold text-gray-800 group-hover:text-blue-600">
                        {{ $item->nama_layanan }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ Str::limit($item->deskripsi_layanan, 90) }}
                    </p>
                </div>
            <!-- <h2 class="font-semibold">{{ $item->nama_layanan }}</h2> -->
            <!-- <p class="text-gray-500">{{ Str::limit($item->deskripsi_layanan, 80) }}</p> -->

             {{-- Divider --}}
            <div class="border-t border-gray-100 my-3"></div>

        {{-- Syarat --}}
        <div>
            <p class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-1">
                📄 Syarat Pengajuan :
            </p>

            <ul class="space-y-1 text-sm text-gray-600">
                @foreach ($item->syarat->take(3) as $syarat)
                    <li class="flex items-start gap-2">
                        <span class="text-blue-500 mt-1">•</span>
                        <span>{{ $syarat->nama_syarat }}</span>
                    </li>
                @endforeach
            </ul>

            {{-- Jika syarat lebih dari 3 --}}
            @if ($item->syarat->count() > 3)
                <p class="text-xs text-gray-400 mt-2 italic">
                    +{{ $item->syarat->count() - 3 }} syarat lainnya
                </p>
            @endif
        </div>

        {{-- Footer --}}
        <div class="mt-4">
            <span class="inline-block text-sm font-medium text-blue-600 group-hover:underline">
                Ajukan Permohonan →
            </span>
        </div>

</a>
@endforeach










</div>
</div>
@endsection
