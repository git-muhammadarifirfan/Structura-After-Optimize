<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('images/icons/structura.png') }}" sizes="64x64" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Structura</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Changa:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F9FAFB] font-Montserrat">

    {{-- Loader --}}
    <div id="page-loader" class="fixed inset-0 flex items-center justify-center bg-white z-50">
        <div class="text-4xl font-bold flex space-x-1 text-darkblue">
            <span class="dot animate-pulse delay-[0ms]">.</span>
            <span class="dot animate-pulse delay-[200ms]">.</span>
            <span class="dot animate-pulse delay-[400ms]">.</span>
        </div>
    </div>
    <script>
        window.addEventListener('beforeunload', () => {
            document.getElementById('page-loader').classList.remove('hidden');
        });
        window.addEventListener('load', () => {
            document.getElementById('page-loader').classList.add('hidden');
        });
    </script>

    {{-- Navbar --}}
    <x-navbar></x-navbar>

    {{-- Main Content --}}
    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('product') }}" class="text-sm text-gray-500 hover:underline mb-6 inline-flex items-center">
            <img src="{{ asset('images/icons/back.png') }}" alt="Back" class="w-4 h-4 mr-2"> Continue shopping
        </a>

        <h2 class="text-2xl sm:text-3xl font-bold text-darkblue mb-6">Checkout</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded-md border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="bg-white shadow-md rounded-lg p-4 sm:p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border-separate border-spacing-y-3">
                        <thead>
                            <tr class="text-gray-500 uppercase text-xs tracking-wider border-b">
                                <th class="py-2">Produk</th>
                                <th class="py-2">Harga</th>
                                <th class="py-2">Jumlah</th>
                                <th class="py-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr class="bg-[#F8F9F9] rounded-lg text-darkblue">
                                    <td class="py-3 px-2 rounded-l-lg">
                                        <span class="font-semibold">
                                            {{ $item->product->product_name ?? 'Produk tidak ditemukan' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                    <td class="py-3 px-2">{{ $item->quantity }}</td>
                                    <td class="py-3 px-2 rounded-r-lg font-semibold text-red-600">
                                        Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-between items-center mt-6 border-t pt-4">
                    <p class="text-lg text-gray-700 font-medium">Total</p>
                    <p class="text-xl font-bold text-darkblue">Rp {{ number_format($total, 0, ',', '.') }}</p>
                </div>

                <h2 class="text-lg font-bold mb-4 text-gray-800">Metode Pembayaran</h2>
                <div class="relative">
                <select name="method" required
                    class="w-full border rounded-lg px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none appearance-none">
                    <option value="" disabled selected>Pilih metode pembayaran</option>
                    @foreach ($channels as $channel)
                        @if ($channel['active'])
                            <option value="{{ $channel['code'] }}">
                                {{ $channel['name'] }}
                            </option>
                        @endif
                    @endforeach
                </select>
            
                <!-- Dropdown icon -->
                <!--<svg class="w-5 h-5 absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"-->
                <!--    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">-->
                <!--    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />-->
                <!--</svg>-->
                </div>


                <div class="mt-6 text-center">
                    <button id="pay-button" type="submit"
                        class="w-full sm:w-auto bg-darkblue text-white px-8 py-3 rounded-md text-sm sm:text-base font-semibold hover:darkblue transition">
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>
</body>

</html>
