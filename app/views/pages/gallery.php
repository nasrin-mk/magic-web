<?php
$extraCss = ['gallery.css'];
require_once __DIR__ . '/../layouts/header.php';

$images = $images ?? [];
$videos = $videos ?? [];

// Combine both collections into a single unified gallery array
$allItems = [];
foreach ($images as $img) {
    $allItems[] = [
        'type'          => 'image',
        'id'            => $img['id'],
        'title'         => $img['title'],
        'category'      => $img['category'] ?? 'on-stage',
        'image_path'    => $img['image_path'],
        'display_order' => (int)($img['display_order'] ?? 0),
        'created_at'    => $img['created_at'],
    ];
}
foreach ($videos as $vid) {
    $allItems[] = [
        'type'          => 'video',
        'id'            => $vid['id'],
        'title'         => $vid['title'],
        'category'      => $vid['category'] ?? 'on-stage',
        'youtube_url'   => $vid['youtube_url'],
        'youtube_id'    => $vid['youtube_id'],
        'display_order' => (int)($vid['display_order'] ?? 0),
        'created_at'    => $vid['created_at'],
    ];
}

// Sort all items by display_order ASC, then newest created_at first
usort($allItems, function ($a, $b) {
    if ($a['display_order'] !== $b['display_order']) {
        return $a['display_order'] <=> $b['display_order'];
    }
    return strcmp($b['created_at'], $a['created_at']);
});
?>

  <!-- Header -->
  <header class="page-hero">
    <nav class="navbar">
      <a href="<?= BASE_URL ?>/" class="logo">
        <img src="<?= BASE_URL ?>/images/magicnas-logo.png" alt="Magicnas - Professional Magician in Dubai">
      </a>
      <button type="button" class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <ul class="nav-links">
        <li><a href="<?= BASE_URL ?>/">Home</a></li>
        <li><a href="<?= BASE_URL ?>/about">About</a></li>
        <li><a href="<?= BASE_URL ?>/services">Services</a></li>
        <li><a href="<?= BASE_URL ?>/gallery" class="active">Gallery</a></li>
        <li><a href="<?= BASE_URL ?>/contact">Contact</a></li>
      </ul>
    </nav>

    <div class="container page-hero-inner">
      <div>
        <p class="label">Gallery &amp; Media</p>
        <h1>The stage.<br>The smiles.<br><span class="gold">The wonder.</span></h1>
      </div>
      <p class="text">Real moments from live shows, private events and corporate performances.</p>
    </div>
  </header>

  <!-- Captured Moments / Visual Memories Section -->
  <section class="section" id="gallery">
    <div class="container">

      <div style="text-align: center; max-width: 650px; margin: 0 auto 30px;">
        <p class="label">Captured Moments</p>
        <h2 class="section-title">Visual <span class="gold">Memories</span></h2>
      </div>

      <!-- Filter Buttons -->
      <div class="filters">
        <button class="active" data-filter="all">All Moments</button>
        <button data-filter="on-stage">On Stage</button>
        <button data-filter="close-up">Close-up</button>
        <button data-filter="events">Events</button>
      </div>

      <!-- Unified Dynamic Gallery Grid (Photos & YouTube Videos) -->
      <div class="gallery-grid">
        <?php if (empty($allItems)): ?>
          <div style="grid-column: 1 / -1; padding: 60px 24px; text-align: center; background: #fff; border-radius: 8px; border: 1px dashed var(--border);">
            <p style="font-size: 1.15rem; color: var(--text-main); margin-bottom: 8px; font-weight: 600;">No gallery items added yet.</p>
            <p style="font-size: 0.9rem; color: #777;">Photos and YouTube performance videos added through the admin panel will appear here.</p>
          </div>
        <?php else: ?>
          <?php foreach ($allItems as $item): ?>
            <?php
              $isImage = ($item['type'] === 'image');
              $category = $item['category'];
              $categoryLabel = match($category) {
                  'close-up' => 'Close-up',
                  'events'   => 'Events',
                  default    => 'On Stage',
              };
            ?>

            <div class="gallery-item"
                 data-category="<?= htmlspecialchars($category) ?>"
                 data-title="<?= htmlspecialchars($item['title']) ?>"
                 <?= !$isImage ? ('data-youtube-id="' . htmlspecialchars($item['youtube_id']) . '"') : '' ?>>

              <div class="gallery-img">
                <?php if ($isImage): ?>
                  <img src="<?= BASE_URL ?>/<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" loading="lazy">
                  <span class="badge" style="background: rgba(255, 255, 255, 0.95); color: var(--gold-dark);">&#128247; Photo</span>
                <?php else: ?>
                  <img src="https://img.youtube.com/vi/<?= htmlspecialchars($item['youtube_id']) ?>/hqdefault.jpg" alt="<?= htmlspecialchars($item['title']) ?>" loading="lazy">
                  <span class="badge" style="background: rgba(230, 57, 70, 0.95); color: #fff;">&#9654; Video</span>
                <?php endif; ?>
              </div>

              <h3><?= htmlspecialchars($item['title']) ?></h3>
              <p><?= htmlspecialchars($categoryLabel) ?></p>
            </div>

          <?php endforeach; ?>
        <?php endif; ?>
      </div>

    </div>
  </section>

  <!-- Call to action -->
  <section class="section cta">
    <div class="container cta-inner">
      <div>
        <p class="label">Your event, your guests</p>
        <h2 class="section-title">Want moments like these?</h2>
        <p class="text">
          Tell Magicnas the date, the place and the people.
          Find the right kind of impossible together.
        </p>
      </div>
      <a href="<?= BASE_URL ?>/contact" class="btn btn-white">Let&rsquo;s talk</a>
    </div>
  </section>

  <!-- Popup Lightbox / Modal for full photos and YouTube videos -->
  <div class="modal" id="modal">
    <button class="modal-close" id="modalClose" aria-label="Close">&times;</button>
    <div class="modal-box">
      <div class="modal-media" id="modalMedia"></div>
      <p class="modal-title" id="modalTitle"></p>
    </div>
  </div>

  <style>
    .modal-media iframe {
      width: 100%;
      height: 100%;
      min-height: 480px;
      border: 0;
    }
    @media (max-width: 768px) {
      .modal-media iframe {
        min-height: 280px;
      }
    }
  </style>

  <script src="<?= BASE_URL ?>/js/gallery.js"></script>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
