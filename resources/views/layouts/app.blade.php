<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Website Desa Lemahbang' }}</title>

    {{-- FAVICON DESA --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo-desa.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/logo-desa.png') }}">

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .header-scrolled {
            background-color: rgba(17, 24, 39, 0.95); /* gray-900 */
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 6px rgba(0,0,0,0.4);
        }
    </style>
</head>

<body class="bg-gray-100">

    {{-- HEADER --}}
    <header id="mainHeader"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300
        {{ request()->routeIs('home') ? 'bg-transparent' : 'bg-gray-900 shadow-md' }}">

        @include('layouts.navigation')
    </header>

    {{-- SPACER AVOID CONTENT OVERLAP --}}
    @if(!request()->routeIs('home'))
    <div class="h-28"></div>
    @endif

    {{-- MAIN CONTENT --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

    {{-- SCROLL SCRIPT ONLY FOR HOMEPAGE --}}
    @if (request()->routeIs('home'))
    <script>
        const header = document.getElementById("mainHeader");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                header.classList.add("header-scrolled");
                header.classList.remove("bg-transparent");
            } else {
                header.classList.remove("header-scrolled");
                header.classList.add("bg-transparent");
            }
        });
    </script>
    @endif

     {{-- SweetAlert --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
