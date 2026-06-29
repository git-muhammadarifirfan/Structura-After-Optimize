<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Structura menyediakan material bangunan berkualitas dengan harga terjangkau untuk kebutuhan konstruksi dan renovasi.">
    <link rel="preload" as="image" href="{{ asset('images/landingpages/hero-mobile.webp') }}"
        imagesrcset="{{ asset('images/landingpages/hero-mobile.webp') }} 900w, {{ asset('images/landingpages/hero-desktop.webp') }} 1600w"
        imagesizes="100vw" fetchpriority="high">
    <link rel="icon" href="{{ asset('images/icons/structura.png') }}" sizes="64x64" type="image/png">
    <title>Structura</title>
    @vite('resources/css/app.css')

    <style>
        :root {
            --landing-font-sans: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            --landing-font-brand: var(--landing-font-sans);
        }

        .font-Montserrat {
            font-family: var(--landing-font-sans) !important;
        }

        .font-Changa {
            font-family: var(--landing-font-brand) !important;
            letter-spacing: 0.02em;
        }

        .hero-shell {
            min-height: 240px;
            aspect-ratio: 16 / 9;
        }

        .section-lazy {
            content-visibility: auto;
            contain-intrinsic-size: 1px 560px;
        }

        .section-lazy-sm {
            content-visibility: auto;
            contain-intrinsic-size: 1px 340px;
        }

        @media (min-width: 768px) {
            .hero-shell {
                min-height: 320px;
                aspect-ratio: 16 / 5;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                scroll-behavior: auto !important;
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body class="bg-white font-Montserrat">

    <script>
        (() => {
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('img:not([loading])').forEach((img) => img.setAttribute('loading', 'lazy'));
                document.querySelectorAll('img:not([decoding])').forEach((img) => img.setAttribute('decoding', 'async'));
            }, { once: true });

            const loadTidio = () => {
                if (window.__tidioLoaded) return;
                window.__tidioLoaded = true;

                const script = document.createElement('script');
                script.src = 'https://code.tidio.co/hqsiluutklrxvrzkhjvle2sh7trgrvs1.js';
                script.async = true;
                script.defer = true;
                document.body.appendChild(script);
            };

            ['scroll', 'pointerdown', 'keydown', 'touchstart'].forEach((eventName) => {
                window.addEventListener(eventName, loadTidio, {
                    once: true,
                    passive: true,
                });
            });

            window.addEventListener('load', () => {
                window.setTimeout(loadTidio, 12000);
            }, { once: true });
        })();
    </script>

    {{-- Navbar --}}
    <x-navbar></x-navbar>

    {{-- hero WebP diberi preload, ukuran tetap, fetchpriority tinggi, dan aspect-ratio. --}}
    {{-- Hero Section --}}
    <section
        class="hero-shell mt-8 bg-smoothcream max-w-[1280px] mx-auto w-full relative overflow-hidden lg:rounded-[10px] xl:rounded-[10px] 2xl:rounded-[10px]">
        <picture class="absolute inset-0 block">
            <source type="image/webp" media="(max-width: 767px)"
                srcset="{{ asset('images/landingpages/hero-mobile.webp') }} 1x, {{ asset('images/landingpages/hero-mobile.webp') }} 2x">
            <source type="image/webp" media="(min-width: 768px)"
                srcset="{{ asset('images/landingpages/hero-desktop.webp') }} 1x, {{ asset('images/landingpages/hero-desktop.webp') }} 2x">
            <img src="{{ asset('images/landingpages/hero-desktop.webp') }}"
                srcset="{{ asset('images/landingpages/hero-mobile.webp') }} 900w, {{ asset('images/landingpages/hero-desktop.webp') }} 1600w"
                sizes="(min-width: 1280px) 1280px, 100vw" alt="Material konstruksi Structura" width="1600"
                height="400" fetchpriority="high" loading="eager" decoding="async"
                class="absolute inset-0 h-full w-full object-cover" style="object-position: center center;">
        </picture>

        <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(255,255,255,.82) 0%, rgba(255,255,255,.62) 38%, rgba(255,255,255,.12) 100%);"></div>

        <div
            class="relative z-10 flex h-full flex-col items-center justify-center px-4 py-6 text-center text-darkblue md:items-start md:text-left">
            <div class="w-full md:w-3/4 lg:w-1/2 max-w-lg md:ml-8">
                <p class="text-base sm:text-xl md:text-xl lg:text-2xl font-bold leading-snug">
                    Paket renovasi terbaik! Lengkapi kebutuhan pembangunan Anda dengan harga ekonomis dan kualitas
                    terjamin!
                </p>

                @auth
                    <a href="{{ route('product') }}" class="inline-block">
                        <button
                            class="mt-4 px-6 md:px-10 py-2 bg-darkblue text-white font-semibold rounded-[10px] text-sm md:text-base transition-transform duration-300 ease-in-out transform hover:scale-105">
                            Beli Sekarang!
                        </button>
                    </a>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="inline-block">
                        <button
                            class="mt-4 px-6 md:px-10 py-2 bg-darkblue text-white font-semibold rounded-[10px] text-sm md:text-base transition-transform duration-300 ease-in-out transform hover:scale-105">
                            Beli Sekarang!
                        </button>
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <section class="section-lazy-sm">
        <x-category :categories="$categories"></x-category>
    </section>

    {{-- Descript Section --}}
    <section class="section-lazy-sm">
        <div
            class="mx-auto mt-0 sm:mt-2 lg:mt-6 max-w-[1280px] w-full overflow-hidden rounded-[10px] px-6 py-6 text-center sm:py-8 lg:py-10 relative">
            <img src="{{ asset('images/landingpages/footer-bg.webp') }}" alt="Latar belakang Structura" width="1600"
                height="476" loading="lazy" decoding="async" fetchpriority="low" class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0" style="background: rgba(255, 255, 255, 0.74);"></div>

            <div class="relative z-10">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#1E375A]">Hai, kami STRUCTURA.</h1>

                <p class="text-sm sm:text-base text-gray-600 mt-4 max-w-2xl mx-auto leading-relaxed">
                    STRUCTURA adalah platform e-commerce bahan bangunan yang menyediakan material konstruksi
                    berkualitas tinggi dengan harga terjangkau. Berfokus pada kebutuhan para profesional di industri
                    pembangunan, STRUCTURA menghadirkan solusi lengkap mulai dari material dasar hingga alat berat.
                    Kami berkomitmen mendukung pembangunan yang efisien dan inovatif, sekaligus memberdayakan pasar
                    lokal dengan produk terbaik yang memenuhi standar global.
                </p>
            </div>
        </div>
    </section>

    <section class="section-lazy">
        <div class="mx-auto text-center">
            <h1 class="mt-8 mb-8 font-extrabold text-darkblue text-xl">TERBARU DI STRUCTURA</h1>
        </div>

        <div class="mx-auto mb-8 h-auto w-full max-w-[1280px] flex items-center justify-center px-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 w-full">
                @foreach ($latestProducts as $product)
                    <div
                        class="bg-white p-2 sm:p-3 md:p-4 text-left w-full max-w-[180px] sm:max-w-[200px] md:max-w-[220px] text-darkblue mx-auto">
                        <a href="{{ route('product.detail', $product->sku) }}" class="group block">
                            <div class="w-full h-[160px] sm:h-[180px] md:h-[200px] overflow-hidden mx-auto rounded-sm">
                                <img src="{{ thumb_url($product->image, 320) }}" loading="lazy" decoding="async" fetchpriority="low"
                                    sizes="(min-width: 768px) 220px, 44vw" width="320" height="320"
                                    alt="{{ $product->product_name }}"
                                    class="w-full h-full object-cover transition-transform duration-300 ease-in-out transform group-hover:scale-105">
                            </div>
                            <h2 class="mt-2 text-[12px] sm:text-[14px] md:text-[16px] font-semibold ml-1 sm:ml-2">
                                {{ $product->product_name }}</h2>
                            <p class="ml-1 sm:ml-2 font-light text-[10px] sm:text-[12px]">Merk: {{ $product->brand }}
                            </p>
                            <p class="font-extrabold ml-1 sm:ml-2 text-[12px] sm:text-[14px] md:text-[16px]">Rp
                                {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-lazy">
        <div
            class="mt-8 mb-16 mx-auto bg-darkblue h-auto w-full max-w-[1280px] relative lg:rounded-[10px] xl:rounded-[10px] 2xl:rounded-[10px] flex flex-col lg:flex-row overflow-hidden">
            <div
                class="hidden lg:flex w-1/2 items-center justify-center rounded-t-[10px] lg:rounded-t-none lg:rounded-l-[10px] overflow-hidden" style="background: rgba(107, 114, 128, 0.10);">
                <img src="{{ asset('images/landingpages/exploremore.webp') }}" alt="Material konstruksi Structura"
                    width="1200" height="437" loading="lazy" decoding="async" fetchpriority="low" sizes="640px"
                    class="w-full h-full object-cover">
            </div>

            <div
                class="w-full lg:w-1/2 px-4 py-6 text-white flex flex-col justify-center items-start sm:items-center sm:text-center">
                <h2 class="text-base sm:text-lg md:text-xl font-bold mb-2">Jelajahi Lebih Banyak</h2>
                <p class="text-sm sm:text-base md:text-lg max-w-md leading-relaxed">
                    Temukan berbagai kategori material bangunan dengan mudah dan cepat.
                </p>

                @auth
                    <a href="{{ route('product') }}" class="w-full sm:w-auto">
                        <button
                            class="mt-4 px-5 py-2 bg-white text-darkblue font-semibold rounded-[10px] text-sm sm:text-base w-full sm:w-auto">
                            Belanja Sekarang!
                        </button>
                    </a>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="w-full sm:w-auto">
                        <button
                            class="mt-4 px-5 py-2 bg-white text-darkblue font-semibold rounded-[10px] text-sm sm:text-base w-full sm:w-auto">
                            Belanja Sekarang!
                        </button>
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <section class="section-lazy-sm">
        <x-footer></x-footer>
    </section>

</body>

</html>
