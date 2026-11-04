<?php
$extraCss = ['contact.css'];
require_once __DIR__ . '/../layouts/header.php';
?>

  <!-- Header -->
  <header class="top">
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
        <li><a href="<?= BASE_URL ?>/gallery">Gallery</a></li>
        <li><a href="<?= BASE_URL ?>/contact" class="active">Contact</a></li>
      </ul>
    </nav>
  </header>

  <!-- Contact form -->
  <section class="section">
    <div class="container contact">

      <!-- Left: intro + details -->
      <div>
        <p class="label">Invite the impossible</p>
        <h1 class="section-title">
          Let&rsquo;s make<br>
          <span class="gold">it happen.</span>
        </h1>
        <p class="text">
          Tell Magicnas about the date, the place and the people. You don&rsquo;t
          need every detail figured out to start a good conversation.
        </p>

        <h3 class="direct-title">Or reach Magicnas directly</h3>
        <div class="direct">
          <p><strong>Email:</strong> <a href="mailto:magicnas@email.com">magicnas@email.com</a></p>
          <p><strong>Phone:</strong> <a href="tel:+9715559646461">+971 5559646461</a></p>
          <p><strong>Location:</strong> UAE, meetings by appointment</p>
          <p><strong>Hours:</strong> Mon &ndash; Sat, 10am &ndash; 8pm. Sunday: events only</p>
        </div>

        <img class="contact-img" src="<?= BASE_URL ?>/images/nasar-portarait.png" alt="Magicnas performing on stage">
      </div>

      <!-- Right: form -->
      <form class="contact-form" action="<?= BASE_URL ?>/enquiry/submit" method="POST">
        <h2>Send an enquiry</h2>
        <p class="form-top">Share the first few details. Fields marked * are required.</p>

        <div class="form-fields">

          <div class="field">
            <label for="name">Full name *</label>
            <input type="text" id="name" name="name" placeholder="Your name" required>
          </div>

          <div class="field">
            <label for="phone">Phone *</label>
            <input type="tel" id="phone" name="phone" placeholder="+971 50 000 0000" required>
          </div>

          <div class="field wide">
            <label for="email">Email address *</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
          </div>

          <div class="field">
            <label for="type">Event type *</label>
            <select id="type" name="event_type" required>
              <option value="">Select event</option>
              <option value="Corporate events">Corporate events</option>
              <option value="Private events">Private events</option>
              <option value="Live performances">Live performances</option>
              <option value="Holiday parties">Holiday parties</option>
              <option value="Other occasions">Other occasions</option>
              <option value="Not sure yet">Not sure yet</option>
            </select>
          </div>

          <div class="field">
            <label for="date">Event date</label>
            <input type="date" id="date" name="event_date">
          </div>

          <div class="field wide">
            <label for="guests">Expected guests</label>
            <input type="text" id="guests" name="guests" placeholder="e.g. 150">
          </div>

          <div class="field wide">
            <label for="message">Your message *</label>
            <textarea id="message" name="message" rows="5" placeholder="Venue, theme, anything we should know..." required></textarea>
          </div>

        </div>

        <button type="submit" class="btn btn-gold">Send enquiry</button>
        <p class="small">Your details are only used to reply to your enquiry. We respond within 24 hours.</p>
      </form>

    </div>
  </section>

  <!-- What happens next -->
  <section class="section">
    <div class="container">
      <p class="label">What happens next</p>
      <h2 class="section-title">A conversation, <span class="gold">then a plan.</span></h2>

      <div class="steps">
        <p><strong>First, the fit.</strong> Talk through the audience, event and timing.</p>
        <p><strong>Then, the details.</strong> Discuss the format, logistics and custom quote.</p>
        <p><strong>Finally, the booking.</strong> Confirm arrangements directly before adding it to the calendar.</p>
      </div>
    </div>
  </section>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
