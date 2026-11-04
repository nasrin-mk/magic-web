<?php
$activeTab = $activeTab ?? 'enquiries';
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
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-dark: #0d0f12;
      --bg-panel: #16191f;
      --bg-panel-light: #20242d;
      --border-color: #2c323f;
      --gold: #d4af37;
      --gold-hover: #b8972e;
      --gold-bg: rgba(212, 175, 55, 0.12);
      --text-main: #f0f2f5;
      --text-muted: #9ba3af;
      --danger: #e63946;
      --danger-bg: rgba(230, 57, 70, 0.15);
      --success: #2a9d8f;
      --success-bg: rgba(42, 157, 143, 0.15);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--bg-dark);
      color: var(--text-main);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Top Navigation Bar */
    .admin-navbar {
      background: var(--bg-panel);
      border-bottom: 1px solid var(--border-color);
      padding: 0 24px;
      height: 68px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .admin-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: var(--text-main);
    }
    .admin-brand img {
      height: 38px;
      width: auto;
    }
    .admin-brand span {
      font-family: 'Cinzel', serif;
      font-size: 1.15rem;
      letter-spacing: 1px;
      color: var(--gold);
    }
    .admin-brand .badge {
      background: var(--gold-bg);
      color: var(--gold);
      border: 1px solid rgba(212, 175, 55, 0.3);
      padding: 2px 8px;
      border-radius: 4px;
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .admin-nav-links {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .admin-nav-item {
      color: var(--text-muted);
      text-decoration: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 0.92rem;
      font-weight: 500;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .admin-nav-item:hover {
      color: var(--text-main);
      background: var(--bg-panel-light);
    }
    .admin-nav-item.active {
      color: var(--gold);
      background: var(--gold-bg);
      border: 1px solid rgba(212, 175, 55, 0.3);
      font-weight: 600;
    }

    .admin-user-menu {
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .admin-user-info {
      font-size: 0.88rem;
      color: var(--text-muted);
    }
    .admin-user-info strong {
      color: var(--text-main);
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 0.88rem;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s ease;
      border: 1px solid transparent;
    }
    .btn-gold {
      background: var(--gold);
      color: #0b0c10;
    }
    .btn-gold:hover {
      background: var(--gold-hover);
    }
    .btn-outline {
      background: transparent;
      border-color: var(--border-color);
      color: var(--text-main);
    }
    .btn-outline:hover {
      border-color: var(--text-muted);
      background: var(--bg-panel-light);
    }
    .btn-danger {
      background: var(--danger-bg);
      color: var(--danger);
      border-color: rgba(230, 57, 70, 0.4);
    }
    .btn-danger:hover {
      background: var(--danger);
      color: #fff;
    }
    .btn-sm {
      padding: 5px 10px;
      font-size: 0.8rem;
    }

    /* Main Container */
    .admin-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 32px 24px;
      width: 100%;
      flex: 1;
    }

    .admin-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
      flex-wrap: wrap;
      gap: 16px;
    }
    .admin-title h1 {
      font-family: 'Cinzel', serif;
      font-size: 1.6rem;
      color: var(--text-main);
    }
    .admin-title p {
      color: var(--text-muted);
      font-size: 0.9rem;
      margin-top: 4px;
    }

    /* Flash Alerts */
    .alert {
      padding: 14px 18px;
      border-radius: 8px;
      margin-bottom: 24px;
      font-size: 0.92rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .alert-success {
      background: var(--success-bg);
      border: 1px solid var(--success);
      color: #72e396;
    }
    .alert-error {
      background: var(--danger-bg);
      border: 1px solid var(--danger);
      color: #ff9b9b;
    }
    .alert-close {
      background: none;
      border: none;
      color: inherit;
      font-size: 1.2rem;
      cursor: pointer;
    }

    /* Cards & Panels */
    .card {
      background: var(--bg-panel);
      border: 1px solid var(--border-color);
      border-radius: 10px;
      overflow: hidden;
    }
    .card-header {
      padding: 18px 24px;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .card-header h2 {
      font-size: 1.15rem;
      font-weight: 600;
      color: var(--gold);
    }
    .card-body {
      padding: 24px;
    }

    /* Tables */
    .table-responsive {
      overflow-x: auto;
    }
    table.data-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }
    table.data-table th {
      background: var(--bg-panel-light);
      padding: 14px 16px;
      font-size: 0.8rem;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      color: var(--text-muted);
      border-bottom: 1px solid var(--border-color);
    }
    table.data-table td {
      padding: 16px;
      border-bottom: 1px solid var(--border-color);
      font-size: 0.9rem;
      vertical-align: middle;
    }
    table.data-table tr:last-child td {
      border-bottom: none;
    }
    table.data-table tr:hover td {
      background: rgba(255, 255, 255, 0.02);
    }

    /* Form controls */
    .form-group {
      margin-bottom: 18px;
    }
    .form-group label {
      display: block;
      font-size: 0.88rem;
      font-weight: 500;
      color: var(--text-main);
      margin-bottom: 6px;
    }
    .form-control {
      width: 100%;
      background: var(--bg-dark);
      border: 1px solid var(--border-color);
      color: var(--text-main);
      padding: 10px 14px;
      border-radius: 6px;
      font-size: 0.92rem;
      transition: border-color 0.2s ease;
    }
    .form-control:focus {
      outline: none;
      border-color: var(--gold);
      box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
    }
    .form-text {
      font-size: 0.78rem;
      color: var(--text-muted);
      margin-top: 4px;
    }

    /* Badges */
    .badge-unread {
      background: rgba(212, 175, 55, 0.15);
      color: var(--gold);
      border: 1px solid rgba(212, 175, 55, 0.4);
      padding: 3px 8px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    .badge-read {
      background: rgba(42, 157, 143, 0.15);
      color: #72e396;
      border: 1px solid rgba(42, 157, 143, 0.4);
      padding: 3px 8px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    /* Admin Footer */
    .admin-footer {
      background: var(--bg-panel);
      border-top: 1px solid var(--border-color);
      padding: 18px 24px;
      text-align: center;
      font-size: 0.85rem;
      color: var(--text-muted);
    }
  </style>
</head>
<body>

  <!-- Admin Navbar -->
  <header class="admin-navbar">
    <div style="display:flex; align-items:center; gap:32px;">
      <a href="<?= BASE_URL ?>/admin/enquiries" class="admin-brand">
        <img src="<?= BASE_URL ?>/images/magicnas-logo.png" alt="Magicnas Admin">
        <span>MAGICNAS</span>
        <span class="badge">Control Panel</span>
      </a>

      <nav class="admin-nav-links">
        <a href="<?= BASE_URL ?>/admin/enquiries" class="admin-nav-item <?= ($activeTab === 'enquiries') ? 'active' : '' ?>">
          &#9993; Enquiries
        </a>
        <a href="<?= BASE_URL ?>/admin/videos" class="admin-nav-item <?= ($activeTab === 'videos') ? 'active' : '' ?>">
          &#9654; YouTube Videos
        </a>
      </nav>
    </div>

    <div class="admin-user-menu">
      <a href="<?= BASE_URL ?>/" target="_blank" class="btn btn-outline btn-sm" title="Open main website in a new tab">
        &#128065; View Live Site
      </a>
      <div class="admin-user-info">
        Logged in as <strong><?= htmlspecialchars($_SESSION['admin_username'] ?? 'admin') ?></strong>
      </div>
      <a href="<?= BASE_URL ?>/admin/logout" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to log out?');">
        Logout
      </a>
    </div>
  </header>

  <!-- Main Content Container -->
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
