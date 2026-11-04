<?php
require_once __DIR__ . '/../layouts/admin_layout.php';

$images = $images ?? [];
$videos = $videos ?? [];
?>

<div class="admin-header">
  <div class="admin-title">
    <h1>Gallery Media Manager</h1>
    <p>Upload show photographs and manage YouTube performance videos displayed in your gallery.</p>
  </div>
  <div style="display:flex; gap:12px; align-items:center;">
    <span class="badge" style="background:var(--bg-panel-light); border:1px solid var(--border-color); padding:8px 14px; border-radius:6px; font-size:0.9rem;">
      Photos: <strong style="color:#72e396;"><?= count($images) ?></strong>
    </span>
    <span class="badge" style="background:var(--bg-panel-light); border:1px solid var(--border-color); padding:8px 14px; border-radius:6px; font-size:0.9rem;">
      Videos: <strong style="color:#ff6b6b;"><?= count($videos) ?></strong>
    </span>
    <span class="badge" style="background:var(--bg-panel-light); border:1px solid var(--border-color); padding:8px 14px; border-radius:6px; font-size:0.9rem;">
      Total: <strong style="color:var(--gold);"><?= count($images) + count($videos) ?></strong>
    </span>
  </div>
</div>

<!-- Collapsible Accordion Dropdowns (Stacked Vertically) -->
<div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 32px; width: 100%;">

  <!-- Accordion Panel 1: Add New Photo -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-header accordion-toggle" style="cursor: pointer; user-select: none; display: flex; align-items: center; justify-content: space-between; padding: 16px 20px;" onclick="toggleMediaAccordion('photo')">
      <div style="display: flex; align-items: center; gap: 10px;">
        <span style="font-size: 1.25rem;">&#128247;</span>
        <h2 style="font-size: 1.05rem; margin: 0; color: #fff;">+ Add New Photo</h2>
      </div>
      <span id="photoArrow" style="color: var(--gold); font-size: 0.9rem; transition: transform 0.25s ease;">&#9654;</span>
    </div>
    <div class="card-body" id="photoFormBody" style="display: none; border-top: 1px solid var(--border-color); padding: 24px;">
      <form action="<?= BASE_URL ?>/admin/images/upload" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="image_title">Photo Title *</label>
          <input type="text" id="image_title" name="title" class="form-control" placeholder="e.g. VIP Sleight of Hand Performance" required>
        </div>

        <div class="form-group">
          <label for="image_file">Upload Image File *</label>
          <input type="file" id="image_file" name="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp" required onchange="previewUploadImage(this)">
          <div class="form-text">Formats: JPG, JPEG, PNG, WEBP (Max 8MB)</div>
          <div id="photoPreviewWrap" style="display:none; margin-top:10px; border-radius:6px; overflow:hidden; border:1px solid var(--border-color); max-height:150px;">
            <img id="photoPreviewImg" src="" alt="Preview" style="width:100%; height:150px; object-fit:cover; display:block;">
          </div>
        </div>

        <div class="form-group">
          <label for="image_category">Category *</label>
          <select id="image_category" name="category" class="form-control" required style="background:var(--bg-dark);">
            <option value="on-stage">On Stage</option>
            <option value="close-up">Close-up</option>
            <option value="events">Events</option>
          </select>
          <div class="form-text">Select which gallery filter category displays this photo.</div>
        </div>

        <div class="form-group">
          <label for="image_order">Display Order</label>
          <input type="number" id="image_order" name="display_order" class="form-control" value="0" min="0">
        </div>

        <button type="submit" class="btn btn-gold" style="width: 100%; background:#2a9d8f; border-color:#2a9d8f; color:#fff;">
          &#128247; Upload Photo to Gallery
        </button>
      </form>
    </div>
  </div>

  <!-- Accordion Panel 2: Add New YouTube Video -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-header accordion-toggle" style="cursor: pointer; user-select: none; display: flex; align-items: center; justify-content: space-between; padding: 16px 20px;" onclick="toggleMediaAccordion('video')">
      <div style="display: flex; align-items: center; gap: 10px;">
        <span style="color: #ff4b4b; font-size: 1.25rem;">&#9654;</span>
        <h2 style="font-size: 1.05rem; margin: 0; color: #fff;">+ Add New YouTube Video</h2>
      </div>
      <span id="videoArrow" style="color: var(--gold); font-size: 0.9rem; transition: transform 0.25s ease;">&#9654;</span>
    </div>
    <div class="card-body" id="videoFormBody" style="display: none; border-top: 1px solid var(--border-color); padding: 24px;">
      <form action="<?= BASE_URL ?>/admin/videos/add" method="POST">
        <div class="form-group">
          <label for="video_title">Video Title *</label>
          <input type="text" id="video_title" name="title" class="form-control" placeholder="e.g. Dove Production Stage Illusion" required>
        </div>

        <div class="form-group">
          <label for="youtube_url">YouTube URL or Video ID *</label>
          <input type="text" id="youtube_url" name="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." required>
          <div class="form-text">Accepts watch links, <code>youtu.be</code>, embed, shorts, or raw 11-char ID.</div>
        </div>

        <div class="form-group">
          <label for="video_category">Category *</label>
          <select id="video_category" name="category" class="form-control" required style="background:var(--bg-dark);">
            <option value="on-stage">On Stage</option>
            <option value="close-up">Close-up</option>
            <option value="events">Events</option>
          </select>
          <div class="form-text">Select which gallery filter category displays this video.</div>
        </div>

        <div class="form-group">
          <label for="video_order">Display Order</label>
          <input type="number" id="video_order" name="display_order" class="form-control" value="0" min="0">
        </div>

        <button type="submit" class="btn btn-gold" style="width: 100%;">
          &#9654; Add Video to Gallery
        </button>
      </form>
    </div>
  </div>

