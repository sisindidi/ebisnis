<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran QRIS - {{ $outlet->name ?? 'Kantin Kampus' }}</title>

    <!-- Google Fonts & Tailwind CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased flex flex-col bg-slate-50/70">

    @php
        $outletId = $outlet->id ?? 1;
        $outletName = $outlet->name ?? 'Esa Corner';
        $stanCode = match($outletId) {
            2 => 'Stan 02',
            3 => 'Stan 03',
            4 => 'Stan 04',
            default => 'Stan 01',
        };
    @endphp

    <!-- ========================================================
         1. NAVBAR / HEADER
    ======================================================== -->
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-30 border-b border-slate-200/80 shadow-xs">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="/menu/{{ $outletId }}" class="w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-lg font-black transition-all cursor-pointer shadow-xs" title="Kembali ke Menu">
                    &larr;
                </a>
                <a href="/" class="flex items-center gap-2 group">
                    <div class="flex flex-col">
                        <div class="flex items-center text-xl sm:text-2xl font-black tracking-tight leading-none text-[#0066B3] group-hover:opacity-90 transition-opacity" style="text-shadow: 0 2px 8px rgba(0, 102, 179, 0.2);">
                            <span>Esa</span>
                            <span class="ml-1.5 flex items-center">
                                <span>C</span>
                                <img src="{{ asset('images/esa-logo.png') }}" alt="o" class="w-5 h-5 sm:w-6 sm:h-6 object-contain inline-block mx-0.5 -mt-0.5 drop-shadow-xs">
                                <span>rner</span>
                            </span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 tracking-wider uppercase block mt-1">
                            Kantin Kampus
                        </span>
                    </div>
                </a>
            </div>

            <!-- Right: Sesi & Back Link -->
            <div class="flex items-center gap-3">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-orange-50 text-[#f15a29] font-bold text-xs border border-orange-200/80">
                    <span class="w-2 h-2 rounded-full bg-[#f15a29] animate-pulse"></span>
                    <span>QRIS Bank Indonesia Aktif</span>
                </div>
                <a href="/menu/{{ $outletId }}" class="text-xs font-extrabold text-slate-600 hover:text-slate-900 underline underline-offset-4">
                    Ubah Pesanan
                </a>
            </div>
        </div>
    </header>


    <!-- ========================================================
         2. MAIN PAYMENT PAGE CONTENT
    ======================================================== -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        <!-- Top Notice Banner (Biru #EAF4FF Selaras Info Kantin) -->
        <div style="background-color: #EAF4FF;" class="rounded-3xl p-4 sm:p-5 border border-blue-200/80 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-start sm:items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-white text-[#f15a29] border border-blue-200/60 flex items-center justify-center text-xl font-black shrink-0 shadow-2xs">
                    📱
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-base sm:text-lg font-black text-slate-900">
                            Pembayaran QRIS - {{ $outletName }}
                        </h1>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white text-blue-700 text-[11px] font-black tracking-wide border border-blue-200/80 shadow-2xs">
                            {{ $stanCode }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-600 mt-1 font-medium">
                        Arahkan kamera HP Anda ke QRIS di bawah untuk langsung membuka halaman pembayaran dan menyelesaikan pesanan.
                    </p>
                </div>
            </div>

            <!-- Countdown Timer Sisa Waktu -->
            <div class="flex items-center gap-2 bg-white/90 border border-blue-200/80 px-4 py-2.5 rounded-2xl text-xs font-black text-slate-800 shadow-2xs shrink-0 self-stretch sm:self-auto justify-center">
                <span class="text-slate-500 font-semibold">Sisa Waktu:</span>
                <span class="text-[#f15a29] font-black tracking-wider text-sm" id="paymentTimer">⏱️ 02:00</span>
            </div>
        </div>

        <!-- Empty State Container (Jika keranjang kosong) -->
        <div id="emptyOrderState" class="hidden bg-white rounded-3xl p-12 text-center border border-slate-200 shadow-xs space-y-4">
            <div class="w-16 h-16 rounded-2xl bg-orange-50 text-[#f15a29] flex items-center justify-center text-3xl mx-auto">
                🛒
            </div>
            <h2 class="text-xl font-black text-slate-800">Belum Ada Pesanan yang Dipilih</h2>
            <p class="text-xs text-slate-500 max-w-md mx-auto">
                Anda belum memilih menu di stan {{ $outletName }}. Silakan kembali ke katalog stan untuk memilih makanan dan minuman lezat!
            </p>
            <div class="pt-2">
                <a href="/menu/{{ $outletId }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-orange-500 via-[#f15a29] to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-extrabold text-xs shadow-md transition-all">
                    <span>&larr; Lihat Menu Stan {{ $outletName }}</span>
                </a>
            </div>
        </div>

        <!-- 2 Column Checkout Grid -->
        <div id="paymentContentGrid" class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- LEFT COLUMN: QRIS CODE DISPLAY (PROMINENT CENTERPIECE) (lg:col-span-7) -->
            <div class="lg:col-span-7 space-y-5">
                
                <div class="bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-8 shadow-xs space-y-5 text-center">
                    
                    <!-- QRIS & GPN Official Header -->
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-2.5">
                            <span class="bg-[#0f172a] text-white text-xs font-black px-2.5 py-1 rounded-md tracking-wider">
                                QRIS
                            </span>
                            <div class="leading-none text-left">
                                <span class="text-[10px] font-black text-slate-800 uppercase tracking-wider block">QR CODE STANDAR</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">PEMBAYARAN NASIONAL</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="inline-flex items-center gap-1 bg-red-50 text-red-700 text-[10px] font-black px-2 py-0.5 rounded border border-red-200">
                                <span>GPN INDONESIA</span>
                            </div>
                            <span class="text-[9px] font-semibold text-slate-400 block mt-0.5 font-mono">NMID: ID10243292017291</span>
                        </div>
                    </div>

                    <!-- Outlet & Stan Info -->
                    <div class="text-center space-y-0.5">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Scan untuk Bayar ke Stan</span>
                        <h2 class="text-lg sm:text-xl font-black text-slate-900 tracking-tight">
                            {{ $outletName }} <span class="text-[#f15a29]">({{ $stanCode }})</span>
                        </h2>
                        <span class="text-xs text-slate-500 font-medium block">
                            Kantin Kampus Terpadu Esa Unggul
                        </span>
                    </div>

                    <!-- GAMBAR QRIS DINAMIS (BISA LANGSUNG DI-SCAN KAMERA HP & LANGSUNG BUKA MIDTRANS) -->
                    <div class="py-2 flex flex-col items-center">
                        <div class="p-3 sm:p-4 bg-white rounded-3xl border-2 border-orange-500/25 shadow-lg shadow-orange-500/10 max-w-[320px] sm:max-w-[340px] w-full min-h-[300px] flex items-center justify-center relative">
                            <!-- Loading Spinner while generating QR -->
                            <div id="qrLoadingSpinner" class="flex flex-col items-center gap-2 py-10">
                                <div class="w-10 h-10 border-4 border-orange-200 border-t-[#f15a29] rounded-full animate-spin"></div>
                                <span class="text-xs font-bold text-slate-500">Membuat QRIS Pembayaran...</span>
                            </div>

                            <img 
                                id="qrisDisplayImg"
                                src="" 
                                alt="QRIS {{ $outletName }}" 
                                class="w-full h-auto object-contain rounded-2xl hidden mx-auto border border-slate-100"
                            >
                        </div>

                        <!-- Scan Hint & Link Cadangan -->
                        <div class="mt-3 text-center space-y-1">
                            <p class="text-xs font-medium text-slate-600">
                                📸 <strong>Scan menggunakan kamera HP</strong> untuk langsung masuk ke pembayaran Midtrans
                            </p>
                            <a 
                                id="directMidtransPayLink" 
                                href="#" 
                                target="_blank" 
                                class="inline-flex items-center gap-1 text-xs font-bold text-[#f15a29] hover:underline"
                            >
                                <span>Atau klik di sini untuk buka pembayaran di tab baru &rarr;</span>
                            </a>
                        </div>

                        <!-- Badge Dukungan Aplikasi Pembayaran -->
                        <div class="flex items-center justify-center gap-2 flex-wrap mt-3 text-[11px] font-bold text-slate-500 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">
                            <span>📲 BCA</span>
                            <span>•</span>
                            <span>Mandiri</span>
                            <span>•</span>
                            <span>BRI</span>
                            <span>•</span>
                            <span>BNI</span>
                            <span>•</span>
                            <span class="text-[#f15a29]">GoPay</span>
                            <span>•</span>
                            <span>OVO</span>
                            <span>•</span>
                            <span>ShopeePay</span>
                        </div>
                    </div>

                    <!-- Kotak Nominal Tagihan -->
                    <div class="bg-orange-50/60 border border-orange-200/60 rounded-2xl p-4 text-center space-y-1">
                        <span class="text-xs font-bold text-slate-500 block uppercase tracking-wider">
                            Total yang Harus Ditransfer:
                        </span>
                        <strong class="text-2xl sm:text-3xl font-black text-[#f15a29] block" id="exactAmountDisplay">
                            Rp 0
                        </strong>
                        <span class="text-[11px] text-slate-400 block font-medium">
                            Setelah klik [Pay] di HP, halaman ini akan otomatis terverifikasi lunas
                        </span>
                    </div>

                    <!-- Tombol Konfirmasi Selesai Bayar Manual -->
                    <div class="pt-2">
                        <button 
                            type="button" 
                            id="confirmPaymentButton"
                            onclick="confirmPaymentSuccess()"
                            class="w-full py-4 rounded-2xl bg-gradient-to-r from-orange-500 via-[#f15a29] to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-extrabold text-sm sm:text-base shadow-xl shadow-orange-500/30 transition-all flex items-center justify-center gap-2 cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span id="confirmPaymentButtonText">Saya Sudah Bayar via QRIS</span>
                        </button>
                    </div>

                </div>

            </div>


            <!-- RIGHT COLUMN: Order Items Breakdown & Summary (lg:col-span-5) -->
            <div class="lg:col-span-5 space-y-5">
                
                <!-- Order Detail Summary Card -->
                <div class="bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-7 shadow-xs space-y-5">
                    
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">📋</span>
                            <h2 class="text-sm sm:text-base font-black text-slate-900 uppercase tracking-wider">
                                Rincian Pesanan
                            </h2>
                        </div>
                        <span class="text-xs font-black text-orange-600 bg-orange-50 px-2.5 py-1 rounded-lg border border-orange-200/60 font-mono" id="orderTrxCodeBadge">
                            #TRX-ORD
                        </span>
                    </div>

                    <!-- Meta Customer & Service Chips -->
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Pelanggan:</span>
                            <strong class="font-extrabold text-slate-800 text-xs sm:text-sm block truncate" id="customerNameField">Pelanggan</strong>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Tempat Makan:</span>
                            <strong class="font-extrabold text-slate-800 text-xs sm:text-sm block truncate" id="serviceTypeField">Makan di Tempat</strong>
                        </div>
                    </div>

                    <!-- Item List Container -->
                    <div class="space-y-2">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Menu yang Dipesan:</span>
                        <div class="space-y-2 max-h-64 overflow-y-auto pr-1" id="orderItemsList">
                            <!-- Populated via JS -->
                        </div>
                    </div>

                    <!-- Financial Breakdown -->
                    <div class="pt-4 border-t border-slate-200/80 space-y-2 text-xs font-semibold">
                        <div class="flex justify-between text-slate-500">
                            <span>Subtotal Menu:</span>
                            <span id="subtotalDisplay" class="font-bold text-slate-800">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-slate-500">
                            <span>Biaya Layanan:</span>
                            <span class="font-bold text-emerald-600">GRATIS (Rp 0)</span>
                        </div>
                        <div class="flex justify-between text-slate-500">
                            <span>Biaya Admin QRIS:</span>
                            <span class="font-bold text-emerald-600">GRATIS (Rp 0)</span>
                        </div>
                        <div class="flex justify-between text-base sm:text-lg font-black text-slate-900 pt-3 border-t border-dashed border-slate-200">
                            <span>Total yang Harus Dibayar:</span>
                            <span class="text-[#f15a29]" id="grandTotalDisplay">Rp 0</span>
                        </div>
                    </div>



                </div>

            </div>

        </div>

    </main>


    <!-- ========================================================
         3. FOOTER
    ======================================================== -->
    <footer class="bg-white border-t border-slate-200/80 py-6 text-slate-500 text-xs mt-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
            <div class="flex items-center gap-2 font-bold text-slate-800 justify-center">
                <span>Esa<span class="text-[#f15a29]">Corner</span></span>
                <span class="text-slate-300">•</span>
                <span class="text-xs text-slate-500 font-normal">Sistem Pemesanan Kantin Kampus Terpadu</span>
            </div>
            <p class="text-slate-400">&copy; {{ date('Y') }} Kantin Kampus Terpadu. All rights reserved.</p>
        </div>
    </footer>


    <!-- ========================================================
         4. JAVASCRIPT LOGIC
    ======================================================== -->
    <script>
        const outletId = {{ $outletId }};
        const outletName = @json($outletName);
        let cartItems = [];
        let grandTotal = 0;
        let generatedOrderCode = 'ORD-' + Math.random().toString(36).substring(2, 8).toUpperCase();
        let midtransPayUrl = '';
        let activeOrderCode = '';
        let statusPollInterval = null;

        document.addEventListener('DOMContentLoaded', () => {
            loadOrderData();
            startCountdown();
            generateMidtransQris();
        });

        function loadOrderData() {
            // Baca data dari localStorage
            const storedCustomer = localStorage.getItem('customer_name') || 'Pelanggan Kampus';
            const storedOrderType = localStorage.getItem('order_type') || 'solo';
            const storedService = localStorage.getItem('service_type') || 'dine_in';
            const storedTable = localStorage.getItem('table_number') || '';
            const storedCartJson = localStorage.getItem('checkout_cart_items');
            
            // Set header & badge
            const customerEl = document.getElementById('customerNameField');
            if (customerEl) customerEl.innerText = storedCustomer;

            const serviceEl = document.getElementById('serviceTypeField');
            if (serviceEl) {
                const tableStr = storedTable ? ` (Meja #${storedTable})` : '';
                serviceEl.innerText = storedService === 'dine_in' ? `Makan di Tempat${tableStr}` : 'Bungkus / Take Away';
            }

            const trxBadge = document.getElementById('orderTrxCodeBadge');
            if (trxBadge) trxBadge.innerText = '#TRX-' + generatedOrderCode.replace('ORD-', '');

            // Parse items
            if (storedCartJson) {
                try {
                    cartItems = JSON.parse(storedCartJson);
                } catch(e) {
                    cartItems = [];
                }
            }

            // Jika kosong, tampilkan empty state
            const emptyState = document.getElementById('emptyOrderState');
            const contentGrid = document.getElementById('paymentContentGrid');

            if (!cartItems || cartItems.length === 0) {
                if (emptyState) emptyState.classList.remove('hidden');
                if (contentGrid) contentGrid.classList.add('hidden');
                return;
            }

            // Render daftar items
            const itemsListEl = document.getElementById('orderItemsList');
            let listHtml = '';
            grandTotal = 0;

            cartItems.forEach(item => {
                const sub = (parseInt(item.price) || 0) * (parseInt(item.quantity) || 1);
                grandTotal += sub;

                const imgHtml = item.image 
                    ? `<img src="${item.image}" alt="${item.name}" class="w-10 h-10 object-cover rounded-lg border border-slate-200 shrink-0">`
                    : `<div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 font-extrabold flex items-center justify-center text-xs shrink-0">🍱</div>`;

                listHtml += `
                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-xs">
                        <div class="flex items-center gap-2.5 min-w-0 flex-1 pr-2">
                            ${imgHtml}
                            <div class="min-w-0">
                                <span class="font-bold text-slate-800 block truncate">${item.name}</span>
                                <span class="text-[11px] text-slate-400 block">Rp ${(parseInt(item.price) || 0).toLocaleString('id-ID')} x ${item.quantity}</span>
                            </div>
                        </div>
                        <strong class="font-extrabold text-slate-900 shrink-0">
                            Rp ${sub.toLocaleString('id-ID')}
                        </strong>
                    </div>
                `;
            });

            if (itemsListEl) itemsListEl.innerHTML = listHtml;

            // Set total angka
            const formatted = 'Rp ' + grandTotal.toLocaleString('id-ID');
            const exactEl = document.getElementById('exactAmountDisplay');
            const subtotalEl = document.getElementById('subtotalDisplay');
            const grandEl = document.getElementById('grandTotalDisplay');

            if (exactEl) exactEl.innerText = formatted;
            if (subtotalEl) subtotalEl.innerText = formatted;
            if (grandEl) grandEl.innerText = formatted;
        }

        // ========================================================
        // 5. GENERATE QRIS MIDTRANS DINAMIS (BISA DI-SCAN LANGSUNG)
        // ========================================================
        function generateMidtransQris() {
            if (!cartItems || cartItems.length === 0) return;

            const storedCustomer = localStorage.getItem('customer_name') || 'Pelanggan Kampus';
            const storedOrderType = localStorage.getItem('order_type') || 'solo';
            const storedService = localStorage.getItem('service_type') || 'dine_in';

            const payloadItems = cartItems.map(item => ({
                id: item.menu_id || item.id,
                menu_id: item.menu_id || item.id,
                name: item.name,
                customer_name: item.customer_name || storedCustomer,
                quantity: parseInt(item.quantity) || 1,
                price: parseInt(item.price) || 0
            }));

            const payload = {
                outlet_id: outletId,
                order_type: storedOrderType,
                service_type: storedService,
                customer_name: storedCustomer,
                items: payloadItems
            };

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // Request ke endpoint Midtrans Gopay / Deeplink
            fetch('/order/midtrans-gopay', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.deeplink_url) {
                    midtransPayUrl = data.deeplink_url;
                    activeOrderCode = data.order_code;

                    // Update TRX Badge dengan Order Code resmi
                    const trxBadge = document.getElementById('orderTrxCodeBadge');
                    if (trxBadge) trxBadge.innerText = '#' + activeOrderCode;

                    // Generate QR Code dari link Midtrans (Bisa langsung di-scan kamera HP!)
                    const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=350x350&margin=10&data=' + encodeURIComponent(midtransPayUrl);
                    
                    const imgEl = document.getElementById('qrisDisplayImg');
                    const spinner = document.getElementById('qrLoadingSpinner');
                    const directLink = document.getElementById('directMidtransPayLink');

                    if (imgEl) {
                        imgEl.src = qrUrl;
                        imgEl.onload = () => {
                            if (spinner) spinner.classList.add('hidden');
                            imgEl.classList.remove('hidden');
                        };
                    }

                    if (directLink) {
                        directLink.href = midtransPayUrl;
                    }

                    // Mulai polling cek status pembayaran secara otomatis
                    startStatusPolling(activeOrderCode);
                } else {
                    console.error('Gagal generate Midtrans QR:', data);
                    fallbackToStaticQr();
                }
            })
            .catch(err => {
                console.error('Error generate Midtrans QR:', err);
                fallbackToStaticQr();
            });
        }

        // Fallback jika API gagal
        function fallbackToStaticQr() {
            const spinner = document.getElementById('qrLoadingSpinner');
            const imgEl = document.getElementById('qrisDisplayImg');
            if (spinner) spinner.classList.add('hidden');
            if (imgEl) {
                imgEl.src = '/images/qris-esacorner.png';
                imgEl.classList.remove('hidden');
            }
        }

        // Polling status secara realtime (saat user klik [Pay] di HP, layar laptop otomatis lunas)
        function startStatusPolling(orderCode) {
            if (statusPollInterval) clearInterval(statusPollInterval);

            statusPollInterval = setInterval(() => {
                fetch(`/order/${orderCode}/status`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'paid' || data.status === 'cooking' || data.status === 'ready' || data.status === 'completed') {
                            clearInterval(statusPollInterval);
                            const btnText = document.getElementById('confirmPaymentButtonText');
                            if (btnText) btnText.innerText = '✓ Pembayaran Berhasil Terverifikasi!';
                            
                            localStorage.removeItem('checkout_cart_items');
                            localStorage.removeItem('cart_state_' + outletId);

                            setTimeout(() => {
                                window.location.href = `/order/track/${orderCode}`;
                            }, 1200);
                        }
                    })
                    .catch(() => {});
            }, 2500);
        }

        // Timer Sesi 02:00
        let seconds = 120;
        function startCountdown() {
            const timerEl = document.getElementById('paymentTimer');
            const interval = setInterval(() => {
                seconds--;
                if (seconds <= 0) {
                    clearInterval(interval);
                    if (timerEl) timerEl.innerText = '⏱️ Waktu Habis';
                    return;
                }
                const m = Math.floor(seconds / 60);
                const s = seconds % 60;
                if (timerEl) timerEl.innerText = `⏱️ 0${m}:${s < 10 ? '0' : ''}${s}`;
            }, 1000);
        }

        // Share Nota WA
        function shareBillToWhatsapp() {
            const customer = localStorage.getItem('customer_name') || 'Pelanggan';
            let text = `🧾 *TAGIHAN PESANAN KANTIN - ${outletName.toUpperCase()}*\n`;
            text += `Kode: ${activeOrderCode || generatedOrderCode}\n`;
            text += `Pemesan: ${customer}\n`;
            text += `------------------------------------\n`;
            cartItems.forEach(i => {
                text += `• ${i.name} (${i.quantity}x) = Rp ${(i.price * i.quantity).toLocaleString('id-ID')}\n`;
            });
            text += `------------------------------------\n`;
            text += `*TOTAL: Rp ${grandTotal.toLocaleString('id-ID')}*\n`;
            text += `Status: Menunggu Pembayaran QRIS\n`;

            window.open('https://api.whatsapp.com/send?text=' + encodeURIComponent(text), '_blank');
        }

        // ========================================================
        // 6. TOMBOL MANUAL: SAYA SUDAH BAYAR VIA QRIS
        // ========================================================
        let isSubmitting = false;
        function confirmPaymentSuccess() {
            if (isSubmitting) return;

            if (!cartItems || cartItems.length === 0) {
                alert('Pesanan kosong!');
                return;
            }

            isSubmitting = true;
            const btn = document.getElementById('confirmPaymentButton');
            const btnText = document.getElementById('confirmPaymentButtonText');
            if (btn) btn.disabled = true;
            if (btnText) btnText.innerText = 'Memverifikasi Pembayaran...';

            const finalCode = activeOrderCode || generatedOrderCode;

            // Jika pesanan sudah dibuat di Midtrans, cukup update statusnya ke paid
            if (activeOrderCode) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                fetch(`/order/${activeOrderCode}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ status: 'paid' })
                }).finally(() => {
                    localStorage.removeItem('checkout_cart_items');
                    localStorage.removeItem('cart_state_' + outletId);
                    window.location.href = `/order/track/${activeOrderCode}`;
                });
                return;
            }

            // Fallback simpan langsung
            const storedCustomer = localStorage.getItem('customer_name') || 'Pelanggan Kampus';
            const storedOrderType = localStorage.getItem('order_type') || 'solo';
            const storedService = localStorage.getItem('service_type') || 'dine_in';

            const payloadItems = cartItems.map(item => ({
                menu_id: item.menu_id || item.id,
                customer_name: item.customer_name || storedCustomer,
                quantity: parseInt(item.quantity) || 1,
                price: parseInt(item.price) || 0
            }));

            const payload = {
                outlet_id: outletId,
                order_type: storedOrderType,
                service_type: storedService,
                items: payloadItems,
                status: 'paid'
            };

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch('/order/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                localStorage.removeItem('checkout_cart_items');
                localStorage.removeItem('cart_state_' + outletId);
                window.location.href = `/order/track/${data.order_code || finalCode}`;
            })
            .catch(err => {
                console.error(err);
                alert('Gagal menyimpan pesanan. Silakan coba lagi.');
                isSubmitting = false;
                if (btn) btn.disabled = false;
                if (btnText) btnText.innerText = 'Saya Sudah Bayar via QRIS';
            });
        }
    </script>
</body>
</html>
