<?php
require_once __DIR__ . '/../layouts/admin_layout.php';

$totalEnquiries    = $totalEnquiries ?? 0;
$unreadEnquiries   = $unreadEnquiries ?? 0;
$readEnquiries     = $readEnquiries ?? 0;
$archivedEnquiries = $archivedEnquiries ?? 0;
$totalImages       = $totalImages ?? 0;
$totalVideos       = $totalVideos ?? 0;
$totalMedia        = $totalMedia ?? 0;
$recentEnquiries   = $recentEnquiries ?? [];
$recentImages      = $recentImages ?? [];
$recentVideos      = $recentVideos ?? [];
$eventTypeCounts   = $eventTypeCounts ?? [];
$categoryCounts    = $categoryCounts ?? ['on-stage' => 0, 'close-up' => 0, 'events' => 0];
?>

<style>
  /* -------------------------------------------------------------------------
     DASHBOARD REFINED STYLES
     ------------------------------------------------------------------------- */
  .dash-hero {
    background: linear-gradient(135deg, rgba(21, 25, 34, 0.95) 0%, rgba(28, 34, 48, 0.85) 100%);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 26px 30px;
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
  }
  .dash-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, var(--gold) 0%, #b8972e 100%);
  }
  .dash-hero::after {
    content: '';
    position: absolute;
    top: -60px;
    right: -40px;
    width: 220px;
    height: 220px;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.12) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }
  .hero-greeting h1 {
    font-family: 'Cinzel', serif;
    font-size: 1.65rem;
    font-weight: 700;
    color: var(--text-main);
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 6px;
  }
  .hero-greeting h1 span.gold-name {
    color: var(--gold-light);
  }
  .hero-greeting p {
    color: var(--text-secondary);
    font-size: 0.92rem;
    max-width: 620px;
    line-height: 1.5;
  }
  .hero-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  /* KPI Grid */
  .kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 20px;
    margin-bottom: 30px;
    width: 100%;
    max-width: 100%;
  }
  .kpi-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 22px;
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
    min-width: 0;
    max-width: 100%;
  }
  .kpi-card:hover {
    transform: translateY(-2px);
    border-color: rgba(212, 175, 55, 0.35);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.3);
  }
  .kpi-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
  }
  .kpi-title {
    font-size: 0.82rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--text-muted);
  }
  .kpi-icon-wrap {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .kpi-icon-gold {
    background: rgba(212, 175, 55, 0.12);
    color: var(--gold);
    border: 1px solid rgba(212, 175, 55, 0.25);
  }
  .kpi-icon-amber {
    background: rgba(245, 158, 11, 0.12);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.25);
  }
  .kpi-icon-emerald {
    background: rgba(16, 185, 129, 0.12);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.25);
  }
  .kpi-icon-rose {
    background: rgba(239, 68, 68, 0.12);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.25);
  }
  .kpi-value {
    font-family: 'Cinzel', serif;
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--text-main);
    line-height: 1;
    margin-bottom: 10px;
  }
  .kpi-subtext {
    font-size: 0.82rem;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 12px;
  }
  .kpi-bottom-link {
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    padding-top: 10px;
    margin-top: auto;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .kpi-bottom-link a {
    color: var(--gold);
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: gap 0.2s;
  }
  .kpi-bottom-link a:hover {
    gap: 7px;
  }

  .pulse-dot-amber {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #f59e0b;
    box-shadow: 0 0 0 rgba(245, 158, 11, 0.5);
    animation: pulseAmber 1.8s infinite;
  }
  @keyframes pulseAmber {
    0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.6); }
    70% { box-shadow: 0 0 0 8px rgba(245, 158, 11, 0); }
    100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
  }

  /* Two Column Main Dashboard Structuring */
  .dash-main-grid {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(0, 1fr);
    gap: 24px;
    width: 100%;
    max-width: 100%;
  }
  .grid-column {
    display: flex;
    flex-direction: column;
    gap: 24px;
    min-width: 0;
    max-width: 100%;
    width: 100%;
  }

  /* Client Table Avatar */
  .client-avatar-circle {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: rgba(212, 175, 55, 0.15);
    color: var(--gold);
    border: 1px solid rgba(212, 175, 55, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 700;
    flex-shrink: 0;
  }

  /* Launchpad Grid */
  .launchpad-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
    width: 100%;
    max-width: 100%;
  }
  .launch-btn {
    background: var(--bg-subtle);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 14px 16px;
    color: var(--text-main);
    text-decoration: none;
    display: flex;
    flex-direction: column;
    gap: 6px;
    transition: all 0.2s ease;
  }
  .launch-btn:hover {
    border-color: var(--gold);
    background: var(--gold-subtle);
    transform: translateY(-2px);
  }
  .launch-icon {
    font-size: 1.3rem;
  }
  .launch-title {
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--text-main);
  }
  .launch-desc {
    font-size: 0.74rem;
    color: var(--text-muted);
  }

  /* Progress meters */
  .meter-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
    width: 100%;
    max-width: 100%;
  }
  .meter-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
    min-width: 0;
    max-width: 100%;
    width: 100%;
  }
  .meter-header {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
    color: var(--text-secondary);
  }
  .meter-track {
    width: 100%;
    height: 7px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 4px;
    overflow: hidden;
  }
  .meter-bar {
    height: 100%;
    border-radius: 4px;
    transition: width 0.5s ease;
  }

  /* Media Preview Strip */
  .thumb-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(115px, 1fr));
    gap: 12px;
    width: 100%;
    max-width: 100%;
  }
  .thumb-card {
    background: #0d1017;
    border: 1px solid var(--border);
    border-radius: 8px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
  }
  .thumb-card:hover {
    border-color: var(--gold);
    transform: translateY(-2px);
  }
  .thumb-img {
    width: 100%;
    height: 85px;
    object-fit: cover;
    background: #000;
    display: block;
  }
  .thumb-content {
    padding: 8px 10px;
    font-size: 0.78rem;
  }
  .thumb-title {
    font-weight: 600;
    color: var(--text-main);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .thumb-cat {
    font-size: 0.7rem;
    color: var(--gold);
    text-transform: capitalize;
    margin-top: 2px;
  }

  @media (max-width: 1180px) {
    .kpi-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    .dash-main-grid {
      grid-template-columns: minmax(0, 1fr);
    }
  }

  @media (max-width: 600px) {
    .kpi-grid {
      grid-template-columns: minmax(0, 1fr);
    }
    .launchpad-grid {
      grid-template-columns: minmax(0, 1fr);
    }
    .dash-hero {
      padding: 20px 18px;
    }
  }
</style>

<!-- Top Executive Banner -->
<section class="dash-hero">
  <div class="hero-greeting">
    <h1>
      <span>&#127913;</span> Welcome back, <span class="gold-name"><?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?></span>!
    </h1>
    <p>Central management suite for customer booking inquiries, stage performances, and high-resolution portfolio media.</p>
  </div>

  <div class="hero-actions">
    <a href="<?= BASE_URL ?>/admin/enquiries" class="btn btn-gold btn-sm">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
      <span>Review Inquiries</span>
    </a>
    <a href="<?= BASE_URL ?>/admin/media" class="btn btn-outline btn-sm">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect><line x1="7" y1="2" x2="7" y2="22"></line><line x1="17" y1="2" x2="17" y2="22"></line></svg>
      <span>Media Manager</span>
    </a>
  </div>
</section>

<!-- KPI Stats Row -->
<section class="kpi-grid">
  <!-- Total Enquiries -->
  <div class="kpi-card">
    <div>
      <div class="kpi-top">
        <span class="kpi-title">Total Enquiries</span>
        <div class="kpi-icon-wrap kpi-icon-gold">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        </div>
      </div>
      <div class="kpi-value"><?= number_format($totalEnquiries) ?></div>
      <div class="kpi-subtext">
        <span style="color:var(--gold); font-weight:600;"><?= $unreadEnquiries ?></span> unread &bull;
        <span style="color:#6ee7b7; font-weight:600;"><?= $readEnquiries ?></span> read
      </div>
    </div>
    <div class="kpi-bottom-link">
      <span style="color:var(--text-muted);">Incoming requests</span>
      <a href="<?= BASE_URL ?>/admin/enquiries">View all &rarr;</a>
    </div>
  </div>

  <!-- Pending Action -->
  <div class="kpi-card">
    <div>
      <div class="kpi-top">
        <span class="kpi-title">Requires Action</span>
        <div class="kpi-icon-wrap kpi-icon-amber">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        </div>
      </div>
      <div class="kpi-value" style="color:<?= $unreadEnquiries > 0 ? '#fbbf24' : 'var(--text-main)' ?>;">
        <?= number_format($unreadEnquiries) ?>
      </div>
      <div class="kpi-subtext">
        <?php if ($unreadEnquiries > 0): ?>
          <span style="color:#fbbf24; display:inline-flex; align-items:center; gap:6px;">
            <span class="pulse-dot-amber"></span> Follow-up required
          </span>
        <?php else: ?>
          <span style="color:#6ee7b7;">&#10003; Inbox fully caught up</span>
        <?php endif; ?>
      </div>
    </div>
    <div class="kpi-bottom-link">
      <span style="color:var(--text-muted);">Pending response</span>
      <a href="<?= BASE_URL ?>/admin/enquiries">Open inbox &rarr;</a>
    </div>
  </div>

  <!-- Gallery Photos -->
  <div class="kpi-card">
    <div>
      <div class="kpi-top">
        <span class="kpi-title">Gallery Photos</span>
        <div class="kpi-icon-wrap kpi-icon-emerald">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
        </div>
      </div>
      <div class="kpi-value"><?= number_format($totalImages) ?></div>
      <div class="kpi-subtext">
        <span><?= $categoryCounts['on-stage'] ?? 0 ?> stage</span> &bull;
        <span><?= $categoryCounts['close-up'] ?? 0 ?> close-up</span>
      </div>
    </div>
    <div class="kpi-bottom-link">
      <span style="color:var(--text-muted);">Active portfolio</span>
      <a href="<?= BASE_URL ?>/admin/media">Upload photo &rarr;</a>
    </div>
  </div>

  <!-- Performance Videos -->
  <div class="kpi-card">
    <div>
      <div class="kpi-top">
        <span class="kpi-title">YouTube Videos</span>
        <div class="kpi-icon-wrap kpi-icon-rose">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
        </div>
      </div>
      <div class="kpi-value"><?= number_format($totalVideos) ?></div>
      <div class="kpi-subtext">
        <span>Stage &amp; close-up event reels</span>
      </div>
    </div>
    <div class="kpi-bottom-link">
      <span style="color:var(--text-muted);">Active embeds</span>
      <a href="<?= BASE_URL ?>/admin/media">Add video &rarr;</a>
    </div>
  </div>
</section>

<!-- Two-Column Main Structuring -->
<div class="dash-main-grid">

  <!-- Main Left Column -->
  <div class="grid-column">

    <!-- Recent Booking Inquiries Table -->
    <div class="card">
      <div class="card-header">
        <div>
          <h2>Recent Booking Inquiries</h2>
          <span style="font-size:0.82rem; color:var(--text-muted);">Newest requests submitted through the live website</span>
        </div>
        <div>
          <a href="<?= BASE_URL ?>/admin/enquiries" class="btn btn-outline btn-sm">
            View All (<?= $totalEnquiries ?>) &rarr;
          </a>
        </div>
      </div>

      <div class="table-responsive">
        <?php if (empty($recentEnquiries)): ?>
          <div style="padding: 46px 24px; text-align: center; color: var(--text-muted);">
            <div style="font-size: 2.4rem; margin-bottom: 8px;">&#9993;</div>
            <p style="font-size: 1.05rem; font-weight: 600; color: var(--text-main); margin-bottom: 4px;">No inquiries received yet</p>
            <p style="font-size: 0.85rem; max-width: 400px; margin: 0 auto;">Client requests submitted via the contact &amp; booking forms will automatically appear here.</p>
          </div>
        <?php else: ?>
          <table class="data-table">
            <thead>
              <tr>
                <th>Client</th>
                <th>Occasion</th>
                <th>Event Date</th>
                <th>Message Snippet</th>
                <th>Status</th>
                <th style="text-align: right;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recentEnquiries as $enquiry): ?>
                <?php
                  $initials = strtoupper(substr(trim($enquiry['full_name'] ?: 'C'), 0, 2));
                ?>
                <tr>
                  <td>
                    <div style="display:flex; align-items:center; gap:10px;">
                      <div class="client-avatar-circle"><?= htmlspecialchars($initials) ?></div>
                      <div>
                        <div style="font-weight: 600; color: var(--text-main); font-size: 0.92rem;">
                          <?= htmlspecialchars($enquiry['full_name']) ?>
                        </div>
                        <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 2px;">
                          <a href="mailto:<?= htmlspecialchars($enquiry['email']) ?>" style="color: var(--gold); text-decoration: none;">
                            <?= htmlspecialchars($enquiry['email']) ?>
                          </a>
                          <?php if (!empty($enquiry['phone'])): ?>
                            &bull; <a href="tel:<?= htmlspecialchars($enquiry['phone']) ?>" style="color: inherit; text-decoration: none;">
                              <?= htmlspecialchars($enquiry['phone']) ?>
                            </a>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span style="display:inline-block; background:rgba(212,175,55,0.1); color:var(--gold); border:1px solid rgba(212,175,55,0.25); padding:3px 8px; border-radius:4px; font-size:0.76rem; font-weight:600;">
                      <?= htmlspecialchars($enquiry['event_type'] ?: 'Magic Performance') ?>
                    </span>
                    <?php if (!empty($enquiry['expected_guests'])): ?>
                      <div style="font-size:0.75rem; color:var(--text-muted); margin-top:3px;">
                        ~<?= htmlspecialchars($enquiry['expected_guests']) ?> guests
                      </div>
                    <?php endif; ?>
                  </td>
                  <td style="font-size: 0.84rem; color: var(--text-secondary); white-space: nowrap;">
                    <?php if (!empty($enquiry['event_date'])): ?>
                      <strong style="color: #cbd5e1;"><?= date('M d, Y', strtotime($enquiry['event_date'])) ?></strong>
                    <?php else: ?>
                      <span style="font-style: italic; color: var(--text-muted);">Not set</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div style="max-width: 200px; font-size: 0.82rem; color: #94a3b8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($enquiry['message']) ?>">
                      <?= htmlspecialchars($enquiry['message']) ?>
                    </div>
                  </td>
                  <td>
                    <?php if (($enquiry['status'] ?? 'unread') === 'unread'): ?>
                      <span class="badge-unread">Unread</span>
                    <?php elseif (($enquiry['status'] ?? '') === 'read'): ?>
                      <span class="badge-read">Read</span>
                    <?php else: ?>
                      <span style="background:rgba(156,163,175,0.12); color:#9ca3af; border:1px solid rgba(156,163,175,0.25); padding:3px 8px; border-radius:12px; font-size:0.75rem;">Archived</span>
                    <?php endif; ?>
                  </td>
                  <td style="text-align: right; white-space: nowrap;">
                    <a href="<?= BASE_URL ?>/admin/enquiries" class="btn btn-outline btn-sm" style="padding: 4px 8px; font-size: 0.76rem;">
                      Manage &rarr;
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>

    <!-- Portfolio Media Activity Card -->
    <div class="card">
      <div class="card-header">
        <div>
          <h2>Portfolio Highlights</h2>
          <span style="font-size:0.82rem; color:var(--text-muted);">Recent photo uploads and video embeds</span>
        </div>
        <div>
          <a href="<?= BASE_URL ?>/admin/media" class="btn btn-outline btn-sm">
            &#127916; Media Manager &rarr;
          </a>
        </div>
      </div>
      <div class="card-body">

        <!-- Photos Row -->
        <div style="margin-bottom: 24px;">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <strong style="font-size:0.88rem; color:var(--gold-light); display:flex; align-items:center; gap:6px;">
              &#128247; Latest Photos
            </strong>
            <a href="<?= BASE_URL ?>/admin/media" style="font-size:0.8rem; color:var(--text-muted); text-decoration:none;">
              + Upload photo
            </a>
          </div>

          <?php if (empty($recentImages)): ?>
            <div style="padding: 22px; text-align: center; color: var(--text-muted); background: #0d1017; border-radius: 8px; border: 1px dashed var(--border);">
              <p style="font-size: 0.85rem; margin-bottom: 8px;">No photos uploaded yet.</p>
              <a href="<?= BASE_URL ?>/admin/media" class="btn btn-gold btn-sm" style="font-size:0.78rem;">Upload First Photo</a>
            </div>
          <?php else: ?>
            <div class="thumb-grid">
              <?php foreach ($recentImages as $img): ?>
                <div class="thumb-card">
                  <img src="<?= BASE_URL ?>/<?= htmlspecialchars(ltrim($img['image_path'], '/')) ?>" alt="<?= htmlspecialchars($img['title']) ?>" class="thumb-img" onerror="this.src='<?= BASE_URL ?>/images/blog-default.jpg'">
                  <div class="thumb-content">
                    <div class="thumb-title" title="<?= htmlspecialchars($img['title']) ?>"><?= htmlspecialchars($img['title']) ?></div>
                    <div class="thumb-cat"><?= htmlspecialchars(str_replace('-', ' ', $img['category'])) ?></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Videos Row -->
        <div>
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <strong style="font-size:0.88rem; color:var(--gold-light); display:flex; align-items:center; gap:6px;">
              &#127916; Latest YouTube Videos
            </strong>
            <a href="<?= BASE_URL ?>/admin/media" style="font-size:0.8rem; color:var(--text-muted); text-decoration:none;">
              + Add video
            </a>
          </div>

          <?php if (empty($recentVideos)): ?>
            <div style="padding: 22px; text-align: center; color: var(--text-muted); background: #0d1017; border-radius: 8px; border: 1px dashed var(--border);">
              <p style="font-size: 0.85rem; margin-bottom: 8px;">No videos added yet.</p>
              <a href="<?= BASE_URL ?>/admin/media" class="btn btn-gold btn-sm" style="font-size:0.78rem;">Add First Video</a>
            </div>
          <?php else: ?>
            <div class="thumb-grid">
              <?php foreach ($recentVideos as $vid): ?>
                <?php
                  $thumbUrl = !empty($vid['youtube_id']) 
                    ? "https://img.youtube.com/vi/" . htmlspecialchars($vid['youtube_id']) . "/hqdefault.jpg" 
                    : BASE_URL . "/images/blog-default.jpg";
                ?>
                <a href="<?= htmlspecialchars($vid['youtube_url']) ?>" target="_blank" class="thumb-card" title="Open YouTube video in new tab">
                  <div style="position:relative;">
                    <img src="<?= $thumbUrl ?>" alt="<?= htmlspecialchars($vid['title']) ?>" class="thumb-img">
                    <span style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); background:rgba(0,0,0,0.75); color:#fff; width:26px; height:26px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.75rem;">&#9658;</span>
                  </div>
                  <div class="thumb-content">
                    <div class="thumb-title" title="<?= htmlspecialchars($vid['title']) ?>"><?= htmlspecialchars($vid['title']) ?></div>
                    <div class="thumb-cat"><?= htmlspecialchars(str_replace('-', ' ', $vid['category'])) ?></div>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>

  </div>

  <!-- Supporting Right Column -->
  <div class="grid-column">

    <!-- Quick Launchpad -->
    <div class="card">
      <div class="card-header">
        <h2>Quick Launchpad</h2>
      </div>
      <div class="card-body">
        <div class="launchpad-grid">
          <a href="<?= BASE_URL ?>/admin/enquiries" class="launch-btn">
            <span class="launch-icon">&#9993;</span>
            <span class="launch-title">Inquiries</span>
            <span class="launch-desc">Manage bookings</span>
          </a>

          <a href="<?= BASE_URL ?>/admin/media" class="launch-btn">
            <span class="launch-icon">&#128247;</span>
            <span class="launch-title">Add Photo</span>
            <span class="launch-desc">Upload show photo</span>
          </a>

          <a href="<?= BASE_URL ?>/admin/media" class="launch-btn">
            <span class="launch-icon">&#127916;</span>
            <span class="launch-title">Add Video</span>
            <span class="launch-desc">Embed YouTube</span>
          </a>

          <a href="<?= BASE_URL ?>/" target="_blank" class="launch-btn">
            <span class="launch-icon">&#127760;</span>
            <span class="launch-title">Live Site</span>
            <span class="launch-desc">Open homepage</span>
          </a>

          <a href="<?= BASE_URL ?>/gallery" target="_blank" class="launch-btn">
            <span class="launch-icon">&#127917;</span>
            <span class="launch-title">Gallery</span>
            <span class="launch-desc">View portfolio</span>
          </a>

          <a href="<?= BASE_URL ?>/services" target="_blank" class="launch-btn">
            <span class="launch-icon">&#10024;</span>
            <span class="launch-title">Services</span>
            <span class="launch-desc">Magic packages</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Portfolio Categories Distribution -->
    <div class="card">
      <div class="card-header">
        <h2>Portfolio Categories</h2>
      </div>
      <div class="card-body">
        <?php
          $catStage  = $categoryCounts['on-stage'] ?? 0;
          $catClose  = $categoryCounts['close-up'] ?? 0;
          $catEvents = $categoryCounts['events'] ?? 0;
          $totalCat  = max(1, $catStage + $catClose + $catEvents);
        ?>
        <div class="meter-list">
          <div class="meter-item">
            <div class="meter-header">
              <span>&#127917; On-Stage Magic</span>
              <strong style="color:var(--text-main);"><?= $catStage ?> item<?= $catStage === 1 ? '' : 's' ?></strong>
            </div>
            <div class="meter-track">
              <div class="meter-bar" style="width: <?= round(($catStage / $totalCat) * 100) ?>%; background: var(--gold);"></div>
            </div>
          </div>

          <div class="meter-item">
            <div class="meter-header">
              <span>&#127183; Close-Up Sleight of Hand</span>
              <strong style="color:var(--text-main);"><?= $catClose ?> item<?= $catClose === 1 ? '' : 's' ?></strong>
            </div>
            <div class="meter-track">
              <div class="meter-bar" style="width: <?= round(($catClose / $totalCat) * 100) ?>%; background: #10b981;"></div>
            </div>
          </div>

          <div class="meter-item">
            <div class="meter-header">
              <span>&#127914; Special Events</span>
              <strong style="color:var(--text-main);"><?= $catEvents ?> item<?= $catEvents === 1 ? '' : 's' ?></strong>
            </div>
            <div class="meter-track">
              <div class="meter-bar" style="width: <?= round(($catEvents / $totalCat) * 100) ?>%; background: #60a5fa;"></div>
            </div>
          </div>
        </div>

        <div style="margin-top: 20px; padding-top: 14px; border-top: 1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
          <span style="font-size:0.85rem; color:var(--text-muted);">Total Media Items</span>
          <strong style="font-size:1.1rem; color:var(--gold);"><?= $totalMedia ?></strong>
        </div>
      </div>
    </div>

    <!-- Booking Requests by Event Type -->
    <div class="card">
      <div class="card-header">
        <h2>Inquiries By Occasion</h2>
      </div>
      <div class="card-body">
        <?php if (empty($eventTypeCounts)): ?>
          <div style="font-size:0.85rem; color:var(--text-muted); line-height:1.6;">
            <p style="margin-bottom:8px;">Client requests are automatically categorized by event:</p>
            <ul style="padding-left:18px; margin:0; color:#cbd5e1; font-size:0.82rem;">
              <li>Stage Magic Shows</li>
              <li>Corporate Events</li>
              <li>Birthday Parties</li>
              <li>Weddings &amp; Receptions</li>
            </ul>
          </div>
        <?php else: ?>
          <div class="meter-list">
            <?php
              $totalEnqCount = max(1, $totalEnquiries);
              foreach ($eventTypeCounts as $type => $count):
                $pct = round(($count / $totalEnqCount) * 100);
            ?>
              <div class="meter-item">
                <div class="meter-header">
                  <span style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:180px;"><?= htmlspecialchars($type) ?></span>
                  <strong style="color:var(--text-main);"><?= $count ?> (<?= $pct ?>%)</strong>
                </div>
                <div class="meter-track">
                  <div class="meter-bar" style="width: <?= $pct ?>%; background: linear-gradient(90deg, var(--gold) 0%, #b8972e 100%);"></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>

</div>

</main>

<footer class="admin-footer">
  &copy; <?= date('Y') ?> Magicnas Administration. All rights reserved.
</footer>

</div> <!-- /.admin-content-area -->

<div class="admin-sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<script>
function toggleSidebar() {
  const sidebar = document.getElementById('adminSidebar');
  const overlay = document.getElementById('sidebarOverlay');
  if (sidebar) sidebar.classList.toggle('open');
  if (overlay) overlay.classList.toggle('open');
}
</script>

</body>
</html>
