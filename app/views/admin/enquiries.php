<?php
require_once __DIR__ . '/../layouts/admin_layout.php';
?>

<div class="admin-header">
  <div class="admin-title">
    <h1>Customer Enquiries</h1>
    <p>Review, track, and manage all booking requests submitted through your website.</p>
  </div>
  <div>
    <span class="badge" style="background:var(--bg-panel-light); border:1px solid var(--border-color); padding:8px 14px; border-radius:6px; font-size:0.9rem;">
      Total: <strong style="color:var(--gold);"><?= count($enquiries) ?></strong>
    </span>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h2>All Inquiries</h2>
    <span style="font-size:0.85rem; color:var(--text-muted);">Newest enquiries appear first</span>
  </div>

  <div class="table-responsive">
    <?php if (empty($enquiries)): ?>
      <div style="padding: 48px 24px; text-align: center; color: var(--text-muted);">
        <p style="font-size: 1.1rem; margin-bottom: 8px;">No enquiries received yet.</p>
        <p style="font-size: 0.85rem;">When potential clients submit the booking form on your website, their enquiries will appear here.</p>
      </div>
    <?php else: ?>
      <table class="data-table">
        <thead>
          <tr>
            <th style="width: 50px;">ID</th>
            <th>Client</th>
            <th>Contact Details</th>
            <th>Event Info</th>
            <th style="width: 30%;">Message</th>
            <th>Date Received</th>
            <th>Status</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($enquiries as $item): ?>
            <tr>
              <td style="color: var(--text-muted); font-size: 0.85rem;">#<?= htmlspecialchars($item['id']) ?></td>
              <td>
                <strong style="color: var(--text-main); font-size: 0.95rem;"><?= htmlspecialchars($item['full_name']) ?></strong>
              </td>
              <td>
                <div style="line-height: 1.4;">
                  <div><a href="mailto:<?= htmlspecialchars($item['email']) ?>" style="color: var(--gold); text-decoration: none;"><?= htmlspecialchars($item['email']) ?></a></div>
                  <div style="color: var(--text-muted); font-size: 0.85rem;"><a href="tel:<?= htmlspecialchars($item['phone']) ?>" style="color: inherit; text-decoration: none;"><?= htmlspecialchars($item['phone']) ?></a></div>
                </div>
              </td>
              <td>
                <div style="line-height: 1.4;">
                  <div><strong style="color: #cbd5e1;"><?= htmlspecialchars($item['event_type']) ?></strong></div>
                  <?php if (!empty($item['event_date'])): ?>
                    <div style="font-size: 0.82rem; color: var(--text-muted);">Date: <?= htmlspecialchars(date('M d, Y', strtotime($item['event_date']))) ?></div>
                  <?php endif; ?>
                  <?php if (!empty($item['expected_guests'])): ?>
                    <div style="font-size: 0.82rem; color: var(--text-muted);">Guests: <?= htmlspecialchars($item['expected_guests']) ?></div>
                  <?php endif; ?>
                </div>
              </td>
              <td>
                <div style="max-height: 120px; overflow-y: auto; font-size: 0.88rem; line-height: 1.5; color: #d1d5db; white-space: pre-wrap; background: rgba(0,0,0,0.2); padding: 8px 12px; border-radius: 4px; border: 1px solid rgba(255,255,255,0.05);"><?= htmlspecialchars($item['message']) ?></div>
              </td>
              <td style="font-size: 0.82rem; color: var(--text-muted); white-space: nowrap;">
                <?= htmlspecialchars(date('M d, Y', strtotime($item['created_at']))) ?><br>
                <?= htmlspecialchars(date('h:i A', strtotime($item['created_at']))) ?>
              </td>
              <td>
                <form action="<?= BASE_URL ?>/admin/enquiries/status" method="POST" style="display:inline-block;">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                  <select name="status" onchange="this.form.submit()" style="background:var(--bg-dark); color:<?= ($item['status'] === 'unread') ? 'var(--gold)' : '#72e396' ?>; border:1px solid var(--border-color); padding:4px 8px; border-radius:4px; font-size:0.8rem; cursor:pointer;">
                    <option value="unread" <?= ($item['status'] === 'unread') ? 'selected' : '' ?>>Unread</option>
                    <option value="read" <?= ($item['status'] === 'read') ? 'selected' : '' ?>>Read</option>
                    <option value="archived" <?= ($item['status'] === 'archived') ? 'selected' : '' ?>>Archived</option>
                  </select>
                </form>
              </td>
              <td style="text-align: right; white-space: nowrap;">
                <form action="<?= BASE_URL ?>/admin/enquiries/delete" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this enquiry from <?= htmlspecialchars(addslashes($item['full_name'])) ?>?');" style="display: inline-block;">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                  <button type="submit" class="btn btn-danger btn-sm" title="Delete enquiry">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
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
