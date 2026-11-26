@extends('admin')

@section('content')
<div class="p-8">
    
    {{-- Header Dashboard with Blurred Esa Unggul Campus Backdrop --}}
    <div class="relative overflow-hidden rounded-3xl p-6 sm:p-8 bg-gradient-to-r from-blue-900 via-slate-900 to-blue-950 text-white mb-8 shadow-md border border-slate-800">
        <img src="{{ asset('images/kampus-esaunggul.jpg') }}" alt="Kampus Esa Unggul" class="absolute inset-0 w-full h-full object-cover opacity-20 filter blur-xs scale-105 pointer-events-none">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white flex items-center gap-2">
                    Selamat siang, {{ $user->name ?? 'Admin' }} 👋
                </h1>
                <p class="text-blue-200 text-sm mt-1">
                    @if(isset($isSuperAdmin) && $isSuperAdmin)
                        Ini ringkasan operasional seluruh kantin kampus hari ini.
                    @else
                        Ini ringkasan operasional kantin <span class="font-bold text-orange-400">{{ $user->outlet->nama_outlet ?? 'Kantin Anda' }}</span> hari ini.
                    @endif
                </p>
            </div>

            {{-- Badge Tanggal Hari Ini --}}
            <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/15 text-xs font-semibold text-white">
                <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-width="2"/>
                    <line x1="16" y1="2" x2="16" y2="6" stroke-width="2"/>
                    <line x1="8" y1="2" x2="8" y2="6" stroke-width="2"/>
                    <line x1="3" y1="10" x2="21" y2="10" stroke-width="2"/>
                </svg>
                <span>{{ now()->translatedFormat('d M Y') }} &bull; Hari ini</span>
            </div>
        </div>
    </div>

    {{-- BARIS 3 KOTAK: Total Transaksi, Ringkasan Pesanan, Status Pesanan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        {{-- KOTAK 1: TOTAL TRANSAKSI --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between text-slate-500 mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Transaksi</span>
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-slate-800">
                Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
            </div>
            <p class="text-xs text-slate-500 mt-3 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="font-bold text-slate-700">{{ $totalTransaksiBerhasil ?? 0 }}</span> pesanan berhasil dibayar
            </p>
        </div>

        {{-- KOTAK 2: RINGKASAN PESANAN --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between text-slate-500 mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Ringkasan Pesanan</span>
                <div class="w-9 h-9 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-slate-800">
                {{ $totalOrder ?? 0 }} <span class="text-sm font-semibold text-slate-400">Total Order</span>
            </div>
            <div class="flex items-center gap-2.5 mt-3 text-xs">
                <span class="bg-orange-50 text-orange-700 font-semibold px-2.5 py-1 rounded-lg">
                    {{ $orderAktif ?? 0 }} order aktif
                </span>
                <span class="bg-emerald-50 text-emerald-700 font-semibold px-2.5 py-1 rounded-lg">
                    {{ $orderSelesai ?? 0 }} selesai
                </span>
            </div>
        </div>

        {{-- KOTAK 3: STATUS PESANAN --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between text-slate-500 mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Status Pesanan</span>
                <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2 text-xs">
                <div class="flex items-center justify-between bg-slate-50 p-2 rounded-lg">
                    <span class="text-slate-600 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span> Dikonfirmasi
                    </span>
                    <span class="font-bold text-slate-800">{{ $statusCounts['konfirmasi'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between bg-slate-50 p-2 rounded-lg">
                    <span class="text-slate-600 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-[#f97316]"></span> Disiapkan
                    </span>
                    <span class="font-bold text-slate-800">{{ $statusCounts['disiapkan'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between bg-slate-50 p-2 rounded-lg">
                    <span class="text-slate-600 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-teal-500"></span> Siap Ambil
                    </span>
                    <span class="font-bold text-slate-800">{{ $statusCounts['siap'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between bg-slate-50 p-2 rounded-lg">
                    <span class="text-slate-600 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Selesai
                    </span>
                    <span class="font-bold text-slate-800">{{ $statusCounts['selesai'] ?? 0 }}</span>
                </div>
            </div>
        </div>

    </div>

    {{-- KOTAK BAWAH: HANYA ORDER TERBARU --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        
        <div class="p-6 pb-4 flex items-center justify-between border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-800">Order terbaru</h2>
                <p class="text-xs text-slate-400 mt-0.5">Daftar pesanan transaksi paling baru</p>
            </div>
            <a href="{{ route('orders.index') }}" class="text-xs font-bold text-[#e04f44] hover:underline flex items-center gap-1">
                Lihat semua order &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-400 font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3.5">Kode / Pemesan</th>
                        @if(isset($isSuperAdmin) && $isSuperAdmin)
                            <th class="px-6 py-3.5">Outlet</th>
                        @endif
                        <th class="px-6 py-3.5">Total</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orderTerbaru ?? [] as $order)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-[#2563eb] text-sm">
                                    {{ $order->kode_order ?? 'EC-'.$order->id }}
                                </div>
                                <div class="text-xs text-slate-400 font-medium">
                                    {{ $order->user->name ?? $order->nama_pemesan ?? 'Pelanggan' }}
                                </div>
                            </td>

                            @if(isset($isSuperAdmin) && $isSuperAdmin)
                                <td class="px-6 py-4">
                                    <span class="inline-block px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 text-xs font-semibold">
                                        {{ $order->outlet->nama_outlet ?? '-' }}
                                    </span>
                                </td>
                            @endif

                            <td class="px-6 py-4 font-extrabold text-slate-800">
                                Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $st = strtolower($order->status ?? 'sedang_disiapkan');
                                    $badge = match($st) {
                                        'sedang_disiapkan'    => ['bg' => 'bg-[#ffedd5]', 'text' => 'text-[#c2410c]', 'dot' => 'bg-[#ea580c]', 'label' => 'Sedang disiapkan'],
                                        'dikonfirmasi'        => ['bg' => 'bg-[#fef3c7]', 'text' => 'text-[#b45309]', 'dot' => 'bg-[#d97706]', 'label' => 'Pesanan dikonfirmasi'],
                                        'siap_diambil'        => ['bg' => 'bg-[#ccfbf1]', 'text' => 'text-[#0f766e]', 'dot' => 'bg-[#0d9488]', 'label' => 'Siap diambil'],
                                        'selesai'             => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'dot' => 'bg-slate-400', 'label' => 'Selesai'],
                                        default               => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'dot' => 'bg-slate-400', 'label' => ucfirst($st)],
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $badge['bg'] }} {{ $badge['text'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $badge['dot'] }}"></span>
                                    {{ $badge['label'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-xs font-medium text-slate-400 whitespace-nowrap">
                                {{ optional($order->created_at)->format('H.i') ?? now()->format('H.i') }} WIB
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ (isset($isSuperAdmin) && $isSuperAdmin) ? 5 : 4 }}" class="px-6 py-10 text-center text-slate-400 text-xs">
                                Belum ada pesanan masuk hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-100 text-xs text-slate-500 flex items-center justify-between">
            <span>{{ count($orderTerbaru ?? []) }} order terbaru hari ini</span>
            <div class="flex items-center gap-1">
                <span class="w-6 h-6 flex items-center justify-center rounded bg-slate-200 text-slate-700 font-bold text-xs">1</span>
            </div>
        </div>

    </div>

</div>
@endsection
