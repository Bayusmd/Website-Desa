
<footer class="bg-gray-900 text-white pt-12 pb-6">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-5 gap-5">

        {{-- Identitas Desa --}}
        <div class="flex gap-2">
            <img src="{{ asset('storage/images/logo-desa.png') }}"
                 alt="Logo Desa"
                 class="w-40 h-40 object-contain">


        </div>
        <div>
            <div>
                <h3 class="text-lg font-bold mb-2">
                    Pemerintah<br>
                    Desa Lemahbang
                </h3>

                <p class="text-sm leading-relaxed text-gray-200">
                    JL. Jagan-Lemahbang, Desa Lemahbang, Kecamatan Jumapolo,<br>
                    Kabupaten Karanganyar,<br>
                    Provinsi Jawa Tengah, 57783
                </p>
            </div>
        </div>

        <div>
            <div>
                <h3 class="text-lg font-bold mb-2">
                    Jam Kerja
                </h3>
                <p class="text-sm leading-relaxed text-gray-200">
                    Senin-Kamis<br>
                    07.30-15.00 WIB<br>
                    <br>
                    Jum'at<br>
                    07.30-11.30 WIB
                </p>
            </div>
        </div>


        {{-- Nomor Telepon Penting --}}
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <div>
            <h3 class="text-lg font-bold mb-3">
                Hubungi Kami
            </h3>

            <ul class="space-y-2 text-sm text-gray-200">
                <li>
                    <a href="mailto:lemahbangdesa@gmail.com" target="_blank" class="hover:underline text-gray-200">
                        <i class="fa-solid fa-envelope text-white-600"></i>
                        <span class="text-white-700">lemahbangdesa@gmail.com</span>
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/628xxxxxxxxxx" class="hover:underline text-gray-200">
                        <i class="fa-solid fa-phone text-white-600"></i>
                        <span class="text-white-700">08xx-xxxx-xxxx</span>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Jelajahi --}}
        <div>
            <h3 class="text-lg font-bold mb-3">
                Jelajahi
            </h3>

            <ul class="space-y-2 text-sm">
                <li>
                    <a href="https://kemendesa.go.id"
                       target="_blank"
                       class="hover:underline text-gray-200">
                        Website Kemendesa
                    </a>
                </li>

                <li>
                    <a href="https://kemendagri.go.id"
                       target="_blank"
                       class="hover:underline text-gray-200">
                        Website Kemendagri
                    </a>
                </li>

                <li>
                    <a href="https://cekdptonline.kpu.go.id"
                       target="_blank"
                       class="hover:underline text-gray-200">
                        Cek DPT Online
                    </a>
                </li>
            </ul>
        </div>

    </div>





    {{-- Copyright --}}
    <div class="text-center text-sm text-gray-300 mt-6">
       © {{ date('Y') }} Pemerintah Desa Lemahbang - Kabupaten Karanganyar
    </div>
</footer>