</div>

<!-- Media Tabs for Listings -->
<div style="display: flex; gap: 12px; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
  <button type="button" class="btn btn-outline" id="tabBtnPhotos" onclick="switchMediaTab('photos')" style="border-color: var(--gold); color: var(--gold); background: var(--gold-bg); font-weight: 600;">
    &#128247; Uploaded Photos (<?= count($images) ?>)
  </button>
  <button type="button" class="btn btn-outline" id="tabBtnVideos" onclick="switchMediaTab('videos')">
    &#9654; YouTube Videos (<?= count($videos) ?>)
  </button>
</div>

<!-- Section 1: Uploaded Photos Table -->
<div class="card" id="mediaSectionPhotos" style="display: block; margin-bottom: 30px;">
  <div class="card-header">
    <h2>Uploaded Photos (<?= count($images) ?>)</h2>
    <span style="font-size:0.85rem; color:var(--text-muted);">Stored on local filesystem &amp; database</span>
  </div>

  <?php if (empty($images)): ?>
    <div style="padding: 48px 24px; text-align: center; color: var(--text-muted);">
      <p style="font-size: 1.1rem; color: #fff; margin-bottom: 6px;">No photos uploaded yet.</p>
      <p style="font-size: 0.85rem;">Use "+ Add New Photo" above to upload your first gallery image.</p>
    </div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th style="width: 120px;">Preview</th>
            <th>Title</th>
            <th>Category</th>
            <th>File Path</th>
            <th>Order</th>
            <th>Date</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($images as $img): ?>
            <?php
              $categoryLabel = match($img['category'] ?? 'on-stage') {
                  'close-up' => 'Close-up',
                  'events'   => 'Events',
                  default    => 'On Stage',
              };
            ?>
            <tr>
              <td>
                <a href="<?= BASE_URL ?>/<?= htmlspecialchars($img['image_path']) ?>" target="_blank" style="display:block; width:90px; height:60px; border-radius:6px; overflow:hidden; border:1px solid var(--border-color);">
                  <img src="<?= BASE_URL ?>/<?= htmlspecialchars($img['image_path']) ?>" alt="<?= htmlspecialchars($img['title']) ?>" style="width:100%; height:100%; object-fit:cover; display:block;">
                </a>
              </td>
              <td>
                <strong style="color: var(--text-main); font-size: 0.95rem; display:block;"><?= htmlspecialchars($img['title']) ?></strong>
              </td>
              <td>
                <span style="background: rgba(42,157,143,0.15); color: #72e396; border: 1px solid rgba(42,157,143,0.35); padding: 3px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">
                  <?= htmlspecialchars($categoryLabel) ?>
                </span>
              </td>
              <td style="font-size: 0.82rem; color: var(--text-muted);">
                <code><?= htmlspecialchars($img['image_path']) ?></code>
              </td>
              <td style="color: var(--gold); font-weight: 600;">
                <?= (int)$img['display_order'] ?>
              </td>
              <td style="font-size: 0.82rem; color: var(--text-muted); white-space: nowrap;">
                <?= htmlspecialchars(date('M d, Y', strtotime($img['created_at']))) ?>
              </td>
              <td style="text-align: right;">
                <form action="<?= BASE_URL ?>/admin/images/delete" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this photo?');" style="display:inline-block;">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($img['id']) ?>">
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

