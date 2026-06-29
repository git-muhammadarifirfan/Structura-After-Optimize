<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menunggu Pembayaran - Structura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind via CDN (atau ganti dengan hasil build CLI) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">

    <div class="bg-white shadow-lg rounded-xl p-8 sm:p-10 max-w-md w-full text-center">
        <!-- Judul -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Menunggu Pembayaran</h1>

        <!-- Invoice -->
        <div class="mb-5">
            <p class="text-gray-600">Invoice:</p>
            <p class="text-lg font-semibold text-gray-900">{{ $order->invoice_number }}</p>
        </div>

        <!-- Total Pembayaran -->
        <div class="mb-5">
            <p class="text-gray-600">Total Pembayaran:</p>
            <p class="text-xl font-bold text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
        </div>

        <!-- Batas Waktu -->
        <div class="mb-8">
            <p class="text-gray-600">Batas Waktu Pembayaran:</p>
            <p class="text-base font-medium text-red-600">{{ $order->payment_expired_at->format('d M Y H:i') }}</p>
        </div>

        <!-- Tombol Lanjutkan Pembayaran -->
        <button onclick="window.open('{{ $order->payment_url }}', '_blank')"
            class="w-full bg-blue-950 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 mb-4">
            Lanjutkan Pembayaran
        </button>

        <!-- Tombol Kembali ke Keranjang -->
        <button onclick="window.location.href='{{ route('cart') }}'"
            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-200">
            Kembali ke Keranjang
        </button>
    </div>

    <script>
        // Replace history supaya back browser tidak kembali ke /checkout
        window.history.replaceState({}, document.title, "{{ route('order.waiting', $order->uuid) }}");

        // Force reload jika user menggunakan back/forward
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.getEntriesByType('navigation')[0].type === 'back_forward')) {
                window.location.reload();
            }
        });
    </script>

</body>

</html>
