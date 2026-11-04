<?php
$extraCss = ['about.css'];
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
        <li><a href="<?= BASE_URL ?>/about" class="active">About</a></li>
        <li><a href="<?= BASE_URL ?>/services">Services</a></li>
        <li><a href="<?= BASE_URL ?>/gallery">Gallery</a></li>
        <li><a href="<?= BASE_URL ?>/contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>

    <!-- Banner -->
    <section class="about-hero-banner">
      <div class="banner-bg">
        <img src="<?= BASE_URL ?>/images/gallery_image_4.png" alt="Magicnas performing on stage">
        <div class="banner-overlay"></div>
      </div>

      <div class="container">
        <div class="banner-content">
          <p class="label">Magicnas &mdash; The Narrative</p>
          <h1 class="banner-title">
            The art of wonder,<br><em>the discipline of the mind.</em>
          </h1>
          <p class="banner-lead">
            Master Illusionist. Psychological Mentalist. Certified Hypnotherapist.<br>
            For over two decades, Nasar Rahman has transformed human perception and
            suggestion into an unforgettable live art form.
          </p>
          <p class="banner-meta">
            <span>Based in Dubai &amp; South India</span>
            <span class="meta-dot">&bull;</span>
            <span>Performing Globally</span>
          </p>
        </div>
      </div>
    </section>

    <!-- Biography -->
    <section class="section biography">
      <div class="container split-grid">

        <div class="sticky-lead">
          <div class="portrait-frame">
            <img src="<?= BASE_URL ?>/images/nasar-portarait.png" alt="Nasar Rahman (Magicnas)">
          </div>
          <p class="label">The artistic philosophy</p>
          <h2 class="split-title">Beyond finger dexterity</h2>

          <div class="stat-badge">
            <div class="stat-num">20+</div>
            <div class="stat-label">Years entertaining global audiences</div>
          </div>
        </div>

        <div class="prose">
          <p class="lead">
            What begins as an impossible mystery on stage is rooted in a dedicated study
            of human behavior, subconscious suggestion, and cognitive focus.
          </p>
          <p>
            Recognized across the United Arab Emirates and internationally as
            <strong>Magicnas</strong>, Nasar Rahman&rsquo;s craft bridges classic Indian and
            European sleight of hand with modern psychological mentalism and clinical
            hypnotherapy. Each performance is designed not merely to fool the eye, but to
            evoke genuine joy, intellectual engagement, and lasting emotional resonance.
          </p>
          <p>
            His path started with classical prestidigitation in South India before evolving
            into psychological mentalism and mindfulness entertainment across the Gulf.
            Having performed before ruling royal dignitaries, armed forces commanders,
            international luxury brands, and corporate summits across Dubai and Abu Dhabi,
            Nas has mastered the art of holding multicultural audiences spellbound without
            theatrical clich&eacute;s or language barriers.
          </p>
          <p>
            Every audience brings a distinct energy. Whether performing strolling sleight of
            hand at an intimate VIP dinner or commanding an auditorium of 2,000 corporate
            delegates, Nas ensures every person in the room feels directly connected to the
            experience.
          </p>
          <p>
            Based between Dubai, UAE, and Kerala, India, Nas travels globally for keynote
            shows, grand galas, and bespoke private salon presentations.
          </p>
        </div>

      </div>
    </section>

    <!-- Motto -->
    <section class="section statement-break">
      <div class="container center">
        <p class="label">Core motto</p>
        <blockquote class="statement-quote">
          &ldquo;The affordable art of astonishment;<br>
          <em>lasting wonders of smiles.&rdquo;</em>
        </blockquote>
      </div>
    </section>

    <!-- Two disciplines -->
    <section class="section">
      <div class="container">

        <div class="methodology-header">
          <p class="label">Two core disciplines</p>
          <h2 class="section-title">Where psychology <span class="gold">meets illusion</span></h2>
          <p class="text">
            True deception requires an understanding of how expectations are constructed.
            Every performance is an exploration of memory, influence, and intuition.
          </p>
        </div>

        <div class="methodology-grid">

          <article class="methodology-card">
            <div class="method-image-frame">
              <img src="<?= BASE_URL ?>/images/gallery_image_9.jpg" alt="Psychological mentalism by Magicnas" loading="lazy">
            </div>
            <h3>Psychological Mentalism</h3>
            <p>
              Extracting unspoken thoughts, predicting audience decisions in sealed
              envelopes, and demonstrating intuitive telepathy in full room light.
            </p>
          </article>

          <article class="methodology-card">
            <div class="method-image-frame">
              <img src="<?= BASE_URL ?>/images/gallery_image_6.png" alt="Magicnas grand stage illusion" loading="lazy">
            </div>
            <h3>Theatrical Grand Stage</h3>
            <p>
              Clean, sophisticated illusions crafted for corporate keynotes, gala
              celebrations, and cultural festivals with complete audience participation.
            </p>
          </article>

        </div>
      </div>
    </section>

    <!-- Videos -->
    <section class="section bg-ivory" id="videos">
      <div class="container">

        <div class="video-head">
          <p class="label">Live footage</p>
          <h2 class="section-title">In <span class="gold">Action</span></h2>
          <span class="line"></span>
        </div>

        <div class="video-grid">

          <article class="video-card">
            <a class="video-frame" href="#"
               data-youtube="https://www.youtube.com/watch?v=QmQe4kK_B1U"
               data-title="Family Combo Pack Offer"></a>
            <div class="video-body">
              <h3>Family Combo Pack</h3>
              <p>
                Magic, face painting and party games in one package. A fun,
                easy-to-book show for birthdays and family celebrations.
              </p>
            </div>
          </article>

          <article class="video-card">
            <a class="video-frame" href="#"
               data-youtube="https://www.youtube.com/watch?v=IcEIdneywjY"
               data-title="Party Magic"></a>
            <div class="video-body">
              <h3>Party Magic</h3>
              <p>
                Interactive magic and games that keep children and parents
                involved from the first trick to the last.
              </p>
            </div>
          </article>

          <article class="video-card">
            <a class="video-frame" href="#"
               data-youtube="https://www.youtube.com/watch?v=HbKrQy8dLfY"
               data-title="Fun Magic Reading"></a>
            <div class="video-body">
              <h3>Fun Magic Reading</h3>
              <p>
                Pure psychological mentalism. A guest thinks of a name or a number,
                and Magicnas reveals it, with no stooges and no camera tricks.
              </p>
            </div>
          </article>

        </div>
      </div>
    </section>

    <!-- Three pillars -->
    <section class="section">
      <div class="container">
        <div class="triptych-grid">

          <div class="triptych-item">
            <p class="triptych-num">Pillar 01</p>
            <h3>Certified Hypnotherapy</h3>
            <p>
              Combining cognitive relaxation and subconscious awareness to teach stress
              relief, mental focus, and peak performance alongside magic.
            </p>
          </div>

          <div class="triptych-item">
            <p class="triptych-num">Pillar 02</p>
            <h3>International Galas</h3>
            <p>
              A distinguished portfolio of performances for royal family members,
              corporate leaders, and state assemblies in Dubai and Abu Dhabi.
            </p>
          </div>

          <div class="triptych-item">
            <p class="triptych-num">Pillar 03</p>
            <h3>Bespoke Brand Reveals</h3>
            <p>
              Custom-scripted illusion presentations designed around executive speeches,
              product reveals, and luxury launches.
            </p>
          </div>

        </div>
      </div>
    </section>

    <!-- Contact CTA -->
    <section class="section cta" id="contact">
      <div class="container cta-inner">
        <div>
          <p class="label">Reserve your date</p>
          <h2 class="section-title">Bring wonder to your next event.</h2>
          <p class="text">
            Share your tentative dates, venue city, and gathering size. Management
            responds with full technical riders and calendar availability.
          </p>
        </div>
        <a href="<?= BASE_URL ?>/contact" class="btn btn-white">Request performance dossier</a>
      </div>
    </section>

  </main>

  <script src="<?= BASE_URL ?>/js/about.js"></script>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
