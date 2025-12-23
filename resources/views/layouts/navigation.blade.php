<nav class="max-w-7xl mx-auto flex items-center justify-between py-6 px-6 lg:px-10">

    {{-- Logo + Nama Desa --}}
    <div class="flex items-center space-x-4">
        <img src="{{ asset('storage/images/logo-desa.png') }}" class="w-14 h-14">

        <div class="leading-tight text-white font-bold">
            <div class="text-2xl">Desa Lemahbang</div>
            <div class="text-sm font-normal opacity-90">Kabupaten Karanganyar</div>
        </div>
    </div>

    {{-- Menu Desktop --}}
    <ul class="hidden md:flex space-x-12 text-white font-semibold text-lg">
        <li><a href="{{ route('home') }}"
               class="hover:text-gray-200 {{ request()->routeIs('home') ? 'underline underline-offset-8' : '' }}">
               Beranda</a></li>

        <li><a href="{{ route('informasi.index') }}"
               class="hover:text-gray-200 {{ request()->routeIs('informasi.index') ? 'underline underline-offset-8' : '' }}">
               Informasi Desa</a></li>

        <li><a href="{{ route('agenda.index') }}"
               class="hover:text-gray-200 {{ request()->routeIs('agenda.index') ? 'underline underline-offset-8' : '' }}">
               Agenda Desa</a></li>

        <li><a href="{{ route('aduan.create') }}"
               class="hover:text-gray-200 {{ request()->routeIs('aduan.create') ? 'underline underline-offset-8' : '' }}">
               Aduan</a></li>

        <li><a href="{{ route('permohonan.index') }}"
               class="hover:text-gray-200 {{ request()->routeIs('permohonan.index') ? 'underline underline-offset-8' : '' }}">
               Layanan Surat</a></li>

        <li><a href="{{ route('permohonan.riwayat') }}"
               class="hover:text-gray-200 {{ request()->routeIs('permohonan.riwayat') ? 'underline underline-offset-8' : '' }}">
               Status Permohonan</a></li>
    </ul>

    {{-- Hamburger --}}
    <button id="hamburger" class="md:hidden text-white text-3xl focus:outline-none">
        ☰
    </button>
</nav>

{{-- Mobile Menu --}}
<div id="mobileMenu" class="hidden bg-black bg-opacity-80 text-white px-6 py-6 space-y-4 md:hidden">
    <a class="block text-lg" href="{{ route('home') }}">Beranda</a>
    <a class="block text-lg" href="{{ route('informasi.index') }}">Informasi Desa</a>
    <a class="block text-lg" href="{{ route('agenda.index') }}">Agenda Desa</a>
    <a class="block text-lg" href="{{ route('aduan.create') }}">Aduan</a>
    <a class="block text-lg" href="{{ route('permohonan.index') }}">Layanan Surat</a>
    <a class="block text-lg" href="{{ route('permohonan.riwayat') }}">Status Permohonan</a>
</div>

<script>
    document.getElementById('hamburger').onclick = () => {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    };
</script>
