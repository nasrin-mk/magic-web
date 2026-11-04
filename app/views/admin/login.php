<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Magicnas Control Panel</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-dark: #0a0c10;
      --bg-card: #14171f;
      --border-color: #262c38;
      --gold: #d4af37;
      --gold-hover: #b8972e;
      --text-main: #f0f2f5;
      --text-muted: #8b94a0;
      --danger: #ff6b6b;
      --danger-bg: rgba(255, 107, 107, 0.12);
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--bg-dark);
      background-image: radial-gradient(circle at 50% 20%, rgba(212, 175, 55, 0.08) 0%, rgba(10, 12, 16, 0.98) 70%);
      color: var(--text-main);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .login-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 0 0 1px rgba(212, 175, 55, 0.15);
      border-radius: 12px;
      width: 100%;
      max-width: 420px;
      padding: 40px 32px;
    }
    .brand {
      text-align: center;
      margin-bottom: 28px;
    }
    .brand img {
      height: 48px;
      width: auto;
      margin-bottom: 12px;
    }
    .brand h1 {
      font-family: 'Cinzel', serif;
      font-size: 1.5rem;
      color: var(--gold);
      letter-spacing: 1px;
    }
    .brand p {
      font-size: 0.85rem;
      color: var(--text-muted);
      margin-top: 4px;
    }

    .alert {
      padding: 12px 16px;
      border-radius: 6px;
      font-size: 0.88rem;
      margin-bottom: 20px;
    }
    .alert-error {
      background: var(--danger-bg);
      border: 1px solid rgba(255, 107, 107, 0.3);
      color: var(--danger);
    }
    .alert-success {
      background: rgba(42, 157, 143, 0.15);
      border: 1px solid rgba(42, 157, 143, 0.4);
      color: #72e396;
    }

    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      font-size: 0.85rem;
      font-weight: 500;
      color: var(--text-main);
      margin-bottom: 8px;
    }
    .form-control {
      width: 100%;
      background: #0d0f14;
      border: 1px solid var(--border-color);
      color: var(--text-main);
      padding: 12px 14px;
      border-radius: 6px;
      font-size: 0.95rem;
      transition: all 0.2s;
    }
    .form-control:focus {
      outline: none;
      border-color: var(--gold);
      box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
    }

    .btn-login {
      width: 100%;
      background: var(--gold);
      color: #0b0c10;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.2s;
      margin-top: 8px;
    }
    .btn-login:hover {
      background: var(--gold-hover);
    }

    .back-link {
      text-align: center;
      margin-top: 24px;
      font-size: 0.85rem;
    }
    .back-link a {
      color: var(--text-muted);
      text-decoration: none;
      transition: color 0.2s;
    }
    .back-link a:hover {
      color: var(--gold);
    }
  </style>
</head>
<body>

  <div class="login-card">
    <div class="brand">
      <img src="<?= BASE_URL ?>/images/magicnas-logo.png" alt="Magicnas">
      <h1>MAGICNAS</h1>
      <p>Administrator Control Panel</p>
    </div>

    <?php if (!empty($_SESSION['flash_error'])): ?>
      <div class="alert alert-error">
        <?= htmlspecialchars($_SESSION['flash_error']) ?>
      </div>
      <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash_success'])): ?>
      <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['flash_success']) ?>
      </div>
      <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/admin/login" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Enter admin username" required autofocus autocomplete="username">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter admin password" required autocomplete="current-password">
      </div>

      <button type="submit" class="btn-login">Sign In</button>
    </form>

    <div class="back-link">
      <a href="<?= BASE_URL ?>/">&larr; Return to Website</a>
    </div>
  </div>

</body>
</html>
