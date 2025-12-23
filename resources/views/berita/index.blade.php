@extends('layouts.app', ['title' => 'Berita Desa Lemahbang'])

@section('content')
<div class="max-w-6xl mx-auto py-12">

    <h1 class="text-3xl font-bold mb-10 text-center">
        Berita Desa
    </h1>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($beritas as $item)
            <div class="border rounded-xl overflow-hidden shadow shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <img src="{{ asset('storage/'.$item->foto) }}" class="h-48 w-full object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-xl">
                        {{ $item->judul }}
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $item->admin->name }} •
                        {{ $item->created_at->format('d M Y') }}
                    </p>
                    <p class="text-gray-700 mt-3 line-clamp-3">
                        {!! Str::limit(strip_tags($item->isi), 120) !!}
                    </p>
                    <a href="{{ route('berita.show', $item->id) }}"
                       class="inline-block mt-4 text-gray-700 font-semibold">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    {{ $beritas->links() }}
</div>
@endsection
