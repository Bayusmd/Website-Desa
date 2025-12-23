@extends('layouts.app', ['title' => 'Informasi Desa Lemahbang'])

@section('content')
<div class="pt-20 pb-20">
<center>

    <h2 class="text-3xl font-bold mb-4">{{ $info->judul }}</h2>

    <img
        src="{{ asset('storage/' . $info->gambar) }}"
        class="rounded mb-4 max-w-full h-auto mx-auto"
        alt="{{ $info->judul }}"
    >

    <p class="text-2xl font-semibold">{{ $info->deskripsi }}</p>

</center>
</div>
@endsection
