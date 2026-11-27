<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Kampus - Esa Corner</title>

    <!-- Google Fonts: Plus Jakarta Sans & Caveat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

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
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
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

        .font-handwriting {
            font-family: 'Caveat', cursive;
        }

        /* Glassmorphism & Custom Badges */
        .glass-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .hero-pattern {
            background-color: #0b132b;
            background-image: 
                radial-gradient(at 0% 0%, rgba(30, 58, 138, 0.5) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(241, 90, 41, 0.25) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(15, 23, 42, 0.9) 0px, transparent 50%);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
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
    </style>
</head>
<body class="antialiased text-slate-800 bg-[#f8fafc]">

    <!-- ========================================================
         1. NAVBAR
    ======================================================== -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            
            <!-- Logo & Brand (Identik Neon Sign Esa Corner Kampus) -->
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

            <!-- Nav Links Desktop -->
            <nav id="desktop-nav-links" class="hidden md:flex items-center gap-1 text-xs sm:text-sm font-bold text-slate-600 bg-slate-100/80 p-1 rounded-full border border-slate-200/70">
                <a href="#home-section" data-nav-target="home-section" class="nav-bubble-pill px-3.5 py-1.5 rounded-full bg-white text-[#f15a29] shadow-2xs transition-all">Home</a>
                <a href="#kategori-section" data-nav-target="kategori-section" class="nav-bubble-pill px-3 py-1.5 rounded-full text-slate-600 hover:text-[#f15a29] transition-all">Kategori</a>
                <a href="#kantin-section" data-nav-target="kantin-section" class="nav-bubble-pill px-3 py-1.5 rounded-full text-slate-600 hover:text-[#f15a29] transition-all">Titik Kantin</a>
                <a href="#menu-terlaris-section" data-nav-target="menu-terlaris-section" class="nav-bubble-pill px-3 py-1.5 rounded-full text-slate-600 hover:text-[#f15a29] transition-all">Menu Terlaris</a>
                <a href="#keunggulan-section" data-nav-target="keunggulan-section" class="nav-bubble-pill px-3 py-1.5 rounded-full text-slate-600 hover:text-[#f15a29] transition-all">Keunggulan</a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                <!-- Cek Status Pesanan Button -->
                <button 
                    type="button" 
                    onclick="openTrackModal()" 
                    class="relative inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-orange-50 hover:bg-orange-100 text-[#ea580c] font-bold text-xs sm:text-sm border border-orange-200/80 transition-all shadow-xs"
                >
                    <svg class="w-4 h-4 text-[#ea580c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span>Cek Pesanan</span>
                    <span id="nav-order-indicator" class="hidden absolute -top-1 -right-1 w-3 h-3 bg-emerald-500 rounded-full ring-2 ring-white animate-pulse"></span>
                </button>
            </div>

        </div>
    </header>


    <!-- ========================================================
         2. HERO SECTION (FULL-WIDTH, UNBOXED, SOFT BLUE #EAF4FF, CAMPUS PHOTO ON RIGHT)
    ======================================================== -->
    <section id="home-section" class="relative w-full overflow-hidden bg-[#EAF4FF] min-h-[480px] lg:min-h-[540px] flex items-center">
        
        <!-- Campus Photo (Positioned naturally on the right, clear and vivid) -->
        <img 
            src="{{ asset('images/kampus-esaunggul.jpg') }}" 
            alt="Gedung Kampus Universitas Esa Unggul" 
            class="absolute inset-0 w-full h-full object-cover object-[70%_35%] filter brightness-100 contrast-105"
        >

        <!-- Left Gradient: Soft Blue #EAF4FF backdrop behind text fading out smoothly to the campus photo -->
        <div class="absolute inset-0 hidden md:block pointer-events-none" style="background: linear-gradient(90deg, #EAF4FF 0%, rgba(234, 244, 255, 0.95) 45%, rgba(234, 244, 255, 0.7) 65%, rgba(234, 244, 255, 0.2) 82%, transparent 100%);"></div>
        <div class="absolute inset-0 block md:hidden pointer-events-none" style="background: linear-gradient(180deg, rgba(234, 244, 255, 0.96) 0%, rgba(234, 244, 255, 0.85) 60%, rgba(234, 244, 255, 0.4) 100%);"></div>

        <!-- Bottom Gradient: Fades seamlessly into the white page background (#f8fafc) so there is NO box boundary -->
        <div class="absolute inset-x-0 bottom-0 h-24 pointer-events-none" style="background: linear-gradient(0deg, #f8fafc 0%, rgba(248, 250, 252, 0.8) 25%, rgba(234, 244, 255, 0.2) 60%, transparent 100%);"></div>

        <!-- Content Container: Left-aligned ("tulisannya taro di kiri") without any boxed container card ("tp jangan kotak2") -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-12 sm:py-16 lg:py-20 relative z-10">
            <div class="max-w-xl text-left space-y-5">
                
                <!-- Top Pill Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/90 backdrop-blur-md border border-blue-200/80 text-blue-900 font-extrabold text-xs tracking-wide shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-[#f15a29] animate-pulse"></span>
                    <span>Kantin Digital Universitas Esa Unggul</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-[1.15]">
                    Pesan Makanan Jadi Lebih Praktis <br>
                    <span class="text-[#f15a29]">Pesan Dulu, Ambil Nanti!</span>
                </h1>

                <!-- Subheading -->
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed font-normal max-w-lg">
                    Nikmati kemudahan memesan makanan di kantin secara online tanpa harus antre. Pilih menu, lakukan pembayaran, dan ambil saat pesanan siap. 
                </p>

                <!-- Action Buttons -->
                <div class="pt-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <button 
                        type="button" 
                        onclick="scrollToMenuSection()" 
                        class="px-7 py-3.5 rounded-xl bg-[#f15a29] hover:bg-orange-600 text-white font-black text-xs sm:text-sm shadow-lg shadow-orange-500/30 transition-all flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <span>Yuk, Pesan Sekarang!</span>
                        <span class="text-base leading-none">&rarr;</span>
                    </button>
                    <a 
                        href="#kantin-section" 
                        class="px-5 py-3.5 rounded-xl bg-white hover:bg-blue-50/80 text-blue-950 font-bold text-xs sm:text-sm border border-blue-200 shadow-xs hover:border-blue-300 transition-all flex items-center justify-center gap-2"
                    >
                        <span>🏢 Pilih Stan Kantin</span>
                    </a>
                </div>

            </div>
        </div>
    </section>


    <!-- ========================================================
         3. KATEGORI PILIHAN MAHASISWA
    ======================================================== -->
    <section id="kategori-section" class="py-6 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search Bar (Positioned above Kategori section, centered) -->
            <div class="mb-8 sm:mb-10 max-w-2xl mx-auto -mt-6 sm:-mt-8 relative z-20">
                <div class="bg-white rounded-2xl p-1.5 sm:p-2 shadow-md hover:shadow-lg transition-shadow border border-slate-200 text-slate-800 flex items-center gap-2">
                    <div class="relative flex-1 flex items-center">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input 
                            type="text" 
                            id="heroSearchInput"
                            onkeyup="handleSearchFilter(this.value)"
                            placeholder="Cari menu favorit: bakso, nasi goreng, geprek, es teh..." 
                            class="w-full pl-11 pr-3 py-2 text-xs sm:text-sm font-semibold text-slate-800 placeholder-slate-400 bg-transparent rounded-xl focus:outline-hidden"
                        >
                    </div>
                    <button 
                        type="button" 
                        onclick="scrollToMenuSection()"
                        class="bg-[#f15a29] hover:bg-orange-600 text-white font-bold text-xs sm:text-sm px-5 py-2.5 rounded-xl shadow-md shadow-orange-500/20 transition-all flex items-center justify-center gap-1.5 cursor-pointer shrink-0"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Cari</span>
                    </button>
                </div>
            </div>

           


    <!-- ========================================================
         4. TITIK KANTIN KAMPUS TERPADU (OUTLETS)
    ======================================================== -->
    <section id="kantin-section" class="py-10 bg-slate-100/70 border-y border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <span class="text-xs font-extrabold text-[#f15a29] tracking-wider uppercase bg-orange-100/80 px-3 py-1 rounded-full">
                        PILIH OUTLET
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-2.5">
                        Esa Corner Kampus Tangerang
                    </h2>
                    <p class="text-sm text-slate-500 font-medium mt-1">
                        Pilih stan kantin tujuan untuk membuka katalog menu lengkap dan langsung memesan
                    </p>
                </div>
            </div>

            @php
                $outletConfig = [
                    1 => [
                        'image' => 'images/esacorner.png',
                        'position' => 'center 56%',
                        'location' => 'Lantai 1 • Dekat Pintu Masuk',
                        'desc' => 'Pusat aneka bakso urat, camilan gurih, sosis, dan aneka gorengan renyah mahasiswa.',
                        'rating' => '4.8',
                        'reviews' => '128 ulasan',
                        'time' => '10-15 mnt',
                    ],
                    2 => [
                        'image' => 'images/kedaimamici.png',
                        'position' => 'center 15%',
                        'location' => 'Lantai 1 • Deretan No. 02',
                        'desc' => 'Spesialis masakan rumah, nasi goreng wangi, ayam cabe hijau, dan menu kenyang hemat.',
                        'rating' => '4.9',
                        'reviews' => '210 ulasan',
                        'time' => '12-18 mnt',
                    ],
                    3 => [
                        'image' => 'images/kantintehnur.png',
                        'position' => 'center 20%',
                        'location' => 'Lantai 1 • Deretan No. 03',
                        'desc' => 'Pusat mie ayam mantap, kuah bakso aci rempah, es teh jumbo, dan aneka minuman kopi.',
                        'rating' => '4.8',
                        'reviews' => '95 ulasan',
                        'time' => '8-12 mnt',
                    ],
                    4 => [
                        'image' => 'images/kedaibuyanti.png',
                        'position' => 'center 20%',
                        'location' => 'Lantai 1 • Deretan No. 04',
                        'desc' => 'Ayam geprek krispi sambal bawang level 1-5, ayam bakar bumbu legit, dan lalapan segar.',
                        'rating' => '4.9',
                        'reviews' => '174 ulasan',
                        'time' => '10-15 mnt',
                    ],
                ];

                $getConfig = function($outlet, $idx) use ($outletConfig) {
                    $name = strtolower($outlet->name ?? '');
                    if (str_contains($name, 'esa') || str_contains($name, 'corner')) return $outletConfig[1];
                    if (str_contains($name, 'mamici')) return $outletConfig[2];
                    if (str_contains($name, 'nur') || str_contains($name, 'teh')) return $outletConfig[3];
                    if (str_contains($name, 'yanti')) return $outletConfig[4];
                    return $outletConfig[$outlet->id] ?? ($outletConfig[($idx % 4) + 1]);
                };
            @endphp

            <!-- Outlet Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($outlets as $index => $outlet)
                    @php
                        $cfg = $getConfig($outlet, $index);
                        $cardImg = !empty($outlet->image) 
                            ? (str_starts_with($outlet->image, 'http') ? $outlet->image : asset('storage/' . $outlet->image))
                            : asset($cfg['image']);
                    @endphp

                    <div 
                        class="outlet-card-item group bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-orange-500/40 transition-all duration-300 flex flex-col overflow-hidden cursor-pointer"
                        onclick="openModal({{ $outlet->id }}, '{{ addslashes($outlet->name) }}')"
                    >
                        <!-- Card Image Frame -->
                        <div class="relative w-full h-44 overflow-hidden bg-slate-100">
                            <img 
                                src="{{ $cardImg }}" 
                                alt="{{ $outlet->name }}"
                                style="object-position: {{ $cfg['position'] }};"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                loading="lazy"
                            >
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 flex items-center gap-2">
                                <span class="bg-emerald-600 text-white text-[11px] font-black px-2.5 py-1 rounded-lg shadow-sm flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> BUKA
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-[#f15a29] transition-colors">
                                    {{ $outlet->name }}
                                </h3>
                                
                                <p class="text-xs text-slate-500 font-medium flex items-center gap-1 mt-1 mb-2.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>{{ $cfg['location'] }}</span>
                                </p>

                                <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                                    {{ $outlet->description ?? $cfg['desc'] }}
                                </p>
                            </div>

                            <!-- CTA Button: Kotak Oranye Transparan di Tengah -->
                            <div class="pt-4 mt-4 border-t border-slate-100">
                                <div class="w-full py-2.5 px-4 rounded-xl bg-orange-500/10 hover:bg-[#f15a29] text-[#f15a29] hover:text-white border border-orange-500/20 font-extrabold text-xs transition-all flex items-center justify-center gap-1.5 shadow-2xs group-hover:bg-[#f15a29] group-hover:text-white">
                                    <span>Buka Menu</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>


    <!-- ========================================================
         5. MENU BEST-SELLER PALING LARIS
         (Catatan: Stan Kuliner Favorit dihilangkan sesuai permintaan user)
    ======================================================== -->
    <section id="menu-terlaris-section" class="py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <span class="text-xs font-extrabold text-amber-600 tracking-wider uppercase bg-amber-100/80 px-3 py-1 rounded-full">
                        MENU BEST-SELLER 🔥
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-2.5">
                        Menu Favorit Mahasiswa Hari Ini
                    </h2>
                    <p class="text-sm text-slate-500 font-medium mt-1">
                        Daftar kuliner kampus dengan rating tertinggi. Klik tanda (+) untuk langsung memilih menu!
                    </p>
                </div>
                <div class="text-xs font-semibold text-slate-500">
                    Menampilkan rekomendasi menu aktif
                </div>
            </div>

            @php
                // Mengambil menu real dari database mewakili masing-masing stan kantin aktif
                $activeOutlets = \App\Models\Outlet::where('is_active', true)->with(['menus' => function($q) {
                    $q->where('is_available', true);
                }])->get();

                $collectedMenus = collect();
                // Ambil hingga 2 menu terfavorit dari tiap-tiap outlet agar beragam & akurat
                foreach ($activeOutlets as $outlet) {
                    foreach ($outlet->menus->take(2) as $m) {
                        $collectedMenus->push($m);
                    }
                }
                // Jika kurang dari 8, lengkapi dengan menu lainnya
                if ($collectedMenus->count() < 8) {
                    $existingIds = $collectedMenus->pluck('id')->filter()->toArray();
                    $fillers = \App\Models\Menu::with('outlet')
                        ->where('is_available', true)
                        ->whereNotIn('id', $existingIds)
                        ->take(8 - $collectedMenus->count())
                        ->get();
                    foreach ($fillers as $f) {
                        $collectedMenus->push($f);
                    }
                }
                $dbMenus = $collectedMenus;

                $resolveImg = function($imageVal, $name) {
                    if (!empty($imageVal)) {
                        if (str_starts_with($imageVal, 'http')) {
                            return $imageVal;
                        }
                        if (str_starts_with($imageVal, 'images/') || str_starts_with($imageVal, 'image/')) {
                            $clean = preg_replace('#^image/#', 'images/', $imageVal);
                            $base = basename($clean);
                            if (file_exists(public_path('images/menus/' . $base))) return asset('images/menus/' . $base);
                            if (file_exists(public_path('images/' . $base))) return asset('images/' . $base);
                            return asset($clean);
                        }
                        $trimmed = ltrim($imageVal, '/');
                        if (file_exists(public_path('images/' . $trimmed))) {
                            return asset('images/' . $trimmed);
                        }
                        if (file_exists(public_path('images/menus/' . basename($trimmed)))) {
                            return asset('images/menus/' . basename($trimmed));
                        }
                        return asset('storage/' . $trimmed);
                    }
                    $lower = strtolower($name);
                    if (str_contains($lower, 'bakso')) return 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=600&q=80';
                    if (str_contains($lower, 'nasi goreng')) return 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=600&q=80';
                    if (str_contains($lower, 'geprek')) return 'https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=600&q=80';
                    if (str_contains($lower, 'cabe')) return 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?auto=format&fit=crop&w=600&q=80';
                    if (str_contains($lower, 'mie')) return 'https://images.unsplash.com/photo-1559847844-5315695dadae?auto=format&fit=crop&w=600&q=80';
                    if (str_contains($lower, 'otak') || str_contains($lower, 'cimol')) return 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?auto=format&fit=crop&w=600&q=80';
                    if (str_contains($lower, 'jeruk')) return 'https://images.unsplash.com/photo-1613478223719-2ab802602423?auto=format&fit=crop&w=600&q=80';
                    if (str_contains($lower, 'teh')) return 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&w=600&q=80';
                    return 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80';
                };

                // Susun item cards
                $displayBestSellers = [];
                if ($dbMenus->count() > 0) {
                    foreach ($dbMenus as $m) {
                        $displayBestSellers[] = [
                            'id' => $m->id,
                            'name' => $m->name,
                            'outlet_id' => $m->outlet_id,
                            'outlet_name' => $m->outlet->name ?? 'Kantin Kampus',
                            'price' => $m->price,
                            'rating' => '4.8',
                            'reviews' => rand(65, 230),
                            'image' => $resolveImg($m->image, $m->name),
                            'desc' => $m->description ?? 'Pilihan menu terfavorit dengan rasa otentik.',
                            'is_available' => (bool) ($m->is_available ?? true),
                        ];
                    }
                } else {
                    $displayBestSellers = [
                        [
                            'name' => 'Bakso Urat Malang',
                            'outlet_id' => 1,
                            'outlet_name' => 'Esa Corner',
                            'price' => 15000,
                            'rating' => '4.8',
                            'reviews' => 140,
                            'image' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=600&q=80',
                            'desc' => 'Bakso urat sapi asli kenyal dengan kuah kaldu sapi sedap.',
                            'is_available' => true,
                        ],
                        [
                            'name' => 'Cimol Bumbu Pedas',
                            'outlet_id' => 2,
                            'outlet_name' => 'Kantin Mamici',
                            'price' => 10000,
                            'rating' => '4.9',
                            'reviews' => 195,
                            'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?auto=format&fit=crop&w=600&q=80',
                            'desc' => 'Cimol gurih kenyal dengan taburan bumbu pedas gurih khas Mamici.',
                            'is_available' => true,
                        ],
                        [
                            'name' => 'Nasi Goreng Spesial',
                            'outlet_id' => 2,
                            'outlet_name' => 'Kantin Mamici',
                            'price' => 18000,
                            'rating' => '4.9',
                            'reviews' => 185,
                            'image' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=600&q=80',
                            'desc' => 'Nasi goreng harum telur mata sapi, ayam suwir, dan kerupuk.',
                            'is_available' => true,
                        ],
                        [
                            'name' => 'Nasi Ayam Cabe Hijau',
                            'outlet_id' => 3,
                            'outlet_name' => 'Kantin Teh Nur',
                            'price' => 15000,
                            'rating' => '4.8',
                            'reviews' => 115,
                            'image' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?auto=format&fit=crop&w=600&q=80',
                            'desc' => 'Ayam empuk gurih sambal cabe hijau pedas segar khas Teh Nur.',
                            'is_available' => true,
                        ],
                        [
                            'name' => 'Ayam Geprek Sambal Bawang',
                            'outlet_id' => 4,
                            'outlet_name' => 'Kedai Bu Yanti',
                            'price' => 18000,
                            'rating' => '4.9',
                            'reviews' => 210,
                            'image' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=600&q=80',
                            'desc' => 'Ayam krispi digeprek cabai rawit pedas harum minyak bawang.',
                            'is_available' => true,
                        ],
                    ];
                }
            @endphp

            <!-- Best Seller Menu Grid -->
            <div id="bestSellerGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($displayBestSellers as $item)
                    <div 
                        class="menu-food-card group bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-orange-500/40 transition-all duration-300 flex flex-col overflow-hidden {{ !($item['is_available'] ?? true) ? 'opacity-80' : '' }}"
                        data-name="{{ strtolower($item['name']) }}"
                        data-outlet="{{ strtolower($item['outlet_name']) }}"
                        onclick="{{ ($item['is_available'] ?? true) ? "selectPopularItem({$item['outlet_id']}, '" . addslashes($item['outlet_name']) . "', '" . addslashes($item['name']) . "', {$item['price']})" : "alert('Maaf, menu {$item['name']} sedang habis di stan.')" }}"
                    >
                        <!-- Food Photo Frame -->
                        <div class="relative w-full h-44 overflow-hidden bg-slate-100 cursor-pointer">
                            <img 
                                src="{{ $item['image'] }}" 
                                alt="{{ $item['name'] }}"
                                class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500 {{ !($item['is_available'] ?? true) ? 'grayscale contrast-75' : '' }}"
                                loading="lazy"
                            >
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 bg-[#f15a29] text-white text-[11px] font-black px-2.5 py-0.5 rounded-lg shadow-sm">
                                TERLARIS
                            </div>

                            @if (!($item['is_available'] ?? true))
                                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-[1px] flex items-center justify-center z-10">
                                    <span class="bg-rose-600 text-white text-xs font-black px-3.5 py-1.5 rounded-xl uppercase tracking-wider shadow-lg border border-white/20 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                        <span>HABIS</span>
                                    </span>
                                </div>
                            @else
                                <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-md text-slate-800 text-xs font-bold px-2 py-0.5 rounded-lg shadow-sm flex items-center gap-1">
                                    <span class="text-amber-500">⭐</span> {{ $item['rating'] }}
                                </div>
                            @endif

                            <div class="absolute bottom-2.5 left-3 bg-slate-900/80 backdrop-blur-xs text-orange-200 text-[11px] font-bold px-2.5 py-0.5 rounded-md flex items-center gap-1">
                                📍 {{ $item['outlet_name'] }}
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="text-base font-extrabold text-slate-900 group-hover:text-[#f15a29] transition-colors leading-snug">
                                        {{ $item['name'] }}
                                    </h3>
                                    @if (!($item['is_available'] ?? true))
                                        <span class="shrink-0 text-[10px] font-black uppercase tracking-wider text-rose-600 bg-rose-50 px-2 py-0.5 rounded-md border border-rose-200">
                                            Habis
                                        </span>
                                    @endif
                                </div>

                                <p class="text-xs text-slate-500 line-clamp-2 mt-1.5 leading-relaxed font-normal">
                                    {{ $item['desc'] ?? 'Menu rekomendasi lezat untuk makan siang kampus Anda.' }}
                                </p>
                            </div>

                            <!-- Bottom Price & Add Button -->
                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                                <div>
                                    <span class="text-[11px] font-bold text-slate-600 block uppercase tracking-wider">Harga</span>
                                    <span class="text-lg font-black text-slate-900">
                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    </span>
                                </div>

                                @if ($item['is_available'] ?? true)
                                    <button 
                                        type="button" 
                                        class="w-10 h-10 rounded-xl bg-[#f15a29] hover:bg-orange-600 text-white flex items-center justify-center shadow-md shadow-orange-500/30 group-hover:scale-110 transition-all cursor-pointer"
                                        title="Pesan menu ini langsung di {{ $item['outlet_name'] }}"
                                        onclick="event.stopPropagation(); selectPopularItem({{ $item['outlet_id'] }}, '{{ addslashes($item['outlet_name']) }}', '{{ addslashes($item['name']) }}', {{ $item['price'] }})"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                @else
                                    <div class="px-3 py-1.5 rounded-xl bg-slate-100 text-slate-400 font-extrabold text-xs border border-slate-200 select-none">
                                        🚫 Habis
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Empty Search State -->
            <div id="searchEmptyState" class="hidden text-center py-16 bg-white rounded-3xl border border-dashed border-slate-300">
                <div class="w-16 h-16 rounded-full bg-orange-100 text-[#f15a29] flex items-center justify-center text-3xl mx-auto mb-3">
                    🔍
                </div>
                <h3 class="text-base font-extrabold text-slate-800">Menu tidak ditemukan</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Coba gunakan kata kunci lain seperti "nasi", "bakso", "mie", atau "geprek".</p>
                <button type="button" onclick="quickFilterSearch('Semua')" class="mt-4 px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-slate-800">
                    Tampilkan Semua Menu
                </button>
            </div>

        </div>
    </section>


    <!-- ========================================================
         6. FITUR KEUNGGULAN (KENAPA PESAN LEWAT KANTIN DIGITAL?)
    ======================================================== -->
    <section id="keunggulan-section" class="py-14 bg-white border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-extrabold text-[#f15a29] tracking-wider uppercase bg-orange-50 px-3 py-1 rounded-full border border-orange-200">
                    KEMUDAHAN KAMPUS DIGITAL
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-3">
                    Kenapa Pesan Lewat Kantin Kampus Digital?
                </h2>
                <p class="text-sm text-slate-500 font-medium mt-2">
                    Didesain khusus untuk mahasiswa dan dosen agar istirahat makan siang lebih efektif, hemat, dan tanpa ribet.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Feature 1 -->
                <div class="p-8 rounded-3xl bg-slate-50/70 border border-slate-200/80 hover:bg-white hover:shadow-xl hover:border-orange-500/30 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center text-2xl mb-6 font-black">
                        📱
                    </div>
                    <h3 class="text-lg font-extrabold text-slate-900 mb-2">Scan & Langsung Pesan</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Cukup buka web dari HP atau laptop Anda. Pilih stan kantin, tentukan menu favorit, dan selesaikan tanpa harus antre berdesakan di depan meja stan.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-3xl bg-slate-50/70 border border-slate-200/80 hover:bg-white hover:shadow-xl hover:border-orange-500/30 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-orange-500/10 text-[#f15a29] flex items-center justify-center text-2xl mb-6 font-black">
                        👥
                    </div>
                    <h3 class="text-lg font-extrabold text-slate-900 mb-2">Pesan Bersama & Split Bill</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Makan bareng teman satu geng? Fitur Split Bill otomatis membagi siapa pesan apa dan rincian bayar per orang secara adil tanpa pusing bagi nota manual.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-3xl bg-slate-50/70 border border-slate-200/80 hover:bg-white hover:shadow-xl hover:border-orange-500/30 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-2xl mb-6 font-black">
                        ⚡
                    </div>
                    <h3 class="text-lg font-extrabold text-slate-900 mb-2">QRIS Real-Time & Antrean</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Bayar instan dengan semua aplikasi m-banking & e-wallet (GoPay, OVO, Dana, ShopeePay). Pantau status pesanan kapan matang dan siap diambil langsung di HP.
                    </p>
                </div>

            </div>

        </div>
    </section>


    <!-- ========================================================
         7. BOTTOM CALL TO ACTION BANNER (Biru #EAF4FF)
    ======================================================== -->
    <section class="py-10 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="background-color: #EAF4FF;" class="rounded-3xl p-8 sm:p-12 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6 border border-blue-200/80">
                <div class="max-w-xl text-center md:text-left">
                    <h3 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900">
                        Sudah Tahu Mau Makan Apa Siang Ini?
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed font-medium">
                        Jangan biarkan jam istirahat kuliahmu habis hanya untuk menunggu antrean. Pesan sekarang, makanan siap pas kamu tiba di kantin!
                    </p>
                </div>
                <div class="shrink-0">
                    <a 
                        href="#kantin-section" 
                        class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-[#f15a29] hover:bg-orange-600 text-white font-extrabold text-sm shadow-lg shadow-orange-500/25 transition-all hover:scale-105 cursor-pointer"
                    >
                        <span>Mulai Pesan Sekarang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================================
         8. FOOTER
    ======================================================== -->
    <footer class="bg-white border-t border-slate-200/80 py-10 text-slate-500 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2 font-bold text-slate-800 text-sm">
                <span>Esa<span class="text-[#f15a29]">Corner</span></span>
                <span class="text-slate-300">•</span>
                <span class="text-xs text-slate-500 font-semibold">Satu Kampus, Banyak Rasa</span>
            </div>
            <div class="flex items-center gap-6 font-semibold">
                <a href="#home-section" class="hover:text-slate-800">Home</a>
                <a href="#kantin-section" class="hover:text-slate-800">Kantin</a>
                <a href="/order/track" class="hover:text-slate-800">Pelacakan Pesanan</a>
                <a href="/admin" class="hover:text-slate-800">Panel Admin</a>
            </div>
            <p class="text-slate-400">
                &copy; {{ date('Y') }} Kantin Kampus Terpadu. All rights reserved.
            </p>
        </div>
    </footer>


    <!-- ========================================================
         9. MODAL MULAI PEMESANAN (ORDER INITIATION MODAL)
         Persis sesuai mockup Google Stitch
    ======================================================== -->
    <div id="nameModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative transform transition-all scale-95 duration-200" id="nameModalBox">
            
            <!-- Close Button -->
            <button 
                type="button" 
                onclick="closeOrderModal()" 
                class="absolute top-5 right-5 w-8 h-8 rounded-full bg-slate-100 text-slate-400 hover:text-slate-700 hover:bg-slate-200 flex items-center justify-center text-sm font-black transition-colors"
            >
                ✕
            </button>

            <!-- Modal Header -->
            <div class="text-center mb-6">
                <h3 class="text-xl font-black text-slate-900" id="modalOutletTitle">Mulai Pemesanan</h3>
                <p class="text-xs text-slate-500 font-medium mt-1" id="modalOutletSubtitle">
                    Silakan isi nama Anda dan pilih metode pemesanan
                </p>
            </div>

            <!-- Form Content -->
            <div class="space-y-4">
                
                <!-- Input Nama -->
                <div>
                    <label for="nameInput" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nama Pemesan:
                    </label>
                    <input
                        type="text"
                        id="nameInput"
                        placeholder="Contoh: Budi / Cindy / Meja 05"
                        autocomplete="name"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-300 focus:border-[#f15a29] focus:ring-3 focus:ring-orange-500/20 text-sm font-semibold text-slate-800 outline-hidden transition-all placeholder-slate-400"
                    >
                </div>

                <!-- Pilihan Mode Pemesanan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Pilih Mode Pesanan:
                    </label>

                    <div class="space-y-2.5">
                        
                        <!-- Opsi Solo -->
                        <label class="relative flex items-center p-3.5 rounded-2xl border-2 border-orange-500 bg-orange-50/50 cursor-pointer transition-all option-card" id="cardOptionSolo">
                            <input
                                type="radio"
                                name="order_type"
                                value="solo"
                                checked
                                onchange="highlightOptionCard('solo')"
                                class="w-4 h-4 text-[#f15a29] focus:ring-[#f15a29] border-slate-300"
                            >
                            <div class="ml-3 flex-1">
                                <span class="block text-xs font-black text-slate-900">
                                    👤 Pesan Sendiri 
                                </span>
                                <span class="block text-[11px] text-slate-500 font-medium">
                                    Pesan untuk diri sendiri, langsung bayar & ambil praktis.
                                </span>
                            </div>
                        </label>

                        <!-- Opsi Group (Split Bill) -->
                        <label class="relative flex items-center p-3.5 rounded-2xl border-2 border-slate-200 hover:border-slate-300 bg-white cursor-pointer transition-all option-card" id="cardOptionGroup">
                            <input
                                type="radio"
                                name="order_type"
                                value="group"
                                onchange="highlightOptionCard('group')"
                                class="w-4 h-4 text-[#f15a29] focus:ring-[#f15a29] border-slate-300"
                            >
                            <div class="ml-3 flex-1">
                                <span class="block text-xs font-black text-slate-900">
                                    👥 Pesan Bersama (Split Bill)
                                </span>
                                <span class="block text-[11px] text-slate-500 font-medium">
                                    Pesan bareng teman satu meja, otomatis hitung patungan per orang.
                                </span>
                            </div>
                        </label>

                    </div>
                </div>

                <!-- Submit Button -->
                <button
                    type="button"
                    onclick="continueOrder()"
                    class="w-full mt-2 py-4 rounded-xl bg-[#f15a29] hover:bg-orange-600 text-white font-extrabold text-sm shadow-lg shadow-orange-500/25 transition-all flex items-center justify-center gap-2 cursor-pointer"
                >
                    <span id="modalProceedBtnText">Lanjut ke Menu Kantin</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>

            </div>

        </div>
    </div>


    <!-- ========================================================
         10. MODAL CEK STATUS PESANAN (TRACKING MODAL)
    ======================================================== -->
    <div id="trackModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative">
            
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-orange-100 text-[#f15a29] flex items-center justify-center font-black">
                        🛍️
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Cek Status Pesanan</h3>
                </div>
                <button onclick="closeTrackModal()" class="w-7 h-7 rounded-full bg-slate-100 text-slate-400 hover:text-slate-700 flex items-center justify-center text-xs font-black">✕</button>
            </div>

            <p class="text-xs text-slate-500 leading-relaxed mb-5">
                Pantau proses pesanan kantin Anda mulai dari konfirmasi, dimasak, hingga pesanan siap diambil di meja stan.
            </p>

            <!-- Active Order Card (If Available in LocalStorage) -->
            <div id="quickActiveOrderCard" class="hidden bg-orange-50/70 border border-orange-200 rounded-2xl p-4 mb-5 text-left">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[11px] font-black text-orange-950 uppercase tracking-wider">Pesanan Aktif Terakhir</span>
                    <span id="quickStatusBadge" class="bg-emerald-500 text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full">Aktif</span>
                </div>
                <div class="flex items-baseline justify-between mb-3">
                    <span id="quickOrderCode" class="text-xl font-black text-[#f15a29]">ORD-XXXXXX</span>
                    <span id="quickOutletName" class="text-xs font-semibold text-slate-600">Kantin Kampus</span>
                </div>
                <a id="quickTrackBtn" href="/order/track" class="block w-full py-2.5 text-center bg-[#f15a29] hover:bg-orange-600 text-white rounded-xl font-bold text-xs shadow-xs transition-colors">
                    Buka Pelacakan Lengkap &rarr;
                </a>
            </div>

            <!-- Input Kode Manual -->
            <div class="mb-5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Atau Masukkan Kode Pesanan:
                </label>
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        id="homeOrderInput" 
                        placeholder="Contoh: ORD-RYRMPR" 
                        class="flex-1 px-4 py-3 rounded-xl border border-slate-300 text-xs font-black uppercase text-slate-800 tracking-wider focus:outline-hidden focus:border-[#f15a29]"
                    >
                    <button 
                        type="button" 
                        onclick="submitHomeTrack()" 
                        class="px-5 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition-colors"
                    >
                        Lacak
                    </button>
                </div>
            </div>

            <!-- Recent Orders Chips -->
            <div id="homeRecentSection" class="hidden mb-5 text-left">
                <span class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2">Riwayat Pesanan Anda:</span>
                <div id="homeRecentChips" class="flex gap-2 flex-wrap"></div>
            </div>

            <div class="pt-4 border-t border-slate-100 text-center">
                <a href="/order/track" class="text-xs font-bold text-slate-500 hover:text-[#f15a29] transition-colors">
                    Buka Halaman Pelacakan Utama &rarr;
                </a>
            </div>

        </div>
    </div>


    <!-- ========================================================
         JAVASCRIPT LOGIC
    ======================================================== -->
    <script>
        let selectedOutletId = '';
        let selectedOutlet = '';
        let selectedAutoAddItem = '';
        let selectedItemPrice = 0;

        // 1. Direct Selection from Best Seller (Buka Modal Pesan Sendiri / Split Bill Terlebih Dahulu)
        function selectPopularItem(outletId, outletName, menuItemName, price) {
            openModal(outletId, outletName, menuItemName, price);
        }

        // 2. Open Order Initiation Modal
        function openModal(outletId, outletName, menuItemName = '', price = 0) {
            selectedOutletId = outletId;
            selectedOutlet = outletName;
            selectedAutoAddItem = menuItemName || '';
            selectedItemPrice = price || 0;

            const titleEl = document.getElementById('modalOutletTitle');
            const subTitleEl = document.getElementById('modalOutletSubtitle');
            const proceedBtn = document.getElementById('modalProceedBtnText');

            if (menuItemName) {
                if (titleEl) titleEl.innerText = `Pesan ${menuItemName}`;
                if (subTitleEl) subTitleEl.innerText = `Stan: ${outletName} • Lengkapi nama & mode pesanan`;
                if (proceedBtn) proceedBtn.innerText = `Lanjut Pesan ${menuItemName}`;
            } else {
                if (titleEl) titleEl.innerText = `Mulai Pesan di ${outletName}`;
                if (subTitleEl) subTitleEl.innerText = `Silakan lengkapi nama pemesan untuk ${outletName}`;
                if (proceedBtn) proceedBtn.innerText = `Lanjut ke Menu Kantin`;
            }
            
            const modal = document.getElementById('nameModal');
            const box = document.getElementById('nameModalBox');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            setTimeout(() => {
                box.classList.remove('scale-95');
                box.classList.add('scale-100');
                const nameInput = document.getElementById('nameInput');
                if (nameInput) nameInput.focus();
            }, 10);

            // Autofill existing name if available
            const savedName = localStorage.getItem('customer_name');
            if (savedName && savedName !== 'Pelanggan') {
                document.getElementById('nameInput').value = savedName;
            }
        }

        function closeOrderModal() {
            const modal = document.getElementById('nameModal');
            const box = document.getElementById('nameModalBox');
            box.classList.remove('scale-100');
            box.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 150);
        }

        // 3. Highlight option cards in modal
        function highlightOptionCard(type) {
            const soloCard = document.getElementById('cardOptionSolo');
            const groupCard = document.getElementById('cardOptionGroup');

            if (type === 'solo') {
                soloCard.classList.add('border-orange-500', 'bg-orange-50/50');
                soloCard.classList.remove('border-slate-200', 'bg-white');
                groupCard.classList.remove('border-orange-500', 'bg-orange-50/50');
                groupCard.classList.add('border-slate-200', 'bg-white');
            } else {
                groupCard.classList.add('border-orange-500', 'bg-orange-50/50');
                groupCard.classList.remove('border-slate-200', 'bg-white');
                soloCard.classList.remove('border-orange-500', 'bg-orange-50/50');
                soloCard.classList.add('border-slate-200', 'bg-white');
            }
        }

        // 4. Continue Order to Menu View
        function continueOrder() {
            const nameInput = document.getElementById('nameInput');
            const name = nameInput ? nameInput.value.trim() : '';
            const orderType = document.querySelector('input[name="order_type"]:checked')?.value || 'solo';

            if (name === '') {
                alert('Silakan masukkan nama pemesan terlebih dahulu.');
                if (nameInput) nameInput.focus();
                return;
            }

            localStorage.setItem('customer_name', name);
            localStorage.setItem('order_type', orderType);
            localStorage.setItem('outlet_id', selectedOutletId);
            localStorage.setItem('outlet_name', selectedOutlet);

            if (selectedAutoAddItem) {
                localStorage.setItem('auto_add_item', selectedAutoAddItem);
                localStorage.setItem('selected_menu_name', selectedAutoAddItem);
                if (selectedItemPrice) {
                    localStorage.setItem('selected_menu_price', selectedItemPrice);
                }
                window.location.href = `/menu/${selectedOutletId}?item=${encodeURIComponent(selectedAutoAddItem)}`;
            } else {
                localStorage.removeItem('auto_add_item');
                localStorage.removeItem('selected_menu_name');
                window.location.href = `/menu/${selectedOutletId}`;
            }
        }

        // 5. Quick Filter & Search Handler
        function handleSearchFilter(query) {
            const cleanQuery = query.toLowerCase().trim();
            const cards = document.querySelectorAll('.menu-food-card');
            let matchedCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                const outlet = card.getAttribute('data-outlet') || '';
                
                if (cleanQuery === '' || name.includes(cleanQuery) || outlet.includes(cleanQuery)) {
                    card.style.display = 'flex';
                    matchedCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('searchEmptyState');
            if (matchedCount === 0 && cleanQuery !== '') {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }

        function quickFilterSearch(keyword) {
            const input = document.getElementById('heroSearchInput');
            if (keyword === 'Semua') {
                input.value = '';
                handleSearchFilter('');
            } else {
                input.value = keyword;
                handleSearchFilter(keyword);
            }
            scrollToMenuSection();
        }

        function scrollToMenuSection() {
            const section = document.getElementById('menu-terlaris-section');
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // 6. Track Modal Logic
        function openTrackModal() {
            const modal = document.getElementById('trackModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            try {
                const lastCode = localStorage.getItem('esa_last_order_code');
                const recent = JSON.parse(localStorage.getItem('esa_recent_orders') || '[]');
                
                const card = document.getElementById('quickActiveOrderCard');
                if (lastCode) {
                    card.classList.remove('hidden');
                    document.getElementById('quickOrderCode').innerText = lastCode;
                    document.getElementById('quickTrackBtn').href = `/order/track/${lastCode}`;
                    
                    if (recent.length > 0 && recent[0].code === lastCode) {
                        document.getElementById('quickOutletName').innerText = recent[0].outlet || 'Kantin Kampus';
                    }
                } else {
                    card.classList.add('hidden');
                }

                const recentSec = document.getElementById('homeRecentSection');
                const chips = document.getElementById('homeRecentChips');
                if (recent.length > 0) {
                    recentSec.classList.remove('hidden');
                    chips.innerHTML = recent.map(r => `
                        <a href="/order/track/${r.code}" class="px-3 py-1 rounded-full bg-slate-100 hover:bg-slate-200 border border-slate-200 text-xs font-bold text-slate-700">
                            🏷️ ${r.code}
                        </a>
                    `).join('');
                } else {
                    recentSec.classList.add('hidden');
                }
            } catch(e) {}
        }

        function closeTrackModal() {
            const modal = document.getElementById('trackModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function submitHomeTrack() {
            const val = document.getElementById('homeOrderInput').value.trim();
            if (!val) {
                alert('Silakan masukkan kode pesanan terlebih dahulu.');
                return;
            }
            window.location.href = `/order/track/${val}`;
        }

        // Navbar Active Pill Bubble Controller
        const navSectionIds = ['home-section', 'kategori-section', 'kantin-section', 'menu-terlaris-section', 'keunggulan-section'];
        
        function setActiveNavPill(targetId) {
            const pills = document.querySelectorAll('.nav-bubble-pill');
            pills.forEach(pill => {
                const target = pill.getAttribute('data-nav-target');
                if (target === targetId) {
                    pill.classList.remove('text-slate-600');
                    pill.classList.add('bg-white', 'text-[#f15a29]', 'shadow-2xs');
                } else {
                    pill.classList.remove('bg-white', 'text-[#f15a29]', 'shadow-2xs');
                    pill.classList.add('text-slate-600');
                }
            });
        }

        // Check active order on startup & setup navbar scroll spy
        document.addEventListener('DOMContentLoaded', () => {
            // Nav Bubble Pill Click Handling
            document.querySelectorAll('.nav-bubble-pill').forEach(pill => {
                pill.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('data-nav-target');
                    if (targetId) {
                        setActiveNavPill(targetId);
                        const el = document.getElementById(targetId);
                        if (el) {
                            e.preventDefault();
                            const offset = 80;
                            const bodyRect = document.body.getBoundingClientRect().top;
                            const elementRect = el.getBoundingClientRect().top;
                            const elementPosition = elementRect - bodyRect;
                            const offsetPosition = elementPosition - offset;
                            window.scrollTo({
                                top: offsetPosition,
                                behavior: 'smooth'
                            });
                            history.pushState(null, null, '#' + targetId);
                        }
                    }
                });
            });

            // Scroll Spy to sync active pill as user scrolls
            window.addEventListener('scroll', () => {
                let current = 'home-section';
                const scrollPosition = window.scrollY + 140;
                navSectionIds.forEach(id => {
                    const section = document.getElementById(id);
                    if (section) {
                        const sectionTop = section.offsetTop;
                        if (scrollPosition >= sectionTop) {
                            current = id;
                        }
                    }
                });
                setActiveNavPill(current);
            }, { passive: true });

            // Sync with current hash if loaded directly (e.g. #kategori-section)
            if (window.location.hash) {
                const hashId = window.location.hash.replace('#', '');
                if (navSectionIds.includes(hashId)) {
                    setActiveNavPill(hashId);
                }
            }

            try {
                const lastCode = localStorage.getItem('esa_last_order_code');
                if (lastCode) {
                    const dot = document.getElementById('nav-order-indicator');
                    if (dot) dot.classList.remove('hidden');
                }
            } catch(e) {}
        });
    </script>

</body>
</html>