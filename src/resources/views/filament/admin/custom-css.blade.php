<style>
    /* ==========================================================================
       ESA CORNER - BLUE FRESH DESIGN SYSTEM (FILAMENT V3)
       ========================================================================== */
    :root {
        --c-bg-main: #EAF4FF;
        --c-primary: #0875BD;
        --c-primary-hover: #065A92;
        --c-navy: #101735;
        --c-orange: #F15A29;
        --c-orange-hover: #D94819;
        --c-white: #FFFFFF;
        --c-border: #DCEAF7;
        --c-bg-secondary: #F5F8FC;
        --c-success: #16A36A;
        --c-danger: #E84B5B;
    }

    /* Base Layout Backgrounds */
    html, body, .fi-layout, .fi-main, .fi-main-ctn {
        background-color: #EAF4FF !important;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
    }

    /* Topbar / Navigation Header */
    .fi-topbar {
        background-color: #FFFFFF !important;
        border-bottom: 1px solid #DCEAF7 !important;
        box-shadow: 0 1px 4px 0 rgba(8, 117, 189, 0.04) !important;
    }

    /* Sidebar Styling */
    .fi-sidebar {
        background-color: #FFFFFF !important;
        border-right: 1px solid #DCEAF7 !important;
        box-shadow: 2px 0 10px rgba(8, 117, 189, 0.03) !important;
    }

    .fi-sidebar-header {
        border-bottom: 1px solid #DCEAF7 !important;
        background-color: #FFFFFF !important;
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    /* Sidebar Items */
    .fi-sidebar-item-button {
        border-radius: 0.75rem !important;
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        font-weight: 500 !important;
        color: #334155 !important;
    }

    .fi-sidebar-item-button:hover {
        background-color: #EAF4FF !important;
        color: #0875BD !important;
    }

    .fi-sidebar-item-button:hover .fi-sidebar-item-icon {
        color: #0875BD !important;
    }

    /* Active Sidebar Item */
    .fi-sidebar-item-active > a,
    .fi-sidebar-item-active > button,
    a.fi-sidebar-item-button[aria-current="page"] {
        background: linear-gradient(135deg, #0875BD 0%, #065A92 100%) !important;
        color: #FFFFFF !important;
        box-shadow: 0 4px 14px rgba(8, 117, 189, 0.28) !important;
        font-weight: 600 !important;
    }

    .fi-sidebar-item-active .fi-sidebar-item-icon,
    a.fi-sidebar-item-button[aria-current="page"] .fi-sidebar-item-icon {
        color: #FFFFFF !important;
    }

    .fi-sidebar-item-active .fi-sidebar-item-label,
    a.fi-sidebar-item-button[aria-current="page"] .fi-sidebar-item-label {
        color: #FFFFFF !important;
    }

    /* Group Labels */
    .fi-sidebar-group-label {
        color: #64748B !important;
        font-size: 0.725rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        padding-left: 0.5rem !important;
    }

    /* Page Header & Titles */
    .fi-header-heading, h1.fi-header-heading {
        color: #101735 !important;
        font-weight: 800 !important;
        letter-spacing: -0.02em !important;
    }

    .fi-header-subheading {
        color: #475569 !important;
        font-size: 0.95rem !important;
    }

    .fi-breadcrumbs a {
        color: #0875BD !important;
        font-weight: 500 !important;
    }

    /* Cards & Containers (White Card Design) */
    .fi-card,
    .fi-section,
    .fi-ta-ctn,
    .fi-wi-stats-overview-stat,
    .fi-wi-chart {
        background-color: #FFFFFF !important;
        border: 1px solid #DCEAF7 !important;
        border-radius: 1rem !important;
        box-shadow: 0 4px 20px -2px rgba(8, 117, 189, 0.05), 0 2px 6px -1px rgba(16, 23, 53, 0.02) !important;
    }

    /* Stat Cards Specific */
    .fi-wi-stats-overview-stat {
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .fi-wi-stats-overview-stat:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 10px 25px -4px rgba(8, 117, 189, 0.12) !important;
    }

    .fi-wi-stats-overview-stat-value {
        color: #101735 !important;
        font-weight: 800 !important;
        font-size: 1.85rem !important;
        letter-spacing: -0.02em !important;
    }

    .fi-wi-stats-overview-stat-label {
        color: #64748B !important;
        font-weight: 600 !important;
        font-size: 0.875rem !important;
    }

    /* Tables */
    .fi-ta-header {
        background-color: #FFFFFF !important;
        border-bottom: 1px solid #DCEAF7 !important;
        border-top-left-radius: 1rem !important;
        border-top-right-radius: 1rem !important;
    }

    .fi-ta-table {
        background-color: #FFFFFF !important;
    }

    .fi-ta-header-cell {
        background-color: #F5F8FC !important;
        color: #101735 !important;
        font-weight: 700 !important;
        font-size: 0.8125rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.04em !important;
        border-bottom: 1px solid #DCEAF7 !important;
        padding-top: 0.875rem !important;
        padding-bottom: 0.875rem !important;
    }

    .fi-ta-row {
        border-bottom: 1px solid #EBF2FA !important;
        transition: background-color 0.15s ease !important;
    }

    .fi-ta-row:hover {
        background-color: #F8FAFD !important;
    }

    .fi-ta-cell {
        color: #1E293B !important;
        font-size: 0.9125rem !important;
        padding-top: 0.875rem !important;
        padding-bottom: 0.875rem !important;
    }

    .fi-ta-pagination {
        background-color: #FFFFFF !important;
        border-top: 1px solid #DCEAF7 !important;
        border-bottom-left-radius: 1rem !important;
        border-bottom-right-radius: 1rem !important;
    }

    /* Buttons */
    /* Orange Accent Button (Tambah Menu & Important Actions) */
    .fi-btn-color-warning {
        background-color: #F15A29 !important;
        color: #FFFFFF !important;
        font-weight: 600 !important;
        border-radius: 0.625rem !important;
        box-shadow: 0 4px 12px rgba(241, 90, 41, 0.28) !important;
        transition: all 0.2s ease !important;
    }

    .fi-btn-color-warning:hover {
        background-color: #D94819 !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 16px rgba(241, 90, 41, 0.35) !important;
    }

    /* Primary Blue Button */
    .fi-btn-color-primary {
        background-color: #0875BD !important;
        color: #FFFFFF !important;
        font-weight: 600 !important;
        border-radius: 0.625rem !important;
        box-shadow: 0 4px 12px rgba(8, 117, 189, 0.25) !important;
        transition: all 0.2s ease !important;
    }

    .fi-btn-color-primary:hover {
        background-color: #065A92 !important;
        transform: translateY(-1px) !important;
    }

    /* Danger Button */
    .fi-btn-color-danger {
        background-color: #E84B5B !important;
        color: #FFFFFF !important;
        border-radius: 0.625rem !important;
    }

    .fi-btn-color-danger:hover {
        background-color: #D43949 !important;
    }

    /* Soft Badges */
    .fi-badge-color-success {
        background-color: rgba(22, 163, 106, 0.12) !important;
        color: #16A36A !important;
        border: 1px solid rgba(22, 163, 106, 0.25) !important;
        font-weight: 600 !important;
    }

    .fi-badge-color-danger {
        background-color: rgba(232, 75, 91, 0.12) !important;
        color: #E84B5B !important;
        border: 1px solid rgba(232, 75, 91, 0.25) !important;
        font-weight: 600 !important;
    }

    .fi-badge-color-info,
    .fi-badge-color-primary {
        background-color: rgba(8, 117, 189, 0.1) !important;
        color: #0875BD !important;
        border: 1px solid rgba(8, 117, 189, 0.25) !important;
        font-weight: 600 !important;
    }

    .fi-badge-color-warning {
        background-color: rgba(241, 90, 41, 0.12) !important;
        color: #F15A29 !important;
        border: 1px solid rgba(241, 90, 41, 0.25) !important;
        font-weight: 600 !important;
    }

    .fi-badge-color-gray {
        background-color: #F1F5F9 !important;
        color: #475569 !important;
        border: 1px solid #E2E8F0 !important;
        font-weight: 600 !important;
    }

    /* Inputs, Selects, and Form Controls */
    .fi-input-wrp {
        border-color: #DCEAF7 !important;
        border-radius: 0.625rem !important;
        background-color: #FFFFFF !important;
        transition: border-color 0.15s ease, box-shadow 0.15s ease !important;
    }

    .fi-input-wrp:focus-within {
        border-color: #0875BD !important;
        box-shadow: 0 0 0 3px rgba(8, 117, 189, 0.15) !important;
    }

    /* Modals & Dialogs */
    .fi-modal-window {
        background-color: #FFFFFF !important;
        border: 1px solid #DCEAF7 !important;
        border-radius: 1.25rem !important;
        box-shadow: 0 20px 45px -10px rgba(16, 23, 53, 0.15) !important;
    }

    .fi-modal-header {
        border-bottom: 1px solid #DCEAF7 !important;
        padding: 1.25rem 1.5rem !important;
    }

    .fi-modal-footer {
        border-top: 1px solid #DCEAF7 !important;
        background-color: #F8FAFD !important;
        padding: 1rem 1.5rem !important;
        border-bottom-left-radius: 1.25rem !important;
        border-bottom-right-radius: 1.25rem !important;
    }

    /* Dropdown Menus & Popovers */
    .fi-dropdown-panel {
        background-color: #FFFFFF !important;
        border: 1px solid #DCEAF7 !important;
        border-radius: 0.875rem !important;
        box-shadow: 0 10px 30px -5px rgba(8, 117, 189, 0.12), 0 4px 6px -2px rgba(16, 23, 53, 0.04) !important;
    }

    .fi-dropdown-list-item-button:hover {
        background-color: #EAF4FF !important;
        color: #0875BD !important;
    }

    /* Notifications (Toasts) */
    .fi-no-notification {
        background-color: #FFFFFF !important;
        border: 1px solid #DCEAF7 !important;
        border-radius: 1rem !important;
        box-shadow: 0 10px 30px -5px rgba(16, 23, 53, 0.12) !important;
    }

    /* Custom Scrollbar for clean modern feel */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    ::-webkit-scrollbar-track {
        background: #EAF4FF;
    }
    ::-webkit-scrollbar-thumb {
        background: #B9D7F2;
        border-radius: 3px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #0875BD;
    }
</style>
<script>
    (function () {
        function upgradeNavigateHover() {
            document.querySelectorAll('a[wire\\:navigate]').forEach(function (el) {
                if (!el.hasAttribute('wire:navigate.hover')) {
                    el.removeAttribute('wire:navigate');
                    el.setAttribute('wire:navigate.hover', '');
                }
            });
        }
        document.addEventListener('livewire:init', upgradeNavigateHover);
        document.addEventListener('alpine:init', upgradeNavigateHover);
        document.addEventListener('DOMContentLoaded', upgradeNavigateHover);
    })();
</script>
