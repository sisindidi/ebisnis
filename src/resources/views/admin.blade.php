<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Konsol Administrator - Kantin Kampus' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#eef2f6] text-slate-700 antialiased">

<div class="flex min-h-screen">
    
    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col justify-between p-5 sticky top-0 h-screen overflow-y-auto">
        <div>
            {{-- Header Sidebar --}}
            <div class="mb-8 px-2">
                <span class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">
                    KONSOL ADMINISTRATOR
                </span>
                <div class="text-xs font-semibold text-slate-500 mt-0.5">
                    Role: <span class="text-orange-600 font-bold">{{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Admin Outlet' }}</span>
                </div>
            </div>

            {{-- Label Kategori --}}
            <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase px-2 mb-3">
                OPERASIONAL
            </div>

            {{-- Navigasi Menu --}}
            <nav class="space-y-1.5 text-sm font-medium">
                {{-- Dashboard (Active) --}}
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#fde8e8] text-[#e04f44] font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                {{-- Menu Makanan / Minuman --}}
                <a href="{{ url('/admin/menus') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Menu</span>
                </a>

                {{-- Detail Pesanan --}}
                <a href="{{ route('order-details.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Detail Pesanan</span>
                </a>

                {{-- Order dengan Badge Counter --}}
                <a href="{{ route('orders.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span>Order</span>
                    </div>
                    @if(isset($orderAktifCount) && $orderAktifCount > 0)
                        <span class="bg-slate-100 text-slate-600 font-bold text-xs px-2 py-0.5 rounded-md">
                            {{ $orderAktifCount }}
                        </span>
                    @endif
                </a>

                {{-- Outlet: Super Admin bisa kelola semua, Admin Outlet melihat profil outletnya --}}
                <a href="{{ route('outlets.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>{{ auth()->user()->role === 'super_admin' ? 'Outlet' : 'Profil Outlet' }}</span>
                </a>
            </nav>
        </div>

        {{-- Bagian Bawah Sidebar --}}
        <div class="space-y-4 pt-6">
            {{-- Banner Biru "Satu kampus, banyak rasa" --}}
            <div class="bg-[#e4effa] rounded-2xl p-4 relative overflow-hidden">
                <div class="w-7 h-7 rounded-lg bg-[#3b82f6]/20 text-[#2563eb] flex items-center justify-center mb-2.5">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
                    </svg>
                </div>
                <h4 class="font-bold text-xs text-slate-800">Satu kampus, banyak rasa.</h4>
                <p class="text-[11px] text-slate-600 mt-1 leading-relaxed">
                    Kelola kantin lebih mudah, layani mahasiswa lebih baik.
                </p>
            </div>

            {{-- Pusat Bantuan & Logout --}}
            <div class="flex items-center justify-between px-2 text-xs font-semibold text-slate-500">
                <a href="#" class="flex items-center gap-2 hover:text-slate-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pusat bantuan
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-rose-500 hover:text-rose-700">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 flex flex-col min-w-0">
        @yield('content')
    </main>

</div>

</body>
</html>
