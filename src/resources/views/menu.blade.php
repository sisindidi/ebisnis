<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $outlet->name ?? 'Outlet Kantin' }} - Kantin Kampus Terpadu</title>

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            500: '#f15a29',
                            600: '#ea580c',
                            700: '#c2410c',
                        },
                        navy: {
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#0a0f1d'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .highlight-pulse {
            animation: pulseGlow 1.4s ease 2;
            border-color: #f15a29 !important;
        }

        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(241, 90, 41, 0.6); }
            50% { box-shadow: 0 0 0 12px rgba(241, 90, 41, 0); }
            100% { box-shadow: 0 0 0 0 rgba(241, 90, 41, 0); }
        }
    </style>
</head>
<body class="antialiased text-slate-800 bg-[#f8fafc] min-h-screen flex flex-col">

    <!-- ========================================================
         1. TOP NAVBAR
    ======================================================== -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            
            <!-- Logo & Campus Subtitle (Identik Neon Sign Esa Corner Kampus) -->
            <div class="flex items-center gap-3">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="flex flex-col">
                        <div class="flex items-center text-2xl sm:text-[26px] font-black tracking-tight leading-none text-[#0066B3] group-hover:opacity-90 transition-opacity" style="text-shadow: 0 2px 8px rgba(0, 102, 179, 0.2);">
                            <span>Esa</span>
                            <span class="ml-1.5 flex items-center">
                                <span>C</span>
                                <img src="{{ asset('images/esa-logo.png') }}" alt="o" class="w-6 h-6 sm:w-7 sm:h-7 object-contain inline-block mx-0.5 -mt-0.5 drop-shadow-xs">
                                <span>rner</span>
                            </span>
                        </div>
                        <span class="text-[10px] sm:text-[11px] font-bold text-slate-500 tracking-wider uppercase block mt-1">
                            Kantin Kampus Terpadu
                        </span>
                    </div>
                </a>
            </div>

            <!-- Nav Links Desktop -->
            <nav class="hidden md:flex items-center gap-1 text-xs sm:text-sm font-bold text-slate-600 bg-slate-100/80 p-1 rounded-full border border-slate-200/70">
                <a href="/" class="px-3.5 py-1.5 rounded-full text-slate-600 hover:text-[#f15a29] transition-all">Beranda</a>
                <a href="#view-menu-catalog" class="px-3.5 py-1.5 rounded-full bg-white text-[#f15a29] shadow-2xs transition-all">Menu</a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">

                <!-- Status Antrean Button -->
                <a 
                    href="/order/track" 
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-orange-50 hover:bg-orange-100 text-[#ea580c] font-bold text-xs sm:text-sm border border-orange-200/80 transition-all shadow-xs"
                >
                    <svg class="w-4 h-4 text-[#ea580c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span>Status Antrean</span>
                </a>
            </div>

        </div>
    </header>


    <!-- ========================================================
         MAIN PAGE CONTAINER
    ======================================================== -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-32 space-y-8">

        @php
            // Konfigurasi visual outlet
            $outletId = $outlet->id ?? 1;
            $outletName = $outlet->name ?? 'Esa Corner';
            
            $outletMeta = [
                1 => [
                    'image' => 'images/esacorner.jpg',
                    'position' => 'center 56%',
                    'location' => 'Lantai 1 • Dekat Pintu Masuk',
                    'desc' => 'Menyediakan aneka burger, ayam krispi, camilan ringan, serta berbagai pilihan minuman segar.',
                    'rating' => '4.8',
                    'reviews' => '1.2rb Ulasan',
                    'time' => '8 - 15 Menit',
                    'stanCode' => 'Stan 01',
                ],
                2 => [
                    'image' => 'images/kedaimamici.jpg',
                    'position' => 'center 15%',
                    'location' => 'Lantai 1 • Deretan No. 02',
                    'desc' => 'Menawarkan berbagai hidangan seperti baso aci, baso urat, mi ayam gurih, dan aneka jajanan lezat.',
                    'rating' => '4.9',
                    'reviews' => '2.1rb Ulasan',
                    'time' => '10 - 18 Menit',
                    'stanCode' => 'Stan 02',
                ],
                3 => [
                    'image' => 'images/kantintehnur.jpg',
                    'position' => 'center 20%',
                    'location' => 'Lantai 1 • Deretan No. 03',
                    'desc' => 'Menyajikan aneka menu rumahan seperti ayam cabe hijau, ayam bawang putih, aneka gorengan, dan minuman.',
                    'rating' => '4.8',
                    'reviews' => '950 Ulasan',
                    'time' => '8 - 12 Menit',
                    'stanCode' => 'Stan 03',
                ],
                4 => [
                    'image' => 'images/kedaibuyanti.jpg',
                    'position' => 'center 20%',
                    'location' => 'Lantai 1 • Deretan No. 04',
                    'desc' => 'Menyediakan beragam hidangan favorit seperti nasi goreng, kwetiau, mi goreng, serta aneka makanan lainnya.',
                    'rating' => '4.9',
                    'reviews' => '2.4rb Ulasan',
                    'time' => '8 - 15 Menit',
                    'stanCode' => 'Stan 04',
                ],
            ];

            $lowOutlet = strtolower($outletName);
            $currMeta = $outletMeta[$outletId] ?? $outletMeta[1];
            if (str_contains($lowOutlet, 'mamici')) $currMeta = $outletMeta[2];
            elseif (str_contains($lowOutlet, 'nur') || str_contains($lowOutlet, 'teh')) $currMeta = $outletMeta[3];
            elseif (str_contains($lowOutlet, 'yanti') || str_contains($lowOutlet, 'geprek')) $currMeta = $outletMeta[4];

            $bannerPhoto = !empty($outlet->image) 
                ? (str_starts_with($outlet->image, 'http') ? $outlet->image : asset('storage/' . $outlet->image))
                : asset($currMeta['image']);
        @endphp


        <!-- ========================================================
             2. OUTLET PROFILE HEADER CARD
        ======================================================== -->
        <section style="background-color: #EAF4FF;" class="rounded-3xl border border-blue-200/80 shadow-xs p-5 sm:p-7 relative overflow-hidden">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                
                <!-- Left: Photo & Stan Identity -->
                <div class="flex items-start sm:items-center gap-4 sm:gap-6">
                    
                    <!-- Outlet Thumbnail -->
                    <div class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden bg-white shrink-0 border border-blue-200/80 shadow-inner">
                        <img 
                            src="{{ $bannerPhoto }}" 
                            alt="{{ $outletName }}" 
                            style="object-position: {{ $currMeta['position'] }};"
                            class="w-full h-full object-cover"
                        >
                        <span class="absolute bottom-1 right-1 bg-slate-900/80 backdrop-blur-xs text-white text-[10px] font-black px-1.5 py-0.5 rounded-md">
                            {{ $currMeta['stanCode'] }}
                        </span>
                    </div>

                    <!-- Outlet Info -->
                    <div>
                        <!-- Badges Row -->
                        <div class="flex items-center gap-2 flex-wrap mb-2">
                            <span class="bg-white/90 text-blue-700 text-xs font-black px-2.5 py-0.5 rounded-lg border border-blue-200/60 shadow-2xs">
                                {{ $currMeta['stanCode'] }}
                            </span>
                        </div>

                        <!-- Main Heading -->
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">
                            {{ $outletName }}
                        </h1>

                        <!-- Location -->
                        <p class="text-xs sm:text-sm text-slate-500 font-medium flex items-center gap-1.5 flex-wrap mt-1">
                            <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $currMeta['location'] }}</span>
                        </p>
                    </div>

                </div>

                <!-- Right: Info Chips -->
                <div class="flex items-center gap-3 sm:gap-4 shrink-0 flex-wrap sm:flex-nowrap border-t lg:border-t-0 pt-4 lg:pt-0 border-blue-200/60">
                    <div class="bg-white/90 border border-blue-200/70 rounded-2xl p-3 sm:p-3.5 flex items-center gap-3 flex-1 sm:flex-initial shadow-2xs">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-slate-500 block uppercase tracking-wider">Jaminan Pesanan</span>
                            <span class="text-xs sm:text-sm font-extrabold text-slate-800">Hangat & Cepat</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Info Bar Inside Header -->
            <div class="mt-5 pt-4 border-t border-blue-200/60 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2 text-slate-700 font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Layanan: <strong class="text-slate-900 font-bold">Pesan online dan ambil pesanan langsung di stan tanpa perlu mengantre.</strong></span>
                </div>
                <div class="text-slate-600 font-medium">
                    Pelanggan: <span class="font-extrabold text-[#f15a29]" id="headerCustomerName">Pelanggan</span>
                </div>
            </div>
        </section>


       

        <!-- ========================================================
             4. SERVICE TYPE SELECTION (DINE IN / TAKE AWAY)
        ======================================================== -->
        <div class="bg-white rounded-2xl border border-[#DCEAF7] p-3 sm:p-4 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <span class="text-xs font-black text-[#101735] uppercase tracking-wider shrink-0">Tempat Makan:</span>
                <div class="inline-flex items-center bg-[#F1F5F9] p-1 rounded-full border border-slate-200/80 shadow-2xs w-full sm:w-auto">
                    <button 
                        type="button" 
                        id="service-btn-dine-in" 
                        onclick="setServiceType('dine_in')"
                        class="flex-1 sm:flex-initial px-4 py-1.5 rounded-full text-xs font-bold transition-all bg-[#f15a29] text-white shadow-xs cursor-pointer select-none"
                    >
                        Makan di Tempat (Dine In)
                    </button>
                    <button 
                        type="button" 
                        id="service-btn-take-away" 
                        onclick="setServiceType('take_away')"
                        class="flex-1 sm:flex-initial px-4 py-1.5 rounded-full text-xs font-semibold bg-transparent text-[#475569] hover:text-[#f15a29] transition-all cursor-pointer select-none"
                    >
                        Bungkus (Take Away)
                    </button>
                </div>
            </div>

           
        </div>


        <!-- ====================================================================
             5. TAMPILAN KHUSUS SPLIT BILL: HALAMAN ATUR TEMAN & RINGKASAN
             (Muncul saat mode Split Bill aktif, sebelum masuk ke menu teman)
        ==================================================================== -->
        <section id="view-split-friends" class="hidden space-y-6">
            
            <!-- Split Bill Header Card with #F4F6FA -->
            <div style="background-color: #F4F6FA;" class="rounded-3xl p-6 sm:p-8 text-slate-800 shadow-xs relative overflow-hidden border border-slate-300/80">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-300/80">
                    <div>
                        
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                            Pesan Makanan Bersama Teman (Split Bill)
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                            Ajak temanmu untuk memesan makanan bersama! Tambahkan nama teman yang ikut, lalu setiap orang bisa memilih makanan dan minuman sesuai keinginan masing-masing.
                        </p>
                    </div>
                </div>

                <!-- Form Tambah Nama Teman -->
                <div class="pt-5 space-y-3">
                    <span class="text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-1.5">
                        <span class="text-base">➕</span> TAMBAHKAN NAMA TEMAN YANG IKUT MAKAN:
                    </span>

                    <div class="flex flex-col sm:flex-row gap-2 max-w-lg">
                        <input 
                            type="text" 
                            id="inputNamaTemanSplit"
                            onkeypress="handleFriendInputKey(event)"
                            placeholder="Ketik nama teman (misal: Cindy, Linda, Budi)..." 
                            class="flex-1 px-4 py-3 rounded-xl bg-white border border-slate-300 text-xs sm:text-sm font-semibold text-slate-800 placeholder-slate-400 focus:outline-hidden focus:border-[#f15a29] focus:ring-1 focus:ring-[#f15a29] shadow-2xs"
                        >
                        <button 
                            type="button" 
                            onclick="addFriendFromInput()"
                            class="px-6 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-[#f15a29] hover:opacity-90 text-white font-black text-xs sm:text-sm shadow-md transition-all flex items-center justify-center gap-1.5 cursor-pointer shrink-0"
                        >
                            <span>+ Tambah Nama</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Grid Bubble Kartu Teman & Tombol Pilih Menu Masing-Masing -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight">
                            Daftar Teman & Rincian Pesanan
                        </h3>
                        <p class="text-xs text-slate-500">Klik tombol "Pilih Menu" pada nama teman untuk membuka halaman pilihan makanannya.</p>
                    </div>
                    <span class="text-xs font-extrabold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-full" id="splitFriendsCountBadge">
                        1 Teman Terdaftar
                    </span>
                </div>

                <!-- BUBBLE CARDS CONTAINER -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="friendsBubbleGrid">
                    <!-- Diisi JavaScript -->
                </div>
            </div>

            <!-- Ringkasan Tagihan Sesi & Pembayaran QRIS Bersama -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-md flex flex-col sm:flex-row items-center justify-between gap-6">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Tagihan Sesi Bersama:</span>
                    <strong class="text-2xl sm:text-3xl font-black text-slate-900" id="splitGrandTotalBottom">Rp 0</strong>
                    <span class="text-xs text-slate-500 block mt-0.5" id="splitTotalItemsBottom">0 menu dipesan oleh semua teman</span>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button 
                        type="button" 
                        onclick="handleMainProceed()"
                        class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-[#f15a29] hover:bg-orange-600 text-white font-extrabold text-xs sm:text-sm shadow-lg shadow-orange-500/25 transition-all flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <span>Bayar Semua Pesanan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </div>

        </section>


        <!-- ====================================================================
             6. TAMPILAN KATALOG MENU (UNTUK SOLO MODE & SAAT TEMAN PILIH MENU)
        ==================================================================== -->
        <section id="view-menu-catalog" class="space-y-6">
            
            <!-- HEADER KHUSUS JIKA SEDANG MEMILIH MENU UNTUK TEMAN (DI MODE SPLIT BILL) -->
            <div id="splitActiveFriendHeader" style="background-color: #F4F6FA;" class="hidden rounded-3xl p-5 sm:p-6 shadow-xs border border-slate-300/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-slate-800">
                <div class="flex items-center gap-3.5">
                    <button 
                        type="button" 
                        onclick="returnToSplitFriendsView()"
                        class="w-10 h-10 rounded-2xl bg-white hover:bg-slate-100 text-slate-800 border border-slate-200/80 shadow-2xs flex items-center justify-center font-black text-lg transition-colors cursor-pointer shrink-0"
                        title="Kembali ke Daftar Teman"
                    >
                        &larr;
                    </button>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-md bg-white border border-slate-300 text-slate-700 text-[10px] font-black uppercase tracking-wider shadow-2xs">
                                MEMILIH MENU
                            </span>
                            <span class="text-xs text-slate-500 font-bold" id="activeFriendStatusItems">0 Menu Dipilih</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-black text-slate-900 mt-0.5">
                            Pilih Makanan untuk: <span id="activeFriendHeadingName" class="text-[#f15a29] underline underline-offset-4">Cindy</span>
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Filter Kategori & Pencarian Menu -->
            <div class="bg-white rounded-2xl border border-[#DCEAF7] p-3 sm:p-4 shadow-xs flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
                
                <div class="inline-flex items-center gap-1 bg-[#F1F5F9] p-1.5 rounded-full border border-slate-200/80 shadow-2xs overflow-x-auto">
                    <button 
                        type="button" 
                        onclick="filterCategory('semua')" 
                        id="cat-pill-semua"
                        class="category-pill px-4 py-1.5 rounded-full bg-white text-[#F15A29] font-semibold shadow-2xs transition-all cursor-pointer shrink-0 text-xs sm:text-sm select-none"
                    >
                        Semua Menu
                    </button>
                    <button 
                        type="button" 
                        onclick="filterCategory('makanan')" 
                        id="cat-pill-makanan"
                        class="category-pill px-4 py-1.5 rounded-full bg-transparent text-[#475569] hover:text-[#101735] hover:bg-white/60 font-medium transition-all cursor-pointer shrink-0 text-xs sm:text-sm select-none"
                    >
                        Makanan
                    </button>
                    <button 
                        type="button" 
                        onclick="filterCategory('minuman')" 
                        id="cat-pill-minuman"
                        class="category-pill px-4 py-1.5 rounded-full bg-transparent text-[#475569] hover:text-[#101735] hover:bg-white/60 font-medium transition-all cursor-pointer shrink-0 text-xs sm:text-sm select-none"
                    >
                        Minuman
                    </button>
                    <button 
                        type="button" 
                        onclick="filterCategory('cemilan')" 
                        id="cat-pill-cemilan"
                        class="category-pill px-4 py-1.5 rounded-full bg-transparent text-[#475569] hover:text-[#101735] hover:bg-white/60 font-medium transition-all cursor-pointer shrink-0 text-xs sm:text-sm select-none"
                    >
                        Cemilan
                    </button>
                </div>

                <div class="relative w-full md:w-72">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input 
                        type="text" 
                        id="inStoreSearchInput"
                        onkeyup="handleMenuSearch(this.value)"
                        placeholder="Cari menu di stan {{ $outletName }}..." 
                        class="w-full pl-10 pr-4 py-2 text-xs font-semibold text-slate-800 placeholder-slate-400 bg-slate-50 border border-slate-200 rounded-xl focus:outline-hidden focus:border-[#f15a29] focus:bg-white transition-all"
                    >
                </div>

            </div>

            <!-- Layout Menu Penuh (Panjang Kebawah) -->
            <div class="w-full space-y-10">
                
                <div class="space-y-10">
                    
                    @php
                        $categorized = [];
                        foreach ($menus as $m) {
                            $cat = $m->category ?? 'makanan';
                            if ($cat === 'camilan') $cat = 'cemilan';

                            $categorized[] = [
                                'id' => $m->id,
                                'name' => $m->name,
                                'price' => $m->price,
                                'description' => $m->description ?? 'Hidangan istimewa racikan bumbu khas dapur.',
                                'image' => \App\Models\Menu::resolveImageUrl($m->image, $m->name),
                                'category' => $cat,
                                'is_available' => (bool) ($m->is_available ?? true),
                            ];
                        }
                    @endphp

                    <!-- SECTION 1: MAKANAN -->
                    <div class="menu-section-group" id="sec-makanan">
                        <div class="flex items-center justify-between mb-5 border-b border-[#DCEAF7] pb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#FFF0E8] border border-[#F15A29]/20 flex items-center justify-center shrink-0 text-[#F15A29] shadow-2xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/>
                                        <path d="M7 2v20"/>
                                        <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg sm:text-xl font-bold text-[#101735] tracking-tight leading-tight">Makanan</h3>
                                    <div class="h-1 w-8 bg-[#F15A29] rounded-full mt-1"></div>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-[#64748B] hidden sm:inline">Pilihan Lauk & Santapan Sedap</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                            @php $makananFound = false; @endphp
                            @foreach ($categorized as $item)
                                @if ($item['category'] === 'makanan')
                                    @php $makananFound = true; @endphp
                                    <div 
                                        class="menu-card-desktop group bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-lg hover:border-orange-500/40 transition-all duration-300 flex flex-col overflow-hidden"
                                        data-id="{{ $item['id'] }}"
                                        data-name="{{ $item['name'] }}"
                                        data-price="{{ $item['price'] }}"
                                        data-image="{{ $item['image'] }}"
                                        data-desc="{{ $item['description'] }}"
                                        data-cat="makanan"
                                        data-available="{{ $item['is_available'] ? '1' : '0' }}"
                                    >
                                        <div class="relative w-full h-40 overflow-hidden bg-slate-100">
                                            <img 
                                                src="{{ $item['image'] }}" 
                                                alt="{{ $item['name'] }}"
                                                class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500 {{ !$item['is_available'] ? 'grayscale contrast-95' : '' }}"
                                                loading="lazy"
                                            >
                                            @if (!$item['is_available'])
                                                <div class="absolute inset-0 bg-slate-900/45 flex items-center justify-center">
                                                    <span class="bg-rose-500/95 text-white text-[11px] font-black px-4 py-1.5 rounded-full uppercase tracking-wider shadow-md border border-white/20">
                                                        HABIS
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="p-4 flex-1 flex flex-col justify-between">
                                            <div>
                                                <h4 class="text-sm font-extrabold text-slate-900 group-hover:text-[#f15a29] transition-colors leading-snug">
                                                    {{ $item['name'] }}
                                                </h4>
                                                <p class="text-xs text-slate-500 line-clamp-2 mt-1 font-normal leading-relaxed">
                                                    {{ $item['description'] }}
                                                </p>
                                            </div>

                                            <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between">
                                                <div class="text-base font-black text-slate-900">
                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </div>

                                                @if ($item['is_available'])
                                                    <div class="flex items-center bg-slate-100 rounded-xl p-1 border border-slate-200">
                                                        <button 
                                                            type="button" 
                                                            onclick="updateItemQty({{ $item['id'] }}, -1)" 
                                                            class="w-8 h-8 rounded-lg bg-white text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white transition-all text-base flex items-center justify-center shadow-xs cursor-pointer select-none leading-none"
                                                        >
                                                            -
                                                        </button>
                                                        <span class="w-8 text-center text-xs font-black text-slate-900 select-none" id="qty-val-{{ $item['id'] }}">0</span>
                                                        <button 
                                                            type="button" 
                                                            onclick="updateItemQty({{ $item['id'] }}, 1)" 
                                                            class="w-8 h-8 rounded-lg bg-white text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white transition-all text-base flex items-center justify-center shadow-xs cursor-pointer select-none leading-none"
                                                        >
                                                            +
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 text-slate-500 text-xs font-bold border border-slate-200 select-none shadow-2xs">
                                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                                        </svg>
                                                        <span>Stok sedang habis</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if (!$makananFound)
                                <div class="col-span-full py-6 text-center text-xs text-slate-400 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                    Belum ada menu makanan di outlet ini.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- SECTION 2: MINUMAN -->
                    <div class="menu-section-group" id="sec-minuman">
                        <div class="flex items-center justify-between mb-5 border-b border-[#DCEAF7] pb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#FFF0E8] border border-[#F15A29]/20 flex items-center justify-center shrink-0 text-[#F15A29] shadow-2xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="m6 8 1.75 12.28a2 2 0 0 0 2 1.72h4.5a2 2 0 0 0 2-1.72L18 8"/>
                                        <path d="M5 8h14"/>
                                        <path d="M7 15a6.47 6.47 0 0 1 5 0 6.47 6.47 0 0 0 5 0"/>
                                        <path d="m12 8 1-6h2"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg sm:text-xl font-bold text-[#101735] tracking-tight leading-tight">Minuman</h3>
                                    <div class="h-1 w-8 bg-[#F15A29] rounded-full mt-1"></div>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-[#64748B] hidden sm:inline">Minuman Dingin & Hangat Segar</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                            @php $minumanFound = false; @endphp
                            @foreach ($categorized as $item)
                                @if ($item['category'] === 'minuman')
                                    @php $minumanFound = true; @endphp
                                    <div 
                                        class="menu-card-desktop group bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-lg hover:border-orange-500/40 transition-all duration-300 flex flex-col overflow-hidden"
                                        data-id="{{ $item['id'] }}"
                                        data-name="{{ $item['name'] }}"
                                        data-price="{{ $item['price'] }}"
                                        data-image="{{ $item['image'] }}"
                                        data-desc="{{ $item['description'] }}"
                                        data-cat="minuman"
                                        data-available="{{ $item['is_available'] ? '1' : '0' }}"
                                    >
                                        <div class="relative w-full h-36 overflow-hidden bg-slate-100">
                                            <img 
                                                src="{{ $item['image'] }}" 
                                                alt="{{ $item['name'] }}"
                                                class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500 {{ !$item['is_available'] ? 'grayscale contrast-95' : '' }}"
                                                loading="lazy"
                                            >
                                            @if (!$item['is_available'])
                                                <div class="absolute inset-0 bg-slate-900/45 flex items-center justify-center">
                                                    <span class="bg-rose-500/95 text-white text-[11px] font-black px-4 py-1.5 rounded-full uppercase tracking-wider shadow-md border border-white/20">
                                                        HABIS
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="p-4 flex-1 flex flex-col justify-between">
                                            <div>
                                                <h4 class="text-sm font-extrabold text-slate-900 group-hover:text-[#f15a29] transition-colors leading-snug">
                                                    {{ $item['name'] }}
                                                </h4>
                                                <p class="text-xs text-slate-500 line-clamp-1 mt-1 font-normal">
                                                    {{ $item['description'] }}
                                                </p>
                                            </div>

                                            <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between">
                                                <div class="text-base font-black text-slate-900">
                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </div>

                                                @if ($item['is_available'])
                                                    <div class="flex items-center bg-slate-100 rounded-xl p-1 border border-slate-200">
                                                        <button 
                                                            type="button" 
                                                            onclick="updateItemQty({{ $item['id'] }}, -1)" 
                                                            class="w-8 h-8 rounded-lg bg-white text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white transition-all text-base flex items-center justify-center shadow-xs cursor-pointer select-none leading-none"
                                                        >
                                                            -
                                                        </button>
                                                        <span class="w-8 text-center text-xs font-black text-slate-900 select-none" id="qty-val-{{ $item['id'] }}">0</span>
                                                        <button 
                                                            type="button" 
                                                            onclick="updateItemQty({{ $item['id'] }}, 1)" 
                                                            class="w-8 h-8 rounded-lg bg-white text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white transition-all text-base flex items-center justify-center shadow-xs cursor-pointer select-none leading-none"
                                                        >
                                                            +
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 text-slate-500 text-xs font-bold border border-slate-200 select-none shadow-2xs">
                                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                                        </svg>
                                                        <span>Stok sedang habis</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if (!$minumanFound)
                                <div class="col-span-full py-6 text-center text-xs text-slate-400 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                    Belum ada menu minuman di outlet ini.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- SECTION 3: CEMILAN -->
                    <div class="menu-section-group" id="sec-cemilan">
                        <div class="flex items-center justify-between mb-5 border-b border-[#DCEAF7] pb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#FFF0E8] border border-[#F15A29]/20 flex items-center justify-center shrink-0 text-[#F15A29] shadow-2xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M18 8a2 2 0 0 0 0-4 2 2 0 0 0-4 0 2 2 0 0 0-4 0 2 2 0 0 0-4 0 2 2 0 0 0 0 4"/>
                                        <path d="M10 22 9 8"/>
                                        <path d="m14 22 1-14"/>
                                        <path d="M20 8c.5 0 .9.4.8 1l-2.6 12.2a2 2 0 0 1-2 1.8H7.8a2 2 0 0 1-2-1.8L3.2 9c-.1-.6.3-1 .8-1Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg sm:text-xl font-bold text-[#101735] tracking-tight leading-tight">Cemilan</h3>
                                    <div class="h-1 w-8 bg-[#F15A29] rounded-full mt-1"></div>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-[#64748B] hidden sm:inline">Snack & Gorengan Renyah</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                            @php $cemilanFound = false; @endphp
                            @foreach ($categorized as $item)
                                @if ($item['category'] === 'cemilan')
                                    @php $cemilanFound = true; @endphp
                                    <div 
                                        class="menu-card-desktop group bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-lg hover:border-orange-500/40 transition-all duration-300 flex flex-col overflow-hidden"
                                        data-id="{{ $item['id'] }}"
                                        data-name="{{ $item['name'] }}"
                                        data-price="{{ $item['price'] }}"
                                        data-image="{{ $item['image'] }}"
                                        data-desc="{{ $item['description'] }}"
                                        data-cat="cemilan"
                                        data-available="{{ $item['is_available'] ? '1' : '0' }}"
                                    >
                                        <div class="relative w-full h-36 overflow-hidden bg-slate-100">
                                            <img 
                                                src="{{ $item['image'] }}" 
                                                alt="{{ $item['name'] }}"
                                                class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500 {{ !$item['is_available'] ? 'grayscale contrast-95' : '' }}"
                                                loading="lazy"
                                            >
                                            @if (!$item['is_available'])
                                                <div class="absolute inset-0 bg-slate-900/45 flex items-center justify-center">
                                                    <span class="bg-rose-500/95 text-white text-[11px] font-black px-4 py-1.5 rounded-full uppercase tracking-wider shadow-md border border-white/20">
                                                        HABIS
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="p-4 flex-1 flex flex-col justify-between">
                                            <div>
                                                <h4 class="text-sm font-extrabold text-slate-900 group-hover:text-[#f15a29] transition-colors leading-snug">
                                                    {{ $item['name'] }}
                                                </h4>
                                                <p class="text-xs text-slate-500 line-clamp-1 mt-1 font-normal">
                                                    {{ $item['description'] }}
                                                </p>
                                            </div>

                                            <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between">
                                                <div class="text-base font-black text-slate-900">
                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </div>

                                                @if ($item['is_available'])
                                                    <div class="flex items-center bg-slate-100 rounded-xl p-1 border border-slate-200">
                                                        <button 
                                                            type="button" 
                                                            onclick="updateItemQty({{ $item['id'] }}, -1)" 
                                                            class="w-8 h-8 rounded-lg bg-white text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white transition-all text-base flex items-center justify-center shadow-xs cursor-pointer select-none leading-none"
                                                        >
                                                            -
                                                        </button>
                                                        <span class="w-8 text-center text-xs font-black text-slate-900 select-none" id="qty-val-{{ $item['id'] }}">0</span>
                                                        <button 
                                                            type="button" 
                                                            onclick="updateItemQty({{ $item['id'] }}, 1)" 
                                                            class="w-8 h-8 rounded-lg bg-white text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white transition-all text-base flex items-center justify-center shadow-xs cursor-pointer select-none leading-none"
                                                        >
                                                            +
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 text-slate-500 text-xs font-bold border border-slate-200 select-none shadow-2xs">
                                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                                        </svg>
                                                        <span>Stok sedang habis</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if (!$cemilanFound)
                                <div class="col-span-full py-6 text-center text-xs text-slate-400 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                    Belum ada menu cemilan di outlet ini.
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- Sticky Floating Bottom Cart Bar (Menggantikan Sidebar) -->
            <div id="bottomCartBar" class="fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-2xl py-3 px-4 sm:px-8 transition-all">
                <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5 min-w-0 flex-1">
                        <div class="w-11 h-11 rounded-2xl bg-orange-50 text-[#f15a29] border border-orange-200/80 flex items-center justify-center shrink-0 shadow-2xs">
                            <svg class="w-5 h-5 text-[#f15a29]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block" id="sidebarTitle">Pesanan:</span>
                                <span class="text-base sm:text-lg font-black text-slate-900" id="cartGrandTotalDisplay">Rp 0</span>
                                <span class="text-[11px] font-black text-[#f15a29] bg-orange-50 px-2 py-0.5 rounded-lg border border-orange-200/60" id="cartTotalItemsCount">0 Item</span>
                            </div>
                            <!-- Tulisan kecil warna abu daftar menu yang dipesan -->
                            <p class="text-[11px] text-slate-400 font-medium truncate max-w-xs sm:max-w-md md:max-w-xl mt-0.5" id="cartOrderedItemsPreview">
                                Belum ada menu yang dipilih
                            </p>
                        </div>
                    </div>

                    <!-- Hidden Cart Elements for JS compatibility -->
                    <div id="cartItemList" class="hidden"></div>
                    <div id="cartSubtotalDisplay" class="hidden"></div>
                    <div id="sidebarActionContainer" class="hidden"></div>

                    <button 
                        type="button" 
                        id="mainCheckoutButton"
                        onclick="handleMainProceed()"
                        class="px-5 sm:px-8 py-3.5 rounded-2xl bg-gradient-to-r from-orange-500 via-[#f15a29] to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-extrabold text-xs sm:text-sm shadow-lg shadow-orange-500/25 transition-all flex items-center gap-2 cursor-pointer shrink-0"
                    >
                        <span id="mainCheckoutText">Lanjut ke Pembayaran</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </div>

        </section>

    </main>


    <!-- ========================================================
         7. FOOTER
    ======================================================== -->
    <footer class="bg-white border-t border-slate-200/80 py-8 text-slate-500 text-xs mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2 font-bold text-slate-800">
                <span>Esa<span class="text-[#f15a29]">Corner</span></span>
                <span class="text-slate-300">•</span>
                <span class="text-xs text-slate-500 font-normal">Sistem Pemesanan Kantin Kampus Terpadu</span>
            </div>
            <div class="flex items-center gap-6 font-semibold">
                <a href="/" class="hover:text-slate-800">Beranda</a>
                <a href="/order/track" class="hover:text-slate-800">Pelacakan Pesanan</a>
                <a href="/admin" class="hover:text-slate-800">Admin Login</a>
            </div>
            <p class="text-slate-400">&copy; {{ date('Y') }} Kantin Kampus Terpadu. All rights reserved.</p>
        </div>
    </footer>


    <!-- ========================================================
         8. MODAL SCAN QRIS PEMBAYARAN (GOOGLE STITCH REDESIGN)
    ======================================================== -->
    <div class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-4 md:p-6 bg-slate-900/75 backdrop-blur-sm overflow-y-auto" id="qrisModal">
        <div class="bg-white rounded-3xl max-w-5xl w-full p-4 sm:p-6 md:p-8 shadow-2xl border border-slate-200 relative my-auto max-h-[92vh] overflow-y-auto space-y-6">
            
            <!-- 1. Top Notice Header Bar (Floating Pill Banner) -->
            <div class="bg-slate-50 border border-slate-200/90 rounded-2xl p-4 sm:p-5 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg font-black shrink-0">
                        ⇄
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-sm sm:text-base font-black text-slate-900">
                                Gerbang Pembayaran Otomatis QRIS Kantin
                            </h3>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[11px] font-black tracking-wide">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Mode QRIS BI Aktif
                            </span>
                        </div>
                        <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                            Verifikasi otomatis seketika melalui Bank Indonesia Fast & Jaringan GPN. Pesanan langsung dialihkan ke koki stan tanpa verifikasi manual.
                        </p>
                    </div>
                </div>

                <!-- Countdown Timer & Close Button -->
                <div class="flex items-center justify-between md:justify-end w-full md:w-auto gap-3 shrink-0">
                    <div class="bg-white border border-slate-200 px-3.5 py-2 rounded-xl text-xs font-black text-slate-700 flex items-center gap-1.5 shadow-2xs">
                        <span class="text-slate-400 font-normal">Sesi Berlaku:</span>
                        <span class="text-orange-600 font-black tracking-wider text-sm" id="qrisCountdownTimer">⏱️ 01:30</span>
                    </div>
                    <button 
                        type="button" 
                        onclick="closeQrisModal()" 
                        class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-400 hover:text-slate-800 flex items-center justify-center text-sm font-black transition-colors cursor-pointer"
                        title="Tutup Modal"
                    >
                        ✕
                    </button>
                </div>
            </div>

            <!-- 2. Two Columns Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- LEFT COLUMN: QR Frame & Action Buttons (lg:col-span-6) -->
                <div class="lg:col-span-6 bg-white border border-slate-200/90 rounded-3xl p-5 sm:p-6 shadow-xs space-y-5">
                    
                    <!-- QR Header: Official QRIS & GPN Logos -->
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-2">
                            <span class="bg-[#0f172a] text-white text-xs font-black px-2.5 py-1 rounded-md tracking-wider">QRIS</span>
                            <div class="leading-none">
                                <span class="text-[10px] font-black text-slate-800 uppercase tracking-wider block">QR CODE STANDAR</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">PEMBAYARAN NASIONAL</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="inline-flex items-center gap-1 bg-red-50 text-red-700 text-[10px] font-black px-2 py-0.5 rounded border border-red-200">
                                <span>GPN INDONESIA</span>
                            </div>
                            <span class="text-[9px] font-semibold text-slate-400 block mt-0.5">NMID: ID10243292017291</span>
                        </div>
                    </div>

                    <!-- Outlet & Stan Info -->
                    <div class="text-center space-y-0.5">
                        <h4 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Kantin Kampus Terpadu</h4>
                        <p class="text-xs font-bold text-slate-500" id="qrisStanSubtitle">
                            {{ $currMeta['stanCode'] }} ({{ $outletName }})
                        </p>
                    </div>

                    <!-- QR Box Centerpiece -->
                    <div class="bg-slate-50/80 border border-slate-200/90 rounded-2xl p-4 sm:p-6 text-center space-y-4">
                        <!-- QR Frame Container -->
                        <div class="w-56 h-56 sm:w-64 sm:h-64 mx-auto bg-white rounded-2xl p-3 border border-slate-200 shadow-sm flex items-center justify-center overflow-hidden relative group">
                            <img 
                                src="{{ asset($currMeta['image']) }}" 
                                id="qrisImageDisplay" 
                                alt="QRIS Kantin Kampus"
                                class="w-full h-full object-contain"
                            >
                        </div>

                        <!-- Nominal Total Box -->
                        <div class="space-y-1">
                            <span class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider block">
                                TOTAL NOMINAL PEMBAYARAN TEPAT:
                            </span>
                            <div class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight" id="qrisExactAmountDisplay">
                                Rp 0
                            </div>
                            <p class="text-[11px] text-slate-400 font-medium">
                                Sudah termasuk biaya transaksi merchant Rp 0
                            </p>
                        </div>
                    </div>

                    <!-- Action Button: Simpan QR -->
                    <div>
                        <button 
                            type="button" 
                            onclick="saveOrDownloadQrImage()"
                            class="w-full py-3 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold text-xs transition-colors flex items-center justify-center gap-1.5 cursor-pointer shadow-2xs"
                        >
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            <span>Simpan / Tangkapan QR</span>
                        </button>
                    </div>

                    <!-- Live Auto-Detection Status Ticker -->
                    <div class="bg-amber-50/80 border border-amber-200/80 rounded-2xl p-3.5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-sm font-black shrink-0">
                                <svg class="w-4 h-4 text-amber-700 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs font-black text-slate-900 block">Mengecek Pembayaran Otomatis...</span>
                                <span class="text-[11px] text-slate-500 font-medium block">Sistem mendeteksi mutasi mutakhir secara live tanpa upload struk</span>
                            </div>
                        </div>
                    </div>

                    <!-- Primary Confirm Button: Saya Sudah Membayar -->
                    <button 
                        type="button" 
                        id="btnConfirmQris"
                        onclick="confirmPaymentSuccess()"
                        class="w-full py-4 rounded-2xl bg-gradient-to-r from-orange-500 via-[#f15a29] to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-black text-sm shadow-lg shadow-orange-500/25 transition-all transform active:scale-[0.99] flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <span>✓</span>
                        <span>Saya Sudah Membayar / Cek Status Transaksi</span>
                    </button>

                    <!-- 256-bit BI Encryption Notice -->
                    <div class="flex items-center justify-center gap-2 text-center text-[11px] text-slate-400 font-medium">
                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v2H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-1V6a4 4 0 00-4-4zm2 6V6a2 2 0 10-4 0v2h4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Pembayaran Anda dilindungi sertifikasi enkripsi 256-bit standar Bank Indonesia.</span>
                    </div>

                    <!-- Compatible Banks & E-Wallets Badges -->
                    <div class="pt-3 border-t border-slate-100 space-y-2">
                        <div class="flex items-center justify-between text-[10px] font-black text-slate-400 uppercase tracking-wider">
                            <span>KOMPATIBEL DENGAN SELURUH APLIKASI PEMBAYARAN QRIS:</span>
                            <span class="text-emerald-600 font-bold">Bebas Admin</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-bold">BCA Mobile</span>
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-bold">Livin' Mandiri</span>
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-bold">BRImo</span>
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-bold">BNI Mobile</span>
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-bold">GoPay</span>
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-bold">OVO</span>
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-bold">DANA</span>
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-bold">ShopeePay</span>
                        </div>
                    </div>

                </div>


                <!-- RIGHT COLUMN: Order Identification, Participants & Guide (lg:col-span-6) -->
                <div class="lg:col-span-6 space-y-5">
                    
                    <!-- Identification Card -->
                    <div class="bg-white border border-slate-200/90 rounded-3xl p-5 sm:p-6 shadow-xs space-y-4">
                        
                        <!-- Identification Code & Status Pill -->
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div>
                                <span class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider block">IDENTIFIKASI PESANAN</span>
                                <span class="text-base sm:text-lg font-black text-slate-900 tracking-tight" id="qrisOrderTrxBadge">#TRX-KP9218</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-xs font-black">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Pembayaran
                            </span>
                        </div>

                        <!-- Service & Pick-up Method Info Box -->
                        <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3.5 space-y-2 text-xs">
                            <div class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-[#0875BD] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider block">Metode Konsumsi & Penyerahan:</span>
                                    <strong class="text-slate-900 font-extrabold block text-xs" id="qrisServiceDetailText">
                                        Makan di Tempat (Dine In) - Meja #04
                                    </strong>
                                </div>
                            </div>
                            <div class="flex items-start gap-2.5 pt-2 border-t border-slate-200/60">
                                <svg class="w-4 h-4 text-[#0875BD] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider block">Alur Pengambilan:</span>
                                    <span class="text-slate-700 font-semibold block text-xs">Ambil Mandiri di Etalase Konter Stan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Participants Breakdown (Solo or Split Bill) -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <h5 class="text-xs font-black text-slate-900 uppercase tracking-wider" id="qrisParticipantHeaderTitle">
                                        Pesan Bersama (3 Mahasiswa)
                                    </h5>
                                </div>
                                <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded" id="qrisParticipantSplitType">
                                    Patungan: Sesuai Pesanan
                                </span>
                            </div>

                            <!-- Dynamic Participant Cards Container -->
                            <div class="space-y-2.5 max-h-56 overflow-y-auto pr-1" id="qrisParticipantsListContainer">
                                <!-- Populated via JS -->
                            </div>
                        </div>

                        <!-- Financial Summary -->
                        <div class="pt-3 border-t border-slate-200/80 space-y-2 text-xs">
                            <div class="flex justify-between text-slate-600">
                                <span>Subtotal Makanan & Minuman:</span>
                                <span class="font-extrabold text-slate-800" id="qrisModalSubtotal">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-slate-600">
                                <span>Biaya Layanan Digital Kampus:</span>
                                <span class="font-bold text-emerald-600">GRATIS (Subsidi Kampus)</span>
                            </div>
                            <div class="flex justify-between items-baseline pt-2 border-t border-dashed border-slate-200">
                                <div>
                                    <span class="text-xs font-black text-slate-900 uppercase tracking-wider block">Total Tagihan Bersama:</span>
                                    <span class="text-[10px] text-slate-400 block">1 struk resmi terenkripsi</span>
                                </div>
                                <strong class="text-2xl font-black text-[#f15a29]" id="qrisModalGrandTotal">Rp 0</strong>
                            </div>
                        </div>

                    </div>

                    <!-- 3 Langkah Mudah Pembayaran QRIS Mahasiswa -->
                    <div class="bg-gradient-to-br from-slate-50 to-slate-100/80 border border-slate-200/90 rounded-3xl p-5 space-y-3.5 text-xs">
                        <div class="flex items-center gap-2 text-slate-900 font-black">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            <span>3 Langkah Mudah Pembayaran QRIS Mahasiswa</span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-slate-900 text-white font-black text-[10px] flex items-center justify-center shrink-0 mt-0.5">1</span>
                                <div>
                                    <strong class="text-slate-800 block text-xs">Buka Aplikasi Perbankan / E-Wallet</strong>
                                    <p class="text-[11px] text-slate-500 leading-relaxed">Pilih menu 'Pindai' atau 'Scan QRIS' pada ponsel Anda.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-slate-900 text-white font-black text-[10px] flex items-center justify-center shrink-0 mt-0.5">2</span>
                                <div>
                                    <strong class="text-slate-800 block text-xs">Arahkan Kamera ke Kode QR Di Samping</strong>
                                    <p class="text-[11px] text-slate-500 leading-relaxed">Pastikan nama penerima tertera Kantin Kampus Terpadu dan nominal tepat.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-slate-900 text-white font-black text-[10px] flex items-center justify-center shrink-0 mt-0.5">3</span>
                                <div>
                                    <strong class="text-slate-800 block text-xs">Dapatkan Nomor Antrean Etalase</strong>
                                    <p class="text-[11px] text-slate-500 leading-relaxed">Setelah berhasil, halaman ini otomatis berganti menjadi tiket panggilan konter untuk diambil mandiri.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>


    <!-- ========================================================
         9. MODAL SUKSES & PELACAKAN PESANAN REALTIME (GOOGLE STITCH SCREEN 3)
    ======================================================== -->
    <div class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-4 bg-slate-900/75 backdrop-blur-sm overflow-y-auto" id="orderSuccessModal">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 text-center space-y-5 my-auto max-h-[92vh] overflow-y-auto">
            
            <!-- Header: Panggilan Mandiri di Konter Stan -->
            <div class="space-y-1">
                <span class="text-[10px] font-black uppercase tracking-widest text-[#f15a29] block">
                    ● PANGGILAN MANDIRI DI KONTER STAN
                </span>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-100 rounded-full text-xs font-bold text-slate-700">
                    <span class="px-2 py-0.5 rounded-md bg-slate-900 text-white text-[10px] font-black" id="successStanBadge">
                        {{ $currMeta['stanCode'] }}
                    </span>
                    <span id="successOutletName">{{ $outletName }}</span>
                </div>
            </div>

            <!-- Big Queue Number Box -->
            <div class="bg-gradient-to-b from-orange-50/70 to-amber-50/40 border border-orange-200/80 rounded-3xl p-5 space-y-1 relative overflow-hidden">
                <span class="text-[11px] font-black text-slate-500 uppercase tracking-widest block">
                    NOMOR ANTREAN ANDA
                </span>
                <div class="text-5xl sm:text-6xl font-black text-[#f15a29] tracking-tight py-1" id="successQueueNumber">
                    #14
                </div>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-black">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span id="modal-status-text">Pembayaran QRIS Terverifikasi Lunas</span>
                </div>
            </div>

            <!-- QR Code for Counter Claim -->
            <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex items-center gap-4 text-left">
                <div class="w-16 h-16 bg-white p-1 rounded-xl border border-slate-200 shrink-0 shadow-2xs flex items-center justify-center">
                    <svg class="w-12 h-12 text-slate-800" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2 2h8v8H2V2zm2 2v4h4V4H4zm10-2h8v8h-8V2zm2 2v4h4V4h-4zM2 14h8v8H2v-8zm2 2v4h4v-4H4zm14 0h4v4h-4v-4zm-4 4h4v4h-4v-4zm0-4h4v-4h-4v4zm4-4h4v4h-4v-4zm-4-2h-2v4h2v-2h2v-2h-2z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-[10px] font-black uppercase text-orange-600 tracking-wider block">Kupon Klaim Pengambilan</span>
                    <p class="text-xs text-slate-600 font-semibold leading-snug mt-0.5">
                        Tunjukkan nomor antrean ini di kasir stan saat pesanan dipanggil.
                    </p>
                    <div class="mt-1 flex items-center gap-2">
                        <span class="text-xs font-black text-slate-800" id="success-order-code">ORD-XXXXXX</span>
                        <button type="button" onclick="copyOrderCodeFromModal()" class="text-[10px] text-blue-600 hover:underline font-bold cursor-pointer">Salin Kode</button>
                    </div>
                </div>
            </div>

            <!-- 3-Stage Kitchen Real-time Tracker -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-4 text-left space-y-3.5">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#0875BD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h5 class="text-xs font-black text-slate-900 uppercase tracking-wider">Pelacakan Dapur Real-Time</h5>
                    </div>
                    <span class="text-[10px] font-bold text-orange-600 bg-orange-50 px-2 py-0.5 rounded-full animate-pulse">
                        Estimasi: 8-15 mnt
                    </span>
                </div>

                <!-- Step 1: Diterima -->
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-full bg-emerald-500 text-white font-black text-xs flex items-center justify-center shrink-0 shadow-xs">
                        1
                    </div>
                    <div>
                        <strong class="text-xs font-black text-slate-900 block">1. Pesanan Diterima & Masuk Antrean</strong>
                        <p class="text-[11px] text-slate-500 leading-snug mt-0.5">
                            Dapur stan telah mengonfirmasi menu Anda dan menyiapkan bahan segar.
                        </p>
                    </div>
                </div>

                <!-- Step 2: Dimasak (Active with animated progress bar) -->
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-full bg-orange-500 text-white font-black text-xs flex items-center justify-center shrink-0 shadow-xs">
                        2
                    </div>
                    <div class="flex-1">
                        <strong class="text-xs font-black text-[#f15a29] block">2. Sedang Dimasak & Disiapkan Dapur</strong>
                        <p class="text-[11px] text-slate-500 leading-snug mt-0.5">
                            Pesanan sedang dimasak dadakan oleh koki stan dengan higienis.
                        </p>
                        <!-- Animated Progress Bar -->
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-orange-400 to-[#f15a29] h-1.5 rounded-full w-2/3 animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Siap Diambil -->
                <div class="flex items-start gap-3 opacity-60">
                    <div class="w-7 h-7 rounded-full bg-slate-200 text-slate-500 font-black text-xs flex items-center justify-center shrink-0">
                        3
                    </div>
                    <div>
                        <strong class="text-xs font-black text-slate-700 block">3. Siap Diambil di Etalase Pick-up</strong>
                        <p class="text-[11px] text-slate-400 leading-snug mt-0.5">
                            Notifikasi audio dan layar etalase konter akan memanggil nomor Anda.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Links -->
            <div class="space-y-2 pt-1">
                <a id="modal-track-link" href="/order/track" class="block w-full py-3.5 bg-[#f15a29] hover:bg-orange-600 text-white rounded-xl font-black text-xs sm:text-sm shadow-md shadow-orange-500/20 transition-all text-center">
                    Buka Halaman Pelacakan Lengkap &rarr;
                </a>
                <a id="modal-invoice-link" href="#" class="block w-full py-2.5 bg-orange-50 hover:bg-orange-100 text-[#ea580c] rounded-xl font-bold text-xs border border-orange-200 transition-colors text-center">
                    Lihat & Cetak Invoice Pembayaran
                </a>
                <button type="button" onclick="window.location.href='/'" class="w-full py-2 text-xs font-bold text-slate-500 hover:text-slate-800 cursor-pointer">
                    Kembali ke Beranda
                </button>
            </div>

        </div>
    </div>


    <!-- ========================================================
         JAVASCRIPT LOGIC
    ======================================================== -->
    <script>
        /* --- 1. Master Menu Data Initialization --- */
        const masterMenus = [];
        document.querySelectorAll('.menu-card-desktop').forEach(card => {
            masterMenus.push({
                id: parseInt(card.dataset.id),
                name: card.dataset.name,
                price: parseInt(card.dataset.price),
                image: card.dataset.image,
                desc: card.dataset.desc,
                category: card.dataset.cat,
                isAvailable: card.dataset.available === '1',
                qty: 0
            });
        });

        let friendsList = [];
        let activeFriendId = 1; // Default ke host (id: 1)
        let orderMode = localStorage.getItem('order_type') || 'solo';
        let serviceType = 'dine_in';
        let customerName = localStorage.getItem('customer_name') || 'Pelanggan';
        let outletName = @json($outlet->name ?? 'Esa Corner');
        let currentOutletId = @json($outlet->id ?? 1);
        let outletId = currentOutletId;
        let generatedOrderCode = 'ORD-' + Math.floor(100000 + Math.random() * 900000);

        document.addEventListener('DOMContentLoaded', () => {
            // Set nama pemesan
            const nameEl = document.getElementById('headerCustomerName');
            if (nameEl) nameEl.innerText = customerName;
            const hostEl = document.getElementById('group-host-name');
            if (hostEl) hostEl.innerText = `${customerName} (Host)`;

            // Inisialisasi daftar teman (Host otomatis ada)
            friendsList = [
                {
                    id: 1,
                    name: customerName + ' (Host)',
                    isHost: true,
                    orders: {} // { menuId: qty }
                }
            ];

            // Set mode awal
            setOrderMode(orderMode);

            // Auto select item if URL has ?item=...
            const urlParams = new URLSearchParams(window.location.search);
            const highlightName = urlParams.get('item') || localStorage.getItem('auto_add_item');
            if (highlightName) {
                localStorage.removeItem('auto_add_item');
                const target = masterMenus.find(m => 
                    m.name.toLowerCase().includes(highlightName.toLowerCase()) || 
                    highlightName.toLowerCase().includes(m.name.toLowerCase())
                );
                if (target) {
                    if (!target.isAvailable) {
                        alert(`Menu "${target.name}" saat ini sedang HABIS dan tidak dapat dipesan.`);
                    } else {
                        if (orderMode === 'group') {
                            openMenuForFriend(1);
                        }
                        updateItemQty(target.id, 1);
                        const card = document.querySelector(`.menu-card-desktop[data-id="${target.id}"]`);
                        if (card) {
                            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            card.classList.add('highlight-pulse');
                        }
                    }
                }
            }
        });

        /* --- 2. Switch Mode (Solo vs Split Bill) --- */
        function setOrderMode(mode) {
            orderMode = mode || 'solo';
            localStorage.setItem('order_type', orderMode);

            const btnSolo = document.getElementById('mode-btn-solo');
            const btnGroup = document.getElementById('mode-btn-group');
            const viewSplitFriends = document.getElementById('view-split-friends');
            const viewMenuCatalog = document.getElementById('view-menu-catalog');
            const splitActiveFriendHeader = document.getElementById('splitActiveFriendHeader');
            const sidebarTitle = document.getElementById('sidebarTitle');

            if (orderMode === 'solo') {
                if (btnSolo) btnSolo.className = 'px-3 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer bg-white text-slate-900 shadow-xs';
                if (btnGroup) btnGroup.className = 'px-3 py-1.5 rounded-xl text-xs font-bold text-slate-600 hover:text-slate-900 transition-all flex items-center gap-1.5 cursor-pointer';

                // Tampilkan langsung katalog menu solo
                if (viewSplitFriends) viewSplitFriends.classList.add('hidden');
                if (viewMenuCatalog) viewMenuCatalog.classList.remove('hidden');
                if (splitActiveFriendHeader) splitActiveFriendHeader.classList.add('hidden');

                // Tampilkan bottom bar checkout untuk mode solo
                const bottomCartBar = document.getElementById('bottomCartBar');
                if (bottomCartBar) bottomCartBar.classList.remove('hidden');

                if (sidebarTitle) sidebarTitle.innerText = 'Pesanan:';
                updateSidebarActionButton(false);

                syncBadgesSolo();
                recalculateCart();
            } else {
                if (btnGroup) btnGroup.className = 'px-3 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer bg-white text-slate-900 shadow-xs';
                if (btnSolo) btnSolo.className = 'px-3 py-1.5 rounded-xl text-xs font-bold text-slate-600 hover:text-slate-900 transition-all flex items-center gap-1.5 cursor-pointer';

                // Di mode Split Bill: Default buka Halaman Atur Teman (View Split Friends)
                if (viewSplitFriends) viewSplitFriends.classList.remove('hidden');
                if (viewMenuCatalog) viewMenuCatalog.classList.add('hidden');
                if (splitActiveFriendHeader) splitActiveFriendHeader.classList.add('hidden');

                // Sembunyikan bottom bar saat di halaman daftar teman agar fokus ke ringkasan sesi & tombol bayar sesi bersama
                const bottomCartBar = document.getElementById('bottomCartBar');
                if (bottomCartBar) bottomCartBar.classList.add('hidden');

                renderFriendsBubbles();
                recalculateSplitGrandTotal();
            }
        }

        /* --- 3. Split Bill: Tambah Nama Teman (Memunculkan Bubble) --- */
        function handleFriendInputKey(e) {
            if (e.key === 'Enter') {
                addFriendFromInput();
            }
        }

        function addFriendFromInput() {
            const input = document.getElementById('inputNamaTemanSplit');
            const name = input.value.trim();
            if (!name) return;

            const newFriend = {
                id: Date.now(),
                name: name,
                isHost: false,
                orders: {}
            };

            friendsList.push(newFriend);
            input.value = '';

            renderFriendsBubbles();
            recalculateSplitGrandTotal();
        }

        function removeFriend(id) {
            friendsList = friendsList.filter(f => f.id !== id);
            renderFriendsBubbles();
            recalculateSplitGrandTotal();
        }

        /* --- 4. Render Bubble Kartu Teman Beserta Ringkasan dan Tombol Pilih Menu --- */
        function renderFriendsBubbles() {
            const grid = document.getElementById('friendsBubbleGrid');
            const countBadge = document.getElementById('splitFriendsCountBadge');
            if (countBadge) countBadge.innerText = `${friendsList.length} Teman Terdaftar`;

            if (!grid) return;

            grid.innerHTML = friendsList.map(f => {
                let friendSub = 0;
                let itemsListHtml = '';
                const entries = Object.entries(f.orders || {});

                if (entries.length === 0) {
                    itemsListHtml = '<div class="text-slate-400 text-xs italic py-2">Belum ada makanan yang dipilih</div>';
                } else {
                    itemsListHtml = entries.map(([menuId, qty]) => {
                        const m = masterMenus.find(item => item.id === parseInt(menuId));
                        if (!m || qty <= 0) return '';
                        const sub = m.price * qty;
                        friendSub += sub;
                        return `
                            <div class="flex justify-between items-center text-xs py-1 border-b border-slate-100">
                                <span class="font-bold text-slate-800">${m.name} (${qty}x)</span>
                                <span class="text-slate-600 font-semibold">Rp ${sub.toLocaleString('id-ID')}</span>
                            </div>
                        `;
                    }).join('');
                }

                const hasItems = entries.length > 0;

                return `
                    <div class="bg-white rounded-3xl border border-slate-200/90 p-5 shadow-xs hover:shadow-md transition-all flex flex-col justify-between space-y-4">
                        <div>
                            <!-- Header Bubble: Avatar & Nama -->
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-10 h-10 rounded-2xl ${f.isHost ? 'bg-orange-500 text-white' : 'bg-blue-600 text-white'} flex items-center justify-center font-black text-sm shadow-xs">
                                        ${f.name.trim().charAt(0).toUpperCase()}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-slate-900">${f.name}</h4>
                                        <span class="text-[11px] font-bold ${hasItems ? 'text-emerald-600' : 'text-slate-400'}">
                                            ${hasItems ? '✓ Sudah Memilih Menu' : 'Menunggu Pilihan Menu'}
                                        </span>
                                    </div>
                                </div>
                                ${!f.isHost ? `<button type="button" onclick="removeFriend(${f.id})" class="text-slate-300 hover:text-red-500 font-black p-1 text-sm cursor-pointer" title="Hapus">✕</button>` : ''}
                            </div>

                            <!-- List Pesanan Teman Ini (Ringkasan pada Bubble) -->
                            <div class="pt-3 space-y-1">
                                <span class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider block mb-1">Daftar Makanan:</span>
                                ${itemsListHtml}
                            </div>
                        </div>

                        <!-- Subtotal & Tombol Masuk ke Halaman Menu Teman -->
                        <div class="pt-3 border-t border-slate-100 space-y-3">
                            <div class="flex justify-between items-baseline text-xs">
                                <span class="font-bold text-slate-500 uppercase text-[11px]">Subtotal:</span>
                                <strong class="text-base font-black text-[#f15a29]">Rp ${friendSub.toLocaleString('id-ID')}</strong>
                            </div>

                            <!-- Tombol ini yang membuka halaman menu untuk teman ini -->
                            <button 
                                type="button" 
                                onclick="openMenuForFriend(${f.id})"
                                class="w-full py-3 rounded-xl bg-orange-50 hover:bg-[#f15a29] text-[#ea580c] hover:text-white font-extrabold text-xs border border-orange-200/80 hover:border-transparent transition-all flex items-center justify-center gap-2 shadow-xs cursor-pointer"
                            >
                                <span>${hasItems ? '✎ Ubah Menu ' + f.name : ' Pilih Menu untuk ' + f.name}</span>
                                <span>&rarr;</span>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        /* --- 5. Masuk ke Halaman Menu Teman ("beda halaman") --- */
        function openMenuForFriend(friendId) {
            activeFriendId = friendId;
            const friend = friendsList.find(f => f.id === friendId) || friendsList[0];

            // Sembunyikan halaman atur teman, buka halaman katalog menu
            document.getElementById('view-split-friends').classList.add('hidden');
            document.getElementById('view-menu-catalog').classList.remove('hidden');

            // Aktifkan banner atas khusus teman
            const header = document.getElementById('splitActiveFriendHeader');
            if (header) {
                header.classList.remove('hidden');
                const nameEl = document.getElementById('activeFriendHeadingName');
                if (nameEl) nameEl.innerText = friend.name;
            }

            // Tampilkan bottom bar untuk menu teman yang sedang dipilih
            const bottomCartBar = document.getElementById('bottomCartBar');
            if (bottomCartBar) bottomCartBar.classList.remove('hidden');

            // Update title sidebar & tombol aksi menjadi Simpan Pesanan & Selesai
            const sidebarTitle = document.getElementById('sidebarTitle');
            if (sidebarTitle) sidebarTitle.innerText = `Menu ${friend.name}:`;
            updateSidebarActionButton(true, friend.name);

            // Sync kuantitas tombol - + sesuai pesanan teman ini
            syncBadgesForActiveFriend();
            recalculateCart();

            // Scroll ke atas halaman katalog menu
            document.getElementById('view-menu-catalog').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function returnToSplitFriendsView() {
            // Kembali ke halaman daftar teman (View Split Friends)
            document.getElementById('view-split-friends').classList.remove('hidden');
            document.getElementById('view-menu-catalog').classList.add('hidden');
            const header = document.getElementById('splitActiveFriendHeader');
            if (header) header.classList.add('hidden');

            // Sembunyikan bottom bar di halaman daftar teman agar tidak bingung dengan tombol bayar utama
            const bottomCartBar = document.getElementById('bottomCartBar');
            if (bottomCartBar) bottomCartBar.classList.add('hidden');

            // Render ulang bubble teman agar ringkasannya langsung ter-update
            renderFriendsBubbles();
            recalculateSplitGrandTotal();

            // Scroll ke bagian daftar teman
            document.getElementById('view-split-friends').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function updateSidebarActionButton(isFriendMenu, friendName = '') {
            const btn = document.getElementById('mainCheckoutButton');
            const textSpan = document.getElementById('mainCheckoutText');
            if (!btn) return;

            if (isFriendMenu) {
                if (textSpan) textSpan.innerText = '✓ Simpan Pesanan & Selesai';
                btn.onclick = returnToSplitFriendsView;
                btn.className = 'px-5 sm:px-8 py-3.5 rounded-2xl bg-gradient-to-r from-orange-500 via-[#f15a29] to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-extrabold text-xs sm:text-sm shadow-lg shadow-orange-500/25 transition-all flex items-center gap-2 cursor-pointer shrink-0';
            } else {
                if (textSpan) textSpan.innerText = 'Lanjut ke Pembayaran';
                btn.onclick = handleMainProceed;
                btn.className = 'px-5 sm:px-8 py-3.5 rounded-2xl bg-gradient-to-r from-orange-500 via-[#f15a29] to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-extrabold text-xs sm:text-sm shadow-lg shadow-orange-500/25 transition-all flex items-center gap-2 cursor-pointer shrink-0';
            }
        }

        /* --- 6. Stepper (- dan +) untuk Menambah/Mengurangi Menu --- */
        function updateItemQty(menuId, change) {
            const item = masterMenus.find(m => m.id === menuId);
            if (!item) return;

            if (!item.isAvailable && change > 0) {
                alert(`Maaf, menu "${item.name}" saat ini sedang HABIS.`);
                return;
            }

            if (orderMode === 'solo') {
                item.qty = Math.max(0, item.qty + change);
                const badge = document.getElementById(`qty-val-${menuId}`);
                if (badge) badge.innerText = item.qty;
            } else {
                // Di mode Split Bill: Catat untuk teman yang sedang aktif
                const activeFriend = friendsList.find(f => f.id === activeFriendId);
                if (!activeFriend) return;

                activeFriend.orders = activeFriend.orders || {};
                const currentQty = activeFriend.orders[menuId] || 0;
                const newQty = Math.max(0, currentQty + change);

                if (newQty === 0) {
                    delete activeFriend.orders[menuId];
                } else {
                    activeFriend.orders[menuId] = newQty;
                }

                const badge = document.getElementById(`qty-val-${menuId}`);
                if (badge) badge.innerText = newQty;

                // Update text counter di banner atas teman
                const totalFriendItems = Object.values(activeFriend.orders).reduce((a, b) => a + b, 0);
                const statusLabel = document.getElementById('activeFriendStatusItems');
                if (statusLabel) statusLabel.innerText = `${totalFriendItems} Menu Dipilih`;
            }

            recalculateCart();
        }

        function syncBadgesForActiveFriend() {
            const activeFriend = friendsList.find(f => f.id === activeFriendId);
            masterMenus.forEach(m => {
                const badge = document.getElementById(`qty-val-${m.id}`);
                if (badge) {
                    const friendQty = (activeFriend && activeFriend.orders && activeFriend.orders[m.id]) || 0;
                    badge.innerText = friendQty;
                }
            });

            if (activeFriend) {
                const totalFriendItems = Object.values(activeFriend.orders || {}).reduce((a, b) => a + b, 0);
                const statusLabel = document.getElementById('activeFriendStatusItems');
                if (statusLabel) statusLabel.innerText = `${totalFriendItems} Menu Dipilih`;
            }
        }

        function syncBadgesSolo() {
            masterMenus.forEach(m => {
                const badge = document.getElementById(`qty-val-${m.id}`);
                if (badge) {
                    badge.innerText = m.qty;
                }
            });
        }

        /* --- 7. Hitung Total Keranjang di Sidebar & Bawah --- */
        function recalculateCart() {
            let totalCount = 0;
            let totalPrice = 0;
            const listEl = document.getElementById('cartItemList');
            const emptyEl = document.getElementById('emptyCartNotice');

            let cartHtml = '';
            let orderedSummaries = [];

            if (orderMode === 'solo') {
                masterMenus.filter(m => m.qty > 0).forEach(m => {
                    totalCount += m.qty;
                    const sub = m.price * m.qty;
                    totalPrice += sub;
                    orderedSummaries.push(`${m.name} (${m.qty}x)`);

                    cartHtml += `
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-200/70 text-xs">
                            <div class="flex-1 pr-2">
                                <span class="font-extrabold text-slate-800 block">${m.name}</span>
                                <span class="text-slate-400 text-[11px]">Rp ${m.price.toLocaleString('id-ID')} x ${m.qty}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <strong class="text-slate-900 font-bold">Rp ${sub.toLocaleString('id-ID')}</strong>
                                <div class="flex items-center bg-white rounded-md border border-slate-200 p-0.5">
                                    <button type="button" onclick="updateItemQty(${m.id}, -1)" class="w-6 h-6 rounded text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white text-xs flex items-center justify-center cursor-pointer select-none leading-none">-</button>
                                    <button type="button" onclick="updateItemQty(${m.id}, 1)" class="w-6 h-6 rounded text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white text-xs flex items-center justify-center cursor-pointer select-none leading-none">+</button>
                                </div>
                            </div>
                        </div>
                    `;
                });
            } else {
                // Mode Split Bill: Hitung pesanan khusus untuk teman yang sedang aktif memilih
                const activeFriend = friendsList.find(f => f.id === activeFriendId);
                if (activeFriend) {
                    Object.entries(activeFriend.orders || {}).forEach(([menuId, qty]) => {
                        const m = masterMenus.find(item => item.id === parseInt(menuId));
                        if (m && qty > 0) {
                            totalCount += qty;
                            const sub = m.price * qty;
                            totalPrice += sub;
                            orderedSummaries.push(`${m.name} (${qty}x)`);

                            cartHtml += `
                                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-200/70 text-xs">
                                    <div class="flex-1 pr-2">
                                        <span class="font-extrabold text-slate-800 block">${m.name}</span>
                                        <span class="text-slate-400 text-[11px]">Rp ${m.price.toLocaleString('id-ID')} x ${qty}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <strong class="text-slate-900 font-bold">Rp ${sub.toLocaleString('id-ID')}</strong>
                                        <div class="flex items-center bg-white rounded-md border border-slate-200 p-0.5">
                                            <button type="button" onclick="updateItemQty(${m.id}, -1)" class="w-6 h-6 rounded text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white text-xs flex items-center justify-center cursor-pointer select-none leading-none">-</button>
                                            <button type="button" onclick="updateItemQty(${m.id}, 1)" class="w-6 h-6 rounded text-slate-800 font-extrabold hover:bg-orange-500 hover:text-white text-xs flex items-center justify-center cursor-pointer select-none leading-none">+</button>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    });
                }
            }

            if (emptyEl && listEl) {
                if (totalCount > 0) {
                    emptyEl.classList.add('hidden');
                    listEl.innerHTML = cartHtml;
                } else {
                    emptyEl.classList.remove('hidden');
                    listEl.innerHTML = '';
                    listEl.appendChild(emptyEl);
                }
            } else if (listEl) {
                listEl.innerHTML = cartHtml;
            }

            // Update Preview Text Daftar Menu Yang Dipesan (Warna Abu Kecil)
            const previewEl = document.getElementById('cartOrderedItemsPreview');
            if (previewEl) {
                if (orderedSummaries.length > 0) {
                    previewEl.innerText = orderedSummaries.join(', ');
                    previewEl.title = orderedSummaries.join(', ');
                } else {
                    previewEl.innerText = 'Belum ada menu yang dipilih';
                    previewEl.title = '';
                }
            }

            const countEl = document.getElementById('cartTotalItemsCount');
            if (countEl) countEl.innerText = `${totalCount} Item`;

            const subEl = document.getElementById('cartSubtotalDisplay');
            if (subEl) subEl.innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;

            const grandEl = document.getElementById('cartGrandTotalDisplay');
            if (grandEl) grandEl.innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        }

        function recalculateSplitGrandTotal() {
            let total = 0;
            let itemsCount = 0;

            friendsList.forEach(f => {
                Object.entries(f.orders || {}).forEach(([menuId, qty]) => {
                    const m = masterMenus.find(item => item.id === parseInt(menuId));
                    if (m && qty > 0) {
                        itemsCount += qty;
                        total += m.price * qty;
                    }
                });
            });

            const bottomTotal = document.getElementById('splitGrandTotalBottom');
            if (bottomTotal) bottomTotal.innerText = `Rp ${total.toLocaleString('id-ID')}`;
            const bottomCount = document.getElementById('splitTotalItemsBottom');
            if (bottomCount) bottomCount.innerText = `${itemsCount} menu dipesan oleh semua teman`;
            recalculateCart();
        }

        /* --- 8. Service Type (Dine In / Take Away) --- */
        function setServiceType(type) {
            serviceType = type;
            const dineBtn = document.getElementById('service-btn-dine-in');
            const takeBtn = document.getElementById('service-btn-take-away');
            const tableWrap = document.getElementById('tableNumberWrap');

            const activeClass = 'flex-1 sm:flex-initial px-4 py-1.5 rounded-full text-xs font-bold transition-all bg-[#f15a29] text-white shadow-xs cursor-pointer select-none';
            const inactiveClass = 'flex-1 sm:flex-initial px-4 py-1.5 rounded-full text-xs font-semibold bg-transparent text-[#475569] hover:text-[#f15a29] transition-all cursor-pointer select-none';

            if (type === 'dine_in') {
                dineBtn.className = activeClass;
                takeBtn.className = inactiveClass;
                if (tableWrap) tableWrap.classList.remove('hidden');
            } else {
                takeBtn.className = activeClass;
                dineBtn.className = inactiveClass;
                if (tableWrap) tableWrap.classList.add('hidden');
            }
        }

        /* --- 9. Filter & Search --- */
        function filterCategory(cat) {
            document.querySelectorAll('.category-pill').forEach(btn => {
                btn.className = 'category-pill px-4 py-1.5 rounded-full bg-transparent text-[#475569] hover:text-[#101735] hover:bg-white/60 font-medium transition-all cursor-pointer shrink-0 text-xs sm:text-sm select-none';
            });
            const activeBtn = document.getElementById(`cat-pill-${cat}`);
            if (activeBtn) {
                activeBtn.className = 'category-pill px-4 py-1.5 rounded-full bg-white text-[#F15A29] font-semibold shadow-2xs transition-all cursor-pointer shrink-0 text-xs sm:text-sm select-none';
            }

            const sections = document.querySelectorAll('.menu-section-group');
            sections.forEach(sec => {
                if (cat === 'semua' || sec.id === `sec-${cat}`) {
                    sec.style.display = 'block';
                } else {
                    sec.style.display = 'none';
                }
            });

            const cards = document.querySelectorAll('.menu-card-desktop');
            cards.forEach(card => {
                const cardCat = card.getAttribute('data-cat') || '';
                if (cat === 'semua' || cardCat === cat) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function handleMenuSearch(keyword) {
            const clean = keyword.toLowerCase().trim();
            const cards = document.querySelectorAll('.menu-card-desktop');

            cards.forEach(card => {
                const name = (card.getAttribute('data-name') || '').toLowerCase();
                const desc = (card.getAttribute('data-desc') || '').toLowerCase();
                if (clean === '' || name.includes(clean) || desc.includes(clean)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function shareBillToWhatsapp() {
            let total = 0;
            let text = `🧾 *TAGIHAN SPLIT BILL - ${outletName.toUpperCase()}*\n`;
            text += `Layanan: ${serviceType === 'dine_in' ? 'Makan di Tempat' : 'Bawa Pulang'}\n`;
            text += `------------------------------------\n`;

            friendsList.forEach(f => {
                let sub = 0;
                let items = [];
                Object.entries(f.orders || {}).forEach(([menuId, qty]) => {
                    const m = masterMenus.find(item => item.id === parseInt(menuId));
                    if (m && qty > 0) {
                        sub += m.price * qty;
                        items.push(`${m.name} (${qty}x)`);
                    }
                });
                total += sub;
                text += `👤 *${f.name}*: Rp ${sub.toLocaleString('id-ID')}\n`;
                if (items.length > 0) text += `   ↳ ${items.join(', ')}\n`;
            });

            text += `------------------------------------\n`;
            text += `💰 *TOTAL BERSAMA: Rp ${total.toLocaleString('id-ID')}*\n`;
            text += `Silakan transfer sesuai pesanan masing-masing yaa 🙌`;

            window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(text)}`, '_blank');
        }

        /* --- 10. Checkout & Pembayaran di Halaman Baru --- */
        function handleMainProceed() {
            let totalQty = 0;
            let cartPayload = [];

            if (orderMode === 'solo') {
                totalQty = masterMenus.reduce((sum, m) => sum + m.qty, 0);
                cartPayload = masterMenus.filter(m => m.qty > 0).map(m => ({
                    id: m.id,
                    menu_id: m.id,
                    name: m.name,
                    price: m.price,
                    quantity: m.qty,
                    image: m.image,
                    customer_name: customerName
                }));
            } else {
                // Mode Split Bill:
                // Cek apakah ada teman yang belum memilih makanan
                const unpickedFriends = friendsList.filter(f => !f.orders || Object.keys(f.orders).length === 0 || Object.values(f.orders).reduce((sum, q) => sum + q, 0) === 0);
                if (unpickedFriends.length > 0) {
                    const unpickedNames = unpickedFriends.map(f => f.name).join(', ');
                    const proceed = confirm(`Ada teman yang belum memilih makanan:\n👉 ${unpickedNames}\n\nApakah Anda yakin ingin lanjut bayar sekarang untuk pesanan yang sudah ada?`);
                    if (!proceed) return;
                }

                friendsList.forEach(f => {
                    Object.entries(f.orders || {}).forEach(([menuId, qty]) => {
                        const m = masterMenus.find(item => item.id === parseInt(menuId));
                        if (m && qty > 0) {
                            totalQty += qty;
                            cartPayload.push({
                                id: m.id,
                                menu_id: m.id,
                                name: m.name,
                                price: m.price,
                                quantity: qty,
                                image: m.image,
                                customer_name: f.name
                            });
                        }
                    });
                });
            }

            if (totalQty === 0) {
                alert('Belum ada pesanan yang dipilih! Silakan klik "Pilih Menu" pada nama teman terlebih dahulu.');
                return;
            }

            // Simpan data pesanan ke localStorage & buka halaman baru pembayaran
            localStorage.setItem('checkout_cart_items', JSON.stringify(cartPayload));
            const tableVal = document.getElementById('tableNumberInput')?.value.trim() || '';
            localStorage.setItem('table_number', tableVal);
            localStorage.setItem('service_type', serviceType);
            localStorage.setItem('order_type', orderMode);
            localStorage.setItem('customer_name', customerName);

            // Redirect ke Halaman Baru Pembayaran QRIS (bukan popup)
            const targetOutletId = {{ $outletId }};
            window.location.href = `/menu/${targetOutletId}/pembayaran`;
        }

        let qrisCountdownSeconds = 90; // 01:30

        function openQrisModal() {
            // 1. Set Identifikasi & Service Info
            const trxCode = '#TRX-' + (generatedOrderCode.replace('ORD-', '') || 'KP9218');
            const trxEl = document.getElementById('qrisOrderTrxBadge');
            if (trxEl) trxEl.innerText = trxCode;

            const stanSub = document.getElementById('qrisStanSubtitle');
            if (stanSub) stanSub.innerText = `${@json($currMeta['stanCode'])} (${outletName})`;

            const tableNoInput = document.getElementById('tableNumberInput');
            const tableNo = tableNoInput ? tableNoInput.value.trim() : '';
            const tableText = tableNo ? ` - Meja #${tableNo}` : (serviceType === 'dine_in' ? ' - Meja #04' : '');
            const serviceLabel = serviceType === 'dine_in' ? `Makan di Tempat (Dine In)${tableText}` : 'Bungkus / Bawa Pulang (Take Away)';
            const serviceDetailEl = document.getElementById('qrisServiceDetailText');
            if (serviceDetailEl) serviceDetailEl.innerText = serviceLabel;

            // 2. Countdown Timer (01:30)
            if (window.qrisInterval) clearInterval(window.qrisInterval);
            qrisCountdownSeconds = 90;
            const timerEl = document.getElementById('qrisCountdownTimer');
            function updateTimer() {
                const m = Math.floor(qrisCountdownSeconds / 60);
                const s = qrisCountdownSeconds % 60;
                if (timerEl) {
                    timerEl.innerText = `⏱️ ${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
                }
                if (qrisCountdownSeconds <= 0) {
                    clearInterval(window.qrisInterval);
                } else {
                    qrisCountdownSeconds--;
                }
            }
            updateTimer();
            window.qrisInterval = setInterval(updateTimer, 1000);

            // 3. Rincian Partisipan & Tagihan
            const container = document.getElementById('qrisParticipantsListContainer');
            const titleEl = document.getElementById('qrisParticipantHeaderTitle');
            const splitTypeEl = document.getElementById('qrisParticipantSplitType');
            let grandTotal = 0;

            if (orderMode === 'solo') {
                if (titleEl) titleEl.innerText = 'Pesanan Anda';
                if (splitTypeEl) splitTypeEl.innerText = 'Pesan Sendiri';

                let itemsHtml = '';
                masterMenus.filter(m => m.qty > 0).forEach(m => {
                    const sub = m.price * m.qty;
                    grandTotal += sub;
                    itemsHtml += `
                        <div class="flex justify-between items-center text-xs py-1 border-b border-slate-100 last:border-0">
                            <span class="font-bold text-slate-800">${m.name} (${m.qty}x)</span>
                            <span class="font-extrabold text-slate-700">Rp ${sub.toLocaleString('id-ID')}</span>
                        </div>
                    `;
                });

                if (container) {
                    container.innerHTML = `
                        <div class="bg-slate-50 border border-slate-200/90 rounded-2xl p-3.5 space-y-2">
                            <div class="flex items-center justify-between pb-2 border-b border-slate-200/70">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-xl bg-orange-500 text-white font-black text-xs flex items-center justify-center shadow-xs">
                                        ${customerName.charAt(0).toUpperCase()}
                                    </div>
                                    <div>
                                        <strong class="text-xs font-black text-slate-900 block leading-none">${customerName}</strong>
                                        <span class="text-[10px] text-slate-400 font-bold">Pelanggan Utama</span>
                                    </div>
                                </div>
                                <strong class="text-xs font-black text-[#f15a29]">Rp ${grandTotal.toLocaleString('id-ID')}</strong>
                            </div>
                            <div class="space-y-1">
                                ${itemsHtml || '<span class="text-slate-400 text-xs italic">Belum ada makanan yang dipilih</span>'}
                            </div>
                        </div>
                    `;
                }
            } else {
                if (titleEl) titleEl.innerText = `Pesan Bersama (${friendsList.length} Mahasiswa)`;
                if (splitTypeEl) splitTypeEl.innerText = 'Patungan: Sesuai Pesanan';

                const cardsHtml = friendsList.map((f, idx) => {
                    let fSub = 0;
                    let itemsHtml = '';
                    const entries = Object.entries(f.orders || {});
                    entries.forEach(([menuId, qty]) => {
                        const m = masterMenus.find(item => item.id === parseInt(menuId));
                        if (m && qty > 0) {
                            const sub = m.price * qty;
                            fSub += sub;
                            itemsHtml += `
                                <div class="flex justify-between items-center text-xs py-1 border-b border-slate-100 last:border-0">
                                    <span class="font-bold text-slate-800">${m.name} (${qty}x)</span>
                                    <span class="font-extrabold text-slate-700">Rp ${sub.toLocaleString('id-ID')}</span>
                                </div>
                            `;
                        }
                    });

                    grandTotal += fSub;
                    const initial = f.name.replace(/[^a-zA-Z]/g, '').charAt(0).toUpperCase() || 'T';
                    const avatarBg = f.isHost ? 'bg-orange-500' : (idx % 2 === 0 ? 'bg-blue-600' : 'bg-purple-600');

                    return `
                        <div class="bg-slate-50 border border-slate-200/90 rounded-2xl p-3.5 space-y-2">
                            <div class="flex items-center justify-between pb-2 border-b border-slate-200/70">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-xl ${avatarBg} text-white font-black text-xs flex items-center justify-center shadow-xs">
                                        ${initial}
                                    </div>
                                    <div>
                                        <strong class="text-xs font-black text-slate-900 block leading-none">${f.name}</strong>
                                        <span class="text-[10px] ${f.isHost ? 'text-orange-600 font-extrabold' : 'text-slate-400 font-bold'}">
                                            ${f.isHost ? 'Pemrakarsa (Host)' : 'Teman Patungan'}
                                        </span>
                                    </div>
                                </div>
                                <strong class="text-xs font-black text-[#f15a29]">Rp ${fSub.toLocaleString('id-ID')}</strong>
                            </div>
                            <div class="space-y-1">
                                ${itemsHtml || '<span class="text-slate-400 text-xs italic">Belum memilih menu</span>'}
                            </div>
                        </div>
                    `;
                }).join('');

                if (container) container.innerHTML = cardsHtml;
            }

            // 4. Update Angka Nominal di Modal
            const amountStr = `Rp ${grandTotal.toLocaleString('id-ID')}`;
            const exactEl = document.getElementById('qrisExactAmountDisplay');
            if (exactEl) exactEl.innerText = amountStr;
            const subtotalEl = document.getElementById('qrisModalSubtotal');
            if (subtotalEl) subtotalEl.innerText = amountStr;
            const grandTotalEl = document.getElementById('qrisModalGrandTotal');
            if (grandTotalEl) grandTotalEl.innerText = amountStr;

            // 5. Buka Modal QRIS
            const modal = document.getElementById('qrisModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeQrisModal() {
            if (window.qrisInterval) clearInterval(window.qrisInterval);
            const modal = document.getElementById('qrisModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function saveOrDownloadQrImage() {
            const img = document.getElementById('qrisImageDisplay');
            if (img && img.src) {
                const a = document.createElement('a');
                a.href = img.src;
                a.download = `QRIS-${outletName.replace(/\s+/g, '-')}.png`;
                a.target = '_blank';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }
        }

        async function confirmPaymentSuccess() {
            closeQrisModal();

            let payloadItems = [];
            let grandTotal = 0;

            if (orderMode === 'solo') {
                masterMenus.filter(m => m.qty > 0).forEach(m => {
                    payloadItems.push({
                        menu_id: m.id,
                        customer_name: customerName,
                        quantity: m.qty,
                        price: m.price
                    });
                    grandTotal += m.price * m.qty;
                });
            } else {
                friendsList.forEach(f => {
                    Object.entries(f.orders || {}).forEach(([menuId, qty]) => {
                        const m = masterMenus.find(item => item.id === parseInt(menuId));
                        if (m && qty > 0) {
                            payloadItems.push({
                                menu_id: m.id,
                                customer_name: f.name,
                                quantity: qty,
                                price: m.price
                            });
                            grandTotal += m.price * qty;
                        }
                    });
                });
            }

            const tableNo = document.getElementById('tableNumberInput') ? document.getElementById('tableNumberInput').value.trim() : '';

            const payload = {
                outlet_id: currentOutletId,
                order_type: orderMode,
                service_type: serviceType,
                table_number: tableNo,
                status: 'paid',
                items: payloadItems
            };

            try {
                const res = await fetch('/order/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ request()->hasSession() ? csrf_token() : '' }}'
                    },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                const code = data.order_code || generatedOrderCode;
                openTrackingModal(code, grandTotal, data.order_id);
            } catch (e) {
                console.error('Order store error:', e);
                openTrackingModal(generatedOrderCode, grandTotal, null);
            }
        }

        function openTrackingModal(code, total, orderId) {
            // Set Nomor Antrean besar (misal #14 seperti di Stitch)
            const queueNum = orderId ? ('#' + (orderId % 90 + 10)) : ('#' + Math.floor(10 + Math.random() * 40));
            const queueEl = document.getElementById('successQueueNumber');
            if (queueEl) queueEl.innerText = queueNum;

            const codeEl = document.getElementById('success-order-code');
            if (codeEl) codeEl.innerText = code;

            const trackLink = document.getElementById('modal-track-link');
            if (trackLink) trackLink.href = `/order/track/${code}`;
            const invLink = document.getElementById('modal-invoice-link');
            if (invLink) invLink.href = `/order/invoice/${code}`;

            try {
                localStorage.setItem('esa_last_order_code', code);
                let recent = JSON.parse(localStorage.getItem('esa_recent_orders') || '[]');
                recent = recent.filter(o => o.code !== code);
                recent.unshift({
                    code: code,
                    outlet: outletName,
                    total: `Rp ${total.toLocaleString('id-ID')}`,
                    queue: queueNum,
                    status: 'paid'
                });
                localStorage.setItem('esa_recent_orders', JSON.stringify(recent));
            } catch(e) {}

            const successModal = document.getElementById('orderSuccessModal');
            if (successModal) {
                successModal.classList.remove('hidden');
                successModal.classList.add('flex');
            }
        }

        function copyOrderCodeFromModal() {
            const codeEl = document.getElementById('success-order-code');
            const code = codeEl ? codeEl.innerText : '';
            if (code) {
                navigator.clipboard.writeText(code).then(() => {
                    alert(`Kode pesanan ${code} berhasil disalin!`);
                });
            }
        }
    </script>

</body>
</html>
