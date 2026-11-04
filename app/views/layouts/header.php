<?php
$activeNav = $activeNav ?? '';
$pageTitle = $pageTitle ?? 'Magicnas | Professional Magician in Dubai';
$extraCss  = $extraCss ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
  <?php foreach ($extraCss as $css): ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/<?= htmlspecialchars($css) ?>">
  <?php endforeach; ?>
  <style>
    /* Flash Message Styles */
    .flash-container {
      position: fixed;
      top: 80px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 9999;
      width: 90%;
      max-width: 600px;
    }
    .flash-alert {
      padding: 16px 20px;
      margin-bottom: 12px;
      border-radius: 8px;
      font-size: 0.95rem;
      font-weight: 500;
      box-shadow: 0 10px 30px rgba(0,0,0,0.4);
      display: flex;
      align-items: center;
      justify-content: space-between;
      animation: fadeInDown 0.3s ease-out;
    }
    .flash-success {
      background: #112d1b;
      color: #72e396;
      border: 1px solid #1f5630;
    }
    .flash-error {
      background: #361414;
      color: #ff8b8b;
      border: 1px solid #632222;
    }
    .flash-close {
      background: none;
      border: none;
      color: currentColor;
      font-size: 1.3rem;
      cursor: pointer;
      line-height: 1;
      padding: 0 4px;
    }
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-15px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <!-- Flash Message Banner -->
  <?php if (!empty($_SESSION['flash_success']) || !empty($_SESSION['flash_error'])): ?>
    <div class="flash-container">
      <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="flash-alert flash-success" id="flashMsg">
          <span><?= htmlspecialchars($_SESSION['flash_success']) ?></span>
          <button class="flash-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
      <?php endif; ?>
      <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="flash-alert flash-error" id="flashMsg">
          <span><?= htmlspecialchars($_SESSION['flash_error']) ?></span>
          <button class="flash-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
      <?php endif; ?>
    </div>
    <script>
      setTimeout(() => {
        const f = document.getElementById('flashMsg');
        if (f) f.style.display = 'none';
      }, 7000);
    </script>
  <?php endif; ?>