<!-- Section 2: YouTube Videos Table -->
<div class="card" id="mediaSectionVideos" style="display: none; margin-bottom: 30px;">
  <div class="card-header">
    <h2>YouTube Performance Videos (<?= count($videos) ?>)</h2>
    <span style="font-size:0.85rem; color:var(--text-muted);">Loaded dynamically with YouTube embeds &amp; thumbnails</span>
  </div>

  <?php if (empty($videos)): ?>
    <div style="padding: 48px 24px; text-align: center; color: var(--text-muted);">
      <p style="font-size: 1.1rem; color: #fff; margin-bottom: 6px;">No YouTube videos added yet.</p>
      <p style="font-size: 0.85rem;">Use "+ Add New YouTube Video" above to embed a video into your gallery.</p>
    </div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th style="width: 130px;">Preview</th>
            <th>Title &amp; YouTube ID</th>
            <th>Category</th>
            <th>Order</th>
            <th>Date</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($videos as $vid): ?>
            <?php
              $categoryLabel = match($vid['category'] ?? 'on-stage') {
                  'close-up' => 'Close-up',
                  'events'   => 'Events',
                  default    => 'On Stage',
              };
            ?>
            <tr>
              <td>
                <a href="https://www.youtube.com/watch?v=<?= htmlspecialchars($vid['youtube_id']) ?>" target="_blank" style="display:block; position:relative; width:100px; height:60px; border-radius:6px; overflow:hidden; border:1px solid var(--border-color);">
                  <img src="https://img.youtube.com/vi/<?= htmlspecialchars($vid['youtube_id']) ?>/mqdefault.jpg" alt="<?= htmlspecialchars($vid['title']) ?>" style="width:100%; height:100%; object-fit:cover; display:block;">
                  <span style="position:absolute; bottom:2px; right:2px; background:rgba(230,57,70,0.85); color:#fff; font-size:0.6rem; padding:1px 4px; border-radius:2px;">&#9654;</span>
                </a>
              </td>
              <td>
                <strong style="color: var(--text-main); font-size: 0.95rem; display:block; margin-bottom:3px;">
                  <?= htmlspecialchars($vid['title']) ?>
                </strong>
                <div style="font-size: 0.8rem; color: var(--text-muted);">
                  ID: <code><?= htmlspecialchars($vid['youtube_id']) ?></code> &bull;
                  <a href="<?= htmlspecialchars($vid['youtube_url']) ?>" target="_blank" style="color:var(--gold); text-decoration:none;">Open in YouTube &nearr;</a>
                </div>
              </td>
              <td>
                <span style="background: rgba(230,57,70,0.15); color: #ff8b8b; border: 1px solid rgba(230,57,70,0.35); padding: 3px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">
                  <?= htmlspecialchars($categoryLabel) ?>
                </span>
              </td>
              <td style="color: var(--gold); font-weight: 600;">
                <?= (int)$vid['display_order'] ?>
              </td>
              <td style="font-size: 0.82rem; color: var(--text-muted); white-space: nowrap;">
                <?= htmlspecialchars(date('M d, Y', strtotime($vid['created_at']))) ?>
              </td>
              <td style="text-align: right;">
                <form action="<?= BASE_URL ?>/admin/videos/delete" method="POST" onsubmit="return confirm('Are you sure you want to remove this video?');" style="display:inline-block;">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($vid['id']) ?>">
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

