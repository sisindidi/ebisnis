<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $order->order_code }} - {{ $order->outlet->name ?? 'Esa Corner' }}</title>

    <style>
        :root {
            --orange: #e87522;
            --orange-dark: #c95d12;
            --text: #292929;
            --muted: #777;
            --line: #e8e3de;
            --paper: #fff;
            --page: #f4f2ef;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--page);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            padding: 28px 16px 40px;
        }

        .page {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }

        .actions-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .back-link {
            color: #555;
            text-decoration: none;
            font-size: 13px;
        }

        .back-link:hover {
            color: var(--orange-dark);
        }

        .button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            border: 1px solid #d8d2cc;
            border-radius: 5px;
            background: #fff;
            color: #333;
            padding: 9px 13px;
            font: inherit;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            background: #f8f6f3;
        }

        .button-primary {
            color: #fff;
            background: var(--orange);
            border-color: var(--orange);
        }

        .button-primary:hover {
            background: var(--orange-dark);
            border-color: var(--orange-dark);
        }

        .receipt {
            background: var(--paper);
            border: 1px solid #e4ded8;
            border-radius: 6px;
            padding: 28px 30px;
            box-shadow: 0 2px 8px rgba(40, 30, 20, 0.04);
        }

        .receipt-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px dashed #cfc8c1;
        }

        .brand {
            font-size: 23px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: .4px;
        }

        .brand span {
            color: var(--orange);
        }

        .campus {
            color: var(--muted);
            font-size: 12px;
            margin-top: 4px;
        }

        .outlet-name {
            display: inline-block;
            margin-top: 10px;
            padding: 4px 10px;
            background: #f7f2ed;
            color: #5a4636;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 700;
        }

        .receipt-title {
            margin-top: 15px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .meta {
            padding: 17px 0;
            border-bottom: 1px dashed #cfc8c1;
        }

        .meta-row,
        .item-row,
        .total-row,
        .split-heading,
        .split-total {
            display: flex;
            justify-content: space-between;
            gap: 16px;
        }

        .meta-row {
            margin: 5px 0;
            font-size: 12.5px;
        }

        .meta-row span:first-child {
            color: var(--muted);
        }

        .meta-row span:last-child {
            text-align: right;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-block;
            color: #267448;
            background: #edf7ef;
            padding: 2px 7px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 700;
        }

        .section-title {
            margin: 20px 0 10px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .35px;
            text-transform: uppercase;
        }

        .item-row {
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #f0ede9;
            font-size: 13px;
        }

        .item-row:last-child {
            border-bottom: 0;
        }

        .item-name {
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .item-note {
            color: var(--muted);
            font-size: 11.5px;
            margin-top: 2px;
        }

        .price {
            white-space: nowrap;
            text-align: right;
        }

        .split-card {
            border: 1px solid #e8e1da;
            border-radius: 4px;
            padding: 12px 13px;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .split-heading {
            align-items: center;
            padding-bottom: 8px;
            margin-bottom: 5px;
            border-bottom: 1px solid #eee8e2;
            font-size: 13px;
            font-weight: 700;
        }

        .paid-label {
            color: #267448;
            font-size: 11px;
            font-weight: 600;
        }

        .split-card .item-row {
            border-bottom: 0;
            padding: 4px 0;
            color: #555;
            font-size: 12px;
        }

        .split-total {
            border-top: 1px solid #eee8e2;
            margin-top: 8px;
            padding-top: 9px;
            font-size: 12.5px;
            font-weight: 700;
        }

        .split-total .price,
        .grand-total .price {
            color: var(--orange-dark);
        }

        .totals {
            border-top: 1px dashed #cfc8c1;
            margin-top: 15px;
            padding-top: 13px;
        }

        .total-row {
            align-items: flex-start;
            margin: 6px 0;
            font-size: 12.5px;
        }

        .total-row span:first-child {
            color: #666;
        }

        .grand-total {
            border-top: 2px solid #333;
            margin-top: 12px;
            padding-top: 12px;
            font-size: 14px;
            font-weight: 700;
        }

        .grand-total .price {
            font-size: 18px;
            white-space: nowrap;
        }

        .receipt-footer {
            text-align: center;
            margin-top: 23px;
            padding-top: 15px;
            border-top: 1px dashed #cfc8c1;
            color: #777;
            font-size: 11.5px;
        }

        .receipt-footer p + p {
            margin-top: 4px;
        }

        .bottom-actions {
            display: grid;
            gap: 9px;
            margin-top: 14px;
        }

        .bottom-actions .button {
            width: 100%;
        }

        @media (max-width: 480px) {
            body {
                padding: 14px 10px 28px;
            }

            .receipt {
                padding: 23px 18px;
            }

            .brand {
                font-size: 21px;
            }

            .meta-row,
            .total-row {
                font-size: 12px;
            }

            .grand-total .price {
                font-size: 16px;
            }
        }

        @media print {
            @page {
                size: auto;
                margin: 10mm;
            }

            body {
                background: #fff !important;
                padding: 0 !important;
                font-size: 12px;
            }

            .no-print {
                display: none !important;
            }

            .page {
                max-width: 100%;
            }

            .receipt {
                border: 0;
                border-radius: 0;
                box-shadow: none;
                padding: 0;
            }

            .split-card,
            .item-row,
            .receipt-header,
            .meta,
            .totals {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
<div class="page">
    <div class="actions-top no-print">
        <a href="{{ route('menu.page', $order->outlet_id) }}" class="back-link">← Kembali ke menu</a>
        <button type="button" class="button" onclick="window.print()">Cetak struk</button>
    </div>

    <main class="receipt">
        <header class="receipt-header">
            <div class="brand">ESA <span>CORNER</span></div>
            <div class="campus">Universitas Esa Unggul</div>
            <div class="outlet-name">{{ $order->outlet->name ?? 'Outlet Kampus' }}</div>
            <div class="receipt-title">Struk Pembayaran</div>
        </header>

        <section class="meta" aria-label="Informasi transaksi">
            <div class="meta-row">
                <span>No. pesanan</span>
                <strong>#{{ $order->order_code }}</strong>
            </div>
            <div class="meta-row">
                <span>Tanggal</span>
                <span>{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-' }} WIB</span>
            </div>
            <div class="meta-row">
                <span>Jenis pesanan</span>
                <span>{{ $order->order_type === 'group' ? 'Pesan bersama (' . $customerSummary->count() . ' orang)' : 'Pesan sendiri' }}</span>
            </div>
            <div class="meta-row">
                <span>Layanan</span>
                <span>{{ $order->service_type === 'dine_in' ? 'Dine in' : 'Take away' }}</span>
            </div>
            <div class="meta-row">
                <span>Pembayaran</span>
                <span><span class="status">LUNAS · QRIS</span></span>
            </div>
        </section>

        @if($order->order_type === 'group')
            <h2 class="section-title">Rincian pesanan per orang</h2>

            @foreach($customerSummary as $cs)
                <section class="split-card">
                    <div class="split-heading">
                        <span>{{ $cs['name'] }}</span>
                        <span class="paid-label">Termasuk dalam pesanan</span>
                    </div>

                    @foreach($cs['items'] as $item)
                        <div class="item-row">
                            <span>{{ $item->quantity }}x {{ $item->menu ? $item->menu->name : 'Menu' }}</span>
                            <span class="price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    <div class="split-total">
                        <span>Total {{ $cs['name'] }}</span>
                        <span class="price">Rp {{ number_format($cs['total'], 0, ',', '.') }}</span>
                    </div>
                </section>
            @endforeach
        @else
            <h2 class="section-title">Rincian pesanan — {{ optional($order->items->first())->customer_name ?? 'Pelanggan' }}</h2>

            <section aria-label="Daftar menu">
                @foreach($order->items as $item)
                    <div class="item-row">
                        <div>
                            <div class="item-name">{{ $item->quantity }}x {{ $item->menu ? $item->menu->name : 'Menu' }}</div>
                            <div class="item-note">@ Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                        <span class="price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </section>
        @endif

        <section class="totals">
            @if($order->order_type === 'group')
                <div class="section-title" style="margin-top:0">Ringkasan split bill</div>
                @foreach($customerSummary as $cs)
                    <div class="total-row">
                        <span>{{ $cs['name'] }}</span>
                        <span class="price">Rp {{ number_format($cs['total'], 0, ',', '.') }}</span>
                    </div>
                @endforeach
            @endif

            <div class="total-row">
                <span>Subtotal</span>
                <span class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="total-row grand-total">
                <span>Total pembayaran</span>
                <span class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </section>

        

    <div class="bottom-actions no-print">
        <button type="button" class="button button-primary" onclick="window.print()">Cetak struk pembayaran</button>
        <a href="{{ route('order.track', $order->order_code) }}" class="button">Lacak status pesanan</a>
        <a href="{{ route('menu.page', $order->outlet_id) }}" class="button">Pesan menu lainnya</a>
    </div>
</div>
</body>
</html>
