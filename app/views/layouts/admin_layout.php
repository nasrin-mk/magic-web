<?php
$activeTab = $activeTab ?? 'dashboard';
$pageTitle = $pageTitle ?? 'Admin Dashboard | Magicnas';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-body: #0b0d12;
      --bg-sidebar: #10131a;
      --bg-card: #151922;
      --bg-card-hover: #1b202c;
      --bg-subtle: #1c2230;
      --border: rgba(255, 255, 255, 0.08);
      --border-focus: rgba(212, 175, 55, 0.5);
      --gold: #d4af37;
      --gold-light: #f3cf65;
      --gold-glow: rgba(212, 175, 55, 0.15);
      --gold-subtle: rgba(212, 175, 55, 0.08);
      --text-main: #f3f4f6;
      --text-secondary: #9ca3af;
      --text-muted: #6b7280;
      --danger: #ef4444;
      --danger-bg: rgba(239, 68, 68, 0.12);
      --success: #10b981;
      --success-bg: rgba(16, 185, 129, 0.12);
      --sidebar-width: 270px;
      --topbar-height: 64px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    html {
      overflow-x: hidden;
      width: 100%;
      max-width: 100%;
    }

    body {
      background: var(--bg-body);
      color: var(--text-main);
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      min-height: 100vh;
      width: 100%;
      max-width: 100%;
      display: flex;
      flex-direction: row;
      overflow-x: hidden;
    }

    /* -------------------------------------------------------------------------
       LEFT SIDEBAR
       ------------------------------------------------------------------------- */
    .admin-sidebar {
      width: var(--sidebar-width);
      min-width: var(--sidebar-width);
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      background: var(--bg-sidebar);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      z-index: 100;
      overflow-y: auto;
      overflow-x: hidden;
      transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .admin-sidebar::-webkit-scrollbar {
      width: 4px;
    }
    .admin-sidebar::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.12);
      border-radius: 4px;
    }

    /* Brand Header */
    .sidebar-brand-wrapper {
      padding: 22px 20px;
      border-bottom: 1px solid var(--border);
    }
    .sidebar-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }
    .brand-logo-img {
      height: 38px;
      width: auto;
      filter: drop-shadow(0 2px 8px rgba(212, 175, 55, 0.25));
    }
    .brand-meta {
      display: flex;
      flex-direction: column;
      line-height: 1.15;
    }
    .brand-title {
      font-family: 'Cinzel', serif;
      font-size: 1.15rem;
      font-weight: 700;
      letter-spacing: 1.2px;
      color: var(--gold);
    }
    .brand-subtitle {
      font-size: 0.68rem;
      font-weight: 600;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-top: 2px;
    }

    /* Navigation */
    .sidebar-nav-container {
      padding: 24px 14px;
      flex: 1;
      overflow-y: auto;
    }
    .nav-group-title {
      font-size: 0.7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      color: var(--text-muted);
      padding: 0 12px;
      margin-bottom: 12px;
    }
    .sidebar-nav {
      display: flex;
      flex-direction: column;
      gap: 6px;
      list-style: none;
    }
    .sidebar-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 11px 14px;
      border-radius: 8px;
      font-size: 0.92rem;
      font-weight: 500;
      color: var(--text-secondary);
      text-decoration: none;
      transition: all 0.2s ease;
      position: relative;
    }
    .sidebar-link:hover {
      color: var(--text-main);
      background: rgba(255, 255, 255, 0.04);
    }
    .sidebar-link.active {
      color: var(--gold-light);
      background: var(--gold-subtle);
      font-weight: 600;
      box-shadow: inset 0 0 0 1px rgba(212, 175, 55, 0.2);
    }
    .sidebar-link.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 6px;
      bottom: 6px;
      width: 3px;
      border-radius: 0 4px 4px 0;
      background: var(--gold);
    }
    .sidebar-link svg {
      flex-shrink: 0;
      stroke: currentColor;
      transition: transform 0.2s ease;
    }
    .sidebar-link:hover svg {
      transform: scale(1.08);
    }
    .sidebar-link .link-badge {
      margin-left: auto;
      background: rgba(212, 175, 55, 0.2);
      color: var(--gold);
      border: 1px solid rgba(212, 175, 55, 0.35);
      font-size: 0.72rem;
      font-weight: 700;
      padding: 2px 7px;
      border-radius: 10px;
    }

    /* Sidebar Footer User Box */
    .sidebar-user-box {
      margin: 16px;
      padding: 14px;
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 12px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
    }
    .user-profile-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(212, 175, 55, 0.25) 0%, rgba(212, 175, 55, 0.08) 100%);
      border: 1.5px solid var(--gold);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gold);
      font-size: 1.1rem;
      font-weight: 700;
      flex-shrink: 0;
    }
    .user-info {
      overflow: hidden;
      display: flex;
      flex-direction: column;
      line-height: 1.25;
    }
    .user-name {
      font-size: 0.92rem;
      font-weight: 600;
      color: var(--text-main);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .user-role-badge {
      font-size: 0.7rem;
      color: var(--gold);
      font-weight: 600;
      letter-spacing: 0.4px;
    }
    .sidebar-actions-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
    }
    .sidebar-btn {
      padding: 7px 10px;
      font-size: 0.78rem;
      font-weight: 600;
      border-radius: 6px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      transition: all 0.2s ease;
      border: 1px solid var(--border);
      color: var(--text-secondary);
      background: var(--bg-subtle);
    }
    .sidebar-btn:hover {
      color: var(--text-main);
      border-color: rgba(255, 255, 255, 0.18);
      background: var(--bg-card-hover);
    }
    .sidebar-btn-danger {
      color: #f87171;
      background: rgba(239, 68, 68, 0.08);
      border-color: rgba(239, 68, 68, 0.25);
    }
    .sidebar-btn-danger:hover {
      background: var(--danger);
      color: #fff;
      border-color: var(--danger);
    }

    /* -------------------------------------------------------------------------
       MAIN CONTENT AREA & TOPBAR
       ------------------------------------------------------------------------- */
    .admin-content-area {
      margin-left: var(--sidebar-width);
      flex: 1 1 auto;
      min-width: 0;
      width: calc(100% - var(--sidebar-width));
      max-width: calc(100% - var(--sidebar-width));
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      overflow-x: hidden;
      background: var(--bg-body);
      box-sizing: border-box;
    }

    /* Modern Topbar */
    .admin-topbar {
      height: var(--topbar-height);
      background: rgba(16, 19, 26, 0.85);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--border);
      padding: 0 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 90;
      width: 100%;
      max-width: 100%;
      box-sizing: border-box;
    }
    .topbar-left {
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .mobile-menu-trigger {
      display: none;
      background: var(--bg-card);
      border: 1px solid var(--border);
      color: var(--text-main);
      width: 38px;
      height: 38px;
      border-radius: 8px;
      cursor: pointer;
      align-items: center;
      justify-content: center;
    }
    .breadcrumb-trail {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.85rem;
      color: var(--text-muted);
    }
    .breadcrumb-trail a {
      color: inherit;
      text-decoration: none;
      transition: color 0.2s;
    }
    .breadcrumb-trail a:hover {
      color: var(--gold);
    }
    .breadcrumb-sep {
      opacity: 0.4;
      font-size: 0.75rem;
    }
    .breadcrumb-current {
      color: var(--text-main);
      font-weight: 600;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .topbar-date-chip {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid var(--border);
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      color: var(--text-secondary);
      display: flex;
      align-items: center;
      gap: 6px;
    }

    /* Shared Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 9px 18px;
      border-radius: 8px;
      font-size: 0.88rem;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s ease;
      border: 1px solid transparent;
    }
    .btn-gold {
      background: linear-gradient(135deg, #d4af37 0%, #b8972e 100%);
      color: #0b0c10;
      box-shadow: 0 4px 14px rgba(212, 175, 55, 0.2);
    }
    .btn-gold:hover {
      background: linear-gradient(135deg, #e5bf43 0%, #c4a133 100%);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
    }
    .btn-outline {
      background: rgba(255, 255, 255, 0.03);
      border-color: var(--border);
      color: var(--text-main);
    }
    .btn-outline:hover {
      border-color: rgba(255, 255, 255, 0.25);
      background: rgba(255, 255, 255, 0.07);
    }
    .btn-danger {
      background: var(--danger-bg);
      color: #f87171;
      border-color: rgba(239, 68, 68, 0.3);
    }
    .btn-danger:hover {
      background: var(--danger);
      color: #fff;
    }
    .btn-sm {
      padding: 6px 12px;
      font-size: 0.82rem;
      border-radius: 6px;
    }

    /* Container */
    .admin-container {
      max-width: 1360px;
      margin: 0 auto;
      padding: 32px;
      width: 100%;
      min-width: 0;
      box-sizing: border-box;
      flex: 1;
    }

    .admin-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 26px;
      flex-wrap: wrap;
      gap: 16px;
    }
    .admin-title h1 {
      font-family: 'Cinzel', serif;
      font-size: 1.65rem;
      color: var(--text-main);
      font-weight: 700;
    }
    .admin-title p {
      color: var(--text-secondary);
      font-size: 0.92rem;
      margin-top: 4px;
    }

    /* Flash Alerts */
    .alert {
      padding: 14px 18px;
      border-radius: 10px;
      margin-bottom: 24px;
      font-size: 0.92rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .alert-success {
      background: var(--success-bg);
      border: 1px solid var(--success);
      color: #6ee7b7;
    }
    .alert-error {
      background: var(--danger-bg);
      border: 1px solid var(--danger);
      color: #fca5a5;
    }
    .alert-close {
      background: none;
      border: none;
      color: inherit;
      font-size: 1.25rem;
      cursor: pointer;
      line-height: 1;
    }

    /* Cards */
    .card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      min-width: 0;
      max-width: 100%;
    }
    .card-header {
      padding: 20px 24px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .card-header h2 {
      font-size: 1.15rem;
      font-weight: 600;
      color: var(--gold-light);
    }
    .card-body {
      padding: 24px;
    }

    /* Tables */
    .table-responsive {
      overflow-x: auto;
      width: 100%;
      max-width: 100%;
      min-width: 0;
      -webkit-overflow-scrolling: touch;
    }
    table.data-table {
      width: 100%;
      min-width: 580px;
      border-collapse: collapse;
      text-align: left;
    }
    table.data-table th {
      background: rgba(255, 255, 255, 0.02);
      padding: 14px 18px;
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: var(--text-muted);
      border-bottom: 1px solid var(--border);
    }
    table.data-table td {
      padding: 16px 18px;
      border-bottom: 1px solid var(--border);
      font-size: 0.9rem;
      vertical-align: middle;
    }
    table.data-table tr:last-child td {
      border-bottom: none;
    }
    table.data-table tr:hover td {
      background: rgba(255, 255, 255, 0.025);
    }

    /* Form controls */
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      font-size: 0.88rem;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 6px;
    }
    .form-control {
      width: 100%;
      background: #0d1017;
      border: 1px solid var(--border);
      color: var(--text-main);
      padding: 11px 14px;
      border-radius: 8px;
      font-size: 0.92rem;
      transition: all 0.2s ease;
    }
    .form-control:focus {
      outline: none;
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }
    .form-text {
      font-size: 0.78rem;
      color: var(--text-muted);
      margin-top: 6px;
    }

    /* Badges */
    .badge-unread {
      background: rgba(245, 158, 11, 0.15);
      color: #fbbf24;
      border: 1px solid rgba(245, 158, 11, 0.4);
      padding: 3px 9px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    .badge-read {
      background: rgba(16, 185, 129, 0.15);
      color: #6ee7b7;
      border: 1px solid rgba(16, 185, 129, 0.4);
      padding: 3px 9px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    /* Footer */
    .admin-footer {
      background: var(--bg-sidebar);
      border-top: 1px solid var(--border);
      padding: 20px 32px;
      text-align: center;
      font-size: 0.85rem;
      color: var(--text-muted);
      margin-top: auto;
      width: 100%;
      max-width: 100%;
      box-sizing: border-box;
    }

    /* Drawer Overlay */
    .admin-sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(4px);
      z-index: 99;
    }

    /* -------------------------------------------------------------------------
       LOGOUT CONFIRMATION MODAL
       ------------------------------------------------------------------------- */
    .modal-backdrop {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(4, 6, 10, 0.82);
      backdrop-filter: blur(6px);
      z-index: 10000;
      align-items: center;
      justify-content: center;
      padding: 20px;
      opacity: 0;
      transition: opacity 0.25s ease;
    }
    .modal-backdrop.is-open {
      display: flex;
      opacity: 1;
    }
    .modal-dialog {
      background: #141720;
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      width: 100%;
      max-width: 440px;
      padding: 32px 28px 28px;
      text-align: center;
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(212, 175, 55, 0.18);
      transform: scale(0.92) translateY(12px);
      transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
    }
    .modal-backdrop.is-open .modal-dialog {
      transform: scale(1) translateY(0);
    }
    .modal-badge-icon {
      width: 58px;
      height: 58px;
      margin: 0 auto 18px;
      border-radius: 50%;
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #f87171;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 24px rgba(239, 68, 68, 0.15);
    }
    .modal-title {
      font-family: 'Cinzel', serif;
      font-size: 1.35rem;
      color: var(--text-main);
      margin-bottom: 10px;
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    .modal-desc {
      font-size: 0.9rem;
      color: var(--text-secondary);
      line-height: 1.55;
      margin-bottom: 26px;
    }
    .modal-actions-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    .modal-action-btn {
      width: 100%;
      padding: 10px 16px;
      font-size: 0.88rem;
    }

    /* Responsive */
    @media (max-width: 960px) {
      body {
        flex-direction: column;
      }
      .admin-content-area {
        margin-left: 0;
        width: 100%;
        max-width: 100%;
      }
      .admin-topbar {
        padding: 0 20px;
      }
      .mobile-menu-trigger {
        display: inline-flex;
      }
      .admin-sidebar {
        position: fixed;
        left: -290px;
        top: 0;
        bottom: 0;
        height: 100vh;
        width: 280px;
        z-index: 1000;
        box-shadow: 8px 0 32px rgba(0, 0, 0, 0.7);
      }
      .admin-sidebar.open {
        transform: translateX(290px);
      }
      .admin-sidebar-overlay.open {
        display: block;
      }
      .admin-container {
        padding: 24px 16px;
      }
    }
  </style>
</head>
<body>

  <!-- Logout Confirmation Modal -->
  <div class="modal-backdrop" id="logoutModalBackdrop" onclick="handleBackdropClick(event)">
    <div class="modal-dialog" role="dialog" aria-modal="true" aria-labelledby="logoutModalTitle">
      <div class="modal-badge-icon">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
          <polyline points="16 17 21 12 16 7"></polyline>
          <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
      </div>

      <h3 class="modal-title" id="logoutModalTitle">Log Out of Admin Panel?</h3>
      <p class="modal-desc">
        Are you sure you want to log out? You will need to sign in again to access the Magicnas dashboard and manage customer inquiries.
      </p>

      <div class="modal-actions-row">
        <button type="button" class="btn btn-outline modal-action-btn" onclick="closeLogoutModal()">
          Cancel
        </button>
        <a href="<?= BASE_URL ?>/admin/logout" class="btn btn-danger modal-action-btn">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
          <span>Yes, Log Out</span>
        </a>
      </div>
    </div>
  </div>

  <script>
    function openLogoutModal() {
      const modal = document.getElementById('logoutModalBackdrop');
      if (modal) {
        modal.classList.add('is-open');
        document.body.style.overflow = 'hidden';
      }
    }

    function closeLogoutModal() {
      const modal = document.getElementById('logoutModalBackdrop');
      if (modal) {
        modal.classList.remove('is-open');
        document.body.style.overflow = '';
      }
    }

    function handleBackdropClick(event) {
      if (event.target === document.getElementById('logoutModalBackdrop')) {
        closeLogoutModal();
      }
    }

    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeLogoutModal();
      }
    });
  </script>

  <!-- LEFT SIDEBAR -->
  <aside class="admin-sidebar" id="adminSidebar">
    
    <div>
      <!-- Brand Header -->
      <div class="sidebar-brand-wrapper">
        <a href="<?= BASE_URL ?>/admin" class="sidebar-brand">
          <img src="<?= BASE_URL ?>/images/magicnas-logo.png" alt="Magicnas Admin" class="brand-logo-img">
          <div class="brand-meta">
            <span class="brand-title">MAGICNAS</span>
            <span class="brand-subtitle">Control Panel</span>
          </div>
        </a>
      </div>

      <!-- Navigation Section -->
      <div class="sidebar-nav-container">
        <div class="nav-group-title">Menu Navigation</div>
        <ul class="sidebar-nav">
          <li>
            <a href="<?= BASE_URL ?>/admin" class="sidebar-link <?= ($activeTab === 'dashboard') ? 'active' : '' ?>">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
              </svg>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="<?= BASE_URL ?>/admin/enquiries" class="sidebar-link <?= ($activeTab === 'enquiries') ? 'active' : '' ?>">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
              <span>Enquiries</span>
            </a>
          </li>
          <li>
            <a href="<?= BASE_URL ?>/admin/media" class="sidebar-link <?= ($activeTab === 'media' || $activeTab === 'videos') ? 'active' : '' ?>">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                <line x1="7" y1="2" x2="7" y2="22"></line>
                <line x1="17" y1="2" x2="17" y2="22"></line>
                <line x1="2" y1="12" x2="22" y2="12"></line>
                <line x1="2" y1="7" x2="7" y2="7"></line>
                <line x1="2" y1="17" x2="7" y2="17"></line>
                <line x1="17" y1="17" x2="22" y2="17"></line>
                <line x1="17" y1="7" x2="22" y2="7"></line>
              </svg>
              <span>Media Manager</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Bottom User Box in Left Sidebar -->
    <div class="sidebar-user-box">
      <div class="user-profile-row">
        <div class="user-avatar">&#127913;</div>
        <div class="user-info">
          <span class="user-role-badge">Logged in as</span>
          <strong class="user-name"><?= htmlspecialchars($_SESSION['admin_username'] ?? 'admin') ?></strong>
        </div>
      </div>

      <div class="sidebar-actions-grid">
        <a href="<?= BASE_URL ?>/" target="_blank" class="sidebar-btn" title="Open public website in a new tab">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
          <span>Live Site</span>
        </a>
        <a href="javascript:void(0);" class="sidebar-btn sidebar-btn-danger" onclick="openLogoutModal();" title="Sign out securely">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
          <span>Logout</span>
        </a>
      </div>
    </div>

  </aside>

  <!-- RIGHT CONTENT AREA -->
  <div class="admin-content-area">

    <!-- Sticky Topbar -->
    <header class="admin-topbar">
      <div class="topbar-left">
        <button type="button" class="mobile-menu-trigger" onclick="toggleSidebar()" aria-label="Toggle menu">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>

        <div class="breadcrumb-trail">
          <a href="<?= BASE_URL ?>/admin">Magicnas Control</a>
          <span class="breadcrumb-sep">/</span>
          <span class="breadcrumb-current"><?= ucfirst($activeTab) ?></span>
        </div>
      </div>

      <div class="topbar-right">
        <span class="topbar-date-chip">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          <?= date('l, M j, Y') ?>
        </span>
      </div>
    </header>

    <!-- Main Container -->
    <main class="admin-container">
      <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success">
          <span><?= htmlspecialchars($_SESSION['flash_success']) ?></span>
          <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
      <?php endif; ?>

      <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-error">
          <span><?= htmlspecialchars($_SESSION['flash_error']) ?></span>
          <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
      <?php endif; ?>