<script>
function toggleMediaAccordion(panel) {
  var photoBody = document.getElementById('photoFormBody');
  var photoArrow = document.getElementById('photoArrow');
  var videoBody = document.getElementById('videoFormBody');
  var videoArrow = document.getElementById('videoArrow');

  if (panel === 'photo') {
    var isClosed = (photoBody.style.display === 'none' || photoBody.style.display === '');
    if (isClosed) {
      photoBody.style.display = 'block';
      photoArrow.innerHTML = '&#9660;';
      // Close video panel
      videoBody.style.display = 'none';
      videoArrow.innerHTML = '&#9654;';
    } else {
      photoBody.style.display = 'none';
      photoArrow.innerHTML = '&#9654;';
    }
  } else if (panel === 'video') {
    var isClosed = (videoBody.style.display === 'none' || videoBody.style.display === '');
    if (isClosed) {
      videoBody.style.display = 'block';
      videoArrow.innerHTML = '&#9660;';
      // Close photo panel
      photoBody.style.display = 'none';
      photoArrow.innerHTML = '&#9654;';
    } else {
      videoBody.style.display = 'none';
      videoArrow.innerHTML = '&#9654;';
    }
  }
}

function switchMediaTab(tab) {
  var secPhotos = document.getElementById('mediaSectionPhotos');
  var secVideos = document.getElementById('mediaSectionVideos');
  var btnPhotos = document.getElementById('tabBtnPhotos');
  var btnVideos = document.getElementById('tabBtnVideos');

  if (tab === 'photos') {
    secPhotos.style.display = 'block';
    secVideos.style.display = 'none';

    btnPhotos.style.borderColor = 'var(--gold)';
    btnPhotos.style.color = 'var(--gold)';
    btnPhotos.style.background = 'var(--gold-bg)';
    btnPhotos.style.fontWeight = '600';

    btnVideos.style.borderColor = 'var(--border-color)';
    btnVideos.style.color = 'var(--text-main)';
    btnVideos.style.background = 'transparent';
    btnVideos.style.fontWeight = '500';
  } else {
    secPhotos.style.display = 'none';
    secVideos.style.display = 'block';

    btnVideos.style.borderColor = 'var(--gold)';
    btnVideos.style.color = 'var(--gold)';
    btnVideos.style.background = 'var(--gold-bg)';
    btnVideos.style.fontWeight = '600';

    btnPhotos.style.borderColor = 'var(--border-color)';
    btnPhotos.style.color = 'var(--text-main)';
    btnPhotos.style.background = 'transparent';
    btnPhotos.style.fontWeight = '500';
  }
}

function previewUploadImage(input) {
  var wrap = document.getElementById('photoPreviewWrap');
  var img = document.getElementById('photoPreviewImg');
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      img.src = e.target.result;
      wrap.style.display = 'block';
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    wrap.style.display = 'none';
  }
}
</script>

<style>
.accordion-toggle {
  transition: background-color 0.2s ease;
}
.accordion-toggle:hover {
  background-color: var(--bg-panel-light) !important;
}
</style>

</main>

<footer class="admin-footer">
  &copy; <?= date('Y') ?> Magicnas Administration. All rights reserved.
</footer>

</body>
</html>
