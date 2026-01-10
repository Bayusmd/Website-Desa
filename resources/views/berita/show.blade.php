@extends('layouts.app', ['title' => 'Berita Desa Lemahbang'])

@section('content')
<div class="max-w-6xl mx-auto py-12">

    <h1 class="text-3xl font-bold mb-10 text-center">
        Berita Desa
    </h1>
    <h1 class="text-4xl font-bold mb-4">{{ $berita->judul }}</h1>

    <p class="text-gray-500 mb-6">
        {{ $berita->admin?->nama_admin ?? }} •
        {{ $berita->created_at->format('d M Y') }}
    </p>

    <img src="{{ asset('storage/'.$berita->foto) }}"
         class="w-full rounded-xl mb-6">

    <div class="prose max-w-none">
        {!! $berita->isi !!}
    </div>



</div>
@endsection
