<?php
require_once __DIR__ . '/../layouts/header.php';
?>

  <!-- Hero -->
  <header class="hero" id="home">
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
        <li><a href="<?= BASE_URL ?>/" class="active">Home</a></li>
        <li><a href="<?= BASE_URL ?>/about">About</a></li>
        <li><a href="<?= BASE_URL ?>/services">Services</a></li>
        <li><a href="<?= BASE_URL ?>/gallery">Gallery</a></li>
        <li><a href="<?= BASE_URL ?>/contact">Contact</a></li>
      </ul>
    </nav>

    <img class="hero-bg" src="<?= BASE_URL ?>/images/Magician.png" alt="Magician holding colorful magic wands">

    <div class="hero-text">
      <p class="label">Professional Magician</p>
      <h1>Mind tricks <span class="gold">Magic Dubai</span></h1>
      <p class="text">No stooges. No camera tricks. Your guest thinks of a name, a number, a free choice - and Magic Nas reveals it. Pure psychological mentalism that stuns CEOs, families, and VIPs. Ideal for corporate events, gala dinners, luxury private parties, and mall activations where you need sophisticated, mind-blowing entertainment.</p>
      <div class="buttons">
        <a href="<?= BASE_URL ?>/contact" class="btn btn-gold">Bring Magicnas to your event</a>
        <a href="<?= BASE_URL ?>/gallery" class="btn btn-outline">Watch the event reel</a>
      </div>
    </div>
  </header>

  <!-- Selected moments -->
  <section class="section bg-white" id="gallery">
    <div class="container two-col">

      <div>
        <img class="moments-img" id="momentImg" src="<?= BASE_URL ?>/images/MentorandBoy.png" alt="Magicnas performing close-up magic">
        <div class="moments-bar">
          <p id="momentCaption">Close-up magic at a private dinner</p>
          <div class="moments-nav">
            <button type="button" id="momentPrev" aria-label="Previous">&lsaquo;</button>
            <span><span id="momentCurrent">1</span> / 3</span>
            <button type="button" id="momentNext" aria-label="Next">&rsaquo;</button>
          </div>
        </div>
      </div>

      <div>
        <p class="label" id="momentTag">A private audience</p>
        <h2 class="section-title">
          <span id="momentLine1">A deck of cards.</span><br>
          <span class="gold" id="momentLine2">A room full of wonder.</span>
        </h2>
        <p class="text" id="momentText">
          An intimate performance for a small, curious crowd. The setting may be
          grand. The magic still happens right there, in someone&rsquo;s hands.
        </p>

        <blockquote class="quote">
          <p id="momentQuote">&ldquo;An incredible performance that left everyone amazed! The show was entertaining, engaging, and truly unforgettable. Highly recommended for any special event.&rdquo;</p>
          <cite id="momentCite">Shibin</cite>
        </blockquote>

        <div class="buttons">
          <a href="<?= BASE_URL ?>/about" class="btn btn-outline">More about Magicnas</a>
        </div>
      </div>

    </div>
  </section>

  <!-- The reaction -->
  <section class="section reaction">
    <div class="container center">
      <p class="label">The method stays hidden.</p>
      <h2 class="section-title">The reaction <span class="gold">is real.</span></h2>
    </div>
    <img class="reaction-img" src="<?= BASE_URL ?>/images/nasar-portarait.png" alt="A guest reacting with surprise during a Magicnas performance">
  </section>

  <!-- Services -->
  <section class="section bg-white" id="services">
    <div class="container">

      <div class="services-head">
        <h2 class="section-title">What are <span class="gold">you planning?</span></h2>
        <p class="text">Five occasions. Different possibilities.<br>One very good decision.</p>
      </div>

      <div class="occasion-list" id="occasionList">

        <button type="button" class="occasion is-active"
          data-service="corporate" aria-expanded="true">
          <img src="<?= BASE_URL ?>/images/gallery_image_6.png" alt="Corporate events magic">
          <span class="occasion-name">Corporate events</span>
          <span class="occasion-desc">
            Give colleagues and clients a shared experience beyond the usual small talk.
            Interactive magic, mentalism and clean humor for conferences, awards nights
            and company dinners.
            <span class="occasion-btn">Explore Details &rarr;</span>
          </span>
          <span class="occasion-toggle-icon" aria-hidden="true"></span>
        </button>

        <button type="button" class="occasion"
          data-service="private" aria-expanded="false">
          <img src="<?= BASE_URL ?>/images/gallery_image_2.png" alt="Private events magic">
          <span class="occasion-name">Private events</span>
          <span class="occasion-desc">
            Birthdays, anniversaries and milestone evenings, with close-up magic
            that moves through the room and keeps every guest involved.
            <span class="occasion-btn">Explore Details &rarr;</span>
          </span>
          <span class="occasion-toggle-icon" aria-hidden="true"></span>
        </button>

        <button type="button" class="occasion"
          data-service="live" aria-expanded="false">
          <img src="<?= BASE_URL ?>/images/gallery_image_7.png" alt="Live performances magic">
          <span class="occasion-name">Live performances</span>
          <span class="occasion-desc">
            Table-to-table magic during the reception, so guests meet each other
            and the couple gets a story worth retelling.
            <span class="occasion-btn">Explore Details &rarr;</span>
          </span>
          <span class="occasion-toggle-icon" aria-hidden="true"></span>
        </button>

        <button type="button" class="occasion"
          data-service="holiday" aria-expanded="false">
          <img src="<?= BASE_URL ?>/images/gallery_image_3.png" alt="Holiday parties magic">
          <span class="occasion-name">Holiday parties</span>
          <span class="occasion-desc">
            A festive show for teams and families that is easy to fit into
            your evening and friendly for every age.
            <span class="occasion-btn">Explore Details &rarr;</span>
          </span>
          <span class="occasion-toggle-icon" aria-hidden="true"></span>
        </button>

        <button type="button" class="occasion"
          data-service="other" aria-expanded="false">
          <img src="<?= BASE_URL ?>/images/gallery_image_4.png" alt="Other occasions magic">
          <span class="occasion-name">Other occasions</span>
          <span class="occasion-desc">
            A host who keeps the program moving, welcomes your speakers
            and adds a moment of wonder between sessions.
            <span class="occasion-btn">Explore Details &rarr;</span>
          </span>
          <span class="occasion-toggle-icon" aria-hidden="true"></span>
        </button>

      </div>
    </div>
  </section>

  <!-- Service Details Popup -->
  <div class="service-popup" id="servicePopup" aria-hidden="true">
    <div class="service-popup-overlay" id="servicePopupOverlay"></div>
    <div class="service-popup-box" role="dialog" aria-modal="true" aria-labelledby="servicePopupTitle">
      <button type="button" class="service-popup-close" id="servicePopupClose" aria-label="Close">&times;</button>
      <div class="service-popup-image-wrap">
        <img id="servicePopupImage" src="" alt="">
      </div>
      <div class="service-popup-body">
        <span class="service-popup-label" id="servicePopupLabel">Service</span>
        <h3 id="servicePopupTitle"></h3>
        <p id="servicePopupDescription"></p>
        <div class="service-popup-features" id="servicePopupFeatures"></div>
        <a id="servicePopupWhatsapp"
           class="service-popup-whatsapp"
           href="#"
           target="_blank"
           rel="noopener">
          <span>WhatsApp to enquire</span>
        </a>
      </div>
    </div>
  </div>

  <!-- About section -->
  <section class="about" id="about">
    <div class="about-photo">
      <img src="<?= BASE_URL ?>/images/gallery_image_4.png" alt="Magicnas on stage">
    </div>

    <div class="about-copy">
      <p class="label">The person behind the magic</p>
      <h2 class="section-title">
        A performer.<br>
        A creator.<br>
        <span class="gold">Always curious.</span>
      </h2>
      <p class="text">
        Before something impossible can happen in front of you, somebody has
        to work out how to make it happen at all.
      </p>
      <p class="text">
        Magicnas builds every performance around your event, from the first
        idea to the final reveal. The result is a show shaped by the person
        who creates it.
      </p>
      <div class="buttons">
        <a href="<?= BASE_URL ?>/contact" class="btn btn-gold">Book your event</a>
      </div>
    </div>
  </section>

  <!-- Video highlight reel -->
  <section class="section bg-white" id="videos">
    <div class="container">
      <div class="video-head">
        <p class="label">Video reels</p>
        <h2 class="section-title">Live in <span class="gold">Action</span></h2>
        <span class="line"></span>
      </div>

      <div class="video-grid">
        <article class="video-card">
          <a class="video-frame" href="#"
             data-youtube="https://www.youtube.com/watch?v=QmQe4kK_B1U"
             data-title="Family Combo Pack Offer"></a>
          <div class="video-body">
            <h3>Family Combo Pack</h3>
            <p>Magic, face painting and party games in one package. A fun, easy-to-book show for birthdays and family celebrations.</p>
          </div>
        </article>

        <article class="video-card">
          <a class="video-frame" href="#"
             data-youtube="https://www.youtube.com/watch?v=IcEIdneywjY"
             data-title="Party Magic"></a>
          <div class="video-body">
            <h3>Party Magic</h3>
            <p>Interactive magic and games that keep children and parents involved from the first trick to the last.</p>
          </div>
        </article>

        <article class="video-card">
          <a class="video-frame" href="#"
             data-youtube="https://www.youtube.com/watch?v=HbKrQy8dLfY"
             data-title="Fun Magic Reading"></a>
          <div class="video-body">
            <h3>Fun Magic Reading</h3>
            <p>Pure psychological mentalism. A guest thinks of a name or a number, and Magicnas reveals it, with no stooges and no camera tricks.</p>
          </div>
        </article>
      </div>

      <div style="text-align: center; margin-top: 36px;">
        <a href="<?= BASE_URL ?>/gallery" class="btn btn-gold">View Full Video Gallery &rarr;</a>
      </div>
    </div>
  </section>

  <!-- Testimonial -->
  <section class="section testimonial">
    <div class="container center">
      <p class="label">From the people who book him</p>
      <blockquote>
        <p>&ldquo;Magicnas is AMAZING! Our attendees are still raving about his show.&rdquo;</p>
        <cite>Shibin</cite>
      </blockquote>
    </div>
  </section>

  <!-- FAQ -->
  <section class="section bg-white" id="faq">
    <div class="container two-col faq">
      <div>
        <p class="label">A few good questions</p>
        <h2 class="section-title">
          Wonder about the magic.<br>
          <span class="gold">Be clear on the plan.</span>
        </h2>
      </div>

      <div class="faq-list">
        <details name="faq">
          <summary>How does booking work?</summary>
          <p>Send a short message with your date, venue and type of event. You will receive a reply with ideas and a quote, and the date is secured once the booking is confirmed.</p>
        </details>
        <details name="faq">
          <summary>Where does Magicnas perform?</summary>
          <p>Across Dubai and the wider Gulf region, at hotels, private homes, exhibition halls and corporate venues.</p>
        </details>
        <details name="faq">
          <summary>Can we see a performance first?</summary>
          <p>Yes. Watch the event reel on this page, and ask if you would like to see footage from a similar event to yours.</p>
        </details>
        <details name="faq">
          <summary>What about show length and technical needs?</summary>
          <p>Roaming sets and stage shows can be shaped to fit your schedule. Technical needs are minimal, and any requirements are confirmed with you well before the event.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- Blog / Latest Stories (Dynamic from Blogger RSS) -->
  <section class="section bg-ivory" id="blog">
    <div class="container">

      <div style="text-align: center; max-width: 680px; margin: 0 auto 40px;">
        <p class="label" style="letter-spacing: 2px;">STORIES &amp; ARTICLES</p>
        <h2 class="section-title">
          Professional Magician in <span class="gold">Dubai &amp; Beyond</span>
        </h2>
        <p class="text" style="margin-top: 10px;">
          Read the latest updates, event highlights, and travel stories directly from our blog.
        </p>
      </div>

      <?php if (!empty($blogs)): ?>
        <div class="blog-grid">
          <?php foreach ($blogs as $post): ?>
            <article class="blog-card">
              <a href="<?= htmlspecialchars($post['link']) ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                <div class="blog-card-img-wrap">
                  <img src="<?= htmlspecialchars($post['thumbnail']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" loading="lazy">
                </div>
                <div class="blog-body">
                  <div style="margin-bottom: 10px;">
                    <span class="blog-date-badge">
                      <?= htmlspecialchars($post['date']) ?>
                    </span>
                  </div>
                  <h3 class="blog-post-title">
                    <?= htmlspecialchars($post['title']) ?>
                  </h3>
                  <p class="blog-post-snippet">
                    <?= htmlspecialchars($post['snippet']) ?>
                  </p>
                  <span class="read-more">
                    Read More &rarr;
                  </span>
                </div>
              </a>
            </article>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p style="text-align: center; color: #777;">Latest stories are temporarily unavailable. Please visit our blog directly.</p>
      <?php endif; ?>

      <div style="text-align: center; margin-top: 40px;">
        <a href="https://www.magicnas.com" target="_blank" rel="noopener noreferrer" class="btn btn-gold">
          Visit Full Blog &rarr;
        </a>
      </div>

    </div>
  </section>

  <style>
    /* Blog Grid Enhancements */
    .blog-card {
      transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      background: #fff;
      border: 1px solid rgba(0, 0, 0, 0.08);
      border-radius: 8px;
    }
    .blog-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 14px 30px rgba(0, 0, 0, 0.12);
      border-color: rgba(212, 175, 55, 0.5);
    }
    .blog-card-img-wrap {
      overflow: hidden;
      position: relative;
      height: 220px;
      background: #0f1217;
    }
    .blog-card-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.4s ease;
    }
    .blog-card:hover .blog-card-img-wrap img {
      transform: scale(1.06);
    }
    .blog-date-badge {
      display: inline-block;
      background: rgba(212, 175, 55, 0.12);
      color: #b8972e;
      border: 1px solid rgba(212, 175, 55, 0.35);
      padding: 3px 10px;
      border-radius: 4px;
      font-size: 0.78rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .blog-post-title {
      font-family: 'Cinzel', serif;
      font-size: 1.15rem;
      line-height: 1.4;
      color: #111;
      margin: 0 0 10px;
      transition: color 0.2s ease;
    }
    .blog-card:hover .blog-post-title {
      color: #b8972e;
    }
    .blog-post-snippet {
      color: #666;
      font-size: 0.9rem;
      line-height: 1.6;
      margin: 0 0 16px;
      flex: 1;
    }
    @media (max-width: 900px) {
      .blog-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <!-- Contact CTA -->
  <section class="section cta" id="contact">
    <div class="container cta-inner">
      <div>
        <p class="label">The next great room could be yours</p>
        <h2 class="section-title">Let&rsquo;s give them a story.</h2>
        <p class="text">
          Tell Magicnas the date, the place and the people.
          Find the right kind of impossible together.
        </p>
      </div>
      <a href="<?= BASE_URL ?>/contact" class="btn btn-white">Let&rsquo;s talk</a>
    </div>
  </section>

  <script>
  // Selected Moments Slider
  var moments = [
    {
      img: "<?= BASE_URL ?>/images/MentorandBoy.png",
      caption: "Close-up magic at a private dinner",
      tag: "A private audience",
      line1: "A deck of cards.",
      line2: "A room full of wonder.",
      text: "An intimate performance for a small, curious crowd. The setting may be grand. The magic still happens right there, in someone’s hands.",
      quote: "“An incredible performance that left everyone amazed! The show was entertaining, engaging, and truly unforgettable. Highly recommended for any special event.”",
      cite: "Shibin"
    },
    {
      img: "<?= BASE_URL ?>/images/gallery_image_6.png",
      caption: "Stage show at a corporate event",
      tag: "A corporate evening",
      line1: "One stage.",
      line2: "Two hundred guests, wondering.",
      text: "Magic and mentalism built around your event, your guests and your schedule, with plenty of room for shared laughter.",
      quote: "“An incredible performance that left everyone amazed! The show was entertaining, engaging, and truly unforgettable. Highly recommended for any special event.”",
      cite: "Shibin"
    },
    {
      img: "<?= BASE_URL ?>/images/gallery_image_8.png",
      caption: "Wedding reception, table to table",
      tag: "A celebration",
      line1: "Table to table.",
      line2: "Smile to smile.",
      text: "Close-up magic that moves through the room, so every guest gets a moment that belongs only to them.",
      quote: "“An incredible performance that left everyone amazed! The show was entertaining, engaging, and truly unforgettable. Highly recommended for any special event.”",
      cite: "Shibin"
    }
  ];

  var current = 0;
  function byId(id) { return document.getElementById(id); }

  function showMoment(i) {
    current = (i + moments.length) % moments.length;
    var m = moments[current];
    byId("momentImg").src = m.img;
    byId("momentCaption").textContent = m.caption;
    byId("momentCurrent").textContent = current + 1;
    byId("momentTag").textContent = m.tag;
    byId("momentLine1").textContent = m.line1;
    byId("momentLine2").textContent = m.line2;
    byId("momentText").textContent = m.text;
    byId("momentQuote").textContent = m.quote;
    byId("momentCite").textContent = m.cite;
  }

  if (byId("momentPrev") && byId("momentNext")) {
    byId("momentPrev").addEventListener("click", function () { showMoment(current - 1); });
    byId("momentNext").addEventListener("click", function () { showMoment(current + 1); });
  }

  // YouTube Videos
  document.querySelectorAll("[data-youtube]").forEach(function (box) {
    var link = box.getAttribute("data-youtube") || "";
    var match = link.match(/(?:youtu\.be\/|v=|embed\/|shorts\/|live\/)([A-Za-z0-9_-]{11})/);
    if (!match) return;
    var id = match[1];
    var title = box.getAttribute("data-title") || "YouTube video";

    box.href = "https://www.youtube.com/watch?v=" + id;
    box.target = "_blank";
    box.rel = "noopener noreferrer";
    box.setAttribute("aria-label", "Watch " + title + " on YouTube");

    if (box.querySelector("img")) return;
    var img = document.createElement("img");
    img.src = "https://i.ytimg.com/vi/" + id + "/hqdefault.jpg";
    img.alt = title;
    img.loading = "lazy";

    var play = document.createElement("span");
    play.className = "video-play";
    var badge = document.createElement("span");
    badge.className = "video-badge";
    badge.textContent = "YouTube ↗";

    box.appendChild(img);
    box.appendChild(play);
    box.appendChild(badge);
  });

  // Service Popups and Accordion
  function initServiceAccordionAndPopup() {
    var serviceCards = document.querySelectorAll(".occasion");
    var popup = byId("servicePopup");
    var popupOverlay = byId("servicePopupOverlay");
    var popupClose = byId("servicePopupClose");
    var popupImage = byId("servicePopupImage");
    var popupLabel = byId("servicePopupLabel");
    var popupTitle = byId("servicePopupTitle");
    var popupDescription = byId("servicePopupDescription");
    var popupFeatures = byId("servicePopupFeatures");
    var popupWhatsapp = byId("servicePopupWhatsapp");

    if (!popup || !popupOverlay || !popupClose || !popupImage || !popupLabel || !popupTitle || !popupDescription || !popupFeatures || !popupWhatsapp) return;

    var services = {
      corporate: {
        label: "Corporate Events",
        title: "Magic that brings people together",
        image: "<?= BASE_URL ?>/images/gallery_image_6.png",
        description: "Give colleagues and clients a shared experience beyond the usual small talk. Interactive magic, mentalism and clean humor designed for professional events.",
        features: ["Interactive close-up magic", "Mentalism and audience participation", "Suitable for conferences and company dinners", "Professional and clean presentation"]
      },
      private: {
        label: "Private Events",
        title: "Make your celebration unforgettable",
        image: "<?= BASE_URL ?>/images/gallery_image_2.png",
        description: "Birthdays, anniversaries and milestone evenings become more memorable with close-up magic that moves naturally through the room.",
        features: ["Close-up magic for guests", "Interactive performances", "Perfect for birthdays and anniversaries", "Guests become part of the experience"]
      },
      live: {
        label: "Live Performances",
        title: "A performance your guests will remember",
        image: "<?= BASE_URL ?>/images/gallery_image_7.png",
        description: "Bring live magic to your event with an engaging performance designed to create memorable moments for your audience.",
        features: ["Live magic performance", "Audience interaction", "Engaging and visual entertainment", "Suitable for receptions and special events"]
      },
      holiday: {
        label: "Holiday Parties",
        title: "Add some magic to the celebration",
        image: "<?= BASE_URL ?>/images/gallery_image_3.png",
        description: "A festive magic experience for teams and families that fits naturally into your evening and keeps guests entertained.",
        features: ["Festive interactive magic", "Suitable for teams and families", "Friendly for different age groups", "Easy to fit into your event schedule"]
      },
      other: {
        label: "Other Occasions",
        title: "Let's create something magical",
        image: "<?= BASE_URL ?>/images/gallery_image_4.png",
        description: "Planning something different? Get in touch and we can create a magic experience that fits your event.",
        features: ["Flexible performance options", "Interactive entertainment", "Can fit different event formats", "Custom arrangements available"]
      }
    };

    function openServicePopup(serviceKey) {
      var service = services[serviceKey];
      if (!service) return;

      popupImage.src = service.image;
      popupImage.alt = service.title;
      popupLabel.textContent = service.label;
      popupTitle.textContent = service.title;
      popupDescription.textContent = service.description;

      // Clear the previous service features
      popupFeatures.innerHTML = "";
      service.features.forEach(function (feature) {
        var item = document.createElement("div");
        item.className = "service-popup-feature";
        item.textContent = feature;
        popupFeatures.appendChild(item);
      });

      // WhatsApp number: country code + number, digits only.
      var whatsappNumber = "9715555966461";
      var message = "Hi, I would like to enquire about " + service.label + ".";
      popupWhatsapp.href = "https://wa.me/" + whatsappNumber + "?text=" + encodeURIComponent(message);

      popup.classList.add("is-open");
      popup.setAttribute("aria-hidden", "false");

      // Prevent background scrolling while the popup is open
      popup.dataset.previousOverflow = document.body.style.overflow;
      document.body.style.overflow = "hidden";
    }

    function closeServicePopup() {
      popup.classList.remove("is-open");
      popup.setAttribute("aria-hidden", "true");
      document.body.style.overflow = popup.dataset.previousOverflow || "";
    }

    var lastClickedService = document.querySelector(".occasion.is-active");

    serviceCards.forEach(function (card) {
      card.addEventListener("click", function (e) {
        var serviceKey = card.getAttribute("data-service");
        var isDetailsBtn = e.target.closest(".occasion-btn");
        var isToggleIcon = e.target.closest(".occasion-toggle-icon");
        var isAlreadyActive = card.classList.contains("is-active");

        // If clicking the "Explore Details" button: open popup immediately!
        if (isDetailsBtn) {
          e.stopPropagation();
          openServicePopup(serviceKey);
          return;
        }

        // If card is already active:
        if (isAlreadyActive) {
          // On mobile, if clicking the toggle icon on an open card, collapse it
          if (isToggleIcon && window.innerWidth <= 1000) {
            e.stopPropagation();
            card.classList.remove("is-active");
            card.setAttribute("aria-expanded", "false");
            lastClickedService = null;
            return;
          }
          // Otherwise, clicking the active card opens the details popup!
          openServicePopup(serviceKey);
          return;
        }

        // Card is not active: expand it in the accordion
        serviceCards.forEach(function (item) {
          item.classList.remove("is-active");
          item.setAttribute("aria-expanded", "false");
        });

        card.classList.add("is-active");
        card.setAttribute("aria-expanded", "true");
        lastClickedService = card;

        // On mobile, smoothly ensure the newly opened section is visible so it doesn't jump away
        if (window.innerWidth <= 1000) {
          setTimeout(function () {
            card.scrollIntoView({ behavior: "smooth", block: "nearest" });
          }, 80);
        }
      });
    });

    popupClose.addEventListener("click", closeServicePopup);
    popupOverlay.addEventListener("click", closeServicePopup);
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && popup.classList.contains("is-open")) {
        closeServicePopup();
      }
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initServiceAccordionAndPopup);
  } else {
    initServiceAccordionAndPopup();
  }
  </script>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
