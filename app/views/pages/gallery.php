<?php
$extraCss = ['gallery.css'];
require_once __DIR__ . '/../layouts/header.php';
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

  <!-- YouTube Video Showcase (Loaded dynamically from MySQL) -->
  <section class="section" id="videos" style="background: #0d0f14; border-bottom: 1px solid #1f242d;">
    <div class="container">
      <div style="text-align: center; max-width: 720px; margin: 0 auto 36px;">
        <p class="label" style="color: #d4af37; text-transform: uppercase; letter-spacing: 2px; font-size: 0.85rem; font-weight: 600;">Live in Action</p>
        <h2 class="section-title" style="font-family: 'Cinzel', serif; font-size: 2.2rem; color: #fff; margin-top: 6px;">
          Video <span class="gold">Showcase</span>
        </h2>
        <p class="text" style="color: #9ba3af; margin-top: 10px; font-size: 1rem;">
          Watch live stage clips, impossible psychological reveals, and guest reactions as they unfold in real time.
        </p>
      </div>

      <?php if (empty($videos)): ?>
        <div style="background: #161922; border: 1px dashed #2c323f; border-radius: 10px; padding: 40px 20px; text-align: center; color: #9ba3af;">
          <p style="font-size: 1.1rem; color: #f4f4f4; margin-bottom: 8px;">No videos featured yet.</p>
          <p style="font-size: 0.9rem;">Check back soon or browse our gallery moments below.</p>
        </div>
      <?php else: ?>
        <div class="youtube-grid">
          <?php foreach ($videos as $video): ?>
            <div class="youtube-card">
              <div class="youtube-video-container">
                <iframe
                  src="https://www.youtube-nocookie.com/embed/<?= htmlspecialchars($video['youtube_id']) ?>?rel=0"
                  title="<?= htmlspecialchars($video['title']) ?>"
                  loading="lazy"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  allowfullscreen>
                </iframe>
              </div>
              <div class="youtube-content">
                <h3 class="youtube-title"><?= htmlspecialchars($video['title']) ?></h3>
                <div class="youtube-meta">
                  <span>&#9654; Live Performance</span>
                  <a href="<?= htmlspecialchars($video['youtube_url']) ?>" target="_blank" rel="noopener noreferrer">Watch on YouTube &nearr;</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Photo & Clip Moments Gallery -->
  <section class="section" id="gallery">
    <div class="container">

      <div style="text-align: center; max-width: 650px; margin: 0 auto 30px;">
        <p class="label">Captured Moments</p>
        <h2 class="section-title">Visual <span class="gold">Memories</span></h2>
      </div>

      <div class="filters">
        <button class="active" data-filter="all">All moments</button>
        <button data-filter="stage">On stage</button>
        <button data-filter="closeup">Close-up</button>
        <button data-filter="events">Events</button>
        <button data-filter="video">Video clips</button>
      </div>

      <div class="gallery-grid">

        <div class="gallery-item" data-title="Card Magic" data-type="closeup">
          <div class="gallery-img">
            <img src="<?= BASE_URL ?>/images/gallery_image_1.jpg" alt="Magician performing floating card trick">
          </div>
          <h3>Card Magic</h3>
          <p>Close-up</p>
        </div>

        <div class="gallery-item" data-title="Corporate Interaction" data-type="events closeup">
          <div class="gallery-img">
            <img src="<?= BASE_URL ?>/images/gallery_image_2.png" alt="Magician performing table trick for audience">
          </div>
          <h3>Corporate Interaction</h3>
          <p>Corporate event</p>
        </div>

        <div class="gallery-item" data-title="Dove Production" data-type="stage video">
          <div class="gallery-img">
            <video autoplay muted loop playsinline poster="<?= BASE_URL ?>/images/gallery-dove.jpg">
              <source src="<?= BASE_URL ?>/videos/gallery_video_1.mp4" type="video/mp4">
            </video>
            <span class="badge">&#9654; Live clip</span>
          </div>
          <h3>Dove Production</h3>
          <p>On stage</p>
        </div>

        <div class="gallery-item" data-title="Audience Wonder" data-type="events">
          <div class="gallery-img">
            <img src="<?= BASE_URL ?>/images/gallery_image_3.png" alt="Interactive performance with child volunteer">
          </div>
          <h3>Audience Wonder</h3>
          <p>Family event</p>
        </div>

        <div class="gallery-item" data-title="Stage Illusions" data-type="stage video">
          <div class="gallery-img">
            <video autoplay muted loop playsinline poster="<?= BASE_URL ?>/images/gallery-wands.jpg">
              <source src="<?= BASE_URL ?>/videos/gallery_video_2.mp4" type="video/mp4">
            </video>
            <span class="badge">&#9654; Stage clip</span>
          </div>
          <h3>Stage Illusions</h3>
          <p>On stage</p>
        </div>

        <div class="gallery-item" data-title="Chinese Linking Rings" data-type="stage">
          <div class="gallery-img">
            <img src="<?= BASE_URL ?>/images/gallery_image_4.png" alt="Linking rings with smoke atmosphere">
          </div>
          <h3>Chinese Linking Rings</h3>
          <p>On stage</p>
        </div>

        <div class="gallery-item" data-title="Fire &amp; Flame Magic" data-type="events video">
          <div class="gallery-img">
            <video autoplay muted loop playsinline poster="<?= BASE_URL ?>/images/gallery-fire.jpg">
              <source src="<?= BASE_URL ?>/videos/gallery_video_3.mp4" type="video/mp4">
            </video>
            <span class="badge">&#9654; Live fire</span>
          </div>
          <h3>Fire &amp; Flame Magic</h3>
          <p>Event</p>
        </div>

        <div class="gallery-item" data-title="Ring Mysteries" data-type="stage">
          <div class="gallery-img">
            <img src="<?= BASE_URL ?>/images/gallery_image_5.jpg" alt="Magician holding three linked metal rings">
          </div>
          <h3>Ring Mysteries</h3>
          <p>On stage</p>
        </div>

        <div class="gallery-item" data-title="Youth Smiles &amp; Wonders" data-type="events">
          <div class="gallery-img">
            <img src="<?= BASE_URL ?>/images/gallery_image_7.png" alt="Magician performing interactive trick with youth volunteer">
          </div>
          <h3>Youth Smiles &amp; Wonders</h3>
          <p>Family event</p>
        </div>

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

  <!-- Popup for photos and videos -->
  <div class="modal" id="modal">
    <button class="modal-close" id="modalClose" aria-label="Close">&times;</button>
    <div class="modal-box">
      <div class="modal-media" id="modalMedia"></div>
      <p class="modal-title" id="modalTitle"></p>
    </div>
  </div>

  <style>
    /* Responsive YouTube Grid Styles */
    .youtube-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
      gap: 28px;
    }
    @media (max-width: 640px) {
      .youtube-grid {
        grid-template-columns: 1fr;
      }
    }
    .youtube-card {
      background: #141720;
      border: 1px solid #242936;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
      display: flex;
      flex-direction: column;
      transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }
    .youtube-card:hover {
      transform: translateY(-5px);
      border-color: rgba(212, 175, 55, 0.5);
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.6), 0 0 15px rgba(212, 175, 55, 0.15);
    }
    .youtube-video-container {
      position: relative;
      width: 100%;
      padding-top: 56.25%; /* 16:9 Aspect Ratio */
      background: #000;
    }
    .youtube-video-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: 0;
    }
    .youtube-content {
      padding: 18px 20px;
      display: flex;
      flex-direction: column;
      flex: 1;
      justify-content: space-between;
    }
    .youtube-title {
      font-family: 'Cinzel', serif;
      font-size: 1.05rem;
      color: #f1f3f7;
      margin: 0 0 10px;
      line-height: 1.4;
    }
    .youtube-meta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 0.8rem;
      color: #9ba3af;
      padding-top: 10px;
      border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    .youtube-meta a {
      color: #d4af37;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s;
    }
    .youtube-meta a:hover {
      color: #f3ca40;
      text-decoration: underline;
    }
  </style>

  <script src="<?= BASE_URL ?>/js/gallery.js"></script>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
