<div
    class="bg-darkblue text-white text-[10px] sm:text-xs md:text-sm py-2 px-3 sm:px-4 md:px-8 flex justify-between items-center w-full font-Montserrat">
    <div class="flex items-center">
        <svg class="mr-1 w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.62a2 2 0 0 1-.45 2.11L8.01 9.73a16 16 0 0 0 6.26 6.26l1.28-1.27a2 2 0 0 1 2.11-.45c.84.29 1.72.5 2.62.62A2 2 0 0 1 22 16.92Z" />
        </svg>
        <p class="text-[10px] sm:text-xs md:text-sm">+62 813-5929-8128</p>
    </div>
    <span class="text-[10px] sm:text-xs text-center md:text-left">
        Shop Something Special Today!
    </span>
    <div class="hidden md:flex gap-3">
        <a href="#" class="hover:opacity-75">
            <img src="{{ asset('images/icons/Instagram.png') }}" alt="Instagram Icon" class="w-5 h-5" width="20"
                height="20" decoding="async">
        </a>
        <a href="#" class="hover:opacity-75">
            <img src="{{ asset('images/icons/Youtube.png') }}" alt="Youtube Icon" class="w-5 h-5" width="20"
                height="20" decoding="async">
        </a>
        <a href="#" class="hover:opacity-75">
            <img src="{{ asset('images/icons/fb.png') }}" alt="Facebook Icon" class="w-5 h-5" width="20"
                height="20" decoding="async">
        </a>
    </div>
</div>

<div class="sticky top-0 z-50 font-Montserrat bg-white ">
    <nav class="px-4 py-3 md:px-6 md:py-4 max-w-7xl mx-auto flex items-center justify-between">
        <a href="{{ route('landingpage') }}"
            class="text-[24px] md:text-[32px] font-extrabold font-Changa text-darkblue">
            STRUCTURA.
        </a>

        <div class="hidden md:flex space-x-8 text-darkblue font-medium">
            <a href="{{ route('landingpage') }}" class="hover:text-gray-600">Beranda</a>
            <a href="{{ route('product') }}" class="hover:text-gray-600">Produk</a>
            <a href="{{ route('store-location') }}" class="hover:text-gray-600">Lokasi Toko</a>
        </div>

        <div class="flex items-center gap-4">
            <form action="{{ route('search') }}" method="GET" class="hidden md:block relative">
                <svg class="absolute left-2 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path stroke-linecap="round" d="m20 20-3.5-3.5"></path>
                </svg>
                <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}"
                    class="w-35 h-8 py-2 pl-10 pr-4 rounded-md border-none focus:outline-none focus:ring-1 focus:ring-darkblue" />
            </form>

            <a href="{{ Auth::check() ? route('cart') : route('login') }}">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h15l-1.5 8.5a2 2 0 0 1-2 1.65H9a2 2 0 0 1-1.97-1.67L5.7 4.75A1 1 0 0 0 4.72 4H3"/>
                    <circle cx="10" cy="20" r="1.4" fill="currentColor" stroke="none"/>
                    <circle cx="18" cy="20" r="1.4" fill="currentColor" stroke="none"/>
                </svg>
            </a>

            <a href="{{ Auth::check() ? route('profile') : route('login') }}" class="hidden md:block">
                <img src="{{ asset('images/icons/User-Profile.png') }}" alt="User Icon" class="w-6 h-6"
                    width="24" height="24" decoding="async" />
            </a>
        </div>
    </nav>
</div>

<div
    class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-300 md:hidden flex justify-around items-center py-2 text-xs sm:text-sm font-medium text-darkblue">

    <a href="{{ route('landingpage') }}" class="flex flex-col items-center hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mb-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M3 12l9-9 9 9M4 10v10h6v-6h4v6h6V10" />
        </svg>
        Beranda
    </a>

    <a href="{{ route('product') }}" class="flex flex-col items-center hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mb-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M5 8h14l1 9H4l1-9zm2 0V6a2 2 0 012-2h4a2 2 0 012 2v2" />
        </svg>
        Produk
    </a>

    <a href="{{ route('store-location') }}" class="flex flex-col items-center hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mb-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M12 11c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm0 10s6-5.686 6-10a6 6 0 10-12 0c0 4.314 6 10 6 10z" />
        </svg>
        Lokasi
    </a>

    <a href="{{ Auth::check() ? route('profile') : route('login') }}"
        class="flex flex-col items-center hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mb-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M5.121 17.804A9.953 9.953 0 0112 15c2.33 0 4.472.797 6.121 2.137M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Profil
    </a>
</div>
