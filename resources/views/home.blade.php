@extends('layouts.app', ['title' => 'Website Resmi Pemerintah Desa Lemahbang'])

@section('content')

{{-- HERO SECTION --}}
<section class="relative h-screen w-full">

    {{-- Background --}}
    <div class="absolute inset-0">
        <img src="{{ asset('storage/images/Bg-desa.jpeg') }}" class="w-full h-full object-cover brightness-75">
         {{-- Overlay gelap --}}
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    {{-- Text --}}
    <div class="relative z-10 flex flex-col justify-center items-center h-full text-center text-white px-4">
        <h2 class="text-5xl font-extrabold drop-shadow-lg">
            Selamat Datang
        </h2>
        <h3 class="text-4xl font-bold mt-2 drop-shadow-lg">
            Website Resmi Desa Lemahbang
        </h3>
        <p class="text-lg mt-4 drop-shadow-lg">
            Sumber informasi terbaru tentang pemerintahan di Desa Lemahbang
        </p>
    </div>

    <!-- {{-- Slider Buttons --}} -->
    <!-- <button class="absolute left-5 top-1/2 text-white text-4xl">←</button> -->
    <!-- <button class="absolute right-5 top-1/2 text-white text-4xl">→</button> -->

</section>


{{-- PROFIL DESA & LOKASI --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch">

            {{-- KIRI : DESKRIPSI DESA --}}
            <div class="bg-gray-600 text-white rounded-2xl p-10 flex flex-col justify-between">
                <div>
                    <h2 class="text-4xl font-bold mb-6">
                        Kantor Desa Lemahbang
                    </h2>

                    <p class="leading-relaxed mb-5">
                        Selamat datang di Desa Lemahbang, Kecamatan Jumapolo, Kabupaten Karanganyar.
                        Desa kami terletak di barat daya Kecamatan Jumapolo yang berbatasan langsung dengan
                        Kecamatan Jatipuro disisi selatan dan Kabupaten Sukoharjo disisi barat.
                        Desa kami juga memiliki kekayaan budaya yang luar biasa.
                    </p>

                    <p class="leading-relaxed mb-5">
                        Dengan luas wilayah ± 409,53 hektar, Desa Lemahbang terdiri
                        dari 8 dusun dan dihuni oleh sekitar 3.242 jiwa yang ramah
                        dan bersahabat.
                    </p>

                    <p class="leading-relaxed mb-5">
                        Mayoritas penduduk Desa Lemahbang bermata pencaharian
                        sebagai buruh, baik buruh tani maupun buruh pabrik.
                    </p>

                    <p class="leading-relaxed">
                        Pemerintah Desa Lemahbang terus berupaya meningkatkan
                        kualitas hidup masyarakat dan membangun desa yang lebih baik.
                    </p>
                </div>
            </div>

            {{-- KANAN : GAMBAR MAP + TOMBOL --}}
            <div class="flex flex-col gap-6">
                {{-- Google Maps embedded atau gambar --}}
                <div class="w-full rounded-xl overflow-hidden shadow-lg">
                    {{-- Embedded Google Maps --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1397.827646942555!2d110.97146998143006!3d-7.720261731888396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a244bd2844689%3A0x5fe411483f50bd63!2sKantor%20Desa%20Lemahbang!5e0!3m2!1sid!2sid!4v1766345478087!5m2!1sid!2sid"
                        width="600"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                {{-- Tombol lokasi --}}
                <div class="text-center">
                    <a
                        href="https://maps.app.goo.gl/jHcEtAWwnBRCtTCy6"
                        target="_blank"
                        class="inline-flex items-center gap-2
                               bg-gray-500 text-white
                               px-8 py-4 rounded-full
                               font-bold tracking-wide
                               hover:bg-gray-400 transition">
                        📍 Lokasi Kantor Desa →
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>



<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        {{-- KOLOM KIRI: FOTO + IDENTITAS --}}
        <div class="flex flex-col items-center text-center">

            {{-- Foto Kepala Desa --}}
            <div class="w-72 h-72 rounded-full overflow-hidden shadow-lg mb-4">
                <img
                    src="{{ $kepalaDesa ? asset('storage/' . $kepalaDesa->foto) : asset('images/default-avatar.png') }}"
                    alt="{{ $kepalaDesa->nama ?? 'Kepala Desa' }}"
                    class="w-full h-full object-cover">
            </div>

            {{-- Nama --}}
            <p class="text-2xl font-bold text-gray-900">
                {{ $kepalaDesa->nama ?? '-' }}
            </p>

            {{-- Jabatan --}}
            <p class="text-xl text-gray-500">
                {{ $kepalaDesa->jabatan ?? 'Kepala Desa' }} Lemahbang
            </p>

        </div>

        {{-- KOLOM KANAN: TEKS SAMBUTAN --}}
        <div>
            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                Sambutan {{ $kepalaDesa->jabatan ?? 'Kepala Desa' }} Lemahbang
            </h2>

            <p class="text-gray-700 leading-relaxed text-justify">
                Assalamu’alaikum Warahmatullahi Wabarakatuh.
                <br><br>
                Puji syukur kita panjatkan ke hadirat Tuhan Yang Maha Esa,
                karena dengan rahmat-Nya website Desa Lemahbang ini dapat
                hadir sebagai media informasi dan pelayanan bagi masyarakat.
                <br><br>
                Kami berharap website ini dapat menjadi sarana transparansi,
                komunikasi, serta pelayanan publik yang lebih baik bagi seluruh
                warga Desa Lemahbang.
            </p>
        </div>

    </div>
</section>


{{-- PREVIEW PERANGKAT DESA --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6">

                {{-- Judul --}}
                <div class="mb-12">
                    <h2 class="text-4xl font-bold text-gray-900">
                        Struktur Organisasi dan Tata Kerja
                    </h2>
                    <p class="text-2xl-gray-600 mt-2">
                        Pemerintah Desa Lemahbang
                    </p>
                </div>

                {{-- Grid Perangkat --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10" >
            @foreach ($perangkatPreview as $perangkat)
                <div
                    class="group bg-white rounded-2xl overflow-hidden
                           shadow-md transition-all duration-500
                           hover:-translate-y-3 hover:shadow-2xl" >

                    {{-- Foto --}}
                    <div class="relative h-72 overflow-hidden">
                        <img
                            src="{{ asset('storage/' . $perangkat->foto) }}"
                            alt="{{ $perangkat->nama }}"
                            class="w-full h-full object-cover
                                   transition-transform duration-700
                                   group-hover:scale-110">

                        {{-- Overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t
                                   from-black/40 to-transparent
                                   opacity-0 group-hover:opacity-100
                                   transition duration-500">
                        </div>
                    </div>

                    {{-- Nama & Jabatan --}}
                    <div
                        class="bg-gray-900 text-white py-5 px-3 text-center
                               transition duration-500
                               group-hover:bg-gray-700">

                        <h3 class="font-bold text-lg  tracking-wide">
                            {{ $perangkat->nama }}
                        </h3>

                        <p class="text-sm opacity-90 mt-1">
                            {{ $perangkat->jabatan }}
                        </p>
                    </div>

                </div>
            @endforeach
        </div>


        {{-- Tombol Selengkapnya --}}
        <div class="text-center mt-14">
            <a href="{{ route('perangkat.index') }}"
               class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full
                      font-semibold hover:bg-gray-500 transition">
                Lihat Selengkapnya →
            </a>
        </div>

    </div>
</section>





<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Judul -->
        <div class="mb-14">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Administrasi Penduduk
            </h2>
            <p class="text-lg text-gray-700 max-w-4xl">
                Sistem digital yang berfungsi mempermudah pengelolaan data dan informasi
                terkait kependudukan dan pendayagunaannya untuk pelayanan publik
                yang efektif dan efisien
            </p>
        </div>

        <!-- Grid Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Penduduk -->
            <div class="flex rounded-xl shadow overflow-hidden">
                <div id="totalPenduduk"
                     class="w-36 bg-gradient-to-r from-gray-900 to-gray-500
                            text-white text-5xl font-bold
                            flex items-center justify-center">
                    0
                </div>
                <div class="flex items-center px-8 text-2xl font-semibold text-gray-700">
                    Jumlah Penduduk
                </div>
            </div>

            <!-- Laki-laki -->
            <div class="flex rounded-xl shadow overflow-hidden">
                <div id="lakiLaki"
                     class="w-36 bg-gradient-to-r from-gray-900 to-gray-700
                            text-white text-5xl font-bold
                            flex items-center justify-center">
                    0
                </div>
                <div class="flex items-center px-8 text-2xl font-semibold text-gray-700">
                    Laki-Laki
                </div>
            </div>

              <!-- Perempuan -->
            <div class="flex rounded-xl shadow overflow-hidden">
                <div id="perempuan"
                     class="w-36 bg-gradient-to-r from-gray-900 to-gray-700
                            text-white text-5xl font-bold
                            flex items-center justify-center">
                    0
                </div>
                <div class="flex items-center px-8 text-2xl font-semibold text-gray-700">
                    Perempuan
                </div>
            </div>

            <!-- Kepala Keluarga (placeholder) -->
            <!-- <div class="flex rounded-xl shadow overflow-hidden"> -->
                <!-- <div -->
                     <!-- class="w-36 bg-gradient-to-r from-green-700 to-green-500 -->
                            <!-- text-white text-5xl font-bold -->
                            <!-- flex items-center justify-center"> -->
                    <!-- 0 -->
                <!-- </div> -->
                <!-- <div class="flex items-center px-8 text-2xl font-semibold text-gray-700"> -->
                    <!-- Kepala Keluarga -->
                <!-- </div> -->
            <!-- </div> -->


            <!-- Penduduk Sementara -->
            <!-- <div class="flex rounded-xl shadow overflow-hidden"> -->
                <!-- <div -->
                     <!-- class="w-36 bg-gradient-to-r from-green-700 to-green-500 -->
                            <!-- text-white text-5xl font-bold -->
                            <!-- flex items-center justify-center"> -->
                    <!-- 0 -->
                <!-- </div> -->
                <!-- <div class="flex items-center px-8 text-2xl font-semibold text-gray-700"> -->
                    <!-- Penduduk Sementara -->
                <!-- </div> -->
            <!-- </div> -->

            <!-- Mutasi Penduduk -->
            <!-- <div class="flex rounded-xl shadow overflow-hidden"> -->
                <!-- <div -->
                     <!-- class="w-36 bg-gradient-to-r from-green-700 to-green-500 -->
                            <!-- text-white text-5xl font-bold -->
                            <!-- flex items-center justify-center"> -->
                    <!-- 0 -->
                <!-- </div> -->
                <!-- <div class="flex items-center px-8 text-2xl font-semibold text-gray-700"> -->
                    <!-- Mutasi Penduduk -->
                <!-- </div> -->
            <!-- </div> -->

        </div>

    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', async () => {

    const res = await fetch('/api/penduduk');
    const json = await res.json();

    const lk = parseInt(json.data.lk) || 0;
    const pr = parseInt(json.data.pr) || 0;
    const total = lk + pr;

    const format = n => new Intl.NumberFormat('id-ID').format(n);

    document.getElementById('lakiLaki').innerText = format(lk);
    document.getElementById('perempuan').innerText = format(pr);
    document.getElementById('totalPenduduk').innerText = format(total);

});
</script>

<!-- Section Peta Desa Lemahbang -->
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- PETA DESA --}}
<section class="bg-white py-20 relative z-10">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Judul --}}
        <div class="mb-6">
            <h2 class="text-4xl font-bold text-gray-900">
                PETA DESA
            </h2>
            <p class="text-lg text-gray-700 mt-2">
                Menampilkan Peta Desa dengan <i>Interest Point</i> Desa Lemahbang
            </p>
        </div>

        {{-- Wrapper Peta --}}
        <div class="relative rounded-2xl overflow-hidden shadow-lg">

            {{-- Search & Filter --}}
            <div class="absolute top-4 left-4 z-[1000] flex gap-4">
                <input
                    type="text"
                    placeholder="Telusuri Peta"
                    class="px-4 py-2 rounded-lg shadow bg-white text-sm w-56">

                <select class="px-4 py-2 rounded-lg shadow bg-white text-sm">
                    <option>Lihat Semua</option>
                    <option>Fasilitas Umum</option>
                    <option>Kantor Desa</option>
                    <option>Tempat Ibadah</option>
                </select>
            </div>

            {{-- Map --}}
            <div id="map-desa" class="w-full h-[500px] relative"></div>

        </div>

    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const map = L.map('map-desa', {
        scrollWheelZoom: false
    }).setView([-7.7035, 111.0855], 14);

    L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        maxZoom: 20,
    }).addTo(map);

    const batasDesa = [
        [-7.724005258876961, 110.98419741414155],
        [-7.720573125320665, 110.97963970636228],
        [-7.716489368173479, 110.97659035121555],
        [-7.713644622410262, 110.97320926705126],
        [-7.715718127875606, 110.97049164089863],
        [-7.715275612324073, 110.9691264484413],
        [-7.717033028496462, 110.9679143616801],
        [-7.7154273320141336, 110.9674167681064],
        [-7.717172104304781, 110.96675331008976],
        [-7.715250325727373, 110.96473741842378],
        [-7.716160642984316, 110.96305325576613],
        [-7.713461332481713, 110.95369220689682],
        [-7.7091448166172905, 110.94773770286619],
        [-7.720013849808694, 110.94401458621157],
        [-7.724013232356599, 110.98408612384681],
    ];

    const polygon = L.polygon(batasDesa, {
        color: '#ffffff',
        weight: 2,
        fillColor: '#16a34a',
        fillOpacity: 0.45
    }).addTo(map);

    map.fitBounds(polygon.getBounds());

    L.marker([-7.71994206666747, 110.97163924007903])
        .addTo(map)
        .bindPopup('<b>Kantor Desa Lemahbang</b>');

    // 🔑 KUNCI SOLUSI
    map.on('mouseover', () => map.scrollWheelZoom.enable());
    map.on('mouseout', () => map.scrollWheelZoom.disable());

});
</script>


