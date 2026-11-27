<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esa Corner - Lacak & Cek Pesanan Kantin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', Arial, sans-serif;
        }

        :root {
            --primary: #f15a29;
            --primary-hover: #d94a1d;
            --primary-light: #fff3ee;
            --dark: #101735;
            --dark-surface: #172044;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --bg-body: #f5f6fa;
        }

        body {
            background-color: var(--bg-body);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR DESKTOP */
        .navbar {
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
            box-shadow: 0 2px 10px rgba(0,0,0,.06);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            color: #0066B3;
            text-decoration: none;
        }

        .nav-center-menu {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-center-menu a {
            text-decoration: none;
            color: var(--dark);
            font-size: 14px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .nav-center-menu a:hover, .nav-center-menu a.active {
            color: var(--primary);
            background: var(--primary-light);
            font-weight: 700;
        }

        .btn-back-home {
            text-decoration: none;
            color: var(--dark);
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background: white;
            transition: all 0.2s;
        }

        .btn-back-home:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* DESKTOP CONTAINER (86% WIDTH PERSIS DI MENU) */
        .desktop-container {
            width: 86%;
            max-width: 1400px;
            margin: 25px auto 60px auto;
            flex: 1;
        }

        /* OUTLET HERO HEADER (COMPACT, DENGAN FOTO ESGUL SEPERTI BERANDA) */
        .track-hero {
            background-color: #EAF4FF;
            border-radius: 18px;
            overflow: hidden;
            color: #0f172a;
            display: flex;
            align-items: center;
            min-height: 112px;
            margin-bottom: 18px;
            position: relative;
            border: 1px solid rgba(191, 219, 254, 0.8);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.06);
        }

        .track-hero-content {
            width: 65%;
            padding: 20px 30px;
            position: relative;
            z-index: 2;
        }

        .track-hero-content h1 {
            font-size: 21px;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 4px;
            color: #0f172a;
        }

        .track-hero-content h1 span {
            color: var(--primary);
        }

        .track-hero-content p {
            color: #475569;
            font-size: 12.5px;
            line-height: 1.45;
            max-width: 560px;
            font-weight: 500;
        }

        .track-hero-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 70% 35%;
            filter: brightness(1) contrast(1.05);
            z-index: 0;
        }

        .track-hero-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background: linear-gradient(90deg, #EAF4FF 0%, rgba(234, 244, 255, 0.95) 45%, rgba(234, 244, 255, 0.7) 65%, rgba(234, 244, 255, 0.2) 82%, transparent 100%);
        }

        @media (max-width: 768px) {
            .track-hero-content {
                width: 100%;
                padding: 18px 20px;
            }
            .track-hero-overlay {
                background: linear-gradient(180deg, rgba(234, 244, 255, 0.96) 0%, rgba(234, 244, 255, 0.85) 60%, rgba(234, 244, 255, 0.45) 100%);
            }
        }        /* SEARCH BAR */
        .search-bar-wrap {
            background: white;
            border-radius: 14px;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            border: 1px solid #edf2f7;
            flex-wrap: wrap;
            gap: 16px;
        }

        .search-form-inline {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            min-width: 320px;
        }

        .search-input-box {
            position: relative;
            flex: 1;
        }

        .search-input-box input {
            width: 100%;
            padding: 11px 16px 11px 40px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            color: var(--dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            outline: none;
            transition: all 0.2s;
        }

        .search-input-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(241, 90, 41, 0.15);
        }

        .search-input-box .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        .btn-main-orange {
            background: var(--primary);
            color: white;
            border: none;
            padding: 11px 22px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-main-orange:hover {
            background: var(--primary-hover);
            box-shadow: 0 4px 14px rgba(241, 90, 41, 0.28);
        }

        .recent-chips-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .chip-label {
            font-size: 12px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
        }

        .chip-btn {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            transition: all 0.15s;
        }

        .chip-btn:hover {
            background: var(--primary-light);
            border-color: #fdba74;
            color: var(--primary);
        }

        /* 2-COLUMN DESKTOP GRID */
        .track-grid {
            display: grid;
            grid-template-columns: 1fr 390px;
            gap: 28px;
            align-items: start;
        }

        @media (max-width: 1080px) {
            .track-grid {
                grid-template-columns: 1fr;
            }
        }

        .left-col {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        /* STATUS BANNER CARD */
        .status-hero-card {
            background: white;
            border-radius: 14px;
            padding: 16px 22px;
            border: 1.5px solid #edf2f7;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
        }

        .status-avatar {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .status-meta h2 {
            font-size: 17px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 2px;
        }

        .status-meta p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.4;
        }

        /* STEPPER CARD */
        .stepper-card {
            background: white;
            border-radius: 16px;
            padding: 30px 24px;
            border: 1.5px solid #edf2f7;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .stepper-header-title {
            font-size: 13px;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stepper-wrap {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .stepper-line-bg {
            position: absolute;
            top: 24px;
            left: 8%;
            right: 8%;
            height: 4px;
            background: #e2e8f0;
            z-index: 1;
        }

        .stepper-line-fill {
            position: absolute;
            top: 24px;
            left: 8%;
            height: 4px;
            background: linear-gradient(90deg, #10b981 0%, #f97316 50%, #059669 100%);
            z-index: 2;
            transition: width 0.5s ease;
            width: 0%;
        }

        .step-col {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 25%;
            text-align: center;
        }

        .step-icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: 3px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 800;
            color: #94a3b8;
            margin-bottom: 12px;
            transition: all 0.3s;
        }

        .step-col.completed .step-icon-circle {
            background: #10b981;
            border-color: #10b981;
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .step-col.active .step-icon-circle {
            background: #f15a29;
            border-color: #fed7aa;
            color: white;
            box-shadow: 0 0 0 6px rgba(241, 90, 41, 0.18);
            transform: scale(1.08);
        }

        .step-title-txt {
            font-size: 13.5px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 4px;
        }

        .step-col.completed .step-title-txt {
            color: #10b981;
        }

        .step-col.active .step-title-txt {
            color: #f15a29;
            font-weight: 800;
        }

        .step-desc-txt {
            font-size: 11px;
            color: #94a3b8;
            max-width: 140px;
            line-height: 1.35;
        }

        /* ITEMS CARD */
        .items-card-desktop {
            background: white;
            border-radius: 16px;
            border: 1.5px solid #edf2f7;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .items-header {
            padding: 18px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #edf2f7;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .items-header h3 {
            font-size: 16px;
            font-weight: 800;
            color: var(--dark);
        }

        .items-badge-count {
            background: #e2e8f0;
            color: #334155;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .item-row {
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f1f5f9;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-info-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .item-qty-circle {
            background: #fff3ee;
            color: var(--primary);
            border: 1.5px solid #fed7aa;
            font-size: 13px;
            font-weight: 800;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .item-text-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 2px;
        }

        .item-text-customer {
            font-size: 12.5px;
            color: #94a3b8;
        }

        .item-price-sub {
            font-size: 15px;
            font-weight: 800;
            color: var(--dark);
            text-align: right;
        }

        .item-price-unit {
            font-size: 12px;
            color: #94a3b8;
            font-weight: 500;
        }

        /* INFO CARD */
        .info-card-desktop {
            background: white;
            border-radius: 16px;
            padding: 22px 24px;
            border: 1.5px solid #edf2f7;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        @media (max-width: 768px) {
            .info-card-desktop {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .info-box-title {
            font-size: 11.5px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .info-box-val {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
        }        /* RIGHT COLUMN (STICKY SIDEBAR) */
        .right-col {
            position: sticky;
            top: 95px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .ticket-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            border: 1.5px solid #edf2f7;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
            text-align: center;
        }

        .ticket-badge-tag {
            display: inline-block;
            background: #f1f5f9;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 6px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .ticket-code {
            font-size: 26px;
            font-weight: 900;
            color: var(--primary);
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .btn-copy-code {
            background: #f8fafc;
            border: 1.5px solid #cbd5e1;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-copy-code:hover {
            background: #e2e8f0;
        }

        .ticket-status-pill {
            margin-top: 18px;
            padding: 10px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .ticket-pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            animation: dotPulse 1.5s infinite;
        }

        @keyframes dotPulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(255, 255, 255, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
        }

        .ticket-note {
            margin-top: 14px;
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.4;
        }

        .payment-summary-card {
            background: white;
            border-radius: 16px;
            padding: 22px 24px;
            border: 1.5px solid #edf2f7;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .summary-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 14px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 10px;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            font-size: 13.5px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .summary-total-line {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1.5px dashed #cbd5e1;
        }

        .summary-total-line span {
            font-size: 14px;
            font-weight: 700;
            color: var(--dark);
        }

        .summary-total-line strong {
            font-size: 22px;
            font-weight: 900;
            color: var(--primary);
        }

        .demo-sim-card {
            background: #fff8f5;
            border: 1.5px dashed #fed7aa;
            border-radius: 16px;
            padding: 20px;
        }

        .demo-sim-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .demo-sim-title {
            font-size: 12.5px;
            font-weight: 800;
            color: #9a3412;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .demo-tag {
            background: var(--primary);
            color: white;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 10px;
        }

        .demo-sim-desc {
            font-size: 11.5px;
            color: #7c2d12;
            margin-bottom: 14px;
            line-height: 1.35;
        }

        .demo-btn-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .btn-sim-action {
            background: white;
            border: 1.5px solid #fdba74;
            padding: 8px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            color: #7c2d12;
            cursor: pointer;
            transition: all 0.15s;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-sim-action:hover {
            background: #fff3ee;
            border-color: var(--primary);
        }

        .btn-sim-action.active {
            background: var(--dark);
            color: white;
            border-color: var(--dark);
        }

        .side-action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-side-white {
            background: white;
            border: 1.5px solid #cbd5e1;
            padding: 12px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 700;
            color: #334155;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-side-white:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .state-feedback-card {
            background: white;
            border-radius: 16px;
            padding: 60px 30px;
            text-align: center;
            border: 1.5px solid #edf2f7;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
            display: none;
        }

        .state-icon-big {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .state-title-big {
            font-size: 22px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .state-desc-big {
            font-size: 14px;
            color: #64748b;
            max-width: 450px;
            margin: 0 auto 20px;
            line-height: 1.5;
        }
    </style>
</head>
<body>

<!-- DESKTOP NAVBAR -->
<nav class="navbar">
    <a href="{{ url('/') }}" class="logo" style="text-decoration: none; display: flex; flex-direction: column; line-height: 1; color: #0066B3;">
        <div style="display: flex; align-items: center; font-weight: 900; font-size: 25px; letter-spacing: -0.02em; color: #0066B3; text-shadow: 0 2px 8px rgba(0, 102, 179, 0.2);">
            <span>Esa</span>
            <span style="margin-left: 6px; display: inline-flex; align-items: center;">
                <span>C</span>
                <img src="{{ asset('images/esa-logo.png') }}" alt="o" style="width: 26px; height: 26px; object-fit: contain; display: inline-block; margin: 0 2px -2px 2px;">
                <span>rner</span>
            </span>
        </div>
        <span style="font-size: 10.5px; font-weight: 700; color: #64748b; letter-spacing: 0.05em; text-transform: uppercase; margin-top: 4px;">
            Kantin Kampus Terpadu
        </span>
    </a>
    
    <div class="nav-center-menu">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/#kantin-section') }}">Kantin</a>
        <a href="{{ route('order.track') }}" class="active">Pesanan Kantin</a>
    </div>

    <div class="nav-right">
        <a href="{{ url('/') }}" class="btn-back-home">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
            Kembali ke Beranda
        </a>
    </div>
</nav>

<div class="desktop-container">

    <!-- OUTLET HERO BANNER (COMPACT DENGAN FOTO ESGUL) -->
    <div class="track-hero">
        <img src="{{ asset('images/kampus-esaunggul.jpg') }}" class="track-hero-bg" alt="Gedung Kampus Universitas Esa Unggul">
        <div class="track-hero-overlay"></div>
        <div class="track-hero-content">
            <h1>Cek Status Pesanan Anda</h1>
            <p>Temukan informasi terbaru tentang pesananmu, mulai dari proses persiapan hingga makanan siap diambil.</p>
        </div>
    </div>

    <!-- SEARCH & QUICK CODE SWITCHER BAR -->
    <div class="search-bar-wrap">
        <form class="search-form-inline" onsubmit="event.preventDefault(); loadOrderByInput();">
            <div class="search-input-box">
                <span class="icon">🏷️</span>
                <input 
                    type="text" 
                    id="orderCodeInput" 
                    placeholder="Masukkan Kode Pesanan (Contoh: ORD-XXXXXX)" 
                    value="{{ $orderCode ?? '' }}"
                    required
                >
            </div>
            <button type="submit" class="btn-main-orange">
                <span>Lacak</span> →
            </button>
        </form>

        <div class="recent-chips-wrap" id="recentSection" style="display: none;">
            <span class="chip-label">Pesanan Anda:</span>
            <div id="recentChips" style="display: flex; gap: 6px; flex-wrap: wrap;"></div>
        </div>
    </div>

    <!-- STATE FEEDBACK: LOADING -->
    <div class="state-feedback-card" id="loadingState">
        <div class="state-icon-big">⏳</div>
        <div class="state-title-big">Menghubungkan ke Dapur Kantin...</div>
        <div class="state-desc-big">Mohon tunggu sebentar, sistem sedang memuat status pesanan anda.</div>
    </div>

    <!-- STATE FEEDBACK: NOT FOUND -->
    <div class="state-feedback-card" id="notFoundState">
        <div class="state-icon-big">❌</div>
        <div class="state-title-big">Pesanan Tidak Ditemukan</div>
        <div class="state-desc-big" id="notFoundMessage">Pastikan kode pesanan yang Anda masukkan sudah benar .</div>
        <a href="/" class="btn-main-orange" style="display: inline-flex;">Kembali ke Beranda</a>
    </div>    <!-- MAIN 2-COLUMN DESKTOP GRID -->
    <div class="track-grid" id="trackMainGrid" style="display: none;">

        <!-- LEFT COLUMN: STATUS, STEPPER, ITEMS, INFO -->
        <div class="left-col">
            
            <!-- DYNAMIC STATUS HERO CARD -->
            <div class="status-hero-card" id="statusCard">
                <div class="status-avatar" id="statusAvatar" style="background: #dcfce7; color: #16a34a;">
                    ✓
                </div>
                <div class="status-meta">
                    <h2 id="statusTitle">Pembayaran Berhasil Terverifikasi!</h2>
                    <p id="statusDesc">Pesanan Anda telah diterima kantin dan segera diteruskan ke dapur untuk disiapkan.</p>
                </div>
            </div>

            <!-- DESKTOP STEPPER CARD -->
            <div class="stepper-card">
                <div class="stepper-header-title">
                    <span>Tahapan Proses Pesanan</span>
                        
                </div>

                <div class="stepper-wrap">
                    <div class="stepper-line-bg"></div>
                    <div class="stepper-line-fill" id="stepperFill"></div>

                    <!-- Step 1 -->
                    <div class="step-col completed" id="step1">
                        <div class="step-icon-circle" id="circle1">💳</div>
                        <div class="step-title-txt">1. Bayar Berhasil</div>
                        <div class="step-desc-txt">Lunas terverifikasi</div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-col" id="step2">
                        <div class="step-icon-circle" id="circle2">🍳</div>
                        <div class="step-title-txt">2. Menyiapkan</div>
                        <div class="step-desc-txt">Koki sedang memasak</div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-col" id="step3">
                        <div class="step-icon-circle" id="circle3">🔔</div>
                        <div class="step-title-txt">3. Pesanan Siap</div>
                        <div class="step-desc-txt">Siap diambil di kasir</div>
                    </div>

                    <!-- Step 4 -->
                    <div class="step-col" id="step4">
                        <div class="step-icon-circle" id="circle4">✨</div>
                        <div class="step-title-txt">4. Selesai</div>
                        <div class="step-desc-txt">Selamat menikmati</div>
                    </div>
                </div>
            </div>

            <!-- ITEMS CARD -->
            <div class="items-card-desktop">
                <div class="items-header">
                    <h3>Rincian Menu Dipesan</h3>
                    <span class="items-badge-count" id="itemsCountBadge">0 Item</span>
                </div>
                <div id="itemsListContainer">
                    <!-- Diisi lewat JavaScript -->
                </div>
            </div>

            <!-- INFO CARD -->
            <div class="info-card-desktop">
                <div>
                    <div class="info-box-title">Kantin / Outlet</div>
                    <div class="info-box-val" id="infoOutletName">-</div>
                </div>
                <div>
                    <div class="info-box-title">Jenis Layanan</div>
                    <div class="info-box-val" id="infoServiceType">-</div>
                </div>
                <div>
                    <div class="info-box-title">Tipe Pesanan</div>
                    <div class="info-box-val" id="infoOrderType">-</div>
                </div>
                <div>
                    <div class="info-box-title">Waktu Pemesanan</div>
                    <div class="info-box-val" id="infoOrderTime">-</div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: STICKY SIDEBAR -->
        <div class="right-col">

            <!-- TICKET PASS CARD -->
            <div class="ticket-card">
                <div class="ticket-badge-tag">TIKET PESANAN KANTIN</div>
                <div class="ticket-code" id="displayTicketCode">ORD-XXXXXX</div>
                <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                    <button type="button" class="btn-copy-code" onclick="copyOrderCode()">
                        <span>📋 Salin Kode</span>
                    </button>
                    <a id="btnTicketInvoice" href="#" class="btn-copy-code" style="background: var(--primary-light); color: var(--primary); border-color: #fed7aa; text-decoration: none;">
                        <span>📄 Lihat Invoice</span>
                    </a>
                </div>

                <div class="ticket-status-pill" id="ticketStatusPill" style="background: #dcfce7; color: #16a34a;">
                    <div class="ticket-pulse-dot"></div>
                    <span id="ticketStatusLabel">Pembayaran Berhasil</span>
                </div>

                <div class="ticket-note">
                    Tunjukkan kode pesanan ini ke kasir atau counter kantin saat Anda mengambil makanan.
                </div>
            </div>

            <!-- PAYMENT SUMMARY CARD -->
            <div class="payment-summary-card">
                <div class="summary-title">Rincian Pembayaran</div>
                <div class="summary-line">
                    <span>Metode Bayar</span>
                    <span style="font-weight: 700; color: var(--dark);">QRIS Esa Corner</span>
                </div>
                <div class="summary-line">
                    <span>Status Verifikasi</span>
                    <span style="color: #10b981; font-weight: 700;">LUNAS ✓</span>
                </div>
                <div class="summary-total-line">
                    <span>Total Pembayaran</span>
                    <strong id="displayTotalPrice">Rp 0</strong>
                </div>
            </div>

        

            <!-- SIDEBAR ACTION BUTTONS -->
            <div class="side-action-buttons">
                <a id="btnOrderMore" href="/menu/1" class="btn-main-orange" style="justify-content: center; width: 100%;">
                    <span>+ Pesan Menu Lain</span>
                </a>
            </div>

        </div>

    </div>

</div><script>
    let activeOrderCode = "{{ $orderCode ?? '' }}";
    const initialOrderData = @json($initialOrderData ?? null);
    let pollInterval = null;
    let lastKnownStatus = '';

    document.addEventListener('DOMContentLoaded', () => {
        loadRecentOrdersUI();

        if (initialOrderData) {
            renderOrderData(initialOrderData);
            showView('result');
            saveToRecentOrders(initialOrderData);
            if (initialOrderData.status !== 'completed') {
                startAutoPolling(initialOrderData.order_code);
            }
        } else if (activeOrderCode) {
            fetchOrder(activeOrderCode);
        } else {
            const lastCode = localStorage.getItem('esa_last_order_code');
            if (lastCode) {
                document.getElementById('orderCodeInput').value = lastCode;
                fetchOrder(lastCode);
            } else {
                showView('searchOnly');
            }
        }
    });

    function loadOrderByInput() {
        const inputVal = document.getElementById('orderCodeInput').value.trim();
        if (!inputVal) return;
        fetchOrder(inputVal);
    }

    async function fetchOrder(orderCode) {
        activeOrderCode = orderCode;
        showView('loading');

        try {
            const res = await fetch(`/order/${orderCode}/status`, {
                headers: { 'Accept': 'application/json' }
            });
            const data = await res.json();

            if (data.success && data.order) {
                renderOrderData(data.order);
                showView('result');
                saveToRecentOrders(data.order);
                startAutoPolling(orderCode);
            } else {
                document.getElementById('notFoundMessage').innerText = data.message || 'Pesanan tidak ditemukan.';
                showView('notFound');
                stopAutoPolling();
            }
        } catch (err) {
            console.error(err);
            document.getElementById('notFoundMessage').innerText = 'Gagal memuat status pesanan. Pastikan server aktif.';
            showView('notFound');
            stopAutoPolling();
        }
    }

    function renderOrderData(order) {
        document.getElementById('displayTicketCode').innerText = order.order_code;
        document.getElementById('orderCodeInput').value = order.order_code;
        document.getElementById('infoOutletName').innerText = order.outlet_name || 'Kantin Kampus';
        document.getElementById('infoServiceType').innerText = order.service_type_label;
        document.getElementById('infoOrderType').innerText = order.order_type_label;
        document.getElementById('infoOrderTime').innerText = order.created_at;
        document.getElementById('displayTotalPrice').innerText = order.formatted_total;
        const inv1 = document.getElementById('btnTicketInvoice');
        if (inv1) inv1.href = `/order/invoice/${order.order_code}`;
        const inv2 = document.getElementById('btnSummaryInvoice');
        if (inv2) inv2.href = `/order/invoice/${order.order_code}`;
        document.getElementById('itemsCountBadge').innerText = `${order.items.length} Item`;

        if (order.outlet_id) {
            document.getElementById('btnOrderMore').href = `/menu/${order.outlet_id}`;
        }

        const listContainer = document.getElementById('itemsListContainer');
        listContainer.innerHTML = order.items.map(item => `
            <div class="item-row">
                <div class="item-info-left">
                    <div class="item-qty-circle">${item.quantity}x</div>
                    <div>
                        <div class="item-text-title">${escapeHtml(item.menu_name)}</div>
                        <div class="item-text-customer">${item.customer_name ? 'Pemesan: ' + escapeHtml(item.customer_name) : ''}</div>
                    </div>
                </div>
                <div class="item-price-sub">
                    <div>${item.formatted_subtotal}</div>
                    <div class="item-price-unit">@ ${item.formatted_price}</div>
                </div>
            </div>
        `).join('');

        updateStatusUI(order.status, order.step);
        updateDemoButtons(order.status);

        if (lastKnownStatus && lastKnownStatus !== order.status && order.status === 'ready') {
            playReadyChime();
        }
        lastKnownStatus = order.status;
    }

    function updateStatusUI(status, step) {
        const avatar = document.getElementById('statusAvatar');
        const title = document.getElementById('statusTitle');
        const desc = document.getElementById('statusDesc');
        const pill = document.getElementById('ticketStatusPill');
        const pillLabel = document.getElementById('ticketStatusLabel');
        const fill = document.getElementById('stepperFill');

        for (let i = 1; i <= 4; i++) {
            const col = document.getElementById(`step${i}`);
            col.className = 'step-col';
        }

        if (status === 'paid') {
            avatar.style.background = '#dcfce7';
            avatar.style.color = '#16a34a';
            avatar.innerText = '✓';
            title.innerText = 'Pembayaran Berhasil Terverifikasi!';
            desc.innerText = 'Pesanan Anda telah diterima kantin dan segera diteruskan ke dapur untuk disiapkan.';

            pill.style.background = '#dcfce7';
            pill.style.color = '#16a34a';
            pillLabel.innerText = 'Pembayaran Berhasil';

            fill.style.width = '0%';
            document.getElementById('step1').classList.add('completed');
            document.getElementById('step2').classList.add('active');
        } else if (status === 'cooking') {
            avatar.style.background = '#ffedd5';
            avatar.style.color = '#ea580c';
            avatar.innerText = '🍳';
            title.innerText = 'Koki Sedang Menyiapkan Pesanan Anda';
            desc.innerText = 'Makanan Anda sedang dimasak dengan higienis di dapur kantin. Estimasi waktu 5 - 10 menit.';

            pill.style.background = '#ffedd5';
            pill.style.color = '#ea580c';
            pillLabel.innerText = 'Menyiapkan Pesanan';

            fill.style.width = '40%';
            document.getElementById('step1').classList.add('completed');
            document.getElementById('step2').classList.add('completed');
            document.getElementById('step3').classList.add('active');
        } else if (status === 'ready') {
            avatar.style.background = '#d1fae5';
            avatar.style.color = '#047857';
            avatar.innerText = '🔔';
            title.innerText = 'Hore! Pesanan Anda Sudah Siap Diambil!';
            desc.innerText = 'Silakan segera datangi kasir atau counter kantin dan tunjukkan kode pesanan Anda.';

            pill.style.background = '#d1fae5';
            pill.style.color = '#047857';
            pillLabel.innerText = 'Pesanan Siap Diambil!';

            fill.style.width = '75%';
            document.getElementById('step1').classList.add('completed');
            document.getElementById('step2').classList.add('completed');
            document.getElementById('step3').classList.add('completed');
            document.getElementById('step4').classList.add('active');
        } else if (status === 'completed') {
            avatar.style.background = '#dbeafe';
            avatar.style.color = '#1d4ed8';
            avatar.innerText = '✨';
            title.innerText = 'Pesanan Telah Selesai';
            desc.innerText = 'Terima kasih telah berbelanja di Esa Corner. Selamat menikmati hidangan lezat Anda!';

            pill.style.background = '#dbeafe';
            pill.style.color = '#1d4ed8';
            pillLabel.innerText = 'Pesanan Selesai';

            fill.style.width = '100%';
            document.getElementById('step1').classList.add('completed');
            document.getElementById('step2').classList.add('completed');
            document.getElementById('step3').classList.add('completed');
            document.getElementById('step4').classList.add('completed');
        } else {
            pill.style.background = '#fef3c7';
            pill.style.color = '#d97706';
            pillLabel.innerText = 'Menunggu Pembayaran';
            fill.style.width = '0%';
        }
    }

    function updateDemoButtons(currentStatus) {
        ['paid', 'cooking', 'ready', 'completed'].forEach(s => {
            const btn = document.getElementById('sim' + s.charAt(0).toUpperCase() + s.slice(1));
            if (btn) {
                if (s === currentStatus) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            }
        });
    }

    async function simulateStatus(newStatus) {
        if (!activeOrderCode) return;
        try {
            const res = await fetch(`/order/${activeOrderCode}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ request()->hasSession() ? csrf_token() : '' }}'
                },
                body: JSON.stringify({ status: newStatus })
            });
            const data = await res.json();
            if (data.success) {
                fetchOrder(activeOrderCode);
            }
        } catch (err) {
            console.error('Gagal simulasi status:', err);
        }
    }

    function startAutoPolling(orderCode) {
        stopAutoPolling();
        pollInterval = setInterval(async () => {
            try {
                const res = await fetch(`/order/${orderCode}/status`, {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success && data.order) {
                    renderOrderData(data.order);
                    if (data.order.status === 'completed') {
                        stopAutoPolling();
                    }
                }
            } catch (e) {}
        }, 3000);
    }

    function stopAutoPolling() {
        if (pollInterval) {
            clearInterval(pollInterval);
            pollInterval = null;
        }
    }

    function showView(view) {
        document.getElementById('loadingState').style.display = view === 'loading' ? 'block' : 'none';
        document.getElementById('notFoundState').style.display = view === 'notFound' ? 'block' : 'none';
        document.getElementById('trackMainGrid').style.display = view === 'result' ? 'grid' : 'none';
    }

    function copyOrderCode() {
        if (!activeOrderCode) return;
        navigator.clipboard.writeText(activeOrderCode).then(() => {
            alert(`Kode pesanan ${activeOrderCode} berhasil disalin!`);
        });
    }

    function playReadyChime() {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(587.33, ctx.currentTime);
            osc.frequency.setValueAtTime(880, ctx.currentTime + 0.15);
            gain.gain.setValueAtTime(0.3, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.6);
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.start();
            osc.stop(ctx.currentTime + 0.6);
        } catch (e) {}
    }

    function saveToRecentOrders(order) {
        try {
            let list = JSON.parse(localStorage.getItem('esa_recent_orders') || '[]');
            list = list.filter(o => o.code !== order.order_code);
            list.unshift({
                code: order.order_code,
                outlet: order.outlet_name,
                total: order.formatted_total,
                status: order.status
            });
            if (list.length > 5) list = list.slice(0, 5);
            localStorage.setItem('esa_recent_orders', JSON.stringify(list));
            localStorage.setItem('esa_last_order_code', order.order_code);
            loadRecentOrdersUI();
        } catch (e) {}
    }

    function loadRecentOrdersUI() {
        try {
            const list = JSON.parse(localStorage.getItem('esa_recent_orders') || '[]');
            const container = document.getElementById('recentChips');
            const section = document.getElementById('recentSection');
            if (!container || !section) return;

            if (list.length > 0) {
                section.style.display = 'flex';
                container.innerHTML = list.map(item => `
                    <button type="button" class="chip-btn" onclick="fetchOrder('${item.code}')">
                        🏷️ ${item.code}
                    </button>
                `).join('');
            } else {
                section.style.display = 'none';
            }
        } catch (e) {}
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
</script>

</body>
</html>