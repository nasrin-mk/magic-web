<?php
$extraCss = ['services.css'];
require_once __DIR__ . '/../layouts/header.php';
?>

  <!-- Header -->
  <header class="site-header">
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
        <li><a href="<?= BASE_URL ?>/services" class="active">Services</a></li>
        <li><a href="<?= BASE_URL ?>/gallery">Gallery</a></li>
        <li><a href="<?= BASE_URL ?>/contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>

    <!-- Hero -->
    <section class="section page-hero">
      <div class="container">
        <p class="label">Repertoire &amp; occasions</p>
        <h1 class="page-title">
          Three disciplines of illusion,<br><em>engineered for the room.</em>
        </h1>
        <p class="page-lead">
          Whether commanding an auditorium of 2,000 corporate leaders or performing inches
          away from dinner guests at a private palace reception, each format is calibrated
          to acoustic pacing, sightlines, and crowd psychology.
        </p>
      </div>
    </section>

    <!-- Jump links -->
    <nav class="format-jump-bar" aria-label="Performance formats">
      <div class="container">
        <ul class="jump-links">
          <li><a href="#mentalism-keynote">01 / The Mentalism Keynote</a></li>
          <li><a href="#vip-strolling">02 / VIP Strolling Sleights</a></li>
          <li><a href="#gala-reveal">03 / The Bespoke Gala Reveal</a></li>
          <li><a href="#mindfulness-keynote">04 / Mindfulness &amp; Focus Keynote</a></li>
        </ul>
      </div>
    </nav>

    <!-- Format 01 -->
    <section class="section act-feature" id="mentalism-keynote">
      <div class="container act-grid">

        <div class="act-image-frame">
          <img src="<?= BASE_URL ?>/images/gallery_image_6.png" alt="The Mentalism Keynote by Magicnas" loading="lazy">
        </div>

        <div class="act-copy">
          <p class="act-index-tag">Format 01 &mdash; Auditorium &amp; Stage</p>
          <h2 class="section-title">The Mentalism <span class="gold">Keynote</span></h2>
          <p class="act-synopsis">
            A sophisticated, high-energy stage presentation exploring telepathic suggestion,
            non-verbal intuition, and impossible predictions. Without gaudy props or
            theatrical assistants, Nas extracts unwritten thoughts, anticipates collective
            audience decisions, and demonstrates synchronicity in full room light.
          </p>

          <dl class="spec-table">
            <div class="spec-row">
              <dt>Ideal scale</dt>
              <dd>150 to 2,500+ attendees</dd>
            </div>
            <div class="spec-row">
              <dt>Duration</dt>
              <dd>45 to 60 minutes</dd>
            </div>
            <div class="spec-row">
              <dt>Occasions</dt>
              <dd>Annual summits, client appreciation galas, leadership conferences</dd>
            </div>
            <div class="spec-row">
              <dt>Rider</dt>
              <dd>Wireless headset (DPA or Shure), stage wash lighting, sound system</dd>
            </div>
          </dl>

          <a href="<?= BASE_URL ?>/contact" class="btn btn-gold">Reserve this production</a>
        </div>

      </div>
    </section>

    <!-- Format 02 -->
    <section class="section act-feature" id="vip-strolling">
      <div class="container act-grid reversed">

        <div class="act-image-frame">
          <img src="<?= BASE_URL ?>/images/gallery_image_9.jpg" alt="VIP strolling sleights at handshake distance" loading="lazy">
        </div>

        <div class="act-copy">
          <p class="act-index-tag">Format 02 &mdash; Intimate close-quarters</p>
          <h2 class="section-title">VIP Strolling <span class="gold">Sleights</span></h2>
          <p class="act-synopsis">
            Miracles occurring mere inches away from guests. Rare coins transform, borrowed
            rings vanish and reappear inside sealed envelopes, and cards shift while clamped
            between a spectator&rsquo;s hands. Perfect for cocktail receptions and banquet
            transitions where guests are moving freely.
          </p>

          <dl class="spec-table">
            <div class="spec-row">
              <dt>Ideal scale</dt>
              <dd>40 to 350 cocktail guests</dd>
            </div>
            <div class="spec-row">
              <dt>Duration</dt>
              <dd>90 to 120 minutes (roaming continuous)</dd>
            </div>
            <div class="spec-row">
              <dt>Occasions</dt>
              <dd>VIP cocktail receptions, royal palace dinners, product reveal mixers</dd>
            </div>
            <div class="spec-row">
              <dt>Rider</dt>
              <dd>Zero AV setup; 100% mobile with no staging footprint</dd>
            </div>
          </dl>

          <a href="<?= BASE_URL ?>/contact" class="btn btn-gold">Reserve this production</a>
        </div>

      </div>
    </section>

    <!-- Quote -->
    <section class="section statement-interlude">
      <div class="container">
        <div class="statement-inner">
          <div class="statement-symbol">&ldquo;</div>
          <blockquote class="statement-text">
            A performance cannot just exist on stage. It must connect with the people right
            in front of you&mdash;the right pace, genuine humor, and enough attention to make
            the entire room feel like part of it.
          </blockquote>
          <p class="statement-cite">Nasar Rahman &middot; Dubai &amp; South India</p>
        </div>
      </div>
    </section>

    <!-- Format 03 -->
    <section class="section act-feature" id="gala-reveal">
      <div class="container act-grid">

        <div class="act-image-frame">
          <img src="<?= BASE_URL ?>/images/gallery_image_4.png" alt="The Bespoke Gala Reveal" loading="lazy">
        </div>

        <div class="act-copy">
          <p class="act-index-tag">Format 03 &mdash; Product &amp; brand launches</p>
          <h2 class="section-title">The Bespoke <span class="gold">Gala Reveal</span></h2>
          <p class="act-synopsis">
            Grand illusions custom-choreographed around an executive entrance, flagship
            product unveiling, or brand milestone. Nas collaborates directly with event
            agencies and lighting directors to weave impossible stage appearances into the
            opening ceremony.
          </p>

          <dl class="spec-table">
            <div class="spec-row">
              <dt>Ideal scale</dt>
              <dd>Arenas, televised galas, grand ballrooms (500 to 5,000+)</dd>
            </div>
            <div class="spec-row">
              <dt>Duration</dt>
              <dd>Custom 10-20 minute narrative sequence or show opening</dd>
            </div>
            <div class="spec-row">
              <dt>Occasions</dt>
              <dd>Automotive reveals, brand reinventions, sovereign ceremonial banquets</dd>
            </div>
            <div class="spec-row">
              <dt>Rider</dt>
              <dd>Custom technical rider coordinated with venue AV team</dd>
            </div>
          </dl>

          <a href="<?= BASE_URL ?>/contact" class="btn btn-gold">Reserve this production</a>
        </div>

      </div>
    </section>

    <!-- Format 04 -->
    <section class="section act-feature" id="mindfulness-keynote">
      <div class="container act-grid reversed">

        <div class="act-image-frame">
          <img src="<?= BASE_URL ?>/images/gallery_image_7.png" alt="Mindfulness and hypnotherapy keynote by Magicnas" loading="lazy">
        </div>

        <div class="act-copy">
          <p class="act-index-tag">Format 04 &mdash; Corporate wellness &amp; retreats</p>
          <h2 class="section-title">Mindfulness &amp; the <span class="gold">Architecture of Focus</span></h2>
          <p class="act-synopsis">
            Drawing upon his certified clinical hypnotherapy and subconscious conditioning
            practice, Nas combines jaw-dropping psychological demonstrations with practical
            insights on mental clarity, stress release, and perception reframing for
            corporate teams.
          </p>

          <dl class="spec-table">
            <div class="spec-row">
              <dt>Ideal scale</dt>
              <dd>50 to 800 executive retreat delegates</dd>
            </div>
            <div class="spec-row">
              <dt>Duration</dt>
              <dd>60 to 75 minutes (interactive keynote + Q&amp;A)</dd>
            </div>
            <div class="spec-row">
              <dt>Occasions</dt>
              <dd>Leadership retreats, wellness symposia, executive offsites</dd>
            </div>
            <div class="spec-row">
              <dt>Rider</dt>
              <dd>Wireless handheld microphone, projector screen, comfortable seating</dd>
            </div>
          </dl>

          <a href="<?= BASE_URL ?>/contact" class="btn btn-gold">Reserve this production</a>
        </div>

      </div>
    </section>

    <!-- Event planner FAQ -->
    <section class="section bg-ivory" id="logistics">
      <div class="container two-col faq">

        <div>
          <p class="label">For event planners</p>
          <h2 class="section-title">Logistics &amp; <span class="gold">practical details</span></h2>
          <p class="text">
            Seamless execution is just as important as the magic on stage. Here are the
            common questions event chairs and production directors ask before confirming dates.
          </p>
        </div>

        <div class="faq-list">

          <details name="faq">
            <summary>What languages does Nas perform in?</summary>
            <p>
              Nas performs fluently in English, Malayalam, and Hindi, with polite Arabic
              stage interactivity. His visual and mentalism routines are designed specifically
              to eliminate language barriers across multicultural delegations.
            </p>
          </details>

          <details name="faq">
            <summary>Can multiple formats be combined for one event?</summary>
            <p>
              Yes. Many gala chairs book VIP Strolling Sleights during the 60-minute cocktail
              mixer, followed by the headline Mentalism Keynote on the main stage after dinner.
            </p>
          </details>

          <details name="faq">
            <summary>How are international flights and travel handled?</summary>
            <p>
              Nas is based in Dubai, UAE, and Kerala, India. For international bookings,
              travel logistics (business/economy flights, local ground transfers, and hotel
              accommodation) are simply appended to the performance contract.
            </p>
          </details>

          <details name="faq">
            <summary>Are the routines clean and corporate-appropriate?</summary>
            <p>
              100%. Nas has entertained sovereign families, diplomatic delegations, and
              multinational boards. The humor is witty, respectful, and never relies on
              crude or embarrassing volunteer interactions.
            </p>
          </details>

        </div>
      </div>
    </section>

    <!-- Contact CTA -->
    <section class="section cta" id="contact">
      <div class="container cta-inner">
        <div>
          <p class="label">Find the right format for your gathering</p>
          <h2 class="section-title">Let&rsquo;s craft an unforgettable room.</h2>
          <p class="text">
            Tell us your event date, city, and approximate attendance. We will send over
            full technical riders and calendar availability within 24 hours.
          </p>
        </div>
        <a href="<?= BASE_URL ?>/contact" class="btn btn-white">Check date availability</a>
      </div>
    </section>

  </main>

  <script src="<?= BASE_URL ?>/js/service.js"></script>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