{{-- Berita DESA --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">
            Berita Terbaru Desa
        </h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($beritas as $item)
            <div class="border rounded-xl overflow-hidden shadow shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <img src="{{ asset('storage/'.$item->foto) }}" class="h-48 w-full object-cover">

                <div class="p-4">
                    <h3 class="font-bold text-lg">
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

        <div class="text-center mt-10">
            <a href="{{ route('berita.index') }}"
               class="px-6 py-3 bg-gray-700 text-white rounded-lg">
                Lihat Berita Selengkapnya
            </a>
        </div>
    </div>
</section>



{{-- GALERI DESA --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Judul --}}
        <div class="mb-10 text-center">
            <h2 class="text-4xl font-bold text-gray-900">
                Galeri Desa Lemahbang
            </h2>
            <p class="text-gray-600 mt-2">
                Dokumentasi kegiatan dan potensi Desa Lemahbang
            </p>
        </div>

        {{-- Slider --}}
        <div class="relative overflow-hidden rounded-2xl shadow-lg">

            <div id="galeriSlider"
                 class="flex transition-transform duration-500 ease-in-out">

                @foreach ($galeri as $item)
                    <div class="min-w-full h-[420px] relative">
                        <img
                            src="{{ asset('storage/' . $item->gambar) }}"
                            alt="{{ $item->judul }}"
                            class="w-full h-full object-cover">

                        {{-- Overlay teks --}}
                        <div class="absolute inset-0 bg-black/40 flex items-end">
                            <div class="p-6 text-white">
                                <h3 class="text-xl font-semibold">
                                    {{ $item->judul }}
                                </h3>
                                @if($item->deskripsi)
                                    <p class="text-sm mt-1 max-w-xl">
                                        {{ $item->deskripsi }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Button --}}
            <button onclick="prevSlide()"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-black-800 p-2 rounded-full shadow">
                ‹
            </button>

            <button onclick="nextSlide()"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-black-800 p-2 rounded-full shadow">
                ›
            </button>

        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let index = 0;

    const slider = document.getElementById('galeriSlider');
    const galeri = @json($galeri);   // ← ini aman
    const total = galeri.length;

    if (!slider || total === 0) return;

    function updateSlider() {
        slider.style.transform = `translateX(-${index * 100}%)`;
    }

    window.nextSlide = function () {
        index = (index + 1) % total;
        updateSlider();
    }

    window.prevSlide = function () {
        index = (index - 1 + total) % total;
        updateSlider();
    }

    // Auto slide
    setInterval(() => {
        nextSlide();
    }, 6000);

});
</script>




















































































@endsection
