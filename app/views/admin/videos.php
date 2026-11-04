<?php
require_once __DIR__ . '/../layouts/admin_layout.php';
?>

<div class="admin-header">
  <div class="admin-title">
    <h1>Manage Gallery Videos</h1>
    <p>Add YouTube videos to appear dynamically in your website's video showcase.</p>
  </div>
  <div>
    <span class="badge" style="background:var(--bg-panel-light); border:1px solid var(--border-color); padding:8px 14px; border-radius:6px; font-size:0.9rem;">
      Total Videos: <strong style="color:var(--gold);"><?= count($videos) ?></strong>
    </span>
  </div>
</div>

<div style="display: grid; grid-template-columns: 380px 1fr; gap: 24px; align-items: start;">

  <!-- Left: Add New Video Form -->
  <div class="card">
    <div class="card-header">
      <h2>+ Add New YouTube Video</h2>
    </div>
    <div class="card-body">
      <form action="<?= BASE_URL ?>/admin/videos/add" method="POST">
        <div class="form-group">
          <label for="title">Video Title *</label>
          <input type="text" id="title" name="title" class="form-control" placeholder="e.g. Close-Up Sleight of Hand Reel" required>
        </div>

        <div class="form-group">
          <label for="youtube_url">YouTube URL or Video ID *</label>
          <input type="text" id="youtube_url" name="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." required>
          <div class="form-text">
            Supports standard (<code>youtube.com/watch?v=...</code>), shortened (<code>youtu.be/...</code>), embed, shorts, or raw 11-char ID.
          </div>
        </div>

        <div class="form-group">
          <label for="display_order">Display Order</label>
          <input type="number" id="display_order" name="display_order" class="form-control" value="0" min="0">
          <div class="form-text">Lower numbers appear first on the gallery page.</div>
        </div>

        <button type="submit" class="btn btn-gold" style="width: 100%;">Add to Gallery</button>
      </form>
    </div>
  </div>

  <!-- Right: Video List -->
  <div class="card">
    <div class="card-header">
      <h2>Current Videos in Gallery</h2>
    </div>

    <?php if (empty($videos)): ?>
      <div style="padding: 48px 24px; text-align: center; color: var(--text-muted);">
        <p style="font-size: 1.1rem; margin-bottom: 8px;">No videos added yet.</p>
        <p style="font-size: 0.85rem;">Use the form on the left to add your first YouTube performance video.</p>
      </div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 140px;">Preview</th>
              <th>Title &amp; Info</th>
              <th>Order</th>
              <th>Added</th>
              <th style="text-align: right;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($videos as $video): ?>
              <tr>
                <td>
                  <a href="https://www.youtube.com/watch?v=<?= htmlspecialchars($video['youtube_id']) ?>" target="_blank" style="display:block; position:relative; border-radius:6px; overflow:hidden; border:1px solid var(--border-color);">
                    <img src="https://img.youtube.com/vi/<?= htmlspecialchars($video['youtube_id']) ?>/mqdefault.jpg" alt="<?= htmlspecialchars($video['title']) ?>" style="width:100%; height:75px; object-fit:cover; display:block;">
                    <span style="position:absolute; bottom:4px; right:4px; background:rgba(0,0,0,0.8); color:#fff; font-size:0.65rem; padding:2px 5px; border-radius:3px;">&#9654; YouTube</span>
                  </a>
                </td>
                <td>
                  <strong style="color: var(--text-main); font-size: 0.95rem; display:block; margin-bottom:4px;">
                    <?= htmlspecialchars($video['title']) ?>
                  </strong>
                  <div style="font-size: 0.82rem; color: var(--text-muted);">
                    ID: <code><?= htmlspecialchars($video['youtube_id']) ?></code> &bull;
                    <a href="<?= htmlspecialchars($video['youtube_url']) ?>" target="_blank" style="color: var(--gold); text-decoration: none;">Original Link &nearr;</a>
                  </div>
                </td>
                <td style="color: var(--gold); font-weight: 600;">
                  <?= (int)$video['display_order'] ?>
                </td>
                <td style="font-size: 0.82rem; color: var(--text-muted); white-space: nowrap;">
                  <?= htmlspecialchars(date('M d, Y', strtotime($video['created_at']))) ?>
                </td>
                <td style="text-align: right;">
                  <form action="<?= BASE_URL ?>/admin/videos/delete" method="POST" onsubmit="return confirm('Are you sure you want to remove this video from your gallery?');" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($video['id']) ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

</div>

</main>

<footer class="admin-footer">
  &copy; <?= date('Y') ?> Magicnas Administration. All rights reserved.
</footer>

</body>
</html>
